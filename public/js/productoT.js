 
 function ProductoT(Referencia, productos){
    $("#cantidadSalida").val("");
    $("#descripcionSalida").val("");
    var campos = $(productos).parent().parent();
    $("#Referencia").val(campos.find("td").eq(0).text());
    $("#nombreProdto").val(campos.find("td").eq(1).text());
    $("#Color").val(campos.find("td").eq(3).text());
    $("#idf").val(campos.find("td").eq(4).text());
    $("#cantActual").val(campos.find("td").eq(6).text());
    $("#ModelSalida").show();
    }
    $(document).ready(function(){
        $('#tablaProducto').DataTable( {
          // "lengthChange": false,
          //"searching": false,
          // "info": false,
          "ordering": false,
      "language": {
          "emptyTable": "No hay producto terminado para listar.",
          "info": "Mostrando página _PAGE_ de _PAGES_",
          "infoEmpty": "Mostrando página _PAGE_ de _PAGES_",
          "zeroRecords": "No hay producto terminado que coincida con la búsqueda.",
      "paginate": {
        "previous": "Anterior",
        "next": "Siguiente"
       }
      },
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]]
        });
      });


    function Salida(){
      $("#descripcionSalidas").val("");
          $("#tbodySal").empty();
          var band = false;
          // var cont = 0;
          $("#tablaProducto tbody tr").each(function(i,v){
            var valor = $(this).find("td").eq(0).html();
            // console.log($(this).find("td").eq(0));
            if ($("#chkSali"+valor).prop("checked")) {
              var fila = "<tr class='trValCantidades'><td style='display: none;'>"+valor+"</td><td> <input type='hidden' name='Referencia[]' value='"
              +$(this).find("td").eq(0).html()+"'>"+$(this).find("td").eq(0).html()+"</td><td><input name='Nombre[]' type= 'hidden' value='"
              +$(this).find("td").eq(1).html()+"'>"+$(this).find("td").eq(1).html()+"</td><td><input name='Color[]' type= 'hidden' value='"
              +$(this).find("td").eq(3).html()+"'>"+$(this).find("td").eq(3).html()+"</td><td><input type='hidden' class='cantidadA' name='Cantidad[]' value='"
              +$(this).find("td").eq(6).html()+"'>"+$(this).find("td").eq(6).html()+"</td><td style='display: none'><input type='hidden' name='idf[]' value='"
              +$(this).find("td").eq(4).html()+"'></td><td><input min='0' data-parsley-required type='number' name='salida[]' style='border-radius:5px;'></td></tr>";
              $("#tbodySal").append(fila);
              band = true;
            }
            // cont++;
          });
          if (band) {
              $("#ModalSalidas").modal();
          }else{
              Lobibox.notify('warning', {delay: 6000, size: 'mini', msg: 'Debe seleccionar productos'});
          }
        }


function asociarFichas(Id_Ficha_Tecnica, Referencia, fichas, idbton, codColor, nombreProducto, nombreColorF){

  var campos = $(fichas).parent().parent();
  CantidadO= $("#CantidadO"+Referencia).val();
  $("#tblVaciaObj").remove();
  // $("#FichasS").removeAttr("hidden");
  var tr = "<tr class='box box-solid trFichasObj' id=''><input type='hidden' value='"+Id_Ficha_Tecnica+"' name=Id_Ficha_Tecnica[]><td>"+Referencia+"<input type='hidden' value='"+Referencia+"' name=Referencia[]></td><td>"+nombreProducto+"</td><td><i class='fa fa-square' style='color:"+codColor+"; font-size: 200%;' title='"+nombreColorF+"'></i></td><td><input type='number' data-parsley-required='' name=CantidadO[] id='cantTotal"+Id_Ficha_Tecnica+"' onkeyup='subtotal"+Id_Ficha_Tecnica+".value=parseFloat(cantTotal"+Id_Ficha_Tecnica+".value); TotalFC();' style='border-radius:5px;' value='0'></td><input type='hidden' name='subtotal"+Id_Ficha_Tecnica+"' class='subtotal' id='subtotal"+Id_Ficha_Tecnica+"' value='0'><td><button type='button' onclick='quitarFichaObj("+idbton+",this,subtotal"+Id_Ficha_Tecnica+".value)' class='btn btn-box-tool btnObjt'><i style='font-size:150%;' class='fa fa-remove'></i></button></td></tr>";
  
  $("#tablaFichass").append(tr);
    boton = "#btnobj"+idbton;
    $(boton).attr('disabled', 'disabled');
  }

  $(document).ready(function(){
    $("#tblFichasObje").html("No hay productos seleccionados.");
  });


// $("#tablaFichass tbody tr").each(function(){
//   $("#cantTotal"+Id_Ficha_Tecnica).on("keyup", function(){
//             $("#TotalT"+Id_Ficha_Tecnica).val("#cantTotal"+Id_Ficha_Tecnica).val();
//   });
// });

function TotalFC(){

  var total=0;
  $(".subtotal").each(function(){
    if (isNaN($(this).val())) {
      $(this).val(0);
    }else{
      total+=parseFloat($(this).val());
    }
  });
  $("#TotalT").val(total);
}

$(function(){
 $('#Fecha_Inicio').datepicker({
   format: "yyyy-mm-dd",
   autoclose: true,
   language: 'es'
 });
});


  $('#FechaInicioMod').datepicker({
          format: "yyyy-mm-dd",
          language: 'es',
          autoclose: true
          // todayBtn: true
        }).on(
          'show', function() {      
          // Obtener valores actuales z-index de cada elemento
          var zIndexModal = $('#ModificarObj').css('z-index');
          var zIndexFecha = $('.datepicker').css('z-index');
          // Re asignamos el valor z-index para mostrar sobre la ventana modal
          $('.datepicker').css('z-index',zIndexModal+1);
        });


  $('#Fecha_FinMod').datepicker({
          format: "yyyy-mm-dd",
          language: 'es',
          autoclose: true
          // todayBtn: true
        }).on(
          'show', function() {      
          // Obtener valores actuales z-index de cada elemento
          var zIndexModal = $('#ModificarObj').css('z-index');
          var zIndexFecha = $('.datepicker').css('z-index');
          // Re asignamos el valor z-index para mostrar sobre la ventana modal
          $('.datepicker').css('z-index',zIndexModal+1);
        });

$(function(){
 $('#Fecha_Fin').datepicker({
   format: "yyyy-mm-dd",
   autoclose: true,
   language: 'es'
 });
});


$(function(){
 $('#FechaRegistro').datepicker({
   format: "yyyy-mm-dd",
   autoclose: true,
   language: 'es'
 });
});

$(function(){
 $('#FechaInicio').datepicker({
   format: "yyyy-mm-dd",
   autoclose: true,
   language: 'es'
 });
});

$(function(){
 $('#FechaFin').datepicker({
   format: "yyyy-mm-dd",
   autoclose: true,
   language: 'es'
 });
});


   function listarO(Id_Objetivo, objetivos){
          var campos = $(objetivos).parent().parent();
           $("#FichasO").empty();

    $.ajax({

            dataType: 'json',
            type: 'post',
            url: uri+"ctrObjetivos/listarF",
            data: {objetivo: Id_Objetivo },
            success: function(data){
               // $("#Nombre").val(campos.find("td").eq(1).text());
            for (var i = 0; i < data.length; i++) {
              Codigo=data[i]["Codigo"];
              var fila = '<tr><td style=display:none;>'+data[i]["Codigo"]+'<input type="hidden" name="Codigo[]" value="'+Codigo+'"/></td><td>'+data[i]["Referencia"]+'</td><td>'+data[i]["Nombre"]+'</td><td><i class="fa fa-square" style="font-size:200%; color:'+data[i]["Codigo_Color"]+'" title="'+data[i]["Nombre_Color"]+'"></i></td><td>'+data[i]["Cantidad"]+'</td></tr>'; 
              $("#FichasO").append(fila);
                          } 
            }, 
            error: function(){
            }
        });
  
    }


     function ModificarObj(Id_Objetivo, Fecha_Registro, Fecha_Inicio, Nombre, Fecha_Fin, objetivos){
          var campos = $(objetivos).parent().parent();
          $("#FichasOM").empty();
          $("#Id_Objetivo").val(campos.find("td").eq(0).text());
          $("#Fecha_Registro").val(campos.find("td").eq(1).text());


          var $fechaInicio = $("#FechaInicioMod").val(campos.find("td").eq(3).text());
          $("#FechaInicioMod").on('blur', function(ev){
            if (!$.trim($fechaInicio.val())) {
              $fechaInicio.val(campos.find("td").eq(3).text());
            }
          });
          
          var $fechaFin = $("#Fecha_FinMod").val(campos.find("td").eq(4).text());
          $("#Fecha_FinMod").on('blur', function(ev){
            if (!$.trim($fechaFin.val())) {
              $fechaFin.val(campos.find("td").eq(4).text());
            }
          });

          $("#Nombre").val(campos.find("td").eq(2).text());
          $("#Id_Estado").val(campos.find("td").eq(7).text()); 
          $("#TotalTN").val(campos.find("td").eq(5).text()); 
          
           // $("#nombre_rol").val(Nombre);
    $.ajax({

            dataType: 'json',
            type: 'post',
            url: uri+"ctrObjetivos/listarF",
            data: {objetivo: Id_Objetivo },
            success: function(data){
               // $("#Nombre").val(campos.find("td").eq(1).text());
            for (var i = 0; i < data.length; i++) {



              Codigo = data[i]["Codigo"];
              Id_Ficha_Tecnica = data[i]["Id_Ficha_Tecnica"];
              var nombreFicha = data[i]["Nombre"];
              cantidad = data[i]["Cantidad"];
              nombreColorF = data[i]["Nombre_Color"];
              codColorF = data[i]["Codigo_Color"];

              var fila = "<tr class='trFichasObModif'><input type='hidden' value='"+Id_Ficha_Tecnica+"' name=Id_Ficha_Tecnica[] id='id_fichTec"+Id_Ficha_Tecnica+"'><td>"+data[i]["Referencia"]+"<input type='hidden' value='"+data[i]["Referencia"]+"' name='Referencia[]' ></td><td>"+nombreFicha+"</td><td><i class='fa fa-square' style='color:"+codColorF+"; font-size: 200%;' title='"+nombreColorF+"'></i></td><td><input type='number' class='cantTotalN' min='1' maxlength='10' style='border-radius:5px;' value='"+cantidad+"' name=CantidadN[] id='cantTotalN"+Id_Ficha_Tecnica+"' onkeyup='subtotal"+Id_Ficha_Tecnica+".value=parseFloat(cantTotalN"+Id_Ficha_Tecnica+".value); TotalFCN();'></td><input type='hidden' name='subtotal' class='subtotal' id=subtotal"+Id_Ficha_Tecnica+" value='"+cantidad+"'><td><button type='button' onclick='quitarPermisosR("+Id_Ficha_Tecnica+", this, subtotal"+Id_Ficha_Tecnica+".value)' class='btn btn-box-tool'><i style='font-size:150%;' class='fa fa-remove'></i></button></td></tr>";
              $("#FichasOM").append(fila);


            } 
            }, 
            error: function(){
            }
        });
    }


    function quitarFichaObj(btn, elemento, subtotal){

    $("#tablaFichass").each(function(){
       if ($("#tablaFichass tbody .trFichasObj").length < 2){
    var tr = "<tr id='tblVaciaObj'><td id='tblFichasObje' colspan='5' style='text-align:center;'></td></tr>";
    $("#tablaFichass").append(tr);
    $("#tblFichasObje").html("No hay productos seleccionados.");
    }
    });

    var e = $(elemento).parent().parent();
    $(e).remove();
    boton = "#btnobj"+btn;
    $(boton).attr('disabled',false);
    valor_tota = $("#TotalT").val();
    desc = valor_tota-subtotal;
    $("#TotalT").val(desc);

}


function quitarPermisosR(btn, elemento, subtotal){

  $("#tablaFiOM").each(function(){
       if ($("#tablaFiOM tbody .trFichasObModif").length < 2){
    var tr = "<tr id='tblVaciaObjModf'><td id='tblFichasObjeMod' colspan='5' style='text-align:center;'></td></tr>";
    $("#tablaFiOM").append(tr);
    $("#tblFichasObjeMod").html("No hay productos seleccionados.");
    }
    });


var e = $(elemento).parent().parent();
    $(e).remove();
    boton = "#btnobjMod"+btn;
    $(boton).attr('disabled',false);
    valor_tota = $("#TotalTN").val();
    desc = valor_tota-subtotal;
    $("#TotalTN").val(desc);
}

function limpiarFormRegObj(){
    $("#tablaFichass tbody .trFichasObj").remove();
    if (!$("#tablaFichass tbody tr #tblFichasObje").length) {

      var tr = "<tr><td id='tblFichasObje' colspan='5' style='text-align:center;'></td></tr>";
      $("#tablaFichass").append(tr);
      $("#tblFichasObje").html("No hay productos seleccionados.");
      $(".btnasociarObje").attr('disabled', false);
      }
}

       function listarON(Id_Objetivo, objetivos){
          var campos = $(objetivos).parent().parent();
          // $("#idRol").val(campos.find("td").eq(0).text());
          // $("#nombre_rol").val(campos.find("td").eq(1).text());
           $("FichasON").empty();
           // $("#nombre_rol").val(Nombre);

    $.ajax({

            dataType: 'json',
            type: 'post',
            url: uri+"ctrObjetivos/listarF",
            data: {objetivo: Id_Objetivo },
            success: function(data){
               // $("#Nombre").val(campos.find("td").eq(1).text());
            for (var i = 0; i < data.length; i++) {
              Codigo=data[i]["Codigo"];
              var fila = '<tr><td>'+data[i]["Codigo"]+'<input type="hidden" name="Codigo[]" value="'+Codigo+'"/></td><td>'+data[i]["Referencia"]+'</td><td>'+data[i]["Cantidad"]+'</td></tr>'; 
              $("#FichasON").append(fila);
                } 
            }, 
            error: function(){
            }
        });
  
    }



function asociarFichasNuevas(Id_Ficha_Tecnica, Referencia, fichas, idbotn, codColorMod, nombreProd){
  var campos = $(fichas).parent().parent();
  CantidadN = $("#CantidadN"+Referencia).val();
  var nombreColorFMod = campos.find("td").eq(7).text();

  objetnuevo = Id_Ficha_Tecnica;
  objagregado = "#id_fichTec"+Id_Ficha_Tecnica;

  if (objetnuevo == $(objagregado).val()) {
    boton = "#btnobjMod"+idbotn;
    $(boton).attr('disabled', 'disabled');

  }else{
    var tr = "<tr class='trFichasObModif'><input type='hidden' value='"+Id_Ficha_Tecnica+"' name=Id_Ficha_Tecnica[]><td>"+Referencia+"<input type='hidden' value='"+Referencia+"' name=Referencia[]></td><td>"+nombreProd+"</td><td><i class='fa fa-square' style='color:"+codColorMod+"; font-size: 200%;' title='"+nombreColorFMod+"'></i></td><td><input type='number' min='0' maxlength='10' style='border-radius:5px;' onkeyup='subtotal"+Id_Ficha_Tecnica+".value=parseFloat(cantTotalN"+Id_Ficha_Tecnica+".value); TotalFCN();' class='cantTotalN' value=0 name=CantidadN[] id='cantTotalN"+Id_Ficha_Tecnica+"'></td><input type='hidden' class='subtotal' name='subtotal' id=subtotal"+Id_Ficha_Tecnica+" value='0'><td><button type='button' onclick='quitarPermisosR("+Id_Ficha_Tecnica+", this, subtotal"+Id_Ficha_Tecnica+".value)' class='btn btn-box-tool'><i style='font-size:150%;' class='fa fa-remove'></i></button></td></tr>";

    $("#tblVaciaObjModf").remove();
    $("#tablaFiOM").append(tr);
    boton = "#btnobjMod"+idbotn;
    $(boton).attr('disabled', 'disabled');
    }
  }



// $("#tablaFiOM tbody tr").each(function(){  $("#cantTotalN"+Id_Ficha_Tecnica).on("keyup", function(){
//             $("#TotalTN"+Id_Ficha_Tecnica).val("#cantTotalN"+Id_Ficha_Tecnica).val();
//   });
// });

function TotalFCN(){
  var totalN=0;
  $(".subtotal").each(function(){
    if (isNaN($(this).val())) {
      $(this).val(0);
    }else{
    totalN=totalN+parseFloat($(this).val());
  }
  });
  $("#TotalTN").val(totalN);
}


  
      function cancelarobjetivo(Id_Objetivo){

        swal({
          title: "¿Está seguro?",   
          text: "El objetivo quedará en estado cancelado!",  
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Sí, cancelar objetivo",
          cancelButtonText: "No, terminar",
          closeOnConfirm: false,
          closeOnCancel: false },
          function(isConfirm){
            if (isConfirm)
            { 
              $.ajax({
            type: 'post',
            dataType: 'json',
            url: uri+"ctrObjetivos/cancelarobjetivo",
            data:{Id_Objetivo: Id_Objetivo}
            }).done(function(respuesta){
              if (respuesta.r == 1) {
                // swal("Cancelado", "El Pedido ha sido cancelado", "success");
                // location.href = uri+"ctrPedido/consPedido";
              }else{
                alert("Error al cancelar el objetivo");
              }
            }).fail(function(){
            })  
              swal("Cancelado", "El objetivo ha sido cancelado", "success");
              location.href = uri+"ctrObjetivos/listarObjetivos";
            }
            else
            {
              swal("Acción interrumpida", "No se completo la acción.", "error");
            }
          });
        }




function valFormModObj(){
  var fecha_RegiMod = $("#Fecha_Registro").val();
  var Fecha_InicioMod = $("#FechaInicioMod").val();
  var fecha_finalMod = $("#Fecha_FinMod").val();

  var respfechaIncioMod = true;
  var respfechaFinMod = true;
  var respTablaMod = true;

  if (Fecha_InicioMod < fecha_RegiMod) {
      Lobibox.notify('warning', {size: 'mini', msg: 'Debe ingresar una fecha de inicio superior a la fecha actual'});
    respfechaIncioMod = false;

  }

  if (fecha_finalMod <= Fecha_InicioMod) {
      Lobibox.notify('warning', {size: 'mini', msg: 'La fecha final debe ser mayor a la fecha de inicio'});
    respfechaFinMod = false;
  }

  if ($("#tblVaciaObjModf").length)
  {
    Lobibox.notify('warning', {size: 'mini', msg: 'Seleccione al menos un producto para el objetivo'});
    respTablaMod = false;
  }

  if (respfechaIncioMod && respfechaFinMod && respTablaMod) {
    return true;
  }
  else{
    return false;
  }
return false;
}


function ValObj(){
  var fecha_Regi = $("#Fecha_Registro").val();
  var Fecha_Inicio = $("#Fecha_Inicio").val();
  var fecha_final = $("#Fecha_Fin").val();

  var respfechaIncio = true;
  var respfechaFin = true;
  var respTabla = true;

  if (Fecha_Inicio < fecha_Regi) {
      Lobibox.notify('warning', {size: 'mini', msg: 'Debe ingresar una fecha de inicio superior a la fecha actual'});
    respfechaIncio = false;

  }

  if (fecha_final <= Fecha_Inicio) {
      Lobibox.notify('warning', {size: 'mini', msg: 'La fecha final debe ser mayor a la fecha de inicio'});
    respfechaFin = false;
  }

  if ($("#tblFichasObje").length)
  {
    Lobibox.notify('warning', {size: 'mini', msg: 'Seleccione al menos un producto para el objetivo'});
    respTabla = false;
  }

  if (respfechaIncio && respfechaFin && respTabla) {
    return true;
  }
  else{
    return false;
  }
return false;
}



    $(document).ready(function(){
        $('#TablaObjetivos').DataTable( {
          // "lengthChange": false,
          //"searching": false,
          // "info": false,
          "ordering": false,
      "language": {
          "emptyTable": "No hay objetivos para listar.",
          "info": "Mostrando página _PAGE_ de _PAGES_",
          "infoEmpty": "Mostrando página _PAGE_ de _PAGES_",
          "zeroRecords": "No hay objetivos que coincidan con la búsqueda.",
      "paginate": {
        "previous": "Anterior",
        "next": "Siguiente"
       }
      },
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]]
        });
      });

      
function validarCantidadSalida(){
  var cantiActual = $("#cantActual").val();
  var cantiSalir = $("#cantidadSalida").val();
  if (parseInt(cantiSalir) <= parseInt(cantiActual)) {
    return true;
  }else{
    Lobibox.notify('warning', {size: 'mini', delayIndicator: false, msg: 'La cantidad de salida no debe ser mayor a la cantidad actual.'});
    return false;
  }
  return false;
}

function validarSalidasMultiples(){
  var bandera = 0;
  $("#tableSal .trValCantidades").each(function(i, v){
    var c = i + 1;
    $(".cantidadA").attr("id", "hola"+c);


  //   var cantidadActual = $(".cantActl").val();
  //   var cantidadSalida = $(".Salida").val();
  //   console.log(cantidadActual, cantidadSalida);
  //   if (parseInt(cantidadSalida) > parseInt(cantidadActual)) {
  //     $(".Salida").val("");
  //     return bandera = 1;
  //   }
  c++;
  });
  // console.log(bandera);
  if (bandera == 1) {
    Lobibox.notify('warning', {size: 'mini', delayIndicator: false, msg: 'La cantidad de salida no debe ser mayor a la cantidad actual.'});
    return false;
  }else{
    return false;
  }
  return false;
}

function genRepExtProductoT(){
  var existenciasProductoT = [];
  $(".repProdT .repProdTerm, .badge").each(function(i,v){
    existenciasProductoT.push(v.outerText);
  });

  $.ajax({
    dataType : 'json',
    type : 'POST',
    url : uri+"ctrProductoT/reporteExistenciasProdT",
    data: {arrayExistPT : existenciasProductoT}
  }).done(function(respuesta){
    if (respuesta.r == 1) {
      location.href = uri+"ctrProductoT/reporteProductoTerminado";
    }
  });
}

$('document').ready(function(){
   $("#checkPadreSalidas").change(function(){
      $("input:checkbox").prop('checked', $(this).prop("checked"));
  });
});

$(".checkboxHijoPT").change(function(){
  var checkboxesPT = $("input:checkbox:checked").length;
   if($(this).is(':checked') && checkboxesPT > 1){
    $("#salidaMultiplePT").removeAttr("disabled");
    $(".arrowSalida").attr("disabled", "disabled");
   }else if(checkboxesPT == 1){
    $(".arrowSalida").removeAttr("disabled");
    $("#salidaMultiplePT").attr("disabled", "disabled");
   }
});

$("#checkPadreSalidas").change(function(){
   if($(this).is(':checked')){
    $(".arrowSalida").attr("disabled", "disabled");
    $("#salidaMultiplePT").removeAttr("disabled");
   }else{
    $(".arrowSalida").removeAttr("disabled");
    $("#salidaMultiplePT").attr("disabled", "disabled");
   }
});

$('#tblObjetivosAsoProdts').dataTable({
    "ordering": false,
    "language": {
        "emptyTable": "No hay productos para listar.",
        "info": "Mostrando página _PAGE_ de _PAGES_",
        "infoEmpty": "Mostrando página _PAGE_ de _PAGES_",
        "zeroRecords": "No se encontraron productos que coincidan con la búsqueda.",
    "paginate": {"previous": "Anterior","next": "Siguiente"}
    }
  });

