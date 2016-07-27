  <!-- Contenedor pricipal  -->
  <div class="content-wrapper">
    <section class="content-header">
      <br>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li><a href="#">Bodega</a></li>
        <li class="active">Existencias insumos</li>
      </ol>
    </section>

    <section class="content">
      <div class="box box-info">
        <div class="box-header with-border"  style="text-align: center;">
          <h3 class="box-title"><strong>EXISTENCIAS INSUMOS</strong></h3>
        </div>


<!--         <div class="row box-header">
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
        </div> -->
    

      <form class="form-horizontal">
         <div class="col-md-12">
           <div class="box">
            <div class="box-body no-padding">
              <div class="table-responsive">
              <table table-responsive class="table" id="example1">
                <thead>
                  <tr class="active">
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Color</th>
                    <th>Medida</th>
                    <th>Cantidad</th>
                    <th>Valor promedio</th>
                    <th>Stock mínimo</th>
                    <th style="width: 7%">Opción</th>
                  </tr>
                </thead>
                <tbody>
                   <tr>
                    <td> 
                      004
                    </td>
                    <td> 
                       Blonda
                    </td>
                    <td>
                        Amarillo
                    </td>
                    <td>
                        Centimetros
                    </td>
                    <td>
                        200
                    </td>
                    <td>
                        150
                    </td>
                    <td>
                       <span class="badge bg-red"> 50 </span>
                    </td>
                    <td>
                      <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#ModelEntrada"><i class="fa fa-arrow-left"></i></button>
                      <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#ModelSalida"><i class="fa fa-arrow-right"></i></button>
                    </td>
                  </tr>
              </tbody></table>
             </div>
            </div>
          </div>
        </div>
       
      <div class="box-footer">
        <div class="col-md-4">
           <button class="btn btn-primary">Generar reporte</button>
        </div>
<!--        <div class="col-md-8">
            <div class="box-tools">
                <ul class="pagination pagination-sm no-margin pull-right">
                  <li class="disabled"><a href="#">«</a></li>
                  <li class="active"><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">»</a></li>
                </ul>
            </div>
        </div> -->
      </div>
     </form>  
    </div> 
    </section> 
</div>

       <div class="modal fade" id="ModelEntrada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document" style="border-radius: 25px;">
            <div class="modal-content" style="border-radius: 20px;">
              <div class="modal-header">
                <h4 class="control-label" style="text-align: center;"><strong>ENTRADA INSUMO</strong></h4>
              </div>
              <div class="modal-body">

                <div class="form-horizontal"> 
                    <div class="form-group">
                     <h4 class="col-md-3">Código: </h4>
                       <div class="col-md-9">
                          <input type="text" value="001" class="form-control" disabled="true"> 
                       </div> 
                    </div>
                    <div class="form-group">
                       <h4 class="col-md-3">Nombre: </h4>
                       <div class="col-md-9">
                       <input type="text" class="form-control" value="Hilo" disabled="true">
                    </div>
                   </div>


                    <div class="form-group">
                       <h4 class="col-md-3">Color: </h4>
                       <div class="col-md-9">
                       <input type="text" class="form-control" value="Rojo" disabled="true">
                    </div>
                   </div>

                   <div class="form-group">
                       <h4 class="col-md-3">Medida: </h4>
                       <div class="col-md-9">
                       <input type="text" class="form-control" value="Decenas" disabled="true">
                    </div>
                   </div>


                    <div class="form-group">
                     <h4 class="col-md-3">Cantidad: </h4>
                       <div class="col-md-9">
                          <input type="number" class="form-control"  min="0"> 
                       </div> 
                    </div>
                    <div class="form-group">
                       <h4 class="col-md-3">Valor: </h4>
                       <div class="col-md-9">
                       <input type="money" class="form-control">
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




        <div class="modal fade" id="ModelSalida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document" style="border-radius: 25px;">
            <div class="modal-content" style="border-radius: 20px;">
              <div class="modal-header">
                <h4 class="control-label" style="text-align: center;"><strong>SALIDA INSUMO</strong></h4>
              </div>
              <div class="modal-body">

                <div class="form-horizontal"> 
                    <div class="form-group">
                     <h4 class="col-md-3">Código: </h4>
                       <div class="col-md-9">
                          <input type="text" value="001" class="form-control" disabled="true"> 
                       </div> 
                    </div>
                    <div class="form-group">
                       <h4 class="col-md-3">Nombre: </h4>
                       <div class="col-md-9">
                       <input type="text" class="form-control" value="Hilo" disabled="true">
                    </div>
                   </div>


                    <div class="form-group">
                       <h4 class="col-md-3">Color: </h4>
                       <div class="col-md-9">
                       <input type="text" class="form-control" value="Rojo" disabled="true">
                    </div>
                   </div>

                   <div class="form-group">
                       <h4 class="col-md-3">Medida: </h4>
                       <div class="col-md-9">
                       <input type="text" class="form-control" value="Decenas" disabled="true">
                    </div>
                   </div>


                    <div class="form-group">
                     <h4 class="col-md-3">Cantidad: </h4>
                       <div class="col-md-9">
                          <input type="number" class="form-control"  min="0" max="3"> 
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