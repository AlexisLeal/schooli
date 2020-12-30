<?php namespace App\Models;

use CodeIgniter\Model;

class Cursos_model extends Model
{
    #Nombre de la tabla
    protected $table      = 'cursos';
    #nombre de la clave primaria 
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    #Aqui ponemos el nombre de las columnas que vamos a modifcar
    protected $allowedFields = ['nombre','num_niveles','total_dias_laborales','id_frecuencia','comentarios',
    'fecha_creacion','fecha_ultimo_cambio','estatus'];

    protected $useTimestamps = false;
    protected $createdField  = 'fecha_creacion';
    protected $updatedField  = 'fecha_ultimo_cambio';
    protected $deletedField  = 'deleted';

    #Reglas de validacion 
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}