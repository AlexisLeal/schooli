<?php namespace App\Models;

use CodeIgniter\Model;

class Usuarios extends Model
{
    #Nombre de la tabla
    protected $table      = 'usuarios';
    #nombre de la clave primaria 
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    #Aqui ponemos el nombre de las columnas que vamos a modifcar
    protected $allowedFields = ['nombre','apellido_paterno','apellido_materno','usuario','password','email','estado','telefono','movil','roll'];

    protected $useTimestamps = false;
    protected $createdField  = 'fecha_creacion';
    protected $updatedField  = 'fecha_ultimo_cambio';
    protected $deletedField  = 'deleted';

    #Reglas de validacion 
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}