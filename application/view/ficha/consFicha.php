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
          <h3 class="box-title" style="margin-top: 0.7%"><strong>LISTAR FICHAS TÉCNICAS</strong></h3>
          <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#ModAyudaFicha" style="background: transparent; border: none;"><i class="fa fa-comment"></i></button>
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
                     <?php if ($ficha["Estado"] == 1): ?>
                        <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#mdEditFicha" onclick="editarFicha('<?= $ficha["Id_Ficha_Tecnica"] ?>', this, '<?= $ficha["Id_Color"] ?>'); cargarInsumos('<?= $ficha["Id_Ficha_Tecnica"] ?>', 1); cargarTallas('<?= $ficha["Id_Ficha_Tecnica"] ?>', 1); habilitarAsociaciones();" ><i style="font-size: 150%;" class="fa fa-pencil-square-o" name="btncarg"></i></button>
                      <?php else: ?>
                         <button type="button" class="btn btn-box-tool"><i style="font-size: 150%; opacity: 0.5" class="fa fa-pencil-square-o"></i></button>
                     <?php endif ?>
                    </td>
                    <td>
                      <?php if ($ficha["Estado"] == 1){ ?>
                      <button type="button" class="btn btn-box-tool" onclick="cambiarEstadoFicha(<?= $ficha["Id_Ficha_Tecnica"] ?>, 0)"><i style="font-size: 150%; color: green;" class="fa fa-repeat"></i></button>
                      <?php }else{ ?>
                      <button type="button" class="btn btn-box-tool" onclick="cambiarEstadoFicha(<?= $ficha["Id_Ficha_Tecnica"] ?>, 1)"><i style="font-size: 150%; color: green;" class="fa fa-repeat"></i></button>
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
              <input type="hidden" name="idsTallas[]" id="idsTallas">

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
              <!-- <div class="row">
                
              </div> -->
                <div class="col-md-4">
                  <div class="form-group table-responsive scrolltablas">
                    <label>*Tallas Asociadas:</label>
                    <table class="table table-hover table-bordered" id="tbl-tallas-aso">
                      <thead>
                        <tr class="active">
                          <th>Id</th>
                          <th>Nombre</th>
                          <th>Retirar</th>
                          <th style="display: none;"></th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group table-responsive scrolltablas">
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
                          <th>Retirar</th>
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
                        5px;"><i class="fa fa-money iconoDinero" style="color:green; font-size:150%;"></i></span>
                        <input type="text" name="vlr_produccion" class="form-control" id="vlr_produccion" readonly="" style="border-radius:5px;" data-parsley-required="" min="1" data-parsley-errors-container='#vTotalInError'>
                      </div>
                      <div id="vTotalInError"></div>
                    </div>
                    <div class="col-sm-2" style="margin-top:25px;">
                      <button style="color: white; background-color: #53868D" type="button" class="btn btn-default btn-md btn-block" data-toggle="modal" data-target="#asoTallas"><i class="fa fa-arrows" aria-hidden="true"></i><b> Tallas</b></button>
                    </div>
                    <div class="col-sm-2" style="margin-top:25px;">
                      <button  style="color: white; background-color: #6BB17A" type="button" class="btn btn-default btn-md btn-block" data-toggle="modal" data-target="#asoInsumos"><i class="fa fa-thumb-tack"></i> <b>Insumos</b></button>
                    </div>
                    <div class="form-group col-sm-4"> 
                      <label for="vlr_producto" class="">*Valor Producto:</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-money" style="color:green; font-size: 150%;"></i></span>
                        <input class="form-control" type="text" name="vlr_producto" id="vlr_producto" style="border-radius:5px;" data-parsley-required="" maxlength="10" data-parsley-errors-container='#vlProdError'>
                      </div>
                      <div id="vlProdError"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <div class="row">
                  <div class="col-md-offset-3 col-md-3">
                    <button type="submit" class="btn btn-warning btn-md btn-block" name="btn-modificar-ficha"><i class="fa fa-refresh" aria-hidden="true"></i> <b>Actualizar</b></button>
                  </div>
                  <div class="col-md-3">
                    <button type="button" class="btn btn-default btn-md btn-block" data-dismiss="modal" aria-label="Close" style="margin-left: 2%;"><i class="fa fa-times-circle" aria-hidden="true"></i> <b>Cerrar</b></button>
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


    <div class="modal fade" id="ModAyudaFicha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 10px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><strong>AYUDA USUARIO</strong></h4>
        </div>
        <div class="modal-body"> 
        <div class="modAyuda scrollAyuda">
          <ol class="c17 lst-kix_list_11-0" start="4"><li class="c1 c16 c2"><h1 id="h.2nusc19" style="display:inline"><span>M&Oacute;DULO DE FICHA T&Eacute;CNICA</span></h1></li></ol><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>El m&oacute;dulo de Ficha T&eacute;cnica permite gestionar la informaci&oacute;n del producto. A este rol solo tendr&aacute; acceso el rol Administrador, u otra cuenta que tenga este permiso asignado.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><h2 class="c1 c2" id="h.1302m92"><span>5.1 REGISTRAR FICHA </span></h2><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>Desde el modulo ficha t&eacute;cnica, opci&oacute;n Registrar Ficha, se puede registrar una referencia, se debe diligenciar todos los campos del formulario y asociar los insumos que se necesitan para realizar el producto. Ver </span><span class="c3">Figura 46. Registrar ficha t&eacute;cnica.</span></p><p class="c0"><span></span></p><p class="c0 c7"><span></span></p><p class="c11 c1 c7 c2" id="h.3mzq4wv"><span class="c5 c4">Figura 46. Registrar ficha t&eacute;cnica</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image05.png" style="width: 589.23px; height: 398.05px; margin-left: -0.00px; margin-top: -35.28px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.2250f4o"><span class="c4 c3">5.1.1 Validaci&oacute;n de campos</span><span>: Si al momento de hacer clic en el bot&oacute;n &ldquo;Registrar&rdquo;, faltan datos o hay un error en el formulario, el sistema emitir&aacute; una alerta mostrando el error a corregir, evitando continuar con el registro. Ver </span><span class="c3">Figura 47. Validaci&oacute;n de campos de ficha,</span></p><p class="c1"><span>&nbsp;</span></p><p class="c6 c1 c2" id="h.haapch"><span class="c5 c4">Figura 47. Validaci&oacute;n de campos de ficha</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image06.png" style="width: 589.23px; height: 397.51px; margin-left: -0.00px; margin-top: -34.47px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c1"><span>En caso contrario el sistema mostrara un mensaje informando el registro exitoso. Ver </span><span class="c3">Figura 48. Registro exitoso de ficha.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.319y80a"><span class="c5 c4">Figura 48. Registro exitoso de ficha</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image07.png" style="width: 589.23px; height: 402.29px; margin-left: -0.00px; margin-top: -35.88px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><h2 class="c1 c2" id="h.1gf8i83"><span>5.2 LISTAR FICHAS</span></h2><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1 c28"><span>Desde el modulo Ficha T&eacute;cnica, opci&oacute;n Listar Fichas, se puede visualizar de manera general la informaci&oacute;n de la referencias que se encuentran registradas. La tabla permite filtrar la informaci&oacute;n por medio de cualquier dato que se encuentre en esta. Para ver los insumos de una referencia en espec&iacute;fico, est&aacute; la opci&oacute;n: insumos asociados, editar y cambiar estado. Ver </span><span class="c3">Figura 49. Listar fichas.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1 c2 c6" id="h.40ew0vw"><span class="c5 c4">Figura 49. Listar fichas</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image08.png" style="width: 589.23px; height: 481.14px; margin-left: -0.00px; margin-top: -44.44px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.2fk6b3p"><span class="c4 c3">5.2.1 Insumos asociados</span><span>: En la opci&oacute;n que aparece al lado derecho de la tabla que lista las fichas, al dar clic se puede ver con detalle las tallas en las que viene esta referencia, m&aacute;s los insumos que se necesita para su producci&oacute;n. Ver </span><span class="c3">Figura 50. Insumos asociados a ficha. </span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c11 c1 c7 c2" id="h.upglbi"><span class="c5 c4">Figura 50. Insumos asociados a ficha</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 264.57px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image09.png" style="width: 680.68px; height: 669.91px; margin-left: -90.24px; margin-top: -91.78px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0 c9"><span></span></p><p class="c0 c9"><span></span></p><p class="c1" id="h.3ep43zb"><span class="c4 c3">5.2.2 Editar</span><span>: Al dar clic en la opci&oacute;n de editar, se abre un formulario que permite modificar los campos de: nombre, color, stock m&iacute;nimo y valor del producto, tambi&eacute;n seleccionar de nuevo las tallas en las que est&aacute; disponible esa referencia y los insumos que se necesitan para su producci&oacute;n. Ver </span><span class="c3">Figura 51. Editar ficha t&eacute;cnica.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c11 c1 c7 c2" id="h.1tuee74"><span class="c5 c4">Figura 51. Editar ficha t&eacute;cnica</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image33.png" style="width: 679.27px; height: 410.74px; margin-left: -90.01px; margin-top: -45.79px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0 c9"><span></span></p><p class="c1"><span>Este formulario tambi&eacute;n contiene validaciones de campos</span><span class="c8 c3">. </span><span class="c8">Ver </span><span class="c8 c3">Figura 47. Validaciones de campos de ficha.</span></p><p class="c0"><span class="c8 c3"></span></p><p class="c0"><span class="c8 c3"></span></p><p class="c1" id="h.4du1wux"><span class="c4 c3">5.2.3 Cambiar estado</span><span>: Para modificar el estado de una ficha, se da clic en el &ldquo;Cambiar Estado&rdquo; que aparece en la parte derecha de la pantalla. Solo las fichas habilitadas se podr&aacute;n producir. Ver </span><span class="c3">Figura 52. Cambiar estado de la ficha.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.2szc72q"><span class="c5 c4">Figura 52. Cambiar estado de la ficha</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image34.png" style="width: 589.23px; height: 398.89px; margin-left: -0.00px; margin-top: -35.88px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span><span>&nbsp;</span></p><h1 class="c0 c2 c10"><span class="c19"></span></h1><hr style="page-break-before:always;display:none;"><p class="c0 c18 c7"><span></span></p>
        </div>            
        </div>
         <div class="modal-footer">
            <div class="row">
              <div class="col-md-12">
                <button data-dismiss="modal" type="reset" class="btn btn-default pull-right" style="margin-left: 2%; margin-top: 2%"><i class="fa fa-times-circle" aria-hidden="true"></i> <b>Cerrar</b></button>
              </div>
            </div>
         </div> 
        </div> 
      </div>
</div>