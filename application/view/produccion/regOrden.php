
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="../../starter2.html"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="#">Producción</a></li>
    <li class="active">Registrar Orden</li>
  </ol>
</section>

<section class="content">
 <br>
 <div>
  <div  class="box box-info">
    <div class="box-header with-border" style="text-align: center;">
      <h1 class="box-title"><strong>REGISTRAR ORDEN</strong></h1>
    </div>
    <div style="padding-left: 8%;">
    <form style="padding-top:10px;" action="<?php echo URL; ?>ctrProduccion/regOrden" method="POST">
      <div class="row">
      <div class="form-group col-lg-4">
        <label class="">Fecha Registro</label>
        <div class="">
          <div class="input-group date">
            <div class="input-group-addon" style="border-radius:5px;">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" name="fecha_registro" id="fecha_registro" value="<?php echo date("Y-m-d");?>" readonly="">
          </div>
        </div>
      </div>
      <div class="form-group col-lg-offset-1 col-lg-4">
        <label class="">Fecha de Terminación</label>
        <div class="">
          <div class="input-group date">
            <div class="input-group-addon" style="border-radius:5px;">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" name="fecha_terminacion" id="fecha_terminacion" readonly="">
          </div>
        </div>
      </div>
      <div class="form-group  col-lg-3">
      <div style="">
        <button type="button" style="margin-top: 11%;" id="asociarPedi" class="btn btn-info btn-md" data-toggle="modal" data-target="#asociarPedid">Asociar Pedido</button>
      </div>
      </div>
      </div>
      <div class="row">
      <div class="form-group col-lg-4">
        <label for="estado" class="" name="estadoProdu">Estado</label>
        <select class="form-control">
          <option value="opcion1" selected>Producción</option>
          <option value="opcion2">Cálidad</option>
          <option value="opcion3">Terminado </option>
        </select>
      </div>
     <div class="form-group col-lg-offset-1 col-lg-4">
      <label for="lugar" class="">Lugar</label>
      <select class="form-control" name="lugar">
        <option value="opcion1" selected>Fábrica</option>
        <option value="opcion2">Satélite</option>
      </select>
    </div>
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
                      <th id="cantidadSat" style="display:none">Cantidad</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
            </div>
<!--     <div class="table table-responsive">
     <h4>Producto Terminado Seleccionado</h4>
     <table class="table table-hover" id="tblFichasProd">
      <thead>
        <tr>
          <th class="col-lg-2">#</th>
          <th class="col-lg-2">Referencia</th>
          <th class="col-lg-2">Talla</th>
          <th class="col-lg-2">Disponible</th>
          <th class="col-lg-2">Cantidad</th>
          <th style="width: 40px">Quitar</th>
          <th><button type="button" class="btn btn-default btn-xs" type="button"><b>+</b></button></th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    
  </div>
  <div class="box-footer">
    <div class="box-tools">
      <ul class="pagination pagination-sm no-margin pull-right">
        <li class="disabled"><a href="#">«</a></li>
        <li class="active"><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">»</a></li>
      </ul>
    </div>
  </div> -->
  <div class="row text-right" style="margin-right: 2%;">
    <div class="form-group col-lg-04 " >
      <button type="button" class="btn btn-primary  col-lg-offset-9" style="margin-top: 15px;" name="btnRegistrarProdu">Registrar</button>
      <button type="reset" class="btn btn-danger" style="margin-left: 15px; margin-top: 15px;">Cancelar</button>
    </div>
  </div>
</form>
<div class="modal fade" id="regiOrden" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Mensaje</h4>
      </div>
      <div class="modal-body">
        Orden de Producción Registrada Existosamente!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>
</div>
</section>
<!-- Inicio Modal asociar fichas -->
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
      <!-- Fin modal asociar fichas -->
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

