<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="<?php echo site_url('Asignacion/asignaralumno');?>" method="post">
<?php foreach(getAllAlumnos() as $fila){
            $alumno = getAlumnoEspecifico($fila->id_usuario); 
            if(empty(getGrupoAlumnoEspecifico($id_grupo,$fila->id_usuario))){?>
            <input type="checkbox" name="<?php echo $fila->id_usuario?>"  value="<?php echo $fila->id_usuario?>"><?php echo $alumno->nombre;?> <br>

            <?php }else{?>
             <input type="checkbox"  disabled="disabled"  checked> <?php echo $alumno->nombre?> <br> 
            <?php }?>
            <?php }?>


        <input type="hidden" name="id_grupo" value= "<?php echo $id_grupo?>">

     <input type="submit" name="submitAL" value="ENVIAR">
           
           
            </form>
</body>
</html>