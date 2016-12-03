<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="<?php echo URL; ?>home/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="#">Usuario</a></li>
    <li class="active">Mi Perfil</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><b>MI PERFIL</b></h3>
        </div>
        <form id="frmEditPerfil" data-parsley-validate="" method="POST" action="<?= URL."ctrUsuario/modificarPerfil"; ?>">
          <div class="box-body">

            <input type="hidden" id="claveEdit" name="clave" value="<?= $_SESSION['user']['Clave']; ?>">
            <div class="row col-md-12" style="margin-left:0.5%">
            <div class="form-group col-md-4">
              <label for="tipo_documento" class="">Tipo de Documento:</label>
                <input disabled="" class="form-control" value="<?= $_SESSION['user']['Tipo_Documento']; ?>">
            </div>
            <div class="form-group col-md-4">
              <label for="documento" class="">Número de Documento:</label>
              <input type="text" name="num_documento" class="form-control" value="<?= $_SESSION['user']['Num_Documento']; ?>" readonly="">
            </div>
            <div class="form-group col-md-4">
              <label for="email" class="">Rol:</label>
              <input type="text" class="form-control" value="<?= $_SESSION['user']['nombreR']; ?>" disabled="">
            </div>
          </div>
          <div class="row col-md-12" style="margin-left:0.5%">
              <div class="form-group col-md-4">
              <label for="nombre" class="">*Nombre:</label>
              <input type="text" class="form-control" value="<?= $_SESSION['user']['Nombre']; ?>" id="nombreUsu" placeholder="" name="nombre" autofocus="" data-parsley-required="" maxlength="45">
            </div>
            <div class="form-group col-md-4">
              <label for="apellido" class="">*Apellido:</label>
              <input type="text" class="form-control" value="<?= $_SESSION['user']['Apellido']; ?>" id="apellidoUsu" placeholder="" value="" name="apellido" data-parsley-required="" maxlength="45">
            </div>
              <div class="form-group col-md-4">
                <label for="nombre_usuario" class="">*Nombre de Usuario:</label>
                <input type="text" class="form-control" value="<?= $_SESSION['user']['Usuario']; ?>" id="Usuario" placeholder="" name="nombre_usuario" data-parsley-required="" maxlength="15">
              </div>
          </div>
          <div class="row col-md-12" style="margin-left:0.5%">
             <div class="form-group col-md-4">
              <label for="email" class="">*E-mail:</label>
              <input type="email" class="form-control" value="<?= $_SESSION['user']['Email']; ?>" id="emailUsu" placeholder="" name="email" onchange="validarEmail(this.value);" data-parsley-required="" data-parsley-trigger="change" maxlength="45">
            </div>
            <div style="display: none;" class="form-group col-md-4 clavePerfil">
              <label class="">*Contraseña Actual:</label>
              <input id="perClaveAct" type="password" class="form-control" maxlength="10" minlength="6">
            </div>
            <div style="display: none;" class="form-group col-md-4 clavePerfil">
              <label class="">*Contraseña Nueva:</label>
              <input id="perClaveNue" type="password" class="form-control" maxlength="10" minlength="6">
            </div>
          </div>
            <div class="row col-md-12" style="margin-left:0.5%">
            <div style="display: none;" class="form-group col-md-4 clavePerfil">
              <label class="">*Confirmar Nueva Contraseña:</label>
              <input id="perRepClaveNue" type="password" class="form-control" maxlength="10" minlength="6">
            </div>
            <div class="form-group col-md-4">
            <div class="col-md-12" style="padding-left:0;">
                <label></label>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" id="checkClavePerf" style="height:15px; width:15px; cursor: pointer;"><span> <b>Cambiar Clave</b></span>
                  </label>
              </div>
              </div>
            </div>
          </div>
          </div>
            <div class="box-footer">
            <div class="row">
              <div class="col-lg-offset-4 col-lg-3">
                <button type="button" class="btn btn-warning btn-md btn-block" onclick="validEdiperfil('<?= $_SESSION['user']['Clave']; ?>');"><i class="fa fa-refresh" aria-hidden="true"></i> <b>Actualizar</b></button>
              </div>
            </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

<!--  <p><?= $_SESSION['user']['Nombre']; ?></p>
  <p><?= $_SESSION['user']['Apellido']; ?></p>
  <p><?= $_SESSION['user']['Usuario']; ?></p>
  <p><?= $_SESSION['user']['Clave']; ?></p>
  <p><?= $_SESSION['user']['Email']; ?></p>
  <p><?= $_SESSION['user']['Estado']; ?></p>
  <p><?= $_SESSION['user']['Tbl_Roles_Id_Rol']; ?></p>
  <p><?= $_SESSION['user']['nombreR']; ?></p> -->
</section>