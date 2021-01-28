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
        $db = \Config\Database::connect();
        $date = 0;
        $numerodeSesiones  = ObtenerSesionesparaCurso($idCurso);
        $semanaCompleta = ObtenerDiasdeFrencueciaEspecifica(ObtenerIdFrecuenciaPorCurso($idCurso));
        $diasdeFrecuencia = InsertarDiasenArreglodeFrecuencia($semanaCompleta);
        $numeroSesionesporSemanas = count($diasdeFrecuencia);
       
    
        $semanaincremental = 1;
        $rangoFechas = ObetenerRangodeFechas($idCiclo); 
        $fechaSesiones = ObtenerFechasparaSesiones($rangoFechas,$diasdeFrecuencia);

            for($sesion = 1;$sesion<=$numerodeSesiones;$sesion++){
                if( ($sesion-1) % $numeroSesionesporSemanas == 0 && $sesion != 1){
                    $semanaincremental++;
                }
               
                $fechaSesionesBD = $fechaSesiones[$date];
                $semanaAnual = ObtenerSemanaAnual($fechaSesionesBD);
                $diasdeFrecuanciaBD = ObtenerDia($fechaSesionesBD);
                
                $query = "INSERT INTO $nombreTabla (idgrupo,idcurso,idciclo,idnivel,numerosemanaincremental,numerosemanaanual,sesion,fecha,dia) 
                VALUES ($idGrupo,$idCurso,$idCiclo,$idNivel,$semanaincremental,'".$semanaAnual."',$sesion ,'".$fechaSesionesBD."','".$diasdeFrecuanciaBD."')";
                $db->query($query);
                $date++;
            }

            

       
    }

    function ObtenerIdFrecuenciaPorCurso($id_curso)
{
    $usermode = new Cursos_model($db);
    $usermode->select('id_frecuencia');
    $usermode->where('deleted',0);
    $usermode->where('id',$id_curso);
    $resultado = $usermode->get();
    $row = $resultado->getRow();
    return($row->id_frecuencia);

}

function ObtenerDiasdeFrencueciaEspecifica($id_frencuencia)
{
    $usermode = new Frecuencia_model($db);
    $usermode->select('lunes,martes,miercoles,jueves,viernes,sabado,domingo');
    $usermode->where('deleted',0);
    $usermode->where('id',$id_frencuencia);
    $resultado = $usermode->get();
    $row = $resultado->getRow();
    return($row);

}

function InsertarDiasenArreglodeFrecuencia($diasFrecuencia){

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

function ObetenerRangodeFechas($idCiclo){ 
    $infoCiclo = getCicloEspecifico($idCiclo);
    $fechaInicioCiclo = $infoCiclo->fecha_inicio;
    $fechaFinCiclo    = $infoCiclo->fecha_fin;

    $week_start = strtotime(date("$fechaInicioCiclo"));
    $week_end   = strtotime(date("$fechaFinCiclo"));

    for($i=$week_start; $i<=$week_end; $i+=86400){
      $fecha  = date("Y-m-d", $i);
      $day    = date('l', strtotime($fecha));
      $fechaCompleta[$fecha] = $day;
    }
    return $fechaCompleta;

}

function ObtenerFechasparaSesiones($rangosFechas,$diasSesiones){
    foreach($rangosFechas as $key => $value){
        foreach($diasSesiones as $dias){
            if($dias == $value){
                    $fechasSesiones[] = $key;
            }
        }               
    } 
    return $fechasSesiones;
}

function ObtenerSemanaAnual($fecha){
    $dia    = substr($fecha,8,2);
    $mes    = substr($fecha,5,2);
    $anio    = substr($fecha,0,4); 

    return date('W',  mktime(0,0,0,$mes,$dia,$anio));

}
function ObtenerDia($fecha){
    return date('l', strtotime($fecha));

}

   

?>