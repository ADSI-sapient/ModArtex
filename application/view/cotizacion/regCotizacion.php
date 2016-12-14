<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="<?php echo URL; ?>home/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="#">Cliente</a></li>
    <li class="active">Registrar Cotización</li>
  </ol>
</section>
<section class="content">
  <div class="box box-primary">
      <div class="box-header with-border" style="text-align: center;">
        <h3 class="box-title" style="margin-top: 0.7%"><strong>REGISTRAR COTIZACIÓN</strong></h3>
        <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#ModAyudaCotizacion" style="background: transparent; border: none;"><i class="fa fa-comment"></i></button>
      </div>
      <form data-parsley-validate="" action="<?php echo URL; ?>ctrCotizacion/regCotizacion" method="POST" id="form" onsubmit="return ValCoti()">
      <div class="box-body">
      <div class="row">

        <div class="col-lg-12">
          <div class="form-group col-lg-4">
            <label class="">Fecha Registro:</label>
            <div class="">
              <div class="input-group date">
                <div class="input-group-addon" style="border-radius:5px;">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" value="<?php echo date ("Y-m-d"); ?>" name="fecha_R" id="fecha_R" readonly="" style="border-radius:5px;">
              </div>
            </div>
          </div>
          <div class="form-group col-lg-4">
            <label class="">*Fecha Vencimiento:</label>
            <div class="">
              <div class="input-group date">
                <div class="input-group-addon" style="border-radius:5px;">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" name="fecha_V" required="" id="fecha1" style="border-radius:5px;" data-parsley-required="" data-parsley-errors-container="#regCotizv" onkeyup="prohibirEscritura();">
              </div>
            </div>
            <div id="regCotizv"></div>
          </div>
          <div class="form-group col-lg-4">

            <label for="estado" class="">Estado</label>
            <input type="text" name="estado" class="form-control" id="estado" readonly="" value="No Entregada">
          </div>
        </div>
        </div>

        <div class="row">
        <div class="col-lg-12">
            <div class="form-group col-lg-4">
              <label for="cliente" class="">*Asociar Cliente:</label>
              <select class="form-control" style="border-radius:5px;" name="cliente" id="clienteReg" data-parsley-required="" data-parsley-errors-container="#regCotizCl">
              <option value=""></option>
                <?php foreach ($clientes as $cliente): ?>
                  <?php if ($cliente["Num_Documento"] != "1017223026"): ?>
                    <option value="<?= $cliente["Num_Documento"] ?>"><?= $cliente["Num_Documento"] ." - ".$cliente["Nombre"]?></option>
                  <?php endif ?>
                <?php endforeach ?>
              </select>
            <div id="regCotizCl"></div>
            </div>
        <!-- </div> -->
        <!-- <div class="row col-lg-12" style="margin-left:0.5%"> -->
          <div class="form-group col-lg-8">
            <button type="button" class="btn btn-primary pull-right" id="" data-toggle="modal" data-target="#ModelProducto" style="margin-top:25px" onclick="prueba()";><b>Asociar Productos</b></button>
          </div>
        </div>
        </div>
          <div class="row">
          <div class="col-md-12" id="agregarFicha">
          <div class="col-md-12">
          <label>*Productos Asociados:</label>
          <div class="table scrolltablas" style="margin-top: 2%;">
            <div class="col-lg-12 table-responsive" style="padding: 0;">
                <table class="table table-hover table-bordered" id="Ficha">
                  <thead>
                    <tr class="active">
                      <th>Referencia</th>
                      <th>Talla</th>
                      <th>Color</th>
                      <th>Valor Producto</th>
                      <th>Cantidad</th>
                      <th>Subtotal</th>
                      <th>Retirar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr id="tlcotiz">
                      <td id="tblFichasVaciaCoti" colspan="8" style="text-align:center;"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
        </div>
        </div>
        <div class="row">
        <div class="col-lg-12" style="margin-left:0.5%">
          <div class="form-group col-lg-offset-8 col-lg-4">
            <label for="vlr_total" class="">Valor Total:</label>
            <div class="input-group">
              <span class="input-group-addon" style="border-radius:5px;">
                <i id="" class="fa fa-money iconoDinero" style="color: green; font-size: 150%;"></i>
              </span>
              <input class="form-control" type="text" name="vlr_total" id="vlr_total" value="0" readonly="" style="border-radius:5px;">
            </div>
          </div>
        </div>
        </div>
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-lg-offset-3 col-lg-3">
            <button type="submit" class="btn btn-success btn-md btn-block" name="btnRegistrar" id="" data-toggle="modal" data-target="#modpedidoregist"><i class="fa fa-check-circle" aria-hidden="true"></i> <b>Registrar</b></button>
          </div>
          <div class="col-lg-3">
            <button type="reset" class="btn btn-default btn-md btn-block" name="" onclick="limpiarFormRegCoti(); animarTotal();" style="margin-left: 2%;"><i class="fa fa-eraser" aria-hidden="true"></i> <b>Limpiar</b></button>
          </div>
        </div>
        <small><b>*Campo requerido</b></small>
      </div>
      </form>
    </div>  
</section>       
    <div class="modal fade" id="ModelProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">PRODUCTOS PARA ASOCIAR</h4>
            </div>
            <div>
              <form  id="myModal" action="<?= URL ?>cotizacion/modiCotizacion" method="post" role="form">
           <div class="table">
                <div class="col-lg-12 table-responsive">
                  <table class="table table-hover table-bordered" style="margin-top: 2%;" id="tablaFichasCoti">
                    <thead>
                      <tr class="active">
                        <th style="display: none;"></th>
                        <th>Referencia</th>
                        <th>Nombre</th>
                        <th>Talla</th>
                        <th>Estado</th>
                        <th>Color</th>
                        <th>Valor Produccion</th>
                        <th>Valor Producto</th>
                        <th>Agregar</th>
                      </tr>
                    </thead>

                    <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($fichas as $ficha): ?>

                    <tr>
                      <td style="display: none;"><?= $ficha["Id_Ficha_Tecnica"] ?></td>
                      <td><?= $ficha["Referencia"] ?></td>
                      <td><?= $ficha["Nombre"] ?></td>
                      <td><?= $ficha["Nom_Talla"] ?></td>
                      <td><?= $ficha["Estado"]==1?"Habilitado":"Inhabilitado" ?></td>
                      <td><i class="fa fa-square" style="color:<?= $ficha["Codigo_Color"] ?>; font-size: 200%;" title="<?= $ficha["Nombre_Color"] ?>"></i></td>
                      <td><?= $ficha["Valor_Produccion"] ?></td>
                      <td><?= $ficha["Valor_Producto"] ?></td>
                      <td>
                      <button id="b<?= $i; ?>" type="button" class="btn btn-box-tool btnAsociarP" onclick="asociarFichaCoti('<?= $ficha["Referencia"] ?>', '<?= $ficha["Nom_Talla"] ?>', '<?= $ficha["Codigo_Color"] ?>', '<?= $ficha["Valor_Producto"] ?>', this, '<?= $i; ?>', '<?= $ficha["Id_Ficha_Tecnica"] ?>', '<?= $ficha["Nombre_Color"] ?>', '<?= $ficha["Id_Fichas_Tallas"] ?>')"><i style="font-size: 150%; color:blue;" class="fa fa-plus"></i></button>
                      </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                  </tbody>

                  </table>
                </div>
              </div>

      <div class="modal-footer" style="border-top:0px;">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
      </div> 
    </form>
     </div>
   </div> 
  </div> 
</div>
              <!--Fin del modal valor total-->     

              <!--Modal de asociar cliente -->

    <div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" id="mdal">
        <div class="modal-content" style="border-radius: 10px;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Asociar Cliente</h4>
          </div>
          <div class="modal-body">
         <div class="table">
        <div class="col-sm-12 table-responsive">
           
        <style type="text/css">
        #mdal{
           width: 70% !important;
        }
        </style>      
              <table class="table table-hover">
                <thead>
                  <tr class="info">
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Tipo de Documento</th>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Email</th>
                    <th>Opcion</th>
                  </tr>
                </thead>

                <tbody> 
                <?php $i= 1; ?>
                 <?php foreach ($clientes as $cliente):?>
                  <tr>
                    <td><?php echo $cliente["Tipo_Nombre"] ?></td>  
                    <td><?php echo $cliente["Estado"] ?></td>
                    <td><?php echo $cliente["Tipo_Documento"] ?></td>
                    <td><?php echo $cliente["Num_Documento"] ?></td>
                    <td><?php echo $cliente["Nombre"] ?></td>
                    <td><?php echo $cliente["Apellido"] ?></td>
                    <td><?php echo $cliente["Telefono"] ?></td>
                    <td><?php echo $cliente["Direccion"] ?></td>
                    <td><?php echo $cliente["Email"] ?></td>
                    <td>
                      <button id="bt<?= $i; ?>" class="btn btn-box-tool" onclick="agregar('<?= $cliente['Num_Documento'] ?>','<?= $cliente['Nombre']; ?>','<?= $i; ?>')"><i class="fa fa-plus"></i></button>
                    </td>
                  </tr>
                  <?php $i++ ?>
                <?php endforeach; ?>
              </tbody>
            </table> 
          </div>
          </div>
         </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div> 
      </div>
    </div> 
  </div> 

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


<div class="modal fade" id="ModAyudaCotizacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 10px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><strong>AYUDA USUARIO</strong></h4>
        </div>
        <div class="modal-body"> 
        <div class="modAyuda scrollAyuda">
          <ol class="c17 lst-kix_list_11-0" start="6"><li class="c1 c16 c2"><h1 id="h.2y3w247" style="display:inline"><span>M&Oacute;DULO DE COTIZACI&Oacute;N</span></h1></li></ol><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>El m&oacute;dulo de cotizaci&oacute;n permite presentar al cliente el valor de los productos que desea adquirir, posteriormente podr&aacute; utilizar esta informaci&oacute;n para registrar un pedido. A este m&oacute;dulo solo tiene acceso la cuenta del Administrador u otro rol que tenga este permiso asignado.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><h2 class="c1 c2" id="h.1d96cc0"><span class="c4 c8 c3">7.1 REGISTRAR COTIZACI&Oacute;N</span><span>&nbsp;</span></h2><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>Para registrar una cotizaci&oacute;n se deben ingresar todos los campos, asociar un cliente y seleccionar los productos con la cantidad que el cliente solicita. El sistema calcula el valor total y por defecto asigna en estado pendiente la cotizaci&oacute;n. Ver </span><span class="c3">Figura 59. Registrar cotizaci&oacute;n.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.3x8tuzt"><span class="c5 c4">Figura 59. Registrar cotizaci&oacute;n.</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image41.png" style="width: 589.23px; height: 358.73px; margin-left: -0.00px; margin-top: -31.07px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.2ce457m"><span class="c4 c3">7.1.1 Validaci&oacute;n de campos de cotizaci&oacute;n</span><span>: Al dar clic en el bot&oacute;n &ldquo;Registrar&rdquo;, el sistema valida que los campos est&eacute;n completos, la fecha de vencimiento no puede ser menor a la fecha de registro. En caso de haber una inconsistencia el sistema muestra una alerta, informando del error e impidiendo el registro exitoso. Ver </span><span class="c3">Figura 60. Validaci&oacute;n de campos de cotizaci&oacute;n.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.rjefff"><span class="c5 c4">Figura 60. Validaci&oacute;n de campos de cotizaci&oacute;n</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image42.png" style="width: 589.23px; height: 353.14px; margin-left: -0.00px; margin-top: -28.23px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c1"><span>En caso contrario el sistema muestra un mensaje de confirmaci&oacute;n exitosa. Ver </span><span class="c3">Figura 61. Registro de cotizaci&oacute;n exitosa.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.3bj1y38"><span class="c5 c4">Figura 61. Registro de cotizaci&oacute;n exitosa</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image32.png" style="width: 589.23px; height: 357.36px; margin-left: -0.00px; margin-top: -32.14px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><h2 class="c1 c2" id="h.1qoc8b1"><span>7.2 LISTAR COTIZACIONES</span></h2><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>En la opci&oacute;n de Listar cotizaciones, se puede visualizar de manera general, por medio de una tabla interactiva la informaci&oacute;n de las cotizaciones registradas. Para ver una cotizaci&oacute;n en espec&iacute;fico, est&aacute;n las opciones: Detalle, Editar y Generar.</span></p><p class="c1"><span>Desde la tabla tambi&eacute;n es posible pasar una cotizaci&oacute;n a un pedido directamente. Ver </span><span class="c3">Figura 62. Listar cotizaciones.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.4anzqyu"><span class="c5 c4">Figura 62. Listar cotizaciones</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image22.png" style="width: 589.23px; height: 391.26px; margin-left: -0.00px; margin-top: -37.80px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.2pta16n"><span class="c4 c3">7.2.1 Detalle</span><span>: En la opci&oacute;n de detalle se puede visualizar la referencia, nombre, color, cantidad, valor producto y subtotal de la cotizaci&oacute;n seleccionada. Ver </span><span class="c3">Figura 63. Detalle cotizaci&oacute;n.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c11 c1 c7 c2" id="h.14ykbeg"><span class="c5 c4">Figura 63. Detalle cotizaci&oacute;n</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 226.77px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image23.png" style="width: 747.46px; height: 624.58px; margin-left: -124.66px; margin-top: -79.06px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.3oy7u29"><span class="c4 c3">7.2.2 Editar</span><span>: Para modificar una cotizaci&oacute;n, se da clic en la opci&oacute;n &ldquo;editar&rdquo;, donde se abre un formulario, que permite modificar todos los datos a excepci&oacute;n de la fecha de registro. Ver </span><span class="c3">Figura 64. Editar cotizaci&oacute;n.</span></p><p class="c0"><span class="c3"></span></p><p class="c11 c1 c7 c2" id="h.243i4a2"><span class="c5 c4">Figura 64. Editar cotizaci&oacute;n</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image24.png" style="width: 753.95px; height: 493.30px; margin-left: -127.11px; margin-top: -64.10px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0 c9"><span></span></p><p class="c0 c9"><span></span></p><p class="c1"><span>Este formulario tambi&eacute;n contiene validaciones de campos. </span><span class="c8">Ver </span><span class="c8 c3">Figura 60. Validaciones de campos de cotizaci&oacute;n</span><span class="c8">.</span></p><p class="c0"><span></span></p><p class="c1" id="h.j8sehv"><span class="c4 c3">7.2.3 Generar</span><span>: Si se desea tener un registro f&iacute;sico de la cotizaci&oacute;n, est&aacute; la opci&oacute;n generar, que crea un documento con todos los datos de la cotizaci&oacute;n. Ver </span><span class="c3">Figura 65. </span><span class="c8 c3">Generar cotizaci&oacute;n.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c11 c1 c7 c2" id="h.338fx5o"><span class="c5 c4">Figura 65. Generar cotizaci&oacute;n</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image25.png" style="width: 836.69px; height: 498.32px; margin-left: -166.15px; margin-top: -85.75px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0 c9"><span></span></p><p class="c0 c9"><span></span></p><p class="c1" id="h.1idq7dh"><span class="c4 c3">7.2.4 Convertir a pedido</span><span>: Si el cliente confirma que va a adquirir los productos previamente cotizados, el sistema permite pasar directamente una cotizaci&oacute;n a un pedido, desde la opci&oacute;n &ldquo;convertir a pedido&rdquo;, donde se abre un formulario que muestra la cotizaci&oacute;n con la informaci&oacute;n de cada referencia, tambi&eacute;n campos para ingresar la cantidad a producir. Ver </span><span class="c3">Figura 66. Convertir cotizaci&oacute;n a pedido.</span></p><p class="c0"><span></span></p><p class="c11 c1 c7 c2" id="h.42ddq1a"><span class="c5 c4">Figura 66. Convertir cotizaci&oacute;n a pedido</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image26.png" style="width: 751.95px; height: 492.07px; margin-left: -127.63px; margin-top: -66.84px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0 c7"><span></span></p><p class="c0 c7"><span></span></p><p class="c1" id="h.2hio093"><span class="c4 c3">7.2.4.1 Validaci&oacute;n de existencias en producto terminado:</span><span>&nbsp;Al momento de pasar una cotizaci&oacute;n a un pedido, aparece en el formulario una tabla con la informaci&oacute;n general, m&aacute;s la cantidad que se encuentra disponible en producto terminado de cada referencia. Se debe diligencia el campo: &ldquo;Tomar de stock&rdquo; en caso de utilizar cantidad de producto terminado, de lo contrario se deja vac&iacute;o. El sistema valida que la cantidad ingresada no sea mayor a la cantidad disponible. &nbsp;Ver </span><span class="c3">Figura 67. Validaci&oacute;n de existencias en producto terminado </span></p><p class="c0 c9"><span></span></p><p class="c11 c1 c7 c2" id="h.wnyagw"><span class="c5 c4">Figura 67.Validaci&oacute;n de existencias en producto terminado</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image27.png" style="width: 760.77px; height: 438.56px; margin-left: -132.90px; margin-top: -57.26px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0 c9"><span></span></p><p class="c1"><span>Este formulario tambi&eacute;n contiene validaciones de campos. </span><span class="c8">Ver </span><span class="c3 c8">Figura 60. Validaciones de campos de cotizaci&oacute;n</span><span class="c8">.</span></p><p class="c0"><span class="c8"></span></p><p class="c1" id="h.3gnlt4p"><span class="c4 c3">7.2.4.2 Validaci&oacute;n de existencia de insumos</span><span>: Al dar clic en registrar, el sistema valida que est&eacute;n disponibles cada uno de los insumos para realizar la producci&oacute;n de cada referencia. Ver </span><span class="c3">Figura 68. Validaci&oacute;n de existencias de insumos.</span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.1vsw3ci"><span class="c5 c4">Figura 68. Validaci&oacute;n de existencias de insumos</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image28.png" style="width: 589.23px; height: 355.19px; margin-left: -0.00px; margin-top: -31.53px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p>
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