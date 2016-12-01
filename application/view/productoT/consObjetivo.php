<style>
  input[type=number]::-webkit-outer-spin-button,
  input[type=number]::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
  }
  input[type=number] {
      -moz-appearance:textfield;
  }
</style>
<section class="content-header">
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li><a href="#">Producto T</a></li>
        <li class="active">Listar objetivos</li>
      </ol>
    </section>
  <!-- Main content -->
  <section class="content">
     <div class="box box-primary">
      <div class="box-header with-border"  style="text-align: center;">
       <h3 class="box-title"><strong>LISTAR OBJETIVOS</strong></h3>
      </div>
      <div id="users">
         <form class="form-horizontal">
          <div class="col-md-12">
              <div class="table table-responsive">
                <table class="table table-hover cell-border" id="TablaObjetivos">
                  <thead>
                    <tr class="info"> 
                      <th>#</th>
                      <th>Fecha de Registro</th>
                      <th>Nombre</th>
                      <th>Fecha Inicio</th>
                      <th>Fecha Fin</th>
                      <th>Total Objetivo</th>
                      <th>Estado</th>
                      <th style="display:none">Id_Estado</th>
                      <th>Editar</th>
                      <th>Estadísticas</th>
                      <th>Productos Asociados</th>
                      <th>Cancelar Objetivo</th>
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
                     <td><?= $objetivo["Nombre_Estado"] ?></td> 
                     <td style="display: none"><?= $objetivo["Id_Estado"] ?></td>
                      
                        <td>
                        <?php if ($objetivo["Nombre_Estado"] == "Cancelado" || $objetivo["Nombre_Estado"] == "En Proceso"): ?>
                        <button disabled="" type="button" class="btn btn-box-tool"><i class="fa fa-pencil-square-o fa-lg" style="font-size: 150%;"></i></button>
                        <?php else: ?>
                          <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#ModificarObj"onclick="ModificarObj('<?= $objetivo["Id_Objetivo"] ?>', '<?= $objetivo["FechaRegistro"] ?>', '<?= $objetivo["FechaInicio"] ?>', '<?= $objetivo["Nombre"] ?>', '<?= $objetivo["FechaFin"] ?>', this, 1)"><i style="font-size:150%;" class="fa fa-pencil-square-o fa-lg"></i></button>
                          <?php endif ?>
                          </td>
                        <td>
                         <?php if ($objetivo["Nombre_Estado"] == "Cancelado" || $objetivo["Nombre_Estado"] == "En Proceso"): ?>
                           
                           <button disabled="" type="button" class="btn btn-box-tool"><i class="fa fa-signal open-modal-estadistica fa-lg" style="font-size: 150%;"></i></button>

                         <?php else: ?>

                          <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target='#Estadisticas'><i style="font-size:150%;" class="fa fa-signal open-modal-estadistica fa-lg" style="color:#3B73FF"></i></button>

                         <?php endif ?>
                        </td>
                        <td>                           
                         <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#ListarF" onclick=" listarO('<?= $objetivo["Id_Objetivo"] ?>', this)"><i class="fa fa-eye fa-lg" style="color:#3B73FF; font-size: 150%;"></i></button>
                        </td>
                     <td>
                          <?php if ($objetivo["Nombre_Estado"] == "Cancelado" || $objetivo["Nombre_Estado"] == "En Proceso"): ?>
                            <button type="button" class="btn btn-box-tool" disabled=""><i class="fa fa-ban" style="font-size: 150%;"></i></button>
                          <?php else: ?>
                            <button type="button" class="btn btn-box-tool" onclick="cancelarobjetivo('<?= $objetivo["Id_Objetivo"] ?>')" id="btn-cancel-ped"><i class="fa fa-ban fa-lg" style="color:red; font-size:150%;"></i></button>
                          <?php endif ?>
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
        <div class="box-footer">
        </div>
      </div>

<!--Modal para listar las fichas -->
 <div class="modal fade" id="ListarF" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content" style="border-radius: 10px;">
       <div class="modal-header with-border" style="text-align: center;"> 
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><strong>PRODUCTOS SELECCIONADOS</strong></h4>
        </div>
        <div class="modal-body">
        <div class="table scrolltablas">
          <table class="table table-hover table-bordered" id="tablaFiO">
            <thead>
              <tr class="info">
                <th style="display: none;"></th>
                <th>Referencia</th>
                <th>Nombre</th>
                <th>Color</th>
                <th>Cantidad</th>
              </tr>
            </thead>
            <tbody id="FichasO">
            </tbody>
          </table>
          </div>
        </div>
        <div class="modal-footer" style="border-top:none; border-bottom:1px solid;">
          <button type="button" class="btn btn-default btn-lg" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
        </div>
      </div>
    </div>
  </div>
<!--Final del modal -->


<div class="modal fade" id="ModificarObj" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content" style="border-radius:10px">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">MODIFICAR OBJETIVO</h4>
            </div>
            
              <form data-parsley-validate="" role="form" id="ModificarObj" action="<?= URL ?>ctrObjetivos/modificarObjetivos" method="post" data-parsley-validate="" onsubmit="return valFormModObj();">    
            <div class="modal-body">

              <input type="hidden" name="Id_Objetivo" id="Id_Objetivo">
              <input type="hidden" name="Id_Estado" id="Id_Estado">

              <div class="row">
                <div class="col-sm-12">

                  <div class="form-group col-sm-6">
                    <label class="">Fecha Registro:</label>
                    <div class="">
                  <div class="input-group date">
                    <div class="input-group-addon" style="border-radius:5px;">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" id="Fecha_Registro" name="FechaRegistro" readonly="" class="form-control">
                  </div>
                  </div>
                </div>
                  <div class="form-group col-sm-6">
                    <label class="">*Nombre:</label>
                    <input  type="text" name="Nombre" id="Nombre" class="form-control" required="" maxlength="45" data-parsley-required="">
                  </div>

                </div>
              </div>


              <div class="row">
              <div class="col-sm-12">
              <div class="form-group col-sm-6">
                <label class="control-label" style="padding-right: 10px;">*Fecha Inicio:</label>
                <div class="input-group date">
                  <div class="input-group-addon" style="border-radius:5px;">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="FechaInicio" id="FechaInicioMod" required="" data-parsley-errors-container="#errorFechaIncmodobj">
                </div>
                <div id="errorFechaIncmodobj"></div>
              </div>
              <div class="col-sm-4"> 
              <div class="form-group">
                <label class="control-label" style="">*Fecha Fin:</label>
                  <div class="input-group date">
                    <div class="input-group-addon" style="border-radius:5px;">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="Fecha_FinMod" name="FechaFin" required="" data-parsley-errors-container="#errorFechafinmodobj">
                </div>
                <div id="errorFechafinmodobj"></div>
              </div>
            </div>
            <div class="col-sm-2">
              <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#FichasN" onclick="listarON('<?= $objetivo["Id_Objetivo"]?>',this)" style="margin-top: 21%; margin-left:20%;"><b>Productos</b></button>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12" id="FichasS">
          <div class="col-md-12">
          <label>*Productos Seleccionados:</label>
          <div class="table scrolltablas" style="margin-top:2%;">
            <div class="col-lg-12 table-responsive" style="padding: 0;">
            <table class="table table-hover table-bordered" id="tablaFiOM">
            <thead>
              <tr class="info">
                <th>Referencia</th>
                <th>Nombre</th>
                <th>Color</th>
                <th>Cantidad</th>
                <th>Retirar</th>
              </tr>
            </thead>
            <tbody id="FichasOM">
            </tbody>
         </table>
      </div>
            </div>
        </div>
        </div>
        </div>

      <div class="row">
        <div class="col-sm-12">
          <div class="form-group col-sm-offset-6 col-sm-6">
            <label>Total Objetivo:</label>
            <input type="number" name="CantidadTotalN" id="TotalTN" class="form-control" value="0" readonly="">
          </div>
        </div>

        </div>
        </div>

          <div class="modal-footer" >
              <div class="row">
                <div class="col-md-offset-3 col-md-3">
                <button type="submit" class="btn btn-warning btn-md btn-block" name="btnModificarObj"><i class="fa fa-refresh" aria-hidden="true"></i>  <b>Actualizar</b></button>
                </div>
                <div class="col-md-3">
                  <button type="reset" class="btn btn-default btn-md btn-block" data-dissmis="modal" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
                </div>
              </div>
            </div>
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
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title"><strong>AVANCE VS OBJETIVO</strong></h3>
              </div>
              <div class="modal-body">
                  <div class="box box-success">
                    <div class="box-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Fecha inicial</label>
                            <input type="text" id="txtFechaI" class="form-control">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Fecha final</label>
                            <input type="text" id="txtFechaF" class="form-control">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <button class="btn btn-success" onclick="mostrarGrafica()">Consultar</button>
                        </div>
                      </div>
                      
                      <div class="chart row">
                        <canvas id="barChart" style="height:230px"></canvas>
                      </div>
                    </div>
                </div>
             </div>
             <div class="modal-footer" style="border-top:none; border-bottom:1px solid;">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar</button>
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
              <h4 class="modal-title"><b>PRODUCTOS PARA ASOCIAR</b></h4>
            </div>
            <div class="modal-body">
              <div class="table">
                <div class="col-sm-12 table-responsive">
                  <table class="table table-hover table-bordered" style="margin-top: 2%;" id="tblObjetivosAsoProdts">
                  <thead>
                    <tr class="active">
                      <th style="display:none;">Id</th>
                      <th>Referencia</th>
                      <th>Nombre</th>
                      <th>Color</th>
                      <th>Cantidad Actual</th>
                      <th>Agregar</th>
                      <th style="display: none"></th>
                      <th style="display: none"></th>
                    </tr>
                  </thead>
                  <tbody class="list">
                     <?php $i = 1; ?>
                  <?php foreach ($fichas as $ficha): ?>
                    <tr >
                      <td style="display:none;"><?= $ficha["Id_Ficha_Tecnica"]?></td>
                      <td><?= $ficha["Referencia"]?></td>
                      <td><?= $ficha["Nombre"]?></td>
                      <td><i class="fa fa-square" style="color: <?= $ficha["Codigo_Color"]?>; font-size: 200%;" title='<?= $ficha["Nombre_Color"]?>'></i></td>
                      <td><?= $ficha["Cantidad"]?></td>
                      <td>
                       <button id="btnobjMod<?= $i; ?>" type="button" class="btn btn-box-tool btnasociarObje" onclick="asociarFichasNuevas('<?= $ficha["Id_Ficha_Tecnica"] ?>','<?= $ficha["Referencia"] ?>',  this, '<?= $i ?>', '<?= $ficha["Codigo_Color"]?>', '<?= $ficha["Nombre"]?>', '<?= $ficha["Id_Ficha_Tecnica"]?>')"><i style="font-size:150%; color:blue;" class="fa fa-plus"></i></button>
                      </td>
                      <td style="display: none" id="ICantidad"></td>
                      <td style="display:none;"><?= $ficha["Nombre_Color"]?></td>
                    </tr>
                    <?php $i++; ?>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-lg" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cerrar</button>
            </div>
          </div><!-- /.modal-content -->
          </form>
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

  <script type="text/javascript">
      $(function(){
        $(".open-modal-estadistica").click(function(){
          $("#el-modal-estadistica").modal("show");
        });
      });

    function mostrarGrafica(){
      var data = null;
      $.ajax({
        data:{FechaInicio:$("#txtFechaI").val(),FechaFin:$("#txtFechaF").val()},
        type:"post",
        dataType:"JSON",
        url:uri+"ctrObjetivos/listar_GraficasOb",
        async:false
      }).done(function(respuesta){
        data = respuesta;
      })

      var areaChartData = {
      labels: data["$objetivo"]
      datasets: [
        {
          label: "Electronics",
          fillColor: "rgba(210, 214, 222, 1)",
          strokeColor: "rgba(210, 214, 222, 1)",
          pointColor: "rgba(210, 214, 222, 1)",
          pointStrokeColor: "#c1c7d4",
          pointHighlightFill: "#c1c7d4",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: data["refObj"]
        },
        {
          label: "Digital Goods",
          fillColor: "rgba(60,141,188,0.9)",
          strokeColor: "rgba(60,141,188,0.8)",
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data:[]
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