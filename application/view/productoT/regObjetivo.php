<!-- Contenedor pricipal  -->
<div class="content-wrapper">
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
        <form action="<?php echo URL; ?>ctrObjetivos/registrarObjetivo" method="POST">
          <div class="row col-lg-12">
            <div class="form-group col-lg-3">
              <label class="">Fecha registro:</label>
              <input type="text" name="FechaRegistro" readonly="" class="form-control" value="<?php echo date ("Y-m-d"); ?>" >
            </div>
        
            <div class=" col-lg-offset-1 col-lg-3"> 
              <div class="form-group">
                <label class="control-label" style="padding-right: 10px;">*Fecha inicio:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="Fecha_Inicio" name="FechaInicio" required="">

                  <!--   <input type="text" class="form-control pull-right" name="Fecha_Inicio" required="" id="Fecha_Inicio" style="border-radius:5px;"> -->
                </div>
              </div>
            </div>

           <div class="form-group col-lg-offset-1 col-lg-3">
              <label class="">*Nombre:</label>
              <input  type="text" name="Nombre" id="Nombre" class="form-control" required="">
            </div>
          </div>

          <div class="row col-lg-12">

            <div class="form-group col-lg-3">
              <label>Estado</label>
              <input type="text" name="estado" value="Pendiente" readonly="" class="form-control">
            </div>

            <div class=" col-lg-offset-1 col-lg-3"> 
              <div class="form-group">
                <label class="control-label" style="padding-right: 10px;">*Fecha fin:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="Fecha_Fin" name="FechaFin" required="">
                </div>
              </div>
            </div>

          <div class="col-lg-offset-1 col-lg-3">
            <button  type="button" class="btn btn-primary pull-right" data-toggle="modal" style="margin-top: 10%;" data-target="#FichasO">Seleccionar Productos</button>
          </div>
          
          <div class="form-group" id="FichasS" hidden="">
            <div class="table">
              <div class="col-lg-12 table-responsive">
                <table class="table table-hover" style="margin-top: 2%;" id="tablaFichass">
                  <thead>
                    <tr class="active">
                    <th>Id</th>
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
        <br>
      <div class="row col-lg-12">
       <div class="form-group col-lg-3">
              <label for="vlr_produccion" class="">Total:</label>
                 <input type="text" name="TotalO" id="TotalO" value="0" class="form-control" disabled="">
        </div>
      </div>

       <div class="row"> 
            <div class="form-group col-lg-12">
              <button type="submit" class="btn btn-primary col-lg-offset-9" style="margin-top: 15px;" name="btnRegObjetivo" id="btnRegObjetivo"><b>Registrar</b></button>

              <button type="reset" class="btn btn-danger" style="margin-left: 15px; margin-top: 15px;" name="btnCanFicha"><b>Limpiar</b></button>
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
                      <th>Id</th>
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
                      <td><?= $ficha["Id_Ficha_Tecnica"]?></td>
                      <td><?= $ficha["Referencia"]?></td>
                    <td><input type="text"  name="CantidadO" id="CantidadO<?= $ficha["Referencia"]?>" class="form-control" value=""></td>
                      <td>
                       <button id="btn<?= $i; ?>" type="button" class="btn btn-box-tool" onclick="asociarFichas('<?= $ficha["Id_Ficha_Tecnica"] ?>','<?= $ficha["Referencia"] ?>',  this)"><i class="fa fa-plus"></i></button>
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
