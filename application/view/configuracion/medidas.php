     <section class="content-header">
          <br>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
            <li><a href="#">Configuración</a></li>
            <li class="active">Unidades de medida</li>
          </ol>
      </section>

      <section class="content">

       <div class="row">
          <div class="col-md-6">
            <div class="box box-primary">
              <div class="box-header with-border" style="text-align: center;">
                   <h4 class="control-label"><strong>REGISTRAR UNIDAD DE MEDIDA</strong></h4>
              </div>

              <form action="<?= URL.'ctrConfiguracion/registrarMedida'; ?>" method="POST">
                <div class="box-body">
                  <div class="col-md-6">
                    <div class="form-group">
                       <h4>Nombre: </h4>                
                       <input type="text" class="form-control" name="nombre" required="">
                    </div>
                  </div> 
                  <div class="col-md-6">
                    <div class="form-group">
                       <h4>Abreviatura: </h4>
                         <input type="text" class="form-control" name="Abr" required="">
                    </div>
                  </div>
                </div>
                <div class="box-footer">
                  <button type="reset" class="btn btn-danger pull-right"  style="margin-left: 2%;">Cancelar</button>
                  <button type="submit" class="btn btn-primary pull-right">Guardar</button>
                </div> 
              </form>
            </div>
          </div>





        <div class="col-md-6">
          <div class="box box-warning">
              <div class="box-header with-border" style="text-align: center;"> 
                   <h4 class="control-label"><strong>LISTAR UNIDADES DE MEDIDA</strong></h4>
              </div>
       

              <div class="box-body">
                <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr class="active">
                      <th style="width: 10%"></th>
                      <th>Nombre</th>
                      <th>Abreviatura</th>
                      <th style="display:none;"></th>
                      <th style="width: 15%">Opción</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $cont = 0?>
                  <?php foreach ($lista as $valor): ?>
                    <tr class="box box-solid collapsed-box">
                      <td><?= $cont += 1; ?></td>
                      <td><?= $valor["Nombre"]; ?></td>
                      <td><?= $valor["Abreviatura"]; ?></td>
                      <td style="display: none; "><?= $valor["Id_Medida"]; ?></td>
                      <td>
                         <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#myModalMedidas" onclick="editar('<?= $valor["Id_Medida"]; ?>', this)"><i class="fa fa-pencil-square-o"></i></button>

                        <button type="button" onclick="confirmacion(<?= $valor['Id_Medida']; ?>)" class="btn btn-box-tool"><i class="fa fa-times"></i></button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody></table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


      <div class="modal fade" id="myModalMedidas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document" ; border-radius: 25px;">
            <div class="modal-content" style="border-radius: 20px;">
              <div class="modal-header with-border" style="text-align: center;"> 
                   <h4 class="control-label"><strong>MODIFICAR UNIDAD DE MEDIDA</strong></h4>
              </div>

              <form action="<?= URL.'ctrConfiguracion/modificarMedida'; ?>" method="POST">
                <div class="modal-body">
                  <div class="form-horizontal"> 
                      <input type="text" id="cod" name="cod" style="display: none; ">
                      <div class="form-group">
                         <h4 class="col-md-3">Nombre: </h4>
                         <div class="col-md-9">
                            <input type="text" class="form-control" id="nombre" name="nombre" required="">
                         </div>
                      </div>
                      <div class="form-group">
                         <h4 class="col-md-3">Abreviatura: </h4>
                         <div class="col-md-9">
                            <input type="text" class="form-control" id="abr" name="abr" required="">
                         </div>
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger pull-right" style="margin-left: 2%;" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary pull-right">Guardar</button>
                </div>
              </form> 
            </div> 
          </div> 
        </div>
