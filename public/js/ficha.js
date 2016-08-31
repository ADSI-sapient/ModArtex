

        //permite seleccionar y asociar tallas al registrar ficha técnica
        $("#selectTallas").select2({});
        
        //permite seleccionar y asociar un color a la ficha técnica al registrarla
        $("#colorFicha").select2({});

        //permite seleccionar y asociar un color a la ficha técnica al modificar
        $("#colorModFicha").select2({});

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

      //pinta el div con el color correspondiente a la opción seleccionada en el select color de ficha
      function coloresFichas(){
        $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ctrFicha/mostrarColores",
            async: false
        }).done(function(respuesta){
          if (respuesta.r != null) {
            miArray = respuesta.r;
            for (var i = 0; i <= miArray.length - 1; i++) {
              codColor = miArray[i]['Codigo_Color'];
              if ($("#colorFicha").val() == miArray[i]['Id_Color']) {
                $("#colorF").css("color", codColor);
                // $("#colorF").css("background-color", codColor);
              }
            }
          }
        });
      }

      //edita la información de una ficha técnica
      function editarFicha(referencia, fichas, idColor){
        var campos = $(fichas).parent().parent();
        $("#idFicha_Tec").val(referencia);
        $("#referencia").val(campos.find("td").eq(0).text());
        $("#fecha_reg").val(campos.find("td").eq(1).text());
        $("#estado").val(campos.find("td").eq(2).text());
        $("#colorModFicha").val(idColor).trigger("change");
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
        // valorcm = valorPromedio / 100;
        valorPromedio = Math.round(valorPromedio);

        $("#agregarInsumo").removeAttr("hidden");
        var tr = "<tr class='box box-solid collapsed-box'><td>"+id_insumo+"</td><td>"+nombre+"</td><td><i class='fa fa-square' style='color: "+color+"; font-size: 150%;'></i></td><td>"+unidadMed+"</td><td><p>$ "+valorPromedio+"</p></td><td><input type='text' id='cantNec"+idbton+"' name='cantNecesaria[]' value='0' onkeyup='res"+idbton+".value=cantNec"+idbton+".value * "+valorPromedio+"; subt"+idbton+".value=parseFloat(res"+idbton+".value); valorProduccion();' style='border-radius:5px;'>"+unidadMed+"</td><td><input class='subtotal' type='hidden' name='valorInsumo[]' id='subt"+idbton+"'value='0'>$<input readonly='' type='text' id='capValor"+idbton+"' name='res"+idbton+"' for='cantNec"+idbton+"' style='border-radius:5px;'></td><td><button type='button' onclick='quitarInsumo("+idbton+", this, subt"+idbton+".value)' class='btn btn-box-tool'><i class='fa fa-remove'></i></button></td><input type='hidden' name='idInsumo[]' value="+id_insumo+"><td style='display:none'>"+id_insumo+"</td></tr>";
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

      //valida todos los campos necesarios para el registro en el formulario
      function enviarFormFicha()
      {
        var vlrproduccion = $("#vlr_produccion").val();
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
        if (document.forms['frmRegFicha']['tallas[]'].selectedIndex == -1){
          Lobibox.notify('error', {size: 'mini', rounded: true, delayIndicator: false, msg: 'Debe seleccionar una talla'});
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
          Lobibox.notify('error', {size: 'mini', rounded: true, delayIndicator: false, msg: 'Debe ingresar un valor del producto'});
          return false;
        }
        if (vlrproducto <= vlrproduccion) {
          Lobibox.notify('error', {size: 'mini', rounded: true, delayIndicator: false, msg: 'El valor del producto debe ser mayor al valor de producción'});
          return false;
        }

        //validación para los inputs de cantidad necesaria
        // $("#tablaInsumos tbody tr").each(function(){
        //   idbton = $(this).find("td").eq(8).html();
        //   cantiNecesaria = $("#cantNec"+idbton).val();
        //   if (cantiNecesaria == 0) {
        //     Lobibox.notify('error', {size: 'mini', rounded: true, delayIndicator: false, msg: 'La cantidad necesaria deber ser mayor a 0'});
        //     return false;
        //   }
        // });

        //valida insumos asociados
        if ($("#tablaInsumos >tbody >tr").length == 0)
        {
          Lobibox.notify('error', {size: 'mini', imageUrl: uri+"img/android.jpg", rounded: true, delayIndicator: false, msg: 'Debe asociar al menos un insumo'});
          //retorna false y no permite que se envie el formulario.
          return false;
        }
        else
        {
          //Este retorno permite enviar el formulario
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

     function quitarFicha(btn, elemento, subtotal){

        var e = $(elemento).parent().parent();
        $(e).remove();
        boton = "#btn"+btn;
        $(boton).attr('disabled', false);
        valortotal = $("#vlr_total").val();
        desc = valortotal - subtotal;
        $("#vlr_total").val(desc);
      }

      
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
                // valorcmt = valorInsumo / 100;
                valorInsumo = Math.round(valorInsumo);

                //Esto se registra en la tabla detalle insumos_fichas
                idIns = arrayInsumos[i]['Id_Insumo'];
                nombreIns = arrayInsumos[i]['Nombre'];
                abrevit = arrayInsumos[i]['Abreviatura'];

                //valor del insumo asociado
                valorIns = arrayInsumos[i]['Valor_Insumo'];
                cantNec = arrayInsumos[i]['Cant_Necesaria'];
                color = arrayInsumos[i]['Codigo_Color'];
                var tr = "";
                if (modalFp == 1) {
                    tr = "<tr class='box box-solid collapsed-box'><td>"+nombreIns+"</td><td><i class='fa fa-square' style='color:"+color+"; font-size: 150%;'></i></td><td>"+abrevit+"</td><td>$ "+valorInsumo+"</td><td><input type='text' min='1' id='cantNec"+idIns+"' name='cantNecesaria[]' value='"+cantNec+"' onkeyup='res"+idIns+".value=cantNec"+idIns+".value * "+valorInsumo+"; subt"+idIns+".value=parseFloat(res"+idIns+".value); valorProduccion();' style='border-radius:5px;'></td><td><input class='subtotal' type='hidden' name='valorInsumo[]' id='subt"+idIns+"' value='"+valorIns+"'><input readonly='' type='text' id='capValor"+idIns+"' name='res"+idIns+"' for='cantNec"+idIns+"' style='border-radius:5px;' value='"+valorIns+"'></td><td><button type='button' class='btn btn-box-tool' onclick='quitarInsumo("+idIns+", this, subt"+idIns+".value)' ><i class='fa fa-remove'></i></button></td><input type='hidden'id='idInsu"+idIns+"' name='idInsumo[]' value='"+idIns+"'><input type='hidden' value=''><input type='hidden'' value=''></tr>";
                    $('#tbl-insumos-aso').append(tr);
                 }else{
                    tr = "<tr class='box box-solid collapsed-box'><td>"+nombreIns+"</td><td><i class='fa fa-square' style='color:"+color+"; font-size: 150%;'></i></td><td>"+abrevit+"</td><td>$ "+valorInsumo+"</td><td>"+cantNec+"</td><td>"+valorIns+"</td>";
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

      //funcion que asocia insumos al momento de modificar ficha
      function asociarInsumoFicha(id, nombre, ref, insumos, valorProm, color, idbt, abrevt){
          var campos = $(insumos).parent().parent();
          // valorcm = valorProm / 100;
          valorProm = Math.round(valorProm);

          //insumo que se quiere agregar
          idNuevoInsumo = id;

          //Comparar con los que ya estan agregados
          insumo = "#idInsu"+id;
          valor = $(insumo).val()

          if (idNuevoInsumo == $(insumo).val()) 
          {
            boton = "#btn"+id;
            $(boton).attr('disabled', 'disabled');
          }
          else
          {
            var tr = "<tr class='box box-solid collapsed-box'><td>"+nombre+"</td><td><i class='fa fa-square' style='color:"+color+"; font-size: 150%;'></i></td><td>"+abrevt+"</td><td><p>$ "+valorProm+"</p></td><td><input type='text' min='1' id='cantNec"+id+"' name='cantNecesaria[]' value='0' onkeyup='res"+id+".value=cantNec"+id+".value * "+valorProm+"; subt"+id+".value=parseFloat(res"+id+".value); valorProduccion();' style='border-radius:5px;'></td><td><input class='subtotal' type='hidden' name='valorInsumo[]' id='subt"+id+"'value='0'><input readonly='' type='text' id='capValor"+id+"' name='res"+id+"' for='cantNec"+id+"' style='border-radius:5px;'></td><td><button type='button' class='btn btn-box-tool' onclick='quitarInsumo("+id+", this, subt"+id+".value)'><i class='fa fa-remove'></i></button></td><input type='hidden' id='idInsu"+id+"' name='idInsumo[]' value="+id+"></tr>";
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

      //Cambia estado a la ficha técnica (Habilita/Inhabilita)
      function cambiarEstadoFicha(ref, est){
        console.log(ref, est);
        $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ctrFicha/cambiarEstadoFicha",
            data: {referencia:ref, estado:est}
        }).done(function(respuesta){
            if (respuesta.v == "1") {
                Lobibox.notify('info', {size: 'mini', msg: 'El estado ha sido modificado', rounded: true, delay: false});
            }else{
                Lobibox.notify('info', {msg: 'Error al cambiar el estado', rounded: true, delay: false});
            }
        }).fail(function(){})
      }



        