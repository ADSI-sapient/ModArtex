    <!-- Content Header (Page header) -->
    <section class="content-header">
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
        <div class="box-header with-border" style="text-align: center;">
          <h3 class="box-title"><strong>LISTAR FICHAS TÉCNICAS</strong></h3>
        </div>
        <div id="users">
      <form class="form-horizontal">
        <div class="col-md-12">
          <div class="table table-responsive">
            <table class="table table-hover cell-border" id="tablaFichas">
              <thead>
                <tr class="">
                  <th>Referencia</th>
                  <th>Nombre</th>
                  <th>Fecha Registro</th>
                  <th>Estado</th>
                  <th>Color</th>
                  <th>Stock Mínimo</th>
                  <th>Valor Producción</th>
                  <th>Valor Producto</th>
                  <th style="width: 7%">Editar</th>
                  <th style="width: 5%">Cambiar Estado</th>
                  <th style="width: 7%">Insumos Asociados</th>
                </tr>
              </thead>
              <tbody class="list">
                <?php foreach ($fichas as $ficha): ?>
                  <tr>
                    <td class="ref"><?= $ficha["Referencia"] ?></td>
                    <td class="nombreF"><?= $ficha["Nombre"] ?></td>
                    <td class="fecha_reg"><?= $ficha["Fecha_Registro"] ?></td>
                    <td class="estado"><?= $ficha["Estado"]==1?"Habilitado":"Inhabilitado" ?></td>
                    <td><i class="fa fa-square" style="color: <?= $ficha["Codigo_Color"] ?>; font-size: 200%;" title="<?= $ficha["Nombre_Color"] ?>"></i></td>
                    <td class="stock"><?= $ficha["Stock_Minimo"] ?></td>
                    <td><?= round($ficha["Valor_Produccion"], 2) ?></td>
                    <td><?= $ficha["Valor_Producto"] ?></td>
                    <td>
                      <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#mdEditFicha" onclick="editarFicha('<?= $ficha["Id_Ficha_Tecnica"] ?>', this, '<?= $ficha["Id_Color"] ?>'); cargarInsumos('<?= $ficha["Id_Ficha_Tecnica"] ?>', 1); cargarTallas('<?= $ficha["Id_Ficha_Tecnica"] ?>', 1); habilitarAsociaciones();" ><i style="font-size: 150%;" class="fa fa-pencil-square-o" name="btncarg"></i></button>
                    </td>
                    <td>
                      <?php if ($ficha["Estado"] == 1){ ?>
                      <button type="button" class="btn btn-box-tool" onclick="cambiarEstadoFicha(<?= $ficha["Id_Ficha_Tecnica"] ?>, 0)"><i style="font-size: 150%;" class="fa fa-minus-circle"></i></button>
                      <?php }else{ ?>
                      <button type="button" class="btn btn-box-tool" onclick="cambiarEstadoFicha(<?= $ficha["Id_Ficha_Tecnica"] ?>, 1)"><i style="font-size: 150%;" class="fa fa-check"></i></button>
                      <?php } ?>
                    </td>
                    <td>
                      <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#dtllInsuTallAso" onclick="cargarInsumos('<?= $ficha["Id_Ficha_Tecnica"] ?>', 0); cargarTallas('<?= $ficha["Id_Ficha_Tecnica"] ?>', 0)" ><i class="fa fa-eye fa-lg" style="color:#3B73FF; font-size: 150%;"></i></button>
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
              <!-- <button type="button" class="close"><span aria-hidden="true">&times;</span></button> -->
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

              <h4 class="modal-title" id="myModalLabel"><b>MODIFICAR FICHA TÉCNICA</b></h4>
            </div>
              <form role="form" action="<?php echo URL; ?>ctrFicha/editFicha" method="post" id="modficha" onsubmit="return validarColorFicha()" data-parsley-validate="">
            <div class="modal-body" style="padding:10px;">
              <input type="hidden" name="idFicha_Tec" id="idFicha_Tec">
              <div class="row">
                <div class="form-group col-sm-12">
                  <div class="form-group col-sm-4">
                    <label for="referencia" class="">Referencia:</label>
                    <input class="form-control" type="text" name="referencia" id="referencia" style="border-radius:5px;" maxlength="25" readonly="">
                  </div>
                  <div class="form-group col-sm-4">
                    <label for="nombre" class="">*Nombre:</label>
                    <input class="form-control" type="text" name="nombreFichaMod" id="nombreFichaMod" style="border-radius:5px;" maxlength="45">
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
                </div>
              </div>
              <div class="row">
                <div class="form-group col-sm-12">
                  <div class="form-group col-sm-4">
                    <label for="estado" class="">*Estado:</label>
                    <input class="form-control" type="text" readonly name="estado" id="estado" style="border-radius:5px;">
                  </div>
                  <div class="col-sm-4">
                    <label for="color" class="">*Color:</label>
                    <!-- <div class="row"></div> -->
                    <div class="input-group">
                      <select name="colorModFicha" id="colorModFicha" class="form-control"  style="width: 100%;" onchange="coloresFichas()" data-parsley-required="">
                        <?php foreach ($colores as $color): ?>
                          <option value='<?= $color["Id_Color"] ?>'><?= $color["Nombre"] ?></option>
                        <?php endforeach ?>
                      </select>
                      <span class="input-group-addon" style="background-color:white; border-radius:5px"><i class="fa fa-square" style="font-size:150%;" id="colorFMod"></i></span>
                    </div>
                  </div>
                  <div class="form-group col-sm-4">
                    <label for="stock_min" class="">*Stock Mínimo:</label>
                    <input class="form-control" type="text" name="stock_min" id="stock_min" style="border-radius:5px;" data-parsley-required="" min="1" max="9999999">
                  </div>
                </div>                
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="col-sm-offset-1 col-sm-2">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#asoTallas"><b>TALLAS</b></button>
                  </div>
                  <div class="col-sm-offset-5 col-sm-3">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#asoInsumos"><b>INSUMOS</b></button>
                  </div>
                </div>
              </div>
                <div class="table">
                  <div class="form-group col-sm-4 table-responsive scrolltablas">
                    <label>*Tallas Asociadas:</label>
                    <table class="table table-hover table-bordered" id="tbl-tallas-aso">
                      <thead>
                        <tr class="active">
                          <th>Id</th>
                          <th>Nombre</th>
                          <th>Quitar</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="table">
                  <div class="form-group col-sm-8 table-responsive scrolltablas">
                    <label>*Insumos asociados:</label>
                    <table class="table table-hover table-bordered" id="tbl-insumos-aso">
                      <thead>
                        <tr class="active">
                          <th>Nombre</th>
                          <th>Color</th>
                          <th>Medida</th>
                          <th style="width: 10px;">Valor</th>
                          <th>Cantidad Necesaria</th>
                          <th>Valor Insumo</th>
                          <th>Quitar</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>                
                <div class="row">
                  <div class="form-group col-sm-12">
                    <div class="form-group col-sm-4">
                      <label for="vlr_produccion" class="">Valor Total Insumos:</label>
                      <div class="input-group">
                        <span class="input-group-addon" style="border-radius: 
                        5px;"><i class="fa fa-money"></i></span>
                        <input type="text" name="vlr_produccion" class="form-control" id="vlr_produccion" readonly="" style="border-radius:5px;" data-parsley-required="" min="1">
                      </div>
                    </div>
                    <div class="form-group col-sm-offset-4 col-sm-4"> 
                      <label for="vlr_producto" class="">*Valor Producto:</label>
                      <div class="input-group">
                        <span class="input-group-addon"><b>$</b></span>
                        <input class="form-control" type="text" name="vlr_producto" id="vlr_producto" style="border-radius:5px;" data-parsley-required="" maxlength="10">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <div class="row">
                  <div class="col-md-offset-3 col-md-3">
                    <button type="submit" class="btn btn-warning btn-sm btn-block" name="btn-modificar-ficha"><i class="fa fa-refresh" aria-hidden="true"></i> <b>Actualizar</b></button>
                  </div>
                  <div class="col-md-3">
                    <button type="button" class="btn btn-default btn-sm btn-block" data-dismiss="modal" aria-label="Close" style="margin-left: 2%;"><i class="fa fa-times-circle" aria-hidden="true"></i> <b>Cerrar</b></button>
                  </div>
                </div>
                <small class="pull-left"><b>*Campo requerido</b></small>
              </div> 
            </form>
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
              <h4 class="modal-title"><b>INSUMOS PARA ASOCIAR</b></h4>
            </div>
            <div class="modal-body">
              <div class="table">
                <div class="col-sm-12 table-responsive">
                  <table class="table table-hover mdlConfig" style="margin-top: 2%;" id="insAsocFT">
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
                          <td><i class="fa fa-square" style="color: <?= $insumo["Codigo_Color"] ?>; font-size: 200%;" title="<?= $insumo["Nombre_Color"] ?>"></i></td>
                          <td><?= $insumo["Estado"]==1?"Habilitado":"Inhabilitado" ?></td>
                          <td><?= round($insumo["Valor_Promedio"],2) ?></td>
                          <td>
                            <button id="btn<?= $insumo["Id_Insumo"] ?>" type="button" class="btn btn-box-tool" onclick="asociarInsumoFicha('<?= $insumo["Id_Insumo"] ?>', '<?= $insumo["Nombre"] ?>', referencia.value, this, '<?= $insumo["Valor_Promedio"] ?>', '<?= $insumo["Codigo_Color"] ?>', '<?= $i; ?>', '<?= $insumo["Abreviatura"] ?>', '<?= $insumo["Nombre_Color"] ?>')"><i style="font-size: 150%; color: blue;" class="fa fa-plus"></i></button>
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
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
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
              <h4 class="modal-title"><b>TALLAS PARA ASOCIAR</b></h4>
            </div>
            <div class="modal-body">
              <div class="table">
                <div class="table-responsive">
                  <table class="table table-hover table-bordered datTableModals" style="margin-top: 2%;" id="tllAsociarRegPedido">
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
                            <button id="btntallas<?= $i ?>" type="button" class="btn btn-box-tool" onclick="asociarTallaFicha('<?= $talla["Id_Talla"] ?>', '<?= $talla["Nombre"] ?>', referencia.value, this, '<?= $i; ?>')"><i style="font-size: 150%; color: blue;" class="fa fa-plus"></i></button>
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
              <button type="button" class="btn btn-default btn-lg" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
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
              <h4 class="modal-title"><b>TALLAS E INSUMOS ASOCIADOS</b></h4>
            </div>
            <div class="modal-body">
            <div class="row col-sm-12">
              <div class="table" style="margin-bottom:0px;">
                <div class="form-group col-sm-4 table-responsive scrolltablas">
                  <table class="table table-hover table-bordered" id="dtll-tallas-aso">
                  <h4 style="border-bottom:1px solid #9e9e9e; padding-bottom:5px">Tallas:</h4>
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
                  <div class="form-group col-sm-8 table-responsive scrolltablas">
                    <table class="table table-hover table-bordered" id="dtll-insumos-aso">
                    <h4 style="border-bottom:1px solid #9e9e9e; padding-bottom:5px">Insumos:</h4>
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
              <button type="button" class="btn btn-default btn-lg" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    </section>