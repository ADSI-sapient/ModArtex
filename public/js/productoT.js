 
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
          "ordering": false
        });
      });

         
     function Salida(){
          $("#tbodySal").empty();
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
            }
          });
        }


function asociarFichas(Id_Ficha_Tecnica, Referencia, fichas){
  var campos = $(fichas).parent().parent();
  CantidadO= $("#CantidadO"+Referencia).val();
   
    $("#FichasS").removeAttr("hidden");
  var tr = "<tr class='box box-solid'><td>"+Id_Ficha_Tecnica+"<input type='hidden' value='"+Id_Ficha_Tecnica+"' name=Id_Ficha_Tecnica[]/></td><td>"+Referencia+"<input type='hidden' value='"+Referencia+"' name=Referencia[]/></td><td>"+CantidadO+"<input type='hidden' value='"+CantidadO+"' name=CantidadO[] /></td><td><button type='button' onclick='quitarPermisosR(0, this)' class='btn btn-box-tool'><i class='fa fa-minus'></i></button></td></tr>";
  $("#tablaFichass").append(tr);
    // boton = "#btn"+idbton;
    // $(boton).attr('disabled', 'disabled');
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
              var fila = '<tr><td>'+data[i]["Codigo"]+'<input type="hidden" name="Codigo[]" value="'+Codigo+'"/></td><td>'+data[i]["Referencia"]+'</td><td>'+data[i]["Referencia"]+'</td><td>'+data[i]["Cantidad"]+'</td></tr>'; 
              $("#FichasO").append(fila);
                          } 
            }, 
            error: function(){
            }
        });
  
    }



