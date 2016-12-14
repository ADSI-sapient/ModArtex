<section class="content-header">
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li><a href="#">Producto T</a></li>
        <li class="active">Listar objetivos</li>
      </ol>
    </section>
  <!-- Main content -->
  <section class="content">
     <div class="box box-primary">
      <div class="box-header with-border"  style="text-align: center;">
       <h3 class="box-title" style="margin-top: 0.7%"><strong>LISTAR OBJETIVOS</strong></h3>
       <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#ModAyudaObjetivos" style="background: transparent; border: none;"><i class="fa fa-comment"></i></button>
      </div>
      <div id="users">
         <form class="form-horizontal">
          <div class="col-md-12">
              <div class="table table-responsive">
                <table class="table table-hover cell-border" id="TablaObjetivos">
                  <thead>
                    <tr class="info"> 
                      <th></th>
                      <th>Fecha de Registro</th>
                      <th>Nombre</th>
                      <th>Fecha Inicio</th>
                      <th>Fecha Fin</th>
                      <th>Total Objetivo</th>
                      <th>Estado</th>
                      <th style="display:none">Id_Estado</th>
                      <th>Editar</th>
                      <th>Estadísticas</th>
                      <th>Referencias</th>
                      <th>Cancelar</th>
                    </tr>
                  </thead>
                  <tbody class="list">
                  <?php foreach ($objetivos as $objetivo): ?>
                    <tr>
                    <td class="Id_Objetivo"><?= $objetivo["Id_Objetivo"] ?></td>
                    <td class="Fecha_Registro"><?= $objetivo["FechaRegistro"] ?></td>
                    <td class="Nombre"><?= $objetivo["Nombre"] ?></td>
                    <td class="Fecha_Inicio"><?= $objetivo["FechaInicio"] ?></td>
                    <td class="Fecha_Fin"><?= $objetivo["FechaFin"]?></td>
                    <td class="Total"><?= $objetivo["CantidadTotal"]?></td>
                     <td><?= $objetivo["Nombre_Estado"] ?></td> 
                     <td style="display: none"><?= $objetivo["Id_Estado"] ?></td>
                      
                        <td>
                        <?php if ($objetivo["Nombre_Estado"] != "Pendiente"): ?>
                        <button disabled="" type="button" class="btn btn-box-tool"><i class="fa fa-pencil-square-o fa-lg" style="font-size:150%;"></i></button>
                        <?php else: ?>
                          <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#ModificarObj"onclick="ModificarObj('<?= $objetivo["Id_Objetivo"] ?>', '<?= $objetivo["FechaRegistro"] ?>', '<?= $objetivo["FechaInicio"] ?>', '<?= $objetivo["Nombre"] ?>', '<?= $objetivo["FechaFin"] ?>', this, 1)"><i style="font-size:150%;" class="fa fa-pencil-square-o fa-lg"></i></button>
                          <?php endif ?>
                          </td>
                        <td>
                         <?php if ($objetivo["Nombre_Estado"] != "En Proceso"): ?>
                           
                           <button disabled="" type="button" class="btn btn-box-tool"><i class="fa fa-signal open-modal-estadistica fa-lg" style="font-size:150%;"></i></button>

                         <?php else: ?>

                          <button type="button" id="Esta_diticas" class="btn btn-box-tool" onclick="mostrarGrafica('<?= $objetivo["Id_Objetivo"] ?>')"><i style="font-size:150%;" class="fa fa-signal open-modal-estadistica fa-lg" style="color:#3B73FF"></i></button>

                         <?php endif ?>
                        </td>
                        <td>                           
                         <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#ListarF" onclick=" listarO('<?= $objetivo["Id_Objetivo"] ?>', this)"><i class="fa fa-eye fa-lg" style="color:#3B73FF; font-size: 150%;"></i></button>
                        </td>
                     <td>
                          <?php if ($objetivo["Nombre_Estado"] != "Pendiente"): ?>
                            <button type="button" class="btn btn-box-tool" disabled=""><i class="fa fa-ban" style="font-size:150%;"></i></button>
                          <?php else: ?>
                            <button type="button" class="btn btn-box-tool" onclick="cancelarobjetivo('<?= $objetivo["Id_Objetivo"] ?>')" id="btn-cancel-ped"><i class="fa fa-ban fa-lg" style="color:red; font-size:150%;"></i></button>
                          <?php endif ?>
                        </td>

                    </tr>
                  <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <div class="col-md-12">
                <div id="canvCont" class="chart row">
                    <canvas id="barChart" style="height:230px"></canvas>
                </div>
              </div>
          </div>
          </form>
        </div>
        <div class="box-footer">
        </div>




      </div>

<!--Modal para listar las fichas -->
 <div class="modal fade" id="ListarF" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content" style="border-radius: 10px;">
       <div class="modal-header with-border" style="text-align: center;"> 
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><strong>PRODUCTOS SELECCIONADOS</strong></h4>
        </div>
        <div class="modal-body">
        <div class="table scrolltablas">
          <table class="table table-hover table-bordered" id="tablaFiO">
            <thead>
              <tr class="info">
                <th style="display: none;"></th>
                <th>Referencia</th>
                <th>Nombre</th>
                <th>Muestra</th>
                <th>Color</th>
                <th>Cantidad</th>
              </tr>
            </thead>
            <tbody id="FichasO">
            </tbody>
          </table>
          </div>
        </div>
        <div class="modal-footer" style="border-top:none; border-bottom:1px solid;">
          <button type="button" class="btn btn-default btn-lg" data-dismiss="modal" onclick="limpiarObj();"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
        </div>
      </div>
    </div>
  </div>
<!--Final del modal -->


<div class="modal fade" id="ModificarObj" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content" style="border-radius:10px">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">MODIFICAR OBJETIVO</h4>
            </div>
            
              <form data-parsley-validate="" role="form" id="ModificarObj" action="<?= URL ?>ctrObjetivos/listarObjetivos" method="post" data-parsley-validate="" onsubmit="return valFormModObj();">    
            <div class="modal-body">

              <input type="hidden" name="Id_Objetivo" id="Id_Objetivo">
              <input type="hidden" name="Id_Estado" id="Id_Estado">

              <div class="row">
                <div class="col-sm-12">

                  <div class="form-group col-sm-6">
                    <label class="">Fecha Registro:</label>
                    <div class="">
                  <div class="input-group date">
                    <div class="input-group-addon" style="border-radius:5px;">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" id="Fecha_Registro" name="FechaRegistro" readonly="" class="form-control">
                  </div>
                  </div>
                </div>
                  <div class="form-group col-sm-6">
                    <label class="">*Nombre:</label>
                    <input  type="text" name="Nombre" id="Nombre" class="form-control" required="" maxlength="45" data-parsley-required="">
                  </div>

                </div>
              </div>


              <div class="row">
              <div class="col-sm-12">
              <div class="form-group col-sm-6">
                <label class="control-label" style="padding-right: 10px;">*Fecha Inicio:</label>
                <div class="input-group date">
                  <div class="input-group-addon" style="border-radius:5px;">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="FechaInicio" id="FechaInicioMod" required="" data-parsley-errors-container="#errorFechaIncmodobj">
                </div>
                <div id="errorFechaIncmodobj"></div>
              </div>
              <div class="col-sm-4"> 
              <div class="form-group">
                <label class="control-label" style="">*Fecha Fin:</label>
                  <div class="input-group date">
                    <div class="input-group-addon" style="border-radius:5px;">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="Fecha_FinMod" name="FechaFin" required="" data-parsley-errors-container="#errorFechafinmodobj">
                </div>
                <div id="errorFechafinmodobj"></div>
              </div>
            </div>
            <div class="col-sm-2">
              <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#FichasN" onclick="listarON('<?= $objetivo["Id_Objetivo"]?>',this)" style="margin-top: 21%; margin-left:20%;"><b>Productos</b></button>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12" id="FichasS">
          <div class="col-md-12">
          <label>*Productos Seleccionados:</label>
          <div class="table scrolltablas" style="margin-top:2%;">
            <div class="col-lg-12 table-responsive" style="padding: 0;">
            <table class="table table-hover table-bordered" id="tablaFiOM">
            <thead>
              <tr class="info">
                <th>Referencia</th>
                <th>Nombre</th>
                <th>Color</th>
                <th>Cantidad</th>
                <th>Retirar</th>
              </tr>
            </thead>
            <tbody id="FichasOM">
            </tbody>
         </table>
      </div>
            </div>
        </div>
        </div>
        </div>

      <div class="row">
        <div class="col-sm-12">
          <div class="form-group col-sm-offset-6 col-sm-6">
            <label>Total Objetivo:</label>
            <input type="number" name="CantidadTotalN" id="TotalTN" class="form-control" value="0" readonly="">
          </div>
        </div>

        </div>
        </div>

          <div class="modal-footer" >
              <div class="row">
                <div class="col-md-offset-3 col-md-3">
                <button type="submit" class="btn btn-warning btn-md btn-block" name="btnModificarObj"><i class="fa fa-refresh" aria-hidden="true"></i>  <b>Actualizar</b></button>
                </div>
                <div class="col-md-3">
                  <button type="reset" class="btn btn-default btn-md btn-block" data-dissmis="modal" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
        </form>
      </div>
<!--Modal de estadisticas-->
  <div class="modal fade" id="Estadisticas" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document" style="width: 70%; border-radius: 25px;">
            <div class="modal-content" style="border-radius: 20px;">
              <div class="modal-header" style="text-align: center;">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title"><strong>AVANCE VS OBJETIVO</strong></h3>
              </div>
              <div class="modal-body">
                  <div class="box box-success">
                    <div class="box-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Fecha inicial</label>
                            <div class="input-group date">
                              <div class="input-group-addon" style="border-radius:5px;">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input readonly="" type="text" id="txtFechaI" name="txtFechaI" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Fecha final</label>
                            <div class="input-group date">
                              <div class="input-group-addon" style="border-radius:5px;">
                                <i class="fa fa-calendar"></i>
                              </div>
                            <input type="text" readonly="" id="txtFechaF" name="txtFechaF" class="form-control">
                            </div>
                            <input type="hidden" name="Id_Objetivos" id="Id_Objetivos">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <!-- <button class="btn btn-success" onclick="mostrarGrafica()">Consultar</button> -->
                        </div>
                      </div>
                      
                      <div class="chart row">
                        <canvas id="barChart" style="height:230px"></canvas>
                      </div>
                    </div>
                </div>
             </div>
             <div class="modal-footer" style="border-top:none; border-bottom:1px solid;">

              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>

              <button class="btn btn-success" onclick="mostrarGrafica()">Consultar</button>

            </div>
         </div>
       </div>
  </div>

   <div class="modal fade" id="FichasN" tabindex="-1" role="dialog" >
        <div class="modal-dialog">
          <div class="modal-content" style="border-radius: 10px;">
            <form method="POST">
            <div class="modal-header">

              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>PRODUCTOS PARA ASOCIAR</b></h4>
            </div>
            <div class="modal-body">
              <div class="table">
                <div class="col-sm-12 table-responsive">
                  <table class="table table-hover table-bordered" style="margin-top: 2%;" id="tblObjetivosAsoProdts">
                  <thead>
                    <tr class="active">
                      <th style="display:none;">Id</th>
                      <th>Referencia</th>
                      <th>Nombre</th>
                      <th>Color</th>
                      <th>Cantidad Actual</th>
                      <th>Seleccionar</th>
                      <th style="display: none"></th>
                      <th style="display: none"></th>
                    </tr>
                  </thead>
                  <tbody>
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
                       <button id="btnobjMod<?= $i; ?>" type="button" class="btn btn-box-tool btnasociarObje" onclick="asociarFichasNuevas('<?= $ficha["Id_Ficha_Tecnica"] ?>','<?= $ficha["Referencia"] ?>',  this, '<?= $i ?>', '<?= $ficha["Codigo_Color"]?>', '<?= $ficha["Nombre"]?>')"><i style="font-size:150%; color:blue;" class="fa fa-plus"></i></button>
                      </td>
                      <td style="display: none" id="ICantidad"></td>
                      <td style="display:none;"><?= $ficha["Nombre_Color"]?></td>
                    </tr>
                    <?php $i++; ?>
                      <?php endforeach; ?>
                    </tbody>
                  </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-lg" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cerrar</button>
            </div>
          </div><!-- /.modal-content -->
          </form>
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->


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