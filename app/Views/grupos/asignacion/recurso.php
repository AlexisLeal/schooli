<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <form action="<?php echo site_url('Asignacion/asignarrecurso');?>" method="post">
        <?php foreach(getRecursos() as $fila){ ?>
        
        <input type="checkbox" name="<?php echo $fila->id?>" value = "<?php echo $fila->id?>"> <?php echo $fila->nombre?> <br>

        <?php }?>
        <input type="hidden" name="id_grupo" value="<?php echo $id_grupo?>">
        <input type="submit" value="enviar" name="submitRC">
        </form>

        
</body>
</html>