<section class="content-header">
  <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li><a href="#">Cliente</a></li>
        <li class="active">Registrar Cotización</li>
      </ol>
</section>
 
    <section class="content">
      <br>
      <div class="box box-info" style="padding-right: 15px;">
          <div class="box-header with-border">
            <div class="box-header with-border" style="text-align: center;">
              <h3 class="box-title"><strong>REGISTRAR COTIZACIÓN</strong></h3>
            </div>

            <br>

            <form action="<?php echo URL; ?>Cotizacion/regCotizacion" method="POST" id="form">
            <br>
            <div class="row col-lg-12">

              <!--   <div class="form-group col-lg-1">
                  <label for="id_pedido" class="">Código</label>
                  <input type="text" class="form-control" id="id_pedido" placeholder="" value="3" disabled="disabled">
                </div> -->

                <div class="form-group col-lg-push-1 col-lg-4">
                  <label class="">Fecha Registro</label>
                  <div class="">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" value="<?php echo date ("Y/m/d"); ?>" name="fecha_R" readonly="">
                    </div>
                  </div>
                </div>

                <div class="form-group col-lg-push-3 col-lg-3">
                  <label for="estado" class="">Estado</label>
                  <select class="form-control" name="estado" id="estado" required="">
                    <option value="No Entregada" selected>No Entregada</option>
                    <option value="Entregada">Entregada</option>
                    <option value="Vencida">Vencida</option>
                    <option value="Canceladas">Cancelado</option>
                  </select>
                </div>

              </div>
              <div class="row col-lg-12">
                <div class="form-group col-lg-push-1 col-lg-4">
                  <label class="">Fecha Vencimiento</label>
                    <div class="">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" name="fecha_V" required="" id="fecha1">
                      </div>
                    </div>
                </div>

               <!--  <div class="form-group col-lg-push-3 col-lg-4">
                  <label for="aso_cliente" class="">Asociar Cliente</label>
                  <form action="#" method="get" class="form-horizontal">
                            <div class="input-group">
                              <input type="text" name="q" class="form-control">
                                  <span class="input-group-btn">
                                    <button type="button" id="search-btn" class="btn btn-flat"><i class="fa fa-search" data-toggle="modal" data-target="#ModelProducto"></i>
                                    </button>
                                  </span>
                            </div>
                    </form>
                </div> -->

                 <div class="form-group col-lg-push-3 col-lg-7">
                  <label for="aso_cliente" class="">Asociar Cliente</label>
                  <!-- <form action="#" method="post" class="form-horizontal"> -->
                       <div class="input-group col-lg-5">
                          <input type="text" name="cliente" class="form-control" id="cliente" required="">
                         <span class="input-group-btn">
                            <button type="button" id="search-btn" class="btn btn-flat"><i class="fa fa-search" data-toggle="modal" data-target="#ModelProducto"></i>
                            </button>
                          </span>
                      </div>
                  </div>
                  </div>
                

                  <!-- </form> -->
                <!-- <div class="form-group">
                  <br>
                  <br>

                  <div class="table row">
                      <div class="col-lg-12 table-responsive">
                        <table class="table table-hover" style="margin-top: 2%;">
                          <thead>
                            <tr class="info">
                              <th>Código</th>
                              <th>Referencia</th>
                              <th>Color</th>
                              <th>Talla</th>
                              <th>Cantidad</th>
                              <th>Valor</th>
                              <th>Opción</th>
                              <th><button type="button" class="btn btn-default btn-xs" type="button"><b>+</b></button></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td>201</td>
                              <td>Rojo</td>
                              <td>
                                <select class="form-control" disabled>
                                  <option value="talla1">L</option>
                                  <option value="talla2">M</option>
                                  <option value="talla3" selected>S</option>
                                </select>
                              </td>
                              <td>60</td>
                              <td>$350000</td>
                              <td><button type="button" class="btn btn-box-tool" data-widget=""><i class="fa fa-times"></i></button></td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td>202</td>
                              <td>Verde</td>
                              <td>
                                <select class="form-control" disabled>
                                  <option value="talla1">L</option>
                                  <option value="talla2" selected>M</option>
                                  <option value="talla3">S</option>
                                </select>
                              </td>
                              <td>150</td>
                              <td>$590000</td>
                              <td><button type="button" class="btn btn-box-tool" data-widget=""><i class="fa fa-times"></i></button></td>
                            </tr>
                            <tr>
                              <td>3</td>
                              <td>203</td>
                              <td>Azul-Violeta</td>
                              <td>
                                <select class="form-control" disabled>
                                  <option value="talla1">L</option>
                                  <option value="talla2" selected>M</option>
                                  <option value="talla3">S</option>
                                </select>
                              </td>
                              <td>200</td>
                              <td>$602500</td>
                              <td><button type="button" class="btn btn-box-tool" data-widget=""><i class="fa fa-times"></i></button></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                  </div>
                </div> -->

            <div class="row col-lg-12">
              <div class="form-group col-lg-push-7 col-lg-3">
                <label for="vlr_total" class="">Valor Total</label>
                  <!-- <form action="#" method="post" class="form-horizontal"> -->
                    <div class="input-group col-lg-12">
                      <input type="text" class="form-control" name="vlr_total" placeholder="" required="">
                        <span class="input-group-btn">
                          <button type="button" id="myModal-btn" class="btn btn-flat"><i class="fa fa-plus" data-toggle="modal" data-target="#ModelProducto"></i></button>
                        </span>
                    </div>
                </div>
              </div>
             <br>

              <div class="row">
                <div class="form-group">
                  <div class="form-group col-lg-12">
                  <button type="submit" class="btn btn-primary  col-lg-offset-9" name="btnRegistrar" style="margin-top: 15px;" data-toggle="modal" data-target="#modpedidoregist">Registrar</button>
                  <button type="reset" class="btn btn-danger" style="margin-left: 15px; margin-top: 15px;">Cancelar</button>
                  </div>
                </div>
             </div>

              <!-- Modal -->

        <!--<div class="modal fade" id="modpedidoregist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Mensaje</h4>
                    </div>
                    <div class="modal-body">Cotización Registrada Exitosamente!</div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                    </div>
                  </div>
                </div>
              </div> -->

         <!--Modal de valor tota-->

      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Agregar Cotizacion</h4>
            </div>

            <div>
                <form  id="myModal" action="<?= URL ?>cotizacion/modiCotizacion" method="post" role="form">

                <table class="table">
                  <thead>
                    <tr class="info">
                      <th>Codigo</th>
                      <th>Valor</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>

                 <tbody>
                  <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                  </tr>
                  </tbody>
                </table> 

             <div class="modal-footer">
              <button type="submit" class="btn btn-primary" data-dismiss="modal">Agregar Cotizacion</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div> 

            </form>
          </div>
         </div> 
        </div> 
      </div>
         <!--Fin del modal valor total-->     



         <!--Modal de asociar cliente -->

          <div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Asociar Cliente</h4>
            </div>

            <div>
                <form  id="mymodal" action="<?= URL ?>cotizacion/modiCotizacion" method="post" role="form">

                <table class="table">
                  <thead>
                    <tr class="info">
                      <th>Documento</th>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Opcion</th>
                    </tr>
                  </thead>

                 <tbody> 
                 <?php foreach ($clientes as $cliente):?>
                  <tr>
                    <td><?php echo $cliente["documento"] ?></td>
                    <td><?php echo $cliente["nombre"] ?></td>
                    <td><?php echo $cliente["email"] ?></td>
                    <td>
                      <button class="btn btn-primary" onclick="return agregarCliente('<?= $cliente['documento'] ?>')">
                        Agregar
                      </button>
                    </td>
                  </tr>
                <?php endforeach ?>
                 </tbody>
               </table> 

             <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div> 

            </form>
          </div>
         </div> 
        </div> 
      </div>

         <!--Fin de asociar cliente -->

        </form>
      </div>
    </div>
</section>

<script type="text/javascript">
  function agregarCliente(documento){
    var docu = $("#cliente");
    var moda = $("#mymodal");
    docu.val(documento);
    moda.modal("hide");
    return false;
  }

</script>