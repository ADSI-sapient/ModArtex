var tempIdColIns = [];

$(window).load(function(){
  mensajeTablaVacia();
  if ($("#tableListInsumos tbody tr").length == 0) {
    var tr = '<tr id="trTablaVacia"><td colspan="7" style="text-align: center;">No hay colores asociados.</td></tr>';
    $("#tableListInsumos tbody").append(tr);
  }

});
    $('#tableListInsumos').dataTable( {
      "ordering": false,
        "language": {
            "emptyTable": "No hay insumos para listar.",
            "info": "",
            "infoEmpty": "",
            "zeroRecords": "No se encontraron resultados.",
        "paginate": {"previous": "Anterior", "next": "Siguiente"}
        },
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]]
    });

    $('.datTableModals').dataTable( {
          "ordering": false,
      "language": {
          "emptyTable": "No hay resultados",
          "info": "",
          "infoEmpty": "",
          "zeroRecords": "No se encontraron resultados",
      "paginate": {
        "previous": "Anterior",
        "next": "Siguiente"
       }
      },
      "lengthMenu": [[3, 5, 10], [3, 5, 10]]
        });

    $('#tblExistencias').dataTable( {
          "ordering": false,
      "language": {
          "emptyTable": "No hay resultados",
          "info": "",
          "infoEmpty": "",
          "zeroRecords": "No se encontraron resultados",
      "paginate": {
        "previous": "Anterior",
        "next": "Siguiente"
       }
      },
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]]
        });


function mensajeTablaVacia(){
    var tr = '<tr id="trTablaVacia"><td colspan="6" style="text-align: center;">No hay colores asociados.</td></tr>';
    if ($("#tbody-colAsocInsumos tr").length == 0) {
      $("#tbody-colAsocInsumos").append(tr);
      return false;
    }else{
      $("#trTablaVacia").remove();
      return true;
    }
}



$(".checkboxHijo").change(function(){
  var checkboxes = $("input:checkbox:checked").length;
   if($(this).is(':checked') && checkboxes > 1){
    $("#entradaMultiple").removeAttr("disabled");
    $("#salidaMultiple").removeAttr("disabled");
    $(".arrowEntradaIns").attr("disabled", "disabled");
    $(".arrowSalidaIns").attr("disabled", "disabled");
   }else if(checkboxes == 1){
    $("#entradaMultiple").attr("disabled", "disabled");
    $("#salidaMultiple").attr("disabled", "disabled");
    $(".arrowEntradaIns").removeAttr("disabled");
    $(".arrowSalidaIns").removeAttr("disabled");
   }
});

$("#checkPadre").change(function(){
   if($(this).is(':checked')){
    $("#entradaMultiple").removeAttr("disabled");
    $("#salidaMultiple").removeAttr("disabled");
    $(".arrowEntradaIns").attr("disabled", "disabled");
    $(".arrowSalidaIns").attr("disabled", "disabled");
   }else{
    $("#entradaMultiple").attr("disabled", "disabled");
    $("#salidaMultiple").attr("disabled", "disabled");
    $(".arrowEntradaIns").removeAttr("disabled");
    $(".arrowSalidaIns").removeAttr("disabled");
   }
});


$("#checkValor").click( function(){
   if($(this).is(':checked')){
      $("#valColIns").removeAttr("readonly");
      $("#tbodyColIns tr").each(function(){
        var idCol = $(this).find("td").eq(0).html();
        $("#valColIns"+idCol).attr("readonly", "");
      });
      $("#valColIns").on('keyup', function(){
        $("#tbodyColIns tr").each(function(){
          var idCol = $(this).find("td").eq(0).html();
          $("#valColIns"+idCol).val($("#valColIns").val());
        });
      });
   }else{
      $("#valColIns").attr("readonly", "");
      $("#valColIns").val("");
      $("#tbodyColIns tr").each(function(i){
        var idCol = $(this).find("td").eq(0).html();
        $("#valColIns"+idCol).removeAttr("readonly");
      });
   }
});

$('document').ready(function(){
   $("#checkPadre").change(function(){
      $("input:checkbox").prop('checked', $(this).prop("checked"));
  });
});




  var cont = 0;
  function seleccion(col){
      $(col).attr("disabled", true);
      var color = $(col).parent().parent();
      var fila = '<tr class="box box-solid collapsed-box"><td>'+(cont+=1)+'</td><td>'+$(color).find("td").eq(1).html()+'</td><td>'+$(color).find("td").eq(2).html()+'</td><td>'+$(color).find("td").eq(3).html()+'</td><td style="display: none; ">'+$(color).find("td").eq(4).html()+'</td><td><button type="button" class="btn btn-box-tool" onclick="$(this).parent().parent().remove(); mensajeTablaVacia(); removeDisabledBtn(this);"><i class="fa fa-times" style="font-size: 150%;"></i></button></td></tr>';
      $("#tbody-colAsocInsumos").append(fila);
      mensajeTablaVacia();
  }

  function removeDisabledBtn(col){
    var color = $(col).parent().parent();
    $("#btnAgreColAsoc"+$(color).find("td").eq(4).html()).attr("disabled", false);
  }

  function limpiarTableColAsoc(){
      $("#tbody-colAsocInsumos tr").each(function(){
        $("#btnAgreColAsoc"+$(this).find("td").eq(4).html()).attr("disabled", false);
      });
      $("#tbody-colAsocInsumos").empty();
      mensajeTablaVacia();
  }


  function valiTablaLlenaColIns(){
      mensajeTablaVacia();
      var valorInsumo = $("#valorIns").val();
      if (mensajeTablaVacia()) {
        return true;
      }else if (valorInsumo.charAt(0) == 0) {
        Lobibox.notify('warning', {delay: 6000, size: 'mini', msg: 'El valor del insumo debe ser mayor a cero'});
        $("#valorIns").val("");        
        return false;
      }
      else{
        Lobibox.notify('warning', {delay: 6000, size: 'mini', msg: 'Debe asociar colores al insumo'});
        return false;
      }
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
  $("#tbodyColIns").empty();
  habilitarBotonAgreCol();
  validateColSelec();
  $("#valColIns").val("");
  $("#valColIns").attr("readonly", true);
  $("#checkValor").attr("checked", false);

  
  var campos = $(insumos).parent().parent();
  $.ajax({
    dataType: 'json',
    type: 'POST',
    url: uri+"ctrBodega/lisColInsu", 
    data:{id: id}
  }).done(function(respuesta){
    if (respuesta) {
      var cont = 0;
      $.each(respuesta, function(i){
        var fila = '<tr class="box box-solid collapsed-box"><td style="display: none;">'
        +respuesta[i]["Id_Color"]+'</td><td style="display: none;">'+respuesta[i]["Id_ColIns"]+
        '</td><td>'+(cont+=1)+'</td><td>'+respuesta[i]["codigo"]+
        '</td><td><i class="fa fa-square" style="color: '+respuesta[i]["codigo"]+
        '; font-size: 200%;"></i> </td><td>'+respuesta[i]["nombre"]+
        '</td><td><input id="valColIns'+respuesta[i]["Id_Color"]+'" type="number" class="form-control" min="1" required="" value="'+respuesta[i]["valor"]+
        '"</td><td style="text-align: center;"><button style="padding: 0 !important;" type="button" class="btn btn-box-tool" onclick="quitarCol(this, '+respuesta[i]["Id_ColIns"]+')"><i style="font-size: 150%;" class="fa fa-times"></i></button></td><td style="display: none;">'+respuesta[i]["cantidad"]+'</td></tr>';
        $("#tbodyColIns").append(fila);  
      });
    }
  }).fail(function(){
  });
  $("#mSel").val(campos.find("td").eq(1).text());   
  $("#nomIns").val(campos.find("td").eq(2).text());
  $("#selMedInsCol").val(campos.find("td").eq(9).html());
  $("#stockIns").val(campos.find("td").eq(5).html());
  $("#ModEditIns").show(); 
}

function seleccionCol(col){
  var color = $(col).parent().parent();
  tr = '<tr class="box box-solid collapsed-box"><td style="display: none;">'
        +$(color).find("td").eq(0).html()+'</td><td style="display: none;">'+false+
        '</td><td>'+$(color).find("td").eq(1).html()+'</td><td>'+$(color).find("td").eq(2).html()+
        '</td><td><i class="fa fa-square" style="color: '+$(color).find("td").eq(2).html()+
        '; font-size: 200%;"></i></td><td>'+$(color).find("td").eq(4).html()+
        '</td><td><input id="valColIns'+$(color).find("td").eq(0).html()+'" type="number" class="form-control" min="1" required="" value="0"</td><td style="text-align: center;"><button style="padding: 0 !important;" type="button" class="btn btn-box-tool" onclick="quitarCol(this, 0)"><i style="font-size: 150%;" class="fa fa-times"></i></button></td></tr>';
  $("#tbodyColIns").append(tr);
  habilitarBotonAgreCol();
  validateColSelec();
}
        function quitarCol(col, idColIns){
          var colorInsumo = $(col).parent().parent();
          if (idColIns == 0) {
            $(colorInsumo).remove();
            var idCol = $(colorInsumo).find("td").eq(0).html();
            $("#btnAgreColAsoc"+idCol).attr("disabled", false);
          }else{
          $.ajax({
            dataType: "json",
            url: uri+"ctrBodega/cantidadColIns",
            type: 'POST',
            data: {idColIns: idColIns}
          }).done(function(resp){
            if (resp["cantidad"] > 0) {
              Lobibox.notify('error', {delay: 6000, size: 'mini', msg: 'Este registro tiene cantidades asociadas'});
            }else{
              $.ajax({
                dataType: 'json',
                type: 'POST',
                url: uri+'ctrBodega/validateFichasAsoc',
                data: {idColIns: idColIns}
              }).done(function(resp){
                if (resp){
                  tempIdColIns.push(idColIns);
                  $(colorInsumo).remove();
                  var idCol = $(colorInsumo).find("td").eq(0).html();
                  $("#btnAgreColAsoc"+idCol).attr("disabled", false);
                }else{
                  Lobibox.notify('error', {delay: 6000, size: 'mini', msg: 'Este registro esta asociado a una ficha tecnica'});
                }
              });
            }
          });
        }
      }


        //Existencias de insumos


        function existen(id, ins){
          $("#cant").val("");
          $("#valUnit").val("");
          $("#valTot").val("");
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
            Lobibox.notify('warning', {size: 'mini', delayIndicator: false, msg: 'La cantidad debe ser mayor a cero'});
            $("#cant").val("");
          }
        });



        //muchas entradas

        function validateMuchasEntradas(){
            $("#tbodyEnt tr").each(function(){
              var valor = $(this).find("td").eq(0).html();
              $("#extCant"+valor).parsley().validate();
              $("#extValUni"+valor).parsley().validate();
              $("#extValTot"+valor).parsley().validate();
              if ($("#extCant"+valor).val() == "" || $("#extCant"+valor).val() < 0 || $("#extValUni"+valor).val() == "" || $("#extValUni"+valor).val() < 0 || $("#extValTot"+valor).val() == "" || $("#extValTot"+valor).val() < 0) {
                return false;
              }else{
                return true;
              }
            });
        }

        function tableEntMay(){
          $("#tbodyEnt").empty();
          $("#valEnt").val("");
          var band = false;
          $("#tblExistencias tbody tr").each(function(){
            var valor = $(this).find("td").eq(0).html();

            if ($("#chkExi"+valor).prop("checked")) {
              var fila = "<tr><td style='display: none;'>"+valor+"</td><td>"+$(this).find("td").eq(3).html()+"</td><td>"
              +$(this).find("td").eq(4).html()+"</td><td>"
              +$(this).find("td").eq(5).html()+"</td><td style='display: none;'>"
              +$(this).find("td").eq(6).html()+"</td><td style='display: none;'>"
              +$(this).find("td").eq(7).html()+"</td><td><input data-parsley-required='' min='0' maxlength='10' id='extCant"
              +valor+"' type='number'></td><td><input data-parsley-required='' min='0' maxlength='10'' id='extValUni"
              +valor+"' type='number'></td><td><input data-parsley-required='' min='0' maxlength='10' id='extValTot"
              +valor+"' type='number'></td></tr>";
              $("#tbodyEnt").append(fila);
              band = true;
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
                Lobibox.notify('warning', {size: 'mini', delayIndicator: false, msg: 'La cantidad debe ser mayor a cero'});
                $("#extCant"+valor).val("");
              }
            });
          });
          if (band) {
              $("#ModalEntradaMayor").modal();
            }else{
              Lobibox.notify('warning', {delay: 6000, size: 'mini', msg: 'Debe seleccionar insumos'});
            }
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
    $("#descripcionSal").val("");
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




function validateMuchasSalidas(){
    $("#tbodySalIns tr").each(function(){
      var valor = $(this).find("td").eq(0).html();
      $("#cantSalIns"+valor).parsley().validate();
      if ($("#cantSalIns"+valor).val() == "" || $("#cantSalIns"+valor).val() <= 0 || $("#cantSalIns"+valor).val() > $(this).find("td").eq(5).html()) {
        Lobibox.notify('warning', {delay: 6000, size: 'mini', msg: 'La cantidad debe ser mayor a cero'});
        return false;
      }else{
        return true;
      }
    });
}

function salidaIns(){
          $("#tbodySalIns").empty();
          $("#descripcion").val("");

          var band = false;
          $("#tblExistencias tbody tr").each(function(){
            var valor = $(this).find("td").eq(0).html();

            if ($("#chkExi"+valor).prop("checked")) {
              var fila = "<tr><td style='display: none;'>"+valor+"</td><td>"+$(this).find("td").eq(3).html()+"</td><td>"
              +$(this).find("td").eq(4).html()+"</td><td>"
              +$(this).find("td").eq(5).html()+"</td><td style='display: none;'>"
              +$(this).find("td").eq(6).html()+"</td><td><input data-parsley-required='' min='0' style='width: 85%;' id='cantSalIns"+valor+"' max='"
              +$(this).find("td").eq(6).text()+"' min='1' type='number'></td></tr>";
              $("#tbodySalIns").append(fila); 
              band = true;
            }
          });
          if (band) {
              $("#SalidaMuchos").modal();
          }else{
              Lobibox.notify('warning', {delay: 6000, size: 'mini', msg: 'Debe seleccionar insumos'});
          }
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


function validateColSelec(){
    $("#tableCols tbody tr").each(function(){
        var idCol = $(this).find("td").eq(0).html();
        $("#tbodyColIns tr").each(function(){
          if ($(this).find("td").eq(0).html() == idCol){
              $("#btnAgreColAsoc"+idCol).attr("disabled", true);
          }
        });
    });
}

function habilitarBotonAgreCol(){
    $("#tableCols tbody tr").each(function(){
        var idCol = $(this).find("td").eq(0).html();
        $("#btnAgreColAsoc"+idCol).removeAttr("disabled");
    });
}



function updateColIns(){
  $("#nomIns").parsley().validate();
  $("#stockIns").parsley().validate();
  $("#selMedInsCol").parsley().validate();

  var band = true;
  $("#tbodyColIns tr").each(function(){
    var IdCol = $(this).find("td").eq(0).html();
    var valIns =  $("#valColIns"+IdCol).parsley().validate();
    if ($("#valColIns"+IdCol).val() == "" || $("#valColIns"+IdCol).val() < 1) {
      band = false;
    }
  });

  var band2 = true;
  if ($("#tbodyColIns tr").length == 0) {
    Lobibox.notify('error', {delay: 6000, size: 'mini', msg: 'La tabla debe tener datos'});
    band2 = false;
  }

  if ($("#nomIns").val() != "" &&  ($("#stockIns").val() != "" && $("#stockIns").val() >= 0) && $("#selMedInsCol").val() != "" && band == true && band2 == true){
      var idIns = $("#mSel").val();
      var idMedida = $("#selMedInsCol").val();
      var nomIns = $("#nomIns").val();
      var stock = $("#stockIns").val();
      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: uri+'ctrBodega/modificarInsumo',
        data: {id: idIns, select: idMedida, nombre: nomIns}
      }).done(function(){
        $.each(tempIdColIns, function(i){
          var idColIns = tempIdColIns[i];
          // console.log(idColIns);
          $.ajax({
            type: 'POST',
            dataType: 'json',
            url: uri+'ctrBodega/borrarColorInsumo',
            data: {idColIns: idColIns}
          }).done(function(){
          }).fail(function(){
            console.log();
          });
        });
        $("#tbodyColIns tr").each(function(){
            var IdColIns = $(this).find("td").eq(1).html();
            var IdCol = $(this).find("td").eq(0).html();
            var valIns =  $("#valColIns"+IdCol).val();
            if ($(this).find("td").eq(1).html() != "false") {
              var cantidad = $(this).find("td").eq(8).html();
              $.ajax({
                type: 'POST',
                dataType: 'json',
                url: uri+'ctrBodega/modificarColorInsumo',
                data: {idColIns: IdColIns, cantidadIns: cantidad, valIns: valIns, stock: stock}
              }).done(function(resp){
                console.log(resp);
              }).fail(function(){
                console.log("fail");
              })
            }else{
              $.ajax({
                type: 'POST',
                dataType: 'json',
                url: uri+'ctrBodega/regColorInsumo',
                data: {IdCol: IdCol, idIns: idIns, valIns: valIns, stock: stock}
              }).done(function(resp){
                console.log(resp);
              }).fail(function(){
                console.log("fail");
              })
            }
        });
        location.href = uri+'ctrBodega/listarInsumos';
      });
  }
  band = true;
  band2 = false;
}


function verDetalleColIns(id){
    $("#tbodyDetalleColIns").empty();  
  $.ajax({
    dataType: 'json',
    type: 'POST',
    url: uri+"ctrBodega/lisColInsu", 
    data:{id: id}
  }).done(function(respuesta){
    if (respuesta) {
      var cont = 0;
      $.each(respuesta, function(i){
        var fila = '<tr class="box box-solid collapsed-box"><td>'+(cont+=1)+'</td><td>'+respuesta[i]["codigo"]+
        '</td><td><i class="fa fa-square" style="color: '+respuesta[i]["codigo"]+
        '; font-size: 200%;"></i> </td><td>'+respuesta[i]["nombre"]+
        '</td><td>'+respuesta[i]["valor"]+'</td><td style="display: none;">'+respuesta[i]["cantidad"]+'</td></tr>';
        $("#tbodyDetalleColIns").append(fila);  
      });
    }
  }).fail(function(){
  });
}

function generarExtIns(){
  var arrayExistencias = [];
  $(".repIns .repoInsum, .badge").each(function(i,v){
    arrayExistencias.push(v.outerText);
  });

  $.ajax({
    dataType : 'json',
    type : 'POST',
    url : uri+"ctrBodega/reporteExistencias",
    data: {arrayExist : arrayExistencias}
  }).done(function(respuesta){
    if (respuesta.r == 1) {
      // location.href = uri+"ctrBodega/reporteInsumos";
    }
  });
}

$('#tableCols').dataTable({
  "ordering": false,
  "language": {
      "emptyTable": "No hay colores para listar.",
      "info": "Mostrando página _PAGE_ de _PAGES_",
      "infoEmpty": "Mostrando página _PAGE_ de _PAGES_",
      "zeroRecords": "No se encontraron colores que coincidan con la búsqueda.",
  "paginate": {"previous": "Anterior","next": "Siguiente"}
  }
});




