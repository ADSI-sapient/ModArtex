    <section class="content-header">
      <br>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li><a href="#">Existencias producto T</a></li>
      </ol>
    </section>

    <section class="content">
      <div class="box box-info">
        <div class="box-header with-border"  style="text-align: center;">
          <h3 class="box-title"><strong>EXISTENCIAS PRODUCTO TERMINADO</strong></h3>
        </div>


        <div class="row box-header">
          <div class="col-md-8"></div>
             <div class="col-md-4">
                <div class="form-group">
                        <div class="box-tools pull-right">   
                          <form action="#" method="get" class="form-horizontal">
                            <div class="input-group">
                              <input type="text" class="form-control" placeholder="Buscar">
                                  <span class="input-group-btn">
                                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                    </button>
                                  </span>
                            </div>
                          </form> 
                       </div>
                </div>
              </div>
        </div>

      <form class="form-horizontal">
         
      
         <div class="col-md-12">
           <div class="box">
            <div class="box-header">
              <h3 class="box-title"><strong>Existencias</strong></h3>

            </div>
            <!-- /.box-header -->
          
            <div class="box-body no-padding">
              <div class="table-responsive">
              <table class="table">
                <tbody>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Referencia</th>
                  <th>Nombre</th>
                  <th>Color</th>
                  <th>Talla</th>
                  <th>Cantidad</th>
                  <th>Valor producción</th>
                  <th style="width: 10%">Stock mínimo</th>
                  <th style="width: 5%">Salida</th>
                </tr>
                <tr>
                  <td>1.</td>
                  <td> 
                    201
                  </td>
                  <td> 
                    Brasilera
                  </td>
                  <td>
                    Verde-rojo
                  </td>
                  <td>
                      S
                  </td>
                  <td>
                      25
                  </td>
                  <td>
                      5400
                  </td>
                  <td>
                      <span class="badge bg-red"> 10 </span>
                  </td>
                  <td>
                    <button type="button" class="btn btn-box-tool"><i class="fa fa-arrow-right" data-toggle="modal" data-target="#ModelSalida"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>2.</td>
                  <td> 
                    202
                  </td>
                  <td> 
                     Panty niña
                  </td>
                  <td>
                    Verde-negro
                  </td>
                  <td>
                      S
                  </td>
                  <td>
                      40
                  </td>
                  <td>
                      3500
                  </td>
                  <td>
                      <span class="badge bg-red"> 15 </span>
                  </td>
                  <td>
                    <button type="button" class="btn btn-box-tool"><i class="fa fa-arrow-right" data-toggle="modal" data-target="#ModelSalida"></i></button>
                  </td>

                </tr>
                 <tr>
                  <td>3.</td>
                  <td> 
                    202
                  </td>
                  <td> 
                     Panty
                  </td>
                  <td>
                    Verde-negro
                  </td>
                  <td>
                      L
                  </td>
                  <td>
                      20
                  </td>
                  <td>
                      3500
                  </td>
                  <td>
                      <span class="badge bg-red"> 15 </span>
                  </td>
                  <td>
                    <button type="button" class="btn btn-box-tool"><i class="fa fa-arrow-right" data-toggle="modal" data-target="#ModelSalida"></i></button>
                  </td>
                </tr>
              </tbody></table>
            </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      <!--Termina tabla colores seleccionados-->
       
      <div class="box-footer">
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
     </form>  
    </div> 
    </section> 








<div class="modal fade" id="ModelSalida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document" style="width: 30%; border-radius: 25px;">
            <div class="modal-content" style="border-radius: 20px;">
              <div class="modal-header">
                <h4 class="control-label" style="text-align: center;"><strong>SALIDA PRODUCTO TERMINADO</strong></h4>
              </div>
              <div class="modal-body">

                <div class="form-horizontal"> 
                    <div class="form-group">
                     <h4 class="col-md-3">Referencia: </h4>
                       <div class="col-md-9">
                          <input type="text" value="201" class="form-control" disabled="true"> 
                       </div> 
                    </div>
                    <div class="form-group">
                       <h4 class="col-md-3">Nombre: </h4>
                       <div class="col-md-9">
                       <input type="text" class="form-control" value="Brasilera" disabled="true">
                    </div>
                   </div>


                    <div class="form-group">
                       <h4 class="col-md-3">Color: </h4>
                       <div class="col-md-9">
                       <input type="text" class="form-control" value="Verde-rojo" disabled="true">
                    </div>
                   </div>

                   <div class="form-group">
                       <h4 class="col-md-3">Talla: </h4>
                       <div class="col-md-9">
                       <input type="text" class="form-control" value="S" disabled="true">
                    </div>
                   </div>


                    <div class="form-group">
                     <h4 class="col-md-3">Cantidad: </h4>
                       <div class="col-md-9">
                          <input type="text" class="form-control" value="25" disabled="true">
                       </div> 
                    </div>



                    <div class="form-group">
                     <h4 class="col-md-3">Salida: </h4>
                       <div class="col-md-9">
                           <input type="number" class="form-control"  min="0" max="15"> 
                       </div> 
                    </div>



                    <div class="form-group">
                     <h4 class="col-md-3">Descripción: </h4>
                       <div class="col-md-9">
                          <textarea rows="4" cols="50" class="form-control">
                         </textarea> 
                       </div> 
                    </div>
               

                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" onclick="botonCancelar()" class="btn btn-danger pull-right" style="margin-left: 2%;">Cancelar</button>
                <button type="submit" onclick="botonRegistrar()" class="btn btn-primary pull-right">Registrar</button>
                
            </div> 
            </div> 
         </div>
       </div>