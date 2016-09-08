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
        <div class="box-body">
        <form data-parsley-validate="" action="<?php echo URL; ?>ctrUsuario/regUsuario" method="POST">
        <div class="row col-lg-12" style="margin-left:0.5%">
            <div class="form-group col-lg-3">
              <label for="nombre" class="">*Nombre: </label>
              <input type="text" class="form-control" id="nombre" placeholder="" name="nombre" autofocus="" data-parsley-required="">
            </div>
            <div class="form-group col-lg-offset-1 col-lg-4">
              <label for="apellido" class="">*Apellido:</label>
              <input type="text" class="form-control" id="apellido" placeholder="" value="" name="apellido" data-parsley-required="">
            </div>
            <div class="form-group col-lg-offset-1 col-lg-3">
              <label for="tipo_de_documento" class="">*Tipo de documento: </label>
              <select class="form-control" name="tipo_documento" data-parsley-required="">
                <option value="C.C" selected>C.C</option>
                <option value="C.E">C.E</option>
              </select>
            </div>
          </div>
          <div class="row col-lg-12" style="margin-left:0.5%">
            <div class="form-group col-lg-3">
              <label for="documento" class="" >*Documento:</label>
              <input type="text" class="form-control" id="documento" placeholder="" name="documento" data-parsley-required="" onChange="validarSiDocumento(this.value);">
            </div>
            <div class="form-group col-lg-offset-1 col-lg-4">
              <label for="Estado" class="">Estado:</label> 
              <input type="text" class="form-control" name="estado" value="Habilitado" disabled="">
              <!-- <select class="form-control" name="estado" required="" disabled="">
                <option value="Habilitado" >Habilitado</option>
                <option value="Inhabilitado">Inhabilitado</option>
              </select> -->
            </div>
              <div class="form-group col-lg-offset-1 col-lg-3">
                <label for="nombre_usuario" class="">*Nombre de usuario:</label>
                <input type="text" class="form-control" id="nombre_usuario" placeholder="" name="nombre_usuario" data-parsley-required="">
              </div>
          </div>
          <div class="row col-lg-12" style="margin-left:0.5%">
            <div class="form-group col-lg-3">
              <label for="acontraseña" class="">*Contraseña:</label>
              <input type="password" class="form-control" id="contraseña" placeholder="" value="" name="clave" data-parsley-required="">
            </div>
            <div class="form-group col-lg-offset-1 col-lg-4">
              <label for="Email" class="">*Email:</label>
              <input type="text" class="form-control" id="email" placeholder="" name="email"  onChange="validarEmail(this.value);" data-parsley-required="">
            </div>
            <input type="hidden" name="direccion">
            <input type="hidden" name="telefono">
            <div class="form-group col-lg-offset-1 col-lg-3">
              <label for="roles" class="">*Rol:</label>
              <select class="form-control" name="rol"  id="rol" data-parsley-required="">
              <?php foreach ($rol as $value): ?>
                <option value="<?= $value['Id_Rol']?>"><?= $value['Nombre'] ?></option>
              <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="row"> 
            <div class="form-group col-lg-12" style="margin-left:14px">
              <button type="submit" class="btn btn-primary col-lg-offset-9" name="btnRegistrar"><b>Registrar</b></button>
              <button type="reset" class="btn btn-danger">Limpiar</button>
            </div>
          </div>      
        </form>
        </div>
    </div>
  </section>
    