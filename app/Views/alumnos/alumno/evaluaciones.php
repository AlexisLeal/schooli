<?php include(APPPATH.'/Views/include/header.php');?>



<?php if($id_grupo != null){ ?>
    <!--Esta funcion esta -->
<?php foreach(getGruposEvaluacion($id_grupo) as $fila){ ?>
        <input type="text"> <?php echo $fila->nombre?> <br>
<?php } ?>
<?php }else{ ?>
    <h1>NO ESTAS ASIGNADO A UN GPO</h1>
<?php } ?>

<?php include(APPPATH.'Views/include/footer.php');?>

