<?php namespace App\Models;

use CodeIgniter\Model;

class Control_Respuestas_model extends Model
{
    #Nombre de la tabla
    protected $table      = 'control_respuestas';
    #nombre de la clave primaria 
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    #Aqui ponemos el nombre de las columnas que vamos a modifcar
    protected $allowedFields = ['idalumno','idgrupo','idevaluacion','idpregunta','idtipopregunta','respuesta','fecha_creacion','fecha_ultimo_cambio'];

    protected $useTimestamps = false;
    protected $createdField  = 'fecha_creacion';
    protected $updatedField  = 'fecha_ultimo_cambio';
    protected $deletedField  = 'deleted';

    #Reglas de validacion 
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
