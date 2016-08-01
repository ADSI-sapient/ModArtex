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
                        <th style="width: 7%">CE</th>
                        <th style="width: 7%">Cancelar</th>
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
                          <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#modalEditPedido" onclick="editarPedido('<?= $pedido["Id_Solicitud"] ?>', this); cargarProductosAsoPed('<?= $pedido["Id_Solicitud"] ?>')"><i class="fa fa-pencil-square-o" name="btncarg"></i></button>
                        </td>
                        <td>
                          <!-- <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#modalEditarEstado"><i class="fa fa-refresh" name="btncargarEstado" onclick="editarEstadoPedido('<?= $pedido["Id_Solicitud"] ?>', this);"></i></button> -->
                        </td>
                        <td>
                          <button type="button" class="btn btn-box-tool"><i class="fa fa-ban"></i></button>
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
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
              <button type="button" class="close" onclick="cancelar()"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>Modificar Pedido</b></h4>
            </div>
            <div class="modal-body" style="padding:10px;">
              <form role="form" action="<?= URL ?>ctrPedido/editarPedido" method="post" id="modpedido">
                <!-- <div class="form-group col-sm-4">
                  <label for="id_pedido" class="">Id Pedido:</label>
                  <input class="form-control" type="text" name="id_pedido" id="id_pedido" readonly="" style="border-radius:5px;">
                </div> -->
                <input type="hidden" name="id_pedido" id="id_pedido">
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
                  <label for="estado" class="">Estado:</label>
                  <input class="form-control" type="text" readonly name="estado" id="estado" style="border-radius:5px;">
                </div>
                <div class="form-group col-sm-6">
                  <label class="">*Fecha Entrega:</label>
                  <div class="">
                    <div class="input-group date">
                      <div class="input-group-addon" style="border-radius:5px;">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" name="fecha_entrega" id="fecha_entrega" required=""  style="border-radius:5px;">
                    </div>
                  </div>
                </div>
                <div class="form-group col-sm-6">
                  <label for="nombrecliente" class="">*Asociar Cliente:</label>
                  <div class="">
                    <div class="input-group">
                      <input type="text" name="nombreCliente" class="form-control" id="nombreCliente" readonly="" required="" style="border-radius:5px;">
                      <input type="hidden" name="doc_cliente"  id="doc_cliente" required="">
                      <div class="input-group-btn" style="border-radius:5px; margin-bottom:10%;">
                        <button type="button" style="border-radius:5px;" id="buscarCliente" class="btn btn-flat" data-toggle="modal" data-target="#asoClientesHab"><i class="fa fa-search"></i>
                          </button>
                      </div>
                    </div>
                  </div>
                </div>
                <label for="valor_total" class="">*Productos Asociados:</label>
                <div class="table">
                <div class="form-group col-sm-12">
                  <table class="table table-hover" style="margin-top: 2%;" id="tbl-prod-aso-ped">
                    <thead>
                      <tr class="active">
                        <th>Referencia</th>
                        <th>Color</th>
                        <th>Valor Producto</th>
                        <th>Cantidad a Producir</th>
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
            <div class="form-group col-sm-6">
              <label for="valor_total" class="">*Valor Total:</label>
              <input class="form-control" type="text" name="valor_total" id="valor_total" readonly="" style="border-radius:5px;">
            </div>
            <div class="modal-footer" style="border-top:none; border-bottom:1px solid;">
              <div class="form-group col-sm-12">
                <button type="submit" class="btn btn-primary" name="btnModificarPed" onclick="confirmarCambioEstado()">Guardar cambios</button>
                <button type="button" class="btn btn-danger" data-dissmis="modal" onclick="cancelar()">Cancelar</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- fin modal modificar pedido-->
       <!-- Incio modal cambiar estado pedido -->
      <div class="modal fade" id="modalEditarEstado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
              <button type="button" class="close" onclick="cerrar()"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>Cambiar Estado Pedido</b></h4>
            </div>
            <div class="modal-body" style="padding:10px;">
              <form role="form" action="<?= URL ?>ctrPedido/cambiarEstadoPedido" method="post" id="modalEditarEstado">
                <input class="form-control" type="hidden" name="id_pedidoMod" id="id_pedidoMod">
                <div class="form-group col-sm-6">
                  <label for="estado" class="">Estado Actual:</label>
                  <select class="form-control" name="estadoMod" id="estadoMod" style="border-radius:5px;">
                    <option value="2">Pendiente</option>
                    <option value="3">En Proceso</option>
                    <option value="4">Terminado</option>
                    <option value="5">Cancelado</option>
                  </select>
                </div>
            </div>
            <div class="modal-footer" style="border-top:none; border-bottom:1px solid;">
              <button type="submit" class="btn btn-primary" name="btnCambiarEstadoPed">Cambiar Estado</button>
              <button type="button" class="btn btn-danger" data-dissmis="modal" onclick="cerrar()">Cancelar</button>
              </form>
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
                    <button>+</button>
                      <!-- <button id="btnAgregar<?= $c; ?>" type="button" class="btn btn-box-tool" onclick="asociarCliente('<?= $cliente["Nombre"] ?>', <?= $cliente["Num_Documento"] ?>, this, '<?= $c; ?>')"><i class="fa fa-plus"></i></button> -->
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
    </section>

