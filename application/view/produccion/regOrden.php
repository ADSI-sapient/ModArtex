<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="<?php echo URL; ?>home/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="#">Producción</a></li>
    <li class="active">Registrar Orden</li>
  </ol>
</section>
<section class="content">
 <div>
  <div  class="box box-info">
    <div class="box-header with-border">
      <h1 class="box-title" style="margin-top: 0.7%"><strong>REGISTRAR ORDEN DE PRODUCCIÓN</strong></h1>
      <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#ModAyudaProduccion" style="background: transparent; border: none;"><i class="fa fa-comment"></i></button>
    </div>
    <!-- <div style="padding-left: 8%;"> -->
    <form data-parsley-validate="" style="padding-top:10px;" action="<?php echo URL; ?>ctrProduccion/regOrden" method="POST">
    <div class="box-body">
    <input type="hidden" name="id_solTud" id="id_solicitud">

    <div class="row">
      <div class="col-lg-12">
        <div class="form-group col-lg-6">
          <div class="col-lg-12">
          <label class="">Fecha Registro:</label>
          <div class="">
            <div class="input-group date">
              <div class="input-group-addon" style="border-radius:5px;">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" name="fecha_registro" id="fecha_registro" value="<?php echo date("Y-m-d");?>" readonly=""  style="border-radius:5px;">
            </div>
          </div>
          </div>
        </div>

        <div class="form-group col-lg-6">
        <div class="col-lg-12">
          <label class="">*Fecha de Terminación:</label>
          <div class="">
            <div class="input-group">
              <div class="input-group-addon" style="border-radius:5px;">
                <i class="fa fa-calendar"></i>
              </div>
              <input readonly="" type="text" class="form-control pull-right" name="fecha_terminacion" id="fecha_terminacion" style="border-radius:5px;" data-parsley-required="" data-parsley-errors-container="#ErrorFechaT">
            </div>
          </div>
          <div id="ErrorFechaT"></div>
        </div>
        </div>
      </div>
      </div>

      <div class="row">
      <div class="col-lg-12">
        <div class="form-group col-lg-6">
          <div class="col-lg-12">
          <label for="estadoProdu" class="">*Estado:</label>
          <input type="text" name="estadoProdu" class="form-control" id="estadoProdu" value="Pendiente" readonly="" style="border-radius:5px;">
          </div>
        </div>
        
        <div class="col-lg-6">
        <div class="form-group col-lg-8">
          <label for="lugarPrd" class="">*Lugar:</label>
          <select id="selectLugarProducc" disabled="" onchange="selectLugarProduccion(this)" class="form-control" name="lugarPrd" data-parsley-required="">
            <option value="Fábrica">Fábrica</option>
            <option value="Satélite">Satélite</option>
            <option value="Fábrica-Satélite">Fábrica-Satélite</option>
          </select>
        </div>
        <div class="form-group col-lg-4">
        <div style="">
          <button type="button" style="margin-top:25px; padding:6px 12px !important;" id="asociarPedi" class="btn btn-primary btn-md" data-toggle="modal" data-target="#asociarPedid"><b>Asociar Pedido</b></button>
        </div>
        </div>
        </div>
      </div>
      </div>

          <div class="row">
          <div class="col-md-12" id="agregarFichaProd">
          <div class="col-md-12">
          <div class="col-md-12">
          <div class="table scrolltablas" style="margin-top: 2%;">
            <div class="col-lg-12 table-responsive" style="padding: 0;">
                <table class="table table-bordered" id="tblFichasProd">
                  <thead>
                    <tr class="active">
                      <th style="display: none;"></th>
                      <th>#</th>
                      <th>Referencia</th>
                      <th>Nombre</th>
                      <th>Color</th>
                      <th>Talla</th>
                      <th>Cantidad a Producir</th>
                      <th>Valor Producto</th>
                      <th>Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
            </div>
            </div>
            </div>  
          </div>
  </div>
  <div class="box-footer">
    <div class="row col-lg-12" >
      <div class="row">
        <div class="col-lg-offset-3 col-lg-3">
          <button onclick="regOrdenProducc()" type="button" class="btn btn-success btn-md btn-block" name="btnRegistrarProdu"><i class="fa fa-check-circle" aria-hidden="true"></i> <b>Registrar</b></button>
        </div>
        <div class="col-lg-3">
          <button onclick="limpiarFormRegOrdPro()" style="margin-left: 2%;" type="reset"  class="btn btn-default btn-md btn-block"><i class="fa fa-eraser" aria-hidden="true"></i> <b>Limpiar</b></button>          
        </div>
      </div>
    </div>
  </div>
</form>
</div>
</section>
<!-- Inicio Modal asociar pedidos -->
      <div class="modal fade" id="asociarPedid" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>PEDIDOS PENDIENTES</b></h4>
            </div>
            <div class="modal-body">
              <div class="table">
                <div class="col-sm-12 table-responsive">
                  <table class="table table-responsive table-hover table-bordered" style="margin-top: 2%;" id="TablOrdenesPedidos">
                    <thead>
                      <tr class="info">
                        <th style="width: 10px">#</th>
                        <th>Fecha Registro</th>
                        <th>Fecha Entrega</th>
                        <th>Valor Total</th>
                        <th>Estado</th>
                        <th>Cliente</th>
                        <th style="width: 7%">Detalle</th>
                        <th style="width: 7%">Agregar</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($pedidosProdu as $pedido): ?>
                      <tr>
                        <td><?= $pedido["Id_Solicitud"] ?></td>
                        <td class="freg"><?= $pedido["Fecha_Registro"] ?></td>
                        <td class="ftga"><?= $pedido["Fecha_Entrega"] ?></td>
                        <td class="vtal">$<?=$pedido["Valor_Total"] ?></td>
                        <td><?= $pedido["Nombre_Estado"] ?></td>
                        <td class="nomclte"><?= $pedido["Nombre"] ?></td>
                        <td>
                          <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#dllPedidosProd" id="" onclick="cargarProductosAsoPed('<?= $pedido["Id_Solicitud"] ?>', null, 0)"><i class="fa fa-eye fa-lg" style="color:#3B73FF; font-size:150%;"></i></button>
                        </td>
                        <td>
                          <button id="btn<?= $i; ?>" type="button" class="btn btn-box-tool" onclick="cargarProductosAsoPed('<?= $pedido["Id_Solicitud"] ?>', '<?= $pedido["Fecha_Entrega"] ?>', 2)"><i class="fa fa-plus" style="font-size:150%; color: blue;"></i></button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    <?php $i++; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer" style="border-top:0px;">
              <button type="button" class="btn btn-default btn-lg" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      <!-- Fin modal asociar pedidos -->
            <div class="modal fade" id="dllPedidosProd" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>PRODUCTOS ASOCIADOS</b></h4>
            </div>
            <div class="modal-body" style="padding:10px;">
              <div class="table">
                <div class="form-group col-sm-12 table-responsive scrolltablas">
                  <table class="table table-hover table-responsive" style="margin-top: 2%;" id="dtlle-pedido-prod">
                    <thead>
                      <tr class="active">
                        <th>Referencia</th>
                        <th>Nombre</th>
                        <th>Color</th>
                        <th>Talla</th>
                        <th>Cantidad a Producir</th>
                        <th>Usar Producto Terminado</th>
                        <th>Valor Producto</th>
                        <th>Subtotal</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer" style="border-top:none; border-bottom:1px solid;">
              <button type="button" class="btn btn-default btn-lg" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- fin modal productos asociados pedido-->

<div class="modal fade" id="ModAyudaProduccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 10px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><strong>AYUDA USUARIO</strong></h4>
        </div>
        <div class="modal-body"> 
        <div class="modAyuda scrollAyuda">
            <ol class="c17 lst-kix_list_11-0" start="8"><li class="c1 c16 c2"><h1 id="h.302dr9l" style="display:inline"><span>PRODUCCI&Oacute;N</span></h1></li></ol><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>En este m&oacute;dulo, se gestiona la informaci&oacute;n del proceso de producci&oacute;n del producto. Solo tendr&aacute; acceso el rol administrador u otro rol que tenga este permiso asignado.</span></p><p class="c0"><span></span></p><h2 class="c0 c2"><span></span></h2><h2 class="c1 c2" id="h.1f7o1he"><span>9.1 REGISTRAR ORDEN DE PRODUCCI&Oacute;N</span></h2><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>Al momento de registrar una orden de producci&oacute;n, el formulario deshabilita los campos para ingresar informaci&oacute;n, por lo que se debe asociar un pedido. Al dar clic en el bot&oacute;n asociar, aparecen los pedidos que se encuentran en estado pendiente, al dar clic en el icono de agregar, los datos del formulario se cargan autom&aacute;ticamente con la informaci&oacute;n del pedido seleccionado. Ver </span><span class="c3">Figura 76. Registrar orden.</span></p><p class="c0"><span class="c3"></span></p><p class="c1"><span>&nbsp;</span></p><p class="c6 c1 c2" id="h.3z7bk57"><span class="c5 c4">Figura 76. Registrar orden</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image61.png" style="width: 589.23px; height: 382.15px; margin-left: -0.00px; margin-top: -33.92px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.2eclud0"><span class="c4 c3">9.1.1 Seleccionar lugar</span><span>: En el formulario aparece la opci&oacute;n de seleccionar lugar para la orden de producci&oacute;n. Ver </span><span class="c3">Figura 77. Seleccionar lugar de producci&oacute;n.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.thw4kt"><span class="c5 c4">Figura 77. Seleccionar lugar de producci&oacute;n</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image62.png" style="width: 589.23px; height: 415.01px; margin-left: -0.00px; margin-top: -37.93px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.3dhjn8m"><span class="c4 c3">9.1.1.1: F&aacute;brica</span><span>. Si se selecciona la opci&oacute;n de f&aacute;brica, significa que la orden va a pasar el proceso de producci&oacute;n dentro de la misma empresa, el sistema no solicita informaci&oacute;n, se le puede dar clic al bot&oacute;n &ldquo;Registrar&rdquo; sin ninguna condici&oacute;n. Ver </span><span class="c3">Figura 78. Lugar-Fabrica.</span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.1smtxgf"><span class="c5 c4">Figura 78. Lugar-Fabrica</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.20px; height: 262.05px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image63.png" style="width: 589.20px; height: 331.27px; margin-left: -0.00px; margin-top: -32.00px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.4cmhg48"><span class="c4 c3">9.1.1.2 Sat&eacute;lite</span><span>. Al seleccionar la opci&oacute;n de sat&eacute;lite, se da a entender que el proceso de producci&oacute;n de la orden se va a realizar en otro lugar, el sistema no solicita informaci&oacute;n, se le puede dar clic al bot&oacute;n &ldquo;Registrar&rdquo; sin ninguna condici&oacute;n. Ver </span><span class="c3">Figura 79. Lugar-Sat&eacute;lite.</span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.2rrrqc1"><span class="c5 c4">Figura 79. Lugar-Sat&eacute;lite</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image64.png" style="width: 589.23px; height: 374.73px; margin-left: -0.00px; margin-top: -32.29px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.16x20ju"><span class="c4 c3">9.1.1.3 F&aacute;brica-Sat&eacute;lite</span><span>. Al seleccionar esta opci&oacute;n, el sistema cuenta con que la producci&oacute;n se va a realizar una parte dentro de la empresa y el resto en otro lugar, por esto se solicita ingresar la cantidad que se va a producir en f&aacute;brica y en otro campo la cantidad a producir en el sat&eacute;lite. Ver </span><span class="c3">Figura 80. Lugar Fabrica-Sat&eacute;lite.</span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.3qwpj7n"><span class="c5 c4">Figura 80. Lugar Fabrica-Sat&eacute;lite</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.20px; height: 271.62px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image65.png" style="width: 589.20px; height: 331.27px; margin-left: -0.00px; margin-top: -29.41px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c1" id="h.261ztfg"><span class="c4 c3">9.1.2 Validaciones de campos</span><span>. Al momento de dar clic en el bot&oacute;n &ldquo;Registrar&rdquo; el sistema valida que los campos est&eacute;n completos. En caso de haber una inconsistencia el sistema muestra un mensaje indicando el error. Ver </span><span class="c3">Figura 81. Validaciones de campos de orden.</span></p><p class="c0"><span class="c3"></span></p><p class="c6 c1 c2" id="h.l7a3n9"><span class="c5 c4">Figura 81. Validaciones de campos de orden</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image55.png" style="width: 589.23px; height: 367.59px; margin-left: -0.00px; margin-top: -30.71px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span class="c3"></span></p><p class="c1"><span>En caso contrario el sistema muestra un mensaje confirmando el registro exitoso. &nbsp;</span><span class="c8 c3">Ver Figura 82. Registro exitoso de orden de producci&oacute;n.</span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.356xmb2"><span class="c5 c4">Figura 82. Registro exitoso de orden de producci&oacute;n</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image56.png" style="width: 589.23px; height: 349.89px; margin-left: -0.00px; margin-top: -30.14px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><h2 class="c1 c2" id="h.1kc7wiv"><span>9.2</span><span class="c21">&nbsp;</span><span class="c8">LISTAR &Oacute;RDENES </span></h2><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1 c26"><span>Esta opci&oacute;n permite visualizar las &oacute;rdenes de producci&oacute;n de manera &nbsp;general, cada orden es mostrada en un cuadro que contiene el estado, la fecha de terminaci&oacute;n y lugar de producci&oacute;n; tambi&eacute;n cuenta con 3 iconos, que permiten modificar y cancelar o iniciar la producci&oacute;n. A este m&oacute;dulo solo tendr&aacute; acceso el rol administrador, u otro rol que tenga este permiso asignado. Ver </span><span class="c3">Figura 83. Listar &oacute;rdenes de producci&oacute;n.</span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.44bvf6o"><span class="c5 c4">Figura 83. Listar &oacute;rdenes de producci&oacute;n</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 579.02px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image57.png" style="width: 588.88px; height: 450.62px; margin-left: -0.00px; margin-top: -38.33px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.2jh5peh"><span class="c4 c3">9.2.1 Modificar orden</span><span>: Para modificar una orden, se da clic sobre el icono que aparece dentro del cuadro, se permite modificar el pedido asociado y el lugar de producci&oacute;n. Ver </span><span class="c3">Figura 84. </span><span class="c8 c3">Modificar orden</span><span class="c3">. </span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.ymfzma"><span class="c5 c4">Figura 84. Modificar orden</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 388.40px; height: 220.14px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image48.png" style="width: 589.20px; height: 331.27px; margin-left: -97.84px; margin-top: -45.86px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c1"><span>Este formulario tambi&eacute;n contiene validaciones de campos. Ver </span><span class="c3">Figura 81. Validaciones de campos de orden.</span></p><p class="c0"><span class="c3"></span></p><p class="c0"><span class="c3"></span></p><p class="c1" id="h.3im3ia3"><span class="c4 c3">9.2.2 Cancelar orden</span><span class="c3">. </span><span>En caso de solicitar la cancelaci&oacute;n de un pedido, el icono se encuentra dentro del cuadro de cada referencia, al dar clic, sale un mansaje para confirmar la cancelaci&oacute;n. Ver </span><span class="c3">Figura 85. Cancelar orden de producci&oacute;n.</span><span>&nbsp;</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.1xrdshw"><span class="c5 c4">Figura 85. Cancelar orden de producci&oacute;n</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image49.png" style="width: 1460.36px; height: 738.01px; margin-left: -468.21px; margin-top: -220.85px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.4hr1b5p"><span class="c4 c3">9.2.3 Iniciar producci&oacute;n</span><span>: Para iniciar la producci&oacute;n, se da clic en la flecha verde que est&aacute; dentro del cuadro de la referencia, aparece de inmediato un mensaje para confirmar el inicio de la orden. Ver </span><span class="c3">Figura 86. Iniciar producci&oacute;n.</span></p><p class="c0"><span class="c3"></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.2wwbldi"><span class="c5 c4">Figura 86. Iniciar producci&oacute;n</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image50.png" style="width: 1429.93px; height: 749.68px; margin-left: -448.24px; margin-top: -226.76px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span class="c3"></span></p><p class="c0"><span class="c3"></span></p><hr style="page-break-before:always;display:none;"><p class="c0"><span></span></p><p class="c0"><span></span></p>
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