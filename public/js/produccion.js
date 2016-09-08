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
            var cantTotal = productosAsoOrden[i]["Cantidad_Producir"];
	    			var cantFab = productosAsoOrden[i]["Cantidad_Fabrica"];
            var cantSat = productosAsoOrden[i]["Cantidad_Satelite"];
            var codEstadoFicha = productosAsoOrden[i]["Id_Estado"];
            var nombreEstadoF = productosAsoOrden[i]["Nombre_Estado"];
            var idFichaTec = productosAsoOrden[i]["Id_Ficha_Tecnica"];
            var idSolcProd = productosAsoOrden[i]["Id_Solicitud_Producto"];
            var lugar = productosAsoOrden[i]["Lugar_Produccion"];

	    			var tr ="";
	    			tr = "<tr class='box box-solid collapsed-box'><td>"+referencia+
            "</td><td><i class='fa fa-square' style='color:"+codColor+"; font-size: 150%;'></td><td>"
            +cantTotal+"</td><td><input type='text' value='"+cantFab+"' name='cantFab[]'></td><td><input type='text' value='"
            +cantSat+"' name='cantSat[]'></td><td><select name='lugarP[]' id='lugarP"
            +idFichaTec+"'><option value='Fábrica'>Fábrica</option><option value='Satélite'>Satélite</option><option value='Fábrica/Satélite'>Fábrica/Satélite</option></select></td><td><select name='estadoF[]' id='estadoF"
            +idFichaTec+"'><option value='5'>Pendiente</option><option value='9'>Calidad</option><option value='7'>Terminada</option></select></td><td></td><input type='hidden' value='"
            +idFichaTec+"' name='id_fichaTec[]'><input type='hidden' value='"
            +idSolcProd+"' name='idSolcProd[]'><input type='hidden' value='"+codEstadoFicha+"' name='codEstadoFicha[]'></tr>";
	           $('#tblFichasProducc').append(tr);
            var lugarPrd = "#lugarP"+idFichaTec;
    			  var estadoFc = "#estadoF"+idFichaTec;
            $(lugarPrd).val(lugar);
            $(estadoFc).val(codEstadoFicha);
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
            $("#numOrdenp").val(solicitudesCliente["Id_Solicitud"]);
            $("#fecha_regOp").val(solicitudesCliente["Fecha_Registro"]);
            $("#fecha_entregaOp").val(solicitudesCliente["Fecha_Entrega"]);
            $("#estadoOp").val(solicitudesCliente["Id_Estado"]);
            //$("#lugarOp").val(lugarPrd);
            //$("#clienteOrdn").val();
        }
      });
    }


