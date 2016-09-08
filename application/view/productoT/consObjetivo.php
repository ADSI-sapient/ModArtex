    <section class="content-header">
    <br>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li><a href="#">Producto T</a></li>
        <li class="active">Listar objetivos</li>
      </ol>
    </section>

    <section class="content">
    <div class="box box-info">
        <div class="box-header with-border"  style="text-align: center;">
          <h3 class="box-title"><strong>LISTAR OBJETIVOS</strong></h3>
        </div>
     <form class="form-horizontal">
          <div class="col-md-12">
            <!-- <div class="box"> -->
            <br>
              <div class="table table-responsive">
                <table class="table table-hover" id="TablaObjetivos">
                  <thead>
                    <tr class="info"> 
                      <th></th>
                      <th>Id_Ficha Tecnica </th>
                      <th>Nombre</th>
                      <th>Fecha inicio</th>
                      <th>Fecha fin</th>
                      <th>Estado</th>
                      <th style="width: 10%">Opción</th>
                    </tr>
                  </thead>
                  <tbody class="list">
                  <?php foreach ($objetivos as $objetivo): ?>
                    <tr>
                    <td class="Id_Objetivo"><?= $objetivo["Id_Objetivo"] ?></td>
                    <td class="FechaRegistro"><?= $objetivo["FechaRegistro"] ?></td>
                    <td class="Nombre"><?= $objetivo["Nombre"] ?></td>
                    <td class="FechaInicio"><?= $objetivo["FechaInicio"] ?></td>
                    <td class="FechaFin"><?= $objetivo["FechaFin"]?></td>
                    <td><?= $objetivo["Id_Estado"]?></td>
                   <!--  <td class="Estado"><?= $objetivo["Estado"]==5?"Habilitado":"Inhabilitado" ?></td> -->
                      <td>                           
                   
                         <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#ListarF" onclick=" listarO('<?= $objetivo["Id_Objetivo"] ?>', this)"><i class="fa fa-eye fa-lg" style="color:#3B73FF"></i></button>

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
    </section>

<div class="modal fade" id="ModelEditarObjetivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document" style="width: 70%; border-radius: 25px;">
            <div class="modal-content" style="border-radius: 20px;">
              <div class="modal-header" style="text-align: center;">
                    <h3 class="box-title"><strong>MODIFICAR OBJETIVO</strong></h3>
              </div>
              <div class="modal-body">

          <div class="row col-lg-12">

            <div class="col-md-4">
                <label class="control-label" style="padding-right: 10px;">Fecha Registro:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="FechaRegistro" name="FechaRegistro" required="">
                  </div>  
              </div>
                       
            
              <div class="form-group col-md-4">
                <label class="control-label" style="padding-right: 10px;">*Fecha inicio:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                      <input type="text" class="form-control pull-right" id="FechaInicio" name="FechaInicio" required="">
                </div>
              </div> 
              <!-- /.form-group -->
     
          <div class="col-md-4">
              <div class="form-group">
                 <label class="control-label">*Nombre:</label>
                 <input type="text" class="form-control" id="FechaRegistro" name="FechaRegistro">
              </div>
            </div>
              <!-- /.form-group -->
          </div> 

            <div class="form-group col-lg-4">
                <label class="control-label">*Fecha fin:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="FechaFin" name="FechaFin" required="">
                  </div>
              </div>
              <!-- /.form-group -->
              
  <div class="col-md-12">
           <div class="box">
            <div class="box-header">
              <h3 class="box-title">Productos objetivos</h3>

              <div class="box-tools">
                <ul class="pagination pagination-sm no-margin pull-right">
                  <li class="disabled"><a href="#">«</a></li>
                  <li class="active"><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">»</a></li>
                </ul>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table" style="margin-bottom: 3%;">
                <tbody>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Referencia</th>
                  <th>Nombre</th>
                  <th>Cantidad</th>
                  <th style="width: 40px">Quitar</th>
                </tr>
                <tr class="box box-solid collapsed-box">
                  <td>1.</td>
                  <td> 
                     207 
                  </td>
                  <td> 
                     Brasilera
                  </td>
                  <td>
                     100 
                  </td>
                  <td>
                     <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </td>
                </tr>
                <tr class="box box-solid collapsed-box">
                  <td>2.</td>
                  <td> 
                      210
                  </td>
                  <td> 
                     Panty niña 
                  </td>
                  <td>
                     200
                  </td>
                    <td>
                     <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </td>
                </tr>
                <tr class="box box-solid collapsed-box">
                  <td>3.</td>
                  <td> 
                      212
                  </td>
                  <td> 
                     Panty
                  </td>
                  <td>
                     300
                  </td>
                  <td>
                     <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </td>
                </tr>


              </tbody>
            </table>
             <div class="col-sm-6"></div> 
             <div class="col-sm-6">
               <div class="form-group">
                <label class="col-sm-2 control-label" >Total</label>
                 <div class="col-sm-8">
                   <input type="text" disabled="disabled" placeholder="600" lenght="10px" style="text-align: right;"> 
                  </div>
                 <div class="col-sm-2">
                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#ModelProducto">+</button>
                 </div> 
              </div>
            </div>  
    </div>
              <!-- /.box-body -->

    </div>
  </div>
       </div>

            <div class="modal-footer">
              <div class="box-footer">
                 <script type="text/javascript">
                    function botonGuardar(){
                      alert("Registro exitoso");
                    }
                    function botonCancelar(){
                      confirm("¿Esta seguro que desea cancelar?");
                    }
                 </script>
                <button type="submit" onclick="botonCancelar()" class="btn btn-danger pull-right" style="margin-left: 2%;">Cancelar</button>
                <button type="submit" onclick="botonGuardar()" class="btn btn-primary pull-right">Guardar</button>
              </div>
            </div> 
          </div> 
        </div>
</div>

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





<!--   <div class="modal fade" id="ModelEstadistica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document" style="width: 70%; border-radius: 25px;">
            <div class="modal-content" style="border-radius: 20px;">
              <div class="modal-header" style="text-align: center;">
                    <h3 class="box-title"><strong>Objetivos vs avances</strong></h3>
              </div>
              <div class="modal-body">
                <div class="box box-success">
                    <div class="box-header with-border">
                      <h3 class="box-title">Bar Chart</h3>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
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
 -->