$(document).ready(function(){
	$("#checkClavePerf").on("change", function(){
		if ($("#checkClavePerf").prop("checked")) {
			$(".clavePerfil").removeAttr("style");
		}else{
			$(".clavePerfil").attr("style", "display: none");
		}
	});
});

function validEdiperfil(clave){
	var res = true;
    if ($("#checkClavePerf").prop("checked")) {
    	$("#perClaveAct").parsley().validate();
    	$("#perClaveAct").attr("required", "");

    	$("#perClaveNue").parsley().validate();
    	$("#perClaveNue").attr("required", "");

    	$("#perRepClaveNue").parsley().validate();
    	$("#perRepClaveNue").attr("required", "");


    	var claveIn = $("#perClaveAct").val();
    	if (claveIn != "") {
    	$.ajax({
    		type: 'POST',
    		dataType: 'json',
    		url: uri+'ctrUsuario/encriptarClave',
    		data: {claveIn: claveIn}
    	}).done(function(claveEncript){
    		if (claveEncript != clave) {
    			Lobibox.notify('warning', {size: 'mini', msg: 'La clave actual no coincide con la clave ingresada', delay: 6000});
    			$("#perClaveAct").val("");
    			$("#perClaveNue").val("");
    			$("#perRepClaveNue").val("");
    			res = false;
    		}else{
    			var claveNueva = $("#perClaveNue").val();
    			var repClaveNueva = $("#perRepClaveNue").val();

    			if (claveNueva != repClaveNueva) {
    				$("#perClaveAct").val("");
    				$("#perClaveNue").val("");
    				$("#perRepClaveNue").val("");
    				Lobibox.notify('warning', {size: 'mini', msg: 'No coincide al repetir la nueva clave', delay: 6000});
    				res = false;
    			}else{
    				$.ajax({
    					type: 'POST',
    					dataType: 'json',
    					url: uri+'ctrUsuario/encriptarClave',
    					data: {claveIn: claveNueva}
    				}).done(function(claveEncriptada){
    					$("#claveEdit").val(claveEncriptada);
    					$("#frmEditPerfil").submit();
    				});
    			}
    		}
    	});
    	}
    }else{
        $("#frmEditPerfil").submit();
    }
}


