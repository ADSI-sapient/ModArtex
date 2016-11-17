<?php 
	class ctrCotizacion extends Controller{
		private $modelo = null;
		function __construct(){
			$this->modelo = $this->loadModel("mdlCotizacion"); 
		}

		public function consCotizacion(){
			if($this->validarURL("ctrCotizacion/consCotizacion")){
				$cotizaciones = $this->modelo->getCotizacion();
				date_default_timezone_set("America/Bogota");
			foreach ($cotizaciones as $cotizacion) {
				$fechaActual = date("Y-m-d");
				$fechaVencito = $cotizacion["Fecha_Vencimiento"];

				//$date1 = new DateTime("now");
				$fecha1 = new DateTime($fechaActual);
				$fecha2 = new DateTime($fechaVencito);
				if ($cotizacion["Sol_Repetida"] != 2) {
					if ($fecha1 >= $fecha2) {
						$this->modelo->__SET("Id_Solicitud", $cotizacion["Id_Solicitud"]);
						$this->modelo->__SET("Id_Estado", 3);
						$this->modelo->cotVencida();
					}	
				}
			}

			$clientes = $this->modelo->getCliente();
			$fichas = $this->modelo->getFichas();         
			$productos = $this->modelo->Ficha_habi();
			
			require APP.'view/_templates/header.php';
			require APP.'view/Cotizacion/consCotizacion.php';
			require APP.'view/_templates/footer.php';
			}else{
				header('location: '.URL.'home/index');
			}
		}	

		public function regCotizacion(){
			if($this->validarURL("ctrCotizacion/regCotizacion")){

			if (isset($_POST["btnRegistrar"])) {

	            $this->modelo->__SET("Num_Documento", $_POST["cliente"]);
	            $this->modelo->__SET("Fecha_Registro", $_POST["fecha_R"]);
	            $this->modelo->__SET("Valor_Total", $_POST["vlr_total"]);
	          
	         if($this->modelo->regCotizacion()){	         		
	            $ultimaSolicitud_reg = $this->modelo->ultimaSolicitud();

	            $this->modelo->__SET("Id_Solicitud", $ultimaSolicitud_reg["Id_Solicitud"]);
	            $this->modelo->__SET("Id_tipoSolicitud", 1);
	            $this->modelo->__SET("Fecha_Vencimiento", $_POST["fecha_V"]);
	            $this->modelo->__SET("Id_Estado", 2);
	            $this->modelo->registra_Tipo();

	            $ultimo_tipo_solicitud = $this->modelo->ultimaSolicitud_Tipo();

	            for ($i = 0; $i < count($_POST["idFicha"]) ; $i++) { 
	            $this->modelo->__SET("Id_tipoSolicitud", $ultimo_tipo_solicitud["Id_Tipo_Solicitud"]);
	            $this->modelo->__SET("referencia", $_POST["idFicha"][$i]);

	            $this->modelo->__SET("Cantidad_existencias", 0);
	            $this->modelo->__SET("Estado_", "k");
	            $this->modelo->__SET("Cantidad_Producir", $_POST["cantiProdu"][$i]);
	            $this->modelo->__SET("Subtotal", $_POST["subtot"][$i]);

	            $this->modelo->regProducto_Aso();
	            }
			        $_SESSION['alert'] = "Lobibox.notify('success', {size: 'mini', msg: 'Cotización registrada exitosamente!'});"; 
			        
			     	header(URL . '/ctrCotizacion/regCotizacion');    
			    }else{
			    	$mensajeCo = "swal('Cotizacion No Registrada','','success')";
			    }
	        }

            $fichas = $this->modelo->getFichas();
            $clientes = $this->modelo->getCliente();

			require APP.'view/_templates/header.php';
			require APP.'view/Cotizacion/regCotizacion.php';
			require APP.'view/_templates/footer.php';
			}else{
				header('location: '.URL.'home/index');
			}
		}

		public function modiCotizacion(){
			
			if (isset($_POST["btnModificar"])){

	            $this->modelo->__SET("Num_Documento", $_POST["id_cliente"]);
	            $this->modelo->__SET("Id_Estado", $_POST["estad"]);	
	            $this->modelo->__SET("Id_Solicitud", $_POST["codigo"]);
	            $this->modelo->__SET("Fecha_Vencimiento", $_POST["fechaVencimiento"]);
	            $this->modelo->__SET("Valor_Total", $_POST["valor_total"]);
	            
				if ($this->modelo->modiCotizacion()){

	            	$idSolTipo = $this->modelo->traerUltimoIdSTipo();
					$this->modelo->__SET("Id_tipoSolicitud", implode("", $idSolTipo));
	            	
					$this->modelo->deleteFichasAso();

					for ($i=0; $i < count($_POST["idProducto"]); $i++) { 

			            $this->modelo->__SET("Cantidad_existencias", 0);
			            $this->modelo->__SET("Estado_", "k");
			            $this->modelo->__SET("Cantidad_Producir", $_POST["cantProducir"][$i]);
			            $this->modelo->__SET("Subtotal", $_POST["subtotal"][$i]);
			            $this->modelo->__SET("Id_Ficha_Tecnica", $_POST["idProducto"][$i]);
			            $this->modelo->regFichasAso();
					}

					$_SESSION['alert'] = "Lobibox.notify('success', {delay: 6000, size: 'mini',
					msg: 'La cotización se modificó correctamente!'});";

				  header ("location: ".URL."ctrCotizacion/consCotizacion");
				}else {
					$_SESSION['alert'] = "sweetAlert('Erro Al Modificar Cotizacion','','error')";
				  header ("location: ".URL."ctrCotizacion/consCotizacion");
				}

			}
				$cotizaciones = $this->modelo->getCotizacion();
				
				require APP.'view/_templates/header.php';
				require APP.'view/cotizacion/consCotizacion.php';
				require APP.'view/_templates/footer.php';
		}

		public function converCotiAPe(){
			if (isset($_POST["gurdarPedi"])) {
				$this->modelo->__SET("Id_Solicitud",$_POST["codisoli"]);
				$this->modelo->__SET("Id_tipoSolicitud", 2);
				$this->modelo->__SET("Fecha_Entrega",$_POST["Fechaentre"]);
				$this->modelo->__SET("Id_Estado", 1);

				if ($this->modelo->converPedido()) {
					$ultimoPedido = $this->modelo->getIdPedido();
					for ($i=0; $i < count($_POST["idSolProducto"]); $i++) { 
						 $this->modelo->__SET("IdSolPro", $_POST["idSolProducto"][$i]);
						 $this->modelo->__SET("CantUsar", $_POST["cantExisUsarCot"][$i]);
						 $this->modelo->__SET("CantPro", $_POST["cantProdCot"][$i]);
						 $this->modelo->__SET("Id_tipoSolicitud", implode("", $ultimoPedido));

						if ($this->modelo->updateSolProdCot()) {
						 	$this->modelo->__SET("Id_Ficha_Tecnica", $_POST["idFichaCotPed"][$i]);
						 	$this->modelo->__SET("Cantidad_existencias", $_POST["exisProdTerCotPed"][$i]);

						 	if ($this->modelo->updateProductTerminado()) {
						 		$_SESSION['alert'] =  "Lobibox.notify('success', {size: 'mini', msg: 'Cotización Enviada A Pedido exitosamente!'});";
						 	}
						}
					}


                	header ("location: ".URL."ctrCotizacion/consCotizacion");
				}
			}
		}

		public function fichaAsociada(){
			$this->modelo->__SET("Id_Solicitud", $_POST["idCot"]);
			$fichaAsoc = $this->modelo->PedidoAsociado();
			echo json_encode($fichaAsoc);
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

		public function cotizacion($cod){
			$this->modelo->__SET("Id_Solicitud", $cod);
			$cotizacion = $this->modelo->generarCotizacion();

			if($cotizacion != false){
				require APP.'view/cotizacion/cotizacion.php';
			}else{
				require APP.'view/cotizacion/consCotizacion.php';	
			}
		}
	}