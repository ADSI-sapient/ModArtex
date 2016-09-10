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
        <div class="box-body">
        <br>
        <form data-parsley-validate="" action="<?php echo URL; ?>ctrFicha/regFicha" method="POST" onsubmit="return enviarFormFicha();" id="frmRegFicha">
          <div class="row col-lg-12" style="margin-left:0.5%">
            <div class="form-group col-lg-3">
              <label for="referencia" class="">*Referencia:</label>
              <input type="text" name="referencia" class="form-control" id="" autofocus="" style="border-radius:5px;" data-parsley-required="" autofocus="">
            </div>
            <div class="form-group col-lg-offset-1 col-lg-4">
              <label class="">Fecha Registro:</label>
              <div class="">
                <div class="input-group date">
                  <div class="input-group-addon" style="border-radius:5px;">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="fecha_reg" id="" placeholder="" style="border-radius:5px;" readonly="" value="<?php echo date("Y-m-d");?>">
                </div>
              </div>
            </div>
            <div class="form-group col-lg-offset-1 col-lg-3 ">
              <label for="estado" class="">Estado:</label>
              <input type="text" name="estado" class="form-control" id="estado" value="Habilitado" readonly="" style="border-radius:5px;" data-parsley-required="">
            </div>
          </div>
          <div class="row col-lg-12" style="margin-left:0.5%">
            <div class="form-group col-lg-3">
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
            <div class="form-group col-lg-offset-1 col-lg-4">
              <label for="selectTallas">*Tallas:</label>
              <select class="form-control" multiple="" style="border-radius:5px;" id="selectTallas" name="tallas[]" data-parsley-required="" style="width:75%" data-parsley-errors-container="#tallasRegf">
                <option value="1">L</option>
                <option value="2">M</option>
                <option value="3">S</option>
              </select>
              <div id="tallasRegf"></div>
            </div>
            <div class="form-group col-lg-offset-1 col-lg-3">  
              <label for="stock_minimo" class="">*Stock Mínimo:</label>
              <input type="text" name="stock_min" class="form-control" id="stock_minimo" placeholder="" value="" style="border-radius:5px;" data-parsley-required="">
            </div>
          </div>
          <div class="row col-lg-12" style="margin-left:0.5%">
            <div class="form-group col-lg-3">
              <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#asoInsum"><b>Asociar Insumos</b></button>
            </div>
          </div>
          <div class="form-group" id="agregarInsumo">
            <div class="table">
              <div class="col-lg-12 table-responsive">
                <table class="table table-hover table-bordered" style="margin-top: 2%;" id="tablaInsumos">
                  <thead>
                    <tr class="active">
                      <th>Id Insumo</th>
                      <th>Nombre</th>
                      <th>Color</th>
                      <th>Unidad de Medida</th>
                      <th>Valor</th>
                      <th>Cantidad Necesaria</th>
                      <th>Valor Insumo</th>
                      <th>Quitar</th>
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
          <div class="row col-lg-12" style="margin-left:0.5%">
            <div class="form-group col-lg-3">
              <label for="vlr_produccion" class="">Valor Producción:</label>
              <div class="">
                <!-- <div class="input-group">
                  <div class="input-group-btn" style="border-radius:5px; margin-bottom:10%;">
                    <button type='button' id="confir" onclick="calcularVlrProd()" class='btn btn-info'><b>Calcular</b></button>
                  </div> -->
                  <input type="text" name="vlr_produccion" class="form-control" id="vlr_produccion"  value="0" style="border-radius:5px;" data-parsley-lt="#vlr_producto" readonly="">
                <!-- </div> -->
              </div>
            </div>

            <div class="form-group col-lg-offset-6 col-lg-3">  
              <label for="vlr_producto" class="">*Valor Producto:</label>
              <input type="text" name="vlr_producto" class="form-control" id="vlr_producto" value="" style="border-radius:5px;" data-parsley-required="true" data-parsley-gt="#vlr_produccion">
            </div>
            <input id="subtotal" name="subtotal" type="hidden" value="0">
            <input id="total" name="total" type="hidden" value="0">
          </div>
          <div class="row"> 
            <div class="form-group col-lg-12" style="margin-left:14px">
              <button type="submit" class="btn btn-primary col-lg-offset-9" name="btnRegFicha" id="reg"><b>Registrar</b></button>
              <button type="reset" class="btn btn-danger" name="btnCanFicha" onclick="limpiarFormRegFicha()"><b>Limpiar</b></button>
            </div>
          </div>
        </form>
        </div>
      <!-- Inicio Modal asociar insumos -->
      <div class="modal fade" id="asoInsum" tabindex="-1" role="dialog" >
        <div class="modal-dialog">
          <div class="modal-content modal-lg" style="border-radius: 10px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Insumos Para Asociar</b></h4>
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
                        <td><i class="fa fa-square" style="color: <?= $insumo["Codigo_Color"] ?>; font-size: 200%;"></i></td>
                        <td><?= $insumo["Estado"]==1?"Habilitado":"Inhabilitado" ?></td>
                        <td><?= round($insumo["Valor_Promedio"], 2) ?></td>
                        <td>
                          <button id="btn<?= $i; ?>" type="button" class="btn btn-box-tool" onclick="asociarInsumosHab('<?= $insumo["Id_Insumo"] ?>', '<?= $insumo["Nombre"] ?>', '<?= $insumo["Codigo_Color"] ?>' , this, '<?= $i; ?>', '<?= $insumo["Estado"] ?>', '<?= $insumo["Valor_Promedio"] ?>', '<?= $insumo["Abreviatura"] ?>')"><i class="fa fa-plus"></i></button>
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
              <button type="button" class="btn btn-primary" data-dismiss="modal"><b>Aceptar</b></button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    </section>
