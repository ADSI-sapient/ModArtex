      

      $(window).load(function(){
          asignarDataTable();
      });

      function listarMedidas(){
        $("#tbody-CrudMedidas").empty();
        $.ajax({
          type: 'POST',
          dataType: 'json',
          url: uri+'ctrConfiguracion/listarMedidas',
          data: {crudMed: true}
        }).done(function(resp){
          var tr = "";
          var cont = 0;
          $(resp).each(function(i){
            tr = '<tr><td>'+(cont+=1)+
            '</td><td>'+resp[i]["Nombre"]+'</td><td>'+resp[i]["Abreviatura"]+
            '</td><td style="display: none;">'+resp[i]["Id_Medida"]+
            '</td><td style="text-align: center;"><button id="editMed'+resp[i]["Id_Medida"]+'" onclick="editCrudMedidas(this, '+resp[i]["Id_Medida"]+');" class="btn btn-box-tool"><i style="font-size: 150%; color: green;" class="fa fa-pencil-square-o" arial-hidden="true"></i></button></td><td style="text-align: center;"><button id="btnDeleteMed'+resp[i]["Id_Medida"]+'" onclick="confirmacionDeleteMed('+resp[i]["Id_Medida"]+', '+true+');" data-dismiss="alert" class="btn btn-box-tool"><i style="font-size: 150%; color: red;" class="fa fa-times" arial-hidden="true"></i></button></td><td style="text-align: center;"><button onclick="guardarEditMed(this, '+resp[i]["Id_Medida"]+')" id="guardarEditMed'+resp[i]["Id_Medida"]+'" disabled="true" type="button" class="btn btn-box-tool"><i class="font-size: 150%; fa fa-check" arial-hidden="true"></i></button></td></tr>';
            $("#tbody-CrudMedidas").append(tr);
          });
        }).fail(function(){
          console.log("fail");
        });
      }

      function listarColores(){
        $("#tbody-CrudColores").empty();
        $.ajax({
          dataType: 'json',
          url: uri+'ctrConfiguracion/listarColoresAjax'
        }).done(function(resp){
          var tr = "";
          var cont = 0;
          $(resp).each(function(i){
            tr += '<tr><td>'+(cont+=1)+
            '</td><td><i class="fa fa-square" style="color:'+resp[i]["Codigo_Color"]+
            '; font-size: 200%;"></i></td><td>'+resp[i]["Nombre"]+
            '</td><td style="display: none;">'+resp[i]["Id_Color"]+
            '</td><td style="text-align: center;"><button id="editCol'+resp[i]["Id_Color"]+'" onclick="editCrudColores(this, '+resp[i]["Id_Color"]+');" class="btn btn-box-tool"><i style="font-size: 150%; color: green;" class="fa fa-pencil-square-o" arial-hidden="true"></i></button></td><td style="text-align: center;"><button id="deleteCol'+resp[i]["Id_Color"]+'" onclick="confirmacionColor(this, '+resp[i]["Id_Color"]+', '+true+');" class="btn btn-box-tool"><i style="font-size: 150%; color: red;" class="fa fa-times" arial-hidden="true"></i></button></td><td style="text-align: center;"><button onclick="guardarEditCol(this, '+resp[i]["Id_Color"]+')" id="guardarEditCol'+resp[i]["Id_Color"]+'" disabled="true" type="button" class="btn btn-box-tool"><i class="font-size: 150%; fa fa-check" arial-hidden="true"></i></button></td><td style="display: none;">'+resp[i]["Codigo_Color"]+'</td></tr>';
          });
            $("#tbody-CrudColores").append(tr);
            // $("#table-CrudColores").DataTable();
        }).fail(function(){
          console.log("fail");
        });
      }


      function editCrudColores(element, id){
        var color = $(element).parent().parent();

        $("#tbody-CrudColores tr").each(function(){
          var idCol = $(this).find("td").eq(3).html();
          if ($("#nomCrudColEdit"+idCol).val()) {
            var colorCuadro = '<i class="fa fa-square" style="color:'+$("#inputCodCol"+idCol).val()+
            '; font-size: 200%;"></i>';
            $(this).find("td").eq(1).html(colorCuadro);
            $(this).find("td").eq(2).html($("#nomCrudColEdit"+idCol).val());
            $("#editCol"+idCol).attr("disabled", false);
            $("#deleteCol"+idCol).attr("disabled", false);
            $("#guardarEditCol"+idCol).attr("disabled", true);
          }
        });

        var intColor = '<div  id="colPickerTable'+id+'" class="input-group colorpicker-element"><input id="inputCodCol'+id+'" type="hidden" value="'+$(color).find("td").eq(7).html()+'"><div class="input-group-addon"><i type="input" style="background-color: '+$(color).find("td").eq(7).html()+';"></i></div></div>';
        var intNom = "<div class='form-group'><div class='input-group'><input id='nomCrudColEdit"+id+"' type='text' class='form-control' value='"+$(color).find("td").eq(2).html()+"'><div class='input-group-addon'><button onclick='listarColores()' style='padding: 0 !important' class='btn btn-box-tool'><i class='fa fa-times' aria-hidden='true'></i></button></div></div></div>";
        $(color).find("td").eq(1).html(intColor);
        $(color).find("td").eq(2).html(intNom);
        $("#colPickerTable"+id).colorpicker();
        $("#editCol"+id).attr("disabled", true);
        $("#deleteCol"+id).attr("disabled", true);
        $("#guardarEditCol"+id).attr("disabled", false);
      }


      function editCrudMedidas(element, id){
        var medida = $(element).parent().parent();

        $("#tbody-CrudMedidas tr").each(function(){
          var idMed = $(this).find("td").eq(3).html();
          if ($("#nomCrudMedEdit"+idMed).val()) {
            $(this).find("td").eq(1).html($("#nomCrudMedEdit"+idMed).val());
            $(this).find("td").eq(2).html($("#abrCrudMedEdit"+idMed).val());
            $("#editMed"+idMed).attr("disabled", false);
            $("#btnDeleteMed"+idMed).attr("disabled", false);
            $("#guardarEditMed"+idMed).attr("disabled", true);
          }
        });

        var intNom = "<input id='nomCrudMedEdit"+id+"' type='text' class='form-control' value='"+$(medida).find("td").eq(1).html()+"'>";
        var intAbr = "<div class='form-group'><div class='input-group'><input id='abrCrudMedEdit"+id+"' type='text' class='form-control' value='"+$(medida).find("td").eq(2).html()+"'><div class='input-group-addon'><button onclick='listarMedidas()' style='padding: 0 !important' class='btn btn-box-tool'><i class='fa fa-times' aria-hidden='true'></i></button></div></div></div>";
        $(medida).find("td").eq(1).html(intNom);
        $(medida).find("td").eq(2).html(intAbr);
        $("#editMed"+id).attr("disabled", true);
        $("#btnDeleteMed"+id).attr("disabled", true);
        $("#guardarEditMed"+id).attr("disabled", false);
      }

      function guardarEditCol(element, id){
        var color = $(element).parent().parent();
        var codigo = $("#inputCodCol"+id).val();
        var nombre = $("#nomCrudColEdit"+id).val();

        $.ajax({
          type: 'POST',
          dataType: 'json',
          url: uri+'ctrConfiguracion/modificarColor',
          data: {id: id, codigo: codigo, nombre: nombre, crudCol: true}
        }).done(function(){
          listarColores();
          Lobibox.notify('success', {delay: 6000, size: 'mini', msg: 'El color se modifico correctamente'});
        });
      }

      function guardarEditMed(element, id){
          var nombre = $("#nomCrudMedEdit"+id).val();
          var abr = $("#abrCrudMedEdit"+id).val();
         $.ajax({
            type: 'POST',
            dataType: 'json',
            url: uri+'ctrConfiguracion/modificarMedida',
            data: {cod: id, nombre: nombre, abr: abr, crudMed: true}
         }).done(function(){
            listarMedidas();
            Lobibox.notify('success', {delay: 6000, size: 'mini', msg: 'La unidad de medida se modifico correctamente'});
         });
      }


      function regColor(){
        $("#nomColorCrud").parsley().validate();
        if ($("#nomColorCrud").val() != "") {
            var nomColor = $("#nomColorCrud").val();
            var codColor = $("#codigoColorCrud").val();
            $.ajax({
              type: 'POST',
              dataType: 'json',
              url: uri+'ctrConfiguracion/validateColor',
              data: {nombre: nomColor}
            }).done(function(resp){
              if (resp == false) {
                  $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: uri+'ctrConfiguracion/registrarColor',
                    data: {codigo: codColor, nombre: nomColor, crudCol: true}
                  }).done(function(){
                    $("#nomColorCrud").val("");
                    $("#codigoColorCrud").val("#0000ff");
                    $("#colColCrudBox").css("background-color", "blue");
                    listarColores();
                    Lobibox.notify('success', {delay: 6000, size: 'mini', msg: 'El color se registro correctamente'});
                  }).fail(function(){
                    console.log("fail");
                  });
              }else{
                  Lobibox.notify('error', {delay: 6000, size: 'mini', msg: 'El color ingresado ya existe'});
              }
            }).fail(function(){
              console.log("fail");
            });
        }
      }


      function regMedida(){
        $("#nomMedidaCrud").parsley().validate();
        $("#AbreMedidaCrud").parsley().validate();

        if ($("#nomMedidaCrud").val() != "" && $("#AbreMedidaCrud").val() != "") {
          var nomMedida = $("#nomMedidaCrud").val();
          var Abreviatura = $("#AbreMedidaCrud").val();

          $.ajax({
              type: 'POST',
              dataType: 'json',
              url: uri+'ctrConfiguracion/validateMedida',
              data: {nombre: nomMedida, Abr: Abreviatura}
            }).done(function(resp){
              if (resp == false) {
                $.ajax({
                  type: 'POST',
                  dataType: 'json',
                  url: uri+'ctrConfiguracion/registrarMedida',
                  data: {Abr: Abreviatura, nombre: nomMedida, crudMed: true}
                }).done(function(){
                  $("#nomMedidaCrud").val("");
                  $("#AbreMedidaCrud").val("");
                  listarMedidas();
                  Lobibox.notify('success', {delay: 6000, size: 'mini', msg: 'La unidad de medida se registro correctamente'});
                }).fail(function(){
                  console.log("fail");
                });
              }else{
                Lobibox.notify('error', {delay: 6000, size: 'mini', msg: 'La unidad de medida ingresada ya existe'});
              }
            });
        }
      }

      function resetCol(){
        $("#colDatapicker").css("background-color", "blue");
      }


      function asignarDataTable(){
      $(function() {
        $(".paginate-search-table").DataTable();
        $('.paginate-table').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        })
      });
     } 

    //Initialize Select2 Elements
    // $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
    {
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate: moment()
    },
    function (start, end) {
      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }
    );

    //Date picker
    $('.calendario').datepicker({
      autoclose: true
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  // });

  function editarColor(codigo, colores){
    var campos = $(colores).parent().parent();
    $("#codigo").val(campos.find("td").eq(2).text());
    // $("#i").on('mouseleave', function(ev){
    //     alert("Hola, diste click afuera del color");
    // });
    $("#i").css("background-color", campos.find("td").eq(2).text());
    $("#inputNom").val(campos.find("td").eq(3).text());
    $("#id").val(campos.find("td").eq(4).text());
    $("#modalEditColor").show();
  }

  function confirmacionColor(element, id, val){

    swal({
      title: "¿Seguro que desea eliminar el color?",
      text: "",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Si, borrar color",
      closeOnConfirm: true
    },
    function(){
      $.ajax({
        dataType: 'json',
        type: 'POST',
        url: uri+'ctrConfiguracion/eliminarColor',
        data: {idColor: id}
      }).done(function(){
        if (val) {
          listarColores();
          Lobibox.notify('success', {delay: 6000, size: 'mini', msg: 'El color se elemino correctamente'});
        }else{
          location.href = uri+'ctrConfiguracion/listarColores';            
        }
      }).fail(function(){
        Lobibox.notify('error', {delay: 6000, size: 'mini', msg: 'El color no se puede eliminar dado que esta asociado a un insumo o ficha tecnica'});
      });
    });
  }

  function editar(codigo, medidas){
    var campos = $(medidas).parent().parent();
    $("#cod").val(campos.find("td").eq(3).text());
    $("#nombre").val(campos.find("td").eq(1).text());
    $("#abr").val(campos.find("td").eq(2).text());
    $("#myModalMedidas").show();
  }

  function confirmacionDeleteMed(cod, val){
    swal({
      title: "¿Seguro que desea eliminar la unidad de medida?",
      text: "",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Si, borrar medida",
      closeOnConfirm: true
    },
    function(){
      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: uri+'ctrConfiguracion/eliminarMedida',
        data: {cod: cod}
      }).done(function(){
        if (val) {
          listarMedidas();
          Lobibox.notify('success', {delay: 6000, size: 'mini', msg: 'La unidad de medida se elemino correctamente'});
        }else{
          location.href = uri+'ctrConfiguracion/listarMedidas';
        }
      }).fail(function(){
        Lobibox.notify('error', {delay: 6000, size: 'mini', msg: 'La unidad de medida no se puede eliminar dado que esta asociado a un insumo'});
      });
    });
  }

  $('#tblListarUnidMedida').dataTable({
    "ordering": false,
        "language": {
            "emptyTable": "No hay unidades de medida para listar.",
            "info": "",
            "infoEmpty": "",
            "zeroRecords": "No se encontraron medidas que coincidan con la búsqueda.",
        "paginate": {
          "previous": "Anterior",
          "next": "Siguiente"
         }
        },
        "lengthMenu": [[3], [3]]
  });

  $('#tblConfColores').dataTable({
    "ordering": false,
        "language": {
            "emptyTable": "No hay colores para listar.",
            "info": "",
            "infoEmpty": "",
            "zeroRecords": "No se encontraron colores que coincidan con la búsqueda.",
        "paginate": {
          "previous": "Anterior",
          "next": "Siguiente"
         }
        },
        "lengthMenu": [[3], [3]]
  });


