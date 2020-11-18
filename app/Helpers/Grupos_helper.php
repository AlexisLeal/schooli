<?php 
use  App\Models\Grupos_model;

function getAllGrupos()
{
    $usermode = new Grupos_model($db);
    $query = "SELECT * FROM grupos WHERE deleted = 0";
    $resultado = $usermode->query($query);
    $rowArray = $resultado->getResult();
    return($rowArray);
}

function generarCodigo() {
    $codigo = '';
    $pattern = '0123456789ABCDEFGHIJKLMNPQRSTUVXWXYZ';
    $max = strlen($pattern)-1;
    for($i=0;$i < 14;$i++) {
        if($i == 4 || $i == 9){
            $codigo .= "-";
        }else{    
       $codigo .= $pattern[rand(0,$max)];
           }
   }
   //En el srtlen se le pone el -1 por que cuenta desde el 1 y el array cuenta desde el 0
    return $codigo;
   }

   function DBCodigo()
   {
    $usermode = new Grupos_model($db);
    $query = "SELECT codigo_acceso FROM grupos WHERE deleted = 0";
    $resultado = $usermode->query($query);
    $rowArray = $resultado->getResult();
    return($rowArray);
     
   }
   
   function checkCodigo(){
        $codigo = generarCodigo();
        foreach(DBCodigo() as $fila){
            if($fila->codigo_acceso  == $codigo){
                return checkCodigo();
            }
        }
        return $codigo;

   }











?>