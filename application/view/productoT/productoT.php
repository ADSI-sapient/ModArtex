    <!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="<?php echo URL ?>home/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Exitencias ProductoT</a></li>
        <li><a class="active">Exitencias ProductoT</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Inicio de listar -->
      <div class="box box-primary">
        <div class="box-header with-border"  style="text-align: center;">
          <h3 class="box-title"><strong>EXISTENCIAS PRODUCTO TERMINADO</strong></h3>
        </div>
        <div id="users">
      <form class="form-horizontal">
        <div class="col-md-12">
          <div class="table table-responsive">
            <table class="table table-hover" id="tablaProducto">
              <thead>
                <tr class="info">
                <th></th>
                 <th>Referencia</th>
                  <th>Color</th>
                  <th style="display: none">Id_Ficha</th> 
                  <th>Cantidad</th>
                  <th>Valor Producción</th>
                  <th>Stock Mínimo</th>
                  <th>Salida</th>
                </tr>
              </thead>
              <tbody class="list">
                  <?php foreach ($productos as $producto): ?>
                    <tr>
                    <th><input type="checkbox" id="chkSali<?= $producto["Referencia"] ?>"></th> 
                      <td class="Referencia"><?= $producto["Referencia"] ?></td>
                      <td class="Color"><i class="fa fa-square" style="color: <?= $producto["Codigo_Color"] ?>; font-size: 200%;"></i></td> 
                       <td class="idf" style="display: none"><?= $producto["Id_Ficha_Tecnica"] ?></td> 
                       <td class="Cantidad"><?= $producto["Cantidad"] ?></td>
                       <td class="Valor_Produccion"><?= $producto["Valor_Produccion"] ?></td>
                       <td><span class="badge bg-red"><?= $producto["Stock_Minimo"] ?></td>
                         <td>

                          <button type="button" class="btn btn-box-tool" data-toggle="modal" onclick="ProductoT('<?= $producto["Referencia"] ?>',this)"  data-target="#ModelSalida"><i style="color: red;" class="fa fa-arrow-down"></i></button> 

                  </td>
                    </tr>
                  <?php endforeach ?>
                  </tbody>
                </table>
              </div>
              <div class="col-md-12" style="text-align: right;">
             <button type="button" class="btn btn-box-tool" data-toggle="modal" onclick="Salida('<?= $producto["Referencia"] ?>',this);"  data-target="#ModalSalidas"><i style="color: red; font-size: 200%;" class="fa fa-arrow-down"></i></button> 
             </div>
            </div>
          </form>
        </div>
        <div class="box-footer">
        </div>
         </section>
      




<!--Inicio del modal de registro de salida individual-->
<div class="modal fade" id="ModelSalida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius: 30px;">
              <div class="modal-header">
                <h4 class="control-label" style="text-align: center;"><strong>SALIDA PRODUCTO TERMINADO</strong></h4>
              </div>

              <div class="modal-body">
              <form role="form" id="ModelSalida" method="post" action="<?= URL ?>ctrProductoT/salida">
                <div class="box-body""> 
                  <div class="form-group col-sm-6">
                      <label for="referencia" class="">Referencia</label>
                      <input type="text" class="form-control" name="Referencia" id="Referencia" readonly=""> 
                    </div>

                     <div class="form-group col-sm-offset-1 col-sm-5">
                     <label>Fecha</label>
                      <input type="text" name="FechaActual" class="form-control" value="<?php echo date ("Y-m-d"); ?>" readonly>
                    </div>

                     <div class="form-group col-sm-6">
                    <label for="referencia" class="">Cantidad actual</label>
                    <input type="text" class="form-control"  name="Cantidad" id="Cantidad" readonly="">
                  </div>

                   <div class="form-group col-sm-offset-1 col-sm-5">
                    <label for="color" class="">Cantidad salida</label>
                     <input type="number" class="form-control"  min="0" id="salida"     name="salida">  
                  </div>


                     <div class="form-group col-sm-12">
                     <label class="col-sm-offset-5">Descripción</label>
                          <textarea rows="4" cols="50" class="form-control" name="descripcion" id="descripcion">
                         </textarea> 
                    </div>
                      <input type="Hidden" class="form-control"  name="idf" id="idf"> 
                  </div> 
                </div>


              <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn btn-danger pull-right" style="margin-left: 15px; margin-top: 2px;">Cancelar</button>
                <button type="submit"  class="btn btn-primary pull-right" name="btndescontarP">Registrar</button>                
            </div> 
            </form>
          </div>
</div>
</div>
<!--Final del modal-->


<!--Inicio del modal re registro de varias salidas -->

  
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="ModalSalidas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width: 60%;">
    <div class="modal-content" style="border-radius: 20px;">

      <form action="<?= URL;?>ctrProductoT/VariasSalidas" method="POST">
        <div class="modal-header" style="text-align: center;">
          <h3 class="box-title"><strong>SALIDA PRODUCTO TERMINADO</strong></h3>
        </div>

        <div class="modal-body">
        <div class="col-md-12">
         <div class="box">
          <div class="box-body no-padding">
           <div class="table-responsive"> 
            <table class="table" id="tableSal" >
              <thead>
                <tr class="active">
                  <th>Referencia</th>
                  <th>Color</th> 
                  <th>Cantidad</th>
                  <th style="display: none">Id_Ficha</th>
                  <th>Salida</th>
                </tr>
              </thead>
              <tbody id="tbodySal">
              </tbody>      
            </table>
          </div>
        </div>
        <div class="form-group col-sm-5">
      <label>Fecha</label>
        <input type="text" name="FechaActual" class="form-control" value="<?php echo date ("Y-m-d"); ?>" readonly>
    </div>

    <div class="form-group col-sm-offset-1 col-sm-5">
      <label>Descipción</label>
     <textarea rows="2" cols="10" class="form-control" name="descripcion" id="descripcion"></textarea> 
    </div> 
      </div>
  
    </div>
</div>

<input type="hidden" id="vec" name="vec">
<div class="modal-footer">
  <button type="button" data-dismiss="modal" class="btn btn-danger pull-right" style="margin-left: 2%; margin-top: 2%">Cancelar</button>
  <button type="submit" class="btn btn-primary pull-right" style="margin-left: 2%; margin-top: 2%" id="regMuchos" name="regMuchos">Registrar</button>
</div> 
</form>
</div> 
</div>
</div> 