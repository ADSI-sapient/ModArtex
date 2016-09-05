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
        <form action="<?php echo URL; ?>ctrPedido/regPedido" method="POST" onsubmit="return enviarFormPedido();">
        <input type="hidden" name="cantDesc[]" value="" id="cantDesc"> 
        <input type="hidden" name="idExistColr[]" value="" id="idExistColr"> 
          <div class="row col-lg-12" style="margin-left:1%">
            <div class="form-group col-lg-4">
              <label class="">Fecha Registro:</label>
              <div class="">
                <div class="input-group date">
                  <div class="input-group-addon" style="border-radius:5px;">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="fecha_reg" id="" placeholder="" style="border-radius:5px;" min="2016-06-01" step="1" readonly="" value="<?php echo date("Y-m-d");?>">
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
                  <input type="text" class="form-control pull-right" name="fecha_entrega" id="fecha_entrega"  style="border-radius:5px;">
                </div>
              </div>
            </div>
            <div class="form-group col-lg-4">
              <label for="estado" class="">*Estado:</label>
              <input type="text" name="estado" class="form-control" id="estado" value="Pendiente" readonly="" style="border-radius:5px;">
            </div>
          </div>
          <div class="row col-lg-12" style="margin-left:1%">
            <div class="form-group col-lg-4">
              <label for="id_cliente" class="" >*Asociar Cliente:</label>
              <select class="form-control" style="border-radius:5px;" name="id_cliente" id="id_cliente">
              <option value=""></option>
                <?php foreach ($clientes as $cliente): ?>
                  <option value="<?= $cliente["Num_Documento"] ?>"><?= $cliente["Num_Documento"] ." - ".$cliente["Nombre"]?></option>
                <?php endforeach ?>
              </select>
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
                      <th>Usar</th>
                      <th>Producto T</th>
                      <th style="display: none;"></th>
                      <th style="display: none;"></th>
                      <th>Quitar</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
            </div>
            <div class="row col-lg-12" style="margin-left:1%">
              <div class="form-group col-lg-3">
                <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#asociarFichas"><b>Asociar Productos</b></button>
              </div>
            </div>
            <div class="row col-lg-12" style="margin-left:1%">
       			  <div class="form-group col-lg-offset-8 col-lg-4">
                <label for="vlr_total" class="">*Valor Total:</label>
                <div class="">
                    <input type="text" name="vlr_total" class="form-control" id="vlr_total" readonly="" value="0" style="border-radius:5px;">
                </div>
              </div>
            </div>
          <br>
          <div class="row"> 
            <div class="form-group col-lg-12">
                <button type="submit" class="btn btn-primary col-lg-offset-9" style="margin-top: 15px; padding-left:2%; padding-right:2%;" name="btnRegPedido" ><b>Registrar</b></button>
                <button type="reset" onclick="limpiarFormRegPedido()" class="btn btn-danger" style="margin-right:2%; margin-left:4%; margin-top: 15px; padding-left:2%; padding-right:2%">Limpiar</b></button>
              </div>
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
                      <td><i class='fa fa-square' style='color: <?= $ficha["Codigo_Color"] ?>; font-size: 150%;'></i></td>
                      <td><?= $ficha["Valor_Produccion"] ?></td>
                      <td><?= $ficha["Valor_Producto"] ?></td>
                      <td>
                        <button id="btn<?= $i; ?>" type="button" class="btn btn-box-tool" onclick="asociarProductos('<?= $ficha["Id_Ficha_Tecnica"] ?>', '<?= $ficha["Referencia"] ?>', '<?= $ficha["Codigo_Color"] ?>', '<?= $ficha["Valor_Producto"] ?>', this, '<?= $i; ?>', '<?= $ficha["Cantidad"] ?>')"><i class="fa fa-plus"></i></button>
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