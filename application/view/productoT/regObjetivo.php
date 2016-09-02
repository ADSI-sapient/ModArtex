<!-- Content Header (Page header) -->
  <section class="content-header">
    <ol class="breadcrumb">
      <li><a href="../../starter2.html"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="#">Objetivos</a></li>
      <li class="active">Registrar Objetivos</li>
    </ol>
  </section>
  <br>

  <section class="content">
    <div class="box box-primary" style="padding-right: 15px;">
      <div class="box-header with-border">
        <div class="box-header with-border" style="text-align: center;">
          <h3 class="box-title"><strong>REGISTRAR OBJETIVOS</strong></h3>
        </div>
        <br>
        <br>
        <form method="POST">
            <div class="form-group col-lg-offset-1 col-lg-4">
              <label class="">Fecha registro:</label>
              <input type="text" name="FechaActualR" class="form-control" value="<?php echo date ("Y-m-d"); ?>" readonly>
            </div>
        
            <div class=" col-lg-offset-1 col-lg-4"> 
              <div class="form-group">
                <label class="control-label" style="padding-right: 10px;">*Fecha inicio:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right calendario" id="datepicker" name="FechaFin">
                </div>
              </div>
            </div>

           <div class="form-group col-lg-offset-1 col-lg-4">
              <label class="">*Nombre:</label>
              <input type="text" name="Nombre" id="Nombre" class="form-control">
            </div>
        
            <div class=" col-lg-offset-1 col-lg-4"> 
              <div class="form-group">
                <label class="control-label" style="padding-right: 10px;">*Fecha fin:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right calendario" id="datepicker" name="FechaFin">
                </div>
              </div>
            </div>

            
           <div class="form-group col-lg-offset-1 col-lg-4">
              <label>Estado</label>
              <input type="text" name="estado" value="Habilitado" readonly="" class="form-control">
            </div>

          <div class="col-lg-offset-1 col-lg-4">
            <button  type="button" class="btn btn-primary pull-right" data-toggle="modal" style="margin-top: 10%;" data-target="#FichasO">Seleccionar Productos</button>
          </div>



          <div  class="form-group" id="FichasS">
            <div class="table">
              <div class="col-lg-12 table-responsive">
                <table class="table table-hover" style="margin-top: 2%;" id="tablaFichass">
                  <thead>
                    <tr class="active">
                      <th>Referencia</th>
                      <th>Cantidad</th>
                      <th>Quitar</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          </form>
      </div>
    </div>
  </section>


 <div class="modal fade" id="FichasO" tabindex="-1" role="dialog" >
        <div class="modal-dialog">
          <div class="modal-content" style="border-radius: 10px;">
            <form method="POST">
            <div class="modal-header">

              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Fichas tecnicas</b></h4>
            </div>
            <div class="modal-body">
              <div class="table">
                <div class="col-sm-12 table-responsive">
                  <table class="table table-hover" style="margin-top: 2%;">
                  <thead>
                    <tr class="active">
                      <th>Referencia</th>
                      <th>Cantidad</th>
                      <th>Seleccionar</th>
                      <th style="display: none"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tbody class="list">
                     <?php $i = 1; ?>
                  <?php foreach ($fichas as $ficha): ?>
                    <tr >
                      <td><?= $ficha["Referencia"]?></td>
                    <td><input type="text"  name="CantidadO" id="CantidadO<?= $ficha["Referencia"]?>" class="form-control" value=""></td>
                      <td>
                       <button id="btn<?= $i; ?>" type="button" class="btn btn-box-tool" onclick="asociarFichas('<?= $ficha["Referencia"] ?>', this)"><i class="fa fa-plus"></i></button>
                      </td>
                      <td style="display: none" id="ICantidad"></td>
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
              <button type="button" class="btn btn-primary" data-dismiss="modal"><b>Aceptar</b></button>
            </div>
          </div><!-- /.modal-content -->
          </form>
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
