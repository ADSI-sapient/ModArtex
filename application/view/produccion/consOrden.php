    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="<?php echo URL ?>home/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Producción</a></li>
        <li class="active">Consultar Orden</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="box box-info">
        <div class="box-header with-border"  style="text-align: center;">
          <h3 class="box-title"><strong>LISTAR ÓRDENES DE PRODUCCIÓN</strong></h3>
        </div>
        <div id="ordenesP">
          <form class="form-horizontal">
            <div class="col-md-12">
              <div class="table table-responsive">
                <table class="table table-hover" id="tblOrdenes">
                  <thead>
                    <tr class="">
                      <th>#</th>
                      <th>Fecha Registro</th>
                      <th>Fecha Terminación</th>
                      <th>Estado</th>
                      <th>Lugar</th>
                      <th>Editar</th>
                      <th>Generar O.P</th>
                      <th>Cancelar</th>
                    </tr>
                  </thead>
                  <tbody class="list">
                  <?php foreach ($ordenesProduccion as $ordenProduccion): ?>
                    <tr>
                      <td><?= $ordenProduccion["Num_Orden"] ?></td>
                      <td><?= $ordenProduccion["Fecha_Registro"] ?></td>
                      <td><?= $ordenProduccion["Fecha_Entrega"] ?></td>
                      <td style="display:none;"><?= $ordenProduccion["Id_Estado"] ?></td>
                      <td><?= $ordenProduccion["Nombre_Estado"] ?></td>
                      <td><?= $ordenProduccion["Lugar_Produccion"] ?></td>
                      <td style="display:none;"><?= $ordenProduccion["Num_Documento"] ?></td>
                      <td style="display:none;"><?= $ordenProduccion["Id_Solicitud"] ?></td>
                      <td style="display:none;"><?= $ordenProduccion["Nombre"] ?></td>
                      <td>
                      <?php if ($ordenProduccion["Id_Estado"] == 4): ?>
                        <button disabled="" type="button" class="btn btn-box-tool"><i class="fa fa-pencil-square-o fa-lg"></i></button>
                        <?php else: ?>
                        <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#mdlEditOrdenP" id="btnAgregar<?= $b; ?>" onclick="editarOrdeP('<?= $ordenProduccion["Num_Orden"] ?>', this); FichasAsoOrd('<?= $ordenProduccion["Num_Orden"] ?>')"><i class="fa fa-pencil-square-o fa-lg" name="btncarg"></i></button>
                      <?php endif ?>
                      </td>
                      <td>
                      <?php if ($ordenProduccion["Id_Estado"] == 4): ?>
                        <button disabled="" type="button" class="btn btn-box-tool" ><i class="fa fa-file-pdf-o fa-lg"></i></button>
                        <?php else: ?>
                        <button type="button" class="btn btn-box-tool" ><i class="fa fa-file-pdf-o fa-lg" name="btncarg"></i></button>
                      <?php endif ?>
                      </td>
                      <td>
                      <?php if ($ordenProduccion["Id_Estado"] == 4): ?>
                        <button disabled="" type="button" class="btn btn-box-tool"><i class="fa fa-ban fa-lg" style="color:red"></i></button>
                      <?php else: ?>
                        <button type="button" class="btn btn-box-tool" onclick="cancelarOrdenP('<?= $ordenProduccion["Num_Orden"] ?>');" id="btn-cancel-ord"><i class="fa fa-ban fa-lg" style="color:red"></i></button>
                      <?php endif ?>
                      </td>
                    </tr>
                  <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </form>
        </div>
        <div class="box-footer"></div> 
      </div>
    </section> 
  <!-- Incio modal modificar orden -->
    <div class="modal fade" id="mdlEditOrdenP" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius:10px;">
            <div class="modal-header">
              <button type="button" class="close" onclick="cancelar()"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>Modificar Orden de Producción</b></h4>
            </div>
            <div class="modal-body" style="padding:10px;">
              <form role="form" action="<?= URL ?>ctrProduccion/editarOrdenProduccion" method="post" id="dtllOrden">
              <input type="hidden" name="numOrdenp" id="numOrdenp">
                  <div class="form-group col-sm-5">
                  <label class="">Fecha Registro:</label>
                  <div class="input-group date">
                    <div class="input-group-addon" style="border-radius:5px;">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control" readonly type="text" id="fecha_regOp" style="border-radius:5px;">
                  </div>
                </div>
                <div class="form-group col-sm-offset-2 col-sm-5">
                  <!-- <label for="estadoOp" class="">Estado:</label>
                  <input type="text" id="estadoOp" class="form-control" value="" readonly="" style="border-radius:5px;"> -->
                    <label for="estadoOp" class="">*Estado:</label>
                    <select class="form-control" name="estadoOp" id="estadoOp" style="border-radius:5px;">
                      <option value="5">Pendiente</option>
                      <option value="10">Producción</option>
                      <option value="7">Terminada</option>
                    </select>
                </div>
                    <div class="form-group col-sm-5">
                    <label class="">*Fecha Terminación:</label>
                    <div class="">
                      <div class="input-group date">
                        <div class="input-group-addon" style="border-radius:5px;">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" name="fecha_entregaOp" id="fecha_entregaOp" style="border-radius:5px;">
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-offset-2 col-sm-5">
                    <label for="clienteOrdn" class="">Cliente:</label>
                    <br>
                    <select onchange="asoPedAOrden(this);" class="form-control" name="clienteOrdn" id="clienteOrdn">
                      <?php foreach ($pedidosCliente as $cliente): ?>
                        <option value="<?= $cliente["Id_Solicitud"] ?>"><?= $cliente["Nombre"] ." - Pedido: ". $cliente["Id_Solicitud"]?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="form-group col-sm-5">
                    <label for="lugarOp" class="">*Lugar Producción:</label>
                    <select class="form-control" name="lugarOp" id="lugarOp" style="border-radius:5px;">
                      <option value="Fábrica">Fábrica</option>
                      <option value="Satélite">Satélite</option>
                      <option value="Fábrica-Satélite">Fábrica/Satélite</option>
                    </select>
                  </div>
                  <!-- <button type="button" class="btn btn-primary pull-right" style="margin-top: 4.7%; margin-right:2.6%;" data-toggle="modal" data-target="#asociarPedidMod">Asociar Pedido</button> -->
                <div class="table">
              <div class="col-sm-12 table-responsive">
                <table class="table table-hover" style="margin-top: 2%;" id="tblFichasProducc">
                  <thead>
                    <tr class="active">
                      <th>Referencia</th>
                      <th>Color</th>
                      <th>Cantidad Total</th>
                      <th>Cantidad Fábrica</th>
                      <th>Cantidad Satélite</th>
                      <th>Lugar</th>
                      <th>Estado</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
            </div>
            <div class="modal-footer" style="border-top:none;">
              <div class="form-group col-sm-12">
                <button type="submit" class="btn btn-primary" name="btnModificarOrd">Guardar cambios</button>
                <button type="button" class="btn btn-danger" data-dissmis="modal" onclick="cancelar()">Cancelar</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- fin modal modificar orden-->
      <!-- Inicio Modal asociar pedidos -->
      <div class="modal fade" id="asociarPedidMod" tabindex="-1" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Pedidos Para Producir</b></h4>
            </div>
            <div class="modal-body">
              <div class="table">
                <div class="col-sm-12 table-responsive">
                  <table class="table table-responsive table-hover" style="margin-top: 2%;" id="">
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
                        <td class="vtal"><?= $pedido["Valor_Total"] ?></td>
                        <td><?= $pedido["Nombre_Estado"] ?></td>
                        <td class="nomclte"><?= $pedido["Nombre"] ?></td>
                        <td>
                          <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#" id="" onclick="cargarProductosAsoPed('<?= $pedido["Id_Solicitud"] ?>', 0)"><i class="fa fa-eye fa-lg" style="color:#3B73FF"></i></button>
                        </td>
                        <td>
                          <button id="btn<?= $i; ?>" type="button" class="btn btn-box-tool" onclick="cargarProductosAsoPed('<?= $pedido["Id_Solicitud"] ?>', '<?= $pedido["Fecha_Entrega"] ?>', 2)"><i class="fa fa-plus"></i></button>
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
              <button type="button" class="btn btn-primary" data-dismiss="modal"><b>Aceptar</b></button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      <!-- Fin modal asociar pedidos -->