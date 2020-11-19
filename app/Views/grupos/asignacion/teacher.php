<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="<?php echo site_url('Asignacion/asignarteacher');?>" method="post">
<?php foreach(getGrupoMaestros($id_grupo) as $fila){
            if(empty($fila->id_grupo)){?>
            <input type="checkbox" name="<?php echo $fila->id?>"  value="<?php echo $fila->id?>"><?php echo $fila->nombre;?> <br>
            <?php }else{?>
             <input type="checkbox"  disabled="disabled"  checked> <?php echo $fila->nombre?> <br> 
            <?php }?>
            <?php }?>


        <input type="hidden" name="id_grupo" value= "<?php echo $id_grupo?>">

     <input type="submit" name="submitTH" value="ENVIAR">
           
           
            </form>
</body>
</html>