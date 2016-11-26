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
          <h3 class="box-title"><strong>REGISTRAR OBJETIVO</strong></h3>
        </div>
          <form data-parsley-validate="" id="form" action="<?php echo URL; ?>ctrObjetivos/registrarObjetivo" method="POST" onsubmit="return ValObj()">
         <div class="box-body">
          <div class="row">
          <div class="col-lg-12">
            <div class="form-group col-lg-4">
              <label class="">Fecha registro:</label>
              <div class="">
              <div class="input-group date">
               <div class="input-group-addon">
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
                    <th>Talla</th>
                    <th>Cantidad Objetivo</th>
                    <th>Retirar</th>
                    </tr>
                  </thead>
                  <tbody>
                 <tr id="tblVaciaObj">
                  <td id="tblFichasObje" colspan="5" style="text-align:center;"></td>
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
                <div class="table table-responsive scrolltablas">
                  <table class="table table-hover table-bordered" style="margin-top: 2%;">
                  <thead>
                    <tr class="active">
                      <th style="display:none;">Id</th>
                      <th>Referencia</th>
                      <th>Nombre</th>
                      <th>Color</th>
                      <th>Talla</th>
                      <th>Cantidad Actual</th>
                      <th>Agregar</th>
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
                      <td><?= $ficha["Nombre_Talla"]?></td>
                      <td><?= $ficha["Cantidad"]?></td>
                      <td>
                       <button id="btnobj<?= $i; ?>" type="button" class="btn btn-box-tool btnasociarObje" onclick="asociarFichas('<?= $ficha["Id_Ficha_Tecnica"] ?>','<?= $ficha["Referencia"] ?>',  this, '<?= $i ?>', '<?= $ficha["Codigo_Color"]?>', '<?= $ficha["Nombre"]?>', '<?= $ficha["Nombre_Color"]?>', '<?= $ficha["Id_Fichas_Tallas"]?>', '<?= $ficha["Nombre_Talla"]?>')"><i style="font-size: 150%; color: blue;" class="fa fa-plus"></i></button>
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