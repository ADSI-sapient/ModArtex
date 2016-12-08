
 function ProductoT(Referencia, productos){
    $("#cantidadSalida").val("");
    $("#descripcionSalida").val("");
    var campos = $(productos).parent().parent();
    $("#Referencia").val(campos.find("td").eq(1).text());
    $("#nombreProdto").val(campos.find("td").eq(2).text());
    $("#Color").val(campos.find("td").eq(4).text());
    $("#idft").val(campos.find("td").eq(7).text());
    $("#cantActual").val(campos.find("td").eq(8).text());
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
      alertaStockProductoT();
      alertaStockInsumos();
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
              +$(this).find("td").eq(3).html()+"'>"+$(this).find("td").eq(3).html()+"</td><td><i class='fa fa-square' style='color:"+$(this).find("td").eq(12).html()+"; font-size: 200%;'' title='"+$(this).find("td").eq(11).html()+"'></i></td><td><input type='hidden' class='cantidadA' name='Cantidad[]' value='"
              +$(this).find("td").eq(7).html()+"'>"+$(this).find("td").eq(7).html()+"</td><td style='display: none'><input type='hidden' name='idft[]' value='"
              +$(this).find("td").eq(6).html()+"'></td><td><input min='0' data-parsley-required type='number' max='"+$(this).find("td").eq(7).html()+"' name='salida[]' style='border-radius:5px;'></td></tr>";
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


function asociarFichas(Id_Ficha_Tecnica, Referencia, fichas, idbton, codColor, nombreProducto, nombreColorF, idFichasTallas){

  var campos = $(fichas).parent().parent();
  CantidadO= $("#CantidadO"+Referencia).val();
  $("#tblVaciaObj").remove();
  $("#tblFichasObje").remove();
  // $("#FichasS").removeAttr("hidden");

  var prodAAgregar = idFichasTallas;
  var prodEnTabla = $("#Id_Fichas_Tallas"+idFichasTallas).val();

  if (prodAAgregar !== prodEnTabla) {
    var tr = "<tr class='box box-solid trFichasObj' id=''><input type='hidden' id='Id_Fichas_Tallas"+idFichasTallas+"' value='"+idFichasTallas+"' name=Id_Fichas_Tallas[]><td>"+Referencia+"<input type='hidden' value='"+Referencia+"' name=Referencia[]></td><td>"+nombreProducto+"</td><td><i class='fa fa-square' style='color:"+codColor+"; font-size: 200%;' title='"+nombreColorF+"'></i></td><td style='display: none;'></td><td><input type='number' data-parsley-required='' name=CantidadO[] id='cantTotal"+idFichasTallas+"' onkeyup='subtotal"+idFichasTallas+".value=parseFloat(cantTotal"+idFichasTallas+".value); TotalFC();' style='border-radius:5px;' value='0' min='1' maxlength='10'></td><input type='hidden' name='subtotal"+idFichasTallas+"' class='subtotal' id='subtotal"+idFichasTallas+"' value='0'><td><button type='button' onclick='quitarFichaObj("+idbton+",this,subtotal"+idFichasTallas+".value)' class='btn btn-box-tool btnObjt'><i style='font-size:150%;' class='fa fa-remove'></i></button></td></tr>";
    $("#tablaFichass").append(tr);
  }
    // boton = "#btnobj"+idbton;
    // $(boton).attr('disabled', 'disabled');
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
              console.log(data);
              Codigo=data[i]["Codigo"];
              var fila = '<tr><td style=display:none;>'+data[i]["Codigo"]+'<input type="hidden" name="Codigo[]" value="'+Codigo+'"/></td><td>'+data[i]["Referencia"]+'</td><td>'+data[i]["Nombre"]+'</td><td><i class="fa fa-square" style="font-size:200%; color:'+data[i]["Codigo_Color"]+'" title="'+data[i]["Nombre_Color"]+'"></i></td><td>'+data[i]["Nombre_Color"]+'</td><td style="display: none;"></td><td>'+data[i]["Cantidad"]+'</td></tr>'; 
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

              var Codigo = data[i]["Codigo"];
              var Id_Ficha_Tecnica = data[i]["Id_Ficha_Tecnica"];
              var idFichasTallas = data[i]["Id_Ficha_Tecnica"];
              var nombreFicha = data[i]["Nombre"];
              var cantidad = data[i]["Cantidad"];
              var nombreColorF = data[i]["Nombre_Color"];
              var codColorF = data[i]["Codigo_Color"];
              var nombreTalla = data[i]["Nombre_Talla"];
              // var idFichasTallas = data[i]["Id_Fichas_Tallas"];

              var fila = "<tr class='trFichasObModif'><input type='hidden' value='"+idFichasTallas+"' name=Id_Fichas_Tallas[] id='id_fichTallas"+idFichasTallas+"'><td>"+data[i]["Referencia"]+"<input type='hidden' value='"+data[i]["Referencia"]+"' name='Referencia[]' ></td><td>"+nombreFicha+"</td><td><i class='fa fa-square' style='color:"+codColorF+"; font-size: 200%;' title='"+nombreColorF+"'></i></td><td style='display: none;'></td><td><input type='number' class='cantTotalN' min='1' maxlength='10' style='border-radius:5px;' value='"+cantidad+"' name=CantidadN[] id='cantTotalN"+idFichasTallas+"' onkeyup='subtotal"+idFichasTallas+".value=parseFloat(cantTotalN"+idFichasTallas+".value); TotalFCN();'></td><input type='hidden' name='subtotal' class='subtotal' id=subtotal"+idFichasTallas+" value='"+cantidad+"'><td><button type='button' onclick='quitarPermisosR("+idFichasTallas+", this, subtotal"+idFichasTallas+".value)' class='btn btn-box-tool'><i style='font-size:150%;' class='fa fa-remove'></i></button></td></tr>";
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
    var tr = "<tr id='tblVaciaObj'><td id='tblFichasObje' colspan='6' style='text-align:center;'></td></tr>";
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
    var tr = "<tr id='tblVaciaObjModf'><td id='tblFichasObjeMod' colspan='6' style='text-align:center;'></td></tr>";
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
      var tr = "<tr><td id='tblFichasObje' colspan='6' style='text-align:center;'></td></tr>";
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



function asociarFichasNuevas(Id_Ficha_Tecnica, Referencia, fichas, idbotn, codColorMod, nombreProd, idFichasTall){
  var campos = $(fichas).parent().parent();
  CantidadN = $("#CantidadN"+Referencia).val();
  var nombreColorFMod = campos.find("td").eq(8).text();

  objetnuevo = idFichasTall;
  objagregado = $("#id_fichTallas"+idFichasTall).val();
  console.log(objetnuevo, objagregado);

  if (objetnuevo !== objagregado) {
    var tr = "<tr class='trFichasObModif'><input type='hidden' id='id_fichTallas"+idFichasTall+"' value='"+idFichasTall+"' name=Id_Fichas_Tallas[]><td>"+Referencia+"<input type='hidden' value='"+Referencia+"' name=Referencia[]></td><td>"+nombreProd+"</td><td><i class='fa fa-square' style='color:"+codColorMod+"; font-size: 200%;' title='"+nombreColorFMod+"'></i></td><td style='display: none;'></td><td><input type='number' min='1' maxlength='10' style='border-radius:5px;' onkeyup='subtotal"+idFichasTall+".value=parseFloat(cantTotalN"+idFichasTall+".value); TotalFCN();' class='cantTotalN' value=0 name=CantidadN[] id='cantTotalN"+idFichasTall+"'></td><input type='hidden' class='subtotal' name='subtotal' id=subtotal"+idFichasTall+" value='0'><td><button type='button' onclick='quitarPermisosR("+idFichasTall+", this, subtotal"+idFichasTall+".value)' class='btn btn-box-tool'><i style='font-size:150%;' class='fa fa-remove'></i></button></td></tr>";
    $("#tblVaciaObjModf").remove();
    $("#tablaFiOM").append(tr);
    // boton = "#btnobjMod"+idbotn;
    // $(boton).attr('disabled', 'disabled');
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
          title: "¿Está seguro de cancelar este objetivo?",   
          text: "El objetivo quedará cancelado!",  
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Sí, cancelar objetivo",
          cancelButtonText: "No",
          closeOnConfirm: true,
          closeOnCancel: true },
          function(){ 
          $.ajax({
            type: 'post',
            dataType: 'json',
            url: uri+"ctrObjetivos/cancelarobjetivo",
            data:{Id_Objetivo: Id_Objetivo}
            }).done(function(respuesta){
                location.href = uri+"ctrObjetivos/listarObjetivos";
            }).fail(function(){
            });
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
  alertaStockProductoT();
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

// function validarSalidasMultiples(){
//   var bandera = 0;
//   $("#tableSal .trValCantidades").each(function(i, v){
//     var c = i + 1;
//     $(".cantidadA").attr("id", "hola"+c);

//   //   var cantidadActual = $(".cantActl").val();
//   //   var cantidadSalida = $(".Salida").val();
//   //   console.log(cantidadActual, cantidadSalida);
//   //   if (parseInt(cantidadSalida) > parseInt(cantidadActual)) {
//   //     $(".Salida").val("");
//   //     return bandera = 1;
//   //   }
//   c++;
//   });
//   // console.log(bandera);
//   if (bandera == 1) {
//     Lobibox.notify('warning', {size: 'mini', delayIndicator: false, msg: 'La cantidad de salida no debe ser mayor a la cantidad actual.'});
//     return false;
//   }else{
//     return false;
//   }
//   return false;
// }

function genRepExtProductoT(){
  alertaStockProductoT();
  alertaStockInsumos();
  var existenciasProductoT = [];
  $(".repProdT .repProdTerm, .badge").each(function(i,v){
    existenciasProductoT.push(v.outerText);
  });
  if (existenciasProductoT.length > 0) {
      $.ajax({
      dataType : 'json',
      type : 'POST',
      url : uri+"ctrProductoT/reporteExistenciasProdT",
      data: {arrayExistPT : existenciasProductoT}
    }).done(function(respuesta){
      if (respuesta.r == 1) {
        // location.href = uri+"ctrProductoT/reporteProductoTerminado";
      }
    });
  }else{
    $("#btnExistProdT").removeAttr("href");
  }
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


$('#tblProducPrAsoc').dataTable({
  "ordering": false,
  "language": {
      "emptyTable": "No hay productos para listar.",
      "info": "Mostrando página _PAGE_ de _PAGES_",
      "infoEmpty": "Mostrando página _PAGE_ de _PAGES_",
      "zeroRecords": "No se encontraron productos que coincidan con la búsqueda.",
  "paginate": {"previous": "Anterior","next": "Siguiente"}
  },
  "lengthMenu": [[3, 5, 10], [3, 5, 10]]
});


 function mostrarGrafica(idObjetivo){
      $("#barChart").remove();
      var canv = "<canvas id='barChart' style='height:230px'></canvas>";
      $("#canvCont").append(canv);
      var data = null;
      $.ajax({
        data:{Id_Objetivo:idObjetivo},
        type:"post",
        dataType:"JSON",
        url:uri+"ctrObjetivos/listar_GraficasOb",
        async:false
      }).done(function(respuesta){
        data = respuesta;
        console.log(data);
      })

      var areaChartData = {
      labels: data["objetivo"],
      datasets: [
        {
          label: "Electronics",
          fillColor: "rgba(210, 214, 222, 1)",
          strokeColor: "rgba(210, 214, 222, 1)",
          pointColor: "rgba(210, 214, 222, 1)",
          pointStrokeColor: "#c1c7d4",
          pointHighlightFill: "#c1c7d4",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: data["cant"]
          
        },
        {
          label: "Digital Goods",
          fillColor: "rgba(60,141,188,0.9)",
          strokeColor: "rgba(60,141,188,0.8)",
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data: data["refObj"]
        }
      ]
    };

    var areaChartOptions = {

      //Boolean - If we should show the scale at all
      showScale: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: false,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - Whether the line is curved between points
      bezierCurve: true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension: 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot: false,
      //Number - Radius of each point dot in pixels
      pointDotRadius: 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth: 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius: 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke: true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth: 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true
    };
    
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    var barChartData = areaChartData;
    barChartData.datasets[0].fillColor = "#e2e2e2";
    barChartData.datasets[0].strokeColor = "#e2e2e2";
    barChartData.datasets[0].pointColor = "#e2e2e2";

    barChartData.datasets[1].fillColor = "#3c8dbc";
    barChartData.datasets[1].strokeColor = "#3c8dbc";
    barChartData.datasets[1].pointColor = "#3c8dbc";


    var barChartOptions = {
      scaleShowLabels: true,
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: true
    };

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
    }



    function alertaStockProductoT(){
      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: uri+'ctrProductoT/alertProdTer',
      }).done(function(resp){
        $.each(resp, function(i){
          var idFichaTalla = "1"+resp[i]["Id_Fichas_Tallas"];
          if (parseInt(resp[i]["Cantidad"]) <=  parseInt(resp[i]["Stock_Minimo"])) {
            var descripcion = "Stock mínimo alcanzado: "+resp[i]["Referencia"]+ " - "+resp[i]["Nombre"]+" - "+resp[i]["Nombre_Talla"];
            var url = "ctrProductoT/existenciasProductoT/?Id="+idFichaTalla+"";
            $.ajax({
              type: 'POST',
              dataType: 'json',
              url: uri+'ctrProductoT/regNotificacion',
              data: {descripcion: descripcion, url: url, idFichaTalla: idFichaTalla}
            }).done(function(){
            });
          }else{
            $.ajax({
              type: 'POST',
              dataType: 'json',
              url: uri+'ctrProductoT/borrarNotificacion',
              data: {idFichaTalla: idFichaTalla}
            }).done(function(){
            });
          }
        });
      });
    }



$(function(){
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: uri+'ctrProductoT/consNotificaciones',
  }).done(function(notificaciones){
      var band = false;
    $.each(notificaciones, function(i){
      var html = ""; 
      if (notificaciones[i]["Estado"] == 0) {
        band = true;
        html = "<li style='background-color: #e2e2e2;'><a href='"+uri+notificaciones[i]["Url"]+"'>"+notificaciones[i]["Descripcion"]+"</a></li>";
      }else{
        html = "<li><a href='"+uri+notificaciones[i]["Url"]+"/?fichTalla="+notificaciones[i]["Ficha_Talla"]+"'>"+notificaciones[i]["Descripcion"]+"</a></li>";
      }
      $("#notificaciones").append(html);
    });
      if (band) {
        $("#campanaNoti").css("color", "red");
      }
  });
});
