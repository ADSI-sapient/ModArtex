  <section class="content-header">
  <ol class="breadcrumb">
      <li><a href="<?php echo URL; ?>home/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="#">Cotizacion</a></li>
      <li class="active">Listar Cotizaciones</li>
  </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="box box-primary">
      <div class="box-header with-border"  style="text-align: center;">
        <h3 class="box-title"><strong>LISTAR COTIZACIONES</strong></h3>
      </div> 
      <div id="users">
        <form class="form-horizontal">
          <div class="col-md-12">
              <div class="table table-responsive">
                <table class="table table-hover cell-border" id="tblCotizaciones">
                  <thead>
                    <tr class="info">
                      <th style="width: 10px">#</th>
                      <th>Fecha Registro</th>
                      <th>Cliente</th>
                      <th>Fecha Vencimiento</th>
                      <th>Estado</th>
                      <th>Valor Total</th>
                      <th style="display: none;"></th>
                      <th style="width: 7%">Editar</th>
                      <th>Generar</th>
                      <th style="width:10%">Convertir en Pedido</th>
                      <th class="col-md">Detalle</th>
                    </tr>
                  </thead>
                  <tbody class="">
                  <?php foreach ($cotizaciones as $cotizacion):?>
                  <tr>
                    <td class="Id_Solicitud"><?= $cotizacion["Id_Solicitud"] ?></td>
                    <td class="Fecha_Registro"><?= $cotizacion["Fecha_Registro"] ?></td>
                    <td class=""><?= $cotizacion["Nombre"] ?></td>
                    <td class="Fecha_Vencimiento"><?= $cotizacion["Fecha_Vencimiento"] ?></td>
                    <td class="Id_Estado"><?= $cotizacion["Nombre_Estado"] ?></td>
                    <td class="Valor_Total"><?= $cotizacion["Valor_Total"] ?></td>
                    <td class="Num_Documento" style="display: none;"><?= $cotizacion["Num_Documento"] ?></td>

                    <!--<td class="tado"><?= $cotizacion["Id_Estado"]==1?"Habilitado":"Inhabilitado"?></td>-->

                   <td>
                   <?php if ($cotizacion["Sol_Repetida"] == 2 || $cotizacion["Id_Estado"] == 1 || $cotizacion["Id_Estado"] == 3): ?>
                      <button type="button" disabled="" class="btn btn-box-tool"><i class="fa fa-pencil-square-o" style="font-size: 150%;"></i></button>
                   <?php else: ?>
                      <button type="button" class="btn btn-box-tool" onclick='editarCotizacion("<?= $cotizacion['Id_Solicitud'] ?>", this,"<?= $cotizacion['Id_Estado']?>"); fichasAsociad("<?= $cotizacion['Id_Solicitud'] ?>", "", 1); habilitarAsociaciones();'><i class="fa fa-pencil-square-o" style="font-size: 150%;"></i></button>
                   <?php endif ?>
                   </td>

                   <td style="text-align: center;">
                   <?php if ($cotizacion["Id_Estado"] == 3): ?>
                      <a class="btn btn-box-tool"><i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size: 150%;"></i></a>
                   <?php else: ?>
                      <a target="_blank" href='<?= URL ?>/ctrCotizacion/cotizacion/<?= $cotizacion["Id_Solicitud"] ?>' class="btn btn-box-tool" id="buttonID" ><i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size: 150%;"></i></a>
                   <?php endif ?> 
                  </td>
                   <td style="text-align: center;">
                   <?php if ($cotizacion["Sol_Repetida"] == 2 || $cotizacion["Id_Estado"] == 3): ?>
                     <button type="button" disabled="" class="btn btn-box-tool"><i class="fa fa-share" style="color:#5A69F2; font-size: 150%;" aria-hidden="true"></i></button>
                   <?php else: ?>
                      <button type="button" id="convertiPedido" class="btn btn-box-tool" onclick='convertirPedido("<?= $cotizacion['Id_Solicitud'] ?>", this,"<?= $cotizacion['Id_Estado']?>"); fichasAsociad("<?= $cotizacion["Id_Solicitud"] ?>","",3);'><i class="fa fa-share" style="color:#5A69F2; font-size: 150%;" aria-hidden="true"></i></button>
                   <?php endif ?>
                   </td>
                  <td>
                   <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#DetallesAso" onclick='fichasAsociad("<?= $cotizacion["Id_Solicitud"] ?>","",2)'><i class="fa fa-eye" style="color:#3B73FF; font-size: 150%;" aria-hidden="true"></i></button>
                  </td>

                </tr>

                <?php endforeach; ?> 
                </tbody>
              </table>
            </div>
          </div>
      </form>
     </div>
      <div class="box-footer">
    </div>
    </div>
</section>

 <!-- Modal De Modificar -->

<!--  <style type="text/css">
        #dl{
           width: 53% !important;
        }
 </style> -->
<div class="modal fade" id="myModal3" tabindex="" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document" id="dl">
        <div class="modal-content" style="border-radius: 10px;">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">MODIFICAR COTIZACIÓN</h4>
          </div>

          <div>
          <form  id="myModal3" action="<?= URL ?>ctrCotizacion/modiCotizacion" method="post" role="form" onsubmit="return ValCot()" data-parsley-validate="">
                  
                  <!-- <div class="form-group col-sm-5"> -->
                    <!-- <label class="">Codigo</label> -->
                    <input type="hidden" class="form-control" name="codigo" id="Codigo" readonly="" style="border-radius: 5px;">
                  <!-- </div> -->
                    
                  <div class="row col-sm-12">
                    <div class="form-group col-sm-4">
                      <label class="">Estado</label>
                      <select class="form-control" name="estad" id="Estado" style="border-radius: 5px;">
                        <option value="2">No Entregada</option>
                        <option value="1">Entregada</option>
                      </select>
                    </div>

                    <div class="form-group col-sm-4">
                      <label class="">Fecha de Registro</label>
                      <input type="text" class="form-control" value="<?php echo date ("Y-m-d"); ?>" name="fechaRegistro" id="Fecha_Registro" readonly="" style="border-radius: 5px;">
                    </div>
                    <div class="form-group col-sm-4">
                      <label class="">Fecha de Vencimineto</label>
                      <input type="text" class="form-control" name="fechaVencimiento" id="FechaVencimiento" style="border-radius: 5px;" data-parsley-required="">
                    </div>
                  </div>

                  <div class="row col-sm-12">
                    <div class="form-group col-sm-4">
                      <label for="id_cliente" class="">Asociar Cliente</label>
                      <select class="form-control" style="border-radius:5px; width: 100%; height: 200%;" name="id_cliente" id="Cliente">
                      <option value=""></option>
                        <?php foreach ($clientes as $cliente): ?>
                          <option value="<?= $cliente["Num_Documento"] ?>"><?= $cliente["Num_Documento"] ." - ".$cliente["Nombre"]?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="col-sm-offset-4 col-sm-4" style="margin-top: 25px;">
                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Productos"><b>Asociar Productos</b></button>
                    </div>
                  </div>                

              <div class="table">
                <div class="form-group col-sm-12 table-responsive scrolltablas">
                  <table class="table table-hover table-responsive table-bordered" style="margin-top: 2%;" id="Asopedido">
                    <thead>
                      <tr class="active">
                        <th>Referencia</th>
                        <th>Nombre</th>
                        <th>Color</th>
                        <th>Cantidad</th>
                        <th>Valor Producto</th>
                        <th>Subtotal</th>
                        <th>Quitar</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            <div class="row col-sm-12">
              <div class="form-group col-sm-5">
              <label for="valor_total" class="">Valor Total:</label>
              <div class="input-group">
                <span class="input-group-addon"><b>$</b></span>
                <input class="form-control" type="text" name="valor_total" id="valor_total" readonly="" style="border-radius:5px;">
              </div>
            </div>
            </div>

          <div class="modal-footer" style="border-top:0px;">
            <div class="row">
              <div class="col-md-offset-3 col-md-3">
                <button type="submit" class="btn btn-warning btn-md btn-block" name="btnModificar"  style="margin-top: 15px; padding:5px 24px !important;"><i class="fa fa-refresh" aria-hidden="true"></i> <b>Actualizar</b></button>
              </div>
              <div class="col-md-3">
                <button type="button" class="btn btn-default btn-md btn-block" class="close" data-dismiss="modal" aria-label="Close" style="margin-left:15px; margin-top: 15px; padding:5px 24px !important;"><i class="fa fa-times-circle" aria-hidden="true"></i> <b>Cerrar</b></button>
              </div>
            </div>
        </div>
          </form> 
             </div> 
         </div>           
      </div>           
  </div>


   <div class="modal fade" id="DetallesAso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 10px;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <h4 class="modal-title"><b>PRODUCTOS ASOCIADOS</b></h4>
            </div>
            <div class="modal-body" style="padding:10px;">
              <div class="table">
                <div class="form-group col-sm-12 table-responsive scrolltablas">
                  <table class="table table-hover table-responsive table-bordered" style="margin-top: 2%;" id="fichaAsociadas">
                    <thead>
                      <tr class="active">
                        <th>Referencia</th>
                        <th>Nombre</th>
                        <th>Color</th>
                        <th>Cantidad</th>
                        <th>Valor Producto</th>
                        <th>Subtotal</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer" style="border-top:none; border-bottom:1px solid;">
              <button type="button" class="btn btn-default btn-lg" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
            </div>
          </div>
      </div>
 </div>


      <div class="modal fade" id="Productos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>PRODUCTOS PARA ASOCIAR</b></h4>
            </div>
            <div class="modal-body" style="padding:10px;">
              <div class="table">
                <div class="col-sm-12 table-responsive">
                <table class="table table-responsive" id="tblfichascotiz">
                <thead>
                  <tr class="active">
                    <th>Referencia</th>
                    <th>Nombre</th>
                    <th>Color</th>
                    <th>Valor Producción</th>
                    <th>Valor Producto</th>
                    <th>Agregar</th>
                  </tr>
                </thead>
                <tbody>
                <?php $p = 1; ?>
                <?php foreach ($productos as $producto): ?>
                  <tr>
                    <td><?= $producto["Referencia"] ?></td>
                    <td><?= $producto["Nombre"] ?></td>
                    <td><i class="fa fa-square" style="color:<?= $producto["Codigo_Color"] ?>; font-size: 200%;" title="<?= $producto["Nombre_Color"] ?>"></i></td>
                    <td><?= $producto["Valor_Produccion"] ?></td>
                    <td><?= $producto["Valor_Producto"] ?></td>
                    <td>
                      <button id="botn<?= $producto["Id_Ficha_Tecnica"] ?>" type="button" class="btn btn-box-tool" onclick="Modificar_ProductoAso('<?= $producto["Referencia"] ?>', '<?= $producto["Codigo_Color"] ?>', '<?= $producto["Valor_Producto"] ?>', this, '<?= $p; ?>', '<?= $producto["Id_Ficha_Tecnica"] ?>')"><i style="font-size: 150%; color: blue;" class="fa fa-plus"></i></button>
                    </td>
                  </tr>
                  <?php $p++; ?>
                <?php endforeach; ?>
                </tbody>
              </table>
              </div>
              </div>
            </div>
            <div class="modal-footer" style="border-top:none; border-bottom:1px solid;">
              <button type="button" class="btn btn-default btn-lg" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
            </div>
          </div>
        </div>
      </div>
<!-- Modal -->











<div class="modal fade" id="modalConvPed" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 10px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">CONVERTIR EN PEDIDO</h4>
      </div>
      <form data-parsley-validate=""  id="myModal3" action="<?= URL ?>ctrCotizacion/converCotiAPe" method="post" role="form" onsubmit="return ValCotPedi()">
        <div class="modal-body">
          <div class="row col-sm-12">
            <input type="hidden" class="form-control" name="codisoli" id="Codig" readonly="" style="border-radius: 5px;">
            <div class="col-sm-5">
              <label class="">Fecha de Registro:</label>
                <input type="text" class="form-control" value="<?php echo date ("Y-m-d"); ?>" name="fechaRegistro" id="Fecha_Registr" readonly="" style="border-radius: 5px;">
            </div>
            <div class="form-group col-sm-offset-1 col-sm-6">
              <label class="">Estado:</label>
              <input type="text" value="Pendiente" readonly="" class="form-control">
            </div>
          </div>
          <div class="row col-md-12" style="margin-bottom: 30px;">
            <div class="col-md-5">
              <label for="aso_cliente" class="">Cliente:</label>
                  <input type="hidden" name="cliente" id="ced_cliente">
                  <input type="text" class="form-control"  id="Client" readonly="" style="border-radius: 5px;" size="28%">
            </div>
            <div class="col-sm-offset-1 col-sm-6">
              <label class="">*Fecha de Entrega:</label>
              <input type="text" class="form-control" name="Fechaentre" id="Fechaentre" style="border-radius: 5px;">
            </div>
          </div>
          <div class="row" style="margin: 5px; padding-top: 5px;">
            <div class="col-md-12"> 
              <label>Productos Asociados:</label>
            </div>
          </div>
          <div class="row col-sm-12">
            <div class="table">
              <div class="col-sm-12 table-responsive scrolltablas">
                  <table class="table table-hover table-bordered" style="margin-top: 2%;" id="fichaAsoConvPedido">
                    <thead>
                      <tr class="active">
                        <th>Referencia</th>
                        <th>Color</th>
                        <th>Cantidad Cotizada</th>
                        <th>Valor Producto</th>
                        <th>Subtotal</th>
                        <th style="display: none;"></th>
                        <th>Cantidad a Producir</th>
                        <th style="width: 15%">Usar</th>
                        <th>ProductoT</th>
                        <th style="display: none;"></th>
                        <th style="display: none;"></th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-5">
                <label class="">Valor Total:</label>
                <input type="text" class="form-control" name="valorTotal" id="ValorTota" readonly="" style="border-radius: 5px;">
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-right" style="margin-left: 2%;" data-dismiss="modal" aria-label="Close"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
        <button type="submit" onclick="updateSolProCot()" class="btn btn-success pull-right" name="gurdarPedi"><i class="fa fa-send-o" aria-hidden="true"></i> <b>Enviar a Pedido</b></button>
      </div>
     </form> 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
 </div><!-- /.modal -->


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