<?php 

	class ctrCotizacion extends Controller{

		private $modelo = null;

		function __construct(){

			$this->modelo = $this->loadModel("mdlCotizacion"); 
		}

		public function consCotizacion(){

			$mensaje = "";
			$mensaje2 = "";

			$cotizaciones = $this->modelo->getCotizacion();
			$clientes = $this->modelo->getCliente();
			
			require APP.'view/_templates/header.php';
			require APP.'view/Cotizacion/consCotizacion.php';
			require APP.'view/_templates/footer.php';
		}	

		public function regCotizacion(){
			
			$mensaje = "";
			$mensaje2 = "";

			if (isset($_POST["btnRegistrar"])) {

	            $this->modelo->__SET("Num_Documento", $_POST["documento_cli"]);
	            $this->modelo->__SET("Id_Estado", 1);
	            $this->modelo->__SET("Fecha_Registro", $_POST["fecha_R"]);
	            $this->modelo->__SET("Valor_Total", $_POST["vlr_total"]);
	          
	         if($this->modelo->regCotizacion()){

	            $ultimaSolicitud_reg = $this->modelo->ultimaSolicitud();

	            $this->modelo->__SET("Id_Solicitud", $ultimaSolicitud_reg["Id_Solicitud"]);
	            $this->modelo->__SET("Id_tipoSolicitud", 1);
	            $this->modelo->__SET("Fecha_Vencimiento", $_POST["fecha_V"]);
	            $this->modelo->registra_Tipo();

	            $ultimo_tipo_solicitud = $this->modelo->ultimaSolicitud_Tipo();

	            for ($i = 0; $i < count($_POST["referencia"]) ; $i++) { 
	            $this->modelo->__SET("Id_tipoSolicitud", $ultimo_tipo_solicitud["Id_Tipo_Solicitud"]);
	            $this->modelo->__SET("referencia", $_POST["referencia"][$i]);

	            $this->modelo->__SET("Cantidad_existencias", 0);
	            $this->modelo->__SET("Estado_", "k");
	            $this->modelo->__SET("Cantidad_Producir", $_POST["cantiProdu"][$i]);
	            $this->modelo->__SET("subtotal", $_POST["subtot"][$i]);

	            $this->modelo->regProducto_Aso();
	            }
			        $mensajeCo = "swal('Cotizacion Registrada Exitosamente','','success')";
			         
			    }else{
			    	$mensajeCo = "swal('Cotizacion No Registrada','','success')";
			    }

            
	        }

         

            $fichas = $this->modelo->getFichas();         
            $clientes = $this->modelo->getCliente();
 
			require APP.'view/_templates/header.php';
			require APP.'view/Cotizacion/regCotizacion.php';
			require APP.'view/_templates/footer.php';
		}

		public function modiCotizacion(){
			$mensaje = "";
			$mensaje2 = "";

			if (isset($_POST["btnModificar"])){

	            $this->modelo->__SET("Num_Documento", $_POST["cliente"]);
	            $this->modelo->__SET("Id_Estado", $_POST["estad"]);	
	            $this->modelo->__SET("Id_Solicitud", $_POST["codigo"]);
	            $this->modelo->__SET("Fecha_Vencimiento", $_POST["fechaVencimiento"]);
	            
				if ($this->modelo->modiCotizacion()){

				$mensaje2 = "swal('Cotizacion Modifacada Exitosamente','','success')";
				}else {
				$mensaje2 = "swal('Modifacada Fracasada','','success')";
				}

				header ("location: ".URL."ctrCotizacion/consCotizacion");
			}

				$cotizaciones = $this->modelo->getCotizacion();
				
				require APP.'view/_templates/header.php';
				require APP.'view/cotizacion/consCotizacion.php';
				require APP.'view/_templates/footer.php';
		}

		// public function cambiarEstado(){

		// 	$this->modelo->__SET("codigo", $_POST["codigo"]);
	    //  $this->modelo->__SET("tado", $_POST["tado"]);
		//     $cotizaciones = $this->modelo->cambiarEstado();
		//     if ($cotizaciones) {
		//     	echo json_encode(["v"=>1]);
		//     }else{
		//     	echo json_encode(["v"=>0]);
		//     }
		// }

		public function factura($cod){
			$this->modelo->__SET("Id_Solicitud", $cod);
			$factura = $this->modelo->facturaVenta();

			if($factura != false){
				require APP.'view/cotizacion/factura.php';
			}else{
				require APP.'view/cotizacion/consCotizacion.php';	
			}
			
		}
	}
?>