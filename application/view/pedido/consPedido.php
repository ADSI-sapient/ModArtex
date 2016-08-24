    <!-- Content Header (Page header) -->
    <section class="content-header">
      <br>
      <ol class="breadcrumb">
        <li><a href="<?php echo URL ?>home/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
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
      <!--<div class="row box-header">
            <div class="col-md-8"></div>
               <div class="col-md-4">
                  <div class="form-group">
                    <div class="box-tools pull-right">   
                      <form action="#" method="get" class="form-horizontal">
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Buscar">
                            <span class="input-group-btn">
                              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                      </form> 
                    </div>
                  </div>
                </div>
              </div> -->
              <form class="form-horizontal">
                <div class="col-md-12">
            <!--<div class="box"> -->
                <br>
                <div class="table-responsive">
                  <table class="table table-responsive" id="tablaPedidos">
                    <thead>
                      <tr class="info">
                        <th style="width: 10px">#</th>
                        <th>Fecha Registro</th>
                        <th>Fecha Entrega</th>
                        <th>Valor Total</th>
                        <th>Estado</th>
                        <th>Cliente</th>
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
                        <td class="ftga"><?= $pedido["Fecha_Entrega"] ?></td>
                        <td class="vtal"><?= $pedido["Valor_Total"] ?></td>
                        <td><?= $pedido["Nombre_Estado"] ?></td>
                        <td class="nomclte"><?= $pedido["Nombre"] ?></td>
                        <td>
                          <?php if ($pedido["Nombre_Estado"] == "Cancelado"): ?>
                            <button type="button" class="btn btn-box-tool" disabled="" ><i class="fa fa-pencil-square-o"></i></button>
                          <?php else: ?>
                            <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#modalEditPedido" id="btncarg" onclick="editarPedido('<?= $pedido["Id_Solicitud"] ?>', this, '<?= $pedido["Num_Documento"] ?>', '<?= $pedido["Nombre"] ?>'); cargarProductosAsoPed('<?= $pedido["Id_Solicitud"] ?>', 1)"><i class="fa fa-pencil-square-o fa-lg" name="btncarg"></i></button>
                          <?php endif ?>
                        </td>
                        <td>
                          <?php if ($pedido["Nombre_Estado"] == "Cancelado"): ?>
                            <button type="button" class="btn btn-box-tool" disabled=""><i class="fa fa-ban"></i></button>
                          <?php else: ?>
                            <button type="button" class="btn btn-box-tool" onclick="cancelarPedido('<?= $pedido["Id_Solicitud"] ?>')" id="btn-cancel-ped"><i class="fa fa-ban fa-lg" style="color:red" ></i></button>
                          <?php endif ?>
                        </td>
                        <td>
                          <?php if ($pedido["Nombre_Estado"] == "Cancelado"): ?>
                            <button type="button" class="btn btn-box-tool" disabled=""><i class="fa fa-eye"></i></button>
                          <?php else: ?>
                          <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#dllProductosAso" onclick="cargarProductosAsoPed('<?= $pedido["Id_Solicitud"] ?>', 0)"><i class="fa fa-eye fa-lg" style="color:#61B3EE"></i></button>
                          <?php endif ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
         <!-- </div> -->
            </div>
          </form>
        </div>
        <div class="box-footer"></div> 
      </div>
      <!-- Incio modal modificar pedido -->
      <div class="modal fade" id="modalEditPedido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
              <button type="button" class="close" onclick="cancelar()"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>Modificar Pedido</b></h4>
            </div>
            <div class="modal-body" style="padding:10px;">
              <form role="form" action="<?= URL ?>ctrPedido/editarPedido" method="post" id="modpedido" onsubmit=" return enviarFormPedidoModi()">
                <!-- <div class="form-group col-sm-4">
                  <label for="id_pedido" class="">Id Pedido:</label>
                  <input class="form-control" type="text" name="id_pedido" id="id_pedido" readonly="" style="border-radius:5px;">
                </div> -->
                <input type="hidden" name="id_pedido" id="id_pedido">
                <div class="form-group col-sm-5">
                  <label class="">Fecha Registro:</label>
                  <div class="input-group date">
                    <div class="input-group-addon" style="border-radius:5px;">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control" readonly type="text" name="fecha_reg" id="fecha_reg" style="border-radius:5px;">
                  </div>
                </div>
                <!-- <div class="form-group col-sm-6">
                  <label for="estado" class="">Estado</label>
                  <select class="form-control" name="estado" id="estado" required="" style="border-radius:5px;">
                    <option value="5">Pendiente</option>
                    <option value="6">En Proceso</option>
                    <option value="7">Terminado</option>
                  </select>
                </div> -->
                <div class="form-group col-sm-offset-2 col-sm-5">
                  <label for="estado" class="">Estado</label>
                  <input type="text" name="estado" id="estado" class="form-control" value="Pendiente" readonly="" style="border-radius:5px;">
                </div>
                <div class="form-group col-sm-5">
                  <label class="">*Fecha Entrega:</label>
                  <div class="">
                    <div class="input-group date">
                      <div class="input-group-addon" style="border-radius:5px;">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control" name="fecha_entrega" id="fecha_entrega" style="border-radius:5px;">
                    </div>
                  </div>
                </div>
                <!-- <div class="form-group col-sm-6">
                  <label for="nombrecliente" class="">*Asociar Cliente:</label>
                  <div class="">
                    <div class="input-group">
                      <input type="text" name="nombreCliente" class="form-control" id="nombreCliente" readonly="" required="" style="border-radius:5px;">
                      <input type="hidden" name="doc_cliente"  id="doc_cliente" required="" value="">
                      <div class="input-group-btn" style="border-radius:5px; margin-bottom:10%;">
                        <button type="button" style="border-radius:5px;" id="buscarCliente" class="btn btn-flat" data-toggle="modal" data-target="#asoClientesHab"><i class="fa fa-search"></i>
                          </button>
                      </div>
                    </div>
                  </div>
                </div> -->
                <div class="form-group col-sm-offset-2 col-sm-5">
                  <label for="doc_cliente" class="">*Asociar Cliente:</label>
                  <select class="form-control" name="doc_cliente" id="doc_cliente" style="border-radius:5px;">
                    <!-- <option value=""></option> -->
                    <?php foreach ($clientes as $cliente): ?>
                      <option value="<?= $cliente["Num_Documento"] ?>"><?= $cliente["Nombre"]?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="table">
                <div class="form-group col-sm-12 table-responsive">
                <label for="valor_total" class="">*Productos Asociados:</label>
                  <table class="table table-hover table-responsive" style="margin-top: 2%;" id="tbl-prod-aso-ped">
                    <thead>
                      <tr class="active">
                        <th>Referencia</th>
                        <th>Color</th>
                        <th>Cantidad a Producir</th>
                        <th>Valor Producto</th>
                        <th>Subtotal</th>
                        <th>Quitar</th>
                        <th><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#asoProductos"><b>Agregar</b></button></th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
                </div>
            </div>
            <div class="form-group col-sm-5">
              <label for="valor_total" class="">*Valor Total:</label>
              <input class="form-control" type="text" name="valor_total" id="valor_total" readonly="" style="border-radius:5px;">
            </div>
            <div class="modal-footer" style="border-top:none; border-bottom:1px solid;">
              <div class="form-group col-sm-12">
                <button type="submit" class="btn btn-primary" name="btnModificarPed">Guardar cambios</button>
                <button type="button" class="btn btn-danger" data-dissmis="modal" onclick="cancelar()">Cancelar</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- fin modal modificar pedido-->
       <!-- Incio modal cambiar estado pedido -->
      <div class="modal fade" id="dllProductosAso" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>Productos Asociados</b></h4>
            </div>
            <div class="modal-body" style="padding:10px;">
              <div class="table">
                <div class="form-group col-sm-12 table-responsive">
                  <table class="table table-hover table-responsive" style="margin-top: 2%;" id="dll-prod-asoped">
                    <thead>
                      <tr class="active">
                        <th>Referencia</th>
                        <th>Color</th>
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
            <div class="modal-footer" style="border-top:none; border-bottom:1px solid;">
              <button type="button" class="btn btn-primary" data-dismiss="modal"><b>Aceptar</b></button>
            </div>
          </div>
        </div>
      </div>
      <!-- fin modal cambiar estado pedido-->
      <!-- inicio modal asociar cliente-->
      <div class="modal fade" id="asoClientesHab" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>Clientes para asociar</b></h4>
            </div>
            <div class="modal-body" style="padding:10px;">
              <div class="table">
                <div class="col-sm-12 table-responsive">
                <table class="table table-responsive" id="tblClientesAsoHab">
                <thead>
                  <tr class="active">
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Agregar</th>
                  </tr>
                </thead>
                <tbody>
                <?php $a = 1; ?>
                <?php foreach ($clientes as $cliente): ?>
                  <tr>
                    <td><?= $cliente["Num_Documento"] ?></td>
                    <td><?= $cliente["Nombre"] ?></td>
                    <td><?= $cliente["Telefono"] ?></td>
                    <td><?= $cliente["Email"] ?></td>
                    <td>
                      <button id="btnAgregar<?= $a; ?>" type="button" class="btn btn-box-tool" onclick="asoClienteModifPedido('<?= $cliente["Nombre"] ?>', <?= $cliente["Num_Documento"] ?>, this, '<?= $a; ?>')"><i class="fa fa-plus"></i></button>
                    </td>
                  </tr>
                  <?php $a++; ?>
                <?php endforeach; ?>
                </tbody>
              </table>
              </div>
              </div>
            </div>
            <div class="modal-footer" style="border-top:none; border-bottom:1px solid;">
              <button type="button" class="btn btn-primary" data-dismiss="modal"><b>Aceptar</b></button>
            </div>
          </div>
        </div>
      </div>
      <!-- fin modal asociar cliente-->
      <!-- Inicio modal asociar productos(fichas) -->
      <div class="modal fade" id="asoProductos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>Productos para asociar</b></h4>
            </div>
            <div class="modal-body" style="padding:10px;">
              <div class="table">
                <div class="col-sm-12 table-responsive">
                <table class="table table-responsive" id="">
                <thead>
                  <tr class="active">
                    <th>Ref</th>
                    <th>Color</th>
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
                    <td><i class="fa fa-square" style="color:<?= $producto["Codigo_Color"] ?>; font-size: 150%;"></i></td>
                    <td><?= $producto["Valor_Produccion"] ?></td>
                    <td><?= $producto["Valor_Producto"] ?></td>
                    <td>
                      <button id="btn<?= $producto["Referencia"] ?>" type="button" class="btn btn-box-tool" onclick="asociarProductosModiPedido('<?= $producto["Id_Ficha_Tecnica"] ?>', '<?= $producto["Referencia"] ?>', '<?= $producto["Codigo_Color"] ?>', '<?= $producto["Valor_Producto"] ?>', this, '<?= $p; ?>')"><i class="fa fa-plus"></i></button>
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
              <button type="button" class="btn btn-primary" data-dismiss="modal"><b>Aceptar</b></button>
            </div>
          </div>
        </div>
      </div>
      <!-- fin modal asociar productos(fichas) -->
    </section>

