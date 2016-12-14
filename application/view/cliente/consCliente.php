  <!-- Content Header (Page header) -->
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="<?php echo URL ?>home/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="#">Cliente</a></li>
      <li class="active">Listar Cliente</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
     <div class="box box-primary">
      <div class="box-header with-border"  style="text-align: center;">
        <h3 class="box-title" style="margin-top: 0.7%;"><strong>LISTAR CLIENTES</strong></h3>
        <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#ModAyudaCliente" style="background: transparent; border: none;"><i class="fa fa-comment"></i></button>
      </div>
      <div id="users">
        <form class="form-horizontal">
          <div class="col-md-12">
            <div class="table table-responsive">
              <table class="table table-hover cell-border" id="TablaClientes">
                <thead>
                    <tr class="">
                      <th class="col-lg">Tipo de Documento</th>
                      <th>Número de Documento</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Teléfono</th>
                      <th>Dirección</th>
                      <th>Email</th>
                      <th>Estado</th>
                      <th style="width: 7%">Editar</th>
                      <th class="col-lg">Cambiar Estado</th>
                      <th style="display: none;"></th>
                    </tr>
                  </thead>
                  <tbody class="">
                  <?php foreach ($clientes as $cliente): ?>
                  <tr>
                    <td class="Tipo_Documento"><?= $cliente["Tipo_Documento"] ?></td>
                    <td class="Num_Documento"><?= $cliente["Num_Documento"] ?></td>
                    <td class="Nombre"><?= $cliente["Nombre"] ?></td>
                    <td class="Apellido"><?= $cliente["Apellido"] ?></td>
                    <td class="Telefono"><?= $cliente["Telefono"] ?></td>
                    <td class="Direccion"><?= $cliente["Direccion"] ?></td>
                    <td class="Email"><?= $cliente["Email"] ?></td>
                    <td class="estado"><?= $cliente["Estado"]==1?"Habilitado":"Inhabilitado" ?></td>
                      <td>
                          
                      <?php if ($cliente["Num_Documento"] == "1017223026"): ?>
                        <button type="button" class="btn btn-box-tool" disabled=""><i class="fa fa-pencil-square-o" style="font-size: 150%;"></i></button>
                      <?php else: ?>
                        <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#myModalC" onclick="editarClientes('<?= $cliente["Num_Documento"] ?>', this)"><i class="fa fa-pencil-square-o" style="font-size: 150%;"></i></button>
                      <?php endif ?>


                      </td>
                      <td style="text-align: center">
                        <?php if ($cliente["Num_Documento"] == "1017223026"): ?>
                          <?php if ($cliente["Estado"] == 1){ ?>
                            <button type="button" class="btn btn-box-tool" disabled=""><i style="font-size: 150%; color: green;" class="fa fa-repeat"></i></button>
                            <?php }else{ ?>
                            <button type="button" class="btn btn-box-tool" disabled=""><i class="fa fa-repeat" style="font-size: 150%; color: green;"></i></button>
                          <?php } ?>
                          <?php else: ?>
                            <?php if ($cliente["Estado"] == 1){ ?>
                            <button type="button" class="btn btn-box-tool" onclick="cambiarEstadoC(<?= $cliente['Num_Documento'] ?>, 0)"><i style="font-size: 150%; color: green;" class="fa fa-repeat"></i></button>
                            <?php }else{ ?>
                            <button type="button" class="btn btn-box-tool" onclick="cambiarEstadoC(<?= $cliente['Num_Documento'] ?>, 1)"><i class="fa fa-repeat" style="font-size: 150%; color: green;"></i></button>
                          <?php } ?>
                        <?php endif ?>
                        </td>
                    <td style="display: none;" class=""><?= $cliente["Info_Adicional"] ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </form>
        </div>
        <div class="box-footer">
        </div>
      </div>
     </section>   



       <div class="modal fade" id="myModalC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius:10px">
              <form role="form" id="myModalC" action="<?= URL ?>ctrCliente/edit" method="post" data-parsley-validate="">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>MODIFICAR CLIENTE</b></h4>
            </div>
            
            <div class="modal-body">
                  <div class="row" style="margin-left:0.5%">
                    <div class="form-group col-sm-6">
                      <label for="tipo_Documento" class="">Tipo de Documento:</label>
                      <input type="text" id="Tipo_Documento" readonly="" class="form-control">
                    </div>
                    <div class="form-group col-sm-6">
                      <label for="documento" class="">Número de Documento:</label>
                      <input type="text"  class="form-control" id="Num_Documento" name="Num_Documento" readonly="">
                    </div>
                  </div>
                  <div class="row" style="margin-left:0.5%">
                    <div class="form-group col-sm-6">
                      <label for="nombre" class="">*Nombre:</label>
                      <input type="text" class="form-control" id="Nombre" placeholder="" name="Nombre" data-parsley-required="" maxlength="45">
                    </div>
                    <div class="form-group col-sm-6">
                      <label for="apellido" class="">*Apellido</label>
                      <input type="text" class="form-control" id="Apellido" placeholder="" name="Apellido" data-parsley-required="" maxlength="45">
                    </div>
                  </div>
                  <div class="row" style="margin-left:0.5%">
                    <div class="form-group  col-sm-6">
                      <label for="telefono">Teléfono:</label>
                      <input type="text" class="form-control" id="Telefono" name="Telefono" onChange="validarTelefono(this.value);" maxlength="25">
                    </div>
                   <div class="form-group col-sm-6">
                   <label for="direccion ">Dirección:</label>
                      <input type="text" class="form-control" id="Direccion" name="Direccion" maxlength="45">
                   </div>
                 </div>
                 <div class="row" style="margin-left:0.5%">
                  <div class="form-group col-sm-6">
                    <label for="email" class="">Email:</label>
                    <input type="email" class="form-control" id="Email" placeholder="" name="Email" onChange="validarEmail(this.value);" maxlength="45">
                  </div>

                  <div class="form-group col-sm-6">
                    <label for="infoAdicionalMod" class="">Información Adicional:</label>
                    <textarea class="form-control" name="infoAdicionalMod" id="infoAdicionalMod" maxlength="250"></textarea>
                    <!-- <input type="text" class="form-control" id="Email" placeholder="" name="Email" onChange="validarEmail(this.value);" data-parsley-required="" maxlength="45"> -->
                  </div>
                </div>
            </div>
            <div class="modal-footer">
            <div class="row">
              <div class="col-lg-offset-3 col-lg-3">
                <button type="submit" class="btn btn-warning btn-md btn-block" name="btnModificar"><i class="fa fa-refresh" aria-hidden="true"></i> <b>Actualizar</b></button>
              </div>
              <div class="col-lg-3">
                <button type="button" class="btn btn-default btn-md btn-block" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> <b>Cerrar</b></button>
              </div>
              </div>
              <small class="pull-left"><b>*Campo requerido</b></small>
            </div>      
          </form>
          </div>
        </div>
      </div>

<div class="modal fade" id="ModAyudaCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 10px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><strong>AYUDA USUARIO</strong></h4>
        </div>
        <div class="modal-body"> 
        <div class="modAyuda scrollAyuda">
          <ol class="c17 lst-kix_list_11-0" start="5"><li class="c1 c16 c2"><h1 id="h.184mhaj" style="display:inline"><span>M&Oacute;DULO DE CLIENTE</span></h1></li></ol><p class="c0"><span></span></p><p class="c0"><span class="c3"></span></p><p class="c1"><span>El m&oacute;dulo de cliente permite gestionar la informaci&oacute;n de los clientes de la empresa, a este m&oacute;dulo solo tendr&aacute; acceso el rol administrador u otro rol que tenga este permiso asignado.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><h2 class="c1 c2" id="h.3s49zyc"><span>6.1 REGISTRAR CLIENTE</span></h2><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>Para registrar un cliente se da clic en el m&oacute;dulo de Cliente, opci&oacute;n Registrar Cliente, donde aparece un formulario, se deben diligenciar todos los campos que contengan un asterisco (*). Ver </span><span class="c3">Figura 53. Registrar cliente.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.279ka65"><span class="c5 c4">Figura 53. Registrar cliente</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image35.png" style="width: 589.23px; height: 430.82px; margin-left: -0.00px; margin-top: -37.31px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><h2 class="c0 c2"><span></span></h2><p class="c0 c9"><span></span></p><p class="c1" id="h.meukdy"><span class="c4 c3">6.1.1 Validaci&oacute;n de campos</span><span>: Al momento de dar clic en el bot&oacute;n &ldquo;Registrar&rdquo;, el sistema valida que los campos est&eacute;n completos, en caso de haber una inconsistencia el sistema informa del error y detiene el registro. Ver </span><span class="c3">Figura 54. Validaci&oacute;n de campos de cliente.</span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.36ei31r"><span class="c5 c4">Figura 54. Validaci&oacute;n de campos de cliente.</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image36.png" style="width: 589.23px; height: 410.06px; margin-left: -0.00px; margin-top: -35.51px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c1"><span>En caso contrario el sistema muestra un mensaje de registro exitoso. Ver </span><span class="c3">Figura 55. Registro de cliente exitoso.</span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.1ljsd9k"><span class="c5 c4">Figura 55. Registro de cliente exitoso</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image37.png" style="width: 589.23px; height: 395.74px; margin-left: -0.00px; margin-top: -31.64px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><h2 class="c1 c2" id="h.45jfvxd"><span>6.2 LISTAR CLIENTES</span></h2><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>En la opci&oacute;n listar clientes del m&oacute;dulo de clientes, se puede visualizar por medio de una tabla interactiva, los clientes que se encuentran registrados en el sistema, all&iacute; se pueden filtrar las personas, por medio de cualquier dato, tambi&eacute;n se puede visualizar espec&iacute;ficamente un cliente en la opci&oacute;n: editar y cambiar estado. Ver </span><span class="c3">Figura 56. Listar </span><span class="c8 c3">clientes</span><span class="c3">.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c11 c1 c7 c2" id="h.2koq656"><span class="c5 c4">Figura 56. Listar clientes</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.07px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image38.png" style="width: 589.07px; height: 400.29px; margin-left: -0.00px; margin-top: -35.62px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.zu0gcz"><span class="c4 c3">6.2.1 Editar</span><span>: Al dar clic en la opci&oacute;n editar, se pueden modificar los campos: Nombre, Apellido, Tel&eacute;fono, Direcci&oacute;n y Email. Ver </span><span class="c3">Figura 57. Editar cliente.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c11 c1 c7 c2" id="h.3jtnz0s"><span class="c5 c4">Figura 57. Editar cliente</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image39.png" style="width: 1032.96px; height: 507.84px; margin-left: -265.06px; margin-top: -67.68px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0 c9"><span></span></p><p class="c1"><span>Este formulario tambi&eacute;n contiene validaciones. Ver </span><span class="c3">Figura 54. Validaciones de campos de </span><span class="c8 c3">cliente.</span></p><p class="c1"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p><p class="c0"><span></span></p><p class="c1" id="h.1yyy98l"><span class="c3 c4">6.2.2 Cambiar Estado</span><span>: En la opci&oacute;n: cambiar estado, se puede modificar el estado de un cliente, solos los clientes habilitados se podr&aacute;n asociar a un pedido. Ver </span><span class="c3">Figura 58. Cambiar estado de cliente.</span></p><p class="c0"><span class="c3"></span></p><p class="c6 c1 c2" id="h.4iylrwe"><span class="c5 c4">Figura 58. Cambiar estado de cliente</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image40.png" style="width: 589.23px; height: 401.99px; margin-left: -0.00px; margin-top: -37.49px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><hr style="page-break-before:always;display:none;"><p class="c0 c18 c7"><span></span></p>
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