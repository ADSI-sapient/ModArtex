    <style>
      input[type=number]::-webkit-outer-spin-button,
      input[type=number]::-webkit-inner-spin-button {
          -webkit-appearance: none;
          margin: 0;
      }
      input[type=number] {
          -moz-appearance:textfield;
      }
    </style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="<?php echo URL; ?>home/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Ficha Técnica</a></li>
        <li class="active">Registrar Ficha</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border" style="text-align: center;">
          <h3 class="box-title"><strong>REGISTRAR FICHA TÉCNICA</strong></h3>
        </div>
        <form data-parsley-validate="" action="<?php echo URL; ?>ctrFicha/regFicha" method="POST" onsubmit="return enviarFormFicha();" id="frmRegFicha">
        <div class="box-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group col-lg-4">
                <label for="referencia" class="">*Referencia:</label>
                <input type="text" name="referencia" class="form-control" id="referencia" autofocus="" style="border-radius:5px;" data-parsley-required="" maxlength="25">
              </div>
              <div class="form-group col-lg-4">
                <label for="nombreFicha" class="">*Nombre:</label>
                <input type="text" name="nombreFicha" class="form-control" id="nombreFicha" style="border-radius:5px;" data-parsley-required="" maxlength="45">
              </div>
              <div class="form-group col-lg-4">
                <label class="">Fecha Registro:</label>
                <div class="">
                  <div class="input-group date">
                    <div class="input-group-addon" style="border-radius:5px;">
                      <i class="fa fa-calendar" style="font-size: 100%"></i>
                    </div>
                    <input type="text" class="form-control pull-right" name="fecha_reg" id="" placeholder="" style="border-radius:5px;" readonly="" value="<?php echo date("Y-m-d");?>">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group col-lg-4">
                <label for="estado" class="">Estado:</label>
                <input type="text" name="estado" class="form-control" id="estado" value="Habilitado" readonly="" style="border-radius:5px;" data-parsley-required="">
              </div>
              <div class="form-group col-lg-4">

                <label for="colorFicha">*Color:</label>
                <div class="input-group" >
                  <select onchange="coloresFichas()" class="form-control" name="colorFicha" id="colorFicha"  data-parsley-required="" data-parsley-errors-container="#coloresRegf">
                    <option value="" selected=""></option>
                    <?php foreach ($colores as $color): ?>
                      <option value='<?= $color["Id_Color"] ?>'><?= $color["Nombre"] ?></option>
                    <?php endforeach; ?>
                  </select>
                  <span class="input-group-addon"  style="background-color:white; border-radius:5px"><i class="fa fa-square" style="color:gray; font-size:150%;" id="colorF"></i></span>
                </div>
                <div id="coloresRegf"></div>
              </div>
              <div class="form-group col-lg-4">
                <label for="">*Tallas:</label>
                <select class="form-control" multiple="" style="border-radius:5px;" id="selectTallas" name="tallas[]" data-parsley-required="" style="width:75%" data-parsley-errors-container="#tallasRegf">
                  <option value="1">L</option>
                  <option value="2">M</option>
                  <option value="3">S</option>
                  <option value="4">2-4</option>
                  <option value="5">6-8</option>
                  <option value="6">10-12</option>
                  <option value="7">14-16</option>
                  <option value="8">UNICA</option>
                </select>
                <div id="tallasRegf"></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group col-lg-4">
                <label for="stock_minimo" class="">*Stock Mínimo:</label>
                <input type="number" name="stock_min" class="form-control" id="stock_minimo" placeholder="" value="" min="0" max="9999999" style="border-radius:5px;" data-parsley-required="">
              </div>
              <div class="form-group col-lg-offset-6 col-lg-2" style="margin-top: 25px;">
                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#asoInsum"><b>Insumos</b></button>
              </div> 
            </div>
          </div>
          <div class="row">
            <div class="col-md-12" id="agregarInsumo">
            <div class="col-md-12">
              <label>*Insumos Asociados:</label>
              <div class="table scrolltablas" style="margin-top: 2%;">
                <div class="col-lg-12 table-responsive" style="padding: 0;">
                    <table class="table table-hover table-bordered" id="tablaInsumos">
                      <thead>
                        <tr class="active">
                          <th>Id Insumo</th>
                          <th>Nombre</th>
                          <th>Color</th>
                          <th>Unidad de Medida</th>
                          <th>Valor</th>
                          <th>Cantidad Necesaria</th>
                          <th>Valor Insumo</th>
                          <th>Retirar</th>
                        </tr>
                      </thead>
                      <tbody>
                      <tr>
                        <td id="tblInsumosVacia" colspan="8" style="text-align:center;"></td>
                      </tr>
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
            </div>
          </div>
          <div class="row col-lg-12">
            <div class="form-group col-lg-4">
              <label for="vlr_produccion" class="">Valor Total Insumos:</label>
              <div class="">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-money iconoDinero" style="color: green; font-size: 150%"></i></span>
                    <input type="text" name="vlr_produccion" class="form-control" id="vlr_produccion"  value="0" style="border-radius:5px;" data-parsley-lt="#vlr_producto" readonly="" min="1" data-parsley-errors-container="#totalInsEr">
                  </div>
                <!-- </div> -->
              </div>
              <div id="totalInsEr"></div>
            </div>
            <div class="form-group col-lg-offset-3 col-lg-5">  
              <label for="vlr_producto" class="">*Valor Producto:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-money" style="color: green; font-size: 150%"></i></span>
                <input type="number" name="vlr_producto" class="form-control" id="vlr_producto" value="" style="border-radius:5px;" data-parsley-required="true" data-parsley-gt="#vlr_produccion" min="0" maxlength="10" data-parsley-errors-container='#vlProdError'>
              </div>
              <div id="vlProdError"></div>
            </div>
            <input id="subtotal" name="subtotal" type="hidden" value="0">
            <input id="total" name="total" type="hidden" value="0">
          </div>
        </div>
        <div class="box-footer"> 
          <div class="row">
            <div class="col-lg-offset-3 col-lg-3">
              <button type="submit" class="btn btn-success btn-md btn-block" name="btnRegFicha" id="reg"><i class="fa fa-check-circle" aria-hidden="true"></i> <b>Registrar</b></button>
            </div>
            <div class="col-lg-3">
              <button type="reset" class="btn btn-default btn-md btn-block" name="btnCanFicha" onclick="limpiarFormRegFicha()" style="margin-left: 2%"><i class="fa fa-eraser" aria-hidden="true"></i> <b>Limpiar</b></button>
            </div>
          </div>
          <small><b>*Campo requerido</b></small>
        </div>
      </form>
      <!-- Inicio Modal asociar insumos -->
      <div class="modal fade" id="asoInsum" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>INSUMOS PARA ASOCIAR</b></h4>
            </div>
            <div class="modal-body">
              <div class="table">
                <div class="col-sm-12 table-responsive">
                  <table class="table table-hover" style="margin-top: 2%;" id="insRegFT">
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
                        <td><i class="fa fa-square" style="color: <?= $insumo["Codigo_Color"] ?>; font-size: 200%;" title="<?= $insumo["Nombre_Color"] ?>"></i></td>
                        <td><?= $insumo["Estado"]==1?"Habilitado":"Inhabilitado" ?></td>
                        <td><?= round($insumo["Valor_Promedio"], 2) ?></td>
                        <td>
                          <button id="btn<?= $i; ?>" type="button" class="btn btn-box-tool btnInsumo" onclick="asociarInsumosHab('<?= $insumo["Id_Insumo"] ?>', '<?= $insumo["Nombre"] ?>', '<?= $insumo["Codigo_Color"] ?>' , this, '<?= $i; ?>', '<?= $insumo["Estado"] ?>', '<?= $insumo["Valor_Promedio"] ?>', '<?= $insumo["Abreviatura"] ?>', '<?= $insumo["Nombre_Color"] ?>')"><i class="fa fa-plus" style="font-size: 150%; color: blue;"></i></button>
                        </td>
                      </tr>
                      <?php $i++; ?>
                    <?php endforeach; ?>
                  </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer" style="border-top:0px">
              <button type="button" class="btn btn-default btn-lg" data-dismiss="modal" aria-label="Close"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    </section>
