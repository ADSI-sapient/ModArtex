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
      <div class="box-body">
      <form data-parsley-validate="" action="<?php echo URL; ?>ctrCotizacion/regCotizacion" method="POST" id="form" onsubmit="return ValCoti()">
        <div class="row col-lg-12" style="margin-left:0.5%">
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
                <input type="text" class="form-control pull-right" name="fecha_V" required="" id="fecha1" style="border-radius:5px;" data-parsley-required="" data-parsley-required="" data-parsley-errors-container="#regCotizv">
              </div>
            </div>
            <div id="regCotizv"></div>
          </div>
          <div class="form-group col-lg-4">

            <label for="estado" class="">Estado</label>
            <input type="text" name="estado" class="form-control" id="estado" readonly="" value="Pendiente">
          </div>
        </div>
        <div class="row col-lg-12" style="margin-left:0.5%">
            <div class="form-group col-lg-4">
              <label for="cliente" class="">*Asociar Cliente:</label>
              <select class="form-control" style="border-radius:5px;" name="cliente" id="clienteReg" data-parsley-required="" data-parsley-required="" data-parsley-errors-container="#regCotizCl">
              <option value=""></option>
                <?php foreach ($clientes as $cliente): ?>
                  <option value="<?= $cliente["Num_Documento"] ?>"><?= $cliente["Num_Documento"] ." - ".$cliente["Nombre"]?></option>
                <?php endforeach ?>
              </select>
            <div id="regCotizCl"></div>
            </div>
        <!-- </div> -->
        <!-- <div class="row col-lg-12" style="margin-left:0.5%"> -->
          <div class="form-group col-lg-3">
            <button type="button" class="btn btn-info pull-right" id="" data-toggle="modal" data-target="#ModelProducto" style="margin-top:25px"><b>Asociar Productos</b></button>
          </div>
        </div>
        <div class="form-group" id="agregarFicha">
            <div class="table" data-parsley-required="">
              <div class="col-lg-12 table-responsive">
                <table class="table table-hover table-bordered" style="margin-top: 2%;" id="Ficha">
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
                    <tr>
                      <td id="tblFichasVaciaCoti" colspan="8" style="text-align:center;"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
        <div class="row col-lg-12" style="margin-left:0.5%">
          <div class="form-group col-lg-offset-8 col-lg-4">
            <label for="vlr_total" class="">Valor Total:</label>
            <input class="form-control" type="text" name="vlr_total" id="vlr_total" value="0" readonly="" style="border-radius:5px; font-size:300;">
          </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-12" style="margin-left:14px">
              <button type="submit" class="btn btn-primary col-lg-offset-9" name="btnRegistrar" id="" data-toggle="modal" data-target="#modpedidoregist"><b>Registrar</b></button>
              <button type="reset" class="btn btn-danger" name="" onclick="limpiarFormRegFicha()"><b>Limpiar</b></button>
            </div>
        </div>
      <div class="modal fade" id="ModelProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content modal-lg" style="border-radius: 10px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Productos Para Asociar</h4>
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