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
        numerosemanaanual INT NOT NULL,
        sesion INT NOT NULL,
        fecha DATE NOT NULL,
        dia INT NOT NULL,
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
        $diasdeFrecuancia = InsertarDiasenArreglodeFrecuencia($semanaCompleta);
        //Ponemos un arrgelo de fecha y dia 
        //Debemos poner el numero de sesiones por semana 
        //En este caso seria tres sesiones por semana

        $numeroSesionesporSemanas = count($diasdeFrecuancia);
        $semanaincremental = 1; 
            for($sesion = 1;$sesion<=$numerodeSesiones;$sesion++){
                if($sesion % $numeroSesionesporSemanas == 0){
                    $semanaincremental++;
                }
                if(($aux+1) % $numeroSesionesporSemanas == 0){
                    $aux = 0;
                }
                $diasdeFrecuanciaBD = $diasdeFrecuancia[$aux];
                $query = "INSERT INTO $nombreTabla (idgrupo,idcurso,idciclo,idnivel,numerosemanaincremental,numerosemanaanual,sesion,fecha,dia) 
                VALUES ($idGrupo,$idCurso,$idCiclo,$idNivel,'$semanaincremental',numerosemanaanual,$sesion,'FECHA',$diasdeFrecuanciaBD";
                $db->query($query);
                $date++;
                $aux++;
                /*
                El la variable date estara recoriendo el arrego de fecha y dia 
                ejemplo 
                FECHA[$date] el date dira la posicion 
                $Dia[$date]
                */
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
    $diasHablitadosFrecuencia = array();

    switch (1){ 
        case $diasFrecuencia->lunes:
            $diasHablitadosFrecuencia[] = 'Lu';
            break;
        case $diasFrecuencia->martes:
            $diasHablitadosFrecuencia[] = 'Ma';
            break;
        case $diasFrecuencia->miercoles:
            $diasHablitadosFrecuencia[] = 'Mi';
            break;
        case $diasFrecuencia->jueves:
            $diasHablitadosFrecuencia[] = 'Ju';
            break;
        case $diasFrecuencia->viernes:
            $diasHablitadosFrecuencia[] = 'Vi';
            break;
        case $diasFrecuencia->sabado:
            $diasHablitadosFrecuencia[] = 'Sa';
            break;
        case $diasFrecuencia->domingo:
            $diasHablitadosFrecuencia[] = 'Do';
            break;

    }
    return $diasHablitadosFrecuencia;

}

   

?>