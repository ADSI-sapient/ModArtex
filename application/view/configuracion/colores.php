<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
    <li><a href="#">Configuración</a></li>
    <li class="active">Colores</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <!--Registrar Rol-->
    <div class="col-md-6">
      <div class="box box-primary" style="height: 385px;">
        <div class="box-header with-border" style="text-align: center;"> 
          <h4 class="box-title" style="margin-top: 1.2%;"><strong>REGISTRAR COLOR</strong></h4>
          <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#ModConfig" style="background: transparent; border: none;"><i class="fa fa-comment"></i></button>
        </div>
        <form data-parsley-validate="" action="<?= URL.'ctrConfiguracion/registrarColor'?>" method="POST">
            <div class="box-body">



               <div style="margin-top: 30px" class="form-group">
                 <h4>*Código: </h4>
                  <div class="input-group my-colorpicker2 colorpicker-element">
                    <input type="text" name="codigo" class="form-control" readonly="" data-parsley-required="" data-parsley-errors-container="#contErrorRegCodCol">
                    <div  class="input-group-addon">
                      <i style="background-color: grey;" id="colDatapicker" type="input"></i>
                    </div>
                  </div>
                  <div id="contErrorRegCodCol"></div>
                 <h4>*Nombre: </h4>
                <input id="nomColorReg" type="text" name="nombre" class="form-control" data-parsley-required="" maxlength="45">
              </div>



          </div>



          <div class="box-footer" style="margin-top: 50px;">
              <div class="row">
                <div class="col-md-offset-3 col-md-3">
                  <button type="submit" class="btn btn-success btn-md btn-block"><i class="fa fa-check-circle" aria-hidden="true"></i> <b>Registrar</b></button> 
                </div>
                <div class="col-md-3">
                  <button type="reset" onclick="resetCol();" class="btn btn-default btn-md btn-block"><i class="fa fa-eraser" aria-hidden="true"></i> <b>Limpiar</b></button>
                </div>
              </div>  
          </div> 
        </form>
      </div>
    </div>


    <div class="col-md-6">
      <div class="box box-primary" style="height: 385px;">
          <div class="box-header with-border" style="text-align: center;"> 
               <h4 class="box-title" style="margin-top: 1.2%;"><strong>LISTAR COLORES</strong></h4>
               <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#ModConfig" style="background: transparent; border: none;"><i class="fa fa-comment"></i></button>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-hover" id="tblConfColores">
                <thead>
                <tr class="active">
                  <th style="width: 10%">#</th>
                  <th>Código</th>
                  <th>Muestra</th>
                  <th>Nombre</th>
                  <th style="display:none;"></th>
                  <th style="text-align: center;">Modificar</th>
                  <th style="text-align: center;">Eliminar</th>
                </tr>
                </thead>
                <tbody>
                  <?php $cont = 0?>
                  <?php foreach ($lista as $valor): ?>
                    <tr>
                      <td><?= $cont += 1; ?></td>
                      <td> <i class="fa fa-square" style="color:<?= $valor["Codigo_Color"]; ?>; font-size: 200%;"></i></td>
                      <td><?= $valor["Codigo_Color"]; ?></td>
                      <td><?= $valor["Nombre"]; ?></td>
                      <td style="display: none; "><?= $valor["Id_Color"]; ?></td>
                      <td style="text-align: center;">
                         <button style="padding: 0 !important;" type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#modalEditColor" onclick="editarColor('<?= $valor["Codigo_Color"]; ?>', this)"><i style="font-size: 150%;" class="fa fa-pencil-square-o"></i></button> 
                      </td>
                      <td style="text-align: center;">
                        <button style="padding: 0 !important;" type="button" onclick="confirmacionColor(this, <?= $valor['Id_Color']; ?>, false);" class="btn btn-box-tool"><i style="font-size: 150%;" class="fa fa-times"></i></button>
                      </td>  
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>
  </div>
</section>






<div class="modal fade" id="modalEditColor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
      <div class="modal-dialog modal-md" role="document";>
        <div class="modal-content" style="border-radius: 10px;">
          <div class="modal-header with-border" style="text-align: center;"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title"><strong>MODIFICAR COLOR</strong></h4>
          </div>
          <form action="<?= URL.'ctrConfiguracion/modificarColor'; ?>" method="POST" data-parsley-validate="">
            <div class="modal-body">
              <div class="form-horizontal"> 
                  <input id="id" name="id" style="display: none;">
                  <div class="form-group"> 
                   <h4 class="col-md-3">*Código: </h4>
                     <div class="col-md-9">
                      <div class="input-group my-colorpicker2 colorpicker-element">
                        <input type="text" class="form-control" name="codigo" id="codigo" readonly="" data-parsley-required="">
                        <div class="input-group-addon">
                          <i id="i"></i>
                        </div>
                      </div>
                     </div> 
                  </div>
                  <div class="form-group">
                     <h4 class="col-md-3">*Nombre: </h4>
                     <div class="col-md-9">
                     <input type="text" class="form-control" id="inputNom" name="nombre" data-parsley-required="" maxlength="45">
                   </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <div class="col-md-offset-3 col-md-3">
                  <button type="submit" class="btn btn-warning btn-md btn-block"><i class="fa fa-refresh" aria-hidden="true"></i> <b>Actualizar</b></button> 
                </div>
                <div class="col-md-3">
                  <button type="reset" class="btn btn-default btn-md btn-block" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> <b>Cerrar</b></button>
                </div>
              </div>         
          </div> 
        </form> 
      </div>
    </div>
</div>

<div class="modal fade" id="ModConfig" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 10px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><strong>AYUDA USUARIO</strong></h4>
        </div>
        <div class="modal-body"> 
        <div class="modAyuda scrollAyuda">
            <ol class="c17 lst-kix_list_11-0" start="2"><li class="c1 c2 c16"><h1 id="h.44sinio" style="display:inline"><span>M&Oacute;DULO DE CONFIGURACI&Oacute;N</span></h1></li></ol><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>El m&oacute;dulo de configuraci&oacute;n nos permite establecer las medidas y los colores que van a estar disponibles para asociar en los dem&aacute;s m&oacute;dulos, tambi&eacute;n nos permite crear roles para un mejor control de cada uno de los procesos del aplicativo.</span></p><p class="c0"><span></span></p><h2 class="c0 c2"><span></span></h2><h2 class="c1 c2" id="h.2jxsxqh"><span>3.1 MEDIDAS</span></h2><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>En el m&oacute;dulo de configuraci&oacute;n, opci&oacute;n medidas, podemos llevar un control de las unidades de medidas que vamos a utilizar en los dem&aacute;s procesos del aplicativo. Ver </span><span class="c3">Figura 9. M&oacute;dulo de medidas</span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.z337ya"><span class="c5 c22">Figura 9. M&oacute;dulo de Medidas</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image85.png" style="width: 589.23px; height: 445.53px; margin-left: -0.00px; margin-top: -39.51px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.3j2qqm3"><span class="c4 c3">3.1.1 Registrar medida</span><span>: Para registrar una medida, se da clic en el m&oacute;dulo configuraci&oacute;n, opci&oacute;n Medidas donde ingresa el nombre y la abreviatura. Ver </span><span class="c3">Figura 10. Registro de medida.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c13 c1 c7 c2" id="h.1y810tw"><span class="c5 c4">Figura 10. Registro de medida</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image90.png" style="width: 766.12px; height: 410.96px; margin-left: -256.51px; margin-top: -47.14px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span><span>&nbsp;</span></p><p class="c0 c9"><span></span></p><p class="c1" id="h.4i7ojhp"><span class="c4 c3">3.1.1.1 Validaci&oacute;n de campos de medida</span><span>: Al momento de dar clic en el bot&oacute;n &ldquo;Registrar&rdquo;, el sistema valida que se ingresen todos los datos correctamente. Ver </span><span class="c3">Figura 11. Validaci&oacute;n de campos de medida.</span></p><p class="c0"><span class="c3"></span></p><p class="c1 c7 c2 c11" id="h.2xcytpi"><span class="c5 c4">Figura 11. Validaci&oacute;n de campos de medida</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image88.png" style="width: 755.66px; height: 436.42px; margin-left: -249.73px; margin-top: -47.74px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0 c9"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>En caso contrario el sistema muestra un mensaje confirmando el registro exitoso. Ver </span><span class="c3">Figura 12. Registro de medida exitoso.</span></p><p class="c0"><span class="c3"></span></p><p class="c6 c1 c2" id="h.1ci93xb"><span class="c5 c4">Figura 12. Registro de medida exitoso</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 453.54px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image89.png" style="width: 694.21px; height: 411.06px; margin-left: -229.42px; margin-top: -47.20px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.3whwml4"><span class="c4 c3">3.1.2 Listar medidas</span><span>: En la opci&oacute;n de listar medidas, se puede visualizar de manera general, por medio de una tabla interactiva las unidades de medida, disponibles en el aplicativo, tambi&eacute;n est&aacute; disponible la acci&oacute;n de modificar o eliminar una unidad de medida. Ver </span><span class="c3">Figura 13. Listar medidas.</span></p><p class="c0"><span></span></p><p class="c11 c1 c7 c2" id="h.2bn6wsx"><span class="c5 c4">Figura 13. Listar medidas</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image91.png" style="width: 758.89px; height: 420.40px; margin-left: -251.98px; margin-top: -47.13px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0 c9"><span></span></p><p class="c0 c9"><span></span></p><p class="c1" id="h.qsh70q"><span class="c4 c3">3.1.2.1 Modificar medida</span><span>: En la tabla que lista los insumos, est&aacute; la opci&oacute;n de editar, que abre un formulario que permite modificar: nombre y abreviatura. Ver </span><span class="c3">Figura 14. Modificar medida.</span></p><p class="c0"><span class="c3"></span></p><p class="c18 c1 c7" id="h.3as4poj"><span>Figura 14. Modificar medida.</span></p><p class="c0 c9"><span></span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 344.31px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image92.png" style="width: 1030.10px; height: 725.53px; margin-left: -422.08px; margin-top: -116.61px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c1 c7"><span>Este formulario tambi&eacute;n contiene validaciones de campos. Ver </span><span class="c3">Figura 11. Validaci&oacute;n de campos de medida.</span></p><p class="c0 c7"><span></span></p><p class="c0 c7"><span></span></p><p class="c1" id="h.1pxezwc"><span class="c4 c3">3.1.2.2 Eliminar medida</span><span>: En caso de equivocarse en el registro de una medida, o no volver a usarla, est&aacute; la opci&oacute;n de eliminar medida. Ver </span><span class="c3">Figura 15. Eliminar medida.</span><span>&nbsp;</span></p><p class="c0"><span></span></p><p class="c11 c1 c7 c2" id="h.49x2ik5"><span class="c5 c4">Figura 15. Eliminar medida</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image93.png" style="width: 1287.74px; height: 764.16px; margin-left: -582.60px; margin-top: -211.18px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0 c9"><span></span></p><p class="c0 c9"><span></span></p><h2 class="c1 c2" id="h.2p2csry"><span>3.2 COLORES</span></h2><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1"><span>En el m&oacute;dulo de configuraci&oacute;n, opci&oacute;n colores, se lleva el control de los colores que se encuentran disponibles para asociar en los dem&aacute;s procesos. Ver </span><span class="c3">Figura 16. M&oacute;dulo de colores.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.147n2zr"><span class="c5 c4">Figura 16. M&oacute;dulo de colores</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image94.png" style="width: 589.23px; height: 417.17px; margin-left: -0.00px; margin-top: -36.09px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.3o7alnk"><span class="c4 c3">3.2.1 Registrar Color</span><span>: En el m&oacute;dulo de configuraci&oacute;n, opci&oacute;n Colores, se puede registrar los colores que van a estar disponibles para asociar en los dem&aacute;s procesos. Ver </span><span class="c3">Figura 17. Registrar Color.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c11 c1 c7 c2" id="h.23ckvvd"><span class="c5 c4">Figura 17. Registrar color</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image95.png" style="width: 753.88px; height: 411.04px; margin-left: -249.14px; margin-top: -46.07px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c1" id="h.ihv636"><span class="c4 c3">3.2.1.1 Validaci&oacute;n de campos de color</span><span>: al momento de dar clic en el bot&oacute;n &ldquo;Registrar&rdquo;, el sistema valida que los campos est&eacute;n completos e ingresados correctamente, en caso de haber una inconsistencia, el sistema muestra un mensaje indicando el error, e impidiendo el registro exitoso. Ver </span><span class="c3">Figura 18. Validaci&oacute;n de campos de color.</span></p><p class="c0"><span class="c3"></span></p><p class="c0"><span></span></p><p class="c11 c1 c7 c2" id="h.32hioqz"><span class="c5 c4">Figura 18. Validaci&oacute;n de campos de color.</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 453.51px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image96.png" style="width: 694.11px; height: 458.85px; margin-left: -231.53px; margin-top: -52.58px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0 c9"><span class="c3"></span></p><p class="c0"><span class="c3"></span></p><p class="c1"><span>En caso contrario el sistema muestra un mensaje indicando el registro exitoso del color. Ver </span><span class="c3">Figura 19. Registro exitoso del color.</span></p><hr style="page-break-before:always;display:none;"><p class="c18 c1 c7" id="h.1hmsyys"><span>Figura 19. Registro exitoso del color</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image97.png" style="width: 743.29px; height: 409.53px; margin-left: -246.80px; margin-top: -44.79px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.41mghml"><span class="c4 c3">3.2.2 Listar colores</span><span>: En el m&oacute;dulo de configuraci&oacute;n, opci&oacute;n colores, se puede visualizar de manera general los colores registrados, que aparecen disponibles en los dem&aacute;s m&oacute;dulos del aplicativo. Ver </span><span class="c3">Figura 20. Listar colores.</span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c11 c1 c7 c2" id="h.2grqrue"><span class="c5 c4">Figura 20. Listar colores</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image98.png" style="width: 748.62px; height: 411.06px; margin-left: -185.31px; margin-top: -49.45px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1" id="h.vx1227"><span class="c4 c3">3.2.2.1 Modificar color</span><span>: Cuando se desea modificar un color, la opci&oacute;n est&aacute; disponible en el listar colores. Al dar clic al icono de modificar, se abre un formulario que permite editar los campos: C&oacute;digo y nombre. Ver </span><span class="c3">Figura 21. Modificar color.</span></p><p class="c0 c9"><span></span></p><p class="c0 c9"><span></span></p><p class="c11 c1 c7 c2" id="h.3fwokq0"><span class="c5 c4">Figura 21. Modificar color</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image66.png" style="width: 1019.10px; height: 725.82px; margin-left: -334.71px; margin-top: -115.59px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c1 c7"><span>Este formulario tambi&eacute;n contiene validaciones de campos. Ver </span><span class="c3">Figura 18. Validaci&oacute;n de campos de color.</span></p><p class="c0 c7"><span class="c3"></span></p><p class="c0 c7"><span class="c3"></span></p><p class="c1 c7" id="h.1v1yuxt"><span class="c4 c3">3.2.2.2 Eliminar color</span><span>: En caso de no necesitar m&aacute;s un color, en la opci&oacute;n listar colores est&aacute; disponible el icono para eliminar. Ver </span><span class="c3">Figura 22. Eliminar color.</span></p><p class="c0 c7"><span class="c3"></span></p><hr style="page-break-before:always;display:none;"><p class="c0 c18 c7"><span></span></p><p class="c11 c1 c7 c2" id="h.4f1mdlm"><span class="c5 c4">Figura 22. Eliminar color</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image67.png" style="width: 1315.53px; height: 849.08px; margin-left: -490.65px; margin-top: -231.07px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0 c9"><span></span></p><p class="c0 c9 c23"><span></span></p><h2 class="c1 c2" id="h.2u6wntf"><span>3.3 ROLES</span></h2><p class="c0"><span></span></p><p class="c0"><span class="c3"></span></p><p class="c1"><span>En el m&oacute;dulo de configuraci&oacute;n, opci&oacute;n roles, se permite llevar un control del acceso a cada uno de los m&oacute;dulos del aplicativo, por medio de permisos que son asignados a un rol, posteriormente los roles son asignados a una cuenta de usuario, dependiendo la funci&oacute;n que el usuario va a ejercer en el proceso. Ver &nbsp;</span><span class="c3">Figura 23. Roles. </span></p><p class="c0"><span class="c3"></span></p><p class="c0"><span></span></p><p class="c6 c1 c2" id="h.19c6y18"><span class="c5 c4">Figura 23. Roles</span></p><p class="c1"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 589.23px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image68.png" style="width: 589.23px; height: 401.35px; margin-left: -0.00px; margin-top: -35.19px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><h3 class="c0 c2"><span></span></h3><p class="c1" id="h.3tbugp1"><span class="c4 c3">3.3.1 Registrar rol</span><span>: Para un llevar un control del acceso a cada uno de los m&oacute;dulos del sistema de informaci&oacute;n est&aacute; la opci&oacute;n de creaci&oacute;n de roles, &nbsp;donde se debe ingresar un nombre que d&eacute; a entender la funci&oacute;n del rol y asignar permisos, dependiendo las funciones que el rol vaya a ejercer sobre el aplicativo. Ver </span><span class="c3">Figura 24. Registrar rol.</span></p><hr style="page-break-before:always;display:none;"><p class="c0 c18 c7"><span></span></p><p class="c11 c1 c7 c2" id="h.28h4qwu"><span class="c5 c4">Figura 24. Registrar rol</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image69.png" style="width: 765.86px; height: 422.03px; margin-left: -257.37px; margin-top: -48.41px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0 c9"><span></span></p><h4 class="c0 c2"><span></span></h4><p class="c0"><span></span></p><p class="c1" id="h.nmf14n"><span class="c4 c3">3.3.1.1 Validaciones de campos de rol</span><span>: Al momento de dar clic en el bot&oacute;n &ldquo;Registrar&rdquo;, el sistema valida que si se haya ingresado un nombre y se hayan asignado permisos. En caso de haber una inconsistencia, el sistema muestra una alerta informando del error, e impidiendo el registro exitoso. Ver </span><span class="c3">Figura 25. Validaciones de campos de rol.</span></p><p class="c0"><span></span></p><p class="c11 c1 c7 c2" id="h.37m2jsg"><span class="c5 c4">Figura 25. Validaciones de campos de rol</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image70.png" style="width: 977.83px; height: 408.25px; margin-left: -322.66px; margin-top: -44.75px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c1"><span>En caso contrario el sistema muestra una alerta, informando el registro exitoso del rol. Ver </span><span class="c3">Figura 26. Registro exitoso de rol.</span></p><p class="c0"><span class="c3"></span></p><p class="c0"><span class="c3"></span></p><p class="c11 c1 c7 c2" id="h.1mrcu09"><span class="c5 c4">Figura 26. Registro exitoso de rol</span></p><p class="c1 c7"><span class="c3">o</span><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image71.png" style="width: 981.91px; height: 409.50px; margin-left: -326.26px; margin-top: -45.79px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c1" id="h.46r0co2"><span class="c4 c3">3.3.2 Listar roles</span><span class="c3">: </span><span>En la opci&oacute;n &ldquo;Listar roles&rdquo;, se puede visualizar de manera general los roles registrados, con sus respectivos permisos, tambi&eacute;n se encuentra la opci&oacute;n de modificar y cambiar un estado a un rol en espec&iacute;fico. Ver </span><span class="c3">Figura 27. Listar roles.</span></p><p class="c0"><span class="c3"></span></p><p class="c0"><span class="c3"></span></p><p class="c11 c1 c7 c2" id="h.2lwamvv"><span class="c5 c4">Figura 27. Listar roles</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image72.png" style="width: 868.89px; height: 420.43px; margin-left: -288.52px; margin-top: -46.37px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0"><span></span></p><p class="c0"><span></span></p><p class="c1 c12" id="h.111kx3o"><span class="c4 c3">3.3.2.1 Permisos asignados</span><span>: En esta opci&oacute;n, se puede visualizar los permisos que un rol tiene asignados. Ver </span><span class="c3">Figura 28. Permisos asignados.</span></p><p class="c0 c12"><span class="c3"></span></p><p class="c0 c12"><span class="c3"></span></p><hr style="page-break-before:always;display:none;"><p class="c0 c7 c18"><span class="c15"></span></p><p class="c11 c1 c7 c2" id="h.3l18frh"><span class="c5 c4">Figura 28. Permisos asignados</span></p><p class="c1 c7 c12"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.33px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image73.png" style="width: 1025.83px; height: 702.50px; margin-left: -419.80px; margin-top: -110.95px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0 c9 c12"><span class="c3"></span></p><p class="c0 c7 c12"><span class="c3"></span></p><p class="c1 c7 c12" id="h.206ipza"><span class="c4 c3">3.2.2.2 Modificar rol</span><span class="c3">:</span><span>&nbsp;En caso de ser necesario, el sistema permite modificar un rol y sus permisos, a excepci&oacute;n del rol administrador. Ver </span><span class="c3">Imagen 29. Modificar rol. </span></p><p class="c0 c7 c12"><span class="c3"></span></p><p class="c1 c7 c2 c13" id="h.4k668n3"><span class="c5 c4">Figura 29. Modificar rol</span></p><p class="c1 c7 c12"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 302.36px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image74.png" style="width: 1029.20px; height: 439.45px; margin-left: -421.89px; margin-top: -68.51px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0 c12"><span class="c3"></span></p><p class="c1"><span>Este formulario tambi&eacute;n contiene validaciones de campos. Ver </span><span class="c3">Figura 25. Validaciones de campos de rol.</span></p><p class="c1" id="h.2zbgiuw"><span class="c4 c3">3.2.2.3 Modificar estado</span><span>: El sistema permite modificar un estado a un rol, solo los roles habilitados se podr&aacute;n asociar a un usuario. Ver </span><span class="c3">Figura 30. Modificar estado. </span></p><p class="c0"><span class="c3"></span></p><p class="c0"><span></span></p><p class="c11 c1 c7 c2" id="h.1egqt2p"><span class="c5 c4">Figura 30. Modificar estado</span></p><p class="c1 c7"><span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 491.34px; height: 340.16px;"><img alt="" src="<?= URL; ?>img/images_ayuda/image75.png" style="width: 1054.87px; height: 466.05px; margin-left: -457.00px; margin-top: -54.03px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title=""></span></p><p class="c0 c9"><span class="c3"></span></p><p class="c0"><span></span></p><hr style="page-break-before:always;display:none;"><p class="c0 c18 c7"><span></span></p> 
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