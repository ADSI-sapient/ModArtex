//convierte cotizacion en pedido
function convertirPedido(codigo, cotizaciones, Id_estado, nombreCliente){
  var campo = $(cotizaciones).parent().parent();
  $("#Codig").val(campo.find("td").eq(0).text());
  var docuCliente = campo.find("td").eq(6).text();
  $("#Client").val(docuCliente+" - "+nombreCliente);
  // $("#Estad").val(Id_estado);
  $("#Fecha_Registr").val(campo.find("td").eq(1).text());
  $("#ValorTota").val(campo.find("td").eq(5).text());
  $("#ced_client").val(campo.find("td").eq(6).text());
  $("#modalConvPed").modal();
}

function PressCantDesCot(){
 $("#fichaAsoConvPedido tbody tr").each(function(){
   var idFicha = parseInt($(this).find("td").eq(7).html());
   var cantProd = parseInt($("#cantProdCot"+idFicha).val());

   var cantCotizada = parseInt($(this).find("td").eq(4).html());
   var cantProdTerm = parseInt($("#spanCantCot"+idFicha).html());

   $("#exisProdTerCotPed"+idFicha).val(cantProdTerm);


   $("#usarProductoTCot"+idFicha).on("keyup", function(){
      animarTotal();
      if ($(this).val() == "" || $(this).val() > cantCotizada || $(this).val() > cantProdTerm) {
        $("#cantProdCot"+idFicha).val(cantProd);
        $("#spanCantCot"+idFicha).html(cantProdTerm);

        $("#exisProdTerCotPed"+idFicha).val($("#spanCantCot"+idFicha).html());
      }else{
        $("#cantProdCot"+idFicha).val(cantProd - parseInt($(this).val()));
        $("#spanCantCot"+idFicha).html(cantProdTerm - $(this).val());

        $("#exisProdTerCotPed"+idFicha).val($("#spanCantCot"+idFicha).html());
      }

      if (cantCotizada < cantProdTerm) {
        $(this).attr("max", cantCotizada);
      }else{
        $(this).attr("max", cantProdTerm);
      }
   });
 });
}


function editarCotizacion(codigo, cotizaciones, Id_estado){
  var campo = $(cotizaciones).parent().parent();
  var cliente = campo.find("td").eq(6).text();
  $("#Codigo").val(campo.find("td").eq(0).text());
  $("#Cliente").val(cliente).trigger("change");
  $("#Estado").val(Id_estado);
  $("#Fecha_Registro").val(campo.find("td").eq(1).text());
  $("#FechaVencimiento").val(campo.find("td").eq(3).text());
  var $fechaVencimiento = $("#FechaVencimiento").val(campo.find("td").eq(3).text());
  $("#FechaVencimiento").on('blur', function(ev){
    if (!$.trim($fechaVencimiento.val())) {
        $fechaVencimiento.val(campo.find("td").eq(3).text());
      }
  });
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

$('#tblfichascotiz').dataTable({
  "ordering": false,
      "language": {
          "emptyTable": "No hay productos para asociar.",
          "info": "",
          "infoEmpty": "",
          "zeroRecords": "No se encontraron productos que coincidan con la búsqueda.",
      "paginate": {
        "previous": "Anterior",
        "next": "Siguiente"
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
        "previous": "Anterior",
        "next": "Siguiente"
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

function asociarFichaCoti(referen, nomTalla, color, vlrproducto, fichas, idboton, idFicha, nombreColor, idFichasTallas){
  var campo = $(fichas).parent().parent();
  $("#Ficha tbody tr #tblFichasVaciaCoti").remove();
  var tr = "<tr class='box box-solid collapsed-box trcotiza' id='trcotizaciones'><td style='display: none;'>"+idFicha+"</td><td id=''>"+referen+"<input type='hidden' value='"+referen+"' name='referencia[]'></td><td>"+nomTalla+"</td><td><i class='fa fa-square' style='color:"+color+"; font-size: 200%;' title='"+nombreColor+"'></td><td>"+vlrproducto+"</td><td><input type='number' min='1' id='cantProducir"+idboton+"' value='' maxlength='10' onkeyup='res"+idboton+".value=cantProducir"+idboton+".value * "+vlrproducto+"; subt"+idboton+".value=parseFloat(res"+idboton+".value); total_Pedido(); animarTotal();' name='cantiProdu[]' data-parsley-required='' style='border-radius:5px'></td><td><input class='subtl' type='hidden' name='subtot[]' id='subt"+idboton+"'value='0'>$<input readonly='' type='text' id='capValor"+idboton+"' name='res"+idboton+"' for='cantProducir"+idboton+"' style='border-radius:5px'></td><td><button type='button' onclick='Elificha("+idboton+", this, res"+idboton+".value)' class='btn btn-box-tool'><i style='font-size:150%' class='fa fa-remove'></i></button></td><input type='hidden' name='idFicha[]' value="+idFicha+"><input type='hidden' name='idFichasTallas[]' id='idFTallas"+idboton+"' value='"+idFichasTallas+"'></tr>";
  $("#Ficha").append(tr);
  boton = "#b"+idboton;
  $(boton).attr('disabled', 'disabled');
}
var intervalo = 0;
function animarTotal(){
  clearTimeout(intervalo);
  $(".iconoDinero").removeClass("fa-money").addClass("fa-spinner fa-spin");
  intervalo = setTimeout(function(){
    $(".iconoDinero").removeClass("fa-spinner fa-spin").addClass("fa-money");
  }, 400);
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
  $("#fichaAsoConvPedido > tbody tr").empty();

    arrayProductos = respuesta;
    for (var i = 0; i <= arrayProductos.length - 1; i++) {
    idSolProducto = arrayProductos[i]['Id_Solicitudes_Producto'];  
    idProducto = arrayProductos[i]['Referencia'];
    nombreProducto = arrayProductos[i]['Nombre'];
    idFichaTec = arrayProductos[i]['Id_Ficha_Tecnica'];
    color = arrayProductos[i]['Codigo_Color'];
    nombreColor = arrayProductos[i]['Nombre_Color'];
    vlrProducto = arrayProductos[i]['Valor_Producto'];
    cantProducir = arrayProductos[i]['Cantidad_Producir'];
    subtotal = arrayProductos[i]['Subtotal'];
    cantidad = arrayProductos[i]['Cantidad'];
    cant_Cotizada = arrayProductos[i]['Cant_Cotizada'];
    idFichasTallas = arrayProductos[i]['Id_Fichas_Tallas'];
    nombreTalla = arrayProductos[i]['Nombre_Talla'];
    var tr = "";

    if (fichaAs == 1) {
    tr = "<tr id='tr"+idProducto+"' class='box box-solid collapsed-box trProducModCoti'><td>"+idProducto+"<input type='hidden' id='idProducto"+idFichasTallas+"' value='"+idFichasTallas+"'></td><td>"+nombreProducto+"</td><td><i class='fa fa-square' style='color:"+color+"; font-size: 200%;' title='"+nombreColor+"'></td><td>"+nombreTalla+"</td><td><input type='number' min='1' maxlength='10' data-parsley-required='' id='cantProducir"+idFichasTallas+"' name='cantProducir[]' value='"+cant_Cotizada+"' onkeyup='res"+idFichasTallas+".value=cantProducir"+idFichasTallas+".value * "+vlrProducto+"; subt"+idFichasTallas+".value=parseFloat(res"+idFichasTallas+".value); total_Pedidos(); animarTotal();' style='border-radius:5px;'></td><td>$"+vlrProducto+"</td><td><input class='subtotal' type='hidden' name='subtotal[]' id='subt"+idFichasTallas+"' value='"+subtotal+"'><input readonly='' type='text' id='capValor"+idFichasTallas+"' name='res"+idFichasTallas+"' data-parsley-required='' for='cantProducir"+idFichasTallas+"' style='border-radius:5px;' value='"+subtotal+"'></td><td><button type='button' class='btn btn-box-tool' onclick='modifiProductos("+idFichasTallas+", this, subt"+idFichasTallas+".value)' ><i class='fa fa-remove' style='font-size:150%'></i></button></td><input type='hidden' id='idProducto"+idFichasTallas+"' name='idProducto[]' value='"+idFichasTallas+"'><td style='display: none;'>"+idFichasTallas+"</td</tr>";
    $('#Asopedido').append(tr);
    }

  else if(fichaAs == 2){
    tr = "<tr class='box box-solid collapsed-box'><td>"+idProducto+"</td><td>"+nombreProducto+"</td><td><i class='fa fa-square' style='color:"+color+"; font-size: 200%;' title='"+nombreColor+"'></td><td>"+nombreTalla+"</td><td>"+cant_Cotizada+"</td><td>$"+vlrProducto+"</td><td>$"+subtotal+"</td></tr>";
    $('#fichaAsociadas').append(tr);
    $('#DetallesAso').show();

   }
   else if(fichaAs == 3){
    tr = "<tr class='box box-solid collapsed-box'><td>"+idProducto+"</td><td>"+nombreProducto+"</td><td><i class='fa fa-square' style='color:"+color+"; font-size: 200%;' title='"+nombreColor+"'></td><td>"+nombreTalla+"</td><td style='text-align: center;'>"+cant_Cotizada+"</td><td>$"+vlrProducto+"</td><td>$"+subtotal+"</td><td style='display: none;'>"+idFichasTallas+
    "</td><td><input type='number' style='width: 100%; border-radius:5px;' min='0' max='"+cant_Cotizada+"' id='cantProdCot"+idFichasTallas+"' name='cantProdCot[]' readonly='' value='"+cantProducir+"'></td><td><input id='usarProductoTCot"+idFichasTallas+"' style='width: 100%; border-radius:5px;' min='0' type='number' name='cantExisUsarCot[]' data-parsley-required='' value='0'></td><td style='text-align:center;'><span onchange='exisProdTerCotPed"+idFichasTallas+".value=jsjasd' id='spanCantCot"+idFichasTallas+"' class='badge bg-red'>"+cantidad+
    "</span><td style='display: none;'><input type='hidden' name='idSolProducto[]' value='"+idSolProducto+"'></td><td style='display: none;'><input type='hidden' value='"+idFichasTallas+"' name='idFichaCotPed[]'><input type='hidden' id='exisProdTerCotPed"+idFichasTallas+"' name='exisProdTerCotPed[]'></td></tr>";
    //tabla convertir a pedido
    $('#fichaAsoConvPedido').append(tr);
    $('#modalConvPed').show();

     PressCantDesCot();
   }
  }
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


function Modificar_ProductoAso(referencia, color, vlrproducto, productos, idbton, idft, nombreColor, nombreFicha, idTalla, nombreTalla){
  idProducNuevo = idTalla;
  producto = "#idProducto"+idTalla;
  valor = $(producto).val();

  if (idProducNuevo == $(producto).val()) {
    boton = "#botn"+idTalla;
    $(boton).attr('disabled', 'disabled');
  }
  else
  {
    var tr = "<tr class='box box-solid collapsed-box trProducModCoti'><td id=''>"+referencia+"</td><td>"+nombreFicha+"</td><td><i class='fa fa-square' style='color: "+color+"; font-size: 200%;' title='"+nombreColor+"'></i></td><td>"+nombreTalla+"</td><td><input type='number' min='1' id='cantProducir"+idTalla+"' name='cantProducir[]' value='0' maxlength='10' data-parsley-required='' onkeyup='res"+idTalla+".value=cantProducir"+idTalla+".value * "+vlrproducto+"; subt"+idTalla+".value=parseFloat(res"+idTalla+".value); total_Pedidos(); animarTotal();' style='border-radius:5px;'></td><td>$"+vlrproducto+"</td><td><input class='subtotal' type='hidden' name='subtotal[]' id='subt"+idTalla+"' value='0'><input readonly='' type='text' id='capValor"+idTalla+"' name='res"+idTalla+"' for='cantProducir"+idTalla+"' style='border-radius:5px;'></td><td><button type='button' onclick='modifiProductos("+idTalla+", this, subt"+idTalla+".value)' class='btn btn-box-tool'><i class='fa fa-remove' style='font-size:150%'></i></button></td><input type='hidden' id='idProducto"+idTalla+"' name='idProducto[]' value="+idTalla+"><td style='display:none;'>"+idTalla+"</td></tr>";
    $("#tblProductosVacia").remove();

    $("#Asopedido").append(tr);
    boton = "#botn"+idTalla;
    $(boton).attr('disabled', 'disabled');
  }
}

  $("#clienteReg").select2({
    placeholder: 'Seleccionar',
    language: {
          noResults: function (params) {
          return "No hay resultados";
    }}
  });

  $("#Cliente").select2({
    language: {
          noResults: function (params) {
          return "No hay resultados";
    }}
  });


function ValCoti(){
  var fecha_Venci = $("#fecha1").val();
  var fecha_Regi = $("#fecha_R").val();

  if (fecha_Venci <= fecha_Regi) {
      Lobibox.notify('warning', {size: 'mini', msg: 'Debe ingresar una fecha de vencimiento superior a la fecha actual.'});
    return false;
  }

  if ($("#tblFichasVaciaCoti").length)
  {
          Lobibox.notify('warning', {size: 'mini', msg: 'Debe asociar al menos un producto a la cotización.'});
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
    var resFechaV = true;
    var resTabla = true;

   if (Mfecha_venci <= Mfecha_regi) {
      Lobibox.notify('warning', {size: 'mini', delayIndicator: 6000, msg: 'Debe ingresar una fecha de vencimiento superior a la fecha de registro.'});
      $(btn_Pedi).attr('disabled',false);
      resFechaV = false;
    }

    if ($("#tblProductosVacia").length)
    {
      Lobibox.notify('warning', {size: 'mini', msg: 'Debe asociar al menos un producto a la cotización.'});
      resTabla = false;
    }

    if (resFechaV  == true && resTabla == true) {
      return true;
    }
    else{
      return false;
    }
    return false;
}

function ValCotPedi(){
  var Pfecha_entrega = $("#Fechaentre").val();
  var Pfecha_registro = $("#Fecha_Registr").val();
  var idSolicitudCoti = $("#Codig").val();
  var band1 = true;

  var resExist = true;
  var resFechaVen = true;
  var resTabla = true;

  $("#fichaAsoConvPedido tbody tr").each(function(){
    var idFicha = $(this).find("td").eq(5).html();
    var cantProducir = $("#cantProdCot"+idFicha).val();
    bol = validarExistenciasIn(idFicha, cantProducir, 0);
    if (bol == false) {
      resExist = false;
    }
  });

   if (Pfecha_entrega <= Pfecha_registro){
      Lobibox.notify('warning', {size: 'mini', delayIndicator: 6000, msg: 'Debe ingresar una fecha de vencimiento superior a la fecha de registro.'});
    resFechaVen = false;
  }

  if ($("#tblFichasVaciaCoti").length)
  {
    Lobibox.notify('warning', {size: 'mini', msg: 'Debe asociar al menos un producto a la cotización'});
    resTabla = false;
  }
  if (resExist && resFechaVen && resTabla) {
    return true
  }
  else
  {
    return false;
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

function prohibirEscritura(){
  $("#fecha1").val("");
  $("#Fechaentre").val("").trigger("change");
  $("#fecha_entrega").val("");
  $("#fecha_entrega").val("").trigger("change");
  if ($("#cantidadSalida").val() == 0) {
    $("#cantidadSalida").val("");
  }
  $("#Fecha_Inicio").val("");
  $("#Fecha_Fin").val("");
  $("#FechaVencimiento").val("").trigger("change");
}

// function prueba(){
//   $(".btn-box-tool").removeAttr("disabled", "disabled");
//   console.log($(".fa-remove").length);
// }
