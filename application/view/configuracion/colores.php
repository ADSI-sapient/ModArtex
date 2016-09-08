    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li><a href="#">Configuración</a></li>
        <li class="active">Colores</li>
      </ol>
    </section>
    <section class="content">
     <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border" style="text-align: center;"> 
              <h4 class="control-label"><strong>REGISTRAR COLOR</strong></h4>
            </div>
            <div class="box-body">
              <form action="<?= URL.'ctrConfiguracion/registrarColor'?>" method="POST" data-parsley-validate="">
                  <div class="col-md-12">
                    <div class="form-group">
                      <h4>Código: </h4>
                        <div class="input-group my-colorpicker2 colorpicker-element">
                          <input type="text" name="codigo" class="form-control" readonly="" value="#0000ff">
                          <div class="input-group-addon">
                            <i type="input"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                       <h4>Nombre: </h4>
                      <input type="text" name="nombre" class="form-control" data-parsley-required="">
                    </div>
                  </div>
              <div class="box-footer">
                  <button type="reset" onclick="alerta();" class="btn btn-danger pull-right"  style="margin-left: 2%;">Limpiar</button>
                  <button type="submit" class="btn btn-primary pull-right">Guardar</button>
              </div> 
            </form>
            </div>
          </div>
        </div>
        <div class="col-xs-6">
          <div class="box box-primary">
              <div class="box-header with-border" style="text-align: center;"> 
                   <h4 class="control-label"><strong>LISTAR COLORES</strong></h4>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr class="active">
                      <th style="width: 10%"></th>
                      <th>Código</th>
                      <th>Muestra</th>
                      <th>Nombre</th>
                      <th style="display:none;"></th>
                      <th style="width: 15%">Opción</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php $cont = 0?>
                      <?php foreach ($lista as $valor): ?>
                        <tr class="box box-solid collapsed-box">
                          <td><?= $cont += 1; ?></td>
                          <td><?= $valor["Codigo_Color"]; ?></td>
                          <td> <i class="fa fa-square" style="color:<?= $valor["Codigo_Color"]; ?>; font-size: 200%;"></i></td>
                          <td><?= $valor["Nombre"]; ?></td>
                          <td style="display: none; "><?= $valor["Id_Color"]; ?></td>
                          <td>
                             <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#modalEditColor" onclick="editarColor('<?= $valor["Codigo_Color"]; ?>', this)"><i class="fa fa-pencil-square-o"></i></button> 

                            <button type="button" onclick="confirmacionColor(<?= $valor['Id_Color']; ?>)" class="btn btn-box-tool"><i class="fa fa-times"></i></button>
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
    <div class="modal fade" id="modalEditColor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document"; border-radius: 25px;">
            <div class="modal-content" style="border-radius: 20px;">
              <div class="box-header with-border" style="text-align: center;"> 
                   <h4 class="control-label"><strong>MODIFICAR COLOR</strong></h4>
              </div>
              <form action="<?= URL.'ctrConfiguracion/modificarColor'; ?>" method="POST">
                <div class="modal-body">

                  <div class="form-horizontal"> 
                      <input id="id" name="id" style="display: none;">
                      <div class="form-group"> 
                       <h4 class="col-md-3">Código: </h4>
                         <div class="col-md-9">
                          <div class="input-group my-colorpicker2 colorpicker-element">
                            <input type="text" class="form-control" name="codigo" id="codigo" readonly="">
                            <div class="input-group-addon">
                              <i id="i"></i>
                            </div>
                          </div>
                         </div> 
                      </div>
                      <div class="form-group">
                         <h4 class="col-md-3">Nombre: </h4>
                         <div class="col-md-9">
                         <input type="text" class="form-control" id="inputNom" name="nombre" required="">
                       </div>
                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger pull-right" data-dismiss="modal" style="margin-left: 2%;">Cancelar</button>
                  <button type="submit" class="btn btn-primary pull-right">Guardar</button>
              </div> 
            </form> 
          </div>
        </div>
    </div>









<div class="modal fade" id="modalCrudColores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document";>
    <div class="modal-content" style="border-radius: 25px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h3 style="font-weight: bold; text-align: center;" class="modal-title">Colores</h3>
      </div>
      <div class="modal-body">
        <div class="row col-sm-12">
          <div class="form-group col-sm-12">
          <div class="col-sm-5">  
            <div class="input-group my-colorpicker2 colorpicker-element">
            <input type="text" name="codigo" class="form-control" readonly="" value="#0000ff">
                <div class="input-group-addon">
                  <i type="input" style="background-color: rgb(0, 0, 255);"></i>
                </div>
            </div>
          </div>
          <div class="col-sm-5">
              <input type="text" name="nombre" class="form-control" required=""> 
          </div> 
            <div class="col-sm-2">
              <button onclick="registrarProfesion()" class="btn btn-primary">Registrar</button>
            </div> 
          </div>
        </div> 
        <div class="row col-sm-12" style="margin-right: 0; padding-left: 8%">
        <div class="box box-primary">
        <div class="box-body">
          <div class="dataTable_wrapper table-responsive">
              <table width="100%" class="table table-striped table-hover example2">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Código</th>
                    <th>Muestra</th>
                    <th>Color</th>
                    <th style="text-align: center;">Modificar</th>
                    <th>Eliminar</th>
                    <th>Guardar</th>  
                  </tr>
                </thead>
                <tbody>
                   <?php $cont = 0?>
                      <?php foreach ($lista as $valor): ?>
                        <tr class="box box-solid collapsed-box">
                          <td><?= $cont += 1; ?></td>
                          <td><?= $valor["Codigo_Color"]; ?></td>
                          <td> <i class="fa fa-square" style="color:<?= $valor["Codigo_Color"]; ?>; font-size: 200%;"></i></td>
                          <td><?= $valor["Nombre"]; ?></td>
                          <td style="display: none; "><?= $valor["Id_Color"]; ?></td>
                          <td>
                            <button id="btnEditProf1" class="btn btn-box-tool">
                              <i style="font-size: 150%; color: green;" class="fa fa-pencil-square-o" arial-hidden="true"></i>
                            </button>
                          </td>
                          <td style="text-align: center;">
                            <button data-dismiss="alert" class="btn btn-box-tool">
                              <i style="font-size: 150%; color: red;" class="fa fa-times" arial-hidden="true"></i>
                            </button>
                          </td>
                          <td style="text-align: center;">
                            <button disabled="true" type="button" class="btn btn-box-tool">
                              <i class="font-size: 150%; fa fa-check" arial-hidden="true"></i>
                            </button>
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
    <div>
      <div class="modal-footer" style="border-top:none; border-bottom:1px solid;">
      </div>
    </div>
  </div>
</div>
</div>



