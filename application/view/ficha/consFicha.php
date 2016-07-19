    <!-- Content Header (Page header) -->
    <section class="content-header">
      <br>
      <ol class="breadcrumb">
        <li><a href="<?php echo URL ?>home/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Ficha Técnica</a></li>
        <li class="active">Listar Fichas</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

    <!-- Inicio de listar -->
    <div class="box box-primary">
      <div class="box-header with-border"  style="text-align: center;">
        <h3 class="box-title"><strong>LISTAR FICHAS TÉCNICAS</strong></h3>
      </div>
      <div id="users">
  <!-- <div class="col-md-offset-8 col-md-4">
         <div class="row box-header">
            <div class="form-group">
              <div class="box-tools pull-right">
                <form action="#" method="get" class="form-horizontal">
                  <div class="input-group">
                    <input type="text" class="form-control search" placeholder="Buscar">
                    <span class="input-group-btn">
                      <button type="submit" name="search" id="search-btn" class="sort btn btn-flat"><i class="fa fa-search"></i></button>
                    </span>
                  </div>
                </form> 
              </div>
          </div>
        </div>
        </div> -->
        <form class="form-horizontal">
          <div class="col-md-12">
            <!-- <div class="box"> -->
            <br>
              <div class="table table-responsive">
                <table class="table table-hover" id="tablaFichas">
                  <thead>
                    <tr class="info">
                      <th>Referencia</th>
                      <th>Fecha Registro</th>
                      <th>Estado</th>
                      <th>Color</th>
                      <th>Stock Mínimo</th>
                      <th>Valor Producción</th>
                      <th>Valor Producto</th>
                      <th style="width: 7%">Opción</th>
                    </tr>
                  </thead>
                  <tbody class="list">
                  <?php foreach ($fichas as $ficha): ?>
                    <tr>
                      <td class="ref"><?= $ficha["Referencia"] ?></td>
                      <td class="fecha_reg"><?= $ficha["Fecha_Registro"] ?></td>
                      <td class="estado"><?= $ficha["Estado"]==1?"Habilitado":"Inhabilitado" ?></td>
                      <td class="color"><?= $ficha["Color"] ?></td>
                      <td class="stock"><?= $ficha["Stock_Minimo"] ?></td>
                      <td><?= $ficha["Valor_Produccion"] ?></td>
                      <td><?= $ficha["Valor_Producto"] ?></td>
                      <td>
                        <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#idModal" onclick="editarFicha('<?= $ficha["Referencia"] ?>', this); cargarInsumos('<?= $ficha["Referencia"] ?>'); cargarTallas('<?= $ficha["Referencia"] ?>')" ><i class="fa fa-pencil-square-o" name="btncarg"></i></button>
                        
                        <?php if ($ficha["Estado"] == 1){ ?>
                      
                      <button type="button" class="btn btn-box-tool" onclick="cambiarEstadoFicha(<?= $ficha['Referencia'] ?>, 0)"><i class="fa fa-minus-circle"></i></button>
                          
                          <?php }else{ ?>
                      <button type="button" class="btn btn-box-tool" onclick="cambiarEstadoFicha(<?= $ficha['Referencia'] ?>, 1)"><i class="fa fa-check"></i></button>

                          <?php } ?>
                           <!-- <button type="button" onclick="cargarInsumosAs('<?= $ficha["Referencia"] ?>');" data-toggle="modal" data-target="#idModal">aso</button> -->
                      </td>
                    </tr>
                  <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            <!-- </div> -->
          </div>
          </form>
        </div>
        <div class="box-footer">
        </div>
      </div>
      <!-- inicio modal modificar ficha-->
      <div class="modal fade" id="idModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
              <button type="button" class="close"><span aria-hidden="true" onclick="cancel()">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>Modificar Ficha Técnica</b></h4>
            </div>
            <div class="modal-body" style="padding:10px;">
              <form role="form" action="<?= URL ?>ctrFicha/editFicha" method="post" id="modficha">
                <div class="form-group col-sm-4">
                  <label for="referencia" class="">*Referencia:</label>
                  <input class="form-control" type="text" name="referencia" id="referencia" readonly="" style="border-radius:5px;">
                </div>
                <div class="form-group col-sm-4">
                  <label class="">Fecha Registro:</label>
                  <div class="input-group date">
                    <div class="input-group-addon" style="border-radius:5px;">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control" readonly type="text" name="fecha_reg" id="fecha_reg" style="border-radius:5px;">
                  </div>
                </div>
                <div class="form-group col-sm-4">
                  <label for="estado" class="">*Estado:</label>
                  <input class="form-control" type="text" readonly name="estado" id="estado" style="border-radius:5px;">
                </div>
                <div class="form-group col-sm-6">
                  <label for="color" class="">*Color:</label>
                  <input class="form-control" type="text" name="color" id="color" style="border-radius:5px;">
                </div>
                <div class="form-group col-sm-6">
                  <label for="stock_min" class="">*Stock Mínimo:</label>
                  <input class="form-control" type="text" name="stock_min" id="stock_min" style="border-radius:5px;">
                </div>
                <label for="tbl-insumos-aso" style="margin-left:15px;">*Insumos Asociados:</label>
                <div class="table">
                  <div class="col-sm-12 table-responsive">
                    <table class="table table-hover" id="tbl-insumos-aso">
                      <thead>
                        <tr class="active">
                          <th>Id</th>
                          <th>Nombre</th>
                          <th>Unidad Medida</th>
                          <th>Valor*cm</th>
                          <th>Cantidad Necesaria</th>
                          <th>Valor Insumo</th>
                          <th>Quitar</th>
                          <th><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#asoInsumos"><b>Agregar</b></button></th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
                <label for="tbl-tallas-aso" style="margin-left:15px; margin-top:15px;">*Tallas Asociadas:</label>
                <div class="table">
                  <div class="col-sm-12 table-responsive">
                    <table class="table table-hover" id="tbl-tallas-aso">
                      <thead>
                        <tr class="active">
                          <th>Id</th>
                          <th>Nombre</th>
                          <th>Quitar</th>
                          <th><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#asoTallas"><b>Agregar</b></button></th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="form-group col-sm-6">
                <label for="vlr_produccion" class="">Valor Producción:</label>
                <div class="">
                  <div class="input-group">
                    <div class="input-group-btn" style="border-radius:5px; margin-bottom:10%;">
                      <button type='button' id="confir" onclick="calcularVlrProd()" class='btn btn-info'><b>Calcular</b></button>
                    </div>
                    <input type="text" min="1" name="vlr_produccion" class="form-control" id="vlr_produccion" style="border-radius:5px;">
                  </div>
                </div>
              </div>
              <div class="form-group col-sm-6"> 
                <label for="vlr_producto" class="">*Valor Producto:</label>
                <input class="form-control" type="text" name="vlr_producto" id="vlr_producto" style="border-radius:5px;">
              </div>
            <div class="modal-footer" style="border-top:none; border-bottom:1px solid;">
              <button type="submit" class="btn btn-primary" name="btn-modificar-ficha">Guardar cambios</button>
              <button type="button" class="btn btn-danger" onclick="cancel()">Cancelar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- fin modal modificar ficha-->
      <!-- Inicio Modal asociar insumos a ficha -->
      <div class="modal fade" id="asoInsumos" tabindex="-1" role="dialog" >
        <div class="modal-dialog">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Insumos para asociar</b></h4>
            </div>
            <div class="modal-body">
              <div class="table">
                <div class="col-sm-12 table-responsive">
                  <table class="table table-hover" style="margin-top: 2%;">
                  <thead>
                    <tr class="active">
                      <th>Id</th>
                      <th>Unidad Medida</th>
                      <th>Nombre</th>
                      <th>Cantidad</th>
                      <th>Valor Total</th>
                      <th>Agregar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($insumos as $insumo): ?>
                      <tr>
                        <td><?= $insumo["Id_Insumo"] ?></td>
                        <td><?= $insumo["Id_Medida"]==1?"mt":"cm" ?></td>
                        <td><?= $insumo["Nombre"] ?></td>
                        <td><?= $insumo["Cantidad"] ?></td>
                        <td><?= $insumo["Valor"] ?></td>
                        <td>
                          <button id="btn<?= $insumo["Id_Insumo"] ?>" type="button" class="btn btn-box-tool" onclick="asociarInsumoFicha('<?= $insumo["Id_Insumo"] ?>', '<?= $insumo["Nombre"] ?>', referencia.value, this, '<?= $insumo["Valor"] ?>', '<?= $insumo["Cantidad"] ?>')"><i class="fa fa-plus"></i></button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal"><b>Aceptar</b></button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      <!-- Inicio Modal asociar tallas a ficha -->
      <div class="modal fade" id="asoTallas" tabindex="-1" role="dialog" >
        <div class="modal-dialog">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Tallas para asociar</b></h4>
            </div>
            <div class="modal-body">
              <div class="table">
                <div class="col-sm-12 table-responsive">
                  <table class="table table-hover" style="margin-top: 2%;">
                  <thead>
                    <tr class="active">
                      <th>Id</th>
                      <th>Nombre</th>
                      <th>Agregar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($tallas as $talla): ?>
                      <tr>
                        <td><?= $talla["Id_Talla"] ?></td>
                        <td><?= $talla["Nombre"] ?></td>
                        <td>
                          <button id="btn<?= $talla["Id_Talla"] ?>" type="button" class="btn btn-box-tool" onclick="asociarTallaFicha('<?= $talla["Id_Talla"] ?>', '<?= $talla["Nombre"] ?>', referencia.value, this)"><i class="fa fa-plus"></i></button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal"><b>Aceptar</b></button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    </section>