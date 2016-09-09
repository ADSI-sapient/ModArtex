   <section class="content-header">
    <br>
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
        <h3 class="box-title"><strong>LISTAR OBJETIVOS</strong></h3>
      </div>
      <div id="users">
        <form class="form-horizontal">
          <div class="col-md-12">
            <!-- <div class="box"> -->
            <br>
              <div class="table table-responsive">
                <table class="table table-hover" id="TablaObjetivos">
                  <thead>
                    <tr class="info"> 
                      <th></th>
                      <th>Fecha de registro</th>
                      <th>Nombre</th>
                      <th>Fecha inicio</th>
                      <th>Fecha fin</th>
                      <th>Total</th>
                      <th>Estado</th>
                      <th style="display: none">Id_Estado</th>
                      <th style="width: 10%">Opción</th>
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
                    <td><?= $objetivo["Nombre_Estado"]?></td>
                    <td style="display: none"><?= $objetivo["Id_Estado"]?></td>
                   <!--  <td class="Estado"><?= $objetivo["Estado"]==5?"Habilitado":"Inhabilitado" ?></td> -->
                      <td>                           
                   
                         <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#ListarF" onclick=" listarO('<?= $objetivo["Id_Objetivo"] ?>', this)"><i class="fa fa-eye fa-lg" style="color:#3B73FF"></i></button>

                        <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#ModificarObj"onclick="ModificarObj('<?= $objetivo["Id_Objetivo"] ?>', '<?= $objetivo["FechaRegistro"] ?>', '<?= $objetivo["FechaInicio"] ?>', '<?= $objetivo["Nombre"] ?>', '<?= $objetivo["FechaFin"] ?>',    this, 1)"><i class="fa fa-pencil-square-o fa-lg"></i></button>

                         <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#Estadisticas" ><i class="fa fa-signal fa-lg" style="color:#3B73FF"></i></button>
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
      </div>

          </div>
        </div>
      </div>
  </section>


<!--Modal para listar las fichas -->
 <div class="modal fade" id="ListarF" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <form role="form" id="ListarF"  method="post">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="border-radius: 25px;">
       <div class="modal-header with-border" style="text-align: center;"> 
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   <h4 class="control-label"><strong>Referencias</strong></h4>
              </div>
         
     <div class="box-body  ">
            <!-- /.box-header -->
            <table class="table table-hover col-lg-12" id="tablaFiO">
            <thead>
              <tr class="info">
                <th class="col-lg-2">Id</th>
                <th class="col-lg-4">Referencia</th>
                <th class="col-lg-4">Cantidad</th>
              </tr>
            </thead>
            <tbody id="FichasO">
            </tbody>
         </table>

      </div>
    </div>
  </div>
  </form>
</div>
<!--Final del modal -->


<!--Modal Para modificar  el objetivo-->
 <div class="modal fade" id="ModificarObj" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <form role="form" id="ModificarObj"  method="post">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="border-radius: 25px;">
       <div class="modal-header with-border" style="text-align: center;"> 
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="control-label"><strong>Modificar Objetivo</strong></h4>
              </div>

              <input type="hidden" name="Id_Objetivo" id="Id_Objetivo">

              <input type="hidden" name="Id_Estado" id="Id_Estado">
            <div class="form-group col-lg-6">
              <label class="">Fecha registro:</label>
              <input type="text" id="Fecha_Registro" name="FechaRegistro" readonly="" class="form-control">
            </div>
        
            <div class="  col-lg-6"> 
              <div class="form-group">
                <label class="control-label" style="padding-right: 10px;">Fecha inicio:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="Fecha_Inicio" name="FechaInicio" required="">

                  <!--   <input type="text" class="form-control pull-right" name="Fecha_Inicio" required="" id="Fecha_Inicio" style="border-radius:5px;"> -->
                </div>
              </div>
            </div>
     

           <div class="form-group col-lg-6">
              <label class="">Nombre:</label>
              <input  type="text" name="Nombre" id="Nombre" class="form-control" required="">
            </div>

             <div class=" col-lg-6"> 
              <div class="form-group">
                <label class="control-label" style="padding-right: 10px;">Fecha fin:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="Fecha_Fin" name="FechaFin" required="">
                </div>
              </div>
            </div>
        <div class="row col-lg-12">
          <div class="box-header col-lg-3">
              <h3 class="box-title"><strong>Referencias</strong></h3>
          </div>

         <button type="button" class="btn btn-primary  col-lg-offset-6 col-lg-3 "  data-toggle="modal" data-target="#FichasN" onclick="listarON('<?= $objetivo["Id_Objetivo"]?>',this)">Agregar Fichas</button>
      </div>
      
     <div class="box-body ">
       
            <!-- /.box-header -->
            <table class="table table-hover col-lg-12" id="tablaFiOM">
            <thead>
              <tr class="info">
                <th class="col-lg-2">Id</th>
                <th class="col-lg-4">Referencia</th>
                <th class="col-lg-4">Cantidad</th>
                <th class="col-lg-2">Quitar</th>
              </tr>
            </thead>
            <tbody id="FichasOM">
            </tbody>
         </table>

      </div>
      <br>
        <div class="row col-lg-12">
          <div class="form-group col-lg-5">
            <label>Total:</label>
            <input type="text" name="CantidadTotalN" id="TotalTN" class="form-control" value="0" >
          </div>
        </div>

         <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="btnModificarObj">Guardar</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
    </div>
  </div>
  </form>
</div>

<!--Final del modal-->


<!--Modal de estadisticas-->
  <div class="modal fade" id="Estadisticas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document" style="width: 70%; border-radius: 25px;">
            <div class="modal-content" style="border-radius: 20px;">
              <div class="modal-header" style="text-align: center;">
                    <h3 class="box-title"><strong>Avance vs Objetivo</strong></h3>
              </div>
              <div class="modal-body">
                <div class="box box-success">
                  
                    <div class="box-body">
                      <div class="chart">
                        <canvas id="barChart" style="height: 230px; width: 510px;" width="510" height="230"></canvas>
                      </div>
                    </div>
                </div>
             </div>
        </div>
       </div>
  </div>
<!--Final del modal-->

<!--Modal para agregar nuevas fichas-->
  <div class="modal fade" id="FichasN" tabindex="-1" role="dialog" >
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
                      <th>Cantidad actual</th>
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
                      <td><?= $ficha["Cantidad"]?></td>
                      <td>
                       <button id="btn<?= $i; ?>" type="button" class="btn btn-box-tool" onclick="asociarFichasNuevas('<?= $ficha["Id_Ficha_Tecnica"] ?>','<?= $ficha["Referencia"] ?>',  this)"><i class="fa fa-plus"></i></button>
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


