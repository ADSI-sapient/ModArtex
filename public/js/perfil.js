	$("#checkClavePerf").on("change", function(){
		if ($("#checkClavePerf").prop("checked")) {
			$(".clavePerfil").removeAttr("style");
		}else{
			$(".clavePerfil").attr("style", "display: none");
		}
	});
