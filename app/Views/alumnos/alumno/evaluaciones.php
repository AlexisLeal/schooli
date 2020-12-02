<?php include(APPPATH.'/Views/include/header.php');?>



<?php if($id_grupo != null){ ?>
    <!--Esta funcion esta asignacion helper
        hay que ponerle que sea un tipo botton -->
<?php foreach(getGruposEvaluacion($id_grupo) as $fila){ ?>
            <a href="<?php echo site_url("Alumno/presentarevaluacion/$fila->id")?>"><?php echo $fila->nombre?></a>
<?php } ?>
<?php }else{ ?>
    <h1>NO ESTAS ASIGNADO A UN GPO</h1>
<?php } ?>

<?php include(APPPATH.'Views/include/footer.php');?>

