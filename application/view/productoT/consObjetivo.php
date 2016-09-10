
    <section class="content-header">
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
                      <th>Fecha de registro</th>
                      <th>Nombre</th>
                      <th>Fecha inicio</th>
                      <th>Fecha fin</th>
                      <th>Total</th>
                      <th>Estado</th>
                      <th style="display: none">Id_Estado</th>
                      <th>Referencias</th>
                      <th>Modificar</th>
                      <th>Estadistica</th>
                      <th>Cancelar objetivo</th>
                    </tr>
                  </thead>
                  <tbody class="list">
                  <?php foreach ($objetivos as $objetivo): ?>
                    <tr>
                    <td class="Id_Objetivo"><?= $objetivo["Id_Objetivo"] ?></td>
                    <td class="Fecha_Registro"><?= $objetivo["FechaRegistro"] ?></td>
                    <td class="Nombre"><?= $objetivo["Nombre"] ?></td>
                    <td class="Fecha_Inicio"><?= $objetivo["FechaInicio"] ?></td>
                    <td class="Fecha_Fin"><?= $objetivo["FechaFin"]?></td>
                    <td class="Total"><?= $objetivo["CantidadTotal"]?></td>
                    <td class="Estado"><?= $objetivo["Id_Estado"]==5? "Pendiente":"Cancelado" ?></td> 
                      <td>                           
                   
                         <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#ListarF" onclick=" listarO('<?= $objetivo["Id_Objetivo"] ?>', this)"><i class="fa fa-eye fa-lg" style="color:#3B73FF"></i></button>
                        </td>
                        <td>
                        <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#ModificarObj"onclick="ModificarObj('<?= $objetivo["Id_Objetivo"] ?>', '<?= $objetivo["FechaRegistro"] ?>', '<?= $objetivo["FechaInicio"] ?>', '<?= $objetivo["Nombre"] ?>', '<?= $objetivo["FechaFin"] ?>',    this, 1)"><i class="fa fa-pencil-square-o fa-lg"></i></button>
                        </td>
                        <td>
                         <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target='#Estadisticas'><i class="fa fa-signal open-modal-estadistica fa-lg" style="color:#3B73FF"></i></button>
                        </td>
                       <td>
                         <?php if ($objetivo["Id_Estado"] == 5){ ?>
                          <button type="button" class="btn btn-box-tool" onclick="cambiarEstadoO(<?= $objetivo['Id_Objetivo'] ?>, 5)"><i class="fa fa-minus-circle fa-lg"></i></button>
                          <?php }else{ ?>
                            <button type="button" class="btn btn-box-tool" onclick="cambiarEstadoO(<?= $objetivo['Id_Objetivo'] ?>, 8)"><i class="fa fa-check fa-lg"></i></button>
                          <?php } ?>
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
      </div>

<!--Modal para listar las fichas -->
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
<!--Final del modal -->


<!--Modal Para modificar  el objetivo-->
 <div class="modal fade" id="ModificarObj" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <form role="form" id="ModificarObj"  method="post">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="border-radius: 25px;">
       <div class="modal-header with-border" style="text-align: center;"> 
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="control-label"><strong>Modificar Objetivo</strong></h4>
              </div>

              <input type="hidden" name="Id_Objetivo" id="Id_Objetivo">

              <input type="hidden" name="Id_Estado" id="Id_Estado">
            <div class="form-group col-lg-6">
              <label class="">Fecha registro:</label>
              <input type="text" id="Fecha_Registro" name="FechaRegistro" readonly="" class="form-control">
            </div>
        
            <div class="  col-lg-6"> 
              <div class="form-group">
                <label class="control-label" style="padding-right: 10px;">Fecha inicio:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="Fecha_Inicio" name="FechaInicio" required="">
                </div>
              </div>
            </div>

           <div class="form-group col-lg-6">
              <label class="">Nombre:</label>
              <input  type="text" name="Nombre" id="Nombre" class="form-control" required="">
            </div>

             <div class=" col-lg-6"> 
              <div class="form-group">
                <label class="control-label" style="padding-right: 10px;">Fecha fin:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="Fecha_Fin" name="FechaFin" required="">
                </div>
              </div>
            </div>

        <div class="row col-lg-12">
          <div class="box-header col-lg-3">
              <h3 class="box-title"><strong>Referencias</strong></h3>
          </div>

         <button type="button" class="btn btn-primary  col-lg-offset-6 col-lg-3 "  data-toggle="modal" data-target="#FichasN" onclick="listarON('<?= $objetivo["Id_Objetivo"]?>',this)">Agregar Fichas</button>
      </div>
      
     <div class="box-body ">
       
            <!-- /.box-header -->
            <table class="table table-hover col-lg-12" id="tablaFiOM">
            <thead>
              <tr class="info">
                <th class="col-lg-2">Id</th>
                <th class="col-lg-4">Referencia</th>
                <th class="col-lg-4">Cantidad</th>
                <th class="col-lg-2">Quitar</th>
              </tr>
            </thead>
            <tbody id="FichasOM">
            </tbody>
         </table>
      </div>
      <br>
        <div class="row col-lg-12">
          <div class="form-group col-lg-5">
            <label>Total:</label>
            <input type="text" name="CantidadTotalN" id="TotalTN" class="form-control" value="0" >
          </div>
        </div>

         <div class="modal-footer">
           <button type="submit" class="btn btn-primary" name="btnModificarObj">Guardar</button>
           <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          </div>
         </div>
     </div>
  </form>
</div>



<!--Modal de estadisticas-->
  <div class="modal fade" id="Estadisticas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document" style="width: 70%; border-radius: 25px;">
            <div class="modal-content" style="border-radius: 20px;">
              <div class="modal-header" style="text-align: center;">
                    <h3 class="box-title"><strong>Avance vs Objetivo</strong></h3>
              </div>
              <div class="modal-body">
                  <div class="box box-success">
                    <div class="box-body">
                      <div class="chart">
                        <canvas id="barChart" style="height:230px"></canvas>
                      </div>
                    </div>
                </div>
             </div>
         </div>
       </div>
  </div>

   <div class="modal fade" id="FichasN" tabindex="-1" role="dialog" >
        <div class="modal-dialog">
          <div class="modal-content" style="border-radius: 10px;">
            <form method="POST">
            <div class="modal-header">

              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Fichas tecnicas</b></h4>
            </div>
            <div class="modal-body">
              <div class="table">
                <div class="col-sm-12 table-responsive">
                  <table class="table table-hover" style="margin-top: 2%;">
                  <thead>
                    <tr class="active">
                      <th>Id</th>
                      <th>Referencia</th>
                      <th>Cantidad actual</th>
                      <th>Seleccionar</th>
                      <th style="display: none"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tbody class="list">
                     <?php $i = 1; ?>
                  <?php foreach ($fichas as $ficha): ?>
                    <tr >
                      <td><?= $ficha["Id_Ficha_Tecnica"]?></td>
                      <td><?= $ficha["Referencia"]?></td>
                      <td><?= $ficha["Cantidad"]?></td>
                      <td>
                       <button id="btn<?= $i; ?>" type="button" class="btn btn-box-tool" onclick="asociarFichasNuevas('<?= $ficha["Id_Ficha_Tecnica"] ?>','<?= $ficha["Referencia"] ?>',  this)"><i class="fa fa-plus"></i></button>
                      </td>
                      <td style="display: none" id="ICantidad"></td>
                    </tr>
                    <?php $i++; ?>
                      <?php endforeach; ?>
                    </tbody>
                  </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal"><b>Aceptar</b></button>
            </div>
          </div><!-- /.modal-content -->
          </form>
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

  <script type="text/javascript">
    $(function(){
      $(".open-modal-estadistica").click(function(){
        $("#el-modal-estadistica").modal("show");
        setTimeout(function(){
          mostrarGrafica();
        }, 800);
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

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: false,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - Whether the line is curved between points
      bezierCurve: true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension: 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot: false,
      //Number - Radius of each point dot in pixels
      pointDotRadius: 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth: 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius: 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke: true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth: 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true
    };
    
    //-------------
    //- BAR CHART -
    //-------------
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
    }
  </script>
