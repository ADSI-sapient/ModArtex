<section class="content-header">
  <ol class="breadcrumb">
      <li><a href="<?php echo URL; ?>home/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="#">Cotizacion</a></li>
      <li class="active">Listar Cotizaciones</li>
  </ol>
    <br>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="box box-info">
      <div class="box-header with-border">
      <div class="box-header with-border"  style="text-align: center;">
        <h3 class="box-title"><strong>LISTAR COTIZACIONES</strong></h3>
      </div>

    <div id="users">
      <div class="row box-header">
        <div class="col-md-8"></div>
           <div class="col-md-4">
            <div class="form-group">
              <div class="box-tools pull-right"></div>
            </div>
          </div>
      </div>
    </div>

      <form class="form-horizontal">
      <div>
        <div class="col-md-12">
          <div class="box">
            <div class="table table-responsive">
              <table class="table table-hover" id="myTable">

                <thead>
                  <tr class="info">
                    <th style="width: 10px">Código</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Fecha Registro</th>
                    <th>Fecha Vencimiento</th>
                    <th>Valor Total</th>
                    <th style="display: none;"></th>
                    <th style="width: 7%">Opción</th>
                  </tr>
                </thead>

            <tbody class="list">

                <?php foreach ($cotizaciones as $cotizacion):?>
                  
                 <tr>
                    <td class="Id_Solicitud"><?= $cotizacion["Id_Solicitud"] ?></td>                 
                    <td class="Num_Documento"><?= $cotizacion["Nombre"] ?></td>
                    <td class="Id_Estado"><?= $cotizacion["Nombre_Estado"] ?></td>
                    <td class="Fecha_Registro"><?= $cotizacion["Fecha_Registro"] ?></td>
                    <td class="Fecha_Vencimiento"><?= $cotizacion["Fecha_Vencimiento"] ?></td>
                    <td class="Valor_Total"><?= $cotizacion["Valor_Total"] ?></td>
                    <td class="Num_Documento" style="display: none;"><?= $cotizacion["Num_Documento"] ?></td>

                    <!--<td class="tado"><?= $cotizacion["Id_Estado"]==1?"Habilitado":"Inhabilitado"?></td>-->

                    <td>
                    <button type="button" class="btn btn-box-tool" onclick='editarCotizacion("<?= $cotizacion['Id_Solicitud'] ?>", this)'><i class="fa fa-pencil-square-o"></i></button>
                     <a href='<?= URL ?>/ctrCotizacion/factura/<?= $cotizacion["Id_Solicitud"] ?>' class="btn btn-box-tool" id="buttonID" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a> 
                    </td>
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
         </div>
        </div>
      </form>
    </div>

 <!-- Modal De Modificar -->

 <style type="text/css">
        #dl{
           width: 50% !important;
        }
 </style>




<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document" id="dl">
        <div class="modal-content" style="border-radius: 10px;">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Modificar Cotizacion</h4>
          </div>

          <div>
              <form  id="myModal3" action="<?= URL ?>ctrCotizacion/modiCotizacion" method="post" role="form">
                  
                  <div class="form-group col-sm-5">
                    <label class="">Codigo</label>
                    <input type="text" class="form-control" name="codigo" id="Codigo" readonly="" style="border-radius: 5px;">
                  </div>
                    
                  <div class="form-group col-sm-push-2 col-sm-5">
                    <label class="">Estado</label>
                    <select class="form-control" name="estad" id="Estado" style="border-radius: 5px;">
                      <option value="1">Entregado</option>
                      <option value="2">No Entregado</option>
                      <option value="3">Vencida</option>
                      <option value="4">Cancelar</option>
                    </select>
                  </div>

                  <div class="form-group col-sm-5">
                    <label class="">Fecha de Registro</label>
                    <input type="text" class="form-control" value="<?php echo date ("Y-m-d"); ?>" name="fechaRegistro" id="Fecha_Registro" readonly="" style="border-radius: 5px;">
                  </div>

                  <div class="form-group col-sm-push-2 col-sm-5">
                    <label class="">Fecha de Vencimineto</label>
                    <input type="text" class="form-control" name="fechaVencimiento" id="FechaVencimiento" style="border-radius: 5px;">
                  </div>

                  <div class="form-group col-sm-5">
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
                  </div>
   
                  <div class="form-group col-sm-push-2 col-sm-5">
                     <label class="">Valor Total</label>
                     <input type="text" class="form-control" name="valorTotal" id="ValorTotal" readonly="" style="border-radius: 5px;">
                  </div>
                  <br />

           <div class="modal-footer">
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
 

<!-- Modal -->
           
<style type="text/css">
        #al{
           width: 67% !important;
        }
 </style>

<div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                    <td><?php echo $cliente["Id_tipo"] ?></td>
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
</section>