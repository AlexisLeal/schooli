<?php namespace App\Models;

use CodeIgniter\Model;

class Preguntas_model extends Model
{
    #Nombre de la tabla
    protected $table      = 'preguntas';
    #nombre de la clave primaria 
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    #Aqui ponemos el nombre de las columnas que vamos a modifcar
    protected $allowedFields = ['idEvaluacion','num_pregunta','pregunta','valor','idTipoPregunta','tiene_imagen','ruta_imagen',
    'clave_pregunta_imagen','tiene_audio_pregunta','ruta_audio_pregunta','clave_pregunta_audio','fecha_creacion','fecha_ultimo_cambio'];

    protected $useTimestamps = false;
    protected $createdField  = 'fecha_creacion';
    protected $updatedField  = 'fecha_ultimo_cambio';
    protected $deletedField  = 'deleted';

    #Reglas de validacion 
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}