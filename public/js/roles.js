function asociarPermisos(Id_Permiso, modulos, Nombre, idbton){
	var campos = $(permisos).parent().parent();
    $("#permisosasig").removeAttr("hidden");
	var tr = "<tr class='box box-solid collapsed-box'><td>"+Id_Permiso+"<input type='hidden' value='"+Id_Permiso+"' name=Idpermiso[] /></td><td>"+modulos+"</td><td>"+Nombre+"</td><td><button type='button' onclick='quitarPermisosR(0, this)' class='btn btn-box-tool'><i class='fa fa-minus'></i></button></td></tr>";
	$("#tablaPermisos").append(tr);

    boton = "#btn"+idbton;
    $(boton).attr('disabled', 'disabled');
}


function quitarPermisosR(btn, elemento){
    var e = $(elemento).parent().parent();
    $(e).remove();
}

function asociarPermisosNuevos(Id_Permiso, modulos, Nombre, idbton){
   var campos = $(permisos).parent().parent();
    $("#permisosN").removeAttr("hidden");
  var tr = "<tr class='box box-solid collapsed-box'><td>"+Id_Permiso+"<input type='hidden' value='"+Id_Permiso+"' name=Idpermiso[] /></td><td>"+modulos+"</td><td>"+Nombre+"</td><td><button type='button' onclick='quitarPermisosR("+idbton+", this)' class='btn btn-box-tool'><i class='fa fa-minus'></i></button></td></tr>";
  $("#tablaR").append(tr);

    boton = "#btn"+idbton;
    $(boton).attr('disabled', 'disabled');
}

    function editarRoles(Id_Rol, Nombre){
          
           $("#fila").empty();

    $.ajax({

            dataType: 'json',
            type: 'post',
            url: uri+"ctrConfiguracion/listarR",
            data: {rol: Id_Rol },
            success: function(data){
               // $("#Nombre").val(campos.find("td").eq(1).text());
            for (var i = 0; i < data.length; i++) {
              var fila = '<tr><td>'+data[i]["Id_Permiso"]+'</td><td>'+data[i]["NombreMod"]+'</td><td>'+data[i]["Nombre"]+'</td><td><button type="button" onclick="quitarPermisosR(0, this)" class="btn btn-box-tool"><i class="fa fa-minus"></i></button></td></tr>'; 
              $("#fila").append(fila);
                          } 
            }, 
            error: function(){
            }
        });
    // var campos = $(roles).parent().parent();
    //        $("#Nombre").val(campos.find("td").eq(1).text());
  
    }


  function editarUsuarios(codigo, usuarios){
    var campos = $(usuarios).parent().parent();
    $("#codigo").val(campos.find("td").eq(0).text());
    $("#tipo_documento").val(campos.find("td").eq(1).text());
    $("#documento").val(campos.find("td").eq(2).text());
    $("#estado").val(campos.find("td").eq(3).text());
    $("#nombre").val(campos.find("td").eq(4).text());
    $("#apellido").val(campos.find("td").eq(5).text());
    $("#nombre_usuario").val(campos.find("td").eq(6).text());
              // $("#clave").val(campos.find("td").eq(7).text());
              $("#email").val(campos.find("td").eq(7).text());   
              $("#rol").val(campos.find("td").eq(9).text());
              $("#myModal3").show();
            }

      

        function cambiarEstado(documento, est){
        $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ctrUsuario/cambiarEstado",
            data: {Num_Documento:documento, Estado:est}
        }).done(function(respuesta){
            if (respuesta.v == "1") {
                Lobibox.notify('success', {size: 'mini', rounded: true, delayIndicator: false, msg: 'Estado actualizado'});
                location.href = uri +"ctrUsuario/consUsuario";
            }else{
                  Lobibox.notify('errors', {size: 'mini', rounded: true, delayIndicator: false, msg: 'Error al actualizar el estado'});
            }
        }).fail(function() {

        });
    }

        function cambiarEstadoRol(Id_Rol, est){
        $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ctrConfiguracion/cambiarEstadoRol",
            data: {Id_Rol:Id_Rol, Estado:est}
        }).done(function(respuesta){
            if (respuesta.v == "1") {
                // Lobibox.notify('success', {size: 'mini', rounded: true, delayIndicator: false, msg: 'Estado actualizado'});
                alert("Estado modificado");
                location.href = uri +"ctrConfiguracion/RegistrarRoles";
            }else{
                  Lobibox.notify('errors', {size: 'mini', rounded: true, delayIndicator: false, msg: 'Error al actualizar el estado'});
            }
        }).fail(function() {

        });
    }

     $(document).ready(function(){
        $('#tablaListar').DataTable( {
          // "lengthChange": false,
          //"searching": false,
          // "info": false,
          "ordering": false
        });
      });

      // $(document).ready(function(){
      //   $('#tablaR').DataTable( {
      //     // "lengthChange": false,
      //     //"searching": false,
      //     // "info": false,
      //     "ordering": false
      //   });
      // });




