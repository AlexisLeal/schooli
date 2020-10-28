<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.css'); ?>"  type="text/css">
    <!--FontAwesome-->
    <link rel="stylesheet" href="<?php echo base_url('css/font-awesome/css/font-awesome.css'); ?>"  type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('css/customer.css'); ?>"  type="text/css">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-96x96.png">
    <title>  <?php if (!empty($page_title)) echo $page_title;?> </title>
    <!--Forma dinamica de poner el titulo-->
    <?php $session = session();?>
    <!--Creamos llamamos ala la session-->
</head>
<body>



