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
                        <th style="width: 7%">Cambiar Estado</th>
                      </tr>
                    </thead>
                    <tbody class="list">
                    <?php foreach ($pedidos as $pedido): ?>
                      <tr>
                        <td><?= $pedido["Id_Pedido"] ?></td>
                        <td class="freg"><?= $pedido["Fecha_Registro"] ?></td>
                        <td class="ftga"><?= $pedido["Fecha_Entrega"] ?></td>
                        <td class="vtal"><?= $pedido["Valor_Total"] ?></td>
                        <td><?= $pedido["Nombre_Estado"] ?></td>
                        <td class="nomclte"><?= $pedido["Nombre"] ?></td>
                        <td>
                          <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#modalEditPedido" onclick="editarPedido('<?= $pedido["Id_Pedido"] ?>', this);" ><i class="fa fa-pencil-square-o" name="btncarg"></i></button>
                        </td>
                        <td>
                          <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#modalEditarEstado"><i class="fa fa-refresh" name="btncargarEstado" onclick="editarEstadoPedido('<?= $pedido["Id_Pedido"] ?>', this);"></i></button>
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
              <form role="form" action="<?= URL ?>pedido/editarPedido" method="post" id="modpedido">
                <div class="form-group col-sm-4">
                  <label for="id_pedido" class="">Id Pedido:</label>
                  <input class="form-control" type="text" name="id_pedido" id="id_pedido" readonly="" style="border-radius:5px;">
                </div>
                <div class="form-group col-sm-4">
                  <label class="">Fecha Registro:</label>
                  <div class="input-group date">
                    <div class="input-group-addon" style="border-radius:5px;">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control" readonly type="text" name="fecha_reg" id="fecha_reg" style="border-radius:5px;">
                  </div>
                </div>
                <div class="form-group col-sm-4">
                  <label for="estado" class="">Estado:</label>
                  <input class="form-control" type="text" readonly name="estado" id="estado" style="border-radius:5px;">
                </div>
                <div class="form-group col-sm-4">
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
                <div class="form-group col-sm-4">
                  <label for="nombrecliente" class="">*Cliente:</label>
                  <input class="form-control" type="text" name="nombrecliente" readonly="" id="nombrecliente" style="border-radius:5px;">
                </div>
                <div class="form-group col-sm-4"> 
                  <label for="valor_total" class="">*Valor Total:</label>
                  <input class="form-control" type="text" name="valor_total" id="valor_total" style="border-radius:5px;">
                </div>
            </div>
            <div class="modal-footer" style="border-top:none; border-bottom:1px solid;">
              <button type="submit" class="btn btn-primary" name="btnModificarPed" onclick="confirmarCambioEstado()">Guardar cambios</button>
              <button type="button" class="btn btn-danger" data-dissmis="modal" onclick="cancelar()">Cancelar</button>
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
              <form role="form" action="<?= URL ?>pedido/cambiarEstadoPedido" method="post" id="modalEditarEstado">
                <input class="form-control" type="hidden" name="id_pedidoMod" id="id_pedidoMod">
                <div class="form-group col-sm-6">
                  <label for="estado" class="">Estado Actual:</label>
                  <select class="form-control" name="estadoMod" id="estadoMod" style="border-radius:5px;">
                    <option value="1">Pendiente</option>
                    <option value="2">En Proceso</option>
                    <option value="3">Terminado</option>
                    <option value="4">Cancelado</option>
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
    </section>

