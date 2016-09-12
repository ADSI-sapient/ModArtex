 
 function ProductoT(Referencia, productos){
    var campos = $(productos).parent().parent();
    $("#Referencia").val(campos.find("td").eq(0).text());
    $("#Color").val(campos.find("td").eq(1).text());
    $("#idf").val(campos.find("td").eq(2).text());
    $("#Cantidad").val(campos.find("td").eq(3).text());
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
          $("#tbodySal").empty();
          var band = false;
          $("#tablaProducto tbody tr").each(function(){
            var valor = $(this).find("td").eq(0).html();
            // console.log($(this).find("td").eq(0));
            if ($("#chkSali"+valor).prop("checked")) {
              var fila = "<tr><td style='display: none;'>"+valor+"</td><td> <input type='hidden' name='Referencia[]' value='"
              +$(this).find("td").eq(0).html()+"'>"+$(this).find("td").eq(0).html()+"</td><td><input name='Color[]' type= 'hidden' value='"
              +$(this).find("td").eq(1).html()+"'>"+$(this).find("td").eq(1).html()+"</td><td><input type='hidden' name='Cantidad[]' value='"
              +$(this).find("td").eq(3).html()+"'>"+$(this).find("td").eq(3).html()+"</td><td style='display: none'><input type='hidden' name='idf[]' value='"
              +$(this).find("td").eq(2).html()+"'></td><td><input id='Salida' type='number' name='salida[]'></td></tr>";
              $("#tbodySal").append(fila);
              band = true;
            }
          });
          if (band) {
              $("#ModalSalidas").modal();
          }else{
              Lobibox.notify('warning', {delay: 6000, size: 'mini', msg: 'Debe seleccionar productos'});
          }
        }


function asociarFichas(Id_Ficha_Tecnica, Referencia, fichas){
  var campos = $(fichas).parent().parent();
  CantidadO= $("#CantidadO"+Referencia).val();
   
  $("#FichasS").removeAttr("hidden");
  var tr = "<tr class='box box-solid'><td>"+Id_Ficha_Tecnica+"<input type='hidden' value='"+Id_Ficha_Tecnica+"' name=Id_Ficha_Tecnica[]></td><td>"+Referencia+"<input type='hidden' value='"+Referencia+"' name=Referencia[]></td><td><input type='text' subtotal"+Id_Ficha_Tecnica+".value=parseFloat(cantTotal"+Id_Ficha_Tecnica+".value); class='cantTotal' value=0 name=CantidadO[] id='cantTotal'"+Id_Ficha_Tecnica+" onkeyup='TotalFC()'></td><input type='hidden' name='subtotal' id=subtotal"+Id_Ficha_Tecnica+"><td><button type='button' onclick='quitarPermisosR(0, this)' class='btn btn-box-tool'><i class='fa fa-minus'></i></button></td></tr>";
  
  $("#tablaFichass").append(tr);
    // boton = "#btn"+idbton;
    // $(boton).attr('disabled', 'disabled');

  }

$("#tablaFichass tbody tr").each(function(){
  $("#cantTotal"+Id_Ficha_Tecnica).on("keyup", function(){
            $("#TotalT"+Id_Ficha_Tecnica).val("#cantTotal"+Id_Ficha_Tecnica).val();
  });
});

function TotalFC(){
  var total=0;
  $(".cantTotal").each(function(){
  total=total+parseFloat($(this).val());
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
          // $("#idRol").val(campos.find("td").eq(0).text());
          // $("#nombre_rol").val(campos.find("td").eq(1).text());
           $("FichasO").empty();
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
              $("#FichasO").append(fila);
                          } 
            }, 
            error: function(){
            }
        });
  
    }


     function ModificarObj(Id_Objetivo, Fecha_Registro, Fecha_Inicio, Nombre, Fecha_Fin, objetivos){
          var campos = $(objetivos).parent().parent();
           $("#Id_Objetivo").val(campos.find("td").eq(0).text());
          $("#Fecha_Registro").val(campos.find("td").eq(1).text());
          $("#Fecha_Inicio").val(campos.find("td").eq(3).text());
          $("#Nombre").val(campos.find("td").eq(2).text());
          $("#Fecha_Fin").val(campos.find("td").eq(4).text());   
          $("#Id_Estado").val(campos.find("td").eq(7).text()); 
           $("FichasOM").empty();
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
              var fila = '<tr><td>'+data[i]["Codigo"]+'<input type="hidden" name="Codigo[]" value="'+Codigo+'"/></td><td>'+data[i]["Referencia"]+'</td><td><input type="text" name="Cantidad[]" id="Cantidad" value='+data[i]["Cantidad"]+'></input></td><td><button type="button" onclick="quitarPermisosR(0, this)" class="btn btn-box-tool"><i class="fa fa-minus"></i></button></td></tr>'; 
              $("#FichasOM").append(fila);
                          } 
            }, 
            error: function(){
            }
        });
  
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



function asociarFichasNuevas(Id_Ficha_Tecnica, Referencia, fichas){
  var campos = $(fichas).parent().parent();
  CantidadN= $("#CantidadN"+Referencia).val();
   
  $("#ModificarObj").removeAttr("hidden");
  var tr = "<tr class='box box-solid'><td>"+Id_Ficha_Tecnica+"<input type='hidden' value='"+Id_Ficha_Tecnica+"' name=Id_Ficha_Tecnica[]></td><td>"+Referencia+"<input type='hidden' value='"+Referencia+"' name=Referencia[]></td><td><input type='text' subtotal"+Id_Ficha_Tecnica+".value=parseFloat(cantTotal"+Id_Ficha_Tecnica+".value); class='cantTotalN' value=0 name=CantidadN[] id='cantTotalN'"+Id_Ficha_Tecnica+" onkeyup='TotalFCN()'></td><input type='hidden' name='subtotal' id=subtotal"+Id_Ficha_Tecnica+"><td><button type='button' onclick='quitarPermisosR(0, this)' class='btn btn-box-tool'><i class='fa fa-minus'></i></button></td></tr>";
  
  $("#tablaFiOM").append(tr);
    // boton = "#btn"+idbton;
    // $(boton).attr('disabled', 'disabled');

  }



$("#tablaFiOM tbody tr").each(function(){  $("#cantTotalN"+Id_Ficha_Tecnica).on("keyup", function(){
            $("#TotalTN"+Id_Ficha_Tecnica).val("#cantTotalN"+Id_Ficha_Tecnica).val();
  });
});

function TotalFCN(){
  var totalN=0;
  $(".cantTotalN").each(function(){
  totalN=totalN+parseFloat($(this).val());
  });
  $("#TotalTN").val(totalN);
}


  function validarC(){
    
  }




