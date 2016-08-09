    <!-- Content Header (Page header) -->
    <section class="content-header">
      <br>
      <ol class="breadcrumb">
        <li><a href="<?php echo URL; ?>home/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Ficha Técnica</a></li>
        <li class="active">Registrar Ficha</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="box box-primary" style="padding-right: 15px;">
        <div class="box-header with-border" style="text-align: center;">
          <h3 class="box-title"><strong>REGISTRAR FICHA TÉCNICA</strong></h3>
        </div>
        <br>
        <form action="<?php echo URL; ?>ctrFicha/regFicha" method="POST" onsubmit="return enviarFormFicha();">
          <div class="row col-lg-12">
            <div class="form-group col-lg-2">
              <label for="referencia" class="">*Referencia:</label>
              <input type="text" name="referencia" class="form-control" id="referencia" autofocus="" required="" style="border-radius:5px;">
            </div>
            <div class="form-group col-lg-offset-1 col-lg-4">
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
            <div class="form-group col-lg-offset-1 col-lg-4">
              <label for="estado" class="">*Estado:</label>
              <input type="text" name="estado" class="form-control" id="estado" value="Habilitado" required="" readonly="" style="border-radius:5px;">
            </div>
          </div>
          <div class="row col-lg-12">
            <div class="form-group col-lg-1">
              <label class="">*Color:</label>
              <div class="">
                <div class="input-group my-colorpicker2 colorpicker-element">
                  <input type="hidden" name="codigo-color" class="form-control" id="codigo-color" readonly="" value="#60c2e0" style="border-radius:5px;">
                  <div class="input-group-addon" style="border-radius:5px; padding:16px;">
                    <div></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group col-lg-offset-2 col-lg-4">
            <label for="tallas" class="" >*Tallas:</label>
            <select class="form-control" required="" multiple="" style="border-radius:5px;" id="selectTallas" name="tallas[]">
              <option value="1">L</option>
              <option value="2">M</option>
              <option value="3">S</option>
            </select>
            </div>
            <div class="form-group col-lg-offset-1 col-lg-4">  
              <label for="stock_minimo" class="">*Stock Mínimo:</label>
              <input type="text" name="stock_min" class="form-control" id="stock_minimo" placeholder="" value="" required="" style="border-radius:5px;">
            </div>
          </div>
          <div class="row col-lg-12">
            <div class="form-group col-lg-3">
              <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#asoInsum"><b>Asociar Insumos</b></button>
            </div>
          </div>
          <div hidden="" class="form-group" id="agregarInsumo">
            <div class="table">
              <div class="col-lg-12 table-responsive">
                <table class="table table-hover" style="margin-top: 2%;" id="tablaInsumos">
                  <thead>
                    <tr class="active">
                      <th>Id Insumo</th>
                      <th>Nombre</th>
                      <th>Color</th>
                      <th>Unidad Medida</th>
                      <th>Valor*cm</th>
                      <th>Cantidad Necesaria</th>
                      <th>Valor Insumo</th>
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
            <div class="form-group col-lg-4">
              <label for="vlr_produccion" class="">Valor Producción:</label>
              <div class="">
                <!-- <div class="input-group">
                  <div class="input-group-btn" style="border-radius:5px; margin-bottom:10%;">
                    <button type='button' id="confir" onclick="calcularVlrProd()" class='btn btn-info'><b>Calcular</b></button>
                  </div> -->
                  <input type="number" min="1" name="vlr_produccion" class="form-control" id="vlr_produccion" readonly="" value="0" style="border-radius:5px;">
                <!-- </div> -->
              </div>
            </div>

            <div class="form-group col-lg-offset-4 col-lg-4">  
              <label for="vlr_producto" class="">*Valor Producto:</label>
              <input type="text" name="vlr_producto" class="form-control" id="vlr_producto" placeholder="" value="" required="" style="border-radius:5px;">
            </div>
            <input id="subtotal" name="subtotal" type="hidden" value="0">
            <input id="total" name="total" type="hidden" value="0">
          </div>
          <br>
          <div class="row"> 
            <div class="form-group col-lg-12">
              <button type="submit" class="btn btn-primary col-lg-offset-9" style="margin-top: 15px;" name="btnRegFicha" id="reg"><b>Registrar</b></button>
              <button type="reset" class="btn btn-danger" style="margin-left: 15px; margin-top: 15px;" name="btnCanFicha" onclick="limpiarFormRegFicha()"><b>Limpiar</b></button>
            </div>
          </div>
        </form>
      </div>
      <!-- Inicio Modal asociar insumos -->
      <div class="modal fade" id="asoInsum" tabindex="-1" role="dialog" >
        <div class="modal-dialog">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Insumos Para Asociar</b></h4>
            </div>
            <div class="modal-body">
              <div class="table">
                <div class="col-sm-12 table-responsive">
                  <table class="table table-hover" style="margin-top: 2%;">
                  <thead>
                    <tr class="active">
                      <th>Id Insumo</th>
                      <th>Nombre</th>
                      <th>Unidad Medida</th>
                      <th>Color</th>
                      <th>Estado</th>
                      <th>Valor Promedio</th>
                      <th>Agregar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($insumosHabAsociar as $insumo): ?>
                      <tr>
                        <td><?= $insumo["Id_Insumo"] ?></td>
                        <td><?= $insumo["Nombre"] ?></td>
                        <td><?= $insumo["Abreviatura"] ?></td>
                        <td><i class="fa fa-square" style="color: <?= $insumo["Codigo_Color"] ?>; font-size: 200%;"></i></td>
                        <td><?= $insumo["Estado"]==1?"Habilitado":"Inhabilitado" ?></td>
                        <td><?= round($insumo["Valor_Promedio"], 2) ?></td>
                        <td>
                          <button id="btn<?= $i; ?>" type="button" class="btn btn-box-tool" onclick="asociarInsumosHab('<?= $insumo["Id_Insumo"] ?>', '<?= $insumo["Nombre"] ?>', '<?= $insumo["Codigo_Color"] ?>' , this, '<?= $i; ?>', '<?= $insumo["Estado"] ?>', '<?= $insumo["Valor_Promedio"] ?>')"><i class="fa fa-plus"></i></button>
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
    </section>