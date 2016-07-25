
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

      $mensaje
    
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

      // function storage(valor){

      //   if (sessionStorage.getItem("ValorT") == undefined) {

      //     var subtotales = [];
      //     subtotales.push(valor);
      //     sessionStorage.setItem("ValorT", JSON.stringify(subtotales));
      //     subtotal = JSON.parse(sessionStorage.getItem("ValorT"));
      //     $("#vlr_total").val(subtotal);
      //     // valortotal = '#res"+id+".value';
      //     // valortotal = subtotal;
      //   }

      //   else
      //   {
      //     var subtotales = JSON.parse(sessionStorage.getItem("ValorT"));
      //   }

      //   console.log(subtotales);


      //   if (subtotales.length == 0)
      //   {
      //     subtotales.push(valor);
      //     sessionStorage.setItem("ValorT", JSON.stringify(subtotales));
      //     subtotal = JSON.parse(sessionStorage.getItem("ValorT"));
      //     $("#vlr_produccion").val(subtotal);

      //   }else {
      //     suma = 0;
      //     for (var i = 0; i < subtotales.length; i++) {
      //       suma = subtotales[i] + subtotales[i + 1];
      //     }
      //     sessionStorage.setItem("ValorT", JSON.stringify(suma));
      //     subtotal = JSON.parse(sessionStorage.getItem("ValorT"));
      //     $("#vlr_total").val(subtotal);
      //   }
      // }

      function valorProduccion(){
        var total=0;
        $(".subtotal").each(function(){
          total=total+parseFloat($(this).val());
        });
        $("#vlr_produccion").val(total);
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
      function asociarIn(id_insumo, nombre, insumos, idbton, estado, valorPromedio){

        var campos = $(insumos).parent().parent();

        valorcm = valorPromedio / 100;
        $("#agregarInsumo").removeAttr("hidden");

        var tr = "<tr class='box box-solid collapsed-box'><td>"+id_insumo+"</td><td>"+nombre+"</td><td><p>cm</p></td><td><p>$ "+valorcm+"</p></td><td><input type='number' min='1' id='cantNec"+idbton+"' name='cantNecesaria[]' value='0' onchange='res"+idbton+".value=cantNec"+idbton+".value * "+valorcm+"; subt"+idbton+".value=parseFloat(res"+idbton+".value); valorProduccion();' style='border-radius:5px;'>cm</td><td><input class='subtotal' type='hidden' name='valorInsumo[]' id='subt"+idbton+"'value='0'>$<input readonly='' type='text' id='capValor"+idbton+"' name='res"+idbton+"' for='cantNec"+idbton+"' style='border-radius:5px;'></td><td><button type='button' onclick='quitarInsumo("+idbton+", this, subt"+idbton+".value)' class='btn btn-box-tool'><i class='fa fa-minus'></i></button></td><input type='hidden' name='idInsumo[]' value="+id_insumo+"></tr>";

        $("#tablaInsumos").append(tr);
        boton = "#btn"+idbton;
        $(boton).attr('disabled', 'disabled');
      }

      function limpiarFormRegFicha(){
        valor = 0;
        $(".subtotal").each(function(){
          $(this).val(valor);
        });
        $("#vlr_produccion").val(valor);
      }

      // function quitarInsumo(btn, elemento, subtotal){

      //   var e = $(elemento).parent().parent();
      //   $(e).remove();
      //   boton = "#btn"+btn;
      //   $(boton).attr('disabled', false);

      //   valortotal = $("#vlr_produccion").val();

      //   valortotal = valortotal - subtotal;

      //   $("#vlr_total").val(valortotal);

      //   subtotal = 0;
      //   fsubtotal = "#subt"+btn;
      //   $(fsubtotal).val(subtotal);

      // }

      // function calcularVlrProd(){
      //   var total=0;
      //   $(".subtotal").each(function(){
      //     total=total+parseFloat($(this).val());
      //   });
      //   $("#vlr_produccion").val(total);
      // }

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
        }

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

      function asociarFicha(ref, color, vlrprodto, fichas, idbton){
        var campos = $(fichas).parent().parent();
        $("#agregarFicha").removeAttr("hidden");
        // var tr = "<tr class='box box-solid collapsed-box'><td id=''>"+ref+"</td><td>"+color+"</td><td>"+vlrprodto+"</td><td><input type='number' min='1' id='cantProducir"+idbton+"' value='0' onchange='res"+idbton+".value=cantProducir"+idbton+".value * "+vlrprodto+"; subt"+idbton+".value=parseFloat(res"+idbton+".value);' style='border-radius:5px;' name='cantProducir[]'></td><td><input class='subtl' type='hidden' name='subTotal[]' id='subt"+idbton+"'value='0'>$<input readonly='' type='text' id='capValor"+idbton+"' name='res"+idbton+"' for='cantProducir"+idbton+"' style='border-radius:5px;'></td><td><button type='button' onclick='quitarFicha("+idbton+", this)' class='btn btn-box-tool'><i class='fa fa-minus'></i></button></td><input type='hidden' name='idFicha[]' value="+ref+"></tr>";
        var tr = "<tr class='box box-solid collapsed-box'><td id=''>"+ref+"</td><td>"+color+"</td><td>"+vlrprodto+"</td><td><input type='number' min='1' id='cantProducir"+idbton+"' value='0' onchange='res"+idbton+".value=cantProducir"+idbton+".value * "+vlrprodto+"; subt"+idbton+".value=parseFloat(res"+idbton+".value); valorTotalPedido();' style='border-radius:5px;' name='cantProducir[]'></td><td><input class='subtl' type='hidden' name='subTotal[]' id='subt"+idbton+"'value='0'>$<input readonly='' type='text' id='capValor"+idbton+"' name='res"+idbton+"' for='cantProducir"+idbton+"' style='border-radius:5px;'></td><td><button type='button' onclick='quitarFicha("+idbton+", this, res"+idbton+".value)' class='btn btn-box-tool'><i class='fa fa-minus'></i></button></td><input type='hidden' name='idFicha[]' value="+ref+"></tr>";
        $("#tablaFicha").append(tr);

        boton = "#btn"+idbton;
        $(boton).attr('disabled', 'disabled');
      }

      function limpiarFormRegPedido(){
        valor = 0;
        $(".subtl").each(function(){
          $(this).val(valor);
        });
        $("#vlr_total").val(valor);
      }

     

      // function calcularValorTotal(){
      //   var total=0;
      //   $(".subtl").each(function(){
      //     total=total+parseFloat($(this).val());
      //   });
      //   $("#vlr_total").val(total);
      // }
    
      // <?= $msgRegPedido ?>
    

    // Asociar cliente
      function asociarCliente(nombre, id_cliente, clientes, idbotonc){

        var campos = $(clientes).parent().parent();
        $("#nombre").val(nombre);
        $("#id_cliente").val(id_cliente);
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
            url: uri+"ctrFicha/cargarInsumosAsociados",
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

                var tr = "<tr id='tr"+idTalla+"' class='box box-solid collapsed-box'><input type='hidden' id='tallas"+idTalla+"' name='tallas[]' value='"+idTalla+"'><td>"+idTalla+"</td><td>"+nombre+"</td><td><button type='button' class='btn btn-box-tool' onclick='quitarAso(this)'><i class='fa fa-remove'></i></button></td></tr>";

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

      //funcion que asocia insumos al momento de editar ficha
      function asociarInsumoFicha(id, nombre, ref, insumos, valorProm, idbt){
        
          var campos = $(insumos).parent().parent();
          valorcm = valorProm / 100;

          var tr = "<tr class='box box-solid collapsed-box'><td>"+id+"</td><td>"+nombre+"</td><td><p>cm</p></td><td><p>$ "+valorcm+"</p></td><td><input type='number' min='1' id='cantNec"+id+"' name='cantNecesaria[]' value='0' onchange='res"+id+".value=cantNec"+id+".value * "+valorcm+"; subt"+id+".value=parseFloat(res"+id+".value);' style='border-radius:5px;'></td><td><input class='subtotal' type='hidden' name='valorInsumo[]' id='subt"+id+"'value='0'><input readonly='' type='text' id='capValor"+id+"' name='res"+id+"' for='cantNec"+id+"' style='border-radius:5px;'></td><td><button type='button' class='btn btn-box-tool' onclick='quitarAso(this)'><i class='fa fa-remove'></i></button></td><input type='hidden' name='idInsumo[]' value="+id+"></tr>";

          $("#tbl-insumos-aso").append(tr);

          boton = "#btn"+idbt;
          $(boton).attr('disabled', 'disabled');
      }

      //función que agrega nuevas tallas al momento de modificar una ficha.
      function asociarTallaFicha(id, nombre, ref, tallas, idbton){
          var campos = $(tallas).parent().parent();
          
          //esta es la talla que quiero agregar
          idNuevaTalla = id;
          
          //Compararla con las que ya estan agregadas
          talla = "#tallas"+id;
          valor = $(talla).val()

          //si la talla ya existe no la agrega
          if (idNuevaTalla == $(talla).val()) {

            //bloquea el boton o muestra una alerta
            botonn = "#btn"+idbton;
            $(botonn).attr('disabled', 'disabled');
            alert("La talla ya se encuentra agregada");

          //si no existe la talla acá la agrega
          }else{

            var tr = "<tr id='tr"+id+"' class='box box-solid collapsed-box'><td>"+id+"</td><td>"+nombre+"</td><td><button type='button' class='btn btn-box-tool' onclick='quitarAso(this)'><i class='fa fa-remove'></i></button></td><input type='hidden' id='tallas"+id+"' name='tallas[]' value="+id+"></tr>";
           
             $("#tbl-tallas-aso").append(tr);
            // botonn = "#btn"+idbton;
            // $(botonn).attr('disabled', 'disabled');
          }
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
