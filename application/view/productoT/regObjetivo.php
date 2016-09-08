<!-- Contenedor pricipal  -->
<div class="content-wrapper">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li><a href="#">ProductoT</a></li>
        <li class="active">Registrar objetivo</li>
      </ol>
    </section>


    <section class="content">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><strong>REGISTRAR OBJETIVO</strong></h3>
        </div>

  
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">

            <div class="col-md-6"> 
              <div class="form-group">
                  <label class="control-label">Código:</label>
                  <input type="text" class="form-control" readonly="readonly" style="width: 70%;"></input>
              </div>    
            </div>
            <div class="col-md-6">
              <div class="form-group">
                  <label class="control-label" length="80px">Fecha registro:</label>
                  <input type="date" class="form-control" min="0" readonly="readonly"></input>
               </div>
            </div>  
              <!-- /.form-group -->
                       

            <div class="col-md-12"> 
              <div class="form-group">
                <label class="control-label" style="padding-right: 10px;">*Fecha inicio:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right calendario" id="datepicker">
                </div>
              </div>
            </div>  
              <!-- /.form-group -->
          </div>
         
          <div class="col-md-6">
            <div class="col-md-12">
              <div class="form-group">
                 <label class="control-label">*Nombre:</label>
                 <input type="text" class="form-control">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label class="control-label">*Fecha fin:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right calendario" id="datepicker2">
                  </div>
              </div>
             </div>
              <!-- /.form-group -->
            </div>
          
           </div>  
        </div> <!--final box body-->
     
      
        <div class="col-md-12">
           <div class="box">
            <div class="box-header">
              <h3 class="box-title">Productos objetivos</h3>

         
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="table-responsive">
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
          </div>

            <div class="box">
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

             <div class="col-md-12" Style="margin-top: 2%; padding: 0;">
             <div class="col-sm-6"></div> 
             <div class="col-sm-6" style="padding-right: 0%;">
               <div class="form-group">
                <label class="col-sm-2 control-label" >Total</label>
                 <div class="col-sm-8">
                   <input type="text" disabled="disabled" placeholder="600" lenght="10px" style="text-align: right;"> 
                  </div>
                 <div class="col-sm-2">
                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#ModelProducto">+</button>
                 </div> 
              </div>
            </div></div>  
          </div>
            <!-- /.box-body -->

          </div>
        </div>
          
         
       
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
        <button type="submit" onclick="botonGuardar()" class="btn btn-primary pull-right">Registrar</button>
        
      </div>
    </div> 
</div>

         <div class="modal fade" id="ModelProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document" style="width: 30%; border-radius: 25px;">
            <div class="modal-content" style="border-radius: 20px;">
             
            
              <div class="modal-header" style="padding: 1%;">
                  <h4 class="box-header" style="text-align: center;"><strong>LISTAR PRODUCTOS</strong></h4>
              </div>
              
              <div class="col-md-6"></div>
              <div class="col-md-6">  
                 <form action="#" method="get" class="form-horizontal" style="margin: 6% 0 2% 0;">
                   <div class="input-group">
                     <input type="text" name="q" class="form-control" placeholder="Buscar">
                         <span class="input-group-btn">
                           <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                           </button>
                         </span>
                   </div>
                 </form>
              </div>    

              
           
              <div class="modal-body">      
               <table class="table"  responsive style="margin-bottom: 3%;">
                <tbody>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Referencia</th>
                  <th>Nombre</th>
                  <th style="width: 40px">Selección</th>
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

                    <input type="checkbox" class="minimal" name="check" style="position: absolute; opacity: 0;">

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
                      <input type="checkbox" class="minimal" name="check" style="position: absolute; opacity: 0;">
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
                      <input type="checkbox" class="minimal" name="check" style="position: absolute; opacity: 0;">
                  </td>
                </tr>


              </tbody>
            </table>
            <div class="box">
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
            </div>


                 
              <div class="row" style="margin: 3%;">
              
                 <label class="col-sm-4 control-label">Cantidad</label>
                 <div class="col-sm-8"> 
                    <input type="number" style="width: 100%" min="0">
                 </div>
      
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-danger pull-right"  style="margin-left: 2%;">Cancelar</button>
                <button type="submit" class="btn btn-primary pull-right">Seleccionar</button> 
            </div> 
            </div> 
         </div>
       </div>