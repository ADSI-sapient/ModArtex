    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="<?php echo URL ?>home/index"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li><a href="#">Pedido</a></li>
        <li class="active">Listar Pedidos</li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border" style="text-align: center;">
          <h3 class="box-title" style="margin-top: 0.7%;"><strong>LISTAR PEDIDOS</strong></h3>
          <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#ModAyudaPedido" style="background: transparent; border: none;"><i class="fa fa-comment"></i></button>
        </div>
        <div id="pedidos">
              <form class="form-horizontal">
                <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-hover table-bordered" id="tablaPedidos">
                    <thead>
                      <tr class="info">
                        <th style="width: 10px">#</th>
                        <th>Fecha Registro</th>
                        <th>Cliente</th>
                        <th>Fecha Entrega</th>
                        <th>Estado</th>
                        <th>Valor Total</th>
                        <th style="width: 7%">Editar</th>
                        <th style="width: 7%">Cancelar</th>
                        <th style="width: 7%">Productos Asociados</th>
                      </tr>
                    </thead>
                    <tbody class="list">
                    <?php foreach ($pedidos as $pedido): ?>
                      <tr>
                        <td><?= $pedido["Id_Solicitud"] ?></td>
                        <td class="freg"><?= $pedido["Fecha_Registro"] ?></td>
                        <td class="nomclte"><?= $pedido["Nombre"] ?></td>
                        <td class="ftga"><?= $pedido["Fecha_Entrega"] ?></td>
                        <td><?= $pedido["Nombre_Estado"] ?></td>
                        <td class="vtal"><?= $pedido["Valor_Total"] ?></td>
                        <td>
                          <?php if ($pedido["Nombre_Estado"] == "Cancelado" || $pedido["Nombre_Estado"] == "En Proceso" || $pedido["Sol_Repetida"] == 2): ?>
                            <button style="cursor:auto;" type="" class="btn btn-box-tool" disabled="" ><i class="fa fa-pencil-square-o" style="cursor:auto; font-size: 150%;"></i></button>
                          <?php else: ?>
                            <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#modalEditPedido" id="btncarg" onclick="editarPedido('<?= $pedido["Id_Solicitud"] ?>', this, '<?= $pedido["Num_Documento"] ?>', '<?= $pedido["Nombre"] ?>'); cargarProductosAsoPed('<?= $pedido["Id_Solicitud"] ?>', '', 1)"><i class="fa fa-pencil-square-o" name="btncarg" style="font-size: 150%;"></i></button>
                          <?php endif ?>
                        </td>
                        <td>
                          <?php if ($pedido["Nombre_Estado"] == "Cancelado" || $pedido["Nombre_Estado"] == "En Proceso"): ?>
                            <button type="button" class="btn btn-box-tool" disabled=""><i class="fa fa-ban" style="cursor:auto; font-size: 150%;"></i></button>
                          <?php else: ?>
                            <button type="button" class="btn btn-box-tool" onclick="cancelarPedido('<?= $pedido["Id_Solicitud"] ?>')" id="btn-cancel-ped"><i class="fa fa-ban fa-lg" style="color:red; font-size: 150%;"></i></button>
                          <?php endif ?>
                        </td>
                        <td>
                          <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#dllProductosAso" onclick="cargarProductosAsoPed('<?= $pedido["Id_Solicitud"] ?>')"><i class="fa fa-eye" style="color:#3B73FF; font-size: 150%;"></i></button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
            </div>
          </form>
        </div>
        <div class="box-footer"></div> 
      </div>
      <!-- Incio modal modificar pedido -->
      <div class="modal fade" id="modalEditPedido" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content" style="border-radius:10px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>MODIFICAR PEDIDO</b></h4>
            </div>
              <form role="form" action="<?= URL ?>ctrPedido/editarPedido" method="post" id="modpedido" onsubmit=" return enviarFormPedidoModi()" data-parsley-validate="">
            <div class="modal-body" style="padding:10px;">
              <input type="hidden" name="id_pedido" id="id_pedido">
              <input type="hidden" name="arrayInsumosPedMod[]" id="arrayInsumosPedMod">
                <div class="row">
                  <div class="form-group col-sm-12">
                    <div class="form-group col-sm-6">
                      <label class="">Fecha Registro:</label>
                      <div class="input-group date">
                        <div class="input-group-addon" style="border-radius:5px;">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input class="form-control" readonly type="text" name="fecha_reg" id="fecha_reg" style="border-radius:5px;">
                      </div>
                    </div>
                    <div class="form-group col-sm-6">
                      <label class="">*Fecha Entrega:</label>
                      <div class="">
                        <div class="input-group date">
                          <div class="input-group-addon" style="border-radius:5px;">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input data-parsley-required='' type="text" class="form-control" name="fecha_entrega" id="fecha_entrega" style="border-radius:5px;" onkeyup="prohibirEscritura();">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                 <div class="row">
                   <div class="form-group col-sm-12">
                      <div class="form-group col-sm-6">
                        <label for="doc_cliente" class="">*Asociar Cliente:</label>
                        <br>
                        <select class="form-control" name="doc_cliente" id="doc_cliente" style="width: 100%;">
                            <!-- <option value=""></option> -->
                          <?php foreach ($clientes as $cliente): ?>
                            <option value="<?= $cliente["Num_Documento"] ?>"><?= $cliente["Num_Documento"] ." - ". $cliente["Nombre"] ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                      <div class="form-group col-sm-3">
                        <label for="estado" class="">Estado:</label>
                        <input type="text" name="estado" id="estado" class="form-control" value="" readonly="" style="border-radius:5px;">
                      </div>
                      <div class="form-group col-sm-3" style="margin-top: 25px;">
                        <button type="button" class="btn btn-primary btn-md btn-block" data-toggle="modal" data-target="#asoProductos"><b>Asociar Productos</b></button>
                      </div>
                    </div>
                 </div>
                <div class="table">
                <label for="valor_total" class="">*Productos Asociados:</label>
                <div class="form-group col-sm-12 table-responsive scrolltablas">
                  <table class="table table-hover table-bordered" style="margin-top: 2%;" id="tbl-prod-aso-ped">
                    <thead>
                      <tr class="active">
                        <th>Referencia</th>
                        <th>Nombre</th>
                        <th>Color</th>
                        <th>Talla</th>
                        <th>Cantidad a Producir</th>
                        <th>Valor Producto</th>
                        <th>Subtotal</th>
                        <th>Tomar de Stock</th>
                        <th>En Producto Terminado</th>
                        <th>Retirar</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-12">
                <div class="form-group col-sm-6" style="margin-left:1%">
                  <label for="valor_total" class="">Valor Total:</label>
                  <div class="input-group">
                    <div class="input-group-addon" style="border-radius:5px;">
                      <i class="fa iconoDinero fa-money" style="color: green; font-size: 150%;"></i>
                    </div>
                    <input data-parsley-required='' min='1' class="form-control" type="text" name="valor_total" id="valor_total" readonly="" style="border-radius:5px;" data-parsley-errors-container="#errorVtMoP">
                  </div>
                  <div id="errorVtMoP"></div>            
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="form-group col-sm-12">
                <div class="col-md-offset-3 col-md-3">
                  <button type="submit" class="btn btn-warning btn-md btn-block" name="btnModificarPed"><i class="fa fa-refresh" aria-hidden="true"></i><b> Actualizar</b></button>
                </div>
                <div class="col-md-3">
                  <button type="button" class="btn btn-default btn-md btn-block" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times-circle"></i> Cerrar</button>
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- fin modal modificar pedido-->
      <!-- Incio modal productos asociados pedido -->
      <div class="modal fade" id="dllProductosAso" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>PRODUCTOS ASOCIADOS</b></h4>
            </div>
            <div class="modal-body" style="padding:10px;">
              <div class="table">
                <div class="table-responsive scrolltablas">
                  <table class="table table-hover cell-border" style="margin-top: 2%;" id="dll-prod-asoped">
                    <thead>
                      <tr class="active">
                        <th>Referencia</th>
                        <th>Nombre</th>
                        <th>Color</th>
                        <th>Talla</th>
                        <th style="text-align: center;">Cantidad a Producir</th>
                        <th style="text-align: center;">Producto Terminado Tomado</th>
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
      <!-- Inicio modal asociar productos(fichas) -->
      <div class="modal fade" id="asoProductos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>PRODUCTOS PARA ASOCIAR</b></h4>
            </div>
            <div class="modal-body" style="padding:10px;">
              <div class="table">
                <div class="col-sm-12 table-responsive">
                <table class="table table-hover table-bordered" id="prodAsociarPedMod">
                <thead>
                  <tr class="active">
                    <th>Referencia</th>
                    <th>Nombre</th>
                    <th>Color</th>
                    <th>Talla</th>
                    <th>Valor Producción</th>
                    <th>Valor Producto</th>
                    <th>Agregar</th>
                  </tr>
                </thead>
                <tbody>
                <?php $p = 1; ?>
                <?php foreach ($productosHab as $producto): ?>
                  <tr>
                    <td><?= $producto["Referencia"] ?></td>
                    <td><?= $producto["Nombre"] ?></td>
                    <td><i class="fa fa-square" style="color:<?= $producto["Codigo_Color"] ?>; font-size: 200%;" title="<?= $producto["Nombre_Color"] ?>"></i></td>
                    <td><?= $producto["Nom_Talla"] ?></td>
                    <td><?= $producto["Valor_Produccion"] ?></td>
                    <td><?= $producto["Valor_Producto"] ?></td>
                    <td>
                      <button id="btn<?= $producto["Id_Ficha_Tecnica"] ?>" type="button" class="btn btn-box-tool" onclick="asociarProductosModiPedido('<?= $producto["Id_Ficha_Tecnica"] ?>', '<?= $producto["Referencia"] ?>', '<?= $producto["Codigo_Color"] ?>', '<?= $producto["Valor_Producto"] ?>', this, '<?= $p; ?>', '<?= $producto["Cantidad"] ?>', '<?= $producto["Nombre"] ?>', '<?= $producto["Nom_Talla"] ?>', '<?= $producto["Id_Fichas_Tallas"] ?>')"><i class="fa fa-plus" style="font-size:150%; color:blue;"></i></button>
                    </td>
                  </tr>
                  <?php $p++; ?>
                <?php endforeach; ?>
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
      <!-- fin modal asociar productos(fichas) -->
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