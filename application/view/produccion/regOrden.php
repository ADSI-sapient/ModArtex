<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="<?php echo URL; ?>home/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="#">Producción</a></li>
    <li class="active">Registrar Orden</li>
  </ol>
</section>
<section class="content">
 <br>
 <div>
  <div  class="box box-info">
    <div class="box-header with-border">
      <h1 class="box-title"><strong>REGISTRAR ORDEN</strong></h1>
    </div>
    <!-- <div style="padding-left: 8%;"> -->
    <form style="padding-top:10px;" action="<?php echo URL; ?>ctrProduccion/regOrden" method="POST">
    <input type="hidden" name="id_solTud" id="id_solicitud">
      <div class="row col-lg-12" style="margin-left:1%">
        <div class="form-group col-lg-4">
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

        <div class="form-group col-lg-offset-1 col-lg-4">
          <label for="estadoProdu" class="">*Estado:</label>
          <input type="text" name="estadoProdu" class="form-control" id="estadoProdu" value="Pendiente" readonly="" style="border-radius:5px;">
        </div>


        <div class="form-group  col-lg-3">
        <div style="">
          <button type="button" style="margin-top: 11%; margin-left:45%;" id="asociarPedi" class="btn btn-info btn-md" data-toggle="modal" data-target="#asociarPedid"><b>Asociar Pedido</b></button>
        </div>
        </div>
      </div>
      <div class="row col-lg-12" style="margin-left:1%">
        
        <div class="form-group col-lg-4">
          <label class="">*Fecha de Terminación:</label>
          <div class="">
            <div class="input-group date">
              <div class="input-group-addon" style="border-radius:5px;">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" name="fecha_terminacion" id="fecha_terminacion" style="border-radius:5px;">
            </div>
          </div>
        </div>
        <div class="form-group col-lg-offset-1 col-lg-4">
          <label for="lugarPrd" class="">*Lugar:</label>
          <select class="form-control" name="lugarPrd">
            <option value="Fábrica">Fábrica</option>
            <option value="Satélite">Satélite</option>
            <option value="Fábrica-Satélite">Fábrica/Satélite</option>
          </select>
        </div>
      </div>
          <div hidden="" class="form-group" id="agregarFichaProd">
            <div class="table">
              <div class="col-lg-12 table-responsive">
                <table class="table table-hover" style="margin-top: 2%;" id="tblFichasProd">
                  <thead>
                    <tr class="active">
                      <th>Referencia</th>
                      <th>Color</th>
                      <th>Cantidad a Producir</th>
                      <th>Valor Producto</th>
                      <th>Subtotal</th>
                      <th>Satélite</th>
                      <th>Lugar</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
            </div>
          <!-- </div> -->
  <div class="row text-right" style="margin-right: 2%;">
    <div class="form-group col-lg-04 " >
      <button type="submit" class="btn btn-primary col-lg-offset-9" style="margin-top: 15px; padding-left:2%; padding-right:2%;" name="btnRegistrarProdu">Registrar</button>
      <button type="reset"  class="btn btn-danger" style="margin-right:1%; margin-left:4.6%; margin-top: 15px; padding-left:2%; padding-right:2%" >Limnpiar</button>
    </div>
  </div>
</form>
</div>
</section>
<!-- Inicio Modal asociar pedidos -->
      <div class="modal fade" id="asociarPedid" tabindex="-1" role="dialog">
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
                          <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#dllPedidosProd" id="" onclick="cargarProductosAsoPed('<?= $pedido["Id_Solicitud"] ?>', 0)"><i class="fa fa-eye fa-lg" style="color:#3B73FF"></i></button>
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
            <div class="modal fade" id="dllPedidosProd" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>Productos Asociados</b></h4>
            </div>
            <div class="modal-body" style="padding:10px;">
              <div class="table">
                <div class="form-group col-sm-12 table-responsive">
                  <table class="table table-hover table-responsive" style="margin-top: 2%;" id="dtlle-pedido-prod">
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
      <!-- fin modal productos asociados pedido-->

