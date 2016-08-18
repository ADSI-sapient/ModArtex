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
        // $("#doc_cliente").select2();

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
      function asociarInsumosHab(id_insumo, nombre, color, insumos, idbton, estado, valorPromedio){
        var campos = $(insumos).parent().parent();
        valorcm = valorPromedio / 100;
        valorcm = Math.round(valorcm);
        $("#agregarInsumo").removeAttr("hidden");
        var tr = "<tr class='box box-solid collapsed-box'><td>"+id_insumo+"</td><td>"+nombre+"</td><td><i class='fa fa-square' style='color: "+color+"; font-size: 150%;'></i></td><td><p>cm</p></td><td><p>$ "+valorcm+"</p></td><td><input type='number' min='1' id='cantNec"+idbton+"' name='cantNecesaria[]' value='0' onchange='res"+idbton+".value=cantNec"+idbton+".value * "+valorcm+"; subt"+idbton+".value=parseFloat(res"+idbton+".value); valorProduccion();' style='border-radius:5px;'>cm</td><td><input class='subtotal' type='hidden' name='valorInsumo[]' id='subt"+idbton+"'value='0'>$<input readonly='' type='text' id='capValor"+idbton+"' name='res"+idbton+"' for='cantNec"+idbton+"' style='border-radius:5px;'></td><td><button type='button' onclick='quitarInsumo("+idbton+", this, subt"+idbton+".value)' class='btn btn-box-tool'><i class='fa fa-remove'></i></button></td><input type='hidden' name='idInsumo[]' value="+id_insumo+"></tr>";
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
        // var vlrproducto = $("#vlr_producto").val();

        if ($("#tablaInsumos >tbody >tr").length == 0)
        {
          swal({title: "0 Insumos Asociados", 
            text: "Por favor asocie al menos un insumo a esta ficha.",   
            imageUrl: uri+"img/stop.png"
          });
          return false;
        }

        if ( $("#vlr_producto").val() === '') {
          alert("Los campos marcados con * se deben llenar");
        }

        else
        {
          return true;
        }
      }
      
      //valida que se asocie al menos una ficha al momento de registrar un pedido.
      function enviarFormPedido(){

        if ($("#tablaFicha >tbody >tr").length == 0) {
          swal({title: "0 Fichas Asociadas", 
            text: "Por favor asocie al menos una ficha al pedido.",   
            imageUrl: uri+"img/stop.png"
          });
          return false;
        }

        //valida que se asocie un cliente a la ficha.
        if($("#nombre").val().length < 1){
          swal({title: "No ha asociado cliente", 
            text: "Por favor asocie un cliente al pedido.",   
            imageUrl: uri+"img/stop.png"
          });
          return false;
        }
        return true;
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
    function valorTotalPedido(){
      var total=0;
      $(".subtl").each(function(){
        total=total+parseFloat($(this).val());
      });
      $("#vlr_total").val(total);
    }

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

      function asociarProductos(idf, ref, color, vlrprodto, fichas, idbton){
        var campos = $(fichas).parent().parent();
        $("#agregarFicha").removeAttr("hidden");
        //onkeyup
        var tr = "<tr class='box box-solid collapsed-box'><td id=''>"+ref+"</td><td><i class='fa fa-square' style='color: "+color+"; font-size: 150%;'></i></td><td>"+vlrprodto+"</td><td><input type='text' id='cantProducir"+idbton+"' value='0' onkeyup='res"+idbton+".value=cantProducir"+idbton+".value * "+vlrprodto+"; subt"+idbton+".value=parseFloat(res"+idbton+".value); valorTotalPedido();' style='border-radius:5px;' name='cantProducir[]'></td><td><input class='subtl' type='hidden' name='subTotal[]' id='subt"+idbton+"'value='0'>$<input readonly='' type='text' id='capValor"+idbton+"' name='res"+idbton+"' for='cantProducir"+idbton+"' style='border-radius:5px;'></td><td><button type='button' onclick='quitarFicha("+idbton+", this, res"+idbton+".value)' class='btn btn-box-tool'><i class='fa fa-remove'></i></button></td><input type='hidden' name='idFicha[]' value="+idf+"></tr>";
        
        //onchange
        //var tr = "<tr class='box box-solid collapsed-box'><td id=''>"+ref+"</td><td><i class='fa fa-square' style='color: "+color+"; font-size: 150%;'></i></td><td>"+vlrprodto+"</td><td><input type='number' min='1' id='cantProducir"+idbton+"' value='0' onchange='res"+idbton+".value=cantProducir"+idbton+".value * "+vlrprodto+"; subt"+idbton+".value=parseFloat(res"+idbton+".value); valorTotalPedido();' style='border-radius:5px;' name='cantProducir[]'></td><td><input class='subtl' type='hidden' name='subTotal[]' id='subt"+idbton+"'value='0'>$<input readonly='' type='text' id='capValor"+idbton+"' name='res"+idbton+"' for='cantProducir"+idbton+"' style='border-radius:5px;'></td><td><button type='button' onclick='quitarFicha("+idbton+", this, res"+idbton+".value)' class='btn btn-box-tool'><i class='fa fa-remove'></i></button></td><input type='hidden' name='idFicha[]' value="+ref+"></tr>";
        
        $("#tablaFicha").append(tr);
        boton = "#btn"+idbton;
        cantProd = "#cantProducir"+idbton;
        subt = "#capValor"+idbton;

        $(boton).attr('disabled', 'disabled');

        // $(cantProd).on("keyup change", function(){
        //   // if ($("#cant").val() <= 0) {
        //   //   $("#valTot").val("");
        //   // }else{
        //     var total = $(subt).val($(cantProd).val() * vlrprodto);
        //     $("#vlr_total").val(total);
        //   // }
        //     valorTotalPedido();
        // });

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
          var tr = "<tr class='box box-solid collapsed-box'><td id=''>"+referencia+"</td><td><i class='fa fa-square' style='color: "+color+"; font-size: 150%;'></i></td><td><input type='number' min='1' id='cantProducir"+referencia+"' name='cantProducir[]' value='0' onchange='res"+referencia+".value=cantProducir"+referencia+".value * "+vlrproducto+"; subt"+referencia+".value=parseFloat(res"+referencia+".value); calcularVlrTotalPed();' style='border-radius:5px;'></td><td>$"+vlrproducto+"</td><td><input class='subtotal' type='hidden' name='subtotal[]' id='subt"+referencia+"'value='0'><input readonly='' type='text' id='capValor"+referencia+"' name='res"+referencia+"' for='cantProducir"+referencia+"' style='border-radius:5px;'></td><td><button type='button' onclick='removerProductoAsoPedi("+referencia+", this, subt"+referencia+".value)' class='btn btn-box-tool'><i class='fa fa-remove'></i></button></td><input type='hidden' id='idProducto"+referencia+"' name='idProducto[]' value="+idfichat+"></tr>";
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

      function editarPedido(id, pedidos, numDocumento){
        var campos = $(pedidos).parent().parent();
        $("#id_pedido").val(campos.find("td").eq(0).text());
        $("#fecha_reg").val(campos.find("td").eq(1).text());
        $("#fecha_entrega").val(campos.find("td").eq(2).text());
        $("#valor_total").val(campos.find("td").eq(3).text());
        // $("#estado").val(estado);
        $("#doc_cliente").val(numDocumento);
        $("#nombreCliente").val(campos.find("td").eq(5).text());
        $("#modalEditPedido").show();
      }

      function cancelar(){
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
            $('#modalEditPedido').modal('toggle');
        });
      }
    

    function editarEstadoPedido(id, pedidos){

        var campos = $(pedidos).parent().parent().parent();

        $("#id_pedidoMod").val(campos.find("td").eq(0).text());
        estado = campos.find("td").eq(4).text();

        if (estado == "Pendiente") {

          $("#estadoMod option[value=1]").attr("selected",true);

        }else if(estado == "En Proceso"){

          $("#estadoMod option[value=2]").attr("selected",true);

        }else if(estado == "Terminado"){
          
          $("#estadoMod option[value=3]").attr("selected",true);

        }else{
          $("#estadoMod option[value=4]").attr("selected",true);
        }

        $("#modalEditarEstado").show();
      }
      
      // <?= $msgModEstadoPedido ?>
    
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
    
      function cargarInsumos(ref){
        $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ctrFicha/cargarInsumosAsociados",
            data: {referencia:ref}
        }).done(function(respuesta){
            if (respuesta.r != null) {
              // $("#tablaPrueba tr").remove();
              $("#tbl-insumos-aso > tbody tr").empty();
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
                var tr = "<tr class='box box-solid collapsed-box'><td>"+nombreIns+"</td><td><i class='fa fa-square' style='color:"+color+"; font-size: 150%;'></i></td><td>cm</td><td>$ "+valorcmt+"</td><td><input type='number' min='1' id='cantNec"+idIns+"' name='cantNecesaria[]' value='"+cantNec+"' onchange='res"+idIns+".value=cantNec"+idIns+".value * "+valorcmt+"; subt"+idIns+".value=parseFloat(res"+idIns+".value); valorProduccion();' style='border-radius:5px;'></td><td><input class='subtotal' type='hidden' name='valorInsumo[]' id='subt"+idIns+"' value='"+valorIns+"'><input readonly='' type='text' id='capValor"+idIns+"' name='res"+idIns+"' for='cantNec"+idIns+"' style='border-radius:5px;' value='"+valorIns+"'></td><td><button type='button' class='btn btn-box-tool' onclick='quitarInsumo("+idIns+", this, subt"+idIns+".value)' ><i class='fa fa-remove'></i></button></td><input type='hidden'id='idInsu"+idIns+"' name='idInsumo[]' value='"+idIns+"'><input type='hidden' value=''><input type='hidden'' value=''></tr>";

                 $('#tbl-insumos-aso').append(tr);
              }
            }
        }).fail(function() {

        })
    }

    function quitarTallaAso(btn, elemento){
        var e = $(elemento).parent().parent();
        $(e).remove();
        boton = "#btn"+btn;
        $(boton).attr('disabled', false);
    }

      function cargarTallas(ref){
        $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ctrFicha/cargarTallasAsociadas",
            data: {referencia:ref}
        }).done(function(respuesta){
          console.log(respuesta);
            if (respuesta.r != null) {
              $("#tbl-tallas-aso > tbody tr").empty();
              arrayTallas = respuesta.r;
              for (var i = 0; i <= arrayTallas.length - 1; i++) {
                idTalla = arrayTallas[i]['Id_Talla'];
                nombre = arrayTallas[i]['Nombre'];
                var tr = "<tr id='tr"+idTalla+"' class='box box-solid collapsed-box'><input type='hidden' id='tallas"+idTalla+"' name='tallas[]' value='"+idTalla+"'><td>"+idTalla+"</td><td>"+nombre+"</td><td><button type='button' class='btn btn-box-tool' onclick='quitarTallaAso("+idTalla+", this)'><i class='fa fa-remove'></i></button></td></tr>";
                 $('#tbl-tallas-aso').append(tr);
              }
            }
        }).fail(function() {

        })
    }

      // function eliminarInsumoAsoFicha(id, ref, insumo){
      //   $.ajax({
      //       dataType: 'json',
      //       type: 'post',
      //       url: uri+"ficha/eliminarInsumoAsociado",
      //       data: {id_insumo:id, referencia:ref}  
      //   }).done(function(resp){
      //     if (resp.r == "1") {
      //       alert("Asociación eliminada correctamente");
      //       var i = $(insumo).parent().parent();
      //       $(i).remove();
      //     }else{
      //       alert('Error al eliminar la asociación');
      //     }
      //   }).fail(function() {

      //   })
      // }

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

            //bloquea el boton o muestra una alerta
            botonn = "#btn"+id;
            $(botonn).attr('disabled', 'disabled');
            alert("La talla ya se encuentra agregada");

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
      function cargarProductosAsoPed(idped){
        $.ajax({
          type: 'post',
          dataType: 'json',
          url: uri+"ctrPedido/cargarProAsoPedido",
          data:{idPed: idped}
        }).done(function(respuesta){
          if (respuesta.r != null) {
              $("#tbl-prod-aso-ped > tbody tr").empty();
              arrayProductos = respuesta.r;
              for (var i = 0; i <= arrayProductos.length - 1; i++) {

                id_fichat = arrayProductos[i]['Id_Ficha_Tecnica'];
                idProducto = arrayProductos[i]['Referencia'];
                color = arrayProductos[i]['Codigo_Color'];
                vlrProducto = arrayProductos[i]['Valor_Producto'];
                cantProducir = arrayProductos[i]['Cantidad_Producir'];
                subtotal = arrayProductos[i]['Subtotal'];
                var tr = "<tr id='tr"+idProducto+"' class='box box-solid collapsed-box'><td>"+idProducto+"</td><td><i class='fa fa-square' style='color:"+color+"; font-size: 150%;'></td><td><input type='number' min='1' id='cantProducir"+idProducto+"' name='cantProducir[]' value='"+cantProducir+"' onchange='res"+idProducto+".value=cantProducir"+idProducto+".value * "+vlrProducto+"; subt"+idProducto+".value=parseFloat(res"+idProducto+".value); calcularVlrTotalPed();' style='border-radius:5px;'></td><td>$"+vlrProducto+"</td><td><input class='subtotal' type='hidden' name='subtotal[]' id='subt"+idProducto+"' value='"+subtotal+"'><input readonly='' type='text' id='capValor"+idProducto+"' name='res"+idProducto+"' for='cantProducir"+idProducto+"' style='border-radius:5px;' value='"+subtotal+"'></td><td><button type='button' class='btn btn-box-tool' onclick='removerProductoAsoPedi("+idProducto+", this, subt"+idProducto+".value)' ><i class='fa fa-remove'></i></button></td><input type='hidden' id='idProducto"+idProducto+"' name='idProducto[]' value='"+id_fichat+"'></tr>";

                $('#tbl-prod-aso-ped').append(tr);
              }
            }
        }).fail(function(){

        })
      }

      function cancelarPedido(idpedido){

        swal({
          title: "¿Está seguro?",   
          text: "El pedido quedará en estado cancelado!",  
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Sí, cancelar pedido",
          cancelButtonText: "No, terminar",
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
              swal("Acción interrumpida", "No se completo la acción.", "error");
            }
          });
        }

            
        