function asociarPermisos(Id_Permiso, modulos, Nombre, idbton){
	var campos = $(permisos).parent().parent();
    $("#permisosasig").removeAttr("hidden");
	var tr = "<tr class='box box-solid collapsed-box'><td style='display:none;' >"+Id_Permiso+"<input type='hidden' value='"+Id_Permiso+"' name=Idpermiso[] /></td><td>"+modulos+"</td><td>"+Nombre+"</td><td><button type='button' onclick='quitarPermisoAsignado("+idbton+", this)' class='btn btn-box-tool'><i style='font-size:150%;' class='fa fa-times'></i></button></td></tr>";
	$("#tablaPermisos").append(tr);

    boton = "#bt"+idbton;
    $(boton).attr('disabled', 'disabled');

    $("#tblpermisosvacia").remove();
}

function quitarPermisoAsignado(btn, elemento){
  var e = $(elemento).parent().parent();
  $(e).remove();

  boton = "#bt"+btn;
  $(boton).attr('disabled', false);

  if ($("#tblPas tr").length < 2) {
    $("#tblPas").empty();
    var tr = '<tr><td id="tblpermisosvacia" colspan="3" style="text-align:center;">No hay permisos asociados.</td></tr>';
    $("#tblPas").append(tr);
  }
}

function quitarPermisoAsignadoMod(btn, elemento){
  var e = $(elemento).parent().parent();
  $(e).remove();

  boton = "#btn"+btn;
  $(boton).attr('disabled', false);
  if ($("#fila tr").length < 1) {
    $("#fila").empty();
    var tr = '<tr id="tblpervacia"><td id="tblpermisosmodvacia" colspan="3" style="text-align:center;">No hay permisos asociados.</td></tr>';
    $("#fila").append(tr);
  }
}

function quitarPermisosR(btn, elemento){
    // var e = $(elemento).parent().parent();
    // $(e).remove();

    // boton = "#bt"+btn;
    // boton = "#btn"+btn;
    // $(boton).attr('disabled', false);

    // if ($("#tblPas tr").length < 2) {
    //   $("#tblPas").empty();
    //   var tr = '<tr><td id="tblpermisosvacia" colspan="3" style="text-align:center;">No hay permisos asociados.</td></tr>';
    //   $("#tblPas").append(tr);
    // }
}

$(document).ready(function(){
  $("#tblpermisosvacia").html("No hay permisos asociados.");
});

function asociarPermisosNuevos(Id_Permiso, modulos, Nombre, idbton){
   var campos = $(permisos).parent().parent();
    $("#permisosN").removeAttr("hidden");
  
    //rol que se va a agregar
    idrolagregar = Id_Permiso;

    //comparar con los que ya se encuentran agregados
    idpermisoagregado = "#idPermiso"+idbton;
    idperm = $(idpermisoagregado).val();

    if (idrolagregar == $(idpermisoagregado).val()) {
      boton = "#btn"+idbton;
      $(boton).attr('disabled', 'disabled');
    }
    else{
      var tr = "<tr class='box box-solid collapsed-box'><td style='display:none;'>"+Id_Permiso+"<input type='hidden' value='"+Id_Permiso+"' name=Idpermiso[] id='idPermiso"+idbton+"'></td><td>"+modulos+"</td><td>"+Nombre+"</td><td><button type='button' onclick='quitarPermisoAsignadoMod("+idbton+", this)' class='btn btn-box-tool'><i style='font-size:150%;' class='fa fa-remove'></i></button></td></tr>";
      $("#fila #tblpervacia").remove();
      $("#fila").append(tr);
      boton = "#btn"+idbton;
      $(boton).attr('disabled', 'disabled');
    }
}

    function editarRoles(Id_Rol, Nombre, roles, btn){
  
          var campos = $(roles).parent().parent();
          $("#idRol").val(campos.find("td").eq(0).text());
          $("#nombre_rol").val(campos.find("td").eq(1).text());
           $("#fila").empty();
           // $("#nombre_rol").val(Nombre);
    $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ctrConfiguracion/listarR",
            data: {rol: Id_Rol },
            success: function(data){
               // $("#Nombre").val(campos.find("td").eq(1).text());
              for (var i = 0; i < data.length; i++) {
                idperm=data[i]["Id_Permiso"];
                var fila = '<tr><td style="display:none;">'+data[i]["Id_Permiso"]+'<input type="hidden" name="Idpermiso[]" value="'+idperm+'" id="idPermiso'+idperm+'"></td><td>'+data[i]["NombreMod"]+'</td><td>'+data[i]["Nombre"]+'</td><td><button type="button" onclick="quitarPermisoAsignadoMod('+idperm+', this)" class="btn btn-box-tool"><i style="font-size:150%;" class="fa fa-remove"></i></button></td></tr>';
                $("#fila").append(fila);
              }
            }, 
            error: function(){
            }
        });
    }



    function listarRoles(Id_Rol, Nombre, roles){
          var campos = $(roles).parent().parent();
          $("#idRol").val(campos.find("td").eq(0).text());
          $("#nombreRol").val(campos.find("td").eq(1).text());
           $("#filass").empty();
           // $("#nombre_rol").val(Nombre);

    $.ajax({

            dataType: 'json',
            type: 'post',
            url: uri+"ctrConfiguracion/listarR",
            data: {rol: Id_Rol },
            success: function(data){
               // $("#Nombre").val(campos.find("td").eq(1).text());
            for (var i = 0; i < data.length; i++) {
              idperm=data[i]["Id_Permiso"];
              var fila = '<tr><td style="display:none;">'+data[i]["Id_Permiso"]+'<input type="hidden" name="Idpermiso[]" value="'+idperm+'"/></td><td>'+data[i]["NombreMod"]+'</td><td>'+data[i]["Nombre"]+'</td></tr>'; 
              $("#filass").append(fila);
                          } 
            }, 
            error: function(){
            }
        });
  
    }


    function editarRolesN(Id_Rol, Nombre, roles){
          var campos = $(roles).parent().parent();
          $("#idRol").val(campos.find("td").eq(0).text());
          $("#nombre_rol").val(campos.find("td").eq(1).text());
           $("#fila").empty();
           // $("#nombre_rol").val(Nombre);

    $.ajax({

            dataType: 'json',
            type: 'post',
            url: uri+"ctrConfiguracion/listarR",
            data: {rol: Id_Rol },
            success: function(data){
               // $("#Nombre").val(campos.find("td").eq(1).text());
            for (var i = 0; i < data.length; i++) {
              idperm=data[i]["Id_Permiso"];
              var fila = '<tr><td>'+data[i]["Id_Permiso"]+'<input type="hidden" name="Idpermiso[]" value="'+idperm+'"/></td><td>'+data[i]["NombreMod"]+'</td><td>'+data[i]["Nombre"]+'</td><td><button type="button" onclick="quitarPermisosR(0, this)" class="btn btn-box-tool"><i class="fa fa-remove"></i></button></td></tr>'; 
              $("#fila").append(fila);
                          } 
            }, 
            error: function(){
            }
        });
  
    }


  function editarUsuarios(Num_Documento, usuarios){
    var campos = $(usuarios).parent().parent();
    $("#codigo").val(campos.find("td").eq(0).text());
    $("#tipo_documento").val(campos.find("td").eq(1).text());
    $("#documento").val(campos.find("td").eq(2).text());
    $("#nombre").val(campos.find("td").eq(3).text());
    $("#apellido").val(campos.find("td").eq(4).text());
    $("#estado").val(campos.find("td").eq(5).text());
    $("#nombre_usuario").val(campos.find("td").eq(6).text());
     // $("#clave").val(campos.find("td").eq(7).text());
    $("#email").val(campos.find("td").eq(7).text());   
    $("#rol").val(campos.find("td").eq(9).html());
    console.log(campos.find("td").eq(9).text());
    $("#myModal3").show();
            }

 function editarClientes(Num_Documento, clientes){
    var campos = $(clientes).parent().parent();
    $("#Tipo_Documento").val(campos.find("td").eq(0).text());
    $("#Num_Documento").val(campos.find("td").eq(1).text());
    $("#Nombre").val(campos.find("td").eq(2).text());
    $("#Apellido").val(campos.find("td").eq(3).text());
    $("#Telefono").val(campos.find("td").eq(4).text());
    $("#Direccion").val(campos.find("td").eq(5).text());   
    $("#Email").val(campos.find("td").eq(6).text());
    $("#infoAdicionalMod").val(campos.find("td").eq(10).text());
    $("#myModalC").show();
    }
      
  function cambiarEstado(documento, est){
        $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ctrUsuario/cambiarEstado",
            data: {Num_Documento:documento, Estado:est}
        }).done(function(respuesta){
            if (respuesta.v == "1") {
            
                location.href = uri +"ctrUsuario/consUsuario";
            }else{
            }
        }).fail(function() {

        });
    }

     function cambiarEstadoC(documento, est){
        $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ctrCliente/CambiarEstado",
            data: {Num_Documento:documento, Estado:est}

        }).done(function(respuesta){
            if (respuesta.v == "1") {
               
                location.href = uri +"ctrCliente/consCliente";
            }else{
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
                //Lobibox.notify('success', {delay: 6000, size: 'mini', msg: 'La orden se modificó correctamente!'});
                //alert("Estado modificado");
                location.href = uri +"ctrConfiguracion/RegistrarRoles";
            }else{
                  // Lobibox.notify('errors', {size: 'mini', rounded: true, delayIndicator: false, msg: 'Error al actualizar el estado'});
            }
        }).fail(function() {

        });
    }

     $(document).ready(function(){
        $('#tablaListarRoles').dataTable( {
          // "lengthChange": false,
          //"searching": false,
          // "info": false,
         "ordering": false,
      "language": {
          "emptyTable": "No hay roles para listar",
          "info": "Mostrando página _PAGE_ de _PAGES_",
          "infoEmpty": "Mostrando página _PAGE_ de _PAGES_",
          "zeroRecords": "No se encontraron roles que coincidan con la búsqueda",
      "paginate": {"previous": "Anterior", "next": "Siguiente"}
      },
      "lengthMenu": [[3], [3]]
        });
      });

      $(document).ready(function(){
        $('#TablaClientes').dataTable( {
          // "lengthChange": false,
          //"searching": false,
          // "info": false,
          "ordering": false,
      "language": {
          "emptyTable": "No hay usuarios para listar",
          "info": "",
          "infoEmpty": "",
          "zeroRecords": "No se encontraron usuarios que coincidan con la búsqueda",
      "paginate": {
        "previous": "Anterior",
        "next": "Siguiente"
       }
      },
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]]
        });
      });

      //    $(document).ready(function(){
      //   $('#tablaR').DataTable( {
      //     // "lengthChange": false,
      //     //"searching": false,
      //     // "info": false,
      //     "ordering": false
      //   });
      // });

           $(document).ready(function(){
        $('#TablaUsuarios').dataTable( {
          // "lengthChange": false,
          //"searching": false,
          // "info": false,
          "ordering": false,
      "language": {
          "emptyTable": "No hay usuarios para listar",
          "info": "",
          "infoEmpty": "",
          "zeroRecords": "No se encontraron usuarios que coincidan con la búsqueda",
      "paginate": {
        "previous": "Anterior",
        "next": "Siguiente"
       }
      },
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]]
        });
      });

//validar que si ingrese datos correctos
function validarSiDocumento(documento){
  if (!/^([0-9])*$/.test(documento) || documento.charAt(0) == 0)
    Lobibox.notify('warning', {size: 'mini', delayIndicator: false, msg: 'El número de documento contiene caracteres incorrectos'}); 
}
 

//Validar email
function validarEmail(email) {
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(email) )
      Lobibox.notify('warning', {size: 'mini', delayIndicator: false, msg: 'El email ingresado contiene caracteres incorrectos'}); 
}

function validarTelefono(telefono){
    if (!/^([0-9])*$+/.test(telefono))
      Lobibox.notify('warning', {size: 'mini', delayIndicator: false, msg: 'El numero de telefono ingresado contiene caracteres incorrectos'}); 
  }


function validarRol(){
  if($("#tblPas tr").length > 0 && $("#tblpermisosvacia").length == 0){
    return true;
  }else{
    Lobibox.notify('warning', {size: 'mini', delayIndicator: false, msg: 'Debe asignar al menos un permiso al rol.'}); ;
    return false;
  }
}

function validarRolEdit(){
  if($("#tblpermisosmodvacia").length){
    Lobibox.notify('warning', {size: 'mini', delayIndicator: false, msg: 'Debe asignar al menos un permiso al rol.'}); ;
    return false;
  }else{
    return true;
  }
  return false;
}

function limpiarTablePermisosRoles(){
  var tr = '<tr><td id="tblpermisosvacia" colspan="3" style="text-align:center;">No hay permisos asociados.</td></tr>';
  $("#tblPas").empty();
  $("#tblPas").append(tr);
}

function enviarFormRegUsuario(){
  var clave1 = $("#contraseña").val();
  var clave2 = $("#confirmContraseña").val();
 
  if (clave1 != clave2) {

    Lobibox.notify('warning', {size: 'mini', delayIndicator: false, msg: 'Las contraseñas no coinciden'});
    $("#contraseña").val("");
    $("#confirmContraseña").val("");
    return false;
  }
  if (/\s/.test(clave1) || /\s/.test(clave2)) {
    Lobibox.notify('warning', {size: 'mini', delayIndicator: false, msg: 'La contraseña no debe contener espacios en blanco'});
    $("#contraseña").val("");
    $("#confirmContraseña").val("");
    return false;
  }else{
    return true;
  }
  return false;
}

