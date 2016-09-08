 
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
        "previous": "",
        "next": ""
       }
      }
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