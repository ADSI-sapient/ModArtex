
        $(function () {
        $('#datepicker').datepicker({
          autoclose: true
        });

        $('#datepicker2').datepicker({
          autoclose: true
        });

    // $('#datepicker3').datepicker({
    //    autoclose: true
    //  });

        $("#selectTallas").select2({
        // placeholder: "Seleccione tallas"
        });
      });
    
      var options = {
        valueNames: ['ref', 'color', 'stock', 'fecha_reg', 'estado']
      };
      // var userList = new List('users', options);
    
   
      // <?= $msjFichaExiste ?>

      // <?= $mensaje ?>
    
      function editarFicha(referencia, fichas){
        var campos = $(fichas).parent().parent();
        $("#referencia").val(campos.find("td").eq(0).text());
        $("#fecha_reg").val(campos.find("td").eq(1).text());
        $("#estado").val(campos.find("td").eq(2).text());
        $("#color").val(campos.find("td").eq(3).text());
        $("#stock_min").val(campos.find("td").eq(4).text());
        $("#vlr_produccion").val(campos.find("td").eq(5).text());
        $("#vlr_producto").val(campos.find("td").eq(6).text());
        $("#idModal").show();
      }

      function storage(valor){

        if (sessionStorage.getItem("ValorT") == undefined) {

          var subtotales = [];
          subtotales.push(valor);
          sessionStorage.setItem("ValorT", JSON.stringify(subtotales));
          subtotal = JSON.parse(sessionStorage.getItem("ValorT"));
          $("#vlr_total").val(subtotal);
          // valortotal = '#res"+id+".value';
          // valortotal = subtotal;
        }

        else
        {
          var subtotales = JSON.parse(sessionStorage.getItem("ValorT"));
        }

        console.log(subtotales);


        if (subtotales.length == 0)
        {
          subtotales.push(valor);
          sessionStorage.setItem("ValorT", JSON.stringify(subtotales));
          subtotal = JSON.parse(sessionStorage.getItem("ValorT"));
          $("#vlr_produccion").val(subtotal);

        }else {

          suma = 0;
          for (var i = 0; i < subtotales.length; i++) {
            suma = subtotales[i] + subtotales[i + 1];
          }
          sessionStorage.setItem("ValorT", JSON.stringify(suma));
          subtotal = JSON.parse(sessionStorage.getItem("ValorT"));
          $("#vlr_total").val(subtotal);
        }

      }
    

      function asociarIn(id_insumo, nombre, insumos, idbton, estado){
        var campos = $(insumos).parent().parent();
        // valorcm = (valor / cantidad) / 100;
        $("#agregarInsumo").removeAttr("hidden");

        var tr = "<tr class='box box-solid collapsed-box'><td id='codigo_insumo'>"+id_insumo+"</td><td>"+nombre+"</td><td><p>cm</p></td><td><p>$ "+valorcm+"</p></td><td><input type='number' min='1' id='cantNec"+id_insumo+"' name='cantNecesaria[]' value='0' onchange='res"+id_insumo+".value=cantNec"+id_insumo+".value * "+valorcm+"; subt"+id_insumo+".value=parseFloat(res"+id_insumo+".value);' style='border-radius:5px;'>cm</td><td><input class='subtotal' type='hidden' name='valorInsumo[]' id='subt"+id_insumo+"'value='0'>$<input readonly='' type='text' id='capValor"+id_insumo+"' name='res"+id_insumo+"' for='cantNec"+id_insumo+"' style='border-radius:5px;'></td><td><button type='button' onclick='quitarInsumo("+idbton+", this, subt"+id_insumo+".value)' class='btn btn-box-tool'><i class='fa fa-minus'></i></button></td><input type='hidden' name='idInsumo[]' value="+id_insumo+"></tr>";

        // var tr = "<tr class='box box-solid collapsed-box'><td id='codigo_insumo'>"+id_insumo+"</td><td>"+nombre+"</td><td><p>cm</p></td><td><p>$ "+valorcm+"</p></td><td><input type='number' min='1' id='cantNec"+id_insumo+"' name='cantNecesaria[]' value='0' onchange='storage(res"+id_insumo+".value=cantNec"+id_insumo+".value * "+valorcm+")' style='border-radius:5px;'>cm</td><td><input class='subtotal' type='hidden' name='valorInsumo[]' id='subt"+id_insumo+"'value='0'>$<input readonly='' type='text' id='capValor"+id_insumo+"' name='res"+id_insumo+"' for='cantNec"+id_insumo+"' style='border-radius:5px;'></td><td><button type='button' onclick='quitarInsumo("+idbton+", this, subt"+id_insumo+".value)' class='btn btn-box-tool'><i class='fa fa-minus'></i></button></td><input type='hidden' name='idInsumo[]' value="+id_insumo+"></tr>";


        $("#tablaInsumos").append(tr);

        boton = "#btn"+idbton;
        $(boton).attr('disabled', 'disabled');
      }

      function quitarInsumo(btn, elemento, subtotal){

        var e = $(elemento).parent().parent();
        $(e).remove();
        boton = "#btn"+btn;
        $(boton).attr('disabled', false);

        valortotal = $("#vlr_produccion").val();

        valortotal = valortotal - subtotal;

        $("#vlr_total").val(valortotal);

        subtotal = 0;
        fsubtotal = "#subt"+btn;
        $(fsubtotal).val(subtotal);

      }

      function calcularVlrProd(){
        var total=0;
        $(".subtotal").each(function(){
          total=total+parseFloat($(this).val());
        });
        $("#vlr_produccion").val(total);
      }

    
      
      function limpiarValoresTabla(){
        valor = 0;
        $(".subtotal").val(valor);
      }
    
      // function enviarFormFicha(){
      //   if ($("#tablaInsumos >tbody >tr").length == 0) {
      //     swal({title: "0 Insumos Asociados", 
      //       text: "Por favor asocie al menos un insumo a esta ficha.",   
      //       imageUrl: uri+"img/stop.png"
      //     });
      //     return false;
      //   }else if($("#vlr_total").val() == 0){
      //     swal({title: "Valor de Produccion: 0", 
      //       text: "Debe calcular un valor de producción para esta ficha.",   
      //       imageUrl: uri+"img/stop.png"
      //     });
      //     return false;
      //   }else{
      //     return true;
      //   }
      // }
    
   

      function enviarFormPedido(){
        if ($("#tablaFicha >tbody >tr").length == 0) {
          swal({title: "0 Fichas Asociadas", 
            text: "Por favor asocie al menos una ficha al pedido.",   
            imageUrl: uri+"img/stop.png"
          });
          return false;
        }else{
          return true;
        }
      }

    
      $(document).ready(function(){
        $('#tablaFichas').DataTable( {
          // "lengthChange": false,
          //"searching": false,
          // "info": false,
          "ordering": false
        });
      });
    
      function cancel(){
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
            $('#idModal').modal('toggle');
        });
      }
    
      // <?= $msgprueba ?>
    
    // todo lo de pedido

      function asociarFicha(ref, color, vlrprodto, fichas, idbton){

        var campos = $(fichas).parent().parent();
        
        $("#agregarFicha").removeAttr("hidden");

        var tr = "<tr class='box box-solid collapsed-box'><td id=''>"+ref+"</td><td>"+color+"</td><td>"+vlrprodto+"</td><td><input type='number' min='1' id='cantProducir"+idbton+"' value='0' onchange='res"+idbton+".value=cantProducir"+idbton+".value * "+vlrprodto+"; subt"+idbton+".value=parseFloat(res"+idbton+".value);' style='border-radius:5px;'></td><td><input class='subtl' type='hidden' name='subt"+idbton+"' id='subt"+idbton+"'value='0'>$<input readonly='' type='text' id='capValor"+idbton+"' name='res"+idbton+"' for='cantProducir"+idbton+"' style='border-radius:5px;'></td><td><button type='button' onclick='quitarFicha("+idbton+", this)' class='btn btn-box-tool'><i class='fa fa-minus'></i></button></td><input type='hidden' name='idFicha[]' value="+ref+"></tr>";

        $("#tablaFicha").append(tr);

        boton = "#btn"+idbton;
        $(boton).attr('disabled', 'disabled');

      }

      function quitarFicha(btn, elemento){
        var e = $(elemento).parent().parent();
        $(e).remove();
        boton = "#btn"+btn;
        $(boton).attr('disabled', false);
      }

      function calcularValorTotal(){
        var total=0;
        $(".subtl").each(function(){
          total=total+parseFloat($(this).val());
        });
        $("#vlr_total").val(total);
      }
    
      // <?= $msgRegPedido ?>
    

    <!-- Asociar cliente -->
      function asociarCliente(idcliente, clientes, idbotonc){

        // boton = "#btnAgregar"+idbotonc;

        var campos = $(clientes).parent().parent();
        
        $("#cliente").val(idcliente);
        // $(boton).attr('disabled', 'disabled');

      }

      

    
      function editarPedido(id, pedidos){

        var campos = $(pedidos).parent().parent();
        $("#id_pedido").val(campos.find("td").eq(0).text());
        $("#fecha_reg").val(campos.find("td").eq(1).text());
        $("#fecha_entrega").val(campos.find("td").eq(2).text());
        $("#valor_total").val(campos.find("td").eq(3).text());
        $("#estado").val(campos.find("td").eq(4).text());
        $("#nombrecliente").val(campos.find("td").eq(5).text());
        $("#modalEditPedido").show();
      }
      // <?= $msgModPedido ?>

    
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
            // url: uri+"ctrFicha/cargarInsumosAsociados",
            data: {referencia:ref}
        }).done(function(respuesta){
            if (respuesta.r != null) {
              // $("#tablaPrueba tr").remove();
              $("#tbl-insumos-aso > tbody tr").empty();
              arrayInsumos = respuesta.r;
              for (var i = 0; i <= arrayInsumos.length - 1; i++) {
                // valorcmt = (arrayInsumos[i]['Valor'] / arrayInsumos[i]['Cantidad']) / 100;

                //valor del insumo de la tabla insumos
                valorInsumo = arrayInsumos[i]['Valor'];
                cantidad = arrayInsumos[i]['Cantidad'];
                valorcmt = (valorInsumo / cantidad) / 100;

                //Esto se registra en la tabla detalle insumos_fichas
                idIns = arrayInsumos[i]['Id_Insumo'];
                nombreIns = arrayInsumos[i]['Nombre'];
                //valor del insumo asociado
                valorIns = arrayInsumos[i]['Valor_Insumo'];
                cantNec = arrayInsumos[i]['Cant_Necesaria'];

                var tr = "<tr class='box box-solid collapsed-box'><td>"+idIns+"</td><td>"+nombreIns+"</td><td>cm</td><td>$ "+valorcmt+"</td><td><input type='number' min='1' id='cantNec"+idIns+"' name='cantNecesaria[]' value='"+cantNec+"' onchange='res"+idIns+".value=cantNec"+idIns+".value * "+valorcmt+"; subt"+idIns+".value=parseFloat(res"+idIns+".value);' style='border-radius:5px;'></td><td><input class='subtotal' type='hidden' name='valorInsumo[]' id='subt"+idIns+"' value='"+valorIns+"'><input readonly='' type='text' id='capValor"+idIns+"' name='res"+idIns+"' for='cantNec"+idIns+"' style='border-radius:5px;' value='"+valorIns+"'></td><td><button type='button' class='btn btn-box-tool' onclick='quitarAso(this)' ><i class='fa fa-remove'></i></button></td><input type='hidden' name='idInsumo[]' value='"+idIns+"'><input type='hidden' value=''><input type='hidden'' value=''></tr>";

                 $('#tbl-insumos-aso').append(tr);
              }
            }
        }).fail(function() {

        })
    }

    function quitarAso(elemento){

        var e = $(elemento).parent().parent();
        $(e).remove();
    }

    
      function cargarTallas(ref){
        $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ctrFicha/cargarTallasAsociadas",
            data: {referencia:ref}
        }).done(function(respuesta){
            if (respuesta.r != null) {
              $("#tbl-tallas-aso > tbody tr").empty();
              arrayTallas = respuesta.r;
              for (var i = 0; i <= arrayTallas.length - 1; i++) {

                idTalla = arrayTallas[i]['Id_Talla'];
                nombre = arrayTallas[i]['Nombre'];

                var tr = "<tr class='box box-solid collapsed-box'><input type=hidden name='tallas[]' value='"+idTalla+"'><td>"+idTalla+"</td><td>"+nombre+"</td><td><button type='button' class='btn btn-box-tool' onclick='quitarAso(this)'><i class='fa fa-remove'></i></button></td></tr>";

                 $('#tbl-tallas-aso').append(tr);
              }
            }
        }).fail(function() {

        })
    }

      function eliminarInsumoAsoFicha(id, ref, insumo){
        $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ficha/eliminarInsumoAsociado",
            data: {id_insumo:id, referencia:ref}
        }).done(function(resp){
          if (resp.r == "1") {
            alert("Asociación eliminada correctamente");
            var i = $(insumo).parent().parent();
            $(i).remove();
          }else{
            alert('Error al eliminar la asociación');
          }
        }).fail(function() {

        })
      }
      function asociarInsumoFicha(id, nombre, ref, insumos, valor, cantidad){
        
          var campos = $(insumos).parent().parent();
          valorcm = (valor / cantidad) / 100;

          var tr = "<tr class='box box-solid collapsed-box'><td id='codigo_insumo'>"+id+"</td><td>"+nombre+"</td><td><p>cm</p></td><td><p>$ "+valorcm+"</p></td><td><input type='number' min='1' id='cantNec"+id+"' name='cantNecesaria[]' value='0' onchange='res"+id+".value=cantNec"+id+".value * "+valorcm+"; subt"+id+".value=parseFloat(res"+id+".value);' style='border-radius:5px;'></td><td><input class='subtotal' type='hidden' name='valorInsumo[]' id='subt"+id+"'value='0'><input readonly='' type='text' id='capValor"+id+"' name='res"+id+"' for='cantNec"+id+"' style='border-radius:5px;'></td><td><button type='button' class='btn btn-box-tool' onclick='quitarAso(this)'><i class='fa fa-remove'></i></button></td><input type='hidden' name='idInsumo[]' value="+id+"></tr>";

          $("#tbl-insumos-aso").append(tr);

          boton = "#btn"+id;
          $(boton).attr('disabled', 'disabled');
      }

      function asociarTallaFicha(id, nombre, ref, tallas){
        
          var campos = $(tallas).parent().parent();

          var tr = "<tr class='box box-solid collapsed-box'><td id='codigo_insumo'>"+id+"</td><td>"+nombre+"</td><td><button type='button' class='btn btn-box-tool' onclick='quitarAso(this)'><i class='fa fa-remove'></i></button></td><input type='hidden' name='tallas[]' value="+id+"></tr>";

          $("#tbl-tallas-aso").append(tr);

          boton = "#btn"+id;
          $(boton).attr('disabled', 'disabled');
      }

      function cambiarEstadoFicha(ref, est){
        $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ctrFicha/cambiarEstado",
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
        }).fail(function() {

        })
    }
