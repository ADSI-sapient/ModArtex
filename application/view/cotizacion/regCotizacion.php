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
        <h3 class="box-title"><strong>REGISTRAR COTIZACIÓN</strong></h3>
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