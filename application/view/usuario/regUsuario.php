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
            <h3 class="box-title" style="margin-top: 0.7%"><strong>REGISTRAR USUARIO</strong></h3>
            <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#ModAyudaUsuario" style="background: transparent; border: none;"><i class="fa fa-comment"></i></button>
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
              <input type="text" class="form-control" id="documento" placeholder="" name="documento" data-parsley-required="" onChange="validarSiDocumento(this.value);" maxlength="20" autofocus="">
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
              <input type="text" class="form-control" id="nombre" placeholder="" name="nombre" data-parsley-required="" maxlength="45">
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
              <input type="password" class="form-control" id="contraseña" placeholder="" value="" name="clave" data-parsley-required="" maxlength="12" minlength="6">
            </div>
            <div class="form-group col-lg-4">
              <label for="confirmContraseña" class="">*Confirmar Contraseña:</label>
              <input type="password" class="form-control" id="confirmContraseña" placeholder="" value="" name="confirmarClave" data-parsley-required="" maxlength="12" minlength="6">
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

<!-- Modal -->

<div class="modal fade" id="ModAyudaUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 10px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><strong>AYUDA USUARIO</strong></h4>
        </div>
        <div class="modal-body"> 
        <div class="modAyuda scrollAyuda">
          <h2 class="c1 c2" id="h.tyjcwt"><span>2.3 CREAR USUARIO</span></h2><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>El registro de un nuevo usuario solo es posible desde la cuenta del administrador o la cuenta que tenga este permiso. Desde el m&oacute;dulo de usuario, opci&oacute;n registrar usuario, se ingresan los datos necesarios y se asigna un rol dentro de la aplicaci&oacute;n. Ver </span><span class="c3">Figura 3. Registro de usuario.</span></p><p class="c0"><span class="c3"></span></p><p class="c6 c1 c2" id="h.3dy6vkm"><span class="c5 c4">Figura 3. Registro de usuario</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image77.png" style="width: 589.23px; height: 437.46px; margin-left: -0.00px; margin-top: -37.79px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.1t3h5sf"><span class="c4 c3">2.3.1 Validaci&oacute;n de campos de usuario</span><span>: Al momento de hacer clic en &ldquo;Registrar&rdquo; el sistema valida que los campos est&eacute;n completos y que no exista ese usuario, si hay una inconsistencia en eso, sale una mensaje indicando el error y el campo que se debe corregir para un registro exitoso. Ver </span><span class="c3">Figura 4. Validaci&oacute;n de campos de usuario.</span></p><p class="c0"><span class="c3"></span></p><p class="c6 c1 c2" id="h.4d34og8"><span class="c5 c4">Figura 4. Validaci&oacute;n de campos de usuario</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image80.png" style="width: 589.23px; height: 420.87px; margin-left: -0.00px; margin-top: -36.35px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span class="c3"></span></p><p class="c1"><span>En caso contrario, al dar clic en el bot&oacute;n &ldquo;Registrar&rdquo; el sistema muestra un mensaje de confirmaci&oacute;n del registro. Ver </span><span class="c3">Figura 5. Registro de usuario exitoso.</span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.2s8eyo1"><span class="c5 c4">Figura 5. Registro de usuario exitoso</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image79.png" style="width: 589.23px; height: 397.32px; margin-left: -0.00px; margin-top: -35.45px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><h2 class="c1 c2" id="h.17dp8vu"><span>2.4 LISTAR USUARIOS</span></h2><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>Los usuarios que han sido creados se pueden visualizar de manera general por medio de una tabla interactiva que permite filtrar por cualquier dato que se encuentre en la lista. Esta tabla permite consultar de manera individual cada usuario en las opciones de: editar o cambiar estado. Ver </span><span class="c3">Figura 6. Listar usuarios.</span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.3rdcrjn"><span class="c5 c4">Figura 6. Listar usuarios</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image83.png" style="width: 589.23px; height: 495.85px; margin-left: -0.00px; margin-top: -42.86px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.26in1rg"><span class="c4 c3">2.4.1 Editar usuario</span><span>: Para editar un usuario se hace &nbsp;clic en el bot&oacute;n editar, que aparece a la derecha de la tabla de listar usuarios, este nuevo formulario permite modificar los campos: nombre, apellido, nombre de usuario, email y seleccionar un nuevo rol. Ver &nbsp;</span><span class="c3">Figura 7. Editar usuario</span><span>.</span></p><p class="c0"><span></span></p><hr style="page-break-before:always;display:none;"><p class="c0 c18 c7"><span></span></p><p class="c6 c1 c2" id="h.lnxbz9"><span class="c5 c4">Figura 7. Editar usuario</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.29px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image81.png" style="width: 1128.11px; height: 599.36px; margin-left: -312.37px; margin-top: -78.74px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0 c9"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>Este formulario tambi&eacute;n contiene validaciones de campos. Ver </span><span class="c3">Figura 4. Validaci&oacute;n de campos de usuario.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.35nkun2"><span>&nbsp;</span><span class="c4 c3">2.4.2 Cambiar estado</span><span>: Desde el m&oacute;dulo de usuario, opci&oacute;n listar usuarios est&aacute; disponible la opci&oacute;n de cambiar estado, que permite habilitar o inhabilitar una cuenta, solo los usuarios habilitados podr&aacute;n ingresar al sistema. Ver </span><span class="c3">Figura 8. Cambiar estado de usuario.</span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.1ksv4uv"><span class="c5 c4">Figura 8. Cambiar estado de usuario</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image87.png" style="width: 589.23px; height: 396.47px; margin-left: -0.00px; margin-top: -35.29px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><hr style="page-break-before:always;display:none;"><p class="c0 c18 c7"><span></span></p>
        </div>            
        </div>
         <div class="modal-footer">
            <div class="row">
              <div class="col-md-12">
                <button data-dismiss="modal" type="reset" class="btn btn-default pull-right" style="margin-left: 2%; margin-top: 2%"><i class="fa fa-times-circle" aria-hidden="true"></i> <b>Cerrar</b></button>
              </div>
            </div>
         </div> 
        </div> 
      </div>
</div>