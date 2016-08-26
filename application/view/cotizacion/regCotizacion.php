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

      <form action="<?php echo URL; ?>ctrCotizacion/regCotizacion" method="POST" id="form">

        <div class="row col-lg-12">

          <div class="form-group col-lg-4">
            <label class="">Fecha Registro</label>
            <div class="">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" value="<?php echo date ("Y-m-d"); ?>" name="fecha_R" readonly="" style="border-radius:5px;">
              </div>
            </div>
          </div>

          <div class="form-group col-lg-4">
            <label class="">Fecha Vencimiento</label>
            <div class="">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" name="fecha_V" required="" id="fecha1" style="border-radius:5px;">
              </div>
            </div>
          </div>

          <div class="form-group col-lg-4">
            <label for="estado" class="">Estado</label>
            <input type="text" name="estado" class="form-control" id="estado" readonly="" value="No Entregada">
          </div>
      </div>
     <!-- <div class="row col-lg-12">
        <div class="form-group col-lg-4">
          <label for="aso_cliente" class="">Asociar Cliente</label>
            <div class="input-group">
             <input type="hidden" name="documento_cli" value="" id="documento_cli">
              <input type="text" name="cliente" class="form-control" id="clienteReg" readonly="" value="" style="border-radius:5px;">
              <span class="input-group-btn">
                <button type="button" id="search-btn" class="btn btn-flat">
                <i class="fa fa-search" data-toggle="modal" data-target="#ModelProducto"></i>
                </button>
              </span>
          </div>
        </div>
     </div>  -->
     <div class="row col-lg-12">
            <div class="form-group col-lg-4">
              <label for="id_cliente" class="" >*Asociar Cliente:</label>
              <select class="form-control" style="border-radius:5px;" name="id_cliente" id="id_cliente">
              <option value=""></option>
                <?php foreach ($clientes as $cliente): ?>
                  <option value="<?= $cliente["Num_Documento"] ?>"><?= $cliente["Num_Documento"] ." - ".$cliente["Nombre"]?></option>
                <?php endforeach ?>
              </select>
              </div>
            </div>
                
        <div hidden="" class="form-group" id="agregarFicha">
            <div class="table">
              <div class="col-lg-12 table-responsive">
                <table class="table table-hover" style="margin-top: 2%;" id="Ficha">
                  <thead>
                    <tr class="active">
                      <th>Referencia</th>
                      <th>Color</th>
                      <th>Valor Producto</th>
                      <th>Cantidad a Producir</th>
                      <th>Subtotal</th>
                      <th>Quitar</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
        </div>

        <div class="row col-lg-12">
            <div class="form-group col-lg-3">
              <button type="button" class="btn btn-info btn-md" id="" data-toggle="modal" data-target="#ModelProducto"><b>Asociar Fichas</b></button>
            </div>
        </div>

          <div class="row col-lg-12">
            <div class="form-group col-lg-offset-8 col-lg-4">
              <label for="vlr_total" class="">Valor Total:</label>
              <div class="">
                <div class="input-group">
                  <div class="input-group-btn" style="border-radius:5px; margin-bottom:10%;">
                    <button type='button' id="confir" readonly="" onclick="calcularValorTotal()" class='btn btn-info'><b>Calcular</b></button>
                  </div>
                  <input type="text" name="vlr_total" class="form-control" id="vlr_total" readonly="" value="0" required="" style="border-radius:5px;">
                </div>
              </div>
            </div>
          </div>

        <div class="row">
          <div class="form-group">
            <div class="form-group col-lg-12">
              <button type="submit" class="btn btn-primary  col-lg-offset-9" name="btnRegistrar" onclick="" style="margin-top: 15px;" data-toggle="modal" data-target="#modpedidoregist">Registrar</button>
              <button type="reset" class="btn btn-danger" style="margin-left: 15px; margin-top: 15px;">Cancelar</button>
            </div>
          </div>
        </div>

      <div class="modal fade" id="ModelProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Agregar Ficha</h4>
            </div>
            <div>

              <form  id="myModal" action="<?= URL ?>cotizacion/modiCotizacion" method="post" role="form">
           <div class="table">
                <div class="col-lg-12 table-responsive">
                  <table class="table table-hover" style="margin-top: 2%;" id="tablaFicha">
                    <thead>
                      <tr class="active">
                        <th style="display: none;"></th>
                        <th>Referencia</th>
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
                      <td><?= $ficha["Estado"]==1?"Habilitado":"Inhabilitado" ?></td>
                      <td><i class="fa fa-square" style="color:<?= $ficha["Codigo_Color"] ?>; font-size: 150%;"></i></td>
                      <td><?= $ficha["Valor_Produccion"] ?></td>
                      <td><?= $ficha["Valor_Producto"] ?></td>
                      <td>
                      <button id="b<?= $i; ?>" type="button" class="btn btn-box-tool" onclick="asociarFichaCoti('<?= $ficha["Referencia"] ?>', '<?= $ficha["Codigo_Color"] ?>', '<?= $ficha["Valor_Producto"] ?>', this, '<?= $i; ?>', '<?= $ficha["Id_Ficha_Tecnica"] ?>')"><i class="fa fa-plus"></i></button>
                      </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                  </tbody>

                  </table>
                </div>
              </div>

      <div class="modal-footer" style="border-top:0px;">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
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
</div>

</section>