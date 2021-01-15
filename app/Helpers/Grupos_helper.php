<?php 
use  App\Models\Grupos_model;
use  App\Models\Grupos_evaluaciones_model;
use  App\Models\Evaluaciones_model;
use  App\Models\Cursos_model;
use  App\Models\Recursos_model;


function getAllGrupos()
{
    $usermode = new Grupos_model($db);
    $usermode->select('id,nombre,id_horario,url_imagen');
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
        $UserModel->select('id,nombre,tipo_recurso,id_evaluacion');
        $UserModel->where('id_curso',$IdCurso);
        $UserModel->where('id_nivel',$IdNivel);
        $UserModel->where('id_leccion',$Sesion);
        $UserModel->where('deleted',0);
        $Query = $UserModel->get();
        $Resultado = $Query->getResult();
        return $Resultado;
}

?>