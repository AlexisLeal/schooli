<?php 
use  App\Models\Grupos_model;
use  App\Models\Cursos_model;
use  App\Models\Recursos_model;
use  App\Models\Frecuencia_model;


function getAllGrupos()
{
    $usermode = new Grupos_model($db);
    $usermode->select('id,nombre,estatus,id_plantel,id_horario,url_imagen');
    $usermode->where('deleted',0);
    $resultado = $usermode->get();
    $rowArray = $resultado->getResult();
    return($rowArray);
}

function generarCodigo() {
    $codigo = '';
    $pattern = '0123456789ABCDEFGHIJKLMNPQRSTUVXWXYZ';
    $max = strlen($pattern)-1;
    for($i=0;$i < 14;$i++) {
        if($i == 4 || $i == 9){
            $codigo .= "-";
        }else{    
       $codigo .= $pattern[rand(0,$max)];
           }
   }
    return $codigo;
   }

function DBCodigo()
{
    $usermode = new Grupos_model($db);
    $usermode->select('codigo_acceso');
    $usermode->where('deleted',0);
    $resultado = $usermode->get();
    $rowArray = $resultado->getResult();
    return($rowArray);
     
}
   
function checkCodigo(){
    $codigo = generarCodigo();
    foreach(DBCodigo() as $fila){
        if($fila->codigo_acceso  == $codigo){
            return checkCodigo();
        }
    }
    return $codigo;

}

function getAllGruposReasignar()
{
    $usermode = new Grupos_model($db);
    $usermode->select('id,nombre,id_plantel,id_unidad_negocio');
    $usermode->where('deleted',0);
    $resultado = $usermode->get();
    $rowArray = $resultado->getResult();
    return($rowArray);
}


function GruposObtenerSesionesporCurso($Id_Curso)
{
        $UserModel = new Cursos_model($db);
        $UserModel->select('total_dias_laborales');
        $UserModel->where('id',$Id_Curso);
        $UserModel->where('deleted',0);
        $Query = $UserModel->get();
        $Resultado = $Query->getRow();
        return $Resultado->total_dias_laborales;
}
function GruposObteneRecursosporCursoNivelSesion($IdCurso,$IdNivel,$Sesion)
{
        $UserModel = new Recursos_model($db);
        $UserModel->select('id,nombre,tipo_recurso,id_evaluacion,ruta');
        $UserModel->where('id_curso',$IdCurso);
        $UserModel->where('id_nivel',$IdNivel);
        $UserModel->where('id_leccion',$Sesion);
        $UserModel->where('deleted',0);
        $Query = $UserModel->get();
        $Resultado = $Query->getResult();
        return $Resultado;
}

function GruposGetIddeCursoPorGrupo($idGrupo)
{
    $usermode = new Grupos_model($db);
    $usermode->select('id_curso');
    $usermode->where('deleted',0);
    $usermode->where('id',$idGrupo);
    $resultado = $usermode->get();
    $row = $resultado->getRow();
    $id_curso = $row->id_curso;
    return($id_curso);
}
function GruposObtenerNivelCursoCiclodeGrupo($idGrupo)
{
    $usermode = new Grupos_model($db);
    $usermode->select('id,id_ciclo,id_curso,id_nivel');
    $usermode->where('deleted',0);
    $usermode->where('id',$idGrupo);
    $resultado = $usermode->get();
    $row = $resultado->getRow();
    return($row);
}
function GruposCrearTablaControlCursoCiclo($idGrupo,$claveGrupo,$IdNivel){
    $db = \Config\Database::connect();
    $claveGrupo = str_replace('-','_',$claveGrupo);
    $nombre= "grupo_{$idGrupo}_cursociclo_clave_{$claveGrupo}_nivel_{$IdNivel}";
    $query =  "CREATE TABLE $nombre ( 
        id INT NOT NULL AUTO_INCREMENT,
        idgrupo INT NOT NULL,
        idcurso INT NOT NULL,
        idciclo INT NOT NULL,
        idnivel INT NOT NULL,
        numerosemanaincremental INT NOT NULL,
        numerosemanaanual INT,
        sesion INT NOT NULL,
        fecha DATE NOT NULL,
        dia VARCHAR(10) NOT NULL,
        PRIMARY KEY (id))";   
        $db->query($query);
        return $nombre;
    }

function GruposInsertaDatosTablaControlCursoCiclo($nombreTabla,$idGrupo,$idCurso,$idCiclo,$idNivel)
    {
        //FUNCION CRITICA 
       
        $numerodeSesiones  = ObtenerSesionesparaCurso($idCurso);
        $db = \Config\Database::connect();
        $date=0;
        $aux = 0;
        $semanaCompleta = ObtenerDiasdeFrencueciaEspecifica(ObtenerIdFrecuenciaPorCurso($idCurso));
        $diasdeFrecuencia = InsertarDiasenArreglodeFrecuencia($semanaCompleta);
        //Ponemos un arrgelo de fecha y dia 
        //Debemos poner el numero de sesiones por semana 
        //En este caso seria tres sesiones por semana

        $numeroSesionesporSemanas = count($diasdeFrecuencia);
       
    
        $semanaincremental = 1;
        $rangoFechas = ObetenerRangodeFechas($idCiclo); 
        $fechaSesiones = ObtenerFechasparaSesiones($rangoFechas,$diasdeFrecuencia);

        $contador = 1;
            for($sesion = 1;$sesion<=$numerodeSesiones;$sesion++){
                if( ($sesion-1) % $numeroSesionesporSemanas == 0 && $sesion != 1){
                    $semanaincremental++;
                    /*
                    
                    echo $contador;
                    echo $sesion;
                    var_dump($semanaincremental);
                    exit();
                */
                }
                if(($aux+1) % $numeroSesionesporSemanas == 0){
                    $aux = 0;
                }

                $diasdeFrecuanciaBD = $diasdeFrecuencia[$aux];
                $fechaSesionesBD = $fechaSesiones[$date];
                
                $query = "INSERT INTO $nombreTabla (idgrupo,idcurso,idciclo,idnivel,numerosemanaincremental,numerosemanaanual,sesion,fecha,dia) 
                VALUES ($idGrupo,$idCurso,$idCiclo,$idNivel,$semanaincremental,2,$sesion,'".$fechaSesionesBD."','".$diasdeFrecuanciaBD."')";
                $db->query($query);
                $date++;
                $aux++;
                $contador++;
                /*
                El la variable date estara recoriendo el arrego de fecha y dia 
                ejemplo 
                FECHA[$date] el date dira la posicion 
                $Dia[$date]
                */
            }



       
    }

    function ObtenerIdFrecuenciaPorCurso($id_curso) //Funciona
{
    $usermode = new Cursos_model($db);
    $usermode->select('id_frecuencia');
    $usermode->where('deleted',0);
    $usermode->where('id',$id_curso);
    $resultado = $usermode->get();
    $row = $resultado->getRow();
    return($row->id_frecuencia);

}

function ObtenerDiasdeFrencueciaEspecifica($id_frencuencia) //Funciona
{
    $usermode = new Frecuencia_model($db);
    $usermode->select('lunes,martes,miercoles,jueves,viernes,sabado,domingo');
    $usermode->where('deleted',0);
    $usermode->where('id',$id_frencuencia);
    $resultado = $usermode->get();
    $row = $resultado->getRow();
    return($row);

}

function InsertarDiasenArreglodeFrecuencia($diasFrecuencia){ //Funciona

    if($diasFrecuencia->lunes == 1){
        $diasHablitadosFrecuencia[] = 'Monday';
        
    }
    if($diasFrecuencia->martes == 1){
        $diasHablitadosFrecuencia[] = 'Tuesday';

    }
    if($diasFrecuencia->miercoles == 1){
        $diasHablitadosFrecuencia[] = 'Wednesday';

    }
    if($diasFrecuencia->jueves == 1){
        $diasHablitadosFrecuencia[] = 'Thursday';

    }
    if($diasFrecuencia->viernes == 1){
        $diasHablitadosFrecuencia[] = 'Friday';

    }
    if($diasFrecuencia->sabado == 1){
        $diasHablitadosFrecuencia[] = 'Saturday';

    }
    if($diasFrecuencia->domingo == 1){
        $diasHablitadosFrecuencia[] = 'Sunday';

    }
    return $diasHablitadosFrecuencia;

}

function ObetenerRangodeFechas($idCiclo){ //Funciona
    $infoCiclo = getCicloEspecifico($idCiclo);
    $fechaInicioCiclo = $infoCiclo->fecha_inicio;
    $fechaFinCiclo    = $infoCiclo->fecha_fin;

    $week_start = strtotime(date("$fechaInicioCiclo"));
    $week_end   = strtotime(date("$fechaFinCiclo"));
  
    /** Inicia funcion GF */
    for($i=$week_start; $i<=$week_end; $i+=86400){
      $fecha  = date("Y-m-d", $i);
      $dia    = substr($fecha,8,2);
      $mes    = substr($fecha,5,2);
      $ano    = substr($fecha,0,4); 
      $day    = date('l', strtotime($fecha));
      $semana = date('W',  mktime(0,0,0,$mes,$dia,$ano));
      $fechaCompleta[$fecha] = $day;


      //$datos[]="$fecha,$semana,$day"; // arreglo normal que tiene todos los dias del ciclo con su num de semana y nombre de dia de la semana

       /* $fechas[] = $fecha;
        $semanas[] = $semana;
        $dias[] = $day;
        */
    }
   
    /*
    $fechaCompleta[0][] = $fechas;
    $fechaCompleta[1][] = $semanas;
    $fechaCompleta[2][] = $dias;
    */
    return $fechaCompleta;

}

function ObtenerFechasparaSesiones($rangosFechas,$diasSesiones){ //Funciona
      /** Termina
                 *  funcion GF */
                // Recorrer arreglo de datos
                    // Dentro de arreglo de datos, recorrer arreglo de frecuencia de dias que tiene 1
                        //  Insertar el registro en la tabla
    foreach($rangosFechas as $key => $value){
        foreach($diasSesiones as $dias){
            if($dias == $value){
                    $fechasSesiones[] = $key;
                    //$semanaAnual[] = $$registros[1];
            }
        }
                         /*   echo "Hola";
                            //obtener cada campo
                            $fechaCiclo      = $registros[0];//es la fecha
                            $numSemana       = $registros[1];//es el numero de semana anual
                            $nombreDiaSemana = $registros[2];//es el nombre del día de la semana

                            //$diasdeFrecuencia arreglo con los dias de la frecuencia, regresa Lu,Ma,Mi,Ju,Vi,Sa,Do

                                 //recorrer dias frecuanci y cuando el dia sea igual a $nombreDiaSemana, hacer el insert
                        */
    } 

   
    return $fechasSesiones;
}

   

?>