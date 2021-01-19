<?php 
use  App\Models\Ciclos_model;
use  App\Models\Horarios_model;
use  App\Models\Salones_model;
use  App\Models\Cursos_model;
use  App\Models\Frecuencia_model;
use  App\Models\Modalidad_model;
use  App\Models\Valor_asistencia_model;
use  App\Models\ValoresAsistencia;

function getAllCiclo()
{
    $usermode = new Ciclos_model($db);
    $usermode->select('id,nombre,estatus,fecha_inicio,fecha_fin,comentarios');
    $usermode->where('deleted',0);
    $resultado = $usermode->get();
    $rowArray = $resultado->getResult();
    return($rowArray);
}
function getCicloEspecifico($id_ciclo)
{
    $usermode = new Ciclos_model($db);
    $usermode->select('id,nombre,estatus,fecha_inicio,fecha_fin,fecha_inicio_excluir,fecha_fin_excluir,comentarios');
    $usermode->where('deleted',0);
    $usermode->where('id',$id_ciclo);
    $resultado = $usermode->get();
    $row = $resultado->getRow();
    return($row);
}


function CatalagogetGetCiclo()
{
    $usermode = new Ciclos_model($db);
    $usermode->select('id,nombre');
    $usermode->where('deleted',0);
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
    $rowArray = $resultado->getResult();
    return($rowArray);
}
function getHorarioEspecifico($id_horario)
{       
    $usermode = new Horarios_model($db);
    $usermode->select('id,nombre,hora_inicio,hora_fin,comentarios,estatus');
    $usermode->where('deleted',0);
    $usermode->where('id',$id_horario);
    $resultado = $usermode->get();
    $row = $resultado->getRow();
    return($row);
}
 
function getAllSalones()
{
    $usermode = new Salones_model($db);
    $usermode->select('id,nombre,comentarios');
    $usermode->where('deleted',0);
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
    $resultado = $usermode->get();
    $row = $resultado->getRow();
    return($row);

}

function getAllCursos()
{
    $usermode = new Cursos_model($db);
    $usermode->select('id,nombre,num_niveles,estatus');
    $usermode->where('deleted',0);
    $resultado = $usermode->get();
    $rowArray = $resultado->getResult();
    return($rowArray);

}

function getCursoEspecifico($id_curso)
{
    $usermode = new Cursos_model($db);
    $usermode->select('id,nombre,num_niveles,id_frecuencia,estatus');
    $usermode->where('deleted',0);
    $usermode->where('id',$id_curso);
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
function CatalagoGetNombreCurso($id_curso)
{
    $usermode = new Cursos_model($db);
    $usermode->select('nombre');
    $usermode->where('deleted',0);
    $usermode->where('id',$id_curso);
    $resultado = $usermode->get();
    $row = $resultado->getRow();
    $nombre = $row->nombre;
    return($nombre);
}
function CatalagoObtenerPonderaciondeCurso($id_curso)
{
    $usermode = new Cursos_model($db);
    $usermode->select('total_dias_laborales,num_examenes,num_ejercicios,valor_asistencia,valor_ejercicios,valor_examenes');
    $usermode->where('deleted',0);
    $usermode->where('id',$id_curso);
    $resultado = $usermode->get();
    $Row = $resultado->getRow();
    return($Row); 
}

function getAllFrecuencia()
{
    $usermode = new Frecuencia_model($db);
    $usermode->select('id,nombre,descripcion,lunes,martes,miercoles,jueves,viernes,sabado,domingo,estatus');
    $usermode->where('deleted',0);
    $resultado = $usermode->get();
    $rowArray = $resultado->getResult();
    return($rowArray);

}

function getFrencueciaEspecifica($id_frencuencia)
{
    $usermode = new Frecuencia_model($db);
    $usermode->select('id,nombre,descripcion,lunes,martes,miercoles,jueves,viernes,sabado,domingo,estatus');
    $usermode->where('deleted',0);
    $usermode->where('id',$id_frencuencia);
    $resultado = $usermode->get();
    $row = $resultado->getRow();
    return($row);

}

function getFrencueciaId($id_frencuencia)
{
    $usermode = new Frecuencia_model($db);
    $usermode->select('id,nombre,descripcion,lunes,martes,miercoles,jueves,viernes,sabado,domingo,estatus');
    $usermode->where('deleted',0);
    $usermode->where('id',$id_frencuencia);
    $resultado = $usermode->get();
    $row = $resultado->getResult();
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
    $resultado = $usermode->get();
    $rowArray = $resultado->getResult();
    return($rowArray);

}

function getValorAsistenciaFrecuencia($id_frecuencia)
{
    $usermode = new Valor_asistencia_model($db);
    $usermode->select('id_frecuencia');
    $usermode->where('deleted',0);
    $usermode->where('id_frecuencia',$id_frecuencia);
    $resultado = $usermode->get();
    $row = $resultado->getRow();
    return($row);
}

function getTipoFormularioRecursos()
{
    $db = \Config\Database::connect();
    $usermodel = $db->table('tipo_recurso_evaluacion');
    $usermodel->select('id,nombre');
    $usermodel->where('deleted',0);
    $query = $usermodel->get();
    $resultado = $query->getResult();
    return($resultado);

}
function getCategoriaEvaluacionRecursos()
{
    $db = \Config\Database::connect();
    $usermodel = $db->table('categoria_recurso_evaluacion');
    $usermodel->select('id,nombre');
    $usermodel->where('deleted',0);
    $query = $usermodel->get();
    $resultado = $query->getResult();
    return($resultado);
}
function getTipoRecursos()
{
    $db = \Config\Database::connect();
    $usermodel = $db->table('tipo_recurso');
    $usermodel->select('id,nombre');
    $usermodel->where('deleted',0);
    $query = $usermodel->get();
    $resultado = $query->getResult();
    return($resultado);

}


function getValorAsistencia()
{
    $usermode = new ValoresAsistencia($db);
    $usermode->select('id,nombre,valor');
    $usermode->where('deleted',0);
    $resultado = $usermode->get();
    $row = $resultado->getResult();
    return($row);

}











?>