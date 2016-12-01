  <!-- Content Wrapper. Contains page content -->
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="<?php echo URL; ?>home/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="#">Usuario</a></li>
      <li class="active">Registrar usuario</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><strong>REGISTRAR USUARIO</strong></h3>
          </div>
        <form data-parsley-validate="" action="<?php echo URL; ?>ctrUsuario/regUsuario" method="POST" onsubmit="return enviarFormRegUsuario();">
        <div class="box-body">
        <div class="row col-lg-12" style="margin-left:0.5%">
            <div class="form-group col-lg-4">
              <label for="tipo_documento" class="">*Tipo de Documento:</label>
              <select class="form-control" name="tipo_documento" data-parsley-required="" id="tipo_documento">
                <option value="C.C" selected>C.C</option>
                <option value="C.E">C.E</option>
              </select>
            </div>
            <div class="form-group col-lg-4">
              <label for="documento" class="" >*Número de Documento:</label>
              <input type="text" class="form-control" id="documento" placeholder="" name="documento" data-parsley-required="" onChange="validarSiDocumento(this.value);" maxlength="20">
            </div>
                        <div class="form-group col-lg-4">
              <label for="estado" class="">Estado:</label> 
              <input type="text" class="form-control" name="estado" value="Habilitado" disabled="" id="estado">
              <!-- <select class="form-control" name="estado" required="" disabled="">
                <option value="Habilitado" >Habilitado</option>
                <option value="Inhabilitado">Inhabilitado</option>
              </select> -->
            </div>
            
          </div>
          <div class="row col-lg-12" style="margin-left:0.5%">
                        <div class="form-group col-lg-4">
              <label for="nombre" class="">*Nombre:</label>
              <input type="text" class="form-control" id="nombre" placeholder="" name="nombre" autofocus="" data-parsley-required="" maxlength="45">
            </div>
             <div class="form-group col-lg-4">
              <label for="apellido" class="">*Apellido:</label>
              <input type="text" class="form-control" id="apellido" placeholder="" value="" name="apellido" data-parsley-required="" maxlength="45">
            </div>

              <div class="form-group col-lg-4">
                <label for="nombre_usuario" class="">*Nombre de Usuario:</label>
                <input type="text" class="form-control" id="nombre_usuario" placeholder="" name="nombre_usuario" data-parsley-required="" maxlength="15">
              </div>
          </div>
          <div class="row col-lg-12" style="margin-left:0.5%">
            <div class="form-group col-lg-4">
              <label for="contraseña" class="">*Contraseña:</label>
              <input type="password" class="form-control" id="contraseña" placeholder="" value="" name="clave" data-parsley-required="" maxlength="10" minlength="6">
            </div>
            <div class="form-group col-lg-4">
              <label for="confirmContraseña" class="">*Confirmar Contraseña:</label>
              <input type="password" class="form-control" id="confirmContraseña" placeholder="" value="" name="confirmarClave" data-parsley-required="" maxlength="10" minlength="6">
            </div>
            <div class="form-group col-lg-4">
              <label for="email" class="">*E-mail:</label>
              <input type="email" class="form-control" id="email" placeholder="" name="email"  onChange="validarEmail(this.value);" data-parsley-required="" data-parsley-trigger="change" maxlength="45">
            </div>
            <input type="hidden" name="direccion">
            <input type="hidden" name="telefono">
          </div>
          <div class="row col-lg-12" style="margin-left: 0.5%">
            <div class="form-group col-lg-4">
              <label for="rol" class="">*Rol:</label>
              <select class="form-control" name="rol"  id="rol" data-parsley-required="">
              <?php foreach ($rol as $value): ?>
                <?php if ($value['Id_Rol'] != 1): ?>
                  <option value="<?= $value['Id_Rol']?>"><?= $value['Nombre'] ?></option>
                <?php endif ?>
              <?php endforeach ?>
              </select>
            </div>
          </div>
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-lg-offset-3 col-lg-3">
            <button style="margin-right: 1%;" type="submit" class="btn btn-success btn-md btn-block" name="btnRegistrar"><i class="fa fa-check-circle" aria-hidden="true"></i> <b>Registrar</b></button>
          </div>
          <div class="col-lg-3">
            <button style="margin-right: 1%;" type="reset" class="btn btn-default btn-md btn-block"><i class="fa fa-eraser" aria-hidden="true"></i> <b>Limpiar</b></button>
          </div>
        </div>
        <small><b>* Campo requerido</b></small>
      </div>
    </form>
  </div>
</section>
    