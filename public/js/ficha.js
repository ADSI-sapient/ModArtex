

        //permite seleccionar y asociar tallas al registrar ficha técnica
        $("#selectTallas").select2({
          language: {
          noResults: function (params) {
          return "No hay resultados";
          }}
        });
     
        //permite seleccionar y asociar un color a la ficha técnica al registrarla
        $("#colorFicha").select2({
          language: {
          noResults: function (params) {
          return "No hay resultados";
          }}
        });

        //permite seleccionar y asociar un color a la ficha técnica al modificar
        $("#colorModFicha").select2({
          language: {
          noResults: function (params) {
          return "No hay resultados";
          }}
        });

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

      function colorFichaModi(idficha)
      {
        $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ctrFicha/mostrarUnColor",
            data: {idficht: idficha}
        }).done(function(respuesta){
          if (respuesta.r != null) {
            miArray = respuesta.r;
              codColor = miArray['Codigo_Color'];
              if ($("#colorModFicha").val() == miArray['Id_Color']) {
                $("#colorFMod").css("color", codColor);
                // $("#colorFMod").css("background-color", codColor);
              }
          }
        });
      }

      //pinta el div con el color correspondiente a la opción seleccionada en el select color de ficha
      function coloresFichas(){
        $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ctrFicha/mostrarColores"
            // async: false
        }).done(function(respuesta){
          if (respuesta.r != null) {
            miArray = respuesta.r;
            for (var i = 0; i <= miArray.length - 1; i++) {
              codColor = miArray[i]['Codigo_Color'];

              if ($("#colorFicha").val() == miArray[i]['Id_Color']) {
                $("#colorF").css("color", codColor);
                // $("#colorF").css("background-color", codColor);
              }

              if ($("#colorModFicha").val() === miArray[i]['Id_Color']) {
                $("#colorFMod").css("color", codColor);
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
        $("#nombreFichaMod").val(campos.find("td").eq(1).text());
        $("#fecha_reg").val(campos.find("td").eq(2).text());
        $("#estado").val(campos.find("td").eq(3).text());
        $("#colorModFicha").val(idColor).trigger("change");
        $("#stock_min").val(campos.find("td").eq(5).text());
        $("#vlr_produccion").val(campos.find("td").eq(6).text());
        $("#vlr_producto").val(campos.find("td").eq(7).text());
        $("#mdEditFicha").show();
      }

      //permite habilitar los botones de agregar en los modals de asociar tallas e insumos al modificar
      function habilitarAsociaciones(){
        $(".btn-box-tool").removeAttr("disabled");
      }

      function valorProduccion(){
        var total=0;
        $(".subtotal").each(function(){
          total=total+parseFloat($(this).val());
        });
        $("#vlr_produccion").val(total);
      }

      function quitarInsumo(btn, elemento, subtotal){

        $("#tablaInsumos").each(function(){
          if ($("#tablaInsumos tbody .trfichas").length < 2){
            var tr = "<tr><td id='tblInsumosVacia' colspan='8' style='text-align:center;'></td></tr>";
            $("#tablaInsumos").append(tr);
            $("#tblInsumosVacia").html("No hay insumos asociados");
            }
        });

        var e = $(elemento).parent().parent();
        $(e).remove();
        boton = "#btn"+btn;
        $(boton).attr('disabled', false);
        valortotal = $("#vlr_produccion").val();
        desc = valortotal - subtotal;
        $("#vlr_produccion").val(desc);
      }

      function quitarInsumoModFicha(btn, elemento, subtotal){

        $("#tbl-insumos-aso").each(function(){
          if ($("#tbl-insumos-aso tbody .trInsumosAsoModFicha").length < 2){
            var tr = "<tr><td id='tblInsumosModFichaVacia' colspan='8' style='text-align:center;'></td></tr>";
            $("#tbl-insumos-aso").append(tr);
            $("#tblInsumosModFichaVacia").html("No hay insumos asociados");
            }
        });

        var e = $(elemento).parent().parent();
        $(e).remove();
        boton = "#btn"+btn;
        $(boton).attr('disabled', false);
        valortotal = $("#vlr_produccion").val();
        desc = valortotal - subtotal;
        $("#vlr_produccion").val(desc);
      }



      $(document).ready(function(){
        $("#tblInsumosVacia").html("No hay insumos asociados");
      });

      //funcion que asocia insumos al momento de registrar una ficha
      function asociarInsumosHab(id_insumo, nombre, color, insumos, idbton, estado, valorPromedio, unidadMed, nombColInsu){
        var campos = $(insumos).parent().parent();
        // valorcm = valorPromedio / 100;
        valorPromedio = Math.round(valorPromedio);

        $("#tablaInsumos tbody tr #tblInsumosVacia").remove();
        var tr = "<tr id='' class='box box-solid collapsed-box trfichas'><td>"+id_insumo+"</td><td>"+nombre+
        "</td><td><i class='fa fa-square' style='color: "+color+"; font-size: 200%;' title='"+nombColInsu+"'></i></td><td>"
        +unidadMed+"</td><td>$ "+valorPromedio+"</td><td><input step='any' maxlength='10' type='number' id='cantNec"
        +idbton+"' name='cantNecesaria[]' value='' onkeyup='res"+idbton+".value=cantNec"+idbton+
        ".value * "+valorPromedio+"; subt"+idbton+".value=parseFloat(res"+idbton+".value); valorProduccion(); animarTotal();' data-parsley-required='' style='border-radius:5px;'></td><td><input class='subtotal' type='hidden' name='valorInsumo[]' id='subt"
        +idbton+"'value='0'><div class='input-group'><span class='input-group-addon' style='border:none; background-color:transparent;'>$</span><input readonly='' type='text' id='capValor"+idbton+"' name='res"
        +idbton+"' for='cantNec"+idbton+"' style='border-radius:5px;'></div></td><td><button type='button' onclick='quitarInsumo("+idbton+", this, subt"+idbton+".value)' class='btn btn-box-tool' id='btn'><i style='font-size: 150%' class='fa fa-remove'></i></button></td><input type='hidden' name='idInsumo[]' value="+id_insumo+"><td style='display:none'>"+id_insumo+"</td></tr>";
        $("#tablaInsumos").append(tr);
        boton = "#btn"+idbton;
        $(boton).attr('disabled', 'disabled');


      //   $('#tablaInsumos').dataTable({
      //   "ordering": false,
      //   "language": {
      //       "emptyTable": "No hay insumos para listar.",
      //       "info": "Mostrando página _PAGE_ de _PAGES_",
      //       "infoEmpty": "Mostrando página _PAGE_ de _PAGES_",
      //       "zeroRecords": "No se encontraron insumos que coincidan con la búsqueda.",
      //   "paginate": {"previous": "Anterior","next": "Siguiente"}
      //   }
      // });
      }

      //limpia los valores del formulario y reinicia los input acumuladores y total.
      function limpiarFormRegFicha(){
        valor = 0;
        $(".subtotal").each(function(){
          $(this).val(valor);
        });
        $("#vlr_produccion").val(valor);

        $("#tablaInsumos tbody .trfichas").remove();
        if (!$("#tablaInsumos tbody tr #tblInsumosVacia").length) {
        var tr = "<tr><td id='tblInsumosVacia' colspan='8' style='text-align:center;'></td></tr>";
        $("#tablaInsumos").append(tr);
        $("#tblInsumosVacia").html("No hay insumos asociados");
        $(".btnInsumo").attr('disabled', false);
        }

        $("#selectTallas").select2("val", "");
        $("#colorFicha").select2("val", "");
        $("#colorF").css("color", "gray");
      }

      //valida todos los campos necesarios para el registro en el formulario
      function enviarFormFicha()
      {
        var res = true;
        var referencia = $("#referencia").val();
        var idcolor = $("#colorFicha").val();
        var nombrecolor = $("#colorFicha option:selected").html();
        var vlrproduccion = parseFloat($("#vlr_produccion").val());
        var vlrproducto = parseFloat($("#vlr_producto").val());

        //valida insumos asociados
        if ($("#tablaInsumos tbody tr #tblInsumosVacia").length)
        {
          Lobibox.notify('warning', {size: 'mini', msg: 'Debe asociar al menos un insumo a la ficha'});
          return false;
        }
        //valida que el valor producto sea mayor al valor de producción
        if (vlrproduccion >= vlrproducto) {
          Lobibox.notify('warning', {size: 'mini', msg: 'El valor del producto debe ser mayor al valor total de insumos'});
          return false;
        }

        $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ctrFicha/validarColorRegFicha",
            async: false,
            data: {referencia:referencia, color:idcolor}
        }).done(function(respuesta){
            if (respuesta.r != null) {
              var arrayColorFicha = respuesta.r;
              for (var i = 0; i < arrayColorFicha.length; i++) {
                if (arrayColorFicha[i]["Referencia"] == referencia && arrayColorFicha[i]["Id_Color"] == idcolor) {
                  res = false;
                }
              }

            }
        });

        if (res == false) {
          Lobibox.notify('warning', {size: 'mini', msg: 'Ya existe una ficha '+referencia+' de color '+nombrecolor});
          return false
        }
        else{
          return true;
        }
        return false;
      }

      function validarColorFicha()
      {
        var res = true;
        var referencia = $("#referencia").val();
        var idcolor = $("#colorModFicha").val();
        var nombrecolormod = $("#colorModFicha option:selected").html();
        var vlrproduccion = $("#vlr_produccion").val();
        var vlrproducto = parseFloat($("#vlr_producto").val());
        var idfit = $("#idFicha_Tec").val();

        //valida insumos asociados
        if ($("#tblInsumosModFichaVacia").length)
        {
          Lobibox.notify('warning', {size: 'mini', msg: 'Debe asociar al menos un insumo a la ficha'});
          return false;
        }

          if ($("#tblTallasVacia").length)
        {
          Lobibox.notify('warning', {size: 'mini', msg: 'Debe asociar al menos una talla a la ficha'});
          return false;
        }


        //valida que el valor producto sea mayor al valor de producción
        if (vlrproduccion >= vlrproducto) {
          Lobibox.notify('warning', {size: 'mini', msg: 'El valor del producto debe ser mayor al valor total de insumos'});
          return false;
        }


        $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ctrFicha/validarColorModFicha",
            async: false,
            data: {idficht:idfit}
        }).done(function(respuesta){
            if (respuesta.r != null) {
              var arrayColorFicha = respuesta.r;
              for (var i = 0; i < arrayColorFicha.length; i++) {
                if (arrayColorFicha[i]["Referencia"] == referencia && arrayColorFicha[i]["Id_Color"] == idcolor) {
                  res = false;
                }
              }
            }
        });

        if (res == false) {
          Lobibox.notify('warning', {size: 'mini', msg: 'Ya existe una ficha '+referencia+' de color '+nombrecolormod});
          return false;
        }
        else{
          return true;
        }
        return false;
      }




      $('#insRegFT').dataTable({
        "ordering": false,
        "language": {
            "emptyTable": "No hay insumos para listar.",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Mostrando página _PAGE_ de _PAGES_",
            "zeroRecords": "No se encontraron insumos que coincidan con la búsqueda.",
        "paginate": {"previous": "Anterior","next": "Siguiente"}
        }
      });

      // $('#tablaInsumos').dataTable({
      //   "ordering": false,
      //   "language": {
      //       "emptyTable": "No hay insumos para listar.",
      //       "info": "Mostrando página _PAGE_ de _PAGES_",
      //       "infoEmpty": "Mostrando página _PAGE_ de _PAGES_",
      //       "zeroRecords": "No se encontraron insumos que coincidan con la búsqueda.",
      //   "paginate": {"previous": "Anterior","next": "Siguiente"}
      //   }
      // });

      // $('#tllAsociarRegPedido').dataTable({
      //   "ordering": false,
      //   "language": {
      //       "emptyTable": "No hay tallas para asociar.",
      //       "info": "Mostrando página _PAGE_ de _PAGES_",
      //       "infoEmpty": "Mostrando página _PAGE_ de _PAGES_",
      //       "zeroRecords": "No se encontraron tallas que coincidan con la búsqueda.",
      //   "paginate": {"previous": "Anterior","next": "Siguiente"}
      //   }
      // });

      $('#insAsocFT').dataTable({
        "ordering": false,
        "language": {
            "emptyTable": "No hay productos para asociar.",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Mostrando página _PAGE_ de _PAGES_",
            "zeroRecords": "No se encontraron productos que coincidan con la búsqueda.",
        "paginate": {"previous": "Anterior","next": "Siguiente"}
        }
      });

      $(document).ready(function(){
        $('#tablaFichas').dataTable( {
          // "lengthChange": false,
          //"searching": false,
          // "info": false,
          "ordering": false,
      "language": {
          "emptyTable": "No hay fichas para listar.",
          "info": "",
          "infoEmpty": "",
          "zeroRecords": "No se encontraron fichas que coincidan con la búsqueda.",
      "paginate": {
        "previous": "Anterior",
        "next": "Siguiente"
       }
      },
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]]
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
                nomColor = arrayInsumos[i]['Nombre_Color'];
                var tr = "";
                if (modalFp == 1) {
                    tr = "<tr class='box box-solid collapsed-box trInsumosAsoModFicha'><td>"+nombreIns+"</td><td><i class='fa fa-square' style='color:"+color+"; font-size: 200%;' title='"+nomColor+"'></i></td><td>"+abrevit+"</td><td>"+valorInsumo+"</td><td><input type='text' step='any' id='cantNec"+idIns+"' name='cantNecesaria[]' value='"+cantNec+"' onkeyup='res"+idIns+".value=cantNec"+idIns+".value * "+valorInsumo+"; subt"+idIns+".value=parseFloat(res"+idIns+".value); valorProduccion(); animarTotal();' style='border-radius:5px;' data-parsley-required=''></td><td><input class='subtotal' type='hidden' name='valorInsumo[]' id='subt"+idIns+"' value='"+valorIns+"'><input readonly='' type='text' id='capValor"+idIns+"' name='res"+idIns+"' for='cantNec"+idIns+"' style='border-radius:5px;' value='"+valorIns+"' data-parsley-required='' min='1'></td><td><button type='button' class='btn btn-box-tool' onclick='quitarInsumoModFicha("+idIns+", this, subt"+idIns+".value)' ><i style='font-size:150%' class='fa fa-remove'></i></button></td><input type='hidden'id='idInsu"+idIns+"' name='idInsumo[]' value='"+idIns+"'><input type='hidden' value=''><input type='hidden'' value=''></tr>";
                    $('#tbl-insumos-aso').append(tr);
                 }else{
                    tr = "<tr class='box box-solid collapsed-box'><td>"+nombreIns+"</td><td><i class='fa fa-square' style='color:"+color+"; font-size: 200%;' title='"+nomColor+"'></i></td><td>"+abrevit+"</td><td>$ "+valorInsumo+"</td><td>"+cantNec+"</td><td>"+valorIns+"</td>";
                    $('#dtll-insumos-aso').append(tr);
                 }
              }
              // $('#tbl-insumos-aso').dataTable({
              //   "ordering": false,
              //   "language": {
              //       "emptyTable": "No hay insumos para listar.",
              //       "info": "Mostrando página _PAGE_ de _PAGES_",
              //       "infoEmpty": "Mostrando página _PAGE_ de _PAGES_",
              //       "zeroRecords": "No se encontraron insumos que coincidan con la búsqueda.",
              //   "paginate": {"previous": "Anterior","next": "Siguiente"}
              //   }
              // });
            }
        }).fail(function(){})
    }

    function quitarTallaAso(btn, elemento){

      $("#tbl-tallas-aso").each(function(){
          if ($("#tbl-tallas-aso tbody .trTallasAsoFichaMod").length < 2){
            var tr = "<tr><td id='tblTallasVacia' colspan='4' style='text-align:center;'></td></tr>";
            $("#tbl-tallas-aso").append(tr);
            $("#tblTallasVacia").html("No hay tallas asociadas");
            }
        });

        var e = $(elemento).parent().parent();
        $(e).remove();
        boton = "#btntallas"+btn;
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
                  tr = "<tr id='tr"+idTalla+"' class='box box-solid collapsed-box trTallasAsoFichaMod'><input type='hidden' id='tallas"+idTalla+"' name='tallas[]' value='"+idTalla+"'><td>"+idTalla+"</td><td>"+nombre+"</td><td><button type='button' class='btn btn-box-tool' onclick='quitarTallaAso("+idTalla+", this)'><i style='font-size:150%' class='fa fa-remove'></i></button></td></tr>";
                  $('#tbl-tallas-aso').append(tr);
                }else{
                  tr = "<tr class='box box-solid collapsed-box'><td>"+idTalla+"</td><td>"+nombre+"</td>";
                  $('#dtll-tallas-aso').append(tr);
                }
              }
            }
        }).fail(function(){})
    }

      //funcion que asocia insumos al momento de modificar ficha
      function asociarInsumoFicha(id, nombre, ref, insumos, valorProm, color, idbt, abrevt, nombre_color){
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
            var tr = "<tr class='box box-solid collapsed-box trInsumosAsoModFicha'><td>"+nombre+"</td><td><i class='fa fa-square' style='color:"+color+"; font-size: 200%;' title='"+nombre_color+"'></i></td><td>"+abrevt+"</td><td><p>"+valorProm+"</p></td><td><input type='text' min='1' id='cantNec"+id+"' name='cantNecesaria[]' value='0' onkeyup='res"+id+".value=cantNec"+id+".value * "+valorProm+"; subt"+id+".value=parseFloat(res"+id+".value); valorProduccion();' style='border-radius:5px;'></td><td><input class='subtotal' type='hidden' name='valorInsumo[]' id='subt"+id+"'value='0'><input readonly='' type='text' id='capValor"+id+"' name='res"+id+"' for='cantNec"+id+"' style='border-radius:5px;'></td><td><button type='button' class='btn btn-box-tool' onclick='quitarInsumoModFicha("+id+", this, subt"+id+".value)'><i style='font-size:150%' class='fa fa-remove'></i></button></td><input type='hidden' id='idInsu"+id+"' name='idInsumo[]' value="+id+"></tr>";
            $("#tblInsumosModFichaVacia").remove();
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
            botonn = "#btntallas"+idbton;
            $(botonn).attr('disabled', 'disabled');

          //si no existe la talla acá la agrega
          }else{

            var tr = "<tr id='tr"+id+"' class='box box-solid collapsed-box trTallasAsoFichaMod'><td>"+id+"</td><td>"+nombre+"</td><td><button type='button' class='btn btn-box-tool' onclick='quitarTallaAso("+id+", this)'><i style='font-size:150%' class='fa fa-remove'></i></button></td><input type='hidden' id='tallas"+id+"' name='tallas[]' value="+id+"></tr>";
           
            $("#tblTallasVacia").remove();
            $("#tbl-tallas-aso").append(tr);
            botonn = "#btntallas"+idbton;
            $(botonn).attr('disabled', 'disabled');
          }
      }

      //Cambia estado a la ficha técnica (Habilita/Inhabilita)
      function cambiarEstadoFicha(ref, est){
        $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ctrFicha/cambiarEstadoFicha",
            data: {referencia:ref, estado:est}
        }).done(function(respuesta){
            if (respuesta.v == "1") {
                
                location.href = uri+"ctrFicha/consFicha";
            }else{
                // location.href = uri+"ctrFicha/consFicha";
            }
        }).fail(function(){})
      }

      $('#frmRegFicha').parsley();


        