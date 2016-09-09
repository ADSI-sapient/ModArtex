    <section class="content-header">
      <br>  
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
                  <div class="form-group">
                     <h4>Nombre: </h4>
                    <input type="text" name="nombre" class="form-control" data-parsley-required="">
                  </div>
              </div>
              <div class="box-footer" style="margin-top: 20px;">
                  <button type="reset" onclick="resetCol();" class="btn btn-default pull-right"  style="margin-left: 2%;"><i class="fa fa-eraser" aria-hidden="true"></i>  Limpiar</button>
                  <button type="submit" class="btn btn-success pull-right"><i class="fa fa-check-circle" aria-hidden="true"></i>  Registrar</button>   
              </div> 
            </form>
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
            <div class="modal-content">
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
                  <button type="button" class="btn btn-default pull-right" data-dismiss="modal" style="margin-left: 2%;"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
                  <button type="submit" class="btn btn-warning pull-right"><i class="fa fa-refresh" aria-hidden="true"></i>  Actualizar</button>          
              </div> 
            </form> 
          </div>
        </div>
    </div>
