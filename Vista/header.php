<?php

require_once "Modelo/rol.php";
$objeto = new rol();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Inicio</title>
  
<!--   <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">
 -->
  <!-- Bootstrap core CSS -->
  <link href="Cliente/bootstrap/css/bootstrap.min.css?ds=688" rel="stylesheet">
  <!--external css-->
  <link href="Cliente/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="Cliente/css/style.css" rel="stylesheet">
  <link href="Cliente/css/style-responsive.css" rel="stylesheet">
  <link href="Cliente/css/sweetalert.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="Cliente/css/bootstrap-datepicker.min.css?ff=ff" />
  <script src="Cliente/lib/jquery/jquery.min.js"></script>
  <script src="Cliente/js/sweetalert.min.js"></script>
 <script src="Cliente/js/sweetalert.js"></script>
 <script type="text/javascript" src="Cliente/lib/bootstrap-datepicker.js?dsd=ds"></script>

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Mostrar / Esconder Menú"></div>
      </div>
      <!--logo start-->
      <a href="" class="logo"><b>CBC<span></span></b></a>
      <!--logo end-->
      
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a href="Controlador/usuario.php?chasi=cerrarsesion" class="logout" >Cerrar Sesión</a></li>
        </ul>
      </div>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <?php 
			  			$query = $objeto->CargarDetalleRolModulo($_SESSION["idrol"]);
			   			while ($reg = pg_fetch_object($query)) {
			  	?>
          <?php if($reg->id_modulo==1 &&  $reg->ind_checked=='NO' ){?>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-cogs"></i>
              <span>Configuraciòn</span>
              </a>
            <ul class="sub">
            <?php 
              $query_op = $objeto->CargarDetalleRolSubModulo($reg->id_modulo,$_SESSION["idrol"]);
              while ($reg1 = pg_fetch_object($query_op)) {
            ?>
              <?php  if($reg1->id_sub_modulo==1 &&  $reg1->ind_checked=='NO' ){?>
              <li><a href="Roles.php">Roles</a></li>
              <?php } ?>
              <?php  if($reg1->id_sub_modulo==2 &&  $reg1->ind_checked=='NO' ){?>
                <li><a href="Usuario.php">Usuarios</a></li>
              <?php } ?>
            <?php } ?>
              <li><a href="marca.php">Marca</a></li>
              <li><a href="vehiculo.php">Vehiculo</a></li>

            </ul>
          </li>
          <?php } ?>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-book"></i>
              <span>Gestiòn Herramientas</span>
              </a>
            <ul class="sub">
              <li><a href="herramienta.php">Herramientas</a></li>
            </ul>
          </li>
          <li class="mt">
            <a class="active" href="inicio.php">
              <i class="fa fa-dashboard"></i>
              <span>Reportes</span>
              </a>
          </li>
          <?php } ?>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
    <section id="main-content">