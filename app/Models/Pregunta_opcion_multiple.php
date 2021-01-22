<?php namespace App\Models;

use CodeIgniter\Model;

class Pregunta_opcion_multiple extends Model
{
    #Nombre de la tabla
    protected $table      = 'pregunta_opcion_multiple';
    #nombre de la clave primaria 
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    #Aqui ponemos el nombre de las columnas que vamos a modifcar
    protected $allowedFields = ['idEvaluacion','idPregunta','valor1','valor2','valor3','valor4','opcion_correcta','fecha_creacion','fecha_ultimo_cambio'];

    protected $useTimestamps = false;
    protected $createdField  = 'fecha_creacion';
    protected $updatedField  = 'fecha_ultimo_cambio';
    protected $deletedField  = 'deleted';
    


    #Reglas de validacion 
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}