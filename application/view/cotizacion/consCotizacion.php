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
                <table class="table table-hover" id="tblCotizaciones">
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
                      <th class="col-md">Convertir en Pedido</th>
                    </tr>
                  </thead>
                  <tbody class="">
                  <?php foreach ($cotizaciones as $cotizacion):?>
                  <tr>
                    <td class="Id_Solicitud"><?= $cotizacion["Id_Solicitud"] ?></td>         
                    <td class="Fecha_Registro"><?= $cotizacion["Fecha_Registro"] ?></td>
                    <td class="Num_Documento"><?= $cotizacion["Nombre"] ?></td>
                    <td class="Fecha_Vencimiento"><?= $cotizacion["Fecha_Vencimiento"] ?></td>
                    <td class="Id_Estado"><?= $cotizacion["Nombre_Estado"] ?></td>
                    <td class="Valor_Total"><?= $cotizacion["Valor_Total"] ?></td>
                    <td class="Num_Documento" style="display: none;"><?= $cotizacion["Num_Documento"] ?></td>

                    <!--<td class="tado"><?= $cotizacion["Id_Estado"]==1?"Habilitado":"Inhabilitado"?></td>-->

                   <td>
                    <button type="button" class="btn btn-box-tool" onclick='editarCotizacion("<?= $cotizacion['Id_Solicitud'] ?>", this,"<?= $cotizacion['Id_Estado']?>"); fichasAsociad("<?= $cotizacion['Id_Solicitud'] ?>")'><i class="fa fa-pencil-square-o fa-lg"></i></button>
                   </td>

                   <td><a target="_blank" href='<?= URL ?>/ctrCotizacion/cotizacion/<?= $cotizacion["Id_Solicitud"] ?>' class="btn btn-box-tool" id="buttonID" ><i class="fa fa-file-pdf-o fa-md" aria-hidden="true"></i></a> </td>

                   <td><button type="button" class="btn btn-box-tool" onclick='convertirPedido("<?= $cotizacion['Id_Solicitud'] ?>", this,"<?= $cotizacion['Id_Estado']?>")'><i class="fa fa-share fa-lg" style="color:#5A69F2;" aria-hidden="true"></i></button></td>
                  
                   <!-- <td class="text-center">
                    
                    <?php if ($cotizacion["Id_Estado"] == 1){ ?>
                    
                    <a href="#" onclick='cambiarEstadoCoti("<?= $cotizacion['Id_Solicitud'] ?>", 2)'><i class="fa fa-check"></i></a>
                        
                    <?php }else if($cotizacion["Id_Estado"] == 2){ ?>

                    <a href="#" onclick='cambiarEstadoCoti("<?= $cotizacion["Id_Solicitud"] ?>", 1)'><i class="fa fa-minus-circle"></i></a>
                        
                    <?php } ?>
                </td> -->
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

 <!-- Modal De Modificar -->

 <style type="text/css">
        #dl{
           width: 53% !important;
        }
 </style>

<div class="modal fade" id="myModal3" tabindex="" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document" id="dl">
        <div class="modal-content" style="border-radius: 10px;">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Modificar Cotizacion</h4>
          </div>

          <div>
              <form  id="myModal3" action="<?= URL ?>ctrCotizacion/modiCotizacion" method="post" role="form">
                  
                  <!-- <div class="form-group col-sm-5"> -->
                    <!-- <label class="">Codigo</label> -->
                    <input type="hidden" class="form-control" name="codigo" id="Codigo" readonly="" style="border-radius: 5px;">
                  <!-- </div> -->
                    
                  <div class="form-group col-sm-5">
                    <label class="">Estado</label>
                    <select class="form-control" name="estad" id="Estado" style="border-radius: 5px;">
                      <option value="1">Entregada</option>
                      <option value="2">No Entregado</option>
                      <option value="3">Vencida</option>
                      <option value="4">Cancelada</option>
                    </select>
                  </div>

                  <div class="form-group col-sm-5 col-sm-push-2">
                    <label class="">Fecha de Registro</label>
                    <input type="text" class="form-control" value="<?php echo date ("Y-m-d"); ?>" name="fechaRegistro" id="Fecha_Registro" readonly="" style="border-radius: 5px;">
                  </div>

                  <div class="form-group col-sm-5">
                    <label class="">Fecha de Vencimineto</label>
                    <input type="text" class="form-control" name="fechaVencimiento" id="FechaVencimiento" style="border-radius: 5px;">
                  </div>

                <!--   <div class="form-group col-sm-5">
                    <label for="aso_cliente" class="">Asociar Cliente</label>
                      <div class="input-group">
                      <input type="hidden" name="cliente" id="ced_cliente"></input>
                      <input type="text" class="form-control"  id="Cliente" readonly="" style="border-radius: 5px;">
                        <span class="input-group-btn">
                          <button type="button" id="search-btn" class="btn btn-flat">
                          <i class="fa fa-search" data-toggle="modal" data-target="#mymoda"></i>
                          </button>
                        </span>
                    </div>
                  </div> -->

                  <div class="form-group col-lg-5 col-lg-push-2">
                    <label for="id_cliente" class="" >Asociar Cliente</label>
                    <select class="form-control" style="border-radius:5px; width: 100%; height: 200%;" name="id_cliente" id="Cliente">
                    <option value=""></option>

                      <?php foreach ($clientes as $cliente): ?>
                        <option value="<?= $cliente["Num_Documento"] ?>"><?= $cliente["Num_Documento"] ." - ".$cliente["Nombre"]?></option>
                      <?php endforeach ?>
                      
                    </select>
                  </div>                 

              <div class="table">
                <div class="form-group col-sm-12 table-responsive">
                <label for="valor_total" class="form-group col-sm-0">Fichas Asociadas</label>

                  <table class="table table-hover table-responsive" style="margin-top: 2%;" id="Asopedido">
                    <thead>
                      <tr class="active">
                        <th>Referencia</th>
                        <th>Color</th>
                        <th>Cantidad a Producir</th>
                        <th>Valor Producto</th>
                        <th>Subtotal</th>
                        <th>Quitar</th>
                        <th><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Productos"><b>Agregar</b></button></th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            <div class="form-group col-sm-5">
              <label for="valor_total" class="">Valor Total:</label>
              <input class="form-control" type="text" name="valor_total" id="valor_total" readonly="" style="border-radius:5px;">
            </div>

          <div class="modal-footer" style="border-top:0px;">
           <div  class="col-sm-push-4 col-sm-8">
            <button type="submit" class="btn btn-primary" name="btnModificar">Guardar modificacion</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
           </div>
        </div>
          </form> 
             </div> 
         </div>           
      </div>           
  </div>           


      <div class="modal fade" id="Productos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>Fichas Para Asociar</b></h4>
            </div>
            <div class="modal-body" style="padding:10px;">
              <div class="table">
                <div class="col-sm-12 table-responsive">
                <table class="table table-responsive">
                <thead>
                  <tr class="active">
                    <th>Referencia</th>
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
                    <td><i class="fa fa-square" style="color:<?= $producto["Codigo_Color"] ?>; font-size: 150%;"></i></td>
                    <td><?= $producto["Valor_Produccion"] ?></td>
                    <td><?= $producto["Valor_Producto"] ?></td>
                    <td>
                      <button id="botn<?= $producto["Referencia"] ?>" type="button" class="btn btn-box-tool" onclick="Modificar_ProductoAso('<?= $producto["Referencia"] ?>', '<?= $producto["Codigo_Color"] ?>', '<?= $producto["Valor_Producto"] ?>', this, '<?= $p; ?>', '<?= $producto["Id_Ficha_Tecnica"] ?>')"><i class="fa fa-plus"></i></button>
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
              <button type="button" class="btn btn-primary" data-dismiss="modal"><b>Aceptar</b></button>
            </div>
          </div>
        </div>
      </div>
 

<!-- Modal -->
           
<style type="text/css">
        #al{
           width: 68% !important;
        }
 </style>

<div class="modal fade" id="mymoda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" id="al">
        <div class="modal-content" style="border-radius: 10px;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Asociar Cliente</h4>
          </div>
          <div class="modal-body">
         <div class="table">
        <div class="col-sm-12 table-responsive">
           
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
                      <button class="btn btn-box-tool" onclick="agregarCliente('<?= $cliente['Num_Documento'] ?>','<?= $cliente['Nombre']?>')"><i class="fa fa-plus"></i></button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table> 
          </div>
          </div>
         </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
        </div> 
      </div>
    </div> 
  </div> 
</div>
<!--fin-->

<div class="modal fade" id="modalConvPed" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 10px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Convertir a Pedido</h4>
      </div>
      <div class="modal-body">
        

           <form  id="myModal3" action="<?= URL ?>ctrCotizacion/converCotiAPe" method="post" role="form">
                  
                  <div class="form-group col-sm-5">
                    <label class="">Codigo</label>
                    <input type="text" class="form-control" name="codisoli" id="Codig" readonly="" style="border-radius: 5px;">
                  </div>
                    
                  <div class="form-group col-sm-push-2 col-sm-5">
                    <label class="">Estado</label>
                    <input type="text" value="Pendiente" readonly="" class="form-control">
                  </div>

                  <div class="form-group col-sm-5">
                    <label class="">Fecha de Registro</label>
                    <input type="text" class="form-control" value="<?php echo date ("Y-m-d"); ?>" name="fechaRegistro" id="Fecha_Registr" readonly="" style="border-radius: 5px;">
                  </div>

                  <div class="form-group col-sm-push-2 col-sm-5">
                    <label class="">Fecha de Entrega</label>
                    <input type="text" class="form-control" name="Fechaentre" id="Fechaentre" style="border-radius: 5px;">
                  </div>

                  <div class="form-group col-sm-5">
                    <label for="aso_cliente" class="">Asociar Cliente</label>
                      <div class="input-group">
                        <input type="hidden" name="cliente" id="ced_cliente"></input>
                        <input type="text" class="form-control"  id="Client" readonly="" style="border-radius: 5px;" size="28%">
                    </div>
                  </div>
   
                  <div class="form-group col-sm-push-2 col-sm-5">
                     <label class="">Valor Total</label>
                     <input type="text" class="form-control" name="valorTotal" id="ValorTota" readonly="" style="border-radius: 5px;">
                  </div>

              <!--   <div class="row col-sm-12">
                  <div class="form-group col-lg-3">
                  <button type="button" class="btn btn-primary btn-md" id="myModal-btn" data-toggle="modal" data-target="#ModelProducto"><b>Modificar Fichas</b></button>
                  </div>
                </div> -->

      <div class="modal-footer">
      <div class="row col-sm-push-8 col-sm-5">
       <br />
        <button type="submit" class="btn btn-primary" name="gurdarPedi" onclick="enviarPedido('<?= $pedido["Id_Solicitud"] ?>')">Enviar Pedido</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</section>

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