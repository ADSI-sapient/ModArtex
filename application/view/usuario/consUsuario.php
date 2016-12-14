  
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="<?php echo URL ?>home/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="#">Usuario</a></li>
    <li class="active">Listar Usuarios</li>
  </ol>
</section>
<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border"  style="text-align: center;">
      <h3 class="box-title" style="margin-top: 0.7%;"><strong>LISTAR USUARIOS</strong></h3>
      <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#ModRegAyudaUsuario" style="background: transparent; border: none;"><i class="fa fa-comment"></i></button>
    </div>
    <div id="users">
      <form class="form-horizontal">
        <div class="col-md-12">
          <div class="box">
            <!-- /Tabla que treae los datos -->
            <div class="box-body no-padding">
             <div class="table-responsive"> 
              <table class="table table-hover cell-border" id="TablaUsuarios">
                <thead>
                  <tr class="">
                    <th style="display:none;"></th>
                    <th>Tipo de Documento</th>
                    <th>Número de Documento</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Estado</th>
                    <th>Nombre de Usuario</th>
                    <!--<th>Clave</th>-->
                    <th>Email</th>
                    <th>Rol</th>
                    <th style="display: none;"></th>
                    <th style="width: 7%">Editar</th>
                    <th class="col-lg">Cambiar Estado</th>
                  </tr>
                </thead>
                <tbody class="list">
                  <?php foreach ($usuarios as $usuario): ?>
                    <tr >
                      <td style="display:none;"><?= $usuario["Id_Usuario"] ?></td>
                      <td class="tipo_documento"><?= $usuario["Tipo_Documento"] ?></td>
                      <td class="documento"><?= $usuario["Num_Documento"] ?></td>
                      <td class="nombre"><?= $usuario["Nombre"] ?></td>
                      <td class="apellido"><?= $usuario["Apellido"] ?></td>
                      <td class="estado"><?= $usuario["Estado"]==1?"Habilitado":"Inhabilitado" ?></td>
                      <td class="nombre_usuario"><?= $usuario["Usuario"] ?></td>
                      <!-- <td class="clave"><?= $usuario["Clave" ] ?></td> -->
                      <td class="email"><?= $usuario["Email"] ?></td>
                      <td class="rol" ><?= $usuario["rol"] ?></td>
                      <td style="display: none;"><?= $usuario["idRol"] ?></td>
<!--                       <td class="r" style="display: none;"><?= $usuario["Id"] ?></td> -->
                      <td>
                      <?php if ($usuario["idRol"] == 1): ?>
                        <button type="button" class="btn btn-box-tool" disabled=""><i style="font-size: 150%;" class="fa fa-pencil-square-o"></i></button>
                      <?php else: ?>
                        <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#myModal3" onclick="editarUsuarios('<?= $usuario["Num_Documento"] ?>', this)"><i style="font-size: 150%;" class="fa fa-pencil-square-o"></i></button>
                        <?php endif ?>
                       </td>
                       <td>
                       <?php if ($usuario["idRol"] == 1): ?>

                          <?php if ($usuario["Estado"] == 1): ?>
                          <button type="button" class="btn btn-box-tool" disabled><i style="font-size: 150%; color: green;" class="fa fa-repeat"></i></button>
                          <?php else: ?>
                          <button type="button" class="btn btn-box-tool" disabled><i style="font-size: 150%; color: green;" class="fa fa-repeat"></i></button>
                          <?php endif ?>


                       <?php else: ?>

                         <?php if ($usuario["Estado"] == 1): ?>
                          <button type="button" class="btn btn-box-tool" onclick="cambiarEstado(<?= $usuario['Num_Documento'] ?>, 0)"><i style="font-size: 150%;" class="fa fa-repeat"></i></button>
                          <?php else: ?>
                            <button type="button" class="btn btn-box-tool" onclick="cambiarEstado(<?= $usuario['Num_Documento'] ?>, 1)"><i style="font-size: 150%;" class="fa fa-repeat"></i></button>
                          <?php endif ?>

                          <?php endif ?>
                       </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--Termina la tabla-->
        <div class="box-footer">
        </div>
      </form>

      <!-- inicia el Modal que permite modificar-->  
      <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius:10px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">MODIFICAR USUARIO</h4>
            </div>
            <form role="form" id="frmModUsuario" action="<?= URL ?>ctrUsuario/edit" method="post" data-parsley-validate="" onsubmit="return validarDatosMod()">
            <input type="hidden" id="nomUsuIni">
            <input type="hidden" id="emailUsuIni">
            <div class="modal-body">
                <div class="row" style="margin-left:0.5%">
                  <div class="form-group col-sm-6">
                    <label for="tipo_Documento" class="">Tipo de Documento:</label>
                   <input type="text" name="Tipo_Documento" id="tipo_documento" readonly="" class="form-control">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="documento" class="">Documento:</label>
                    <input type="text" class="form-control" id="documento" placeholder="" name="documento" readonly="">
                  </div>
                </div>
                <div class="row" style="margin-left:0.5%">
                  <div class="form-group col-sm-6">
                    <label for="nombre" class="">*Nombre:</label>
                    <input type="text" class="form-control" id="nombre" placeholder="" name="nombre" data-parsley-required="" maxlength="45">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="apellido" class="">*Apellido:</label>
                    <input type="text" class="form-control" id="apellido" placeholder="" name="apellido" data-parsley-required="" maxlength="45">
                  </div>
                </div>
                <div class="row" style="margin-left:0.5%">
                  <div class="form-group col-sm-6">
                    <label for="nombre_Usuario" class="">*Nombre de Usuario:</label>
                    <input  type="text" class="form-control" id="nombre_usuario" placeholder="" name="nombre_usuario" data-parsley-required="" maxlength="15">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="rol" class="">*Rol:</label>
                    <select class="form-control" name="rol" id="rol" data-parsley-required="">
                      <?php foreach ($rol as $value): ?>
                        <?php if ($value['Id_Rol'] != 1): ?>
                          <option value="<?= $value['Id_Rol']?>"><?= $value['Nombre']?></option>
                        <?php endif ?>
                      <?php endforeach ?> 
                    </select>
                  </div>
                </div>
                <div class="row" style="margin-left:0.5%">
                  <div class="form-group col-sm-6">
                    <label for="email" class="">*Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="" name="email" data-parsley-required="" maxlength="45">
                  </div>
                </div>
            </div>
            <input type="hidden" id="codigo" name="codigo"></input>
                <div class="modal-footer">
                  <div class="row">
                    <div class="col-lg-offset-3 col-lg-3">
                      <button type="submit" class="btn btn-warning btn-md btn-block" name="btonModificar"><i class="fa fa-refresh" aria-hidden="true"></i>  <b>Actualizar</b></button>
                    </div>
                    <div class="col-lg-3">
                      <button type="button" class="btn btn-default btn-md btn-block" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> <b>Cerrar</b></button>
                    </div>
                  </div>
                </div>
              </form>
          </div>
        </div>
      </div>
</section>



<div class="modal fade" id="ModRegAyudaUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
