  function seleccion(){
    $("#tabla1").removeAttr("style");
    $(".tr").each( function(){
      var rg = false;
      if ($(".chk"+$(this).find("td").eq(0).html()).is(':checked')) {
        var cod = $(this).find("td").eq(0).html();
        $("#tabla1 tr").find('td:eq(0)').each(function(){
          if (cod == $(this).html()) {
            rg = true;
          }
        });
        if (rg == false) {
          var fila = '<tr class="box box-solid collapsed-box"><td>'+$(this).find("td").eq(0).html()+'</td><td>'+$(this).find("td").eq(1).html()+'</td><td>'+$(this).find("td").eq(2).html()+'</td><td>'+$(this).find("td").eq(3).html()+'</td><td style="display: none; ">'+$(this).find("td").eq(4).html()+'</td><td><button type="button" class="btn btn-box-tool" onclick="$(this).parent().parent().remove()"><i class="fa fa-times"></i></button></td></tr>';
          $("#tbody").append(fila);
        }
        $(".chk"+$(this).find("td").eq(0).html()).prop("checked", "");
      }
    });
  }
  function colores(){
    var vec = [];
    $("#tabla1 tr").find('td:eq(4)').each(function(){
      vec.unshift([$(this).html()]);
    });
<<<<<<< HEAD
    $("#vecto").val(vec);
=======
    $("#vector").val(vec);
>>>>>>> kevin
  }