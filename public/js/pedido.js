  $('#tablaPedidos').dataTable( {
    // "lengthChange": false,
    //"searching": false,
    // "info": false,
    "ordering": false,
      "language": {
          "emptyTable": "No hay pedidos para listar.",
          "info": "",
          "infoEmpty": "",
          "zeroRecords": "No se encontraron resultados.",
      "paginate": {"previous": "Anterior", "next": "Siguiente"}
      },
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]]
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
    $("#doc_cliente").select2({
      language: {
        noResults: function (params) {
        return "No hay resultados";
        }}
      });

    $('#tblFichasAsp').dataTable({
        "ordering": false,
        "language": {
            "emptyTable": "No hay productos para listar.",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Mostrando página _PAGE_ de _PAGES_",
            "zeroRecords": "No se encontraron productos que coincidan con la búsqueda.",
        "paginate": {"previous": "Anterior","next": "Siguiente"}
        }
      });

    $('#prodAsociarPedMod').dataTable({
        "ordering": false,
        "language": {
            "emptyTable": "No hay productos para listar.",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Mostrando página _PAGE_ de _PAGES_",
            "zeroRecords": "No se encontraron productos que coincidan con la búsqueda.",
        "paginate": {"previous": "Anterior","next": "Siguiente"}
        }
      });



    //valida que se asocie al menos una ficha al momento de registrar un pedido.
      function enviarFormPedido(){

        // var vlrproduccion = $("#vlr_produccion").val();
        var fecha_entrega = $("#fecha_entrega").val();
        var cliente = $("#id_cliente").val().trim();
        var fecha_regi = $("#fecha_reg").val();

        if (fecha_entrega <= fecha_regi) {
        Lobibox.notify('warning', {size: 'mini', msg: 'Debe ingresar una fecha superior a la fecha actual'});
        return false;
        }

        var res = true;
          idfichas = 0;
          cantidadaproducir = 0;
          $("#tablaFicha tbody .trpedidos").each(function(){
            idfichas = $(this).find("td").eq(9).html();
            idbton = $(this).find("td").eq(9).html();
            cantidadaproducir = $("#cantProducir"+idbton).val();

            bol = validarExistenciasIn(idfichas, cantidadaproducir, 0);
            if (bol == false) {
                res = false;
            }
          });

        //valida productos asociados al pedido
        if ($("#tablaFicha tbody tr #tblFichasVacia").length)
        {
          Lobibox.notify('warning', {size: 'mini', msg: 'Debe asociar al menos un producto al pedido'});
          return false;
        }
        return res;
      }


      //validaciones al momento de modificar un pedido
      function enviarFormPedidoModi(){
        var res = true;
        if ($(".trFichasAsoPedMod").length) {
          idfichas = 0;
          cantidadaproducir = 0;
          $("#tbl-prod-aso-ped tbody tr").each(function(){
            var idfichas = $(this).find("td").eq(8).html();
            // idbton = $(this).find("td").eq(0).html();
            cantidadaproducir = $("#cantDescInsUpdPed"+idfichas).val();
            var bol = validarExistenciasIn(idfichas, cantidadaproducir, 0);
            if (bol == false) {
                // Lobibox.notify('warning', {size: 'mini', msg: 'alerta unica 2'});
                res = false;
            }
          });
        }
        else{
          Lobibox.notify('warning', {size: 'mini', msg: 'Debe asociar al menos un producto al pedido'});
          return false;
        }
        if (res == false) {
          return false;
        }
        else{
          return true;
        }
        return false;      
      }

      //remueve de la tabla los productos asociados al pedido al momento de modificar
      function removerProductoAsoPedi(btn, elemento, subtotal){
        console.log(btn, elemento, subtotal);

        $("#tbl-prod-aso-ped").each(function(){
          if ($("#tbl-prod-aso-ped tbody .trFichasAsoPedMod").length < 2){
            var tr = "<tr><td id='tblFichasPedModVacia' colspan='9' style='text-align:center;'></td></tr>";
            $("#tbl-prod-aso-ped").append(tr);
            $("#tblFichasPedModVacia").html("No hay productos asociados.");
          }
        });

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
        $("#tablaFicha tbody .trpedidos").each(function(){
        var idbton = $(this).find("td").eq(9).html();
        total += parseFloat($("#capValor"+idbton).val());
        $("#vlr_total").val(total);
        });
      }

      $(document).ready(function(){
        $("#tblFichasVacia").html("No hay productos asociados.");
      });

      function quitarFicha(btn, elemento, subtotal){
        $("#tablaFicha").each(function(){
          if ($("#tablaFicha tbody .trpedidos").length < 2){
            var tr = "<tr><td id='tblFichasVacia' colspan='9' style='text-align:center;'></td></tr>";
            $("#tablaFicha").append(tr);
            $("#tblFichasVacia").html("No hay productos asociados.");
            }
        });
        
        var e = $(elemento).parent().parent();
        $(e).remove();
        boton = "#btn"+btn;
        $(boton).attr('disabled', false);
        valortotal = $("#vlr_total").val();
        desc = valortotal - subtotal;
        $("#vlr_total").val(desc);
      }

    //asocia productos al pedido
    function asociarProductos(idf, ref, color, vlrprodto, fichas, idbton, cantidad, nombColor, nombreProducto){

        var campos = $(fichas).parent().parent();
        $("#tablaFicha tbody tr #tblFichasVacia").remove();
        var tr = "<tr id=''class='box box-solid collapsed-box trpedidos'><td>"+ref+"</td><td>"+nombreProducto+"</td><td><i class='fa fa-square' style='color: "+color+"; font-size: 200%;' title='"+nombColor+"'></i></td><td>$"+vlrprodto+"</td><td><input type='number' id='cantProducir"+idbton+"' style='border-radius:5px;' maxlength='10' name='cantProducir[]' value='' data-parsley-required='' min='0'></td><td><input name='subTotal[]' readonly='' value='0' type='text' id='capValor"+idbton+"' style='border-radius:5px;' data-parsley-required='' min='1'></td>"    
        +"<td><input id='usarProductoT"+idbton+"' min='0' max='"+cantidad+"' type='number' style='border-radius:5px;' name='cantExisUsar[]' data-parsley-required='' value='0'></td>"
        +"<td><span id='spanCant"+idbton+"' class='badge bg-red'>"+cantidad+"</span></td>"
        +"<td style='display: none;'><input type='hidden' id='cantProductT"+idbton+"' name='cantProductT[]'></td><td style='display: none;'>"+idbton+"</td>"    
        +"<td><button type='button' onclick='quitarFicha("+idbton+", this, capValor"+idbton+".value)' class='btn btn-box-tool'><i style='font-size:150%;' class='fa fa-remove'></i></button></td><input type='hidden' name='idFicha[]' value="+idf+"></tr>";
    
        $("#tablaFicha").append(tr);

        boton = "#btn"+idbton;

        $(boton).attr('disabled', 'disabled');

        $("#cantProductT"+idbton).val(cantidad);
        $("#tablaFicha tbody .trpedidos").each(function(i){

          $("#spanCant"+idbton).on("click", function(){
              $("#spanCant"+idbton).html(cantidad);
              $("#usarProductoT"+idbton).val(0);
            });

          $("#usarProductoT"+idbton).on("keyup change", function(){
            if ($("#usarProductoT"+idbton).val() != "" && parseInt($("#usarProductoT"+idbton).val()) >= 0 && parseInt($("#usarProductoT"+idbton).val()) <= cantidad) {
              $("#capValor"+idbton).val((vlrprodto * $("#usarProductoT"+idbton).val()) + $("#cantProducir"+idbton).val() * vlrprodto);
              valorTotalPedido();
              $("#spanCant"+idbton).html(parseInt(cantidad) - parseInt($("#usarProductoT"+idbton).val()));
              $("#cantProductT"+idbton).val(parseInt($("#spanCant"+idbton).html()));
            }else{
              $("#spanCant"+idbton).html(cantidad);
              $("#capValor"+idbton).val($("#cantProducir"+idbton).val() * vlrprodto);
              valorTotalPedido();
            }
          });
        });

        $("#cantProducir"+idbton).on("keyup", function(){
            //
            $("#capValor"+idbton).val((vlrprodto * $("#usarProductoT"+idbton).val()) + $("#cantProducir"+idbton).val() * vlrprodto);
            
            //nueva
            var subtot = $("#cantProducir"+idbton).val() * vlrprodto;

            valorTotalPedido();
            validarExistenciasIn(idf, $("#cantProducir"+idbton).val(), 1);
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
            var arrayCantInsumos = "";
            arrayCantInsumos = resp.r;
            for (var i = 0; i <= arrayCantInsumos.length -1; i++)
            {
              var idExInscol = arrayCantInsumos[i]['Id_Existencias_InsCol'];
              var refer = arrayCantInsumos[i]['Referencia'];
              var nombreIns = arrayCantInsumos[i]['Nombre'];
              var nombreColor = arrayCantInsumos[i]['Nombre_Color'];
              var nomColorFicha = arrayCantInsumos[i]['NombreCol_Ficha'];
              var cantNecIns = arrayCantInsumos[i]['Cant_Necesaria'];
              var cantExistIns = arrayCantInsumos[i]['Cantidad_Insumo'];
              var cantNecPedido = cantNecIns * cantProdu;

              if (cantNecPedido > cantExistIns) {
                //alert("No hay suficiente "+nombreIns+" de color "+nombreColor);
                if (alerta == 1) {
                    Lobibox.notify('warning', {size: 'mini', msg: 'No hay suficiente '+nombreIns+' de color '+nombreColor});                
                }
                else if(alerta == 0){
                  // Lobibox.notify('warning', {size: 'mini', msg: 'alertas varias'});
                }
                  res = false;
              }
            }
            if (res == false && alerta == 0) {
              Lobibox.notify('warning', {size: 'mini', msg: 'No hay insumos suficientes para la ficha '+refer+' de color '+nomColorFicha});
              return false;
            }
            else{
              return true;
            }
            $("#cantDesc").val(cantNecPedido);
            $("#idExistColr").val(idExInscol);
          }
        }).fail(function(){});
          return res;
      }

      //asociar productos al modificar el pedido
      function asociarProductosModiPedido(idfichat, referencia, color, vlrproducto, productos, idbton, cantProdT, nombreProdut){
        
        //producto que se quiere agregar
        idProducNuevo = idfichat;

        //comparar con los que estan agregados
        producto = "#idProducto"+idfichat;
        valor = $(producto).val();

        // console.log(idProducNuevo, $(producto).val());
        if (idProducNuevo == $(producto).val()) {
          boton = "#btn"+idfichat;
          $(boton).attr('disabled', 'disabled');
        }
        else
        {
          tr = "<tr id='tr"+idfichat+
            "' class='box box-solid collapsed-box trFichasAsoPedMod'><td>"+referencia+
            "</td><td>"+nombreProdut+"</td><td><i class='fa fa-square' style='color:"+color+
            "; font-size: 150%;'></i></td><td><input type='number' min='0' id='cantProducir"+idfichat+
            "' name='cantProducir[]' value='0' style='border-radius:5px;' data-parsley-required=''><input type='hidden' id='cantDescInsUpdPed"+idfichat+"' name='cantDescInsUpdPed[]' value='0'><input type='hidden' name='cantDevolverInsUpdPed[]' id='cantDevolverInsUpdPed"+idfichat+"' value='0'></td><td>"
            +vlrproducto+"</td><td><input data-parsley-required='' min='0' readonly='' type='text' id='capValor"
            +idfichat+"' name='subTotal[]' for='cantProducir"+idfichat+
            "' style='border-radius:5px;' value='0'></td><td><input data-parsley-required='' name='cantUsarProTerUpdPed[]' id='cantUsarProTerUpdPed"+idfichat+"' style='border-radius:5px; width: 100%;' type='number' min='0' value='0'></td><td style='text-align: center;'><span id='spanUpdateProdPed"+idfichat+
            "' class='badge bg-red'>"+cantProdT+"</span><input type='hidden' id='intSpanUpdaProdPed"+idfichat+"' name='intSpanUpdaProdPed[]' value='"+cantProdT+"'></td><td><button type='button' class='btn btn-box-tool' onclick='removerProductoAsoPedi("+idfichat+", this, capValor"+idfichat+".value)' ><i class='fa fa-remove'></i></button></td><input type='hidden' id='idFicha"+idfichat+
            "' name='idFicha[]' value='"+idfichat+"'><td style='display: none;'>"
            +idfichat+"</td><td><input type='hidden' id='cantProdInicial"+idfichat+"' value='0'><input type='hidden' id='cantUsadaInicial"+idfichat+"' value='0'><input type='hidden' id='cantProdTerInicial"+idfichat+"' value='"+cantProdT+"'></td></tr>";
          $("#tblFichasPedModVacia").remove();
          $("#tbl-prod-aso-ped").append(tr);
          changeValCantUpdateFichPedidos();
          boton = "#btn"+idfichat;
          $(boton).attr('disabled', 'disabled');
        }
      }

      function limpiarFormRegPedido(){
        valor = 0;
        $(".subtl").each(function(){
          $(this).val(valor);
        });
        $("#vlr_total").val(valor);

        $("#tablaFicha tbody .trpedidos").remove();
        var tr = "<tr><td id='tblFichasVacia' colspan='9' style='text-align:center;'></td></tr>";
        $("#tablaFicha").append(tr);
        $("#tblFichasVacia").html("No hay productos asociados");
        $(".btnfichas").attr('disabled', false);
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
        $("#nombreCliente").val(campos.find("td").eq(2).text());
        var $fechaEntre = $("#fecha_entrega").val(campos.find("td").eq(3).text());
        $("#fecha_entrega").on('blur', function(ev){
          if (!$.trim($fechaEntre.val())) {
              $fechaEntre.val(campos.find("td").eq(3).text());
            }
        });
        $("#estado").val(campos.find("td").eq(4).text());
        $("#valor_total").val(campos.find("td").eq(5).text());
        $("#doc_cliente").val(numDocumento).trigger("change");
        // $("#doc_cliente").select2('data');
        // console.log(data.text);
        $("#modalEditPedido").show();
      }

      // function cancelar(){
      //   swal({title: "¿Está seguro de cancelar?", 
      //     text: "Los cambios realizados no se guardaran!", 
      //     type: "warning", 
      //     showCancelButton: true,
      //     cancelButtonText: 'No',
      //     confirmButtonColor: "#DD6B55", 
      //     confirmButtonText: "Si", 
      //     closeOnConfirm: false 
      //     },
      //     function(){
      //       // location.href = uri+"ficha/consFicha";
      //       swal.close();
      //       $('#mdlEditOrdenP').modal('toggle');
      //       $('#modalEditPedido').modal('toggle');
      //   });
      // }
      
     //carga productos asociados al pedido
      function cargarProductosAsoPed(idped, fechaTerm, modalPa){
        $.ajax({
          type: 'post',
          dataType: 'json',
          url: uri+"ctrPedido/cargarProAsoPedido",
          data:{idPed: idped}
        }).done(function(respuesta){
          if (respuesta.r != null) {
              $("#tbl-prod-aso-ped tbody").empty();
              $("#dll-prod-asoped > tbody tr").empty();
              $('#dtlle-pedido-prod > tbody tr').empty();
              $('#tblFichasProd > tbody tr').empty();
              $('#tblFichasProducc > tbody tr').empty();

              var arrayProductos = respuesta.r;
              var cont = 0;
              $("#agregarFichaProd tbody").empty();
              for (var i = 0; i <= arrayProductos.length - 1; i++) {

                var id_fichat = arrayProductos[i]['Id_Ficha_Tecnica'];
                var idProducto = arrayProductos[i]['Referencia'];
                var color = arrayProductos[i]['Codigo_Color'];
                var nomColor = arrayProductos[i]['nomColor'];
                var nombreProdu = arrayProductos[i]['Nombre'];
                var vlrProducto = arrayProductos[i]['Valor_Producto'];
                var cantProducir = arrayProductos[i]['Cantidad_Producir'];
                var id_solic_produc = arrayProductos[i]['Id_Solicitudes_Producto'];
                var subtotal = arrayProductos[i]['Subtotal'];

                var cantUsar = arrayProductos[i]['Cantidad_Existencias'];
                var cantProdTerminado = arrayProductos[i]['Cantidad'];

                var tr ="";
                if (modalPa == 1) {
                  tr = "<tr id='tr"+id_fichat+
                  "' class='box box-solid collapsed-box trFichasAsoPedMod'><td>"+idProducto+
                  "</td><td>"+nombreProdu+"</td><td><i class='fa fa-square' style='color:"+color+
                  "; font-size: 200%;' title='"+nomColor+"'></i></td><td><input data-parsley-required='' type='number' min='0' id='cantProducir"+id_fichat+
                  "' name='cantProducir[]' value='"+cantProducir+"' style='border-radius:5px;'><input type='hidden' id='cantDescInsUpdPed"+id_fichat+"' name='cantDescInsUpdPed[]' value='0'><input type='hidden' name='cantDevolverInsUpdPed[]' id='cantDevolverInsUpdPed"+id_fichat+"' value='0'></td><td>"
                  +vlrProducto+"</td><td><input data-parsley-required='' min='0' readonly='' type='text' id='capValor"
                  +id_fichat+"' name='subTotal[]' for='cantProducir"+id_fichat+
                  "' style='border-radius:5px;' value='"+subtotal+
                  "'></td><td><input data-parsley-required='' name='cantUsarProTerUpdPed[]' id='cantUsarProTerUpdPed"+id_fichat+"' style='border-radius:5px; width: 100%;' type='number' min='0' value='"+cantUsar+"'></td><td style='text-align: center;'><span id='spanUpdateProdPed"+id_fichat+
                  "' class='badge bg-red'>"+cantProdTerminado+"</span><input type='hidden' id='intSpanUpdaProdPed"+id_fichat+"' name='intSpanUpdaProdPed[]' value='"+cantProdTerminado+"'></td><td><button type='button' class='btn btn-box-tool' onclick='removerProductoAsoPedi("+id_fichat+", this, capValor"+id_fichat+".value)' ><i style='font-size:150%;' class='fa fa-remove'></i></button></td><input type='hidden' id='idFicha"+id_fichat+
                  "' name='idFicha[]' value='"+id_fichat+"'><td style='display: none;'>"
                  +id_fichat+"</td><td style='display:none;'><input type='hidden' id='cantProdInicial"+id_fichat+"' value='"+cantProducir+"'><input type='hidden' id='cantUsadaInicial"+id_fichat+"' value='"+cantUsar+"'><input type='hidden' id='cantProdTerInicial"+id_fichat+"' value='"+cantProdTerminado+"'></td></tr>";
                  $('#tbl-prod-aso-ped').append(tr);
                }
                else if(modalPa == 2)
                {
                  tr = "<tr class='box box-solid collapsed-box'><td style='display: none;'>"+id_solic_produc+"</td><td>"+(cont+=1)+
                  "</td><td>"+idProducto+"</td><td>"+nombreProdu+"</td><td><i class='fa fa-square' style='color:"+color+
                  "; font-size: 200%;' title='"+nomColor+"'></i></td><td>"+nomColor+"</td><td>"+cantProducir+
                  "</td><td>$"+vlrProducto+"</td><td>$"+subtotal+"</td></tr>";
                  $('#tblFichasProd tbody').append(tr);
                  $('#tblFichasProducc').append(tr);
                  $('#fecha_terminacion').val(fechaTerm);
                  $('#selectLugarProducc').removeAttr("disabled");

                  //enviamos id_solicitud a input hidden
                  $('#id_solicitud').val(idped);
                }
                else
                {
                  tr = "<tr class='box box-solid collapsed-box'><td>"+idProducto+"</td><td><i class='fa fa-square' style='color:"+color+"; font-size: 200%;' title='"+nomColor+"'></td><td>"+nombreProdu+"</td><td style='text-align: center;'>"+cantProducir+"</td><td style='text-align: center;'>"+cantUsar+"</td><td>$"+vlrProducto+"</td><td>$"+subtotal+"</td></tr>";
                  $('#dll-prod-asoped').append(tr);
                  $('#dtlle-pedido-prod').append(tr);
                }
              }
              changeValCantUpdateFichPedidos();
            }
        }).fail(function(){

        });
      }


function changeValCantUpdateFichPedidos(){
  $("#tbl-prod-aso-ped tbody tr").each(function(){
    var idFicha = $(this).find("td").eq(8).html();
    var valorProducto = parseFloat($(this).find("td").eq(3).html());

    var cantProducirInicial = parseInt($("#cantProdInicial"+idFicha).val());
    var cantUsarIniciar = parseInt($("#cantUsadaInicial"+idFicha).val());
    var ProducTermInicial = parseInt($("#cantProdTerInicial"+idFicha).val());

    console.log(cantProducirInicial, cantUsarIniciar, ProducTermInicial);

    $("#cantUsarProTerUpdPed"+idFicha).attr("max", (cantUsarIniciar + ProducTermInicial));
    
    $("#cantProducir"+idFicha).on("keyup change", function(){
      $("#capValor"+idFicha).val((valorProducto * $(this).val()) + (valorProducto * $("#cantUsarProTerUpdPed"+idFicha).val()));
      calcValTotUpdPed();
      validarExistenciasIn(idFicha, ($(this).val() - cantProducirInicial), 1);
      if ($(this).val() > cantProducirInicial) {
        $("#cantDescInsUpdPed"+idFicha).val($(this).val() - cantProducirInicial);
        $("#cantDevolverInsUpdPed"+idFicha).val(0);
      }else if($(this).val() < cantProducirInicial){
        $("#cantDevolverInsUpdPed"+idFicha).val(cantProducirInicial - $(this).val());
        $("#cantDescInsUpdPed"+idFicha).val(0);
      }else{
        $("#cantDescInsUpdPed"+idFicha).val(0);
        $("#cantDevolverInsUpdPed"+idFicha).val(0);
      }
    });

    $("#cantUsarProTerUpdPed"+idFicha).on("keyup change", function(){
      $("#capValor"+idFicha).val((valorProducto * $(this).val()) + (valorProducto * $("#cantProducir"+idFicha).val()));
      if ($(this).val() >= cantUsarIniciar) {
        if ($(this).val() <= (cantUsarIniciar + ProducTermInicial)) {
          $("#spanUpdateProdPed"+idFicha).html(ProducTermInicial - ($(this).val() - cantUsarIniciar));
          $("#intSpanUpdaProdPed"+idFicha).val(ProducTermInicial - ($(this).val() - cantUsarIniciar));
        }else{
          $("#spanUpdateProdPed"+idFicha).html(0);
          $("#intSpanUpdaProdPed"+idFicha).val(0);
        }
      }else{
        if ($(this).val() >= 0) {
          $("#spanUpdateProdPed"+idFicha).html(ProducTermInicial + (cantUsarIniciar - $(this).val()));
          $("#intSpanUpdaProdPed"+idFicha).val(ProducTermInicial + (cantUsarIniciar - $(this).val()));
        }else{
          $("#spanUpdateProdPed"+idFicha).html(cantUsarIniciar + ProducTermInicial);
          $("#intSpanUpdaProdPed"+idFicha).val(cantUsarIniciar + ProducTermInicial);
        }
      }
      calcValTotUpdPed();
    });
  });

  function calcValTotUpdPed(){
    var valTot = 0;
    $("#tbl-prod-aso-ped tbody tr").each(function(){
      var idFicha = $(this).find("td").eq(8).html();
      valTot += parseFloat($("#capValor"+idFicha).val());
    });
    $("#valor_total").val(valTot);
  }
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
          closeOnCancel: true },
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

      $("#frmRegPedido").parsley();
