    $(window).load(function(){
        if ($("#tblFichasProd tbody tr").length == 0) {
          var tr = "<tr id='tableVaciaProduccion'><td colspan='7' style='text-align: center;''>La tabla está vacía</td></tr>";
          $("#tblFichasProd tbody").append(tr);
        }
    });

    $('#tblOrdenes').dataTable( {
      // "lengthChange": false,
      //"searching": false,
      // "info": false,
      "ordering": false,
      "language": {
          "emptyTable": "No hay ordenes de producción para listar",
          "info": "Mostrando página _PAGE_ de _PAGES_",
          "infoEmpty": "Mostrando página _PAGE_ de _PAGES_",
      "paginate": {
        "previous": "",
        "next": "",
        "last": "ultima"
       }
      }
    });

       $('#TablOrdenesPedidos').dataTable( {
      // "lengthChange": false,
      //"searching": false,
      // "info": false,
      "ordering": false,
      "language": {
          "emptyTable": "No hay pedidos pendientes",
          "info": "Mostrando página _PAGE_ de _PAGES_",
          "infoEmpty": "Mostrando página _PAGE_ de _PAGES_",
      "paginate": {
        "previous": "Anterior",
        "next": "Siguiente",
        "last": "Ultima"
       }
      }
    });

    // $('#fecha_entregaOp').datepicker({
    //       format: "yyyy-mm-dd",
    //       language: 'es',
    //       autoclose: true
    //       // todayBtn: true
    //     }).on(
    //       'show', function() {      
    //       // Obtener valores actuales z-index de cada elemento
    //       var zIndexModal = $('#mdlEditOrdenP').css('z-index');
    //       var zIndexFecha = $('.datepicker').css('z-index');
    //       // Re asignamos el valor z-index para mostrar sobre la ventana modal
    //       $('.datepicker').css('z-index',zIndexModal+1);
    //     });

    function editarOrdeP(idOrden, ordenes)
    {
    	var campos = $(ordenes).parent().parent();
        $("#numOrdenp").val(idOrden);
        $("#fecha_regOp").val(campos.find("td").eq(1).text());
        $("#fecha_entregaOp").val(campos.find("td").eq(2).text());
        $("#estadoOp").val(campos.find("td").eq(3).text());
        $("#lugarOp").val(campos.find("td").eq(5).text());
        $("#clienteOrdn").val(campos.find("td").eq(7).text());
        $("#mdlEditOrdenP").show();
    }

    function FichasAsoOrd(numOrden)
    {
    	$.ajax({
    		type: 'post',
            dataType: 'json',
            url: uri+"ctrProduccion/consFichasOrdenP",
            data:{idOrden: numOrden}
    	}).done(function(resp){
        $('#tblFichasProducc > tbody tr').empty();
    		var productosAsoOrden =resp.v;
        if (productosAsoOrden != null) 
        {
    			for (var i = 0; i < productosAsoOrden.length; i++) {
	    			var referencia = productosAsoOrden[i]["Referencia"];
            var codColor = productosAsoOrden[i]["Codigo_Color"];
	    			var nomColor = productosAsoOrden[i]["Nombre_Color"];
            var cantTotal = productosAsoOrden[i]["Cantidad_Producir"];
	    			var cantFab = productosAsoOrden[i]["Cantidad_Fabrica"];
            var cantSat = productosAsoOrden[i]["Cantidad_Satelite"];
            var codEstadoFicha = productosAsoOrden[i]["Id_Estado"];
            var nombreEstadoF = productosAsoOrden[i]["Nombre_Estado"];
            var idFichaTec = productosAsoOrden[i]["Id_Ficha_Tecnica"];
            var idSolcProd = productosAsoOrden[i]["Id_Solicitud_Producto"];
            var lugar = productosAsoOrden[i]["Lugar_Produccion"];

	    			var tr ="";
            tr = "<tr class='box box-solid collapsed-box'><td style='display: none;'>"+idSolcProd+"</td><td>"+referencia+
            "</td><td><i class='fa fa-square' style='color:"+codColor+"; font-size: 150%;'></td><td>"+nomColor+"</td><td>"
            +cantTotal+"</td><td><input id='cantFabEdit"+idSolcProd+"' disabled='' type='text' value='"+cantFab+"' name='cantFab[]'></td><td><input id='cantSatEdit"+idSolcProd+"' disabled='' type='text' value='"
            +cantSat+"' name='cantSat[]'></td></tr>";
	    			// tr = "<tr class='box box-solid collapsed-box'><td>"+referencia+
        //     "</td><td><i class='fa fa-square' style='color:"+codColor+"; font-size: 150%;'></td><td>"
        //     +cantTotal+"</td><td><input type='text' value='"+cantFab+"' name='cantFab[]'></td><td><input type='text' value='"
        //     +cantSat+"' name='cantSat[]'></td><td><select name='lugarP[]' id='lugarP"
        //     +idFichaTec+"'><option value='Fábrica'>Fábrica</option><option value='Satélite'>Satélite</option><option value='Fábrica/Satélite'>Fábrica/Satélite</option></select></td><td><select name='estadoF[]' id='estadoF"
        //     +idFichaTec+"'><option value='5'>Pendiente</option><option value='9'>Calidad</option><option value='7'>Terminada</option></select></td><td></td><input type='hidden' value='"
        //     +idFichaTec+"' name='id_fichaTec[]'><input type='hidden' value='"
        //     +idSolcProd+"' name='idSolcProd[]'><input type='hidden' value='"+codEstadoFicha+"' name='codEstadoFicha[]'></tr>";
	           $('#tblFichasProducc tbody').append(tr);
            var lugarPrd = "#lugarP"+idFichaTec;
    			  var estadoFc = "#estadoF"+idFichaTec;
            $(lugarPrd).val(lugar);
            $(estadoFc).val(codEstadoFicha);
          }
    		}
    	}).fail(function(){
        console.log("No trajo fichas asociadas a la orden");
      });
    }

    function cancelarOrdenP(idOrden){

        swal({
          title: "¿Está seguro de cancelar esta orden de producción?",   
          text: "La orden quedará cancelada!",  
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Sí, cancelar orden",
          cancelButtonText: "No",
          closeOnConfirm: true,
          closeOnCancel: true },
          function(isConfirm){
          $.ajax({
            type: 'POST',
            dataType: 'json',
            url: uri+'ctrProduccion/consFichasOrdenP',
            data: {idOrden: idOrden}
          }).done(function(resp){
              var tr = "";
              var cont = 0;
              var band = false;
            $(resp.v).each(function(i){
                // if(resp.v[i]["Id_Estado"] == 5){
                //   $("#inputDescInsumos").val();
                // }
                if(resp.v[i]["Id_Estado"] == 5){
                  band = true;
                  tr += "<tr><td style='display: none;'>"+resp.v[i]["Id_Ficha_Tecnica"]+"</td><td>"+(cont+=1)+"</td><td>"+resp.v[i]["Referencia"]+
                  "</td><td><i class='fa fa-square' style='color:"+resp.v[i]["Codigo_Color"]+
                  "; font-size: 150%;'></td><td>"+resp.v[i]["Nombre_Color"]+"</td><td>"+resp.v[i]["Cantidad_Producir"]+
                  "</td><td><input id='inputInsADevolver"+resp.v[i]["Id_Ficha_Tecnica"]+"' class='form-control'></td></tr>";
                }
            });
            if (band) {
              $("#tbodyDevolverInsumos").empty();
              $("#tbodyDevolverInsumos").append(tr);
              $("#devolverInsumos").modal('show');
              $("#idOrdenHidden").val(idOrden);
            }else{
              // $.ajax({
              //   type: 'post',
              //   dataType: 'json',
              //   url: uri+"ctrProduccion/cancelarOrdenProd",
              //   data:{id_orden: idOrden}
              //   }).done(function(respuesta){
              //     if (respuesta.r == 1) {
              //       location.href = uri+'ctrProduccion/consOrden';
              //     }else{
              //       alert("Error al cancelar la orden");
              //     }
              //   }).fail(function(){
              //   }) 
            }
          }).fail(function(){
          });
          });
        }

  //permite seleccionar y asociar un cliente al pedido
    $("#clienteOrdn").select2({
        placeholder: 'Seleccionar',
        language: {
        noResults: function (params) {
        return "No hay resultados";
        }}
    });

    function asoPedAOrden(opciones)
    {
      var id_solicitud =  $(opciones).val();
      $.ajax({
        type: 'post',
        dataType: 'json',
        url: uri+"ctrProduccion/consPedidoCliente",
        data:{id_solc:id_solicitud}
      }).done(function(resp){
        var solicitudesCliente = resp.r;
        if (solicitudesCliente != null) {
            // $("#numOrdenp").val(solicitudesCliente["Id_Solicitud"]);
            $("#fecha_regOp").val(solicitudesCliente["Fecha_Registro"]);
            $("#fecha_entregaOp").val(solicitudesCliente["Fecha_Entrega"]);
            $("#estadoOp").val(solicitudesCliente["Id_Estado"]);
            //$("#lugarOp").val(lugarPrd);
            //$("#clienteOrdn").val();
            $.ajax({
              type: 'post',
              dataType: 'json',
              url: uri+"ctrPedido/cargarProAsoPedido",
              data:{idPed: solicitudesCliente["Id_Solicitud"]}
            }).done(function(resp){
              $("#tblFichasProducc tbody").empty();
              var soliProduc = resp.r;
              var tr = '';
              $.each(soliProduc, function(i){
                  var referencia = soliProduc[i]["Referencia"];
                  var codColor = soliProduc[i]["Codigo_Color"];
                  var nomColor = soliProduc[i]["nomColor"];
                  var cantProducir = soliProduc[i]["Cantidad_Producir"];
                  var idFicha = soliProduc[i]["Id_Ficha_Tecnica"];
                  var idSolcProd = soliProduc[i]["Id_Solicitudes_Producto"];
                
                  tr = "<tr class='box box-solid collapsed-box'><td style='display: none;'>"+idSolcProd+"</td><td>"+referencia+
                  "</td><td><i class='fa fa-square' style='color:"+codColor+"; font-size: 150%;'></td><td>"+nomColor+"</td><td>"
                  +cantProducir+"</td><td><input id='cantFabEdit"+idSolcProd+
                  "' disabled='' type='text' value='0' name='cantFab[]'></td><td><input id='cantSatEdit"+idSolcProd+
                  "' disabled='' type='text' value='0' name='cantSat[]'></td></tr>";
                  
                  $("#tblFichasProducc tbody").append(tr);
              });
            });
        }
      });
    }

    function devolverInsumos(){
        $("#tbodyDevolverInsumos tr").each(function(){
            var idFicha = $(this).find("td").eq(0).html();
            var cantidadPedida = $(this).find("td").eq(5).html();
            var cantidadRealizada = $("#inputInsADevolver"+idFicha).val();
            var cantFichasDevolver = cantidadPedida - cantidadRealizada;
            $.ajax({
              type: 'POST',
              dataType: 'json',
              url: uri+'ctrFicha/cargarInsumosAsociados',
              data: {referencia: idFicha}
            }).done(function(resp){
              console.log(resp);
              $(resp.r).each(function(i){
                 var cantInsumoADevolver =  parseInt(resp.r[i]["Cant_Necesaria"]) * parseInt(cantFichasDevolver);
                 var cantTotalInsumos = parseInt(resp.r[i]["Cantidad_Insumo"]) + parseInt(cantInsumoADevolver);
                 var idExsIns = resp.r[i]["Id_Insumo"];
                 $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: uri+'ctrBodega/actualizarExsIns',
                    data: {idExs: idExsIns, cantidad: cantTotalInsumos}
                 }).done(function(resp){
                 });
              });
            });
        });
        var idOrden = $("#idOrdenHidden").val();
        $.ajax({
          type: 'post',
          dataType: 'json',
          url: uri+"ctrProduccion/cancelarOrdenProd",
          data:{id_orden: idOrden}
          }).done(function(respuesta){
            if (respuesta.r == 1) {
              location.href = uri+'ctrProduccion/consOrden';
            }else{
              alert("Error al cancelar la orden");
            }
          }).fail(function(){
        }); 
    }







function selectLugarProduccion(select){
    if ($(select).val() == "Fábrica-Satélite") {
      $('#tblFichasProd thead tr').each(function(){
        var th = "<th>Fabrica</th><th>Satelite</th>"
        $(this).append(th);
      });
      $('#tblFichasProd tbody tr').each(function(){
        var solPro = $(this).find("td").eq(0).html();
        var td = "<td><input data-parsley-required='' value='0' min='0' type='number' id='canFabri"+solPro+
        "'></td><td><input data-parsley-required='' value='0' min='0' type='number' id='cantSate"+solPro+"'></td>";
        $(this).append(td);
      });
      $('#tblFichasProd tbody tr').each(function(){
        var solPro = $(this).find("td").eq(0).html();
        var cantidad = $(this).find("td").eq(5).html();
        $("#canFabri"+solPro).on('keyup change', function(){
            $("#cantSate"+solPro).val(parseInt(cantidad) - parseInt($("#canFabri"+solPro).val()));
        }); 
        $("#cantSate"+solPro).on('keyup change', function(){
            $("#canFabri"+solPro).val(parseInt(cantidad) - parseInt($("#cantSate"+solPro).val()));  
        });
      });
    }else{
      $('#tblFichasProd thead tr').each(function(){
        $(this).find("th").eq(8).remove();
        $(this).find("th").eq(8).remove();
      });
      $('#tblFichasProd tbody tr').each(function(){
        $(this).find("td").eq(8).remove();
        $(this).find("td").eq(8).remove();
      });
    }
}


function regOrdenProducc(){
  var fechaRegistro = $("#fecha_registro").val();
  var idSolicitud = $("#id_solicitud").val();
  var fechaFin = $("#fecha_terminacion").val();
  var lugarPro = $("#selectLugarProducc").val();

  var band = true;
  if ($("#selectLugarProducc").val() == "Fábrica-Satélite") {
    $('#tblFichasProd tbody tr').each(function(){
      var solPro = $(this).find("td").eq(0).html();
      var cantidad = $(this).find("td").eq(5).html();

      $("#canFabri"+solPro).parsley().validate();
      $("#cantSate"+solPro).parsley().validate();
        if (($("#canFabri"+solPro).val() == "") || ($("#cantSate"+solPro).val() == "") || ($("#canFabri"+solPro).val() < 0) || ($("#cantSate"+solPro).val() < 0)) {
          band = false;
        }else{
          if (((parseInt($("#canFabri"+solPro).val())) + (parseInt($("#cantSate"+solPro).val()))) != parseInt(cantidad)){
             Lobibox.notify('warning', {delay: 6000, size: 'mini', msg: 'La cantidad fabrica y satelite deben ser igual a la cantidad producir'});
             $("#canFabri"+solPro).focus();
             band = false;
          }
        } 
    });  
  }


  $("#fecha_terminacion").parsley().validate();

  if ($("#tblFichasProd tbody tr").length == 1 && $("#tableVaciaProduccion").length) {
    Lobibox.notify('warning', {delay: 6000, size: 'mini', msg: 'La tabla está vacía'});
  }else{
    if ($("#fecha_terminacion").val() != "" && band == true) {
      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: uri+'ctrProduccion/registrarOrdenProduc',
        data: {fecha_registro: fechaRegistro, id_solTud: idSolicitud, fecha_terminacion: fechaFin, lugarPrd: lugarPro}
      }).done(function(resp){
        var ultimaOrden = resp["ultOrden"]
        $('#tblFichasProd tbody tr').each(function(){
          var idSolProd = $(this).find("td").eq(0).html();
          var CantFab = "";
          var CantSat = "";
          if($("#selectLugarProducc").val() == "Fábrica"){
            CantFab = $(this).find("td").eq(5).html();
            CantSat = 0;
          }else if($("#selectLugarProducc").val() == "Satélite"){
            CantFab = 0;
            CantSat = $(this).find("td").eq(5).html();
          }else if($("#selectLugarProducc").val() == "Fábrica-Satélite"){
            CantFab = $("#canFabri"+idSolProd).val();
            CantSat = $("#cantSate"+idSolProd).val();
          }
          console.log(idSolProd, ultimaOrden, CantFab, CantSat);
          $.ajax({
            type: 'POST',
            dataType: 'json',
            url: uri+'ctrProduccion/registraOrdenSolicitud',
            data: {id_solic_prodcto: idSolProd, idOrden: ultimaOrden, cantProducirPed: CantFab, cantSatelite: CantSat}
          }).done(function(resp){
            location.href = uri+'ctrProduccion/regOrden';
          }).fail(function(){
            console.log("fail");
          });
        });
      }).fail(function(){
        console.log("fallo");
      })
    }
  }
}


function cambiarEstadoOrdenPro(idOrd){
  swal({
        title: "¿Está seguro de iniciar la producción?",   
        text: "No podra editar la orden",  
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Sí, iniciar la producción",
        cancelButtonText: "No",
        closeOnConfirm: true,
        closeOnCancel: true },
        function(){
          $.ajax({
            type: 'POST',
            dataType: 'json',
            url: uri+'ctrProduccion/cambiarEstadoOrden',
            data: {id_orden: idOrd, id_est: 6}
          }).done(function(resp){
            $.ajax({
              type: 'POST',
              dataType: 'json',
              url: uri+'ctrProduccion/consFichasOrdenP',
              data: {idOrden: idOrd}
            }).done(function(fichaAso){
              var fichas = fichaAso.v;
              $.each(fichas, function(i){
                  var codOrdSol = fichas[i]["Codigo"];
                  $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: uri+'ctrProduccion/cambiarEstadoOrdenSol',
                    data: {id_ordenSoli: codOrdSol, id_est: 6}
                  }).done(function(res){
                    location.href = uri+'ctrProduccion/consOrden';
                  });
              });
            }).fail(function(){
              console.log("Error fichaAso");
            });
          }).fail(function(){
            console.log("fall");
          });
        }
      );  
}

function selLugOrdSol(){
  $("#tblFichasProducc tbody tr").each(function(){
    var idSolPro = $(this).find("td").eq(0).html();
    var cantTot = $(this).find("td").eq(4).html();

    if ($("#lugarOp").val() == "Fábrica"){
      $("#cantFabEdit"+idSolPro).removeAttr("disabled");
      $("#cantFabEdit"+idSolPro).val(cantTot);
      $("#cantSatEdit"+idSolPro).attr("disabled", true);
      $("#cantSatEdit"+idSolPro).val(0);
    }else if($("#lugarOp").val() == "Satélite"){
      $("#cantSatEdit"+idSolPro).removeAttr("disabled");
      $("#cantSatEdit"+idSolPro).val(cantTot);
      $("#cantFabEdit"+idSolPro).attr("disabled", true);
      $("#cantFabEdit"+idSolPro).val(0);
    }else if($("#lugarOp").val() == "Fábrica-Satélite"){
      $("#cantSatEdit"+idSolPro).removeAttr("disabled");
      $("#cantFabEdit"+idSolPro).removeAttr("disabled");
    }
  });
}


function limpiarFormRegOrdPro(){
   $("#tblFichasProd tbody").empty();
   if ($("#tblFichasProd tbody tr").length == 0) {
          var tr = "<tr id='tableVaciaProduccion'><td colspan='7' style='text-align: center;''>La tabla está vacía</td></tr>";
          $("#tblFichasProd tbody").append(tr);
    }
    $("#selectLugarProducc").attr("disabled", true);
}


function actualizarOrdenProd(){
  var numOrden = $("#numOrdenp").val();
  var lugarProduc = $("#lugarOp").val();

  $.ajax({
      type: 'POST',
      dataType: 'json',
      url: uri+'ctrProduccion/editarOrdenProduccion',
      data: {numOrdenp: numOrden, lugarOp: lugarProduc}
    }).done(function(){
      $("#tblFichasProducc tbody tr").each(function(){
        var idSolProd = $(this).find("td").eq(0).html();
        var cantFabr =  $("#cantFabEdit"+idSolProd).val();
        var cantSat = $("#cantSatEdit"+idSolProd).val();

          $.ajax({
            type: 'POST',
            dataType: 'json',
            url: uri+'ctrProduccion/registrarSolicitudesOrdenes',
            data: {idSolcProd: idSolProd, numOrdenp: numOrden, cantFab: cantFabr, cantSat: cantSat}
        }).done(function(resp){
            location.href = uri+'ctrProduccion/consOrden';
        });
      });
    }).fail(function(){
      console.log("Error al editar orden de producción");
    })
}