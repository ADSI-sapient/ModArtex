  <!-- Content Wrapper. Contains page content -->
  <section class="content-header">
  <br>
    <ol class="breadcrumb">
      <li><a href="../../index.html"><i class="fa fa-dashboard"></i> Inicio</a></li>
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
        <br>
        <br>
        <div class="box-body">
        <form action="<?php echo URL; ?>ctrUsuario/regUsuario" method="POST">
          <div class="row col-lg-12">
            <div class="form-group col-lg-2">
              <label for="tipo_de_documento" class="">*Tipo de documento: </label>
              <select class="form-control" name="tipo_documento" required="">
                <option value="C.C" selected>C.C</option>
                <option value="C.E">C.E</option>
              </select>
            </div>
            <div class="form-group col-lg-offset-2 col-lg-2">
              <label for="documento" class="" >*Documento:</label>
              <input type="text" class="form-control" id="documento" placeholder="" name="documento" required="" onChange="validarSiDocumento(this.value);">
            </div>
            <div class="form-group col-lg-offset-3 col-lg-3">
              <label for="Estado" class="">*Estado:</label> 
              <input type="text" class="form-control" name="estado"  value="Habilitado" disabled="">
              <!-- <select class="form-control" name="estado" required="" disabled="">
                <option value="Habilitado" >Habilitado</option>
                <option value="Inhabilitado">Inhabilitado</option>
              </select> -->
            </div>
          </div>
          <div class="row col-lg-12">
            <div class="form-group col-lg-3">
              <label for="nombre" class="">*Nombre: </label>
              <input type="text" class="form-control" id="nombre" placeholder="" name="nombre" required="">
            </div>
            <div class="form-group col-lg-offset-1 col-lg-4">
              <label for="apellido" class="">*Apellido:</label>
              <input type="text" class="form-control" id="apellido" placeholder="" value="" name="apellido" required="">
            </div>
            <div class="form-group col-lg-offset-1 col-lg-3">
              <label for="nombre_usuario" class="">*Nombre de usuario:</label>
              <input type="text" class="form-control" id="nombre_usuario" placeholder="" name="nombre_usuario" required="">
            </div>
          </div>
          <div class="row col-lg-12">
            <div class="form-group col-lg-3">
              <label for="acontraseña" class="">*Contraseña:</label>
              <input type="password" class="form-control" id="contraseña" placeholder="" value="" name="clave" required="">
            </div>
            <div class="form-group col-lg-offset-1 col-lg-4">
              <label for="Email" class="">*Email:</label>
              <input type="text" class="form-control" id="email" placeholder="" name="email" required="" onChange="validarEmail(this.value);">
            </div>
            <input type="hidden" name="direccion">
            <input type="hidden" name="telefono">
    
            <div class="form-group col-lg-offset-1 col-lg-3">
              <label for="roles" class="">*Rol:</label>
              <select class="form-control" name="rol" required="" id="rol">
              <?php foreach ($rol as $value): ?>
                <option value="<?= $value['Id_Rol']?>"><?= $value['Nombre'] ?></option>
              <?php endforeach ?>
              </select>
            </div>
          </div> 
          <br>
          <div class="row"> 
            <div class="form-group col-lg-12">
              <button type="submit" class="btn btn-primary col-lg-offset-9" style="margin-top: 15px;"               name="btnRegistrar">Registrar</button>
              <button type="reset" class="btn btn-danger" style="margin-left: 15px; margin-top: 15px;">Cancelar</button>
            </div>
          </div>      
        </form>
        </div>
    </div>
  </section>
    