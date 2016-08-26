  var cont = 0;
  function seleccion(){
    $("#tblRegIns").removeAttr("style");
    $(".tr").each( function(){
      var rg = false;
      if ($(".chkReg"+$(this).find("td").eq(4).html()).is(':checked')) {
        var cod = $(this).find("td").eq(4).html();
        $("#tblRegIns tr").find('td:eq(4)').each(function(){
          if (cod == $(this).html()) {
            rg = true;
          }
        });
        if (rg == false) {
          var fila = '<tr class="box box-solid collapsed-box"><td>'+(++cont)+'</td><td>'+$(this).find("td").eq(1).html()+'</td><td>'+$(this).find("td").eq(2).html()+'</td><td>'+$(this).find("td").eq(3).html()+'</td><td style="display: none; ">'+$(this).find("td").eq(4).html()+'</td><td><button type="button" class="btn btn-box-tool" onclick="$(this).parent().parent().remove()"><i class="fa fa-times"></i></button></td></tr>';
          $("#tbody").append(fila);
        }
        $(".chkReg"+$(this).find("td").eq(4).html()).prop("checked", "");
      }
    });
  }

  function colores(){
    var vec = [];
    $("#tblRegIns tr").find('td:eq(4)').each(function(){
      vec.unshift([$(this).html()]);
    });
    $("#vecto").val(vec);
  }




// Listar insumo



function camEst(cod, est){
  $.ajax({
    dataType: 'json',
    type: 'POST',
    url: uri+"ctrBodega/cambiarEstado", 
    data:{id: cod, estado: est}
  }).done(function(respuesta){
    if (respuesta.v == 1) {
      location.href = uri+"ctrBodega/listarInsumos"; 
    }
  }).fail(function(){
  });
} 


function editInsumos(id, insumos){
  var campos = $(insumos).parent().parent();
  $.ajax({
    dataType: 'json',
    type: 'POST',
    url: uri+"ctrBodega/lisColInsu", 
    data:{id: id}
  }).done(function(respuesta){
    if (respuesta) {
      // var cont = 0;
      $.each(respuesta, function(i){
        var fila = '<tr class="box box-solid collapsed-box"><td></td><td>'+respuesta[i]["codigo"]+'</td><td><i class="fa fa-square" style="color: '+respuesta[i]["codigo"]+'; font-size: 200%;"></i> </td><td>'+respuesta[i]["nombre"]+'</td><td id="'+respuesta[i]["id"]+'" style="display: none; ">'+respuesta[i]["id"]+'</td><td><button type="button" class="btn btn-box-tool" onclick="quitarCol('+respuesta[i]["id"]+', '+id+')"><i class="fa fa-times"></i></button></td></tr>';
        $("#tbodyColIns").append(fila);  
      });
    }
  }).fail(function(){
  });
  $("#mSel").val(campos.find("td").eq(1).text());   
  $("#nomIns").val(campos.find("td").eq(2).text());
  $("#medIns").val(campos.find("td").eq(3).find("option").val());
  $("#medIns").text(campos.find("td").eq(3).find("option").text());
  $("#stockIns").val(campos.find("td").eq(4).text());
  $("#ModEditIns").show(); 
}

function seleccionCol(){

          // $("#tablaCol").removeAttr("style");
          $(".tr").each( function(){
            var rg = false;
            // console.log($(".chk"+$(this).find("td").eq(4).html()));
            if ($(".chk"+$(this).find("td").eq(4).html()).is(':checked')) {
              var cod = $(this).find("td").eq(4).html();
              $("#tablaCol tr").find('td:eq(4)').each(function(){
                if (cod == $(this).html()) {
                  rg = true;
                }
              });
              if (rg == false) {
                var fila = '<tr class="box box-solid collapsed-box"><td></td><td>'+$(this).find("td").eq(1).html()+'</td><td>'+$(this).find("td").eq(2).html()+'</td><td>'+$(this).find("td").eq(3).html()+'</td><td style="display: none; ">'+$(this).find("td").eq(4).html()+'</td><td><button type="button" class="btn btn-box-tool" onclick="$(this).parent().parent().remove()"><i class="fa fa-times"></i></button></td></tr>';
                $("#tbodyColIns").append(fila);
              }
              $(".chk"+$(this).find("td").eq(4).text()).prop("checked", "");
            }
          });
        }

        function coloresVec(){
          var vec = [];
          $("#tablaCol tr").find('td:eq(4)').each(function(){
            vec.unshift([$(this).html()]);
          });
          $("#vectorCol").val(vec);
        }

        var vec = [];
        function quitarCol(idCol, idIns){
          $.ajax({
            dataType: "json",
            url: uri+"ctrBodega/cantidadColIns",
            type: 'POST',
            data: {idCol: idCol, idIns: idIns},
            success: function(data) {
              if (data.cantidad > 0) {
                // Lobibox.notify('error', {size: 'mini', rounded: true, delayIndicator: false, position: 'center bottom', msg: 'Datos incorrectos!'});
                swal("Hay cantidades asociadas a este registro", "no se puede eliminar")
                // alert("Hay cantidades asociadas a este registro, no se puede eliminar");
              }else{
                // var str = "#"+idCol;
                // $(str).parent().remove();
                swal({
                  title: "¿Seguro que desea eliminar esta asociación?",
                  text: "",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Si, borrar asociación",
                  closeOnConfirm: true
                },
                function(){
                  $.ajax({
                    url: uri+"ctrBodega/deleteColor",
                    type: 'POST',
                    data: {idCol: idCol, idIns: idIns},
                    success: function(res){
                      if (res) {
                        var str = "#"+idCol;
                        $(str).parent().remove();
                      }
                    }
                  });
                });
              }
            },
            error: function(){
              alert('Error!-');
            }
          });
        }


        //Existencias de insumos


        function existen(id, ins){
          var campos = $(ins).parent().parent();
          $("#idExs").val(id);    
          $("#codIns").val(campos.find("td").eq(2).text());    
          $("#nomIns").val(campos.find("td").eq(3).text());
          $("#coloIns").val(campos.find("td").eq(4).text());
          $("#medIns").val(campos.find("td").eq(5).text());
          $("#cantActual").val(campos.find("td").eq(6).text());
          $("#valPromedio").val(campos.find("td").eq(7).text());
          $("#ModelEntrada").show();
        }

        $("#valUnit").on("keyup change", function(){
          if ($("#cant").val() <= 0) {
            $("#valTot").val("");
          }else{
            $("#valTot").val($("#cant").val() * $("#valUnit").val()); 
          }
        });

        $("#valTot").on("keyup change", function(){
          if ($("#cant").val() <= 0) {
            $("#valUnit").val("");
          }else{
            $("#valUnit").val($("#valTot").val() / $("#cant").val());
          }
        }).change(function(){
        });  

        $("#cant").keyup(function(){
          $("#valTot").val("");
          $("#valUnit").val("");
        }).change(function(){
          if ($("#cant").val() <= 0 && $("#cant").val() != "") {
            alert("La cantidad debe ser mayor a cero");
            $("#cant").val("");
          }
        });



        //muchas entradas
        function tableEntMay(){
          $("#tbodyEnt").empty();
          $("#valEnt").val("");
          $("#tblExistencias tbody tr").each(function(){
            var valor = $(this).find("td").eq(0).html();

            if ($("#chkExi"+valor).prop("checked")) {
              var fila = "<tr><td style='display: none;'>"+valor+"</td><td>"+$(this).find("td").eq(3).html()+"</td><td>"
              +$(this).find("td").eq(4).html()+"</td><td>"
              +$(this).find("td").eq(5).html()+"</td><td style='display: none;'>"
              +$(this).find("td").eq(6).html()+"</td><td style='display: none;'>"
              +$(this).find("td").eq(7).html()+"</td><td><input id='extCant"
              +valor+"' type='number'></td><td><input id='extValUni"
              +valor+"' type='number'></td><td><input id='extValTot"
              +valor+"' type='number'></td></tr>";
              $("#tbodyEnt").append(fila);
            }


            $("#extValUni"+valor).on("keyup change", function(){
              if ($("#extCant"+valor).val() <= 0) {
                $("#extValTot"+valor).val("");
              }else{
                $("#extValTot"+valor).val($("#extCant"+valor).val() * $("#extValUni"+valor).val());
                var vl = 0;
                $("#tbodyEnt tr").each(function(){
                  par = $("#extValTot"+$(this).find("td").eq(0).html()).val();
                  if (par != "") {
                    vl += (parseInt(par));
                  }  
                });
                $("#valEnt").val(vl); 
              }
            });

            $("#extValTot"+valor).on("keyup change", function(){
              var vl = 0;
              $("#tbodyEnt tr").each(function(){
                par = $("#extValTot"+$(this).find("td").eq(0).html()).val();
                if (par != "") {
                  vl += (parseInt(par));
                }  
              });
              $("#valEnt").val(vl);
              if ($("#extCant"+valor).val() <= 0) {
                $("#extValUni"+valor).val("");
              }else{
                $("#extValUni"+valor).val($("#extValTot"+valor).val() / $("#extCant"+valor).val());
              }
            });  

            $("#extCant"+valor).keyup(function(){
              $("#extValTot"+valor).val("");
              $("#extValUni"+valor).val("");
            }).change(function(){
              if ($("#extCant"+valor).val() <= 0 && $("#extCant"+valor).val() != "") {
                alert("La cantidad debe ser mayor a cero");
                $("#extCant"+valor).val("");
              }
            });
          });
        } 

        $("#regMuchos").click(function(){
          var vec = new Object();
          var i = 0;
          $("#tbodyEnt tr").each(function(){
            num = $(this).find("td").eq(0).html();
            vec[i] = [
              {numEx: num}, 
              {cantidad: $("#extCant"+num).val()}, 
              {valorU: $("#extValUni"+num).val()}, 
              {valorT: $("#extValTot"+num).val()},
              {cantActual: $(this).find("td").eq(4).html()},
              {valorPromedio: $(this).find("td").eq(5).html()}
            ];
            i++;
          });
          $("#vec").val(JSON.stringify(vec));
          });



// SALIDA DE UN SOLO INSUMO


function salidaUno(ins){
    var tabla = $(ins).parent().parent();
    $("#idExiSal").val(tabla.find("td").eq(0).text()) ;
    $("#nomInsSal").val(tabla.find("td").eq(3).text());
    $("#coloInsSal").val(tabla.find("td").eq(4).text());
    $("#medInsSal").val(tabla.find("td").eq(5).text());
    $("#cantAct").val(tabla.find("td").eq(6).text());


    $("#cantSal").attr("max", tabla.find("td").eq(6).text());
    $("#cantSal").val(tabla.find("td").eq(6).text());
}


// SALIDA DE VARIOS INSUMOS

function salidaIns(){
          $("#tbodySalIns").empty();
          $("#descripcion").text("");
          $("#tblExistencias tbody tr").each(function(){
            var valor = $(this).find("td").eq(0).html();

            if ($("#chkExi"+valor).prop("checked")) {
              var fila = "<tr><td style='display: none;'>"+valor+"</td><td>"+$(this).find("td").eq(3).html()+"</td><td>"
              +$(this).find("td").eq(4).html()+"</td><td>"
              +$(this).find("td").eq(5).html()+"</td><td style='display: none;'>"
              +$(this).find("td").eq(6).html()+"</td><td><input style='width: 85%;' id='cantSalIns"+valor+"' max='"
              +$(this).find("td").eq(6).text()+"' min='1' type='number'></td></tr>";
              $("#tbodySalIns").append(fila); 
            }
          });
}

$("#salIns").click(function(){
  var array = new Object();
  $("#tbodySalIns tr").each(function(i){
    array[i] = [
      {idExs: $(this).find("td").eq(0).html()},
      {cantSal: $("#cantSalIns"+$(this).find("td").eq(0).html()).val()},
      {cant: $(this).find("td").eq(4).html()}
    ];
  });
  console.log(array);
  $("#arraySalIns").val(JSON.stringify(array));
});





