function cambiarEstado(cod, est){
    $.ajax({
        dataType:'json',
        type:'post',
        url:uri+"ctrlPersona/modificarEstado",
        data:{id:cod, estado:est}
    }).done(function(respuesta){
        if (respuesta.v == "1"){
            alert("Si");
            location.href = uri+"ctrlPersona/index";
        }else{
            alert("No");
        }
    }).fail(function(respuesta){
        alert(cod+"-"+est);
    })
}

 function cambiarEstadoCoti(cod, est){
        $.ajax({
            dataType: 'json',
            type: 'post',
            url: uri+"ctrCotizacion/cambiarEstado",
            data: {cod:cod, est:est}
        }).done(function(respuesta){
            if (respuesta.v == "1") {
                window.location = uri + "ctrCotizacion/consCotizacion";
            }else{
                alert("Ocurrió un error al cambiar estado");
            }
        }).fail(function() {

        })
    }
