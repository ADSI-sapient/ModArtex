<section class="content-header">
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">General Elements</li>
      </ol>
</section>

<section class="content">
	<div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Mi Perfil</h3>
        </div>
        <form method="POST" action="<?= URL."ctrUsuario/modificarPerfil"; ?>">
          <div class="box-body">
            <input type="hidden" name="clave" value="<?= $_SESSION['user']['Clave']; ?>">
            <div class="row col-md-12" style="margin-left:0.5%">
            <div class="form-group col-md-4">
              <label for="nombre" class="">Nombre:</label>
              <input type="text" class="form-control" value="<?= $_SESSION['user']['Nombre']; ?>" id="nombreUsu" placeholder="" name="nombre" autofocus="" data-parsley-required="" maxlength="45">
            </div>
            <div class="form-group col-md-4">
              <label for="apellido" class="">Apellido:</label>
              <input type="text" class="form-control" value="<?= $_SESSION['user']['Apellido']; ?>" id="apellidoUsu" placeholder="" value="" name="apellido" data-parsley-required="" maxlength="45">
            </div>
            <div class="form-group col-md-4">
              <label for="tipo_documento" class="">Tipo de Documento:</label>
                <input disabled="" class="form-control" value="<?= $_SESSION['user']['Tipo_Documento']; ?>">
            </div>
          </div>
          <div class="row col-md-12" style="margin-left:0.5%">
            <div class="form-group col-md-4">
              <label for="documento" class="">Número de Documento:</label>
              <input type="text" name="num_documento" class="form-control" value="<?= $_SESSION['user']['Num_Documento']; ?>" readonly="">
            </div>
              <div class="form-group col-md-4">
                <label for="nombre_usuario" class="">Nombre de Usuario:</label>
                <input type="text" class="form-control" value="<?= $_SESSION['user']['Usuario']; ?>" id="Usuario" placeholder="" name="nombre_usuario" data-parsley-required="" maxlength="15">
              </div>
              <div class="form-group col-md-4">
              <label for="email" class="">E-mail:</label>
              <input type="email" class="form-control" value="<?= $_SESSION['user']['Email']; ?>" id="emailUsu" placeholder="" name="email" onchange="validarEmail(this.value);" data-parsley-required="" data-parsley-trigger="change" maxlength="45">
            </div>
          </div>
          <div class="row col-md-12" style="margin-left:0.5%">
            <div class="form-group col-md-4">
              <label for="email" class="">Rol:</label>
              <input type="text" class="form-control" value="<?= $_SESSION['user']['nombreR']; ?>" disabled="">
            </div>
            <div style="display: none;" class="form-group col-md-4 clavePerfil">
              <label for="email" class="">Clave actual:</label>
              <input type="text" class="form-control">
            </div>
            <div style="display: none;" class="form-group col-md-4 clavePerfil">
              <label for="email" class="">Clave nueva:</label>
              <input type="text" class="form-control">
            </div>
            <div style="display: none;" class="form-group col-md-4 clavePerfil">
              <label for="email" class="">Repetir clave nueva:</label>
              <input type="text" class="form-control" >
            </div>
            <div class="form-group col-md-4">
            <div class="col-md-12">
                <label></label>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" id="checkClavePerf"><span> Cambiar clave</span>
                  </label>
              </div>
              </div>
            </div>
          </div>
          </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Actualizar</button>
              </div>
        </form>
      </div>
    </div>
	</div>

<!-- 	<p><?= $_SESSION['user']['Nombre']; ?></p>
	<p><?= $_SESSION['user']['Apellido']; ?></p>
	<p><?= $_SESSION['user']['Usuario']; ?></p>
	<p><?= $_SESSION['user']['Clave']; ?></p>
	<p><?= $_SESSION['user']['Email']; ?></p>
	<p><?= $_SESSION['user']['Estado']; ?></p>
	<p><?= $_SESSION['user']['Tbl_Roles_Id_Rol']; ?></p>
	<p><?= $_SESSION['user']['nombreR']; ?></p> -->
</section>
