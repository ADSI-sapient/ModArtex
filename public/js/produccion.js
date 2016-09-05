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
          var zIndexModal = $('#modaldllOrden').css('z-index');
          var zIndexFecha = $('.datepicker').css('z-index');
          // Re asignamos el valor z-index para mostrar sobre la ventana modal
          $('.datepicker').css('z-index',zIndexModal+1);
        });

    function editarOrdeP(idOrden, ordenes)
    {
    	var campos = $(ordenes).parent().parent();
        $("#numOrdenp").text(idOrden);
        $("#fecha_regOp").val(campos.find("td").eq(1).text());
        $("#fecha_entregaOp").val(campos.find("td").eq(2).text());
        $("#estadoOp").val(campos.find("td").eq(3).text());
        $("#lugarOp").val(campos.find("td").eq(4).text());
        $("#modaldllOrden").show();

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
	    			var cantFab = productosAsoOrden[i]["Cantidad_Producir"];
	    			var cantSat = productosAsoOrden[i]["Cantidad_Satelite"];
	    			var tr ="";
	    			tr = "<tr class='box box-solid collapsed-box'><td>"+referencia+"</td><td><i class='fa fa-square' style='color:"+codColor+"; font-size: 150%;'></td><td>"+cantFab+"</td><td>"+cantSat+"</td></tr>";
	                  $('#tblFichasProducc').append(tr);
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
