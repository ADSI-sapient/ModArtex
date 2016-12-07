    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="<?php echo URL ?>home/index"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li><a href="#">Pedido</a></li>
        <li class="active">Listar Pedidos</li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border"  style="text-align: center;">
          <h3 class="box-title"><strong>LISTAR PEDIDOS</strong></h3>
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

