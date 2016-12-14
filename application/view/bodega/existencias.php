    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li><a href="#">Bodega</a></li>
        <li class="active">Existencias Insumos</li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border" style="text-align: center;">
          <h3 class="box-title" style="margin-top: 0.7%"><strong>EXISTENCIAS INSUMOS</strong></h3>
          <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#ModAyudaRegIns" style="background: transparent; border: none;"><i class="fa fa-comment"></i></button>
        </div>
        <form id="form1" class="form-horizontal">
         <div class="col-md-12">
           <div style="margin-top: 10px;" class="box">
            <div class="box-body no-padding">
              <div class="table-responsive">
                <table table-responsive class="table table-bordered" id="tblExistencias">
                  <thead>
                    <tr class="active">
                      <th style="display: none;"></th>
                      <th><input type="checkbox" id="checkPadre" style="height:15px; width:15px;"></th>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Color</th>
                      <th>Medida</th>
                      <th>Cantidad</th>
                      <th>Valor Promedio</th>
                      <th style="text-align: center;">Stock Mínimo</th>
                      <th style="width: 7%">Entrada</th>
                      <th style="width: 7%">Salida</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $cont = 0;?>
                    <?php foreach($listEx as $valExt): ?>
                     <?php if ($valExt["Estado"] == 1): ?>
                       

                     <tr class="repIns">
                      <td style="display: none;"><?= $valExt["Id_Existencias_InsCol"]?></td>
                      <td><input type="checkbox" style="height:15px; width:15px;" id="chkExi<?= $valExt["Id_Existencias_InsCol"]?>" class="checkboxHijo"></td>
                      <td class="repoInsum"><?= $cont += 1;?></td>
                      <td class="repoInsum"><?= $valExt["NomIns"]?></td>
                      <td class="repoInsum"><?= $valExt["Nombre"]?></td>
                      <td class="repoInsum"><?= $valExt["medida"]?></td>
                      <td class="repoInsum"><?= $valExt["Cantidad_Insumo"]?></td>
                      <td class="repoInsum"><?= $valExt["Valor_Promedio"]?></td>
                      <td style="text-align: center;"><span class="badge bg-red"><?= $valExt["Stock_Minimo"]?></span></td>
                      <td style="text-align: center;">
                        <button type="button" onclick="existen(<?= $valExt["Id_Existencias_InsCol"]?>, this);" class="btn btn-box-tool arrowEntradaIns" data-toggle="modal" data-target="#ModelEntrada"><i style="color: green; font-size: 150%;" class="fa fa-arrow-up"></i></button>
                      </td>
                      <td style="text-align: center;">
                      <?php if ( $valExt["Cantidad_Insumo"] > 0 ): ?>
                        <button type="button" onclick="salidaUno(this)" class="btn btn-box-tool arrowSalidaIns" data-toggle="modal" data-target="#ModalSalida"><i style="color: red; font-size: 150%" class="fa fa-arrow-down"></i></button>
                      <?php else: ?>
                        <button type="button" onclick="salidaUno(this)" class="btn btn-box-tool" disabled=""><i style="color: red; font-size: 150%" class="fa fa-arrow-down"></i></button>
                      <?php endif ?>
                      </td>  
                    </tr>
                    <?php endif ?>
                  <?php endforeach ?>
                </tbody></table>
              </div>
            </div>
          </div>
        </div>
        <div class="box-footer">
          <div class="col-md-4">
           <a class="btn btn-primary" id="btnGenerarExistIns" role="button" onclick="generarExtIns();" target="_blank" href="<?= URL ?>ctrBodega/reporteInsumos/"><b>Generar Reporte</b></a>
         </div> 
         <div class="col-md-8" style="text-align: right;">
           <button type="button" onclick="tableEntMay()" class="btn btn-box-tool" id="entradaMultiple" disabled=""><i style="color: green; font-size: 200%;" class="fa fa-arrow-up"></i></button>
           <button type="button" class="btn btn-box-tool" onclick="salidaIns()" id="salidaMultiple" disabled=""><i style="color: red; font-size: 200%;" class="fa fa-arrow-down"></i></button>
         </div>
       </div>
     </form>  
   </div> 
 </section> 

 <div class="modal fade" id="ModelEntrada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document" style="border-radius: 25px;">
    <div class="modal-content" style="border-radius: 20px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" style="text-align: center;"><strong>ENTRADA DE INSUMO</strong></h4>
      </div>

      <form data-parsley-validate="" action="<?= URL; ?>ctrBodega/regEntrada" method="POST">
        <div class="modal-body">

        <div class="form-horizontal"> 
        <input type="hidden" name="idExs" id="idExs">
        <input type="hidden" name="cantActual" id="cantActual">
        <input type="hidden" name="valPromedio" id="valPromedio">
        <div class="form-group">
         <h4 class="col-md-3">Fecha Entrada: </h4>
         <div class="col-md-9">
           <input type="text" class="form-control" name="fechaEnt" value="<?= date("Y-m-d")?>" readonly="">
         </div>
       </div>
       <div class="form-group">
         <h4 class="col-md-3">Nombre: </h4>
         <div class="col-md-9">
           <input type="text" class="form-control" id="nomIns" disabled="true">
         </div>
       </div>
       <div class="form-group">
         <h4 class="col-md-3">Color: </h4>
         <div class="col-md-9">
           <input type="text" class="form-control" id="coloIns" disabled="true">
         </div>
       </div>

       <div class="form-group">
         <h4 class="col-md-3">Medida: </h4>
         <div class="col-md-9">
           <input type="text" class="form-control" id="medIns" disabled="true">
         </div>
       </div>

       <div class="form-group">
         <h4 class="col-md-3">Cantidad: </h4>
         <div class="col-md-9">
          <input data-parsley-required="" type="number" id="cant" name="cant" class="form-control"  min="1" maxlength="10"> 
        </div> 
      </div>
      <div class="form-group">
       <h4 class="col-md-3">Valor Unitario: </h4>
       <div class="col-md-9">
         <input data-parsley-required="" type="number" id="valUnit" name="valorUni" class="form-control" min="0" maxlength="10">
       </div>
     </div>
     <div class="form-group">
       <h4 class="col-md-3">Valor Total: </h4>
       <div class="col-md-9">
         <input  data-parsley-required="" type="number" id="valTot" name="valorTot" class="form-control" min="0" maxlength="10">
       </div>
     </div>

   </div>
 </div>
 <div class="modal-footer">
  <div class="row">
    <div class="col-lg-offset-3 col-lg-3">
      <button type="submit" name="regUno" class="btn btn-success btn-md btn-block"><i class="fa fa-check-circle" aria-hidden="true"></i>  Registrar</button>
    </div>
    <div class="col-lg-3">
      <button type="button" data-dismiss="modal" class="btn btn-default btn-md btn-block" style="margin-left: 2%;"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
    </div>
  </div>
</div> 
</form>
</div> 
</div>
</div>

<!-- SALIDA DE INSUMOS DE A UNO -->


 <div class="modal fade" id="ModalSalida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document" style="border-radius: 25px;">
    <div class="modal-content" style="border-radius: 20px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" style="text-align: center;"><strong>SALIDA DE INSUMO</strong></h4>
      </div>

      <form data-parsley-validate="" action="<?= URL; ?>ctrBodega/regSalida" method="POST">
        <div class="modal-body">

        <div class="form-horizontal"> 
        <input type="hidden" name="idExs" id="idExiSal">
        <input type="hidden" name="cant" id="cantAct">
        <div class="form-group">
         <h4 class="col-md-3">Fecha Salida: </h4>
         <div class="col-md-9">
           <input type="text" class="form-control" name="fechaSal" value="<?= date("Y-m-d")?>" readonly="">
         </div>
       </div>
       <div class="form-group">
         <h4 class="col-md-3">Nombre: </h4>
         <div class="col-md-9">
           <input type="text" class="form-control" id="nomInsSal" disabled="true">
         </div>
       </div>
       <div class="form-group">
         <h4 class="col-md-3">Color: </h4>
         <div class="col-md-9">
           <input type="text" class="form-control" id="coloInsSal" disabled="true">
         </div>
       </div>

       <div class="form-group">
         <h4 class="col-md-3">Medida: </h4>
         <div class="col-md-9">
           <input type="text" class="form-control" id="medInsSal" disabled="true">
         </div>
       </div>

       <div class="form-group">
         <h4 class="col-md-3">Cantidad: </h4>
         <div class="col-md-9">
          <input data-parsley-required="" type="number" id="cantSal" name="cantSal" class="form-control"  min="1"> 
        </div> 
      </div>
     <div class="form-group">
       <h4 class="col-md-3">Descripción: </h4>
       <div class="col-md-9">
         <textarea type="text" id="descripcionSal" name="descripcion" class="form-control" maxlength="100"> </textarea>
       </div>
     </div>

   </div>
 </div>
 <div class="modal-footer">
  <div class="row">
    <div class="col-md-offset-3 col-md-3">
      <button type="submit" name="regUnaSal" class="btn btn-success btn-md btn-block"><i class="fa fa-check-circle" aria-hidden="true"></i> <b>Registrar</b></button>
    </div>
    <div class="col-md-3">
      <button data-dismiss="modal" type="button" class="btn btn-default btn-md btn-block" style="margin-left: 2%;"><i class="fa fa-times-circle" aria-hidden="true"></i> <b>Cerrar</b></button>      
    </div>
  </div>
</div> 
</form>
</div> 
</div>
</div>

<div class="modal fade" data-backdrop="static" data-keyboard="false" id="ModalEntradaMayor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 20px;">

      <form onsubmit="return validateMuchasEntradas()" data-parsley-validate="" action="<?= URL;?>ctrBodega/regEntrada" method="POST">
        <div class="modal-header" style="text-align: center;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><strong>ENTRADA DE INSUMOS</strong></h4>
        </div>

        <div class="modal-body">
        <div class="col-md-12">
         <div class="box">
          <div class="box-body no-padding">
           <div class="table-responsive scrolltablas"> 
            <table class="table table-hover cell-border" id="tableEnt" >
              <thead>
                <tr class="active">
                  <th style="display: none;"></th>
                  <th>Nombre</th>
                  <th>Color</th>
                  <th>Medida</th>
                  <th style="display: none;"></th>
                  <th style="display: none;"></th>
                  <th>Cantidad</th>
                  <th>Valor Unitario</th>
                  <th>Valor Total</th>
                </tr>
              </thead>
              <tbody id="tbodyEnt">
              </tbody>      
            </table>
          </div>
        </div> 
      </div>
    </div>


     <div class="row">
      <div class="col-md-6">

        <div class="col-md-12">
          <div class="form-group">
           <input type="hidden" name="id" id="mSel">
           <label class="control-label" length="80px">Fecha Entrada: </label>
           <input type="text" class="form-control" readonly="" name="fechaEnt" value="<?= date("Y-m-d"); ?>">
         </div>
       </div>    
     </div>
     <div class="col-md-6">
      <div class="col-md-12">
        <div class="form-group">
         <label class="control-label">Valor Entrada: </label>
         <div class="input-group">
          <span class="input-group-addon">$</span>
           <input type="number" readonly="" value="0" class="form-control" id="valEnt" data-parsley-required="" name="valorTot">
         </div>
       </div>
     </div>
   </div>
 </div>
</div>

<input type="hidden" id="vec" name="vec">
<div class="modal-footer">
  <div class="row">
    <div class="col-lg-offset-3 col-lg-3">
      <button type="submit" class="btn btn-success btn-md btn-block" style="margin-left: 2%; margin-top: 2%" id="regMuchos" name="regMuchos"><i class="fa fa-check-circle" aria-hidden="true"></i>  <b>Registrar</b></button>
    </div>
    <div class="col-lg-3">
      <button type="button" data-dismiss="modal" class="btn btn-default btn-md btn-block" style="margin-left: 2%; margin-top: 2%"><i class="fa fa-times-circle" aria-hidden="true"></i> <b>Cerrar</b></button>
    </div>
  </div>
</div> 
</form>
</div> 
</div>
</div>




<!-- SALIDA DE VARIOS INSUMOS -->



 <div class="modal fade" data-backdrop="static" data-keyboard="false" id="SalidaMuchos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 20px;">

      <form onsubmit="return validateMuchasSalidas()" data-parsley-validate="" action="<?= URL;?>ctrBodega/regSalida" method="POST">
        <div class="modal-header" style="text-align: center;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><strong>SALIDA DE INSUMOS</strong></h4>
        </div>

        <div class="modal-body">
        <div class="col-md-12">
         <div class="box">
          <div class="box-body no-padding">
           <div class="table-responsive scrolltablas"> 
            <table class="table table-hover cell-border" id="tableSalIns" >
              <thead>
                <tr class="active">
                  <th style="display: none;"></th>
                  <th>Nombre</th>
                  <th>Color</th>
                  <th>Medida</th>
                  <th style="display: none;"></th>
                  <th>Cantidad</th>
                </tr>
              </thead>
              <tbody id="tbodySalIns">
              </tbody>      
            </table>
          </div>
        </div> 
      </div>
    </div>


     <div class="row">
      <div class="col-md-6">

        <div class="col-md-12">
          <div class="form-group">
           <label class="control-label" length="80px">Fecha Salida: </label>
           <input type="text" class="form-control" readonly="" name="fechaSal" value="<?= date("Y-m-d"); ?>">
         </div>
       </div>    
     </div>
     <div class="col-md-6">
      <div class="col-md-12">
        <div class="form-group">
         <label class="control-label">Descripción: </label>
         <textarea class="form-control" id="descripcion" name="descripcion" maxlength="100"></textarea>
       </div>
     </div>
   </div>
 </div>
</div>

<input type="hidden" id="arraySalIns" name="arraySalIns">
<div class="modal-footer">
  <div class="row">
    <div class="col-lg-offset-3 col-lg-3">
      <button type="submit" class="btn btn-success btn-md btn-block" style="margin-left: 2%; margin-top: 2%" id="salIns" name="salIns"><i class="fa fa-check-circle" aria-hidden="true"></i>  Registrar</button>
    </div>
    <div class="col-lg-3">
      <button type="button" data-dismiss="modal" class="btn btn-default btn-md btn-block" style="margin-left: 2%; margin-top: 2%"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
    </div>
  </div>
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