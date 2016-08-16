function editarCotizacion(codigo, cotizaciones){
  var campo = $(cotizaciones).parent().parent();
  $("#Codigo").val(campo.find("td").eq(0).text());
  $("#Cliente").val(campo.find("td").eq(1).text());
  $("#Estado").val(campo.find("td").eq(2).text());
  $("#Fecha_Registro").val(campo.find("td").eq(3).text());
  $("#FechaVencimiento").val(campo.find("td").eq(4).text());
  $("#ValorTotal").val(campo.find("td").eq(5).text());
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

$('#FechaVencimiento').datepicker({
  format: "yyyy-mm-dd",
  language: "es",
  autoclose: true,
  todayBtn: true
}).on(
'show', function() {      
  var zIndexModal = $('#myModal3').css('z-index');
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

function asociarFicha(referen, color, vlrproducto, fichas, idboton){
  var campo = $(fichas).parent().parent();
  $("#agregarFicha").removeAttr("hidden");
  var tr = "<tr class='box box-solid collapsed-box'><td id=''>"+referen+"<input type='hidden' value='"+referen+"' name='referencia[]'></td><td>"+color+"</td><td>"+vlrproducto+"</td><td><input type='number' min='1' id='cantProducir"+idboton+"' value='0' onchange='res"+idboton+".value=cantProducir"+idboton+".value * "+vlrproducto+"; subt"+idboton+".value=parseFloat(res"+idboton+".value);' name='cantiProdu[]'></td><td><input class='subtl' type='hidden' name='subtot[]' id='subt"+idboton+"'value='0'>$<input readonly='' type='text' id='capValor"+idboton+"' name='res"+idboton+"' for='cantProducir"+idboton+"'></td><td><button type='button' onclick='Elificha("+idboton+", this)' class='btn btn-box-tool'><i class='fa fa-minus'></i></button></td><input type='hidden' name='idFicha[]' value="+referen+"></tr>";
  $("#Ficha").append(tr);
  boton = "#btn"+idboton;
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
