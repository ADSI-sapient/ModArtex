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
<section class="content-header">
    <ol class="breadcrumb">
      <li><a href="<?= URL ?>home/index"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="#">Objetivos</a></li>
      <li class="active">Registrar Objetivo</li>
    </ol>
  </section>
<section class="content">
      <div class="box box-primary">
        <div class="box-header with-border" style="text-align: center;">
          <h3 class="box-title" style="margin-top: 0.7%;"><strong>REGISTRAR OBJETIVO</strong></h3>
          <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#ModAyudaObjetivos" style="background: transparent; border: none;"><i class="fa fa-comment"></i></button>
        </div>
          <form data-parsley-validate="" id="form" action="<?php echo URL; ?>ctrObjetivos/registrarObjetivo" method="POST" onsubmit="return ValObj()">
         <div class="box-body">
          <div class="row">
          <div class="col-lg-12">
            <div class="form-group col-lg-4">
              <label class="">Fecha registro:</label>
              <div class="">
              <div class="input-group date">
               <div class="input-group-addon" style="border-radius:5px;">
                  <i class="fa fa-calendar"></i>
                </div>
              <input type="text" name="FechaRegistro" id="Fecha_Registro" readonly="" class="form-control" value="<?php echo date ("Y-m-d"); ?>"  >
            </div>
            </div>
            </div>
        
            <div class="form-group col-lg-4">
              <label>Estado:</label>
              <input type="text" name="estado" value="Pendiente" readonly="" class="form-control">
            </div>
           
           <div class="col-lg-4"> 
              <div class="form-group">
                <label class="control-label" style="padding-right: 10px;">*Fecha Inicio:</label>
                  <div class="input-group date">
                    <div class="input-group-addon" style="border-radius:5px;">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="Fecha_Inicio" name="FechaInicio" required="" data-parsley-errors-container="#errorfechainiciObj" onkeyup="prohibirEscritura();">
                </div>
                <div id="errorfechainiciObj"></div>
              </div>
            </div>

            </div>
          </div>

          <div class="row">
          <div class="col-lg-12">

            
            

            <div class="form-group col-lg-4">
              <label class="">*Nombre:</label>
              <input type="text" name="Nombre" id="Nombre" class="form-control" required="" maxlength="45">
            </div>
            <div class="col-lg-4"> 
              <div class="form-group">
                <label class="control-label" style="padding-right: 10px;">*Fecha Fin:</label>
                  <div class="input-group date">
                    <div class="input-group-addon" style="border-radius:5px;">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="Fecha_Fin" name="FechaFin" required="" data-parsley-errors-container="#errorfechafinobj" onkeyup="prohibirEscritura();">
                </div>
                <div id="errorfechafinobj"></div>
              </div>
            </div>
            <div class="col-lg-4">
              <button  type="button" class="btn btn-primary pull-right" data-toggle="modal" style="margin-top: 10%;" data-target="#FichasO"><b>Asociar Productos</b></button>
            </div>
          </div>
          </div>
          <div class="row">
          <div class="col-md-12" id="FichasS">
          <div class="col-md-12">
            <label>Productos Seleccionados:</label>
          <div class="table scrolltablas" style="margin-top: 2%;">
            <div class="col-lg-12 table-responsive" style="padding: 0;">
                <table class="table table-hover table-bordered" id="tablaFichass">
                  <thead>
                    <tr class="active">
                    <th>Referencia</th>
                    <th>Nombre</th>
                    <th>Color</th>
                    <th>Cantidad Objetivo</th>
                    <th>Retirar</th>
                    </tr>
                  </thead>
                  <tbody>
                 <tr id="tblVaciaObj">
                  <td id="tblFichasObje" colspan="6" style="text-align:center;"></td>
                </tr>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
        </div>
        </div>
        <div class="row">
        <div class="col-lg-offset-8 col-lg-4">
        <div class="col-lg-12">
            <label>Total:</label>
            <div class="">
            <input type="number" name="CantidadTotal" id="TotalT" class="form-control" value="" readonly="">
            </div>
          </div>
        </div>
        </div>


      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-lg-offset-3 col-lg-3">
            <button type="submit" class="btn btn-success btn-md btn-block" name="btnRegObjetivo" ><i class="fa fa-check-circle" aria-hidden="true"></i> <b>Registrar</b></button>
          </div>
          <div class="col-lg-3">
            <button type="reset" onclick="limpiarFormRegObj()" name="btnCanFicha" class="btn btn-default btn-md btn-block"><i class="fa fa-eraser" aria-hidden="true"></i> <b>Limpiar</b></button>
          </div>
        </div>
      </div>
    </form>
      </div>
  </section>


 <div class="modal fade" id="FichasO" tabindex="-1" role="dialog" >
        <div class="modal-dialog modal-lg">
          <div class="modal-content" style="border-radius: 10px;">
            <form method="POST">
            <div class="modal-header">

              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>PRODUCTOS PARA ASOCIAR</b></h4>
            </div>
            <div class="modal-body">
              <!-- <div class="table"> -->
                <div class="table table-responsive">
                  <table class="table table-hover table-bordered" style="margin-top: 2%;" id="tblProducPrAsoc">
                  <thead>
                    <tr class="active">
                      <th style="display:none;">Id</th>
                      <th>Referencia</th>
                      <th>Nombre</th>
                      <th>Color</th>
                      <th>Cantidad Actual</th>
                      <th>Agregar</th>
                      <th style="display: none"></th>
                      <th style="display: none"></th>
                    </tr>
                  </thead>
                  <tbody class="list">
                     <?php $i = 1; ?>
                  <?php foreach ($fichas as $ficha): ?>
                    <tr >
                      <td style="display:none;"><?= $ficha["Id_Ficha_Tecnica"]?></td>
                      <td><?= $ficha["Referencia"]?></td>
                      <td><?= $ficha["Nombre"]?></td>
                      <td><i class="fa fa-square" style="color: <?= $ficha["Codigo_Color"]?>; font-size: 200%;" title='<?= $ficha["Nombre_Color"]?>'></i></td>  
                      <td><?= $ficha["Cantidad"]?></td>
                      <td>
                       <button id="btnobj<?= $i; ?>" type="button" class="btn btn-box-tool btnasociarObje" onclick="asociarFichas('<?= $ficha["Id_Ficha_Tecnica"] ?>','<?= $ficha["Referencia"] ?>',  this, '<?= $i ?>', '<?= $ficha["Codigo_Color"]?>', '<?= $ficha["Nombre"]?>', '<?= $ficha["Nombre_Color"]?>', '<?= $ficha["Id_Ficha_Tecnica"]?>')"><i style="font-size: 150%; color: blue;" class="fa fa-plus"></i></button>
                      </td>
                      <td style="display: none" id="ICantidad"></td>
                      <td style="display:none;"><?= $ficha["Nombre_Color"]?></td>
                    </tr>
                    <?php $i++; ?>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              <!-- </div> -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-lg" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
            </div>
          </div><!-- /.modal-content -->
          </form>
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

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


<div class="modal fade" id="ModAyudaObjetivos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 10px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><strong>AYUDA USUARIO</strong></h4>
        </div>
        <div class="modal-body"> 
        <div class="modAyuda scrollAyuda">
          <ol class="c17 lst-kix_list_11-0" start="10"><li class="c1 c16 c2"><h1 id="h.22vxnjd" style="display:inline"><span>OBJETIVOS</span></h1></li></ol><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>El m&oacute;dulo de objetivos no influye con otros procesos, pero de igual manera es de vital importancia, ya que le permite a la empresa plantarse metas en determinado tiempo y en caso de no cumplirse, estudiar las falencias que el proceso de producci&oacute;n puede tener. </span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><h2 class="c1 c2" id="h.i17xr6"><span>11.1 REGISTRAR OBJETIVO</span></h2><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>Al momento de registrar un objetivo, el sistema asigna la fecha actual con el estado, los campos: Fecha inicio, nombre y fecha fin quedan habilitados para ser ingresados, adem&aacute;s se debe asociar los productos en los que estar&aacute; el objetivo. Ver</span><span class="c3">&nbsp;Figura 93. Registrar objetivo</span><span>.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.320vgez"><span class="c5 c4">Figura 93. Registrar objetivo.</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image46.png" style="width: 589.23px; height: 364.97px; margin-left: -0.00px; margin-top: -33.34px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><hr style="page-break-before:always;display:none;"><p class="c0 c18 c7"><span></span></p><p class="c1" id="h.1h65qms"><span class="c4 c8 c3">11.2 LISTAR OBJETIVOS</span><span>:</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>Al momento de dar clic en la opci&oacute;n de Listar objetivos, aparece una tabla interactiva que muestra la informaci&oacute;n con su respectivo objetivo, si se desea ver de manera individual alguno, est&aacute; la opci&oacute;n: productos asociados, modificar, ver estad&iacute;sticas o tambi&eacute;n cancelar objetivo. Ver </span><span class="c3">Figura 94. Listar objetivos.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.415t9al"><span class="c5 c4">Figura 94. Listar objetivos</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 580.54px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image47.png" style="width: 589.00px; height: 471.77px; margin-left: -0.00px; margin-top: -43.38px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.2gb3jie"><span class="c4 c3">11.2.1 Productos asociados</span><span>: Para ver los productos asociados al objetivo, est&aacute; el icono &ldquo;Ver productos asociados&rdquo;, que muestra por medio de una tabla todas las referencias del objetivo. Ver </span><span class="c3">Figura 95. Productos asociados.</span><span>&nbsp;</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.vgdtq7"><span class="c5 c4">Figura 95. Productos asociados</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 226.77px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image82.png" style="width: 750.32px; height: 561.27px; margin-left: -125.80px; margin-top: -75.09px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.3fg1ce0"><span class="c4 c3">11.2.2 Editar</span><span>: al dar clic al icono de &ldquo;Modificar&rdquo; se abre un formulario que permite diligenciar de nuevo los campos: Nombre, Fecha inicio y Fecha fin, a su vez tambi&eacute;n permite asociar de nuevo o eliminar referencias del objetivo. Ver </span><span class="c3">Figura 96.Editar objetivo.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.1ulbmlt"><span class="c5 c4">Figura 96. Editar objetivo</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image84.png" style="width: 759.40px; height: 406.31px; margin-left: -129.69px; margin-top: -55.48px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c0"><span class="c8 c3"></span></p><p class="c1"><span class="c8 c3">11.2.4 Cancelar objetivo</span><span>: En caso de necesitar cancelar un objetivo, la acci&oacute;n es posible, dando clic en el icono &ldquo;Cancelar&rdquo;, que aparece en el listar, de inmediato aparece un mensaje para confirmar la acci&oacute;n. Ver </span><span class="c3">Figura 98. Cancelar objetivo.</span></p><p class="c6 c1 c2" id="h.4ekz59m"><span class="c5 c4">Figura 98. Cancelar objetivo</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image86.png" style="width: 1452.68px; height: 856.67px; margin-left: -465.70px; margin-top: -283.37px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><hr style="page-break-before:always;display:none;"><p class="c0" id="h.2tq9fhf"><span></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><div><p class="c1 c9 c27"><span class="c14">&nbsp;</span></p><p class="c1 c7 c20"><span class="c14">&nbsp;</span></p>
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