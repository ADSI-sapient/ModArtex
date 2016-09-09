  <!-- Contenedor pricipal  -->
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
            <!-- /.box-header -->
          
            <div class="box-body no-padding">
              <div class="table-responsive">
              <table table-responsive class="table">
                <tbody>
                  <script type="text/javascript">
                        function botonHabilitar(){
                          alert("Insumo habilitado correctamente");
                        }
                        function botonCancelarO(){
                          confirm("¿Esta seguro que desea cancelar el objetivo?");
                        }
                     </script> 
                <tr class="active">
                  <th style="width: 10px">#</th>
                  <th>Código</th>
                  <th>Fecha registro</th>
                  <th>Nombre</th>
                  <th>Fecha inicio</th>
                  <th>Fecha fin</th>
                  <th>Total</th>
                  <th>Estado</th>
                  <th style="width: 10%">Opción</th>
                </tr>
                <tr>
                  <td>1.</td>
                  <td> 
                    001
                  </td>
                  <td> 
                     25/01/2016
                  </td>
                  <td>
                     Primer trimestre
                  </td>
                  <td>
                     01/02/2016
                  </td>
                  <td>
                     31/03/2016
                  </td>
                  <td>
                     600
                  </td>
                  <td>
                     Finalizado
                  </td>
                  <td>    
                    <button type="button" class="btn btn-box-tool"><i class="glyphicon glyphicon-search"></i></button>                 
                  </td>
                </tr>

                  
                  <tr>
                  <td>2.</td>
                  <td> 
                    002
                  </td>
                  <td> 
                     25/03/2016
                  </td>
                  <td>
                     Segundo trimestre
                  </td>
                  <td>
                     01/04/2016
                  </td>
                  <td>
                     30/06/2016
                  </td>
                  <td>
                     900
                  </td>
                  <td>
                     En proceso
                  </td>
                  <td>    
                   <button type="button" class="btn btn-box-tool"><i class="fa fa-pencil-square-o" data-toggle="modal" data-target="#ModelEditarObjetivo"></i></button>
                    <button type="button"  onclick="botonCancelarO()" class="btn btn-box-tool" ><i class="glyphicon glyphicon-ban-circle"></i></button>
                    <button type="button" class="btn btn-box-tool open-modal-estadistica"><i class="fa fa-line-chart" data-target="#ModelEstadistica"></i></button>
                    
                  </td>
                </tr>
                
               <tr>
                  <td>3.</td>
                  <td> 
                    003
                  </td>
                  <td> 
                     25/01/2016
                  </td>
                  <td>
                     Semana vacacional
                  </td>
                  <td>
                     15/06/2016
                  </td>
                  <td>
                     10/07/2016
                  </td>
                  <td>
                     400
                  </td>
                   <td>
                      Pendiente
                  </td>
                  <td>
                    <button type="button" class="btn btn-box-tool"><i class="fa fa-pencil-square-o" data-toggle="modal" data-target="#ModelEditarObjetivo"></i></button>
                    <button type="button" onclick="botonCancelarO()" class="btn btn-box-tool"><i class="glyphicon glyphicon-ban-circle"></i></button>

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
</div>

<div class="modal fade" id="ModelEditarObjetivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document" style="width: 70%; border-radius: 25px;">
            <div class="modal-content" style="border-radius: 20px;">
              <div class="modal-header" style="text-align: center;">
                    <h3 class="box-title"><strong>MODIFICAR OBJETIVO</strong></h3>
              </div>
              <div class="modal-body">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">

            <div class="col-md-6"> 
              <div class="form-group">
                  <label class="control-label">Código:</label>
                  <input type="text" class="form-control" readonly="readonly" value="002" style="width: 70%;"></input>
              </div>    
            </div>
            <div class="col-md-6">
              <div class="form-group">
                  <label class="control-label" length="80px">Fecha registro:</label>
                  <input type="date" class="form-control" min="0" readonly="readonly" value="25/03/2016"></input>
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
                    <input type="text" class="form-control pull-right" id="datepicker" value="01/04/2016">
                </div>
              </div>
            </div>  
              <!-- /.form-group -->
          </div>
     
          <div class="col-md-6">
              <div class="form-group">
                 <label class="control-label">*Nombre:</label>
                 <input type="text" class="form-control" value="Segundo trimestre">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label class="control-label">*Fecha fin:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker" value="30/06/2016">
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
                      
               <table class="table" style="margin-bottom: 3%;">
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
                <button type="submit" class="btn btn-danger pull-right" style="margin-left: 2%;">Cancelar</button>
                <button type="submit" class="btn btn-primary pull-right">Aceptar</button> 
            </div> 
            </div> 
         </div>
  </div>

  <div class="modal fade" id="ModelEstadistica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document" style="width: 70%; border-radius: 25px;">
            <div class="modal-content" style="border-radius: 20px;">
              <div class="modal-header" style="text-align: center;">
                <h3 class="box-title"><strong>Objetivos vs avances</strong></h3>
              </div>
              <div class="modal-body">
                <!-- <div class="box box-success">
                  <div class="box-header with-border">
                      <h3 class="box-title">Bar Chart</h3>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                  </div>
                    <div class="box-body">

                    </div>
                </div> -->
                      <div class="chart">
                        <canvas id="barChart" style="height: 230px; width: 510px;"></canvas>
                      </div>                
             </div>
        </div>
       </div>
  </div>

  <script type="text/javascript">
    $(function(){
      $(".open-modal-estadistica").click(function(){
        $("#ModelEstadistica").modal("show");
        mostrarGrafica();
      });
    });

    function mostrarGrafica(){

      var areaChartData = {
      labels: ["Janu", "February", "March", "April", "May", "June", "July"],
      datasets: [
        {
          label: "Electronics",
          fillColor: "rgba(210, 214, 222, 1)",
          strokeColor: "rgba(210, 214, 222, 1)",
          pointColor: "rgba(210, 214, 222, 1)",
          pointStrokeColor: "#c1c7d4",
          pointHighlightFill: "#c1c7d4",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: [65, 59, 80, 81, 56, 55, 40]
        },
        
        {
          label: "Digital Goods",
          fillColor: "rgba(60,141,188,0.9)",
          strokeColor: "rgba(60,141,188,0.8)",
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data: [28, 48, 40, 19, 86, 27, 90]
        }
      ]
    };

      var barChartCanvas = $("#barChart").get(0).getContext("2d");
      var barChart = new Chart(barChartCanvas);
      var barChartData = areaChartData;
      barChartData.datasets[1].fillColor = "#00a65a";
      barChartData.datasets[1].strokeColor = "#00a65a";
      barChartData.datasets[1].pointColor = "#00a65a";
      var barChartOptions = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero: true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines: true,
        //String - Colour of the grid lines
        scaleGridLineColor: "rgba(0,0,0,.05)",
        //Number - Width of the grid lines
        scaleGridLineWidth: 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,
        //Boolean - If there is a stroke on each bar
        barShowStroke: true,
        //Number - Pixel width of the bar stroke
        barStrokeWidth: 2,
        //Number - Spacing between each of the X value sets
        barValueSpacing: 5,
        //Number - Spacing between data sets within X values
        barDatasetSpacing: 1,
        //String - A legend template
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        //Boolean - whether to make the chart responsive
        responsive: true,
        maintainAspectRatio: true
      };
      barChartOptions.datasetFill = false;
      barChart.Bar(barChartData, barChartOptions);
      alert("okas");
    }
  </script>