<?php namespace App\Models;

use CodeIgniter\Model;

class Control_grupos_calificaciones_evaluaciones_model extends Model
{
    #Nombre de la tabla
    protected $table      = 'control_grupos_calificaciones_evaluaciones';
    #nombre de la clave primaria 
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    #Aqui ponemos el nombre de las columnas que vamos a modifcar
    protected $allowedFields = ['id_alumno','id_grupo','id_evaluacion','calificacion','calificaciontotal','fecha_creacion','fecha_ultimo_cambio'];

    protected $useTimestamps = false;
    protected $createdField  = 'fecha_creacion';
    protected $updatedField  = 'fecha_ultimo_cambio';
    protected $deletedField  = 'deleted';

    #Reglas de validacion 
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
