<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ModArtex</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= URL; ?>css/bootstrap.css">
  <link rel="stylesheet" href="<?= URL; ?>css/font-awesome-4.6.1/css/font-awesome.css">
  <link rel="stylesheet" href="<?= URL; ?>css/daterangepicker-bs3.css">
  <link rel="stylesheet" href="<?= URL; ?>css/datepicker3.css">
  <link rel="stylesheet" href="<?= URL; ?>css/datepicker.css">
  <!--   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="<?= URL; ?>css/colorpicker/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="<?= URL; ?>css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="<?= URL; ?>css/select2.min.css">
  <link rel="stylesheet" href="<?= URL; ?>css/jquery.dataTables.css">
  <link rel="stylesheet" href="<?= URL; ?>css/AdminLTE.css">
  <link rel="stylesheet" href="<?= URL; ?>css/sweetalert.css">
  <link rel="stylesheet" href="<?= URL; ?>css/skin-blue.min.css">
  <link rel="stylesheet" href="<?= URL; ?>css/_all-skins.min.css">
  <link rel="stylesheet" href="<?= URL; ?>css/lobibox.min.css">
  <link rel="stylesheet" href="<?= URL; ?>Parsley.js-2.4.4/src/parsley.css">
      <script src="<?= URL;?>js/jQuery-2.2.0.min.js"></script>
  <!--  <script src="<?= URL;?>css/jQuery-2.2.0.min.js"></script> -->
</head>


<body class="hold-transition skin-blue sidebar-mini">
 <div class="wrapper">
  <header class="main-header">
    <a href="<?php echo URL ?>home/index" class="logo">
      <span class="logo-mini"><b>M</b>A</span>
      <span style="text-align: left;" class="logo-lg"><i class="fa fa-scissors" aria-hidden="true"></i>&nbsp;&nbsp;
      <b> ModArtex</b></span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <style type="text/css">
            .circleColor {
              background: linear-gradient(yellow,red, blue);
              -webkit-background-clip: text;
              color: transparent;  
            }
          </style>
          <li>
            <a disabled="" href="#" data-toggle="modal" data-target="#myModalMedidas" class="dropdown-toggle" data-toggle="dropdown">
              <i style="font-size: 130%;" class="fa fa-balance-scale" aria-hidden="true"></i>
            </a>
          </li> 
          <li>
            <a class="dropdown-toggle">
            <button style="margin: 0; padding: 0;" data-toggle="modal" data-target="#modalCrudColores" class="dropdown-toggle btn btn-box-tool">
              <i style="font-size: 130%;" class="fa fa-circle circleColor" aria-hidden="true"></i>
            </button>
            </a>
          </li>         

          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i style="font-size: 130%;" class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>          
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"><?= $_SESSION['user']['nombreR']; ?></span>
              <i class="fa fa-angle-double-down" aria-hidden="true"></i>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
<!--                 <img src="<?php echo URL ?>img/avatar5.png" class="img-circle" alt="User Image"> -->
                <p>
                  <?= $_SESSION['user']['Nombre']; ?> <?= $_SESSION['user']['Apellido']; ?>
                  <small><?= $_SESSION['user']['nombreR']; ?></small>
                </p>
              </li>
              <li class="user-footer">
<!--                 <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div> -->
                <div class="pull-right">
                  <a href="<?= URL; ?>ctrLogin/cerrarSesion" class="btn btn-default btn-flat">Cerrar sesión</a>
                </div>
              </li>
            </ul>
          </li>
<!--           <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
<!-- 
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo URL; ?>img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $_SESSION['user']['Nombre']; ?><?= substr($_SESSION['user']['Apellido'], 0, 3); ?></p>
        </div>
      </div> -->
      <ul class="sidebar-menu">
<!--         <li style="text-align: center;" class="header">MÓDULOS</li> -->
<!--         <li class=""><a href="<?php echo URL ?>home/index"><i class="fa fa-dashboard"></i><span>Inicio</span></a></li> -->
        <?php $nom = ''; ?>
        <?php foreach ($_SESSION["permisos"] as $valor): ?>
         <?php if ($valor["NombreM"] != $nom): ?>
          <li class="treeview">
            <a href="#"><i class="<?= $valor['Icon']; ?>"></i><span><?= $valor["NombreM"]; ?></span>
              <i class="fa fa-angle-left pull-right"></i>
              <ul class="treeview-menu">
                <?php foreach ($_SESSION["permisos"] as $valor2) {
                  if ($valor2["NombreM"] == $valor["NombreM"]){
                    ?>
                    <li class=""><a href="<?= URL.$valor2['Url']; ?>"><i class="fa fa-circle-o"></i>
                      <?= $valor2["Nombre"]; ?></a></li>
                      <?php       
                    }
                  }?>
                </ul>
              </li>
              <?php $nom = $valor["NombreM"]; ?>
            <?php endif; ?>  
          <?php endforeach; ?>
        </ul>
      </section>
    </aside>
    <div class="content-wrapper" style="min-height: 916px;">