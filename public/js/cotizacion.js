//convierte cotizacion en pedido
function convertirPedido(codigo, cotizaciones, Id_estado){
  var campo = $(cotizaciones).parent().parent();
  $("#Codig").val(campo.find("td").eq(0).text());
  $("#Client").val(campo.find("td").eq(6).text());
  // $("#Estad").val(Id_estado);
  $("#Fecha_Registr").val(campo.find("td").eq(1).text());
  $("#ValorTota").val(campo.find("td").eq(5).text());
  $("#ced_client").val(campo.find("td").eq(6).text());
  $("#modalConvPed").modal();
}

function editarCotizacion(codigo, cotizaciones, Id_estado){
  var campo = $(cotizaciones).parent().parent();
  var cliente = campo.find("td").eq(6).text();
  $("#Codigo").val(campo.find("td").eq(0).text());
  $("#Cliente").val(cliente).trigger("change");
  $("#Estado").val(Id_estado);
  $("#Fecha_Registro").val(campo.find("td").eq(1).text());
  $("#FechaVencimiento").val(campo.find("td").eq(3).text());
  $("#valor_total").val(campo.find("td").eq(5).text());
  $("#ced_cliente").val(campo.find("td").eq(6).text());
  $("#myModal3").modal();
}

var options;
$('#tblCotizaciones').dataTable({
  "ordering": false,
      "language": {
          "emptyTable": "No hay cotizaciones para listar.",
          "info": "",
          "infoEmpty": "",
          "zeroRecords": "No se encontraron cotizaciones que coincidan con la búsqueda.",
      "paginate": {
        "previous": "Anterior",
        "next": "Siguiente"
       }
      },
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]]
});

// $('#Asopedido').dataTable({
//   "ordering": false,
//       "language": {
//           "emptyTable": "No hay productos para listar.",
//           "info": "Mostrando página _PAGE_ de _PAGES_",
//           "infoEmpty": "Mostrando página _PAGE_ de _PAGES_",
//           "zeroRecords": "No se encontraron productos que coincidan con la búsqueda.",
//       "paginate": {
//         "previous": "",
//         "next": ""
//        }
//       }
// });

$('#tblfichascotiz').dataTable({
  "ordering": false,
      "language": {
          "emptyTable": "No hay productos para asociar.",
          "info": "Mostrando página _PAGE_ de _PAGES_",
          "infoEmpty": "Mostrando página _PAGE_ de _PAGES_",
          "zeroRecords": "No se encontraron productos que coincidan con la búsqueda.",
      "paginate": {
        "previous": "",
        "next": ""
       }
      }
}); 

$('#tablaFichasCoti').dataTable({
  "ordering": false,
      "language": {
          "emptyTable": "No hay cotizaciones para listar.",
          "info": "Mostrando página _PAGE_ de _PAGES_",
          "infoEmpty": "Mostrando página _PAGE_ de _PAGES_",
          "zeroRecords": "No se encontraron cotizaciones que coincidan con la búsqueda.",
      "paginate": {
        "previous": "",
        "next": ""
       }
      }
  }); 



$(function(){
  $('#fecha1').datepicker({
    format: "yyyy-mm-dd",
    autoclose: true,
    language: 'es'
  });
});

// Abir Calendario Para Modificar La Cotizacion

$('#FechaVencimiento').datepicker({
  format: "yyyy-mm-dd",
  language: 'es',
  autoclose: true,
}).on(
'show', function() {      
  var zIndexModal = $('#myModal3').css('z-index');
  var zIndexFecha = $('.datepicker').css('z-index');
  $('.datepicker').css('z-index',zIndexModal+1);
});


// Abir Calendario Para Envio de Pedido

$('#Fechaentre').datepicker({
  format: "yyyy-mm-dd",
  language: 'es',
  autoclose: true,
}).on(
'show', function() {      
  var zIndexModal = $('#modalConvPed').css('z-index');
  var zIndexFecha = $('.datepicker').css('z-index');
  $('.datepicker').css('z-index',zIndexModal+1);
});

$(document).ready(function(){
  $("#tblFichasVaciaCoti").html("No hay productos asociados.");
});

$(document).ready(function(){
  var miboton = $("#myModal-btn");
  miboton.click(function(){
    $("#ModelProducto").modal();
  });
          // miboton.text("kevin");
          // miboton.css("color","red");
          // miboton.css("font-size","100px");
          // miboton.css("font-family","algerian");
        });

$(document).ready(function(){
 var boton = $("#search-btn");
 boton.click(function(){
  $("#ModelProducto").modal();
});
});

function agregar(documento_cli, cliente,boto){
  var moda = $("#mymodal");
  $("#clienteReg").val(cliente);
  $("#documento_cli").val(documento_cli);
  moda.modal("hide");
  boto = "#bt"+boto;
  $(boto).attr('disabled','disabled');
  }

function agregarCliente(documento_cli, cliente){
  var moda = $("#mymodal");
  $("#Cliente").val(cliente);
  $("#ced_cliente").val(documento_cli);
  moda.modal("hide");
}

function asociarFichaCoti(referen, color, vlrproducto, fichas, idboton, idFicha){
  var campo = $(fichas).parent().parent();
  $("#Ficha tbody tr #tblFichasVaciaCoti").remove();
  var tr = "<tr class='box box-solid collapsed-box trcotiza' id='trcotizaciones'><td style='display: none;'>"+idFicha+"</td><td id=''>"+referen+"<input type='hidden' value='"+referen+"' name='referencia[]'></td><td><i class='fa fa-square' style='color:"+color+"; font-size: 150%;'></td><td>"+vlrproducto+"</td><td><input type='number' min='1' id='cantProducir"+idboton+"' value='' onkeyup='res"+idboton+".value=cantProducir"+idboton+".value * "+vlrproducto+"; subt"+idboton+".value=parseFloat(res"+idboton+".value); total_Pedido();' name='cantiProdu[]' data-parsley-required=''></td><td><input class='subtl' type='hidden' name='subtot[]' id='subt"+idboton+"'value='0'>$<input readonly='' type='text' id='capValor"+idboton+"' name='res"+idboton+"' for='cantProducir"+idboton+"'></td><td><button type='button' onclick='Elificha("+idboton+", this, res"+idboton+".value)' class='btn btn-box-tool'><i class='fa fa-remove'></i></button></td><input type='hidden' name='idFicha[]' value="+idFicha+"></tr>";
  $("#Ficha").append(tr);
  boton = "#b"+idboton;
  $(boton).attr('disabled', 'disabled');
}

function asoFicha(referen, color, vlrproducto, fichas, idboton){
  var campo = $(fichas).parent().parent();
  $("#agregarficha").removeAttr("hidden");
  var tr = "<tr class='box box-solid collapsed-box'><td id=''>"+referen+"<input type='hidden' value='"+referen+"' name='referencia[]'></td><td>"+color+"</td><td>"+vlrproducto+"</td><td><input type='number' min='1' id='cantProducir"+idboton+"' value='0' onchange='res"+idboton+".value=cantProducir"+idboton+".value * "+vlrproducto+"; subt"+idboton+".value=parseFloat(res"+idboton+".value);' name='cantiProdu[]'></td><td><input class='subtl' type='hidden' name='subtot[]' id='subt"+idboton+"'value='0'>$<input readonly='' type='text' id='capValor"+idboton+"' name='res"+idboton+"' for='cantProducir"+idboton+"'></td><td><button type='button' onclick='Elificha("+idboton+", this, res"+idboton+".value)' class='btn btn-box-tool'><i class='fa fa-remove'></i></button></td><input type='hidden' name='idFicha[]' value="+referen+"></tr>";
  $("#ficha").append(tr);
  boton = "#bt"+idboton;
  $(boton).attr('disabled', 'disabled');  
}

 function Elificha(btn, elemento, subtotal){

   $("#Ficha").each(function(){
      if ($("#Ficha tbody #trcotizaciones").length < 2){
        var tr = "<tr><td id='tblFichasVaciaCoti' colspan='8' style='text-align:center;'></td></tr>";
        $("#Ficha").append(tr);
        $("#tblFichasVaciaCoti").html("No hay productos asociados.");
        }
    });

  var e = $(elemento).parent().parent();
  $(e).remove();
  boton = "#b"+btn;
  $(boton).attr('disabled', false);
  valortotal = $("#vlr_total").val();
  desc = valortotal - subtotal;
  $("#vlr_total").val(desc);
}


function fichasAsociad(idCot, fechaTerm, fichaAs){
  
  $.ajax({
  type: 'post',
  dataType: 'json',
  url: uri+"ctrCotizacion/fichaAsociada",
  data: {idCot: idCot}
  }).done(function(respuesta){

  if (respuesta != null) {
  $("#Asopedido > tbody tr").empty();
  $("#fichaAsociadas > tbody tr").empty();

    arrayProductos = respuesta;
    for (var i = 0; i <= arrayProductos.length - 1; i++) {
    idProducto = arrayProductos[i]['Referencia'];
    idFichaTec = arrayProductos[i]['Id_Ficha_Tecnica'];
    color = arrayProductos[i]['Codigo_Color'];
    vlrProducto = arrayProductos[i]['Valor_Producto'];
    cantProducir = arrayProductos[i]['Cantidad_Producir'];
    subtotal = arrayProductos[i]['Subtotal'];
    var tr = "";

    if (fichaAs == 1) {
    tr = "<tr id='tr"+idProducto+"' class='box box-solid collapsed-box trProducModCoti'><td>"+idProducto+"<input type='hidden' id='idProducto"+idFichaTec+"' value='"+idFichaTec+"'></td><td><i class='fa fa-square' style='color:"+color+"; font-size: 150%;'></td><td><input type='number' min='1' id='cantProducir"+idFichaTec+"' name='cantProducir[]' value='"+cantProducir+"' onkeyup='res"+idFichaTec+".value=cantProducir"+idFichaTec+".value * "+vlrProducto+"; subt"+idFichaTec+".value=parseFloat(res"+idFichaTec+".value); total_Pedidos();' style='border-radius:5px;'></td><td>$"+vlrProducto+"</td><td><input class='subtotal' type='hidden' name='subtotal[]' id='subt"+idFichaTec+"' value='"+subtotal+"'><input readonly='' type='text' id='capValor"+idFichaTec+"' name='res"+idFichaTec+"' for='cantProducir"+idFichaTec+"' style='border-radius:5px;' value='"+subtotal+"'></td><td><button type='button' class='btn btn-box-tool' onclick='modifiProductos("+idFichaTec+", this, subt"+idFichaTec+".value)' ><i class='fa fa-remove'></i></button></td><input type='hidden' id='idProducto"+idFichaTec+"' name='idProducto[]' value='"+idFichaTec+"'><td></td></tr>";
    $('#Asopedido').append(tr);
    }

  else if(fichaAs == 2){
    tr = "<tr class='box box-solid collapsed-box'><td>"+idProducto+"</td><td><i class='fa fa-square' style='color:"+color+"; font-size: 150%;'></td><td>"+cantProducir+"</td><td>$"+vlrProducto+"</td><td>"+subtotal+"</td></tr>";
    $('#fichaAsociadas').append(tr);
    $('#DetallesAso').show();
   }
  }
    // $('#Asopedido').dataTable({
    // "ordering": false,
    //     "language": {
    //         "emptyTable": "No hay productos para listar.",
    //         "info": "Mostrando página _PAGE_ de _PAGES_",
    //         "infoEmpty": "Mostrando página _PAGE_ de _PAGES_",
    //         "zeroRecords": "No se encontraron productos que coincidan con la búsqueda.",
    //     "paginate": {
    //       "previous": "",
    //       "next": ""
    //      }
    //     }
    // });
   }
  }).fail(function(){
        alert("error");
  });
}

function modifiProductos(btn, elemento, subtotal){

  $("#Asopedido").each(function(){
    if ($("#Asopedido tbody .trProducModCoti").length < 2){
      var tr = "<tr><td id='tblProductosVacia' colspan='8' style='text-align:center;'></td></tr>";
      $("#Asopedido").append(tr);
      $("#tblProductosVacia").html("No hay productos asociados");
    }
  });
  var e = $(elemento).parent().parent();
  $(e).remove();
  boton = "#btn"+btn;
  boton = "#botn"+btn;
  $(boton).attr('disabled', false);
  valortotal = $("#valor_total").val();
  desc = valortotal - subtotal;
  $("#valor_total").val(desc);
}

function total_Pedidos(){
  var total=0;
  $(".subtotal").each(function(){
  total=total+parseFloat($(this).val());
  });
  $("#valor_total").val(total);
}

function total_Pedido(){
  var total=0;
  $(".subtl").each(function(){
  total=total+parseFloat($(this).val());
  });
  $("#vlr_total").val(total);
}


function Modificar_ProductoAso(referencia, color, vlrproducto, productos, idbton, idft){
  idProducNuevo = idft;
  producto = "#idProducto"+idft;
  valor = $(producto).val();

  if (idProducNuevo == $(producto).val()) {
    boton = "#botn"+idft;
    $(boton).attr('disabled', 'disabled');
  }
  else
  {
    var tr = "<tr class='box box-solid collapsed-box trProducModCoti'><td id=''>"+referencia+"</td><td><i class='fa fa-square' style='color: "+color+"; font-size: 150%;'></i></td><td><input type='number' min='1' id='cantProducir"+idft+"' name='cantProducir[]' value='0' onkeyup='res"+idft+".value=cantProducir"+idft+".value * "+vlrproducto+"; subt"+idft+".value=parseFloat(res"+idft+".value); total_Pedidos();' style='border-radius:5px;'></td><td>$"+vlrproducto+"</td><td><input class='subtotal' type='hidden' name='subtotal[]' id='subt"+idft+"' value='0'><input readonly='' type='text' id='capValor"+idft+"' name='res"+idft+"' for='cantProducir"+idft+"' style='border-radius:5px;'></td><td><button type='button' onclick='modifiProductos("+idft+", this, subt"+idft+".value)' class='btn btn-box-tool'><i class='fa fa-remove'></i></button></td><input type='hidden' id='idProducto"+idft+"' name='idProducto[]' value="+idft+"><td></td></tr>";
    $("#tblProductosVacia").remove();

    $("#Asopedido").append(tr);
    boton = "#botn"+idft;
    $(boton).attr('disabled', 'disabled');
  }

  // $(boton).on("click", RefreshTable);

  // $('#Asopedido').dataTable({
  //   "ordering": false,
  //       "language": {
  //           "emptyTable": "No hay productos para listar.",
  //           "info": "Mostrando página _PAGE_ de _PAGES_",
  //           "infoEmpty": "Mostrando página _PAGE_ de _PAGES_",
  //           "zeroRecords": "No se encontraron productos que coincidan con la búsqueda.",
  //       "paginate": {
  //         "previous": "",
  //         "next": ""
  //        }
  //       }
  //   });
}



   // function RefreshTable() {
   //     $("#Asopedido").load('#Asopedido');
   // }


  $("#clienteReg").select2({
    placeholder: 'Seleccionar',
    language: {
          noResults: function (params) {
          return "No hay resultados";
    }}
  });

  $(document).ready(function(){
  $("#Cliente").select2({
    language: {
          noResults: function (params) {
          return "No hay resultados";
    }}
  });
}); 


function ValCoti(){
  var fecha_Venci = $("#fecha1").val();
  var fecha_Regi = $("#fecha_R").val();

  if (fecha_Venci <= fecha_Regi) {
      Lobibox.notify('warning', {size: 'mini', msg: 'Debe ingresar una fecha superior a la fecha actual'});
    return false;
  }

  if ($("#tblFichasVaciaCoti").length)
        {
          Lobibox.notify('warning', {size: 'mini', msg: 'Debe asociar al menos un producto a la cotización'});
          return false;
        }
        else{

  return true;
        }
        return false;

}

  function ValCot(){
    var Mfecha_regi = $("#Fecha_Registro").val();
    var Mfecha_venci = $("#FechaVencimiento").val();
    var btn_Pedi = $("#convertiPedido");

    if(Mfecha_venci === Mfecha_regi ){
      Lobibox.notify('warning', {size: 'mini', delayIndicator: 6000, msg: 'Debe ingresar una fecha superior'});
      return false;
    }

   if (Mfecha_venci <= Mfecha_regi) {
      Lobibox.notify('warning', {size: 'mini', delayIndicator: 6000, msg: 'Debe ingresar una fecha superior'});
      $(btn_Pedi).attr('disabled',false);
    return false;
    }

    if ($("#tblProductosVacia").length)
    {
      Lobibox.notify('warning', {size: 'mini', msg: 'Debe asociar al menos un producto a la cotización'});
      return false;
    }
    else{
      return true;
    }
  return false;
}

function ValCotPedi(){
  var Pfecha_entrega = $("#Fechaentre").val();
  var Pfecha_registro = $("#Fecha_Registr").val();
  var idSolicitudCoti = $("#Codig").val();
  var band1 = true;

  if(Pfecha_entrega === Pfecha_registro ){
    Lobibox.notify('warning', {size: 'mini', delayIndicator: 6000, msg: 'Debe ingresar una fecha superior'});
    return false;
  }

   if (Pfecha_entrega <= Pfecha_registro){
      Lobibox.notify('warning', {size: 'mini', delayIndicator: 6000, msg: 'Debe ingresar una fecha superior'});
    return false;
  }

  if ($("#tblFichasVaciaCoti").length)
  {
    Lobibox.notify('warning', {size: 'mini', msg: 'Debe asociar al menos un producto a la cotización'});
    return false;
  }
  else
  {
    return true;
  }

  return false;
}

function limpiarFormRegCoti(){
     $("#clienteReg").select2("val", "");

    $("#Ficha tbody .trcotiza").remove();
    if (!$("#Ficha tbody tr #tblFichasVaciaCoti").length) {

      var tr = "<tr><td id='tblFichasVaciaCoti' colspan='8' style='text-align:center;'></td></tr>";
      $("#Ficha").append(tr);
        $("#tblFichasVaciaCoti").html("No hay productos asociados");
        $(".btnAsociarP").attr('disabled', false);
        }
}

