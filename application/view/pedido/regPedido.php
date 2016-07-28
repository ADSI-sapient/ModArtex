    <section class="content-header">
      <br>
      <ol class="breadcrumb">
        <li><a href="<?php echo URL; ?>home/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Pedido</a></li>
        <li class="active">Registrar Pedido</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="box box-primary" style="padding-right: 15px;">
        <div class="box-header with-border" style="text-align: center;">
          <h3 class="box-title"><strong>REGISTRAR PEDIDO</strong></h3>
        </div>
        <br>
        <form action="<?php echo URL; ?>ctrPedido/regPedido" method="POST"  onsubmit="return enviarFormPedido();">
        <!-- <input type="hidden" name="id_tipo" value="2" id="id_tipo"> -->
          <div class="row col-lg-12">
            <div class="form-group col-lg-4">
              <label class="">Fecha Registro:</label>
              <div class="">
                <div class="input-group date">
                  <div class="input-group-addon" style="border-radius:5px;">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="fecha_reg" id="" placeholder="" required="" style="border-radius:5px;" min="2016-06-01" step="1" readonly="" value="<?php echo date("Y-m-d");?>">
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
                  <input type="text" class="form-control pull-right" name="fecha_entrega" id="datepicker2" required=""  style="border-radius:5px;">
                </div>
              </div>
            </div>
            <div class="form-group col-lg-4">
              <label for="estado" class="">*Estado:</label>
              <input type="text" name="estado" class="form-control" id="estado" value="Pendiente" required="" readonly="" style="border-radius:5px;">
            </div>
          </div>
          <div class="row col-lg-12">
            <div class="form-group col-lg-4">
              <label for="aso_cliente" class="">*Asociar Cliente:</label>
              <div class="">
                <div class="input-group">
                  <input type="text" name="nombre" class="form-control" id="nombre" readonly="" required="" style="border-radius:5px;">
                  <input type="hidden" name="id_cliente"  id="id_cliente" required="">
                  <div class="input-group-btn" style="border-radius:5px; margin-bottom:10%;">
                    <button type="button" style="border-radius:5px;" id="buscarCliente" class="btn btn-flat" data-toggle="modal" data-target="#asociarClientes"><i class="fa fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div hidden="" class="form-group" id="agregarFicha">
            <div class="table">
              <div class="col-lg-12 table-responsive">
                <table class="table table-hover" style="margin-top: 2%;" id="tablaFicha">
                  <thead>
                    <tr class="active">
                      <th>Referencia</th>
                      <th>Color</th>
                      <th>Valor Producto</th>
                      <th>Cantidad a Producir</th>
                      <th>Subtotal</th>
                      <th>Quitar</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="row col-lg-12">
            <div class="form-group col-lg-3">
              <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#asociarFichas"><b>Asociar Fichas</b></button>
            </div>
          </div>
          <div class="row col-lg-12">
     			  <div class="form-group col-lg-offset-8 col-lg-4">
              <label for="vlr_total" class="">*Valor Total:</label>
              <div class="">
                <!-- <div class="input-group">
                  <div class="input-group-btn" style="border-radius:5px; margin-bottom:10%;">
                    <button type='button' id="confir" onclick="calcularValorTotal()" class='btn btn-info'><b>Calcular</b></button>
                  </div> -->
                  <input type="text" name="vlr_total" class="form-control" id="vlr_total" readonly="" value="0" required="" style="border-radius:5px;">
                <!-- </div> -->
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <!-- <div class="form-group"> -->
              <div class="form-group col-lg-12">
                <button type="submit" class="btn btn-primary  col-lg-offset-9" style="margin-top: 15px;" name="btnRegPedido"><b>Registrar</b></button>
                <button type="reset" class="btn btn-danger" onclick="limpiarFormRegPedido()" style="margin-left: 15px; margin-top: 15px;"><b>Limpiar</b></button>
              </div>
            <!-- </div> -->
          </div>
        </form>
      </div>
      
      <!-- Inicio Modal asociar fichas -->
      <div class="modal fade" id="asociarFichas" tabindex="-1" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Fichas Técnicas</b></h4>
            </div>
            <div class="modal-body">
              <div class="table">
                <div class="col-sm-12 table-responsive">
                  <table class="table table-hover" style="margin-top: 2%;">
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
                      <td><?= $ficha["Color"] ?></td>
                      <td><?= $ficha["Valor_Produccion"] ?></td>
                      <td><?= $ficha["Valor_Producto"] ?></td>
                      <td>
                        <button id="btn<?= $i; ?>" type="button" class="btn btn-box-tool" onclick="asociarProductos('<?= $ficha["Referencia"] ?>', '<?= $ficha["Color"] ?>', '<?= $ficha["Valor_Producto"] ?>', this, '<?= $i; ?>')"><i class="fa fa-plus"></i></button>
                      </td>
                    </tr>
                    <?php $i++; ?>
                  <?php endforeach; ?>
                  </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal"><b>Aceptar</b></button>
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
              <button type="button" class="btn btn-primary" data-dismiss="modal"><b>Aceptar</b></button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      <!-- Fin modal asociar cliente -->
    </section>