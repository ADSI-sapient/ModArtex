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
          <h3 class="box-title" style="margin-top: 0.7%"><strong>REGISTRAR FICHA TÉCNICA</strong></h3>
          <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#ModAyudaFicha" style="background: transparent; border: none;"><i class="fa fa-comment"></i></button>
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


<div class="modal fade" id="ModAyudaFicha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 10px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><strong>AYUDA USUARIO</strong></h4>
        </div>
        <div class="modal-body"> 
        <div class="modAyuda scrollAyuda">
          <ol class="c17 lst-kix_list_11-0" start="4"><li class="c1 c16 c2"><h1 id="h.2nusc19" style="display:inline"><span>M&Oacute;DULO DE FICHA T&Eacute;CNICA</span></h1></li></ol><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>El m&oacute;dulo de Ficha T&eacute;cnica permite gestionar la informaci&oacute;n del producto. A este rol solo tendr&aacute; acceso el rol Administrador, u otra cuenta que tenga este permiso asignado.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><h2 class="c1 c2" id="h.1302m92"><span>5.1 REGISTRAR FICHA </span></h2><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>Desde el modulo ficha t&eacute;cnica, opci&oacute;n Registrar Ficha, se puede registrar una referencia, se debe diligenciar todos los campos del formulario y asociar los insumos que se necesitan para realizar el producto. Ver </span><span class="c3">Figura 46. Registrar ficha t&eacute;cnica.</span></p><p class="c0"><span></span></p><p class="c0 c7"><span></span></p><p class="c11 c1 c7 c2" id="h.3mzq4wv"><span class="c5 c4">Figura 46. Registrar ficha t&eacute;cnica</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image05.png" style="width: 589.23px; height: 398.05px; margin-left: -0.00px; margin-top: -35.28px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.2250f4o"><span class="c4 c3">5.1.1 Validaci&oacute;n de campos</span><span>: Si al momento de hacer clic en el bot&oacute;n &ldquo;Registrar&rdquo;, faltan datos o hay un error en el formulario, el sistema emitir&aacute; una alerta mostrando el error a corregir, evitando continuar con el registro. Ver </span><span class="c3">Figura 47. Validaci&oacute;n de campos de ficha,</span></p><p class="c1"><span>&nbsp;</span></p><p class="c6 c1 c2" id="h.haapch"><span class="c5 c4">Figura 47. Validaci&oacute;n de campos de ficha</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image06.png" style="width: 589.23px; height: 397.51px; margin-left: -0.00px; margin-top: -34.47px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c1"><span>En caso contrario el sistema mostrara un mensaje informando el registro exitoso. Ver </span><span class="c3">Figura 48. Registro exitoso de ficha.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.319y80a"><span class="c5 c4">Figura 48. Registro exitoso de ficha</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image07.png" style="width: 589.23px; height: 402.29px; margin-left: -0.00px; margin-top: -35.88px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><h2 class="c1 c2" id="h.1gf8i83"><span>5.2 LISTAR FICHAS</span></h2><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1 c28"><span>Desde el modulo Ficha T&eacute;cnica, opci&oacute;n Listar Fichas, se puede visualizar de manera general la informaci&oacute;n de la referencias que se encuentran registradas. La tabla permite filtrar la informaci&oacute;n por medio de cualquier dato que se encuentre en esta. Para ver los insumos de una referencia en espec&iacute;fico, est&aacute; la opci&oacute;n: insumos asociados, editar y cambiar estado. Ver </span><span class="c3">Figura 49. Listar fichas.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1 c2 c6" id="h.40ew0vw"><span class="c5 c4">Figura 49. Listar fichas</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image08.png" style="width: 589.23px; height: 481.14px; margin-left: -0.00px; margin-top: -44.44px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.2fk6b3p"><span class="c4 c3">5.2.1 Insumos asociados</span><span>: En la opci&oacute;n que aparece al lado derecho de la tabla que lista las fichas, al dar clic se puede ver con detalle las tallas en las que viene esta referencia, m&aacute;s los insumos que se necesita para su producci&oacute;n. Ver </span><span class="c3">Figura 50. Insumos asociados a ficha. </span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c11 c1 c7 c2" id="h.upglbi"><span class="c5 c4">Figura 50. Insumos asociados a ficha</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 264.57px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image09.png" style="width: 680.68px; height: 669.91px; margin-left: -90.24px; margin-top: -91.78px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0 c9"><span></span></p><p class="c0 c9"><span></span></p><p class="c1" id="h.3ep43zb"><span class="c4 c3">5.2.2 Editar</span><span>: Al dar clic en la opci&oacute;n de editar, se abre un formulario que permite modificar los campos de: nombre, color, stock m&iacute;nimo y valor del producto, tambi&eacute;n seleccionar de nuevo las tallas en las que est&aacute; disponible esa referencia y los insumos que se necesitan para su producci&oacute;n. Ver </span><span class="c3">Figura 51. Editar ficha t&eacute;cnica.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c11 c1 c7 c2" id="h.1tuee74"><span class="c5 c4">Figura 51. Editar ficha t&eacute;cnica</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image33.png" style="width: 679.27px; height: 410.74px; margin-left: -90.01px; margin-top: -45.79px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0 c9"><span></span></p><p class="c1"><span>Este formulario tambi&eacute;n contiene validaciones de campos</span><span class="c8 c3">. </span><span class="c8">Ver </span><span class="c8 c3">Figura 47. Validaciones de campos de ficha.</span></p><p class="c0"><span class="c8 c3"></span></p><p class="c0"><span class="c8 c3"></span></p><p class="c1" id="h.4du1wux"><span class="c4 c3">5.2.3 Cambiar estado</span><span>: Para modificar el estado de una ficha, se da clic en el &ldquo;Cambiar Estado&rdquo; que aparece en la parte derecha de la pantalla. Solo las fichas habilitadas se podr&aacute;n producir. Ver </span><span class="c3">Figura 52. Cambiar estado de la ficha.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.2szc72q"><span class="c5 c4">Figura 52. Cambiar estado de la ficha</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image34.png" style="width: 589.23px; height: 398.89px; margin-left: -0.00px; margin-top: -35.88px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span><span>&nbsp;</span></p><h1 class="c0 c2 c10"><span class="c19"></span></h1><hr style="page-break-before:always;display:none;"><p class="c0 c18 c7"><span></span></p>
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