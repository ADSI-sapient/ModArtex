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
          <h3 class="box-title" style="margin-top: 0.7%;"><strong>EXISTENCIAS PRODUCTO TERMINADO</strong></h3>
          <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#ModAyudaProductoT" style="background: transparent; border: none;"><i class="fa fa-comment"></i></button>
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


<div class="modal fade" id="ModAyudaProductoT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 10px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><strong>AYUDA USUARIO</strong></h4>
        </div>
        <div class="modal-body"> 
        <div class="modAyuda scrollAyuda">
          <ol class="c17 lst-kix_list_11-0" start="9"><li class="c1 c16 c2"><h1 id="h.1c1lvlb" style="display:inline"><span>PRODUCTO TERMINADO </span></h1></li></ol><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>En el m&oacute;dulo de producto terminado, se puede visualizar las cantidades ya terminadas y disponibles de una referencia. Ver </span><span class="c3">Figura 87. Producto terminado.</span><span>&nbsp;</span></p><p class="c0"><span class="c3"></span></p><p class="c6 c1 c2" id="h.3w19e94"><span class="c5 c4">Figura 87. Producto terminado</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image51.png" style="width: 589.23px; height: 424.66px; margin-left: -0.00px; margin-top: -37.46px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span class="c3"></span></p><p class="c0"><span class="c3"></span></p><h2 class="c1 c2" id="h.2b6jogx"><span>10.1 SALIDA</span></h2><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>En la p&aacute;gina principal de esta opci&oacute;n, aparece una tabla interactiva con la informaci&oacute;n de cada referencia, para registrar una salida, se da clic en la flecha roja que aparece al lado derecho de la pantalla, donde se abre un formulario para diligenciar la cantidad y la descripci&oacute;n de la salida. Ver </span><span class="c3">Figura 88. Registrar salida.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.qbtyoq"><span class="c5 c4">Figura 88. Registrar salida</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.07px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image52.png" style="width: 589.07px; height: 452.92px; margin-left: -0.00px; margin-top: -41.36px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 25.33px; height: 20.00px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image31.png" style="width: 25.33px; height: 20.00px; margin-left: 0.00px; margin-top: 0.00px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>Tambi&eacute;n se pueden registrar varias salidas a la vez, se seleccionan los productos marcando el check box que aparece a la izquierda de este, que habilita la flecha roja de la parte inferior de la pantalla, donde al dar clic, abre un formulario solicitando ingresar la cantidad de salida de cada referencia y la descripci&oacute;n de &eacute;stas. Ver </span><span class="c3">Figura 89. Registrar varias salidas.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.3abhhcj"><span class="c5 c4">Figura 89. Registrar varias salidas</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image53.png" style="width: 761.20px; height: 576.76px; margin-left: -132.43px; margin-top: -75.54px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c1" id="h.1pgrrkc"><span class="c4 c3">10.1.1 Validaci&oacute;n de campos de salida</span><span>. Al momento de dar clic al bot&oacute;n &ldquo;Registrar&rdquo;, el sistema valida que en el campo de cantidad si se haya ingresado un n&uacute;mero y que este no sea mayor a la cantidad disponible. La descripci&oacute;n es opcional. Ver </span><span class="c3">Figura 90. Validaci&oacute;n de campos de salida.</span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.49gfa85"><span class="c5 c4">Figura 90. Validaci&oacute;n de campos de salida</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image54.png" style="width: 755.95px; height: 603.46px; margin-left: -127.19px; margin-top: -76.05px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span class="c3"></span></p><p class="c0"><span class="c3"></span></p><p class="c1"><span>En caso contrario el sistema muestra un mensaje indicando el registro de la salida exitoso. Ver </span><span class="c3">Figura 91. Registro de salida exitoso.</span></p><p class="c0"><span class="c3"></span></p><p class="c6 c1 c2" id="h.2olpkfy"><span class="c5 c4">Figura 91. Registro de salida exitoso</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.20px; height: 284.91px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image44.png" style="width: 589.20px; height: 331.26px; margin-left: -0.00px; margin-top: -26.08px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><h2 class="c1 c2" id="h.13qzunr"><span>10.2 GENERAR REPORTE</span></h2><p class="c0"><span class="c3"></span></p><p class="c0"><span class="c3"></span></p><p class="c1"><span>Para generar un reporte de las referencias con la cantidad, que se encuentran en producto terminado, se da clic en el bot&oacute;n &ldquo;Generar reporte&rdquo;, donde inmediatamente se genera un archivo pdf con la informaci&oacute;n solicitada. Ver </span><span class="c3">Figura 92. Generar reporte de salidas.</span></p><p class="c0"><span class="c3"></span></p><p class="c0"><span class="c3"></span></p><p class="c6 c1 c2" id="h.3nqndbk"><span class="c5 c4">Figura 92. Generar reporte de salidas</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.29px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image45.png" style="width: 843.23px; height: 540.10px; margin-left: -170.27px; margin-top: -96.99px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><hr style="page-break-before:always;display:none;"><p class="c0 c18 c7"><span class="c3"></span></p>
        </div>            
        </div>
         <div class="modal-footer">
            <div class="row">
              <div class="col-md-12">
                <button data-dismiss="modal" type="reset" class="btn btn-default pull-right" style="margin-left: 2%; margin-top: 2%"><i class="fa fa-times-circle" aria-hidden="true"></i> <b>Cerrar</b></button>
              </div>
            </div>
         </div> 
        </div> 
      </div>
</div>