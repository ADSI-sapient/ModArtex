
function editarCotizacion(codigo, cotizaciones){
  var campos = $(cotizaciones).parent().parent();

  $("#Codigo").val(campos.find("td").eq(0).text());
  $("#FechaRegistro").val(campos.find("td").eq(1).text());
  $("#Estado").val(campos.find("td").eq(2).text());
  $("#FechaVencimiento").val(campos.find("td").eq(3).text());
  $("#Cliente").val(campos.find("td").eq(5).text());
  $("#ValorTotal").val(campos.find("td").eq(4).text());
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

function agregarCliente(documento){
    var docu = $("#cliente");
    var moda = $("#mymodal");
    docu.val(documento);
    moda.modal("hide");
    return false;
  }