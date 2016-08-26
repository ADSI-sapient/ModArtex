//convierte cotizacion en pedido
function convertirPedido(codigo, cotizaciones, Id_estado){
  var campo = $(cotizaciones).parent().parent();
  $("#Codig").val(campo.find("td").eq(0).text());
  $("#Client").val(campo.find("td").eq(1).text());
  // $("#Estad").val(Id_estado);
  $("#Fecha_Registr").val(campo.find("td").eq(3).text());
  $("#ValorTota").val(campo.find("td").eq(5).text());
  $("#ced_client").val(campo.find("td").eq(6).text());
  $("#modalConvPed").modal();
}

function editarCotizacion(codigo, cotizaciones, Id_estado){
  var campo = $(cotizaciones).parent().parent();
  $("#Codigo").val(campo.find("td").eq(0).text());
  $("#Cliente").val(campo.find("td").eq(1).text());
  $("#Estado").val(Id_estado);
  $("#Fecha_Registro").val(campo.find("td").eq(3).text());
  $("#FechaVencimiento").val(campo.find("td").eq(4).text());
  $("#valor_total").val(campo.find("td").eq(5).text());
  $("#ced_cliente").val(campo.find("td").eq(6).text());
  $("#myModal3").modal();
}

var options;
$('#myTable').DataTable();     
$(function(){
  $('#fecha1').datepicker({
    format: "yyyy-mm-dd",
    auntoclose: true
  });
});

// Abir Calendario Para Modificar La Cotizacion

$('#FechaVencimiento').datepicker({
  format: "yyyy-mm-dd",
  language: "es",
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
  language: "es",
  autoclose: true,
}).on(
'show', function() {      
  var zIndexModal = $('#modalConvPed').css('z-index');
  var zIndexFecha = $('.datepicker').css('z-index');
  $('.datepicker').css('z-index',zIndexModal+1);
});


$(document).ready(function(){
  var miboton = $("#myModal-btn");
  miboton.click(function(){
    $("#myModal").modal();
  });
          // miboton.text("kevin");
          // miboton.css("color","red");
          // miboton.css("font-size","100px");
          // miboton.css("font-family","algerian");
        });

$(document).ready(function(){
 var boton = $("#search-btn");
 boton.click(function(){
  $("#mymodal").modal();
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
  console.log(referen, color, vlrproducto, fichas, idboton, idFicha);
  var campo = $(fichas).parent().parent();
  $("#agregarFicha").removeAttr("hidden");
  var tr = "<tr class='box box-solid collapsed-box'><td style='display: none;'>"+idFicha+"</td><td id=''>"+referen+"<input type='hidden' value='"+referen+"' name='referencia[]'></td><td><i class='fa fa-square' style='color:"+color+"; font-size: 150%;'></td><td>"+vlrproducto+"</td><td><input type='number' min='1' id='cantProducir"+idboton+"' value='0' onchange='res"+idboton+".value=cantProducir"+idboton+".value * "+vlrproducto+"; subt"+idboton+".value=parseFloat(res"+idboton+".value);' name='cantiProdu[]'></td><td><input class='subtl' type='hidden' name='subtot[]' id='subt"+idboton+"'value='0'>$<input readonly='' type='text' id='capValor"+idboton+"' name='res"+idboton+"' for='cantProducir"+idboton+"'></td><td><button type='button' onclick='Elificha("+idboton+", this)' class='btn btn-box-tool'><i class='fa fa-minus'></i></button></td><input type='hidden' name='idFicha[]' value="+idFicha+"></tr>";
  $("#Ficha").append(tr);
  boton = "#b"+idboton;
  $(boton).attr('disabled', 'disabled');  
}

function asoFicha(referen, color, vlrproducto, fichas, idboton){
  var campo = $(fichas).parent().parent();
  $("#agregarficha").removeAttr("hidden");
  var tr = "<tr class='box box-solid collapsed-box'><td id=''>"+referen+"<input type='hidden' value='"+referen+"' name='referencia[]'></td><td>"+color+"</td><td>"+vlrproducto+"</td><td><input type='number' min='1' id='cantProducir"+idboton+"' value='0' onchange='res"+idboton+".value=cantProducir"+idboton+".value * "+vlrproducto+"; subt"+idboton+".value=parseFloat(res"+idboton+".value);' name='cantiProdu[]'></td><td><input class='subtl' type='hidden' name='subtot[]' id='subt"+idboton+"'value='0'>$<input readonly='' type='text' id='capValor"+idboton+"' name='res"+idboton+"' for='cantProducir"+idboton+"'></td><td><button type='button' onclick='Elificha("+idboton+", this)' class='btn btn-box-tool'><i class='fa fa-minus'></i></button></td><input type='hidden' name='idFicha[]' value="+referen+"></tr>";
  $("#ficha").append(tr);
  boton = "#bt"+idboton;
  $(boton).attr('disabled', 'disabled');  
}

 function Elificha(btn, elemento){
  var e = $(elemento).parent().parent();
  $(e).remove();
  boton = "#btn"+btn;
  $(boton).attr('disabled', false);
}

 function calcularValorTotal(){
  var total = 0;
  $(".subtl").each(function(){
    total = total + parseFloat($(this).val());
  });
  $("#vlr_total").val(total);
}


function PedidoAsociado(idCot){
  $.ajax({
  type: 'post',
  dataType: 'json',
  url: uri+"ctrCotizacion/fichaAsociada",
  data: {idCot: idCot}
  }).done(function(respuesta){
  if (respuesta != null) {
  $("#Asopedido > tbody tr").empty();
  arrayProductos = respuesta;
  for (var i = 0; i <= arrayProductos.length - 1; i++) {
  idProducto = arrayProductos[i]['Referencia'];
  color = arrayProductos[i]['Codigo_Color'];
  vlrProducto = arrayProductos[i]['Valor_Producto'];
  cantProducir = arrayProductos[i]['Cantidad_Producir'];
  subtotal = arrayProductos[i]['Subtotal'];
  var tr = "<tr id='tr"+idProducto+"' class='box box-solid collapsed-box'><td>"+idProducto+"</td><td><i class='fa fa-square' style='color:"+color+"; font-size: 150%;'></td><td><input type='number' min='1' id='cantProducir"+idProducto+"' name='cantProducir[]' value='"+cantProducir+"' onchange='res"+idProducto+".value=cantProducir"+idProducto+".value * "+vlrProducto+"; subt"+idProducto+".value=parseFloat(res"+idProducto+".value); total_Pedidos();' style='border-radius:5px;'></td><td>$"+vlrProducto+"</td><td><input class='subtotal' type='hidden' name='subtotal[]' id='subt"+idProducto+"' value='"+subtotal+"'><input readonly='' type='text' id='capValor"+idProducto+"' name='res"+idProducto+"' for='cantProducir"+idProducto+"' style='border-radius:5px;' value='"+subtotal+"'></td><td><button type='button' class='btn btn-box-tool' onclick='modifiProductos("+idProducto+", this, subt"+idProducto+".value)' ><i class='fa fa-remove'></i></button></td><input type='hidden' id='idProducto"+idProducto+"' name='idProducto[]' value='"+idProducto+"'></tr>";

  $('#Asopedido').append(tr);
  }
  }
  }).fail(function(){
        alert("error");
  })
}

function modifiProductos(btn, elemento, subtotal){
  var e = $(elemento).parent().parent();
  $(e).remove();
  boton = "#btn"+btn;
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


function Modificar_ProductoAso(referencia, color, vlrproducto, productos, idbton){
  idProducNuevo = referencia;
  producto = "#idProducto"+referencia;
  valor = $(producto).val();
  if (idProducNuevo == $(producto).val()) {

  boton = "#botn"+referencia;
  $(boton).attr('disabled', 'disabled');
  }
  else
  {

  var tr = "<tr class='box box-solid collapsed-box'><td id=''>"+referencia+"</td><td><i class='fa fa-square' style='color: "+color+"; font-size: 150%;'></i></td><td><input type='number' min='1' id='cantProducir"+referencia+"' name='cantProducir[]' value='0' onchange='res"+referencia+".value=cantProducir"+referencia+".value * "+vlrproducto+"; subt"+referencia+".value=parseFloat(res"+referencia+".value); total_Pedidos();' style='border-radius:5px;'></td><td>$"+vlrproducto+"</td><td><input class='subtotal' type='hidden' name='subtotal[]' id='subt"+referencia+"'value='0'><input readonly='' type='text' id='capValor"+referencia+"' name='res"+referencia+"' for='cantProducir"+referencia+"' style='border-radius:5px;'></td><td><button type='button' onclick='modifiProductos("+referencia+", this, subt"+referencia+".value)' class='btn btn-box-tool'><i class='fa fa-remove'></i></button></td><input type='hidden' id='idProducto"+referencia+"' name='idProducto[]' value="+referencia+"></tr>";
  $("#Asopedido").append(tr);
  boton = "#botn"+referencia;
  $(boton).attr('disabled', 'disabled');
  }
}  



