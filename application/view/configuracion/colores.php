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

          <div class="box box-primary" style="height: 350px;">
              <div class="box-header with-border" style="text-align: center;"> 
                     <h4 class="control-label"><strong>REGISTRAR COLOR</strong></h4>
              </div>
            <form data-parsley-validate="" action="<?= URL.'ctrConfiguracion/registrarColor'?>" method="POST">
                <div class="box-body">
                   <div class="form-group">
                     <h4>Código: </h4>
                      
                      <div class="input-group my-colorpicker2 colorpicker-element">
                          <input type="text" name="codigo" class="form-control" readonly="" value="#0000ff">
                          <div  class="input-group-addon">
                            <i id="colDatapicker" type="input"></i>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                     <h4>Nombre: </h4>
                    <input type="text" name="nombre" class="form-control" data-parsley-required="">
                  </div>
              </div>
              <div class="box-footer" style="margin-top: 20px;">
                  <button type="reset" onclick="resetCol();" class="btn btn-danger pull-right"  style="margin-left: 2%;"><i class="fa fa-times-circle" aria-hidden="true"></i>  Cancelar</button>
                  <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o" aria-hidden="true"></i>  Guardar</button>   
              </div> 
            </form>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="box box-primary">
              <div class="box-header with-border" style="text-align: center;"> 
                   <h4 class="control-label"><strong>LISTAR COLORES</strong></h4>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <table class="table table-bordered paginate-search-table">
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
                        <tr class="box box-solid collapsed-box">
                          <td><?= $cont += 1; ?></td>
                          <td> <i class="fa fa-square" style="color:<?= $valor["Codigo_Color"]; ?>; font-size: 200%;"></i></td>
                          <td><?= $valor["Codigo_Color"]; ?></td>
                          <td><?= $valor["Nombre"]; ?></td>
                          <td style="display: none; "><?= $valor["Id_Color"]; ?></td>
                          <td style="text-align: center;">
                             <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#modalEditColor" onclick="editarColor('<?= $valor["Codigo_Color"]; ?>', this)"><i style="font-size: 150%;" class="fa fa-pencil-square-o"></i></button> 
                          </td>
                          <td style="text-align: center;">
                            <button type="button" onclick="confirmacionColor(this, <?= $valor['Id_Color']; ?>, false);" class="btn btn-box-tool"><i style="font-size: 150%;" class="fa fa-times"></i></button>
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
          <div class="modal-dialog modal-md" role="document"; border-radius: 25px;">
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
                  <button type="button" class="btn btn-danger pull-right" data-dismiss="modal" style="margin-left: 2%;"><i class="fa fa-times-circle" aria-hidden="true"></i> Cancelar</button>
                  <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o" aria-hidden="true"></i>  Guardar</button>          
              </div> 
            </form> 
          </div>
        </div>
    </div>









<div class="modal fade" id="modalCrudColores" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document";>
    <div class="modal-content" style="border-radius: 25px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h3 style="font-weight: bold; text-align: center;" class="modal-title">Colores</h3>
      </div>
      <div class="modal-body">
        <div style="margin-top: 10px;" class="row">
          <div class="form-group col-sm-12">
          <div class="col-sm-5">  
            <div class="input-group my-colorpicker2 colorpicker-element">
            <input id="codigoColorCrud" type="text" name="codigo" class="form-control" readonly="" value="#0000ff">
                <div class="input-group-addon">
                  <i type="input" id="colColCrudBox" style="background-color: blue;"></i>
                </div>
            </div>
          </div>
          <div class="col-sm-5">
              <input id="nomColorCrud" type="text" name="nombre" placeholder="Nombre del color" class="form-control" data-parsley-required=""> 
          </div> 
            <div class="col-sm-2">
              <button onclick="regColor()" type="submit" class="btn btn-primary">Registrar</button>
            </div> 
          </div>
        </div>
        <div class="row">
          <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Muestra</th>
                    <th>Código</th>
                    <th>Color</th>
                    <th style="text-align: center;">Modificar</th>
                    <th>Eliminar</th>
                    <th>Guardar</th>  
                  </tr>
                </thead>
                <tbody id="tbody-CrudColores">
                </tbody>
              </table>
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



