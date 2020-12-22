<?php 
use  App\Models\Grupos_model;
use  App\Models\Grupos_evaluaciones_model;
use  App\Models\Evaluaciones_model;
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

function GruposAsignacionAutomaticaEvaluaciones($idGrupo,$idNivel)
{
    $UseModelGruposEvaluaciones = new Grupos_evaluaciones_model($db);
    $hoy = date("Y-m-d H:i:s");
    foreach(GruposGetNivelEvaluaciones($idNivel) as $fila){
        $data = ['id_grupo'=> $idGrupo,
        'id_evaluacion' => $fila->id,
        'fecha_creacion' => $hoy,
        'fecha_ultimo_cambio' => $hoy,
        ];
        $UseModelGruposEvaluaciones->insert($data);
    }
   
   
}
function GruposGetNivelEvaluaciones($idNivel)
{
    $UseModelEvaluacion = new Evaluaciones_model($db);
    $UseModelEvaluacion->select('id');
    $UseModelEvaluacion->where('nivel',$idNivel);
    $UseModelEvaluacion->where('deleted',0);
    $resultado = $UseModelEvaluacion->get();
    $rowArray = $resultado->getResult();
    return($rowArray);
   
}

?>