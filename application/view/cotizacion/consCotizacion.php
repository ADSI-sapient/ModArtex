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
                    <th>Estado</th>
                    <th>Fecha Registro</th>
                    <th>Fecha Vencimiento</th>
                    <th>Valor Total</th>
                    <th>Cliente</th>
                    <th style="width: 7%">Opción</th>
                  </tr>
                </thead>

            <tbody class="list">

                <?php foreach ($cotizaciones as $cotizacion):?>
                  
                 <tr>
                    <td class="Id_Solicitud"><?= $cotizacion["Id_Solicitud"] ?></td>                 
                    <td class="Id_Estado"><?= $cotizacion["Id_Estado"] ?></td>
                    <td class="Fecha_Registro"><?= $cotizacion["Fecha_Registro"] ?></td>
                    <td class="Fecha_Vencimiento"><?= $cotizacion["Fecha_Vencimiento"] ?></td>
                    <td class="Valor_Total"><?= $cotizacion["Valor_Total"] ?></td>
                    <td class="Num_Documento"><?= $cotizacion["Num_Documento"] ?></td>
                    <!--<td class="tado"><?= $cotizacion["Id_Estado"]==1?"Habilitado":"Inhabilitado"?></td>-->

                    <td>
                    <button type="button" class="btn btn-box-tool" onclick='editarCotizacion("<?= $cotizacion['Id_Solicitud'] ?>", this)'><i class="fa fa-pencil-square-o"></i></button>
                    <button type="button" class="btn btn-box-tool" id="buttonID" onclick="window.open('factura.php', '_blank', 'fullscreen=yes'); return false;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button> 
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

<!-- 
      <div class="box-footer">
        <div class="box-tools">
          <ul class="pagination pagination-sm no-margin pull-right">
            <li class="disabled"><a href="#">&laquo;</a></li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">»</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

 <!-Modal De Modificar -->

<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
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
                    <select class="form-control" name="estado" id="Estado" style="border-radius: 5px;">
                      <option value="No Entregada">No Entregada</option>
                      <option value="Entregada" selected>Entregada</option>
                      <option value="Vencida">Vencida</option>
                      <option value="Canceladas">Cancelado</option>
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
                    <label class="">Cliente</label>
                    <input type="text" class="form-control" name="cliente" id="Cliente" style="border-radius: 5px;">
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
    </div>
</section>