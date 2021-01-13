<?php namespace App\Models;

use CodeIgniter\Model;

class Kardex_model extends Model
{
    
    protected $table      = 'kardex';
    
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    
    protected $allowedFields = ['id_usuario','id_nivel','primera_oportunidad','segunda_oportunidad','fecha_creacion',
    'fecha_ultimo_cambio'];

    protected $useTimestamps = false;
    protected $createdField  = 'fecha_creacion';
    protected $updatedField  = 'fecha_ultimo_cambio';
    protected $deletedField  = 'deleted';

    #Reglas de validacion 
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}