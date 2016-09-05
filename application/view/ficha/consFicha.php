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
                  <th style="width: 7%">Editar</th>
                  <th style="width: 7%">Cambiar Estado</th>
                  <th style="width: 15%">Insumos Asociados</th>
                </tr>
              </thead>
              <tbody class="list">
                <?php foreach ($fichas as $ficha): ?>
                  <tr>
                    <td class="ref"><?= $ficha["Referencia"] ?></td>
                    <td class="fecha_reg"><?= $ficha["Fecha_Registro"] ?></td>
                    <td class="estado"><?= $ficha["Estado"]==1?"Habilitado":"Inhabilitado" ?></td>
                    <td><i class="fa fa-square" style="color: <?= $ficha["Codigo_Color"] ?>; font-size: 200%;"></i></td>
                    <td class="stock"><?= $ficha["Stock_Minimo"] ?></td>
                    <td><?= round($ficha["Valor_Produccion"], 2) ?></td>
                    <td><?= $ficha["Valor_Producto"] ?></td>
                    <td>
                      <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#mdEditFicha" onclick="editarFicha('<?= $ficha["Id_Ficha_Tecnica"] ?>', this, '<?= $ficha["Id_Color"] ?>'); cargarInsumos('<?= $ficha["Id_Ficha_Tecnica"] ?>', 1); cargarTallas('<?= $ficha["Id_Ficha_Tecnica"] ?>', 1)" ><i class="fa fa-pencil-square-o fa-lg" name="btncarg"></i></button>
                    </td>
                    <td>
                      <?php if ($ficha["Estado"] == 1){ ?>
                      <button type="button" class="btn btn-box-tool" onclick="cambiarEstadoFicha(<?= $ficha["Id_Ficha_Tecnica"] ?>, 0)"><i class="fa fa-minus-circle fa-lg"></i></button>
                      <?php }else{ ?>
                      <button type="button" class="btn btn-box-tool" onclick="cambiarEstadoFicha(<?= $ficha["Id_Ficha_Tecnica"] ?>, 1)"><i class="fa fa-check fa-lg"></i></button>
                      <?php } ?>
                    </td>
                    <td>
                      <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#dtllInsuTallAso" onclick="cargarInsumos('<?= $ficha["Id_Ficha_Tecnica"] ?>', 0); cargarTallas('<?= $ficha["Id_Ficha_Tecnica"] ?>', 0)" ><i class="fa fa-eye fa-lg" style="color:#3B73FF"></i></button>
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
      <div class="modal fade" id="mdEditFicha" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
              <button type="button" class="close"><span aria-hidden="true" onclick="cerrarModalFicha()">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><b>Modificar Ficha Técnica</b></h4>
            </div>
            <div class="modal-body" style="padding:10px;">
              <form role="form" action="<?= URL ?>ctrFicha/editFicha" method="post" id="modficha">
                <input type="hidden" name="idFicha_Tec" id="idFicha_Tec">
                <div class="form-group col-sm-4">
                  <label for="referencia" class="">Referencia:</label>
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
                <!-- <div class="form-group col-sm-4">
                  <label for="color" class="">*Color:</label>
                  <input class="form-control" type="text" name="color" id="color" style="border-radius:5px;">
                </div> -->
                <!-- <div class="form-group col-sm-1">
                  <label for="color" class="">*Color:</label>
                  <div class="">
                    <div class="input-group my-colorpicker2 colorpicker-element">
                      <input type="hidden" name="color" class="form-control" id="color" readonly="" value="#60c2e0" style="border-radius:5px;">
                      <div class="input-group-addon" style="border-radius:5px; padding:16px;">
                        <div></div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <div class="form-group col-sm-3">
                  <label for="color" class="">*Color:</label>
                  <div class="row"></div>
                  <!-- <div class="input-group"> -->
                  <select name="colorModFicha" id="colorModFicha" class="form-control"  style="width: 100%; height: 100%;">
                    <?php foreach ($colores as $color): ?>
                      <option value='<?= $color["Id_Color"] ?>'><?= $color["Nombre"] ?></option>
                    <?php endforeach ?>
                  </select>
                  <!-- <span class="input-group-addon"  style="background-color:white; border-radius:5px"><i class="fa fa-square" style="color:gray; font-size:150%;" id="colorF"></i></span> -->
                  <!-- </div> -->
                </div>
                <div class="form-group col-sm-offset-5 col-sm-4">
                  <label for="stock_min" class="">*Stock Mínimo:</label>
                  <input class="form-control" type="text" name="stock_min" id="stock_min" style="border-radius:5px;">
                </div>
                <div class="table">
                  <div class="form-group col-sm-4 table-responsive">
                    <label>*Tallas Asociadas:</label>
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
                <div class="table">
                  <div class="form-group col-sm-8 table-responsive">
                    <label>*Insumos asociados:</label>
                    <table class="table table-hover" id="tbl-insumos-aso">
                      <thead>
                        <tr class="active">
                          <th>Nombre</th>
                          <th>Color</th>
                          <th>Medida</th>
                          <th>Valor</th>
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
              </div>
              <div class="form-group col-sm-12">
                <div class="form-group col-sm-4">
                  <label for="vlr_produccion" class="">Valor Producción:</label>
                  <input type="text" name="vlr_produccion" class="form-control" id="vlr_produccion" readonly="" style="border-radius:5px;">
                </div>
                <div class="form-group col-sm-offset-4 col-sm-4"> 
                  <label for="vlr_producto" class="">*Valor Producto:</label>
                  <input class="form-control" type="text" name="vlr_producto" id="vlr_producto" style="border-radius:5px;">
                </div>
              </div>
              <div class="modal-footer" style="border-top:none; border-bottom:1px solid;">
                <div class="form-group col-sm-12">
                  <button type="submit" class="btn btn-primary" name="btn-modificar-ficha">Guardar cambios</button>
                  <button type="button" class="btn btn-danger" onclick="cerrarModalFicha()">Cancelar</button>
                </div>
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
                        <th>Nombre</th>
                        <th>Unidad Medida</th>
                        <th>Color</th>
                        <th>Estado</th>
                        <th>Valor Promedio</th>
                        <th>Agregar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1; ?>
                      <?php foreach ($insumosHabAsociar as $insumo): ?>
                        <tr>
                          <td><?= $insumo["Nombre"] ?></td>
                          <td><?= $insumo["Abreviatura"] ?></td>
                          <td><i class="fa fa-square" style="color: <?= $insumo["Codigo_Color"] ?>; font-size: 200%;"></i></td>
                          <td><?= $insumo["Estado"]==1?"Habilitado":"Inhabilitado" ?></td>
                          <td><?= round($insumo["Valor_Promedio"],2) ?></td>
                          <td>
                            <button id="btn<?= $insumo["Id_Insumo"] ?>" type="button" class="btn btn-box-tool" onclick="asociarInsumoFicha('<?= $insumo["Id_Insumo"] ?>', '<?= $insumo["Nombre"] ?>', referencia.value, this, '<?= $insumo["Valor_Promedio"] ?>', '<?= $insumo["Codigo_Color"] ?>', '<?= $i; ?>', '<?= $insumo["Abreviatura"] ?>')"><i class="fa fa-plus"></i></button>
                          </td>
                        </tr>
                        <?php $i++; ?>
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
                      <?php $i = 1; ?>
                      <?php foreach ($tallas as $talla): ?>
                        <tr>
                          <td><?= $talla["Id_Talla"] ?></td>
                          <td><?= $talla["Nombre"] ?></td>
                          <td>
                            <button id="btn<?= $talla["Id_Talla"] ?>" type="button" class="btn btn-box-tool" onclick="asociarTallaFicha('<?= $talla["Id_Talla"] ?>', '<?= $talla["Nombre"] ?>', referencia.value, this, '<?= $i; ?>')"><i class="fa fa-plus"></i></button>
                          </td>
                        </tr>
                        <?php $i++; ?>
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
      <!-- Inicio Modal Detalle de insumos y tallas asociadas a ficha técnica -->
      <div class="modal fade" id="dtllInsuTallAso" tabindex="-1" role="dialog" >
        <div class="modal-dialog modal-lg">
          <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Tallas e Insumos Asociados</b></h4>
            </div>
            <div class="modal-body">
            <div class="row col-sm-12">
              <div class="table" style="margin-bottom:0px;">
                <div class="form-group col-sm-4 table-responsive">
                  <table class="table table-hover" id="dtll-tallas-aso">
                    <thead>
                        <tr class="active">
                          <th>Id</th>
                          <th>Nombre</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="table">
                  <div class="form-group col-sm-8 table-responsive">
                    <table class="table table-hover" id="dtll-insumos-aso">
                      <thead>
                        <tr class="active">
                          <th>Nombre</th>
                          <th>Color</th>
                          <th>Medida</th>
                          <th>Valor</th>
                          <th>Cantidad Necesaria</th>
                          <th>Valor Insumo</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div> 
            </div>
            <div class="modal-footer" style="border-top:none; border-bottom:1px solid;">
              <button type="button" class="btn btn-primary" data-dismiss="modal"><b>Aceptar</b></button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    </section>