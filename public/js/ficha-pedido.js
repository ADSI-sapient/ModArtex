        $('#fecha_entrega').datepicker({
          format: "yyyy-mm-dd",
          language: "es",
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

        $("#selectTallas").select2({
        });
        
        $("#id_cliente").select2({
          placeholder: 'Seleccionar'
        });

        $("#colorFicha").select2({});
        // $("#colorModFicha").select2({});

        // $("#doc_cliente").select2().on('show', function(){
        //   // Obtener valores actuales z-index de cada elemento
        //   var zIndexModal = $('#modalEditPedido').css('z-index');
        //   var zIndexFecha = $('.select2').css('z-index');
        //   // Re asignamos el valor z-index para mostrar sobre la ventana modal
        //   $('.select2').css('z-index',zIndexModal+1);
        // });

      var options = {
        valueNames: ['ref', 'color', 'stock', 'fecha_reg', 'estado']
      };

      //edita la información de una ficha técnica
      function editarFicha(referencia, fichas, idColor){
        var campos = $(fichas).parent().parent();
        $("#idFicha_Tec").val(referencia);
        $("#referencia").val(campos.find("td").eq(0).text());
        $("#fecha_reg").val(campos.find("td").eq(1).text());
        $("#estado").val(campos.find("td").eq(2).text());
        $("#colorModFicha").val(idColor);
        $("#stock_min").val(campos.find("td").eq(4).text());
        $("#vlr_produccion").val(campos.find("td").eq(5).text());
        $("#vlr_producto").val(campos.find("td").eq(6).text());
        $("#mdEditFicha").show();
      }

      function valorProduccion(){
        var total=0;
        $(".subtotal").each(function(){
          total=total+parseFloat($(this).val());
        });
        $("#vlr_produccion").val(total);
      }

      //calcula el valor total del pedido cuando se modifica la asociación de los productos(fichas)
      function calcularVlrTotalPed(){
        var total=0;
        $(".subtotal").each(function(){
          total=total+parseFloat($(this).val());
        });
        $("#valor_total").val(total);
      }

      function quitarInsumo(btn, elemento, subtotal){
        var e = $(elemento).parent().parent();
        $(e).remove();
        boton = "#btn"+btn;
        $(boton).attr('disabled', false);
        valortotal = $("#vlr_produccion").val();
        desc = valortotal - subtotal;
        $("#vlr_produccion").val(desc);
      }

      //funcion que asocia insumos al momento de registrar una ficha
      function asociarInsumosHab(id_insumo, nombre, color, insumos, idbton, estado, valorPromedio, unidadMed){
        var campos = $(insumos).parent().parent();
        valorcm = valorPromedio / 100;
        valorcm = Math.round(valorcm);
        $("#agregarInsumo").removeAttr("hidden");
        var tr = "<tr class='box box-solid collapsed-box'><td>"+id_insumo+"</td><td>"+nombre+"</td><td><i class='fa fa-square' style='color: "+color+"; font-size: 150%;'></i></td><td>"+unidadMed+"</td><td><p>$ "+valorcm+"</p></td><td><input type='number' min='1' id='cantNec"+idbton+"' name='cantNecesaria[]' value='0' onchange='res"+idbton+".value=cantNec"+idbton+".value * "+valorcm+"; subt"+idbton+".value=parseFloat(res"+idbton+".value); valorProduccion();' style='border-radius:5px;'>cm</td><td><input class='subtotal' type='hidden' name='valorInsumo[]' id='subt"+idbton+"'value='0'>$<input readonly='' type='text' id='capValor"+idbton+"' name='res"+idbton+"' for='cantNec"+idbton+"' style='border-radius:5px;'></td><td><button type='button' onclick='quitarInsumo("+idbton+", this, subt"+idbton+".value)' class='btn btn-box-tool'><i class='fa fa-remove'></i></button></td><input type='hidden' name='idInsumo[]' value="+id_insumo+"></tr>";
        $("#tablaInsumos").append(tr);
        boton = "#btn"+idbton;
        $(boton).attr('disabled', 'disabled');
      }

      //limpia los valores del formulario y reinicia los input acumuladores y total.
      function limpiarFormRegFicha(){
        valor = 0;
        $(".subtotal").each(function(){
          $(this).val(valor);
        });
        $("#vlr_produccion").val(valor);
      }

      //valida que se asocie al menos un insumo al momento de registrar una ficha
      function enviarFormFicha()
      {
        // var vlrproduccion = $("#vlr_produccion").val();
        var referencia = $("#referencia").val();
        var colFichaT = $("#colorFicha").val().trim();
        var tallas = $("#selectTallas").val();
        var stockmini = $("#stock_minimo").val();
        var vlrproducto = $("#vlr_producto").val();

        if (referencia === '') {
          Lobibox.notify('error', {size: 'mini', rounded: true, delayIndicator: false, msg: 'Debe ingresar una referencia'});
          return false;
        }
        if (colFichaT === '') {
          Lobibox.notify('error', {size: 'mini', rounded: true, delayIndicator: false, msg: 'Debe seleccionar un color'});
          return false;
        }
        if (tallas === '') {
          Lobibox.notify('error', {size: 'mini', rounded: true, delayIndicator: false, msg: 'Debe seleccionar al menos una talla'});
          return false;
        }
        if (stockmini === '') {
          Lobibox.notify('error', {size: 'mini', rounded: true, delayIndicator: false, msg: 'Debe ingresar un stock mínimo'});
          return false;
        }
        if (vlrproducto === '') {
          Lobibox.notify('error', {size: 'mini', rounded: true, delayIndicator: false, msg: 'Debe ingresar un valor del procducto'});
          return false;
        }
        // if (vlrproduccion === '') {
        //   alert("Valor Producción no debe estar vacio");
        //   return false;
        // }

        //valida insumos asociados
        if ($("#tablaInsumos >tbody >tr").length == 0)
        {
          // swal({title: "0 Insumos Asociados", text: "Por favor asocie al menos un insumo a esta ficha.",   imageUrl: uri+"img/stop.png"});
          Lobibox.notify('error', {size: 'mini', imageUrl: uri+"img/android.jpg", rounded: true, delayIndicator: false, msg: 'Debe asociar al menos un insumo'});
          //retornar false no permite que se envie el formulario
          return false;
        }
        else
        {
          //Este retorno permite enviar el formulario
          return true;
        }
      }
      // function prueba(){
      //   idfichas = 0;
      //   cantidadaproducir = 0;
      //   $("#tablaFicha tbody tr").each(function(){
      //       idfichas = $(this).find("td").eq(8).html();
      //       idbton = $(this).find("td").eq(8).html();
      //       cantidadaproducir = $("#cantProducir"+idbton).val();
      //       // $("#vlr_total").val(total);
      //       validarExistenciasIn(idfichas, cantidadaproducir);
      //   });
      // }
      
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

      $(document).ready(function(){
        $('#tablaFichas').DataTable( {
          // "lengthChange": false,
          //"searching": false,
          // "info": false,
          "ordering": false
        });
      });
    
      function cerrarModalFicha(){
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
            $('#mdEditFicha').modal('toggle');
        });
      }
    
    //Calcula el valor total del pedido
    // function valorTotalPedido(){
    //   var total=0;
    //   $(".subtl").each(function(){
    //     total=total+parseFloat($(this).val());
    //   });
    //   $("#vlr_total").val(total);
    // }

     function quitarFicha(btn, elemento, subtotal){

        var e = $(elemento).parent().parent();
        $(e).remove();
        boton = "#btn"+btn;
        $(boton).attr('disabled', false);
        valortotal = $("#vlr_total").val();
        desc = valortotal - subtotal;
        $("#vlr_total").val(desc);
      }

      //remueve de la tabla(vista) los productos asociados al pedido al momento de modificar
      function removerProductoAsoPedi(btn, elemento, subtotal){
        var e = $(elemento).parent().parent();
        $(e).remove();
        boton = "#btn"+btn;
        $(boton).attr('disabled', false);
        valortotal = $("#valor_total").val();
        desc = valortotal - subtotal;
        $("#valor_total").val(desc);
      }

        function valorTotalPedido(){
           var total = 0;
           $("#tablaFicha tbody tr").each(function(){
              var idbton = $(this).find("td").eq(8).html();
              total += parseFloat($("#capValor"+idbton).val());
              $("#vlr_total").val(total);
            });
        }

      function asociarProductos(idf, ref, color, vlrprodto, fichas, idbton, cantidad){
        var campos = $(fichas).parent().parent();
        $("#agregarFicha").removeAttr("hidden");
        var tr = "<tr class='box box-solid collapsed-box'><td id=''>"+ref+"</td><td><i class='fa fa-square' style='color: "+color+"; font-size: 150%;'></i></td><td>"+vlrprodto+"</td><td><input type='number' id='cantProducir"+idbton+"' style='border-radius:5px;' name='cantProducir[]' value='0'></td><td><input type='hidden' name='subTotal[]' id='subt"+idbton+"'value='0'>$<input readonly='' value='0' type='number' id='capValor"+idbton+"' name='res"+idbton+"' for='cantProducir"+idbton+"' style='border-radius:5px;'></td>"    
        +"<td><input id='usarProductoT"+idbton+"' min='0' max='"+cantidad+"' type='number' style='border-radius:5px;'></td>"
        +"<td><span id='spanCant"+idbton+"' class='badge bg-red'>"+cantidad+"</span></td>"
        +"<td style='display: none;'><input type='hidden' id='cantProductT"+idbton+"' name='cantProductT[]'></td><td style='display: none;'>"+idbton+"</td>"    
        +"<td><button type='button' onclick='quitarFicha("+idbton+", this, res"+idbton+".value)' class='btn btn-box-tool'><i class='fa fa-remove'></i></button></td><input type='hidden' name='idFicha[]' value="+idf+"></tr>";
        
        //onchange
        //var tr = "<tr class='box box-solid collapsed-box'><td id=''>"+ref+"</td><td><i class='fa fa-square' style='color: "+color+"; font-size: 150%;'></i></td><td>"+vlrprodto+"</td><td><input type='number' min='1' id='cantProducir"+idbton+"' value='0' onchange='res"+idbton+".value=cantProducir"+idbton+".value * "+vlrprodto+"; subt"+idbton+".value=parseFloat(res"+idbton+".value); valorTotalPedido();' style='border-radius:5px;' name='cantProducir[]'></td><td><input valorTotalPedido type='hidden' name='subTotal[]' id='subt"+idbton+"'value='0'>$<input readonly='' type='text' id='capValor"+idbton+"' name='res"+idbton+"' for='cantProducir"+idbton+"' style='border-radius:5px;'></td><td><button type='button' onclick='quitarFicha("+idbton+", this, res"+idbton+".value)' class='btn btn-box-tool'><i class='fa fa-remove'></i></button></td><input type='hidden' name='idFicha[]' value="+ref+"></tr>";
        
        $("#tablaFicha").append(tr);
        boton = "#btn"+idbton;
        cantProd = "#cantProducir"+idbton;
        subt = "#capValor"+idbton;

        $(boton).attr('disabled', 'disabled');

        $("#tablaFicha tbody tr").each(function(){
          $("#cantProducir"+idbton).on("keyup change", function(){

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

          $("#usarProductoT"+idbton).on("keyup change", function(){
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

      function asociarProductosModiPedido(idfichat, referencia, color, vlrproducto, productos, idbton){

        //producto que se quiere agregar
        idProducNuevo = referencia;
        //comparar con los que estan agregados
        producto = "#idProducto"+referencia;
        valor = $(producto).val();
        if (idProducNuevo == $(producto).val()) {

          boton = "#btn"+referencia;
          $(boton).attr('disabled', 'disabled');
          // alert("Este producto ya se encuentra agregado al pedido");
        }
        else
        {
          var tr = "<tr class='box box-solid collapsed-box'><td id=''>"+referencia+"</td><td><i class='fa fa-square' style='color: "+color+"; font-size: 150%;'></i></td><td><input type='number' min='1' id='cantProducir"+referencia+"' name='cantProducir[]' value='0' onkeyup='res"+referencia+".value=cantProducir"+referencia+".value * "+vlrproducto+"; subt"+referencia+".value=parseFloat(res"+referencia+".value); calcularVlrTotalPed(); validarExistenciasIn("+idfichat+", cantProducir"+referencia+".value, 1);' style='border-radius:5px;'></td><td>$"+vlrproducto+"</td><td><input class='subtotal' type='hidden' name='subtotal[]' id='subt"+referencia+"'value='0'><input readonly='' type='text' id='capValor"+referencia+"' name='res"+referencia+"' for='cantProducir"+referencia+"' style='border-radius:5px;'></td><td><button type='button' onclick='removerProductoAsoPedi("+referencia+", this, subt"+referencia+".value)' class='btn btn-box-tool'><i class='fa fa-remove'></i></button></td><input type='hidden' id='idProducto"+referencia+"' name='idProducto[]' value="+idfichat+"><td style='display: none;'>"+idfichat+"</td></tr>";
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
        // $("#estado").val(estado);
        $("#doc_cliente").val(numDocumento);
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
            $('#modalEditPedido').modal('toggle');
        });
      }
    
      $(document).ready(function(){
        $('#tablaPedidos').DataTable( {
          // "lengthChange": false,
          //"searching": false,
          // "info": false,
          "ordering": false
        });
      });

      var options = {
        valueNames: ['freg', 'ftga', 'vtal', 'nomclte']
      };
      // var userList = new List('pedidos', options);
    
      function cerrar(){
        swal({title: "¿Está seguro de cancelar?", 
          text: "Los cambios realizados no se guardaran!", 
          type: "warning", 
          showCancelButton: true, 
          confirmButtonColor: "#DD6B55", 
          confirmButtonText: "Si", 
          closeOnConfirm: false 
          },
          function(){
            // location.href = uri+"ficha/consFicha";
            swal.close();
            $('#modalEditarEstado').modal('toggle');
        });
      }
    
      function cargarInsumos(ref, modalFp){
        $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ctrFicha/cargarInsumosAsociados",
            data: {referencia:ref}
        }).done(function(respuesta){
            if (respuesta.r != null) {
              // $("#tablaPrueba tr").remove();
              $("#tbl-insumos-aso > tbody tr").empty();
              $("#dtll-insumos-aso > tbody tr").empty();
              arrayInsumos = respuesta.r;
              for (var i = 0; i <= arrayInsumos.length - 1; i++) {
                //valor del insumo de la tabla insumos
                valorInsumo = arrayInsumos[i]['Valor_Promedio'];
                valorcmt = valorInsumo / 100;
                valorcmt = Math.round(valorcmt);

                //Esto se registra en la tabla detalle insumos_fichas
                idIns = arrayInsumos[i]['Id_Insumo'];
                nombreIns = arrayInsumos[i]['Nombre'];

                //valor del insumo asociado
                valorIns = arrayInsumos[i]['Valor_Insumo'];
                cantNec = arrayInsumos[i]['Cant_Necesaria'];
                color = arrayInsumos[i]['Codigo_Color'];
                var tr = "";
                if (modalFp == 1) {
                    tr = "<tr class='box box-solid collapsed-box'><td>"+nombreIns+"</td><td><i class='fa fa-square' style='color:"+color+"; font-size: 150%;'></i></td><td>cm</td><td>$ "+valorcmt+"</td><td><input type='number' min='1' id='cantNec"+idIns+"' name='cantNecesaria[]' value='"+cantNec+"' onchange='res"+idIns+".value=cantNec"+idIns+".value * "+valorcmt+"; subt"+idIns+".value=parseFloat(res"+idIns+".value); valorProduccion();' style='border-radius:5px;'></td><td><input class='subtotal' type='hidden' name='valorInsumo[]' id='subt"+idIns+"' value='"+valorIns+"'><input readonly='' type='text' id='capValor"+idIns+"' name='res"+idIns+"' for='cantNec"+idIns+"' style='border-radius:5px;' value='"+valorIns+"'></td><td><button type='button' class='btn btn-box-tool' onclick='quitarInsumo("+idIns+", this, subt"+idIns+".value)' ><i class='fa fa-remove'></i></button></td><input type='hidden'id='idInsu"+idIns+"' name='idInsumo[]' value='"+idIns+"'><input type='hidden' value=''><input type='hidden'' value=''></tr>";
                    $('#tbl-insumos-aso').append(tr);
                 }else{
                    tr = "<tr class='box box-solid collapsed-box'><td>"+nombreIns+"</td><td><i class='fa fa-square' style='color:"+color+"; font-size: 150%;'></i></td><td>cm</td><td>$ "+valorcmt+"</td><td>"+cantNec+"</td><td>"+valorIns+"</td>";
                    $('#dtll-insumos-aso').append(tr);
                 }
              }
            }
        }).fail(function(){})
    }

    function quitarTallaAso(btn, elemento){
        var e = $(elemento).parent().parent();
        $(e).remove();
        boton = "#btn"+btn;
        $(boton).attr('disabled', false);
    }

      function cargarTallas(ref, modalFp){
        $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ctrFicha/cargarTallasAsociadas",
            data: {referencia:ref}
        }).done(function(respuesta){
            if (respuesta.r != null) {
              $("#tbl-tallas-aso > tbody tr").empty();
              $("#dtll-tallas-aso > tbody tr").empty();
              arrayTallas = respuesta.r;
              for (var i = 0; i <= arrayTallas.length - 1; i++) {
                idTalla = arrayTallas[i]['Id_Talla'];
                nombre = arrayTallas[i]['Nombre'];
                var tr = "";
                if (modalFp == 1) {
                  tr = "<tr id='tr"+idTalla+"' class='box box-solid collapsed-box'><input type='hidden' id='tallas"+idTalla+"' name='tallas[]' value='"+idTalla+"'><td>"+idTalla+"</td><td>"+nombre+"</td><td><button type='button' class='btn btn-box-tool' onclick='quitarTallaAso("+idTalla+", this)'><i class='fa fa-remove'></i></button></td></tr>";
                  $('#tbl-tallas-aso').append(tr);
                }else{
                  tr = "<tr class='box box-solid collapsed-box'><td>"+idTalla+"</td><td>"+nombre+"</td>";
                  $('#dtll-tallas-aso').append(tr);
                }
              }
            }
        }).fail(function() {

        })
    }

      //funcion que asocia insumos al momento de editar ficha
      function asociarInsumoFicha(id, nombre, ref, insumos, valorProm, color, idbt){
          var campos = $(insumos).parent().parent();
          valorcm = valorProm / 100;

          //insumo que se quiere agregar
          idNuevoInsumo = id;

          //Comparar con los que ya estan agregados
          insumo = "#idInsu"+id;
          valor = $(insumo).val()

          if (idNuevoInsumo == $(insumo).val()) 
          {
            boton = "#btn"+id;
            $(boton).attr('disabled', 'disabled');
            alert("Este insumo ya se encuentra agregado a la ficha");
          }
          else
          {
            var tr = "<tr class='box box-solid collapsed-box'><td>"+nombre+"</td><td><i class='fa fa-square' style='color:"+color+"; font-size: 150%;'></i></td><td><p>cm</p></td><td><p>$ "+valorcm+"</p></td><td><input type='number' min='1' id='cantNec"+id+"' name='cantNecesaria[]' value='0' onchange='res"+id+".value=cantNec"+id+".value * "+valorcm+"; subt"+id+".value=parseFloat(res"+id+".value); valorProduccion();' style='border-radius:5px;'></td><td><input class='subtotal' type='hidden' name='valorInsumo[]' id='subt"+id+"'value='0'><input readonly='' type='text' id='capValor"+id+"' name='res"+id+"' for='cantNec"+id+"' style='border-radius:5px;'></td><td><button type='button' class='btn btn-box-tool' onclick='quitarInsumo("+id+", this, subt"+id+".value)'><i class='fa fa-remove'></i></button></td><input type='hidden' id='idInsu"+id+"' name='idInsumo[]' value="+id+"></tr>";
            $("#tbl-insumos-aso").append(tr);
            boton = "#btn"+id;
            $(boton).attr('disabled', 'disabled');
          }
      }

      //función que agrega nuevas tallas al momento de modificar una ficha.
      function asociarTallaFicha(id, nombre, ref, tallas, idbton){

          var campos = $(tallas).parent().parent();
          
          //esta es la talla que quiero agregar
          idNuevaTalla = id;
          
          //Compararla con las que ya estan agregadas
          talla = "#tallas"+id;
          valor = $(talla).val();

          //si la talla ya existe no la agrega
          if (idNuevaTalla == $(talla).val()) {

            //bloquea el boton
            botonn = "#btn"+id;
            $(botonn).attr('disabled', 'disabled');
            // alert("La talla ya se encuentra agregada");

          //si no existe la talla acá la agrega
          }else{

            var tr = "<tr id='tr"+id+"' class='box box-solid collapsed-box'><td>"+id+"</td><td>"+nombre+"</td><td><button type='button' class='btn btn-box-tool' onclick='quitarTallaAso("+id+", this)'><i class='fa fa-remove'></i></button></td><input type='hidden' id='tallas"+id+"' name='tallas[]' value="+id+"></tr>";
           
            $("#tbl-tallas-aso").append(tr);
            botonn = "#btn"+id;
            $(botonn).attr('disabled', 'disabled');
          }
      }

      function cambiarEstadoFicha(ref, est){
        console.log(ref, est);
        $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ctrFicha/cambiarEstadoFicha",
            data: {referencia:ref, estado:est}
        }).done(function(respuesta){
            if (respuesta.v == "1") {
                // swal('Ficha modificada exitosamente!', '', 'success');
                // Lobibox.notify('info', {msg: 'El estado ha sido modificado', rounded: true, delay: false});
                alert("Estado modificado");
                location.href = uri+"ctrFicha/consFicha";
            }else{
                // Lobibox.notify('error', {msg: 'Error al cambiar el estado', rounded: true, delay: false});
                alert("Error al modificar el estado");
            }
        }).fail(function(){})
      }

      //carga productos asociados al pedido
      function cargarProductosAsoPed(idped, modalPa){
        $.ajax({
          type: 'post',
          dataType: 'json',
          url: uri+"ctrPedido/cargarProAsoPedido",
          data:{idPed: idped}
        }).done(function(respuesta){
          if (respuesta.r != null) {
              $("#tbl-prod-aso-ped > tbody tr").empty();
              $("#dll-prod-asoped > tbody tr").empty();
              arrayProductos = respuesta.r;
              for (var i = 0; i <= arrayProductos.length - 1; i++) {

                id_fichat = arrayProductos[i]['Id_Ficha_Tecnica'];
                idProducto = arrayProductos[i]['Referencia'];
                color = arrayProductos[i]['Codigo_Color'];
                vlrProducto = arrayProductos[i]['Valor_Producto'];
                cantProducir = arrayProductos[i]['Cantidad_Producir'];
                subtotal = arrayProductos[i]['Subtotal'];
                var tr ="";
                if (modalPa == 1) {

                  //anterior
                  tr = "<tr id='tr"+idProducto+"' class='box box-solid collapsed-box'><td>"+idProducto+"</td><td><i class='fa fa-square' style='color:"+color+"; font-size: 150%;'></i></td><td><input type='number' min='1' id='cantProducir"+idProducto+"' name='cantProducir[]' value='"+cantProducir+"' onkeyup='res"+idProducto+".value=cantProducir"+idProducto+".value * "+vlrProducto+"; subt"+idProducto+".value=parseFloat(res"+idProducto+".value); calcularVlrTotalPed(); validarExistenciasIn("+id_fichat+", cantProducir"+idProducto+".value, 1);' style='border-radius:5px;'></td><td>$"+vlrProducto+"</td><td><input class='subtotal' type='hidden' name='subtotal[]' id='subt"+idProducto+"' value='"+subtotal+"'><input readonly='' type='text' id='capValor"+idProducto+"' name='res"+idProducto+"' for='cantProducir"+idProducto+"' style='border-radius:5px;' value='"+subtotal+"'></td><td><button type='button' class='btn btn-box-tool' onclick='removerProductoAsoPedi("+idProducto+", this, subt"+idProducto+".value)' ><i class='fa fa-remove'></i></button></td><input type='hidden' id='idProducto"+idProducto+"' name='idProducto[]' value='"+id_fichat+"'><td style='display: none;'>"+id_fichat+"</td></tr>";
                  $('#tbl-prod-aso-ped').append(tr);

                  //nueva
                  // tr = "<tr id='tr"+idProducto+"' class='box box-solid collapsed-box'><td>"+idProducto+"</td><td><i class='fa fa-square' style='color:"+color+"; font-size: 150%;'></i></td><td><input type='number' id='cantProducir"+idProducto+"' name='cantProducir[]' value='"+cantProducir+"' style='border-radius:5px;'></td><td>$"+vlrProducto+"</td><td><input class='subtotal' type='hidden' name='subtotal[]' id='subt"+idProducto+"' value='"+subtotal+"'><input readonly='' type='text' id='capValor"+idProducto+"' name='res"+idProducto+"' for='cantProducir"+idProducto+"' style='border-radius:5px;' value='"+subtotal+"'></td><td><button type='button' class='btn btn-box-tool' onclick='removerProductoAsoPedi("+idProducto+", this, subt"+idProducto+".value)' ><i class='fa fa-remove'></i></button></td><input type='hidden' id='idProducto"+idProducto+"' name='idProducto[]' value='"+id_fichat+"'></tr>";
                  // $('#tbl-prod-aso-ped').append(tr);

                  // $("#tbl-prod-aso-ped tbody tr").each(function(){
                  // $("#cantProducir"+idProducto).on("keyup change", function(){

                  // //$("#capValor"+idProducto).val((vlrprodto * $("#usarProductoT"+idbton).val()) + $("#cantProducir"+idbton).val() * vlrprodto);
                  
                  //   //nueva
                  //   var subtot = $("#cantProducir"+idProducto).val() * vlrProducto;
                  //   $("#capValor"+idProducto).val(subtot);
                  //   // $("#subt"+idProducto).val(subtot);
                    
                  //   calcularVlrTotalPed2(idProducto);
                  //   //calcularVlrTotalPed();
                  //   //validarExistenciasIn(idf, $("#cantProducir"+idbton).val());
                  //   });
                  // });
                }
                else
                {
                  tr = "<tr class='box box-solid collapsed-box'><td>"+idProducto+"</td><td><i class='fa fa-square' style='color:"+color+"; font-size: 150%;'></td><td>"+cantProducir+"</td><td>$"+vlrProducto+"</td><td>"+subtotal+"</td>";
                  $('#dll-prod-asoped').append(tr);
                }
              }
            }
        }).fail(function(){

        })
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

            
        