    <!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="<?php echo URL ?>home/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Exitencias ProductoT</a></li>
        <li><a class="active">Exitencias ProductoT</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Inicio de listar -->
      <div class="box box-primary">
        <div class="box-header with-border" style="text-align: center;">
          <h3 class="box-title"><strong>EXISTENCIAS PRODUCTO TERMINADO</strong></h3>
        </div>
        <div id="users">
      <form class="form-horizontal">
        <div class="col-md-12">
          <div class="table table-responsive">
            <table class="table table-hover table-bordered" id="tablaProducto">
              <thead>
                <tr class="info">
                <th><input type="checkbox" id="checkPadreSalidas" style="height:15px; width:15px;"></th>
                 <th>Referencia</th>
                 <th>Nombre</th>
                 <th>Talla</th>
                  <th>Color</th>
                  <th style="display: none"></th> 
                  <th style="display: none">Id_Ficha</th>
                  <th style="display: none">Id_Ficha_Talla</th>
                  <th>Cantidad</th>
                  <th>Valor Producción</th>
                  <th>Stock Mínimo</th>
                  <th>Salida</th>
                  <th style="display: none">nombcolor</th>
                  <th style="display: none">codcolor</th>
                </tr>
              </thead>
              <tbody class="list">
                  <?php foreach ($productos as $producto): ?>
                    <tr class="repProdT">
                      <td><input type="checkbox" id="chkSali<?= $producto["Referencia"] ?>" style="height:15px; width:15px;" class="checkboxHijoPT"></td>
                      <td class="Referencia repProdTerm"><?= $producto["Referencia"] ?></td>
                      <td class="NombreProducto repProdTerm"><?= $producto["Nombre_Producto"] ?></td>
                      <td class="repProdTerm" style="display: none"><?= $producto["Nombre"] ?></td>
                      <td class="repProdTerm"><?= $producto["Nombre_Talla"] ?></td>
                      <td class="Color"><i class="fa fa-square" style="color: <?= $producto["Codigo_Color"] ?>; font-size: 200%;" title="<?= $producto["Nombre"] ?>"></i></td>
                       <td class="idft" style="display: none"><?= $producto["Id_Ficha_Tecnica"] ?></td>
                       <td class="idft" style="display: none"><?= $producto["Id_Fichas_Tallas"] ?></td>
                       <td class="Cantidad repProdTerm"><?= $producto["Cantidad"] ?></td>
                       <td class="Valor_Produccion repProdTerm">$<?= $producto["Valor_Produccion"] ?></td>
                       <td><span class="badge bg-red"><?= $producto["Stock_Minimo"] ?></td>
                      <td>
                        <?php if ($producto["Cantidad"] <= 0): ?>
                          <button type="button" class="btn btn-box-tool" disabled="true"><i style="color: red; font-size: 150%;" class="fa fa-arrow-down"></i></button>
                        <?php else: ?>
                          <button type="button" class="btn btn-box-tool arrowSalida" data-toggle="modal" onclick="ProductoT('<?= $producto["Id_Fichas_Tallas"] ?>',this)"  data-target="#ModelSalida"><i style="color: red; font-size: 150%;" class="fa fa-arrow-down"></i></button>
                        <?php endif ?>    
                      </td>
                      <td style="display: none"><?= $producto["Nombre"] ?></td>
                      <td style="display: none"><?= $producto["Codigo_Color"] ?></td>
                    </tr>
                  <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </form>
        </div>
        <div class="box-footer">
          <div class="col-md-4">
             <a class="btn btn-primary" role="button" id="btnExistProdT" onclick="genRepExtProductoT();" target="_blank" href="<?= URL ?>ctrProductoT/reporteProductoTerminado/"><b>Generar Reporte</b></a>
           </div>
           <div class="col-md-8" style="text-align: right;">
              <button type="button" class="btn btn-box-tool" data-toggle="modal" onclick="Salida('<?= $producto["Referencia"] ?>',this);" disabled="true" id="salidaMultiplePT"><i style="color:red; font-size: 200%;" class="fa fa-arrow-down"></i></button> 
            </div>
        </div>
      </section>
      


<!--Inicio del modal de registro de salida individual-->
<div class="modal fade" id="ModelSalida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius:10px;">
      <div class="modal-header">
        <h4 class="modal-title"><b>SALIDA PRODUCTO TERMINADO</b></h4>
      </div>
      <div class="modal-body">
        <form role="form" id="ModelSalida" method="post" action="<?= URL ?>ctrProductoT/salida" data-parsley-validate="" onsubmit="return validarCantidadSalida();">
        <div class="row">
          <div class="form-group col-sm-6">
            <label for="referencia" class="">Referencia:</label>
            <input type="text" class="form-control" name="Referencia" id="Referencia" readonly="">
          </div>
          <div class="form-group col-sm-6">
            <label for="nombreProdto" class="">Nombre:</label>
            <input type="text" class="form-control" name="nombreProdto" id="nombreProdto" readonly="">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-sm-6">
            <label>Fecha:</label>                    
            <div class="input-group date">
              <div class="input-group-addon" style="border-radius: 5px;">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" name="FechaActual" class="form-control" value="<?php echo date ("Y-m-d"); ?>" readonly>
            </div>
          </div>
          <div class="form-group col-sm-6">
            <label for="referencia" class="">Cantidad Actual:</label>
            <input type="text" class="form-control" name="cantActual" id="cantActual" readonly="">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-sm-6">
            <label for="color" class="">*Cantidad Salida:</label>
            <input type="number" class="form-control"  min="1" id="cantidadSalida" name="cantidadSalida" data-parsley-required="" onkeyup="prohibirEscritura();">  
          </div>
          <div class="form-group col-sm-6">
            <label>Descripción:</label>
            <textarea class="form-control" name="descripcionSalida" id="descripcionSalida" maxlength="200"></textarea>
          </div>
          <input type="Hidden" class="form-control"  name="idft" id="idft"> 
        </div>
      </div>
      <div class="modal-footer">
        <div class="row">
          <div class="col-md-offset-3 col-md-3">
            <button type="submit" class="btn btn-success btn-md btn-block" name="btndescontarP"><i class="fa fa-check-circle" aria-hidden="true"></i> <b>Registrar</b></button>
          </div>
          <div class="col-md-3">
            <button type="button" data-dismiss="modal" class="btn btn-default btn-md btn-block"><i class="fa fa-eraser" aria-hidden="true"></i> <b>Cerrar</b></button>
          </div>
        </div>              
      </div>
      </form>
    </div>
  </div>
</div>
<!--Final del modal-->


<!--Inicio del modal re registro de varias salidas -->

  
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="ModalSalidas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 10px;">
      <!-- <form action="<?= URL;?>ctrProductoT/VariasSalidas" method="POST" onsubmit="return validarSalidasMultiples();" data-parsley-validate=""> -->
      <form action="<?= URL;?>ctrProductoT/VariasSalidas" method="POST" data-parsley-validate="">
        <div class="modal-header" style="text-align: center;">
          <h4 class="modal-title"><b>SALIDAS PRODUCTO TERMINADO</b></h4>
        </div>
        <div class="modal-body">

        <div class="col-md-12">
          <div class="table table-responsive scrolltablas"> 
            <table class="table table-bordered table-hover" id="tableSal">
              <thead>
                <tr class="active">
                  <th>Referencia</th>
                  <th>Nombre</th>
                  <th>Talla</th>
                  <th>Color</th>
                  <th>Cantidad Actual</th>
                  <th style="display: none">Id_Ficha</th>
                  <th>Cantidad Salida</th>
                </tr>
              </thead>
              <tbody id="tbodySal">
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group col-sm-6">
              <label>Fecha:</label>
              <div class="input-group date">
                <div class="input-group-addon" style="border-radius:5px;">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="FechaActualSalidas" class="form-control" value="<?php echo date ("Y-m-d"); ?>" readonly>
              </div>
            </div>
            <div class="form-group col-sm-6">
              <label>Descipción:</label>
             <textarea class="form-control" name="descripcionSalidas" id="descripcionSalidas" maxlength="200"></textarea>
            </div>
          </div>
        </div>
</div>
<input type="hidden" id="vec" name="vec">
<div class="modal-footer">
  <div class="row">
    <div class="col-md-offset-3 col-sm-3">
      <button type="submit" class="btn btn-success btn-md btn-block" id="regMuchos" name="regMuchasSalidas"><i class="fa fa-check-circle" aria-hidden="true"></i> <b>Registrar</b></button>
    </div>
    <div class="col-md-3">
      <button type="button" data-dismiss="modal" class="btn btn-default btn-md btn-block"><i class="fa fa-eraser" aria-hidden="true"></i> <b>Cerrar</b></button>
    </div>
  </div>
</div> 
</form>
</div> 
</div>
</div> 