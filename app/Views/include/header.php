<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.css'); ?>"  type="text/css">
    <!--FontAwesome-->
    <link rel="stylesheet" href="<?php echo base_url('css/font-awesome/css/font-awesome.css'); ?>"  type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('css/customer.css'); ?>"  type="text/css">
    <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('favicon/favicon-96x96.png'); ?>">
    <meta name="google" content="notranslate">


    <title>  <?php if (!empty($page_title)) echo $page_title;?> </title>
    <!--Forma dinamica de poner el titulo-->
    <?php $session = session();?>
    <!--Creamos llamamos ala la session-->
</head>
<body>



