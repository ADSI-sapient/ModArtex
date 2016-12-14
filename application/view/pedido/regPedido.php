    <style>
      input[type=number]::-webkit-outer-spin-button,
      input[type=number]::-webkit-inner-spin-button {
          -webkit-appearance: none;
          margin: 0;
      }
      input[type=number] {
          -moz-appearance:textfield;
      }
    </style>
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="<?php echo URL; ?>home/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Pedido</a></li>
        <li class="active">Registrar Pedido</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border" style="text-align: center;">
          <h3 class="box-title" style="margin-top: 0.7%;"><strong>REGISTRAR PEDIDO</strong></h3>
          <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#ModAyudaPedido" style="background: transparent; border: none;"><i class="fa fa-comment"></i></button>
        </div>
          <form action="<?php echo URL; ?>ctrPedido/regPedido" method="POST" onsubmit="return enviarFormPedido();" id="frmRegPedido" data-parsley-validate="">
        <div class="box-body">
          <input type="hidden" name="cantDesc[]" value="" id="cantDesc"> 
          <input type="hidden" name="idExistColr[]" value="" id="idExistColr">
          <input type="hidden" name="arrInsums[]" value="" id="arrInsums">
          <div class="row">
          <div class="col-lg-12">
            <div class="form-group col-lg-4">
              <label class="">Fecha Registro:</label>
              <div class="">
                <div class="input-group date">
                  <div class="input-group-addon" style="border-radius:5px;">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="fecha_reg" id="fecha_reg" placeholder="" style="border-radius:5px;" readonly="" value="<?php echo date("Y-m-d");?>">
                </div>
              </div>
            </div>
            <div class="form-group col-lg-4">
              <label class="">*Fecha Entrega:</label>
              <div class="">
                <div class="input-group date">
                  <div class="input-group-addon" style="border-radius:5px;">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="fecha_entrega" id="fecha_entrega" style="border-radius:5px;" data-parsley-required="" data-parsley-errors-container="#regPedidov" onkeyup="prohibirEscritura();">
                </div>
              </div>
              <div id="regPedidov"></div>
            </div>
            <div class="form-group col-lg-4">
              <label for="estado" class="">Estado:</label>
              <input type="text" name="estado" class="form-control" id="estado" value="Pendiente" readonly="" style="border-radius:5px;">
            </div>
          </div>
          </div>
          <div class="row">
          <div class="col-lg-12">
            <div class="form-group col-lg-4">
              <label for="id_cliente" class="">*Asociar Cliente:</label>
              <select class="form-control" style="border-radius:5px;" name="id_cliente" id="id_cliente" data-parsley-required="" data-parsley-errors-container="#regPedidoCl">
              <option value=""></option>
                <?php foreach ($clientes as $cliente): ?>
                  <option value="<?= $cliente["Num_Documento"] ?>"><?= $cliente["Num_Documento"] ." - ".$cliente["Nombre"]?></option>
                <?php endforeach ?>
              </select>
              <div id="regPedidoCl"></div>
              </div>
            <!-- </div> -->
            <!-- <div class="row col-lg-12" style="margin-left:0.5%"> -->
              <div class="col-lg-4 col-lg-offset-4">
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#asociarFichas" style="margin-top:25px"><b>Asociar Productos</b></button>
              </div>
              </div>
            </div>
          <div class="row">
          <div class="col-md-12" id="agregarFicha">
          <div class="col-md-12">
          <label>*Productos Asociados:</label>
            <div class="table scrolltablas" style="margin-top: 2%;">
              <div class="col-lg-12 table-responsive" style="padding: 0;">
                <table class="table table-hover table-bordered" id="tablaFicha">
                  <thead>
                    <tr class="active">
                      <th>Referencia</th>
                      <th>Nombre</th>
                      <th>Talla</th>
                      <th>Color</th>
                      <th>Valor Producto</th>
                      <th>Cantidad a Producir</th>
                      <th>Subtotal</th>
                      <th>Tomar de Stock</th>
                      <th>En Producto Terminado</th>
                      <th style="display: none;"></th>
                      <th style="display: none;"></th>
                      <th>Retirar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td id="tblFichasVacia" colspan="10" style="text-align:center;"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            </div>
            </div>
            </div>  
            <div class="row">
              <div class="col-lg-offset-8 col-lg-4">
                <div class="col-lg-12">
                  <label for="vlr_total" class="">*Valor Total:</label>
                  <div class="input-group">
                    <div class="input-group-addon" style="border-radius:5px;">
                      <i class="fa fa-money iconoDinero" style="color:green; font-size:150%;"></i>
                    </div>
                    <input type="text" name="vlr_total" class="form-control" id="vlr_total" readonly="" value="0" style="border-radius:5px;">
                  </div>
                </div>
              </div>
            </div>
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-lg-offset-3 col-lg-3">
            <button type="submit" class="btn btn-success btn-md btn-block" name="btnRegPedido" ><i class="fa fa-check-circle" aria-hidden="true"></i> <b>Registrar</b></button>
          </div>
          <div class="col-lg-3">
            <button type="reset" onclick="limpiarFormRegPedido()" name="btnCanFicha" class="btn btn-default btn-md btn-block"  style="margin-left: 2%;"><i class="fa fa-eraser" aria-hidden="true"></i> <b>Limpiar</b></button>        
          </div>
        </div>
      </div>
    </form>
      </div>
      <!-- Inicio Modal asociar fichas -->
      <div class="modal fade" id="asociarFichas" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>PRODUCTOS PARA ASOCIAR</b></h4>
            </div>
            <div class="modal-body">
              <div class="table">
                <div class="col-sm-12 table-responsive">
                  <table class="table table-hover table-bordered" style="margin-top: 2%;" id="tblFichasAsp">
                  <thead>
                    <tr class="active">
                      <th>Referencia</th>
                      <th>Nombre</th>
                      <th>Talla</th>
                      <th>Estado</th>
                      <th>Color</th>
                      <th>Valor Producción</th>
                      <th>Valor Producto</th>
                      <th>Agregar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($fichas as $ficha): ?>
                    <tr>
                      <td><?= $ficha["Referencia"] ?></td>
                      <td><?= $ficha["Nombre"] ?></td>
                      <td><?= $ficha["Nom_Talla"] ?></td>
                      <td><?= $ficha["Estado"]==1?"Habilitado":"Inhabilitado" ?></td>
                      <td><i class='fa fa-square' style='color: <?= $ficha["Codigo_Color"] ?>; font-size: 200%;' title="<?= $ficha["Nombre_Color"] ?>"></i></td>
                      <td><?= $ficha["Valor_Produccion"] ?></td>
                      <td><?= $ficha["Valor_Producto"] ?></td>
                      <td>
                        <button id="btn<?= $i; ?>" type="button" class="btn btn-box-tool btnfichas" onclick="asociarProductos('<?= $ficha["Id_Ficha_Tecnica"] ?>', '<?= $ficha["Referencia"] ?>', '<?= $ficha["Codigo_Color"] ?>', '<?= $ficha["Valor_Producto"] ?>', this, '<?= $i; ?>', '<?= $ficha["Cantidad"] ?>', '<?= $ficha["Nombre_Color"] ?>', '<?= $ficha["Nombre"] ?>', '<?= $ficha["Nom_Talla"] ?>', '<?= $ficha["Id_Fichas_Tallas"] ?>');"><i style="font-size: 150%; color: blue;" class="fa fa-plus"></i></button>
                      </td>
                    </tr>
                    <?php $i++; ?>
                  <?php endforeach; ?>
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
      <!-- Fin modal asociar fichas -->
      <!-- Inicio modal asociar cliente -->
      <div class="modal fade" id="asociarClientes" tabindex="-1" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Clientes</b></h4>
            </div>
            <div class="modal-body">
              <div class="table">
                <div class="col-sm-12 table-responsive">
                  <table class="table table-hover" style="margin-top: 2%;">
                  <thead>
                    <tr class="active">
                      <th>Documento</th>
                      <th>Nombre</th>
                      <th>Telefono</th>
                      <th>Email</th>
                      <th>Agregar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $c = 1; ?>
                    <?php foreach ($clientes as $cliente): ?>
                    <tr>
                      <td><?= $cliente["Num_Documento"] ?></td>
                      <td><?= $cliente["Nombre"] ?></td>
                      <td><?= $cliente["Telefono"] ?></td>
                      <td><?= $cliente["Email"] ?></td>
                      <td>
                        <button id="btnAgregar<?= $c; ?>" type="button" class="btn btn-box-tool" onclick="asociarCliente('<?= $cliente["Nombre"] ?>', <?= $cliente["Num_Documento"] ?>, this, '<?= $c; ?>')"><i class="fa fa-plus"></i></button>
                      </td>
                    </tr>
                    <?php $c++; ?>
                    <?php endforeach; ?>
                  </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      <!-- Fin modal asociar cliente -->
    </section>


<div class="modal fade" id="ModAyudaPedido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 10px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><strong>AYUDA USUARIO</strong></h4>
        </div>
        <div class="modal-body"> 
        <div class="modAyuda scrollAyuda">
          <ol class="c17 lst-kix_list_11-0" start="7"><li class="c1 c16 c2"><h1 id="h.4fsjm0b" style="display:inline"><span>PEDIDO</span></h1></li></ol><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>En el m&oacute;dulo de pedido, se lleva el control de los pedidos que realizan los clientes a la empresa, se le asigna a cada uno un estado, que informa al usuario si ya se realiz&oacute; o est&aacute; pendiente el pedido. A este m&oacute;dulo solo tiene acceso la cuenta del Administrador u otro rol que tenga este permiso asignado.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><h2 class="c1 c2" id="h.2uxtw84"><span>8.1 REGISTRAR PEDIDO</span></h2><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>En la opci&oacute;n de &ldquo;Registrar pedido&rdquo;, se abre un formulario donde se debe ingresar todos los campos que contengan un asterisco (*), adem&aacute;s se debe asignar un cliente y asociar los productos a suplir en este pedido. Ver </span><span class="c3">Figura 69. Registrar pedido.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.1a346fx"><span class="c5 c4">Figura 69. Registrar pedido</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image29.png" style="width: 589.23px; height: 361.60px; margin-left: -0.00px; margin-top: -32.75px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.3u2rp3q"><span class="c4 c3">8.1.2 Validaci&oacute;n de campos de pedido</span><span>: Al dar clic en el bot&oacute;n &ldquo;Registrar&rdquo; el sistema valida que los campos est&eacute;n completos y la informaci&oacute;n correcta, en caso de haber una inconsistencia, se muestra una alerta informando del error e impidiendo continuar con el registro. Ver </span><span class="c3">Figura 70. Validaci&oacute;n de campos de pedido.</span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.2981zbj"><span class="c5 c4">Figura 70. Validaci&oacute;n de campos de pedido</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image30.png" style="width: 589.23px; height: 351.45px; margin-left: -0.00px; margin-top: -28.65px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c1"><span>Este formulario tambi&eacute;n contiene validaciones de existencias en producto terminado. Ver </span><span class="c3">Figura 67. Validaciones de existencias en producto terminado.</span></p><p class="c0"><span></span></p><p class="c1"><span>Este formulario tambi&eacute;n contiene validaciones de existencias de insumos. Ver </span><span class="c3">Figura 68. Validaciones de existencias de insumos.</span></p><p class="c0"><span></span></p><p class="c1"><span>Luego de mostrar las alertas, el sistema permite continuar con el registro, al dar de nuevo clic en el bot&oacute;n &ldquo;Registrar&rdquo;, se muestra un mensaje de confirmaci&oacute;n. Ver </span><span class="c3">Figura 71. Registro de pedido exitoso.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.odc9jc"><span class="c5 c4">Figura 71. Registro de pedido exitoso</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 283.46px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image20.png" style="width: 589.23px; height: 331.81px; margin-left: -0.00px; margin-top: -27.05px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><h2 class="c1 c2" id="h.38czs75"><span>8.2 LISTAR PEDIDOS</span></h2><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>En la opci&oacute;n de &ldquo;Listar Pedidos&rdquo; se puede visualizar de manera general todos los pedidos que se encuentran registrados, con la informaci&oacute;n y el estado en que cada uno se encuentra. Ver </span><span class="c3">Figura 72. Listar pedidos.</span><span>&nbsp;</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.1nia2ey"><span class="c5 c4">Figura 72. Listar pedidos</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 283.46px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image21.png" style="width: 589.23px; height: 380.17px; margin-left: -0.00px; margin-top: -33.28px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c1" id="h.47hxl2r"><span class="c4 c3">8.2.1 Productos asociados</span><span>: En el listar, est&aacute; disponible el icono de productos asociados. Permite visualizar las referencias con su informaci&oacute;n, m&aacute;s la cantidad a suplir en el pedido. Ver </span><span class="c3">Figura 73. Productos asociados a pedido.</span></p><p class="c0"><span class="c3"></span></p><p class="c0"><span></span></p><p class="c11 c1 c7 c2" id="h.2mn7vak"><span class="c5 c4">Figura 73. Productos asociados a pedido</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 226.77px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image58.png" style="width: 751.71px; height: 583.40px; margin-left: -126.81px; margin-top: -77.58px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span><span class="c3">.</span></p><p class="c0 c9"><span class="c3"></span></p><p class="c0 c9"><span class="c3"></span></p><p class="c1 c7" id="h.11si5id"><span class="c4 c3">8.2.2 Editar</span><span class="c3">: </span><span>Solo se puede modificar un pedido cuando se encuentra en estado: pendiente. Para modificar, se da clic en el icono del editar, disponible al momento de listar, donde se abre un formulario, que permite modificar los campos y asociar otros productos a suplir en el pedido. Ver </span><span class="c3">Figura 74. Modificar pedido.</span></p><p class="c0 c7"><span class="c3"></span></p><p class="c0 c7"><span class="c3"></span></p><p class="c11 c1 c7 c2" id="h.3ls5o66"><span class="c5 c4">Figura 74. Modificar pedido</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image59.png" style="width: 749.54px; height: 410.41px; margin-left: -126.47px; margin-top: -54.58px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0 c9"><span></span></p><p class="c0 c9"><span></span></p><p class="c1" id="h.20xfydz"><span class="c4 c3">8.2.3 Cancelar pedido</span><span>: En caso de cancelaci&oacute;n del pedido, se da clic en el bot&oacute;n &ldquo;Cancelar&rdquo;, que aparece en el listar, donde sale un mensaje para confirmaci&oacute;n de la cancelaci&oacute;n. Solo se puede cancelar un pedido que se encuentre en estado pendiente. Ver </span><span class="c3">Figura 75. Cancelar pedido.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c11 c1 c7 c2" id="h.4kx3h1s"><span class="c5 c4">Figura 75. Cancelar pedido</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image60.png" style="width: 1424.21px; height: 745.10px; margin-left: -450.49px; margin-top: -228.75px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><hr style="page-break-before:always;display:none;"><p class="c0 c18 c7"><span></span></p>
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