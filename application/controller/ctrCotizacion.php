<?php 

	class Cotizacion extends Controller{

		private $modelo = null;

		function __construct(){

			$this->modelo = $this->loadModel("mdlCotizacion"); 
		}

		public function consCotizacion(){

			$mensaje = "";
			$mensaje2 = "";

			$cotizaciones = $this->modelo->getCotizacion();

			require APP.'view/_templates/header.php';
			require APP.'view/Cotizacion/consCotizacion.php';
			require APP.'view/_templates/footer.php';
		}	

		public function regCotizacion(){
			

			$mensaje = "";
			$mensaje2 = "";

			if (isset($_POST["btnRegistrar"])) {

	            $this->modelo->__SET("fechaRegistro", $_POST["fecha_R"]);
	            $this->modelo->__SET("estado", $_POST["estado"]);
	            $this->modelo->__SET("fechaVencimiento", $_POST["fecha_V"]);
	            $this->modelo->__SET("valorTotal", $_POST["vlr_total"]);
	            $this->modelo->__SET("cliente", $_POST["cliente"]);

	         if($this->modelo->regCotizacion()){
			        $mensaje = "swal('Cotizacion Registrada Exitosamente','','success')";
			    }else{
			    	$mensaje = "swal('Cotizacion No Registrada','','success')";
			    }
	        }
	           $clientes = $this->modelo->getCliente();
			require APP.'view/_templates/header.php';
			require APP.'view/Cotizacion/regCotizacion.php';
			require APP.'view/_templates/footer.php';
		}

		public function modiCotizacion(){
			$mensaje = "";
			$mensaje2 = "";

			if (isset($_POST["btnModificar"])){

	            $this->modelo->__SET("codigo", $_POST["codigo"]);
	            $this->modelo->__SET("fechaRegistro", $_POST["fechaRegistro"]);
	            $this->modelo->__SET("estado", $_POST["estado"]);
	            $this->modelo->__SET("fechaVencimiento", $_POST["fechaVencimiento"]);
	            $this->modelo->__SET("valorTotal", $_POST["valorTotal"]);
	            $this->modelo->__SET("cliente", $_POST["cliente"]);
	            

				if ($this->modelo->modiCotizacion()){

				$mensaje2 = "swal('Cotizacion Modifacada Exitosamente','','success')";
				}else {
				$mensaje2 = "swal('Modifacada Fracasada','','success')";
				}
			}

				$cotizaciones = $this->modelo->getCotizacion();

				require APP.'view/_templates/header.php';
				require APP.'view/Cotizacion/consCotizacion.php';
				require APP.'view/_templates/footer.php';
		}

		public function cambiarEstado(){

			$this->modelo->__SET("codigo", $_POST["codigo"]);
	        $this->modelo->__SET("tado", $_POST["tado"]);
		    $cotizaciones = $this->modelo->cambiarEstado();
		    if ($cotizaciones) {
		    	echo json_encode(["v"=>1]);
		    }else{
		    	echo json_encode(["v"=>0]);
		    }
		}
	}
?>