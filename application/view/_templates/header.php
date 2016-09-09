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
 <div class="wrapper fixed">
  <header class="main-header">
    <a href="<?php echo URL ?>home/index" class="logo">
      <span class="logo-mini"><i class="fa fa-scissors" aria-hidden="true"></i></span>
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
            <a class="dropdown-toggle" style="padding: 9px;">
            <button onclick="listarMedidas()" style="margin: 0; padding: 0;" data-toggle="modal" data-target="#modalCrudMedidas" class="dropdown-toggle btn btn-box-tool">
              <i style="font-size: 130%;" class="fa fa-balance-scale" aria-hidden="true"></i>
            </button>  
            </a>
          </li> 
          <li>
            <a class="dropdown-toggle" style="padding: 9px;">
            <button onclick="listarColores()" style="margin: 0; padding: 0;" data-toggle="modal" data-target="#modalCrudColores" class="dropdown-toggle btn btn-box-tool">
              <i style="font-size: 130%;" class="fa fa-paint-brush circleColor" aria-hidden="true"></i>
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
            <a href="#"><i class="<?= $valor['Icon']; ?> fa-lg"></i><span>&nbsp;&nbsp;&nbsp;<?= $valor["NombreM"]; ?></span>
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





    
<div class="modal fade" id="modalCrudColores" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document";>
    <div class="modal-content" style="border-radius: 25px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h3 style="font-weight: bold; text-align: center;" class="modal-title">Colores</h3>
      </div>
      <div class="modal-body">
        <form data-parsley-validate="">
          <div style="margin-top: 10px;" class="row">
            <div class="form-group col-md-12">
            <div style="padding-left: 0px" class="col-md-5">  
              <div class="input-group my-colorpicker2 colorpicker-element">
              <input id="codigoColorCrud" type="text" name="codigo" class="form-control" readonly="" value="#0000ff">
                  <div class="input-group-addon">
                    <i type="input" id="colColCrudBox" style="background-color: blue;"></i>
                  </div>
              </div>
            </div>
            <div class="col-md-5">
                <input id="nomColorCrud" type="text" name="nombre" placeholder="Nombre del color" class="form-control" data-parsley-required=""> 
            </div> 
            <div class="col-md-2">
              <button onclick="regColor()" type="button" class="btn btn-primary">Registrar</button>
            </div> 
            </div>
          </div>
        </form>
        <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
              <table id="table-CrudColores" class="table table-bordered paginate-search-table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Muestra</th>
                    <th>Código</th>
                    <th>Color</th>
                    <th style="text-align: center;">Modificar</th>
                    <th>Eliminar</th>
                    <th>Guardar</th>  
                  </tr>
                </thead>
                <tbody id="tbody-CrudColores">
                </tbody>
              </table>
            </div>
            </div>
      </div>
    </div>
    <div>
      <div class="modal-footer" style="border-top:none; border-bottom:1px solid;">
      </div>
    </div>
  </div>
</div>
</div>




<div class="modal fade" id="modalCrudMedidas" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document";>
    <div class="modal-content" style="border-radius: 25px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h3 style="font-weight: bold; text-align: center;" class="modal-title">Unidades de medida</h3>
      </div>
      <div class="modal-body">
        <form data-parsley-validate="">
          <div style="margin-top: 10px;" class="row">
            <div class="form-group col-sm-12">
            <div style="padding-left: 0;" class="col-sm-4">  
              <input id="AbreMedidaCrud" type="text" class="form-control" placeholder="Abreviatura">
            </div>
            <div class="col-sm-6">
              <input id="nomMedidaCrud" type="text" placeholder="Nombre de la medida" class="form-control">
            </div> 
            <div class="col-sm-2">
              <button onclick="regMedida()" class="btn btn-primary">Registrar</button>
            </div> 
            </div>
          </div>
        </form>  
        <div class="row">
          <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-bordered paginate-search-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Abreviatura</th>
                  <th style="display: none;"></th>
                  <th style="text-align: center;">Modificar</th>
                  <th>Eliminar</th>
                  <th>Guardar</th>  
                </tr>
              </thead>
              <tbody id="tbody-CrudMedidas">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div>
      <div class="modal-footer" style="border-top:none; border-bottom:1px solid;">
      </div>
    </div>
  </div>
</div>
</div>
