function asociarPermisos(Id_Permiso, modulos, Nombre, idbton){
	var campos = $(permisos).parent().parent();
  $("#permisosasig").removeAttr("hidden");

  var permisoAAgregar = Id_Permiso;
  var permisoEnTabla = $("#Idpermiso"+Id_Permiso).val();

  if (permisoAAgregar !== permisoEnTabla) {
  	var tr = "<tr class='box box-solid collapsed-box'><td style='display:none;' >"+Id_Permiso+"<input type='hidden' id='Idpermiso"+Id_Permiso+"' value='"+Id_Permiso+"' name=Idpermiso[] /></td><td>"+modulos+"</td><td>"+Nombre+"</td><td><button type='button' onclick='quitarPermisoAsignado("+idbton+", this)' class='btn btn-box-tool'><i style='font-size:150%;' class='fa fa-times'></i></button></td></tr>";
  	$("#tablaPermisos").append(tr);
  }
    // boton = "#bt"+idbton;
    // $(boton).attr('disabled', 'disabled');
    $("#tblpermisosvacia").remove();
}

function quitarPermisoAsignado(btn, elemento){
  var e = $(elemento).parent().parent();
  $(e).remove();

  boton = "#bt"+btn;
  $(boton).attr('disabled', false);

  if ($("#tblPas tr").length < 2) {
    $("#tblPas").empty();
    var tr = '<tr><td id="tblpermisosvacia" colspan="3" style="text-align:center;">No hay permisos asociados.</td></tr>';
    $("#tblPas").append(tr);
  }
}

function quitarPermisoAsignadoMod(btn, elemento){
  var e = $(elemento).parent().parent();
  $(e).remove();

  boton = "#btn"+btn;
  $(boton).attr('disabled', false);
  if ($("#fila tr").length < 1) {
    $("#fila").empty();
    var tr = '<tr id="tblpervacia"><td id="tblpermisosmodvacia" colspan="3" style="text-align:center;">No hay permisos asociados.</td></tr>';
    $("#fila").append(tr);
  }
}

function quitarPermisosR(btn, elemento){
    // var e = $(elemento).parent().parent();
    // $(e).remove();

    // boton = "#bt"+btn;
    // boton = "#btn"+btn;
    // $(boton).attr('disabled', false);

    // if ($("#tblPas tr").length < 2) {
    //   $("#tblPas").empty();
    //   var tr = '<tr><td id="tblpermisosvacia" colspan="3" style="text-align:center;">No hay permisos asociados.</td></tr>';
    //   $("#tblPas").append(tr);
    // }
}

$(document).ready(function(){
  $("#tblpermisosvacia").html("No hay permisos asociados.");
});

function asociarPermisosNuevos(Id_Permiso, modulos, Nombre, idbton){
   var campos = $(permisos).parent().parent();
    $("#permisosN").removeAttr("hidden");
  
    //rol que se va a agregar
    idrolagregar = Id_Permiso;
    //comparar con los que ya se encuentran agregados
    idpermisoagregado = $("#idPermiso"+Id_Permiso).val();

    if (idrolagregar !== idpermisoagregado) {
      var tr = "<tr class='box box-solid collapsed-box'><td style='display:none;'>"+Id_Permiso+"<input type='hidden' value='"+Id_Permiso+"' name=Idpermiso[] id='idPermiso"+idbton+"'></td><td>"+modulos+"</td><td>"+Nombre+"</td><td><button type='button' onclick='quitarPermisoAsignadoMod("+idbton+", this)' class='btn btn-box-tool'><i style='font-size:150%;' class='fa fa-remove'></i></button></td></tr>";
      $("#fila #tblpervacia").remove();
      $("#fila").append(tr);
    }
      // boton = "#btn"+idbton;
      // $(boton).attr('disabled', 'disabled');
}

    function editarRoles(Id_Rol, Nombre, roles, btn){
  
          var campos = $(roles).parent().parent();
          $("#idRol").val(campos.find("td").eq(0).text());
          $("#nombre_rol").val(campos.find("td").eq(1).text());
           $("#fila").empty();
           // $("#nombre_rol").val(Nombre);
    $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ctrConfiguracion/listarR",
            data: {rol: Id_Rol },
            success: function(data){
               // $("#Nombre").val(campos.find("td").eq(1).text());
              for (var i = 0; i < data.length; i++) {
                idperm=data[i]["Id_Permiso"];
                var fila = '<tr><td style="display:none;">'+data[i]["Id_Permiso"]+'<input type="hidden" name="Idpermiso[]" value="'+idperm+'" id="idPermiso'+idperm+'"></td><td>'+data[i]["NombreMod"]+'</td><td>'+data[i]["Nombre"]+'</td><td><button type="button" onclick="quitarPermisoAsignadoMod('+idperm+', this)" class="btn btn-box-tool"><i style="font-size:150%;" class="fa fa-remove"></i></button></td></tr>';
                $("#fila").append(fila);
              }
            }, 
            error: function(){
            }
        });
    }



    function listarRoles(Id_Rol, Nombre, roles){
          var campos = $(roles).parent().parent();
          $("#idRol").val(campos.find("td").eq(0).text());
          $("#nombreRol").val(campos.find("td").eq(1).text());
           $("#filass").empty();
           // $("#nombre_rol").val(Nombre);

    $.ajax({

            dataType: 'json',
            type: 'post',
            url: uri+"ctrConfiguracion/listarR",
            data: {rol: Id_Rol },
            success: function(data){
               // $("#Nombre").val(campos.find("td").eq(1).text());
            for (var i = 0; i < data.length; i++) {
              idperm=data[i]["Id_Permiso"];
              var fila = '<tr><td style="display:none;">'+data[i]["Id_Permiso"]+'<input type="hidden" name="Idpermiso[]" value="'+idperm+'"/></td><td>'+data[i]["NombreMod"]+'</td><td>'+data[i]["Nombre"]+'</td></tr>'; 
              $("#filass").append(fila);
                          } 
            }, 
            error: function(){
            }
        });
  
    }


    function editarRolesN(Id_Rol, Nombre, roles){
          var campos = $(roles).parent().parent();
          $("#idRol").val(campos.find("td").eq(0).text());
          $("#nombre_rol").val(campos.find("td").eq(1).text());
           $("#fila").empty();
           // $("#nombre_rol").val(Nombre);

    $.ajax({

            dataType: 'json',
            type: 'post',
            url: uri+"ctrConfiguracion/listarR",
            data: {rol: Id_Rol },
            success: function(data){
               // $("#Nombre").val(campos.find("td").eq(1).text());
            for (var i = 0; i < data.length; i++) {
              idperm=data[i]["Id_Permiso"];
              var fila = '<tr><td>'+data[i]["Id_Permiso"]+'<input type="hidden" name="Idpermiso[]" value="'+idperm+'"/></td><td>'+data[i]["NombreMod"]+'</td><td>'+data[i]["Nombre"]+'</td><td><button type="button" onclick="quitarPermisosR(0, this)" class="btn btn-box-tool"><i class="fa fa-remove"></i></button></td></tr>'; 
              $("#fila").append(fila);
                          } 
            }, 
            error: function(){
            }
        });
  
    }


  function editarUsuarios(Num_Documento, usuarios){
    var campos = $(usuarios).parent().parent();
    $("#codigo").val(campos.find("td").eq(0).text());
    $("#tipo_documento").val(campos.find("td").eq(1).text());
    $("#documento").val(campos.find("td").eq(2).text());
    $("#nombre").val(campos.find("td").eq(3).text());
    $("#apellido").val(campos.find("td").eq(4).text());
    $("#estado").val(campos.find("td").eq(5).text());
    $("#nombre_usuario").val(campos.find("td").eq(6).text());
    $("#nomUsuIni").val(campos.find("td").eq(6).text());
     // $("#clave").val(campos.find("td").eq(7).text());
    $("#email").val(campos.find("td").eq(7).text());   
    $("#emailUsuIni").val(campos.find("td").eq(7).text());   
    $("#rol").val(campos.find("td").eq(9).html());
    console.log(campos.find("td").eq(9).text());
    $("#myModal3").show();
            }

 function editarClientes(Num_Documento, clientes){
    var campos = $(clientes).parent().parent();
    $("#Tipo_Documento").val(campos.find("td").eq(0).text());
    $("#Num_Documento").val(campos.find("td").eq(1).text());
    $("#Nombre").val(campos.find("td").eq(2).text());
    $("#Apellido").val(campos.find("td").eq(3).text());
    $("#Telefono").val(campos.find("td").eq(4).text());
    $("#Direccion").val(campos.find("td").eq(5).text());   
    $("#Email").val(campos.find("td").eq(6).text());
    $("#infoAdicionalMod").val(campos.find("td").eq(10).text());
    $("#myModalC").show();
    }
      
  function cambiarEstado(documento, est){
        $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ctrUsuario/cambiarEstado",
            data: {Num_Documento:documento, Estado:est}
        }).done(function(respuesta){
            if (respuesta.v == "1") {
            
                location.href = uri +"ctrUsuario/consUsuario";
            }else{
            }
        }).fail(function() {

        });
    }

     function cambiarEstadoC(documento, est){
        $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ctrCliente/CambiarEstado",
            data: {Num_Documento:documento, Estado:est}

        }).done(function(respuesta){
            if (respuesta.v == "1") {
               
                location.href = uri +"ctrCliente/consCliente";
            }else{
            }
        }).fail(function() {

        });
    }

        function cambiarEstadoRol(Id_Rol, est){
        $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ctrConfiguracion/cambiarEstadoRol",
            data: {Id_Rol:Id_Rol, Estado:est}
        }).done(function(respuesta){
            if (respuesta.v == "1") {
                //Lobibox.notify('success', {delay: 6000, size: 'mini', msg: 'La orden se modificó correctamente!'});
                //alert("Estado modificado");
                location.href = uri +"ctrConfiguracion/RegistrarRoles";
            }else{
                  // Lobibox.notify('errors', {size: 'mini', rounded: true, delayIndicator: false, msg: 'Error al actualizar el estado'});
            }
        }).fail(function() {

        });
    }

     $(document).ready(function(){
        $('#tablaListarRoles').dataTable( {
          // "lengthChange": false,
          //"searching": false,
          // "info": false,
         "ordering": false,
      "language": {
          "emptyTable": "No hay roles para listar",
          "info": "Mostrando página _PAGE_ de _PAGES_",
          "infoEmpty": "Mostrando página _PAGE_ de _PAGES_",
          "zeroRecords": "No se encontraron roles que coincidan con la búsqueda",
      "paginate": {"previous": "Anterior", "next": "Siguiente"}
      },
      "lengthMenu": [[3], [3]]
        });
      });

      $(document).ready(function(){
        $('#TablaClientes').dataTable( {
          // "lengthChange": false,
          //"searching": false,
          // "info": false,
          "ordering": false,
      "language": {
          "emptyTable": "No hay usuarios para listar",
          "info": "",
          "infoEmpty": "",
          "zeroRecords": "No se encontraron usuarios que coincidan con la búsqueda",
      "paginate": {
        "previous": "Anterior",
        "next": "Siguiente"
       }
      },
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]]
        });
      });

      //    $(document).ready(function(){
      //   $('#tablaR').DataTable( {
      //     // "lengthChange": false,
      //     //"searching": false,
      //     // "info": false,
      //     "ordering": false
      //   });
      // });

           $(document).ready(function(){
        $('#TablaUsuarios').dataTable( {
          // "lengthChange": false,
          //"searching": false,
          // "info": false,
          "ordering": false,
      "language": {
          "emptyTable": "No hay usuarios para listar",
          "info": "",
          "infoEmpty": "",
          "zeroRecords": "No se encontraron usuarios que coincidan con la búsqueda",
      "paginate": {
        "previous": "Anterior",
        "next": "Siguiente"
       }
      },
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]]
        });
      });

//validar que si ingrese datos correctos
function validarSiDocumento(documento){
  if (!/^([0-9])*$/.test(documento) || documento.charAt(0) == 0)
    Lobibox.notify('warning', {size: 'mini', delayIndicator: false, msg: 'El número de documento contiene caracteres incorrectos'}); 
}
 

//Validar email
function validarEmail(email) {
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(email) )
      Lobibox.notify('warning', {size: 'mini', delayIndicator: false, msg: 'El email ingresado contiene caracteres incorrectos'}); 
}

function validarTelefono(telefono){
    if (!/^([0-9])*$+/.test(telefono))
      Lobibox.notify('warning', {size: 'mini', delayIndicator: false, msg: 'El numero de telefono ingresado contiene caracteres incorrectos'}); 
  }


function validarRol(){
  if($("#tblPas tr").length > 0 && $("#tblpermisosvacia").length == 0){
    return true;
  }else{
    Lobibox.notify('warning', {size: 'mini', delayIndicator: false, msg: 'Debe asignar al menos un permiso al rol.'}); ;
    return false;
  }
}

function validarRolEdit(){
  if($("#tblpermisosmodvacia").length){
    Lobibox.notify('warning', {size: 'mini', delayIndicator: false, msg: 'Debe asignar al menos un permiso al rol.'}); ;
    return false;
  }else{
    return true;
  }
  return false;
}

function limpiarTablePermisosRoles(){
  var tr = '<tr><td id="tblpermisosvacia" colspan="3" style="text-align:center;">No hay permisos asociados.</td></tr>';
  $("#tblPas").empty();
  $("#tblPas").append(tr);
}

function enviarFormRegUsuario(){
  var clave1 = $("#contraseña").val();
  var clave2 = $("#confirmContraseña").val();
 
  if (clave1 != clave2) {

    Lobibox.notify('warning', {size: 'mini', delayIndicator: false, msg: 'Las contraseñas no coinciden'});
    $("#contraseña").val("");
    $("#confirmContraseña").val("");
    return false;
  }
  if (/\s/.test(clave1) || /\s/.test(clave2)) {
    Lobibox.notify('warning', {size: 'mini', delayIndicator: false, msg: 'La contraseña no debe contener espacios en blanco'});
    $("#contraseña").val("");
    $("#confirmContraseña").val("");
    return false;
  }else{
    return true;
  }
  return false;
}

function validarDatosMod(){
  var nomUsuIni = $("#nomUsuIni").val();
  var emailUsuIni = $("#emailUsuIni").val();

  var nombreUsuario = $("#nombre_usuario").val();
  var correo = $("#email").val();

  if (nomUsuIni != nombreUsuario) {
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: uri+'ctrUsuario/valExistUsuario',
      data: {nombre_usuario: nombreUsuario},
      async: false
    }).done(function(resp){
      if (resp != "") {
        Lobibox.notify('warning', {size: 'mini', delayIndicator: false, msg: 'El usuario ingresado ya se encuentra registrado'}); 
        $("#frmModUsuario").submit(function(){
          return false;
        });
      }
    });
  }

  if (emailUsuIni != correo) {
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: uri+'ctrUsuario/valExistEmail',
      data: {email: correo},
      async: false
    }).done(function(resp){
      if (resp != "") {
        Lobibox.notify('warning', {size: 'mini', delayIndicator: false, msg: 'El correo ingresado ya se encuentra registrado'}); 
        $("#frmModUsuario").submit(function(){
          return false;
        });
      }
    });
  }
}

 function mostrarGraficaRefHome(){
      $("#graficosRefPro").remove();
      var canv = "<canvas id='graficosRefPro' style='height:500px'></canvas>";
      $("#canvContenedor").append(canv);
      var data = null;
      $.ajax({
        type:"post",
        dataType:"JSON",
        url:uri+"ctrObjetivos/listar_GraficasRefHome",
        async:false
      }).done(function(respuesta){
        data = respuesta;
      }).fail(function(){
        console.log(respuesta);
      });

      var areaChartData = {
      labels: data["refHome"],
      datasets: [
        {
          label: "Electronics",
          fillColor: "rgba(210, 214, 222, 1)",
          strokeColor: "rgba(210, 214, 222, 1)",
          pointColor: "rgba(210, 214, 222, 1)",
          pointStrokeColor: "#c1c7d4",
          pointHighlightFill: "#c1c7d4",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: data["cantiProd"]
        }
        // {
        //   label: "Digital Goods",
        //   fillColor: "rgba(60,141,188,0.9)",
        //   strokeColor: "rgba(60,141,188,0.8)",
        //   pointColor: "#3b8bba",
        //   pointStrokeColor: "rgba(60,141,188,1)",
        //   pointHighlightFill: "#fff",
        //   pointHighlightStroke: "rgba(60,141,188,1)",
        //   data: data[""]
        // }
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
    var barChartCanvas = $("#graficosRefPro").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    var barChartData = areaChartData;
    barChartData.datasets[0].fillColor = "#00a65a";
    barChartData.datasets[0].strokeColor = "#00a65a";
    barChartData.datasets[0].pointColor = "#00a65a";
    var barChartOptions = {
      scaleShowLabels: true,
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

$(function(){
  mostrarGraficaRefHome();
});

