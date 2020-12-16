<?php 
use  App\Models\Ciclos_model;
use  App\Models\Horarios_model;
use  App\Models\Salones_model;
use  App\Models\Cursos_model;
use  App\Models\Frecuencia_model;
use  App\Models\Modalidad_model;
function getAllCiclo()
{
    $usermode = new Ciclos_model($db);
    $usermode->select('id,nombre,estatus,fecha_inicio,fecha_fin,comentarios');
    $usermode->where('deleted',0);
    //$query = "SELECT * FROM ciclos WHERE deleted = 0";
    $resultado = $usermode->get();
    $rowArray = $resultado->getResult();
    return($rowArray);
}
function getCicloEspecifico($id_ciclo)
{
    $usermode = new Ciclos_model($db);
    $usermode->select('id,nombre,estatus,fecha_inicio,fecha_fin,comentarios');
    $usermode->where('deleted',0);
    $usermode->where('id',$id_ciclo);
    //$query = "SELECT * FROM ciclos WHERE deleted = 0 AND id = $id_ciclo";
    $resultado = $usermode->get();
    $row = $resultado->getRow();
    return($row);
}

function CatalagogetGetCiclo()
{
    $usermode = new Ciclos_model($db);
    $usermode->select('id,nombre');
    $usermode->where('deleted',0);
    //$query = "SELECT * FROM ciclos WHERE deleted = 0";
    $resultado = $usermode->get();
    $rowArray = $resultado->getResult();
    return($rowArray);
}

function getAllHorarios()
{       
    $usermode = new Horarios_model($db);
    $usermode->select('id,nombre,hora_inicio,hora_fin,comentarios,estatus');
    $usermode->where('deleted',0);
    $resultado = $usermode->get();
    //$query = "SELECT * FROM horarios WHERE deleted = 0";
    //$resultado = $usermode->query($query);
    $rowArray = $resultado->getResult();
    return($rowArray);
}
function getHorarioEspecifico($id_horario)
{       
    $usermode = new Horarios_model($db);
    $usermode->select('id,nombre,hora_inicio,hora_fin,comentarios,estatus');
    $usermode->where('deleted',0);
    $usermode->where('id',$id_horario);
  //  $query = "SELECT * FROM horarios WHERE deleted = 0 AND id = $id_horario";
    $resultado = $usermode->get();
    $row = $resultado->getRow();
    return($row);
}
 
function getAllSalones()
{
    $usermode = new Salones_model($db);
    $usermode->select('id,nombre,comentarios');
    $usermode->where('deleted',0);
   //$query = "SELECT * FROM salones WHERE deleted = 0";
    $resultado = $usermode->get();
    $rowArray = $resultado->getResult();
    return($rowArray);

}

function getSalonEspecificogrupo($id_nivel)
{
    $usermode = new Salones_model($db);
    $usermode->select('id,nombre,comentarios');
    $usermode->where('deleted',0);
    $usermode->where('id',$id_nivel);
    //$query = "SELECT * FROM salones WHERE deleted = 0 AND id = $id_nivel";
    $resultado = $usermode->get();
    $row = $resultado->getRow();
    return($row);

}

function getAllCursos()
{
    $usermode = new Cursos_model($db);
    $usermode->select('id,nombre,num_niveles,comentarios,estatus');
    $usermode->where('deleted',0);

    //$query = "SELECT * FROM cursos WHERE deleted = 0";
    $resultado = $usermode->get();
    $rowArray = $resultado->getResult();
    return($rowArray);

}

function getCursoEspecifico($id_curso)
{
    $usermode = new Cursos_model($db);
    $usermode->select('id,nombre,num_niveles,comentarios,estatus');
    $usermode->where('deleted',0);
    $usermode->where('id',$id_curso);
    //$query = "SELECT * FROM cursos WHERE deleted = 0 AND id = $id_curso";
    $resultado = $usermode->get();
    $row = $resultado->getRow();
    return($row);

}
function CatalagoGetCursos()
{
    $usermode = new Cursos_model($db);
    $usermode->select('id,nombre');
    $usermode->where('deleted',0);
    $resultado = $usermode->get();
    $row = $resultado->getResult();
    return($row);

}


function getAllFrecuencia()
{
    $usermode = new Frecuencia_model($db);
    $usermode->select('id,nombre,descripcion,id_modalidad,lunes,martes,miercoles,jueves,viernes,sabado,domingo,estatus');
    $usermode->where('deleted',0);
    // $query = "SELECT * FROM frecuencia WHERE deleted = 0";
    $resultado = $usermode->get();
    $rowArray = $resultado->getResult();
    return($rowArray);

}

function getFrencueciaEspecifica($id_frencuencia)
{
    $usermode = new Frecuencia_model($db);
    $usermode->select('id,nombre,descripcion,id_modalidad,lunes,martes,miercoles,jueves,viernes,sabado,domingo,estatus');
    $usermode->where('deleted',0);
    $usermode->where('id',$id_frencuencia);
    //$query = "SELECT * FROM frecuencia WHERE deleted = 0 AND id = $id_frencuencia";
    $resultado = $usermode->get();
    $row = $resultado->getRow();
    return($row);

}
function CatalagoGetAllFrecuencias()
    {
    $usermode = new Frecuencia_model($db);
    $usermode->select('id,nombre');
    $usermode->where('deleted',0);
    $resultado = $usermode->get();
    $rowArray = $resultado->getResult();
    return($rowArray);

    }


function getAllModalidad()
{
    $usermode = new Modalidad_model($db);
    $usermode->select('id,nombre');
    $usermode->where('deleted',0);
    //$query = "SELECT * FROM modalidad WHERE deleted = 0";
    
    $resultado = $usermode->get();
    $rowArray = $resultado->getResult();
    return($rowArray);

}
 
function getModalidadEspecifica($id_modalidad)
{
    $usermode = new Modalidad_model($db);
    $usermode->select('nombre');
    $usermode->where('deleted',0);
    $usermode->where('id',$id_modalidad);
   // $query = "SELECT * FROM modalidad WHERE deleted = 0 AND id = $id_modalidad";
    $resultado = $usermode->get();
    $row = $resultado->getRow();
    return($row);

}
?>