 
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


function asociarFichas(Id_Ficha_Tecnica, Referencia, fichas, idbton){

  var campos = $(fichas).parent().parent();
  CantidadO= $("#CantidadO"+Referencia).val();
  $("#tblVaciaObj").remove();
  // $("#FichasS").removeAttr("hidden");
  var tr = "<tr class='box box-solid trFichasObj' id=''><td>"+Id_Ficha_Tecnica+"<input type='hidden' value='"+Id_Ficha_Tecnica+"' name=Id_Ficha_Tecnica[]></td><td>"+Referencia+"<input type='hidden' value='"+Referencia+"' name=Referencia[]></td><td><input type='number' data-parsley-required='' name=CantidadO[] id='cantTotal"+Id_Ficha_Tecnica+"' onkeyup='subtotal"+Id_Ficha_Tecnica+".value=parseFloat(cantTotal"+Id_Ficha_Tecnica+".value); TotalFC()' style='border-radius:5px;' value='0'></td><input type='hidden' name='subtotal"+Id_Ficha_Tecnica+"' class='subtotal' id='subtotal"+Id_Ficha_Tecnica+"' value='0'><td><button type='button' onclick='quitarFichaObj("+idbton+",this)' class='btn btn-box-tool btnObjt'><i class='fa fa-remove'></i></button></td></tr>";
  

  $("#tablaFichass").append(tr);
    boton = "#btnobj"+idbton;
    $(boton).attr('disabled', 'disabled');

  }

    $(document).ready(function(){
        $("#tblFichasObje").html("No hay productos asociados.");
      });


// $("#tablaFichass tbody tr").each(function(){
//   $("#cantTotal"+Id_Ficha_Tecnica).on("keyup", function(){
//             $("#TotalT"+Id_Ficha_Tecnica).val("#cantTotal"+Id_Ficha_Tecnica).val();
//   });
// });

function TotalFC(){
  $("#TotalT").val(0);
  var total=0;
  $(".subtotal").each(function(){
  total+=parseFloat($(this).val());
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
           $("#FichasOM").empty();
           $("#Id_Objetivo").val(campos.find("td").eq(0).text());
          $("#Fecha_Registro").val(campos.find("td").eq(1).text());
          $("#Fecha_Inicio").val(campos.find("td").eq(3).text());
          $("#Nombre").val(campos.find("td").eq(2).text());
          $("#Fecha_Fin").val(campos.find("td").eq(4).text());   
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
              cantidad = data[i]["Cantidad"];

              var fila = "<tr><td>"+Id_Ficha_Tecnica+"<input type='hidden' value='"+Id_Ficha_Tecnica+"' name=Id_Ficha_Tecnica[]></td><td>"+data[i]["Referencia"]+"<input type='hidden' value='"+data[i]["Referencia"]+"' name='Referencia[]' ></td><td><input type='number' class='cantTotalN' value='"+cantidad+"' name=CantidadN[] id='cantTotalN"+Id_Ficha_Tecnica+"' onkeyup='subtotal"+Id_Ficha_Tecnica+".value=parseFloat(cantTotalN"+Id_Ficha_Tecnica+".value); TotalFCN();'></td><input type='hidden' name='subtotal' class='subtotal' id=subtotal"+Id_Ficha_Tecnica+" value='"+cantidad+"'><td><button type='button' onclick='quitarPermisosR(0, this)' class='btn btn-box-tool'><i class='fa fa-remove'></i></button></td></tr>";
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
    var tr = "<tr id='tblVaciaObj'><td id='tblFichasObje' colspan='4' style='text-align:center;'></td></tr>";
    $("#tablaFichass").append(tr);
    $("#tblFichasObje").html("No hay productos asociados.");
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

function limpiarFormRegObj(){
    $("#tablaFichass tbody .trFichasObj").remove();
    if (!$("#tablaFichass tbody tr #tblFichasObje").length) {

      var tr = "<tr><td id='tblFichasObje' colspan='8' style='text-align:center;'></td></tr>";
      $("#tablaFichass").append(tr);
      $("#tblFichasObje").html("No hay productos asociados");
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



function asociarFichasNuevas(Id_Ficha_Tecnica, Referencia, fichas){


  var campos = $(fichas).parent().parent();
  CantidadN = $("#CantidadN"+Referencia).val();
   
  $("#ModificarObj").removeAttr("hidden");

  var tr = "<tr><td>"+Id_Ficha_Tecnica+"<input type='hidden' value='"+Id_Ficha_Tecnica+"' name=Id_Ficha_Tecnica[]></td><td>"+Referencia+"<input type='hidden' value='"+Referencia+"' name=Referencia[]></td><td><input type='number' onkeyup='subtotal"+Id_Ficha_Tecnica+".value=parseFloat(cantTotalN"+Id_Ficha_Tecnica+".value); TotalFCN();' class='cantTotalN' value=0 name=CantidadN[] id='cantTotalN"+Id_Ficha_Tecnica+"'></td><input type='hidden' class='subtotal' name='subtotal' id=subtotal"+Id_Ficha_Tecnica+" min='0' value='0'><td><button type='button' onclick='quitarPermisosR(0, this)' class='btn btn-box-tool'><i class='fa fa-remove'></i></button></td></tr>";

  $("#tablaFiOM").append(tr);
    // boton = "#btn"+idbton;
    // $(boton).attr('disabled', 'disabled');

  }



// $("#tablaFiOM tbody tr").each(function(){  $("#cantTotalN"+Id_Ficha_Tecnica).on("keyup", function(){
//             $("#TotalTN"+Id_Ficha_Tecnica).val("#cantTotalN"+Id_Ficha_Tecnica).val();
//   });
// });

function TotalFCN(){
  var totalN=0;
  $(".subtotal").each(function(){
  totalN=totalN+parseFloat($(this).val());
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


function ValObj(){
  var fecha_Regi = $("#Fecha_Registro").val();
  var Fecha_Inicio = $("#Fecha_Inicio").val();
  var fecha_final = $("#Fecha_Fin").val();

  if (Fecha_Inicio < fecha_Regi) {
      Lobibox.notify('warning', {size: 'mini', msg: 'Debe ingresar una fecha superior a la fecha actual'});
    return false;
  }

  if (fecha_final <= Fecha_Inicio) {
      Lobibox.notify('warning', {size: 'mini', msg: 'Debe ingresar una fecha fin mayor a a la fecha inicial'});
    return false;
  }

  if ($("#tblFichasObje").length)
  {
    Lobibox.notify('warning', {size: 'mini', msg: 'Debe asociar al menos un producto a el objetivo'});
    return false;
  }
  else{
    return true;
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

      





