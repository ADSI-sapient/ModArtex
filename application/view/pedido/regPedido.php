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
          <h3 class="box-title"><strong>REGISTRAR PEDIDO</strong></h3>
        </div>
        <form action="<?php echo URL; ?>ctrPedido/regPedido" method="POST" onsubmit="return enviarFormPedido();" id="frmRegPedido" data-parsley-validate="">
        <div class="box-body">
          <input type="hidden" name="cantDesc[]" value="" id="cantDesc"> 
          <input type="hidden" name="idExistColr[]" value="" id="idExistColr"> 
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
                  <input type="text" class="form-control pull-right" name="fecha_entrega" id="fecha_entrega" style="border-radius:5px;" data-parsley-required="" data-parsley-errors-container="#regPedidov">
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
            <div class="table scrolltablas">
              <div class="col-lg-12 table-responsive" style="padding: 0;">
                <table class="table table-hover table-bordered" style="margin-top: 2%;" id="tablaFicha">
                  <thead>
                    <tr class="active">
                      <th>Referencia</th>
                      <th>Color</th>
                      <th>Valor Producto</th>
                      <th>Cantidad a Producir</th>
                      <th>Subtotal</th>
                      <th>Usar</th>
                      <th>Producto T</th>
                      <th style="display: none;"></th>
                      <th style="display: none;"></th>
                      <th>Quitar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td id="tblFichasVacia" colspan="8" style="text-align:center;"></td>
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
                <div class="">
                    <input type="text" name="vlr_total" class="form-control" id="vlr_total" readonly="" value="0" style="border-radius:5px;">
                </div>
              </div>
              </div>
            </div>
      </div>
      <div class="box-footer">
        <button type="reset" onclick="limpiarFormRegPedido()" name="btnCanFicha" class="btn btn-default pull-right"  style="margin-left: 2%;"><i class="fa fa-eraser" aria-hidden="true"></i> Limpiar</button>
        <button type="submit" class="btn btn-success pull-right" name="btnRegPedido" ><i class="fa fa-check-circle" aria-hidden="true"></i> Registrar</button>
      </div>
    </form>
      </div>
      <!-- Inicio Modal asociar fichas -->
      <div class="modal fade" id="asociarFichas" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Productos Para Asociar</b></h4>
            </div>
            <div class="modal-body">
              <div class="table">
                <div class="col-sm-12 table-responsive">
                  <table class="table table-hover table-bordered" style="margin-top: 2%;" id="tblFichasAsp">
                  <thead>
                    <tr class="active">
                      <th>Referencia</th>
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
                      <td><?= $ficha["Estado"]==1?"Habilitado":"Inhabilitado" ?></td>
                      <td><i class='fa fa-square' style='color: <?= $ficha["Codigo_Color"] ?>; font-size: 150%;'></i></td>
                      <td><?= $ficha["Valor_Produccion"] ?></td>
                      <td><?= $ficha["Valor_Producto"] ?></td>
                      <td>
                        <button id="btn<?= $i; ?>" type="button" class="btn btn-box-tool btnfichas" onclick="asociarProductos('<?= $ficha["Id_Ficha_Tecnica"] ?>', '<?= $ficha["Referencia"] ?>', '<?= $ficha["Codigo_Color"] ?>', '<?= $ficha["Valor_Producto"] ?>', this, '<?= $i; ?>', '<?= $ficha["Cantidad"] ?>');"><i class="fa fa-plus"></i></button>
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
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
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