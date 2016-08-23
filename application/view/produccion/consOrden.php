    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="../../starter2.html"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Producción</a></li>
        <li class="active">Consultar Orden</li>
      </ol>
    </section>

    <!-- Main content -->

    <section class="content">
      <br>
      <div class="box box-info">
        <div class="box-header with-border">
          <div class="box-header with-border"  style="text-align: center;">
            <h3 class="box-title"><strong>LISTAR ÓRDENES</strong></h3>
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
        </div>

        <form class="form-horizontal">
         
          
         <div class="col-md-12">
           <div class="box">
            <!-- /.box-header -->
            <div class="table table-responsive">
              <table class="table table-hover">
                <tbody>
                 <script type="text/javascript">
                  function botonCancelarO(){
                    confirm("¿Esta seguro que desea cancelar el objetivo?");
                  }
                </script>
                <tr class="info">
                  <th>Código</th>
                  <th>Fecha Registro</th>
                  <th>Fecha Terminación</th>
                  <th>Estado</th>
                  <th>Lugar</th>
                  <th style="width: 10%">Opcion</th>
                </tr>
                <tr>
                  <td>20</td>
                  <td>20/04/2016</td>
                  <td>24/05/2016</td>
                  <td>Producción</td>
                  <td>Fábrica</td>
                  <td>
                    <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#myModal3"><i class="fa fa-pencil-square-o"></i></button>
                    <button type="button"  onclick="botonCancelarO()" class="btn btn-box-tool" ><i class="glyphicon glyphicon-ban-circle"></i></button>
                    <button type="button" class="btn btn-box-tool"><i class="fa fa-file-pdf-o"></i></button>
                  </td>
                  
                </tr>
                <tr>
                  <td>13</td>
                  <td>22/04/2016</td>
                  <td>28/05/2016</td>
                  <td>Calidad</td>
                  <td>Fábrica</td>
                  <td> 
                    <button type="button" class="btn btn-box-tool" data-widget="collapce"><i class="fa fa-pencil-square-o"></i></button>
                    <button type="button"  onclick="botonCancelarO()" class="btn btn-box-tool" ><i class="glyphicon glyphicon-ban-circle"></i></button>
                    <button type="button" class="btn btn-box-tool"><i class="fa fa-file-pdf-o"></i></button>
                  </td>
                </tr>

                <tr>
                  <td>12</td>
                  <td>20/04/2016</td>
                  <td>21/05/2016</td>
                  <td>Calidad</td>
                  <td>Fábrica</td>
                  <td>
                   <button type="button" class="btn btn-box-tool"><i class="fa fa-pencil-square-o"></i></button>
                   <button type="button"  onclick="botonCancelarO()" class="btn btn-box-tool" ><i class="glyphicon glyphicon-ban-circle"></i></button>
                   <button type="button" class="btn btn-box-tool"><i class="fa fa-file-pdf-o"></i></button>
                 </td>
                 

               </tr>

             </tbody></table>
           </div>
           <!-- /.box-body -->
         </div>
       </div>
     </form>
     
     
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
      <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 25px;">
            <div class="modal-header" style="text-align: center;">
              <h3 class="box-title"><strong>MODIFICAR ORDEN</strong></h3>
            </div>
            <div class="modal-body">
              <form class="" role="form">
                <div class="box box-info">
                  
                  <form class="form-horizontal" role="form">
                    <div class="box-body">
                      <div class="form-group col-lg-3">
                        <label for="Numero_de_orden" class="">Código </label>
                        <input type="text" class="form-control" id="Numero_de_orden" placeholder="" value="20" disabled>
                      </div>
                      <div class="form-group col-lg-offset-4 col-lg-5">
                        <label class="">Fecha Registro</label>
                        <div class="">
                          <div class="input-group date" >
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="datepicker" value="20/04/2016" disabled="">
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-lg-5">
                        <label class="">Fecha de Terminación</label>
                        <div class="">
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="datepicker" value="24/05/2016" disabled="">
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-lg-offset-2 col-lg-5">
                        <label for="aso_cotizacion">Asociar Pedido
                        </label>
                        <form action="#" method="get" class="form-horizontal">
                          <div class="input-group">
                            <input type="text" name="q" class="form-control" disabled="" />
                            <span class="input-group-btn">
                              <button type="button" id="search-btn" class="btn btn-flat"><i class="fa fa-search" data-toggle="modal" data-target="#myModalhbjn"></i>
                              </button>
                            </span>
                          </div>
                        </form>
                      </div>
                      <div class="form-group col-lg-5">
                        <label for="estado" class="">Estado</label>
                        <select class="form-control" disabled="">
                          <option value="opcion1" >Producción</option>
                          <option value="opcion2">Cálidad</option>
                          <option value="opcion3">Terminado </option>
                        </select>
                      </div>
                      <div class="form-group col-lg-offset-2  col-lg-5">
                        <label for="lugar" class="" >Lugar</label>
                        <select class="form-control " disabled="">
                          <option value="opcion1" >Fábrica</option>
                          <option value="opcion2">Satélite</option>
                        </select>
                        <br>
                      </div>

                      <div class="form-group  col-lg-5">
                        <label for="aso_cotizacion">
                          <input type="checkbox" value="" disabled="">
                          Producto terminado
                        </label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="asoci" placeholder="" disabled>
                          <span class="input-group-btn">
                            <button type="button" class="btn btn-default" type="button" data-toggle="modal" data-target="#myModaln" disabled="">Buscar</button>
                          </span>
                        </div>
                      </div>
                      <!-- /.box-header -->

                      <div class="table table-responsive">
                       <h4>Producto Terminado Seleccionado</h4>
                       <table class="table table-hover">
                        <thead>
                          <tr>
                            <th class="col-lg-2">#</th>
                            <th class="col-lg-2">Referencia</th>
                            <th class="col-lg-2">Talla</th>
                            <th class="col-lg-2">Disponible</th>
                            <th class="col-lg-2"> Cantidad </th>
                            <th style="width: 40px">Quitar</th>
                            <th><button type="button" class="btn btn-default btn-xs" type="button"><b>+</b></button></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>201</td>
                            <td>S</td>
                            <td>30</td>
                            <td>10</td>
                            <td><button type="button" class="btn btn-box-tool"><i class="fa fa-times"></i></button></td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>203</td>
                            <td>L</td>
                            <td>45</td>
                            <td>5</td>
                            <td><button type="button" class="btn btn-box-tool"><i class="fa fa-times"></i></button></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
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

                  

                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
                    <button type="button" class="btn btn-danger"  data-dismiss="modal">Cancelar</button>
                  </div>
                </div>
                
              </div>
            </form>
          </div>
        </div>
      </div>
    </section> 


    