<?php namespace App\Models;

use CodeIgniter\Model;

class Grupos_model extends Model
{
    #Nombre de la tabla
    protected $table      = 'grupos';
    #nombre de la clave primaria 
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    #Aqui ponemos el nombre de las columnas que vamos a modifcar
    protected $allowedFields = ['nombre','estatus','id_plantel','id_horario','id_frecuencia','id_salon','id_nivel','codigo_acceso','cupo','precio','inscritos','disponibles','descripcion','id_unidad_negocio','usuario_creo','usuario_modifico','url_imagen','fecha_creacion','fecha_ultimo_cambio'];

    protected $useTimestamps = false;
    protected $createdField  = 'fecha_creacion';
    protected $updatedField  = 'fecha_ultimo_cambio';
    protected $deletedField  = 'deleted';

    #Reglas de validacion 
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}