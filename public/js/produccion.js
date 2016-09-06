    $('#tblOrdenes').DataTable( {
      // "lengthChange": false,
      //"searching": false,
      // "info": false,
      "ordering": false
    });

    
    $('#fecha_terminacion').datepicker({
          format: "yyyy-mm-dd",
          language: 'es',
          autoclose: true
          // todayBtn: true
    });

    $('#fecha_entregaOp').datepicker({
          format: "yyyy-mm-dd",
          language: 'es',
          autoclose: true
          // todayBtn: true
        }).on(
          'show', function() {      
          // Obtener valores actuales z-index de cada elemento
          var zIndexModal = $('#mdlEditOrdenP').css('z-index');
          var zIndexFecha = $('.datepicker').css('z-index');
          // Re asignamos el valor z-index para mostrar sobre la ventana modal
          $('.datepicker').css('z-index',zIndexModal+1);
        });

    function editarOrdeP(idOrden, ordenes)
    {
    	var campos = $(ordenes).parent().parent();
        $("#numOrdenp").val(idOrden);
        $("#fecha_regOp").val(campos.find("td").eq(1).text());
        $("#fecha_entregaOp").val(campos.find("td").eq(2).text());
        $("#estadoOp").val(campos.find("td").eq(3).text());
        $("#lugarOp").val(campos.find("td").eq(5).text());
        $("#ped_asociado_ord").val(campos.find("td").eq(6).text());
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
            var cantTotal = productosAsoOrden[i]["Cantidad_Producir"];
	    			var cantFab = productosAsoOrden[i]["Cantidad_Fabrica"];
            var cantSat = productosAsoOrden[i]["Cantidad_Satelite"];
            var codEstadoFicha = productosAsoOrden[i]["Id_Estado"];
            var nombreEstadoF = productosAsoOrden[i]["Nombre_Estado"];
            var idFichaTec = productosAsoOrden[i]["Id_Ficha_Tecnica"];
	    			var idSolcProd = productosAsoOrden[i]["Id_Solicitud_Producto"];

            var estadoFichaProd="";
            if (codEstadoFicha == 5) {
              estadoFichaProd = "Pendiente";
            }
            else if(codEstadoFicha == 9){
              estadoFichaProd = "Calidad";
            }
            else{
              estadoFichaProd = "Terminado";
            }
	    			var tr ="";
	    			tr = "<tr class='box box-solid collapsed-box'><td>"+referencia+"</td><td><i class='fa fa-square' style='color:"+codColor+"; font-size: 150%;'></td><td>"+cantTotal+"</td><td><input type='text' value='"+cantFab+"' name='cantFab[]'></td><td><input type='text' value='"+cantSat+"' name='cantSat[]'></td><td>"+estadoFichaProd+"</td><td></td><input type='hidden' value='"+idFichaTec+"' name='id_fichaTec[]'><input type='hidden' value='"+idSolcProd+"' name='idSolcProd[]'><input type='hidden' value='"+codEstadoFicha+"' name='codEstadoFicha[]'></tr>";
	           $('#tblFichasProducc').append(tr);
            // tr = "<tr class='box box-solid collapsed-box'><input type='hidden' value='"+id_solic_produc+"' name='id_solic_prodcto[]'><input type='hidden' value='"+id_fichat+"' name='id_fichaTec[]'><td>"+idProducto+"</td><td><i class='fa fa-square' style='color:"+color+"; font-size: 150%;'></td><td><input type='text' readonly value='"+cantProducir+"' id='cantProducirPed"+id_fichat+"' name='cantProducirPed[]'></td><td>$"+vlrProducto+"</td><td>"+subtotal+"</td><td><input type='checkbox' id='chb"+id_fichat+"' onchange='prueba(cantSatelite"+id_fichat+", chb"+id_fichat+", confirmar"+id_fichat+", cancelarCant"+id_fichat+")'><input type='text' value='0' style='display:none' id='cantSatelite"+id_fichat+"' name='cantSatelite[]'><button style='display:none' type='button' id='confirmar"+id_fichat+"' class='btn btn-box-tool' onclick='confirmarCantSat(cantProducirPed"+id_fichat+".value, cantSatelite"+id_fichat+".value, cantProducirPed"+id_fichat+", cantSatelite"+id_fichat+", confirmar"+id_fichat+")'><i class='fa fa-check fa-lg'></i></button><button style='display:none' type='button' id='cancelarCant"+id_fichat+"' class='btn btn-box-tool' onclick='cancelarCantSat(cancelarCant"+id_fichat+", cantSatelite"+id_fichat+", chb"+id_fichat+", cantProducirPed"+id_fichat+", cantProducirPed"+id_fichat+".value, cantSatelite"+id_fichat+".value, confirmar"+id_fichat+")'><i class='fa fa-remove fa-lg'></i></button></td></tr>";
    			}
    		}
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
          closeOnConfirm: false,
          closeOnCancel: false },
          function(isConfirm){
            if (isConfirm)
            { 
              $.ajax({
            type: 'post',
            dataType: 'json',
            url: uri+"ctrProduccion/cancelarOrdenProd",
            data:{id_orden: idOrden}
            }).done(function(respuesta){
              if (respuesta.r == 1) {
                // swal("Cancelado", "El Pedido ha sido cancelado", "success");
                // location.href = uri+"ctrPedido/consPedido";
              }else{
                alert("Error al cancelar la orden");
              }
            }).fail(function(){
            })  
              swal("Cancelada", "La orden ha sido cancelada", "success");
              location.href = uri+"ctrProduccion/consOrden";
            }
            else
            {
              swal("Acción interrumpida", "No se completó la acción.", "error");
            }
          });
        }


  //permite seleccionar y asociar un cliente al pedido
    $("#ped_asociado_ord").select2({
        placeholder: 'Seleccionar',
        language: {
        noResults: function (params) {
        return "No hay resultados";
        }}
    });