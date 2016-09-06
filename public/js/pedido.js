	$('#tablaPedidos').DataTable( {
    // "lengthChange": false,
    //"searching": false,
    // "info": false,
    "ordering": false
  });

  $('#fecha_entrega').datepicker({
          format: "yyyy-mm-dd",
          language: 'es',
          autoclose: true
          // todayBtn: true
        }).on(
          'show', function() {      
          // Obtener valores actuales z-index de cada elemento
          var zIndexModal = $('#modalEditPedido').css('z-index');
          var zIndexFecha = $('.datepicker').css('z-index');
          // Re asignamos el valor z-index para mostrar sobre la ventana modal
          $('.datepicker').css('z-index',zIndexModal+1);
        });

  //calcula el valor total del pedido cuando se modifica la asociación de los productos(fichas)
    function calcularVlrTotalPed(){
    	var total=0;
        $(".subtotal").each(function(){
          total=total+parseFloat($(this).val());
        });
        $("#valor_total").val(total);
    }

    //permite seleccionar y asociar un cliente al pedido
    $("#id_cliente").select2({
        placeholder: 'Seleccionar',
        language: {
        noResults: function (params) {
        return "No hay resultados";
        }}
    });

    //permite seleccionar y asociar un cliente al pedido al momento de modificar
    $(document).ready(function(){
    $("#doc_cliente").select2({
      language: {
        noResults: function (params) {
        return "No hay resultados";
        }}
      });
    });

    //valida que se asocie al menos una ficha al momento de registrar un pedido.
      function enviarFormPedido(){

        // var vlrproduccion = $("#vlr_produccion").val();
        var fecha_entrega = $("#fecha_entrega").val();
        var cliente = $("#id_cliente").val().trim();

        var res = true;
        
          idfichas = 0;
          cantidadaproducir = 0;
          $("#tablaFicha tbody tr").each(function(){
            idfichas = $(this).find("td").eq(8).html();
            idbton = $(this).find("td").eq(8).html();
            cantidadaproducir = $("#cantProducir"+idbton).val();

            bol = validarExistenciasIn(idfichas, cantidadaproducir, 0);
            if (bol == false) {
                res = false;
            }
          });

        if (fecha_entrega === '') {
          Lobibox.notify('error', {size: 'mini', rounded: true, delayIndicator: false, msg: 'Debe ingresa una fecha de entrega'});
          return false;
        }
        if (cliente === '') {
          Lobibox.notify('error', {size: 'mini', rounded: true, delayIndicator: false, msg: 'Debe seleccionar un cliente'});
          return false;
        }
      
        if ($("#tablaFicha >tbody >tr").length == 0)
        {
          // swal({title: "0 Insumos Asociados", text: "Por favor asocie al menos un insumo a esta ficha.",   imageUrl: uri+"img/stop.png"});
          Lobibox.notify('error', {size: 'mini', rounded: true, delayIndicator: false, msg: 'Debe asociar al menos una ficha al pedido'});
          //retornar false no permite que se envie el formulario
          return false;
        }
        return res;
      }


      //validaciones al momento de modificar un pedido
      function enviarFormPedidoModi(){
        var res = true;
        if ($("#tbl-prod-aso-ped >tbody >tr").length != 0) {
          idfichas = 0;
          cantidadaproducir = 0;
          $("#tbl-prod-aso-ped tbody tr").each(function(){
            idfichas = $(this).find("td").eq(6).html();
            idbton = $(this).find("td").eq(0).html();
            cantidadaproducir = $("#cantProducir"+idbton).val();

            bol = validarExistenciasIn(idfichas, cantidadaproducir, 0);
            if (bol == false) {
                res = false;
            }
          });
        }else{
          swal({title: "0 Fichas Asociadas", 
            text: "Por favor asocie al menos una ficha al pedido.",   
            imageUrl: uri+"img/stop.png"
          });
          res = false;
        }

        return res;      
      }


      //remueve de la tabla los productos asociados al pedido al momento de modificar
      function removerProductoAsoPedi(btn, elemento, subtotal){
        var e = $(elemento).parent().parent();
        $(e).remove();
        boton = "#btn"+btn;
        $(boton).attr('disabled', false);
        valortotal = $("#valor_total").val();
        desc = valortotal - subtotal;
        $("#valor_total").val(desc);
      }

      //calcula el valor total del pedido
      function valorTotalPedido(){
        var total = 0;
        $("#tablaFicha tbody tr").each(function(){
        var idbton = $(this).find("td").eq(8).html();
        total += parseFloat($("#capValor"+idbton).val());
        $("#vlr_total").val(total);
        });
      }

    //asocia productos al pedido
    function asociarProductos(idf, ref, color, vlrprodto, fichas, idbton, cantidad){
        var campos = $(fichas).parent().parent();
        $("#agregarFicha").removeAttr("hidden");
        var tr = "<tr class='box box-solid collapsed-box'><td id=''>"+ref+"</td><td><i class='fa fa-square' style='color: "+color+"; font-size: 150%;'></i></td><td>"+vlrprodto+"</td><td><input type='text' id='cantProducir"+idbton+"' style='border-radius:5px;' name='cantProducir[]' value='0'></td><td><input type='hidden' name='subTotal[]' id='subt"+idbton+"'value='0'>$<input readonly='' value='0' type='text' id='capValor"+idbton+"' name='res"+idbton+"' for='cantProducir"+idbton+"' style='border-radius:5px;'></td>"    
        +"<td><input id='usarProductoT"+idbton+"' min='0' max='"+cantidad+"' type='text' style='border-radius:5px;'></td>"
        +"<td><span id='spanCant"+idbton+"' class='badge bg-red'>"+cantidad+"</span></td>"
        +"<td style='display: none;'><input type='hidden' id='cantProductT"+idbton+"' name='cantProductT[]'></td><td style='display: none;'>"+idbton+"</td>"    
        +"<td><button type='button' onclick='quitarFicha("+idbton+", this, res"+idbton+".value)' class='btn btn-box-tool'><i class='fa fa-remove'></i></button></td><input type='hidden' name='idFicha[]' value="+idf+"></tr>";
        
        //var tr2 = "<tr class='box box-solid collapsed-box'><td id=''>"+ref+"</td><td><i class='fa fa-square' style='color: "+color+"; font-size: 150%;'></i></td><td>"+vlrprodto+"</td><td><input type='text' min='1' id='cantProducir"+idbton+"' value='0' onchange='res"+idbton+".value=cantProducir"+idbton+".value * "+vlrprodto+"; subt"+idbton+".value=parseFloat(res"+idbton+".value); valorTotalPedido();' style='border-radius:5px;' name='cantProducir[]'></td><td><input valorTotalPedido type='hidden' name='subTotal[]' id='subt"+idbton+"'value='0'>$<input readonly='' type='text' id='capValor"+idbton+"' name='res"+idbton+"' for='cantProducir"+idbton+"' style='border-radius:5px;'></td><td><button type='button' onclick='quitarFicha("+idbton+", this, res"+idbton+".value)' class='btn btn-box-tool'><i class='fa fa-remove'></i></button></td><input type='hidden' name='idFicha[]' value="+ref+"></tr>";
        
        $("#tablaFicha").append(tr);
        boton = "#btn"+idbton;
        // cantProd = "#cantProducir"+idbton;
        // subt = "#capValor"+idbton;

        $(boton).attr('disabled', 'disabled');

        $("#tablaFicha tbody tr").each(function(){
          $("#cantProducir"+idbton).on("keyup", function(){

            //
            $("#capValor"+idbton).val((vlrprodto * $("#usarProductoT"+idbton).val()) + $("#cantProducir"+idbton).val() * vlrprodto);
            
            //nueva
            var subtot = $("#cantProducir"+idbton).val() * vlrprodto;
            $("#subt"+idbton).val(subtot);

            valorTotalPedido();
            validarExistenciasIn(idf, $("#cantProducir"+idbton).val(), 1);
          });

          $("#spanCant"+idbton).on("click", function(){
              $("#spanCant"+idbton).html(cantidad);
              $("#usarProductoT"+idbton).val(0);
            });

          $("#usarProductoT"+idbton).on("keyup", function(){
            if ($("#usarProductoT"+idbton).val() != "" && parseInt($("#usarProductoT"+idbton).val()) >= 0 && parseInt($("#usarProductoT"+idbton).val()) <= cantidad) {
              $("#capValor"+idbton).val((vlrprodto * $("#usarProductoT"+idbton).val()) + $("#cantProducir"+idbton).val() * vlrprodto);
              valorTotalPedido();
              $("#spanCant"+idbton).html(parseInt(cantidad) - parseInt($("#usarProductoT"+idbton).val()));
              $("#cantProductT"+idbton).val($("#spanCant"+idbton).html());
            }else{
              $("#spanCant"+idbton).html(cantidad);
              $("#capValor"+idbton).val($("#cantProducir"+idbton).val() * vlrprodto);
              valorTotalPedido();
            }
          });
        });
      }

      //función que permite validar cada uno de los insumos de cada una de las fichas que se van a registrar en un pedido
      function validarExistenciasIn(idfi, cantProdu, alerta){
        var res = true;
        $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ctrPedido/validaExistInsumos",
            data: {id_fichat:idfi},
            async: false
        }).done(function(resp){
          if (resp.r != null){
            var arrayCantInsumos = resp.r;
            for (var i = 0; i <= arrayCantInsumos.length -1; i++)
            {
              var idExInscol = arrayCantInsumos[i]['Id_Existencias_InsCol'];
              var nombreIns = arrayCantInsumos[i]['Nombre'];
              var nombreColor = arrayCantInsumos[i]['Nombre_Color'];
              var cantNecIns = arrayCantInsumos[i]['Cant_Necesaria'];
              var cantExistIns = arrayCantInsumos[i]['Cantidad_Insumo'];
              var cantNecPedido = cantNecIns * cantProdu;
              if (cantNecPedido > cantExistIns) {
                //alert("No hay suficiente "+nombreIns+" de color "+nombreColor);
                if (alerta == 1) {
                  Lobibox.notify('error', {size: 'mini', rounded: true, delayIndicator: false, msg: 'No hay suficiente '+nombreIns+' de color '+nombreColor});
                }else if(alerta == 0){
                  Lobibox.notify('error', {size: 'mini', rounded: true, delayIndicator: false, msg: 'No hay'});
                }
                res = false;
              }
            }
            $("#cantDesc").val(cantNecPedido);
            $("#idExistColr").val(idExInscol);
          }
        }).fail(function(){});
          return res;
      }

      //asociar productos al modificar el pedido
      function asociarProductosModiPedido(idfichat, referencia, color, vlrproducto, productos, idbton){
        
        //producto que se quiere agregar
        idProducNuevo = idfichat;

        //comparar con los que estan agregados
        producto = "#idProducto"+referencia;
        valor = $(producto).val();

        if (idProducNuevo == $(producto).val()) {
          boton = "#btn"+referencia;
          $(boton).attr('disabled', 'disabled');
        }
        else
        {
          var tr = "<tr class='box box-solid collapsed-box'><td id=''>"+referencia+"</td><td><i class='fa fa-square' style='color: "+color+"; font-size: 150%;'></i></td><td><input type='text' min='1' id='cantProducir"+referencia+"' name='cantProducir[]' value='0' onkeyup='res"+referencia+".value=cantProducir"+referencia+".value * "+vlrproducto+"; subt"+referencia+".value=parseFloat(res"+referencia+".value); calcularVlrTotalPed(); validarExistenciasIn("+idfichat+", cantProducir"+referencia+".value, 1);' style='border-radius:5px;'></td><td>$"+vlrproducto+"</td><td><input class='subtotal' type='hidden' name='subtotal[]' id='subt"+referencia+"'value='0'><input readonly='' type='text' id='capValor"+referencia+"' name='res"+referencia+"' for='cantProducir"+referencia+"' style='border-radius:5px;'></td><td><button type='button' onclick='removerProductoAsoPedi("+referencia+", this, subt"+referencia+".value)' class='btn btn-box-tool'><i class='fa fa-remove'></i></button></td><input type='hidden' id='idProducto"+referencia+"' name='idProducto[]' value="+idfichat+"><td style='display: none;'>"+idfichat+"</td></tr>";
          $("#tbl-prod-aso-ped").append(tr);
          boton = "#btn"+referencia;
          $(boton).attr('disabled', 'disabled');
        }
      }

      function limpiarFormRegPedido(){
        valor = 0;
        $(".subtl").each(function(){
          $(this).val(valor);
        });
        $("#vlr_total").val(valor);
      }

      //Asociar cliente
      function asociarCliente(nombre, id_cliente, clientes, idbotonc){

        var campos = $(clientes).parent().parent();
        $("#nombre").val(nombre);
        $("#id_cliente").val(id_cliente);
        // boton = "#btnAgregar"+idbotonc;
        // $(boton).attr('disabled', 'disabled');
        // clienteAgregado = $("#id_cliente").val();
        // if (id_cliente != clienteAgregado) {}
      }

      function asoClienteModifPedido(nombrecliente, idCliente, clientes){
        $("#nombreCliente").val(nombrecliente);
        $("#doc_cliente").val(idCliente);
      }

      function editarPedido(id, pedidos, numDocumento, nombrecliente){
        var campos = $(pedidos).parent().parent();
        $("#id_pedido").val(campos.find("td").eq(0).text());
        $("#fecha_reg").val(campos.find("td").eq(1).text());
        $("#fecha_entrega").val(campos.find("td").eq(2).text());
        $("#valor_total").val(campos.find("td").eq(3).text());
        $("#estado").val(campos.find("td").eq(4).text());
        $("#doc_cliente").val(numDocumento).trigger("change");
        // $("#doc_cliente").select2('data');
        // console.log(data.text);
        $("#nombreCliente").val(campos.find("td").eq(5).text());
        $("#modalEditPedido").show();
      }

      function cancelar(){
        swal({title: "¿Está seguro de cancelar?", 
          text: "Los cambios realizados no se guardaran!", 
          type: "warning", 
          showCancelButton: true,
          cancelButtonText: 'No',
          confirmButtonColor: "#DD6B55", 
          confirmButtonText: "Si", 
          closeOnConfirm: false 
          },
          function(){
            // location.href = uri+"ficha/consFicha";
            swal.close();
            $('#mdlEditOrdenP').modal('toggle');
            $('#modalEditPedido').modal('toggle');
        });
      }
      
     //carga productos asociados al pedido
      function cargarProductosAsoPed(idped, fechaTerm, modalPa){
        $.ajax({
          type: 'post',
          dataType: 'json',
          url: uri+"ctrPedido/cargarProAsoPedido",
          data:{idPed: idped}
        }).done(function(respuesta){
          if (respuesta.r != null) {
              $("#tbl-prod-aso-ped > tbody tr").empty();
              $("#dll-prod-asoped > tbody tr").empty();
              $('#dtlle-pedido-prod > tbody tr').empty();
              $('#tblFichasProd > tbody tr').empty();
              $('#tblFichasProducc > tbody tr').empty();

              arrayProductos = respuesta.r;
              for (var i = 0; i <= arrayProductos.length - 1; i++) {

                id_fichat = arrayProductos[i]['Id_Ficha_Tecnica'];
                idProducto = arrayProductos[i]['Referencia'];
                color = arrayProductos[i]['Codigo_Color'];
                vlrProducto = arrayProductos[i]['Valor_Producto'];
                cantProducir = arrayProductos[i]['Cantidad_Producir'];
                id_solic_produc = arrayProductos[i]['Id_Solicitudes_Producto'];
                subtotal = arrayProductos[i]['Subtotal'];
                var tr ="";
                if (modalPa == 1) {
                  tr = "<tr id='tr"+idProducto+"' class='box box-solid collapsed-box'><td>"+idProducto+"</td><td><i class='fa fa-square' style='color:"+color+"; font-size: 150%;'></i></td><td><input type='text' min='1' id='cantProducir"+idProducto+"' name='cantProducir[]' value='"+cantProducir+"' onkeyup='res"+idProducto+".value=cantProducir"+idProducto+".value * "+vlrProducto+"; subt"+idProducto+".value=parseFloat(res"+idProducto+".value); calcularVlrTotalPed(); validarExistenciasIn("+id_fichat+", cantProducir"+idProducto+".value, 1);' style='border-radius:5px;'></td><td>$"+vlrProducto+"</td><td><input class='subtotal' type='hidden' name='subtotal[]' id='subt"+idProducto+"' value='"+subtotal+"'><input readonly='' type='text' id='capValor"+idProducto+"' name='res"+idProducto+"' for='cantProducir"+idProducto+"' style='border-radius:5px;' value='"+subtotal+"'></td><td><button type='button' class='btn btn-box-tool' onclick='removerProductoAsoPedi("+idProducto+", this, subt"+idProducto+".value)' ><i class='fa fa-remove'></i></button></td><input type='hidden' id='idProducto"+idProducto+"' name='idProducto[]' value='"+id_fichat+"'><td style='display: none;'>"+id_fichat+"</td></tr>";
                  $('#tbl-prod-aso-ped').append(tr);
                }
                else if(modalPa == 2)
                {
                  $("#agregarFichaProd").removeAttr("hidden");
                  tr = "<tr class='box box-solid collapsed-box'><input type='hidden' value='"+id_solic_produc+"' name='id_solic_prodcto[]'><input type='hidden' value='"+id_fichat+"' name='id_fichaTec[]'><td>"+idProducto+"</td><td><i class='fa fa-square' style='color:"+color+"; font-size: 150%;'></td><td><input type='text' readonly value='"+cantProducir+"' id='cantProducirPed"+id_fichat+"' name='cantProducirPed[]'></td><td>$"+vlrProducto+"</td><td>"+subtotal+"</td><td><input type='checkbox' id='chb"+id_fichat+"' onchange='prueba(cantSatelite"+id_fichat+", chb"+id_fichat+", confirmar"+id_fichat+", cancelarCant"+id_fichat+")'><input type='text' value='0' style='display:none' id='cantSatelite"+id_fichat+"' name='cantSatelite[]'><button style='display:none' type='button' id='confirmar"+id_fichat+"' class='btn btn-box-tool' onclick='confirmarCantSat(cantProducirPed"+id_fichat+".value, cantSatelite"+id_fichat+".value, cantProducirPed"+id_fichat+", cantSatelite"+id_fichat+", confirmar"+id_fichat+")'><i class='fa fa-check fa-lg'></i></button><button style='display:none' type='button' id='cancelarCant"+id_fichat+"' class='btn btn-box-tool' onclick='cancelarCantSat(cancelarCant"+id_fichat+", cantSatelite"+id_fichat+", chb"+id_fichat+", cantProducirPed"+id_fichat+", cantProducirPed"+id_fichat+".value, cantSatelite"+id_fichat+".value, confirmar"+id_fichat+")'><i class='fa fa-remove fa-lg'></i></button></td></tr>";
                  $('#tblFichasProd').append(tr);
                  $('#tblFichasProducc').append(tr);
                  $('#fecha_terminacion').val(fechaTerm);

                  //enviamos id_solicitud a input hidden
                  $('#id_solicitud').val(idped);
                }
                else
                {
                  tr = "<tr class='box box-solid collapsed-box'><td>"+idProducto+"</td><td><i class='fa fa-square' style='color:"+color+"; font-size: 150%;'></td><td>"+cantProducir+"</td><td>$"+vlrProducto+"</td><td>"+subtotal+"</td></tr>";
                  $('#dll-prod-asoped').append(tr);
                  $('#dtlle-pedido-prod').append(tr);
                }
              }
            }
        }).fail(function(){

        })
      }

      function confirmarCantSat(cantProduc, cantSatel, cantProduId, cantSatelId, btnconf)
      { 
          $(cantProduId).val(cantProduc - cantSatel);
          $(cantSatelId).attr("readonly", 'readonly');
          $(cantSatelId).css("background", '#eee');
          $(btnconf).css("display", 'none');

      }

      function cancelarCantSat(btcancl, cantidSt, checkb, cantProducirId, cantP, cantSt, btConfm)
      {
          $(checkb).removeAttr("style");
          $(checkb).removeAttr("checked");
          $(btcancl).css("display", 'none');
          $(cantidSt).css("display", 'none');
          $(cantidSt).val(0);
          $(btConfm).css("display", 'none');
          $(cantProducirId).val(parseInt(cantP)+parseInt(cantSt));
      }

      function prueba(inputCantidadSat, checkbox, btnconfm, btncancl)
      {
        // console.log(inputCantidadSat, checkbox, cantProdu);
        
        $("#tblFichasProd tbody tr").each(function(){
          if($(checkbox).is(":checked"))
          {
            $(checkbox).css("display", 'none');
            $(inputCantidadSat).removeAttr("style");
            $(inputCantidadSat).removeAttr("readonly");
            $(btnconfm).removeAttr("style");
            $(btncancl).removeAttr("style");
            // var resta = cantidSatelite - cantProdu;
            // console.log(resta);
          }
          else
          {
            $(inputCantidadSat).css("display", 'none');
            // $("#cantidadSat").css("display", 'none');
          }       
        });
      }



      function calcularVlrTotalPed2(idbton){
        var total = 0;
        $("#tbl-prod-aso-ped tbody tr").each(function(){
          // var idbton = $(this).find("td").eq(4).html();
          total += parseFloat($("#capValor"+idbton).val());
          $("#valor_total").val(total);
        });
      }

      function cancelarPedido(idpedido){

        swal({
          title: "¿Está seguro de cancelar este pedido?",   
          text: "El pedido quedará en estado cancelado!",  
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Sí, cancelar pedido",
          cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: false },
          function(isConfirm){
            if (isConfirm)
            { 
              $.ajax({
            type: 'post',
            dataType: 'json',
            url: uri+"ctrPedido/cancelarPedido",
            data:{id_Pedido: idpedido}
            }).done(function(respuesta){
              if (respuesta.r == 1) {
                // swal("Cancelado", "El Pedido ha sido cancelado", "success");
                // location.href = uri+"ctrPedido/consPedido";
              }else{
                alert("Error al cancelar el pedido");
              }
            }).fail(function(){
            })  
              swal("Cancelado", "El Pedido ha sido cancelado", "success");
              location.href = uri+"ctrPedido/consPedido";
            }
            else
            {
              swal("Acción interrumpida", "No se completó la acción.", "error");
            }
          });
        }