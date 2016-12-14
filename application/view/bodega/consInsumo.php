    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="<?php echo URL ?>home/index"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li><a href="#">Bodega</a></li>
        <li class="active">Listar insumos</li>
      </ol>
    </section>

    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border"  style="text-align: center;">
          <h3 class="box-title" style="margin-top: 0.7%"><strong>LISTAR INSUMOS</strong></h3>
          <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#ModAyudaRegIns" style="background: transparent; border: none;"><i class="fa fa-comment"></i></button>
        </div>
        <form class="form-horizontal" id="frm" action="" method="POST">
          <div class="col-md-12">
            <div class="table-responsive">
              <table id="tableListInsumos" class="table table-bordered paginate-search-table">
                <thead>
                  <tr class="active" style="color: ">
                    <th style="width: 10px">#</th>
                    <th style="display: none;"></th>
                    <th>Nombre</th>
                    <th>Medida</th>
                    <th>Estado</th>
                    <th>Stock Mínimo</th>
                    <th style="width: 7%">Editar</th>
                    <th style="width: 10%">Cambiar Estado</th>
                    <th style="width: 7%">Detalle</th>
                    <th style="display: none;"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $cont = 0;?>
                  <?php foreach ($lisInsumos as $valor): ?>  
                  <tr>
                    <td><?= $cont += 1;?></td>
                    <td style="display: none;"><?= $valor["Id_Insumo"]?></td>
                    <td><?= $valor["Nombre"]?></td>
                    <td><?= $valor["NombreMed"]?></td>
                    <?php if ($valor["Estado"] == 1): ?>
                      <td>Habilitado</td>
                    <?php else: ?>
                      <td>Inhabilitado</td>
                    <?php endif ?>  
                    <td><?= $valor["Stock_Minimo"]?></td>
                    <input type="hidden" value="<?= $valor["Estado"]?>" name="est">
                    <td style="text-align: center;">
                    <?php if ($valor["Estado"] == 1): ?>    
                      <button type="button" id="btnEditar" onclick="editInsumos(<?= $valor["Id_Insumo"]?>, this)" class="btn btn-box-tool" data-toggle="modal" data-target="#ModEditIns"><i style="font-size: 150%;" class="fa fa-pencil-square-o"></i></button>
                    <?php else: ?>
                      <button type="button" disabled="" class="btn btn-box-tool"><i style="font-size: 150%;" class="fa fa-pencil-square-o"></i></button>
                    <?php endif ?>    
                    </td>
                    <td style="text-align: center;">
                      <?php if ($valor["Estado"] == 1): ?>
                           <button type="button" onclick="camEst(<?= $valor["Id_Insumo"]?>, 0)" class="btn btn-box-tool"><i style="font-size: 150%; color: green;" class="fa fa-repeat"></i></button> 
                      <?php endif ?>
                      <?php if ($valor["Estado"] == 0): ?>
                           <button type="button" onclick="camEst(<?= $valor["Id_Insumo"]?>, 1)" class="btn btn-box-tool"><i style="font-size: 150%; color: green;" class="fa fa-repeat"></i></button> 
                      <?php endif ?>
                    </td> 
                    <td style="text-align: center;">
                      <button type="button" onclick="verDetalleColIns(<?= $valor["Id_Insumo"]?>)" class="btn btn-box-tool" data-toggle="modal" data-target="#detalleColIns"><i style="font-size: 150%; color: blue;" class="fa fa-eye"></i></button>
                    </td> 
                    <td style="display: none;"><?= $valor['Id_Medida']?></td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="box-footer"></div>
        </form>
      </div>
    </section>






<div class="modal fade" data-backdrop="static" data-keyboard="false" id="ModEditIns" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 10px;">
      <form data-parsley-validate="">
        <input type="hidden" id="nomIniIns">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><strong>MODIFICAR INSUMO</strong></h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="col-md-12">
                <div class="form-group">
                   <label class="control-label">*Nombre:</label>
                   <input id="nomIns" type="text" class="form-control" data-parsley-required="" name="nombre" maxlength="45">
                </div>
               </div> 
            </div>
            <div class="col-md-6">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">*Unidad de Medida:</label>
                    <select id="selMedInsCol" class="form-control" style="width: 100%;" data-parsley-required="" name="select">
                     <!-- <option selected=""></option> -->
                      <?php foreach ($listaM as $valor): ?>
                        <option value="<?= $valor["Id_Medida"]; ?>"><?= $valor["Nombre"]; ?></option>  
                      <?php endforeach ?>
                    </select>
                </div>
              </div>
            </div> 
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="col-md-12">
                <div class="form-group">
                  <input type="hidden" name="id" id="mSel">
                  <label class="control-label" length="80px">*Stock Mínimo:</label>
                    <input id="stockIns" type="number" class="form-control" min="0" data-parsley-required="" name="stock" max="9999999">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="col-md-8">
                <label class="control-label" length="80px">Valor:</label>
                <input id="checkValor" type="checkbox" class="">
                <div class="input-group">
                  <span  class="input-group-addon">$</span>
                  <input id="valColIns" readonly="" type="number" class="form-control" data-parsley-required="" min="1" name="valor">
                </div>
              </div>
              <div style="margin-top: 25px;" class="col-md-4">
                <!-- <button onclick="validateColSelec()" type="button" class="btn pull-right" data-toggle="modal"  data-target="#ModelProducto"><i style="font-size: 130%;" class="fa fa-paint-brush circleColor" aria-hidden="true"></i></button> -->
                <button type="button" class="btn pull-right" data-toggle="modal"  data-target="#ModelProducto"><i style="font-size: 130%;" class="fa fa-paint-brush circleColor" aria-hidden="true"></i></button>
              </div>
            </div>
          </div>  
          <div class="row">
            <div class="col-md-12">
            <div class="col-md-12">
             <div class="table-responsive scrolltablas"> 
              <table class="table table-bordered">
                <thead>
                  <tr class="active">
                    <th style="display: none;"></th>
                    <th style="display: none;"></th>
                    <th style="width: 10px">#</th>
                    <th>Código</th>
                    <th>Muestra</th>
                    <th>Nombre</th>
                    <th style="width: 20%">Valor</th>
                    <th style="width: 40px">Quitar</th>
                    <th style="display: none;"></th>
                  </tr>
                </thead>
                <tbody id="tbodyColIns">
                </tbody>      
              </table>
             </div>
            </div>
            </div> 
         </div>             
        </div>
         <div class="modal-footer">
            <div class="row">
              <div class="col-lg-offset-3 col-lg-3">
                <button type="button" onclick="updateColIns()" class="btn btn-warning btn-md btn-block" style="margin-left: 2%; margin-top: 2%" name="btnRegIns"><i class="fa fa-refresh" aria-hidden="true"></i> <b>Actualizar</b></button>
              </div>
              <div class="col-lg-3">
                <button data-dismiss="modal" type="reset" class="btn btn-default btn-md btn-block" style="margin-left: 2%; margin-top: 2%"><i class="fa fa-times-circle" aria-hidden="true"></i> <b>Cerrar</b></button>
              </div>
            </div>
         </div> 
         </form>
        </div> 
      </div>
    </div>




  <div class="modal fade" id="ModelProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 10px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title"><strong>COLORES PARA ASOCIAR</strong></h4>
      </div>
      
      <div class="col-md-6"></div>
      <div class="modal-body">
       <table id="tableCols" class="table table-hover cell-border" style="margin-bottom: 3%;">
        <thead>
          <tr>
            <th style="display: none;"></th>
            <th style="width: 10%">#</th>
            <th>Código</th>
            <th>Muestra</th>
            <th>Nombre</th>
            <th style="width: 40px">Selección</th>
          </tr>
        </thead>
        <tbody>
          <?php $cont = 0; ?>
          <?php foreach ($lista as $value): ?>
            <tr class="box box-solid collapsed-box tr">
             <td style="display: none;"><?= $value["Id_Color"]; ?></td>
             <td><?= $cont += 1; ?></td>
             <td><?= $value["Codigo_Color"]; ?></td>
             <td><i class="fa fa-square" style="color: <?= $value['Codigo_Color']; ?>; font-size: 200%;"></i> </td>
             <td><?= $value["Nombre"]; ?></td>
             <td style="text-align: center;"><button id="btnAgreColAsoc<?= $value["Id_Color"]; ?>" onclick="seleccionCol(this, '<?= $value["Id_Color"]; ?>')" class="btn btn-box-tool"><i class="fa fa-plus" style="color: blue; font-size: 150%;"></i></button></td> 
           </tr>
         <?php endforeach ?>
       </tbody>
     </table>
   </div>
  <div class="modal-footer">
    <button type="reset" class="btn btn-default pull-right btn-lg" data-dismiss="modal" style="margin-left: 2%;"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
  </div> 
</div> 
</div>
</div>






<div class="modal fade" data-backdrop="static" data-keyboard="false" id="detalleColIns" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 10px;">
      <form data-parsley-validate="">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><strong>DETALLE INSUMO</strong></h4>
        </div>
        <div class="modal-body"> 
          <div class="row">
            <div class="col-md-12">
            <div class="col-md-12">
             <div class="table-responsive scrolltablas"> 
              <table class="table table-bordered">
                <thead>
                  <tr class="active">
                    <th style="width: 10px">#</th>
                    <th>Código</th>
                    <th>Muestra</th>
                    <th>Nombre</th>
                    <th style="width: 20%">Valor</th>
                  </tr>
                </thead>
                <tbody id="tbodyDetalleColIns">
                </tbody>      
              </table>
             </div>
            </div>
            </div> 
         </div>             
        </div>
         <div class="modal-footer">
            <button data-dismiss="modal" type="reset" class="btn btn-lg btn-default pull-right" style="margin-left: 2%; margin-top: 2%"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
         </div> 
         </form>
        </div> 
      </div>
    </div>


    <div class="modal fade" id="ModAyudaRegIns" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 10px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><strong>AYUDA USUARIO</strong></h4>
        </div>
        <div class="modal-body"> 
        <div class="modAyuda scrollAyuda">
            <ol class="c17 lst-kix_list_11-0" start="3"><li class="c1 c16 c2"><h1 id="h.3ygebqi" style="display:inline"><span>M&Oacute;DULO DE BODEGA</span></h1></li></ol><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>El m&oacute;dulo de bodega se encarga del control y manejo de los insumos existentes. A este m&oacute;dulo solo tiene acceso el rol Administrador u otro rol que tenga este permiso.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><h2 class="c1 c2" id="h.2dlolyb"><span>4.1 REGISTRAR INSUMO</span></h2><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>Desde el m&oacute;dulo de bodega, opci&oacute;n Registrar insumo es posible realizar el registro de un insumo nuevo, se debe diligenciar todos los campos del formulario y asociar los colores en que est&aacute; disponible el insumo. Ver </span><span class="c3">Figura 31. Registro de insumo.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.sqyw64"><span class="c5 c4">Figura 31. Registro de insumo</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 590.51px; height: 248.52px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image10.png" style="width: 590.51px; height: 358.22px; margin-left: -0.00px; margin-top: -30.24px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.3cqmetx"><span class="c4 c3">4.1.1 Validaci&oacute;n de campos</span><span>: Al momento de hacer clic en el bot&oacute;n &ldquo;Registrar&rdquo; el sistema valida que se hayan ingresado los datos, seleccionado los color y el ingreso de un valor mayor a &ldquo;0&rdquo;. En caso de haber una inconsistencia el sistema muestra una alerta que informa del error y evita continuar con el registro. Ver </span><span class="c3">Figura 32. Validaci&oacute;n de campos de insumos.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.1rvwp1q"><span class="c5 c4">Figura 32. Validaci&oacute;n de campos de insumos</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.34px; height: 289.70px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image11.png" style="width: 589.34px; height: 338.48px; margin-left: -0.00px; margin-top: -30.12px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c1"><span>En caso contrario al dar clic en el bot&oacute;n &ldquo;Registrar&rdquo; el sistema muestra un mensaje de confirmaci&oacute;n exitosa. Ver </span><span class="c3">Figura 33. Registro exitoso de insumo.</span></p><p class="c0"><span class="c3"></span></p><p class="c11 c1 c7 c2" id="h.4bvk7pj"><span class="c5 c4">Figura 33. Registro exitoso de insumo</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image12.png" style="width: 589.23px; height: 401.73px; margin-left: -0.00px; margin-top: -37.94px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span><span>&nbsp;</span></p><h2 class="c0 c2"><span></span></h2><p class="c0"><span></span></p><h2 class="c1 c2" id="h.2r0uhxc"><span>4.2 LISTAR INSUMOS</span></h2><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>En la opci&oacute;n de Listar Insumos es posible visualizar de manera general los recursos registrados en el sistema, por medio de una tabla interactiva que permite filtrar la informaci&oacute;n por cualquier dato que se encuentre en ella. Se puede visualizar de manera individual un insumo en la opci&oacute;n: detalle, editar y cambiar estado. Ver </span><span class="c3">Figura 34. Listar insumos.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.1664s55"><span class="c5 c4">Figura 34. Listar insumos</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image13.png" style="width: 589.23px; height: 421.22px; margin-left: -0.00px; margin-top: -37.03px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.3q5sasy"><span class="c4 c3">4.2.1 Detalle</span><span>: Para ver el detalle de un insumo se da clic en el bot&oacute;n: &ldquo;Detalle&rdquo;, donde se visualizan lo colores con que se registr&oacute; el insumo, tambi&eacute;n se puede ver el valor. Ver </span><span class="c3">Figura 35. Detalle de insumo.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c11 c1 c7 c2" id="h.25b2l0r"><span class="c4 c5">Figura 35. Detalle de insumo</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image14.png" style="width: 688.06px; height: 658.31px; margin-left: -91.98px; margin-top: -85.75px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0 c9"><span></span></p><p class="c1" id="h.kgcv8k"><span class="c4 c3">4.2.2 Editar</span><span>: Para modificar un insumo se da clic en el bot&oacute;n: &ldquo;Editar&rdquo;, donde se abre un formulario que permite modificar los campos: Nombre, unidad de medida, stock m&iacute;nimo, colores y valor. Ver </span><span class="c3">Figura 36. Editar insumo.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c11 c1 c7 c2" id="h.34g0dwd"><span class="c5 c4">Figura 36. Editar insumo</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image15.png" style="width: 682.96px; height: 543.90px; margin-left: -91.30px; margin-top: -74.39px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.1jlao46"><span class="c4 c3">4.2.3 Cambiar Estado</span><span>: Para modificar el estado de un insumo se da clic en el bot&oacute;n &ldquo;Cambiar estado&rdquo;. Solo los insumos habilitados est&aacute;n disponibles para asociar en el m&oacute;dulo de ficha t&eacute;cnica. Ver </span><span class="c3">Figura 37. Cambiar estado de insumo.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.43ky6rz"><span class="c5 c4">Figura 37. Cambiar estado de insumo</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 588.85px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image16.png" style="width: 588.85px; height: 355.85px; margin-left: -0.00px; margin-top: -32.43px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><h2 class="c1 c2" id="h.2iq8gzs"><span>4.3 EXISTENCIAS DE INSUMOS</span></h2><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>En existencias de insumos se lleva un control de las entradas y salidas de los insumos. Se puede visualizar de manera general los movimientos de los insumos registrados, por medio de una tabla que permite filtrar por cualquier dato que se encuentra en ella. &nbsp;Ver </span><span class="c3">Figura 38. Existencias de insumos.</span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.xvir7l"><span class="c5 c4">Figura 38. Existencias de insumos</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image17.png" style="width: 589.23px; height: 372.87px; margin-left: -0.00px; margin-top: -35.21px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span class="c8 c3"></span></p><p class="c0"><span class="c8 c3"></span></p><p class="c1" id="h.3hv69ve"><span class="c4 c3">4.3.1 Registro de entrada</span><span>: Una entrada se realiza para registrar el aumento de la cantidad de un insumo, se da clic en la flecha verde que aparece al lado derecho del insumo, donde se ingresa la cantidad, el valor unitario y el valor total.</span></p><p class="c1"><span class="c8">Cuando ya existe un registro previo del insumo, el sistema realiza un promedio entre el valor anterior y el valor actual. Ver </span><span class="c8 c3">Figura 39. Registro de entrada.</span></p><p class="c0"><span class="c8"></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.1x0gk37"><span class="c5 c4">Figura 39. Registro de entrada</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 29.33px; height: 28.00px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image43.png" style="width: 29.33px; height: 28.00px; margin-left: 0.00px; margin-top: 0.00px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 588.12px; height: 279.44px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image18.png" style="width: 589.19px; height: 331.26px; margin-left: 0.01px; margin-top: -29.12px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span class="c8"></span></p><p class="c1"><span class="c8">Se puede realizar el registro de entrada de varios insumos a la vez;</span><span>&nbsp;se marca el check box que aparece al lado izquierdo, ya seleccionados se da clic en la flecha verde que aparece en la parte inferior derecha de la pantalla, donde se abre un formulario para ingresar la informaci&oacute;n de cada insumo y la cantidad que llega. Ver </span><span class="c3">Figura 40. Registro de varias entradas de insumos.</span></p><p class="c0 c7"><span class="c8"></span></p><p class="c0 c7"><span></span></p><p class="c11 c1 c7 c2" id="h.4h042r0"><span class="c5 c4">Figura 40. Registro de varias entradas de insumos</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image19.png" style="width: 688.30px; height: 614.59px; margin-left: -94.13px; margin-top: -79.87px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0 c9"><span class="c8"></span></p><p class="c0 c9"><span class="c8"></span></p><p class="c1" id="h.2w5ecyt"><span class="c4 c3">4.3.1.1 Validaci&oacute;n de campos</span><span>: Al momento de registrar una salida el sistema valida que los campos est&eacute;n completos, en caso de una inconsistencia el aplicativo muestra una alerta, impidiendo el registro exitoso. Ver </span><span class="c3">Figura 41. Validaci&oacute;n de campos de entradas de insumos.</span></p><p class="c0"><span class="c3"></span></p><p class="c6 c1 c2" id="h.1baon6m"><span class="c5 c4">Figura 41. Validaci&oacute;n de campos de entradas de insumos</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image00.png" style="width: 697.72px; height: 586.70px; margin-left: -100.64px; margin-top: -80.13px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c1"><span>En caso contrario el sistema muestra una alerta informando el registro exitoso. Ver </span><span class="c3">Figura 42. Registro de entrada exitoso.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.3vac5uf"><span class="c5 c4">Figura 42. Registro de entrada exitoso</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image01.png" style="width: 589.23px; height: 393.73px; margin-left: -0.00px; margin-top: -32.91px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c1" id="h.2afmg28"><span class="c4 c3">4.3.2 Registro de salida</span><span>: Una salida se realiza cuando se presentan da&ntilde;os e inconvenientes con los insumos registrados. Se da clic en la flecha roja que aparece al frente del insumo donde se ingresa la cantidad y la descripci&oacute;n de la salida. Ver </span><span class="c3">Figura 43. Registro de salida.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c13 c1 c10 c2" id="h.pkwqa1"><span class="c5 c4">Figura 43. Registro de salida</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 29.33px; height: 28.00px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image99.png" style="width: 29.33px; height: 28.00px; margin-left: 0.00px; margin-top: 0.00px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.20px; height: 267.70px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image02.png" style="width: 589.20px; height: 331.27px; margin-left: -0.00px; margin-top: -30.46px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>Para realizar el registro de varias salida, se marca el check box que aparece al lado izquierdo, ya seleccionados se da clic en la flecha roja que aparece en la parte inferior derecha de la pantalla, donde se abre un formulario para ingresar la cantidad de cada insumo y una descripci&oacute;n la salida. Ver </span><span class="c3">Figura 44. Registro de varias salidas de insumos.</span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.39kk8xu"><span class="c5 c4">Figura 44. Registro de varias salidas de insumos</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image03.png" style="width: 689.30px; height: 589.56px; margin-left: -93.97px; margin-top: -82.15px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c1"><span>Este formulario tambi&eacute;n contiene validaciones. </span><span class="c3">Ver </span><span class="c8 c3">Figura 41. Validaci&oacute;n de campos de entradas de insumos.</span></p><p class="c0"><span class="c8 c3"></span></p><p class="c0"><span class="c8 c3 c24"></span></p><p class="c1" id="h.1opuj5n"><span class="c4 c3">4.3.3 Generar reporte</span><span>: En la opci&oacute;n de generar reporte se imprime un documento parametrizable de las existencias de insumos actuales. Ver </span><span class="c3">Figura 45. Reporte de entradas y salidas.</span></p><p class="c0"><span class="c3"></span></p><p class="c0 c7"><span></span></p><p class="c11 c1 c7 c2" id="h.48pi1tg"><span class="c5 c4">Figura 45. Reporte de entradas y salidas</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 453.49px; height: 226.77px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image04.png" style="width: 780.11px; height: 503.93px; margin-left: -157.67px; margin-top: -88.47px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p>
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