<?php
	class ctrProduccion extends Controller{
		private $_modelProduct;

		function __construct(){
			$this->_modelProduct = $this->loadModel('mdlProduccion');
			$this->_modelPedido = $this->loadModel('mdlPedido');
		}

		public function regOrden(){

			if (isset($_POST["btnRegistrarProdu"])) {

	        	//registro nueva orden de produccion
	        	$this->_modelProduct->__SET("_estado_prod", 5);
	        	$this->_modelProduct->__SET("_fecha_regist", $_POST["fecha_registro"]);
		        $this->_modelProduct->__SET("_lugar_prod", $_POST["lugarPrd"]);

	            if ($this->_modelProduct->regOrdenProduccion()) {

	            	//retorna id ultima orden de produccion registrada
	            	$ultimaOrden = $this->_modelProduct->consUltimaOrdenReg();
	        	
	         	    for ($q=0; $q < count($_POST["id_fichaTec"]); $q++) { 
	            		
			        	//registrar en tbl_solicitudes_ordenesproduccion
		        		$this->_modelProduct->__SET("_id_solc_prod", $_POST["id_solic_prodcto"][$q]);
			        	$this->_modelProduct->__SET("_id_ordenProd", implode('', $ultimaOrden));
		        		$this->_modelProduct->__SET("_estadoFih", 5);
		        		$this->_modelProduct->__SET("_cantFab", $_POST["cantProducirPed"][$q]);
		        		$this->_modelProduct->__SET("_cantSat", $_POST["cantSatelite"][$q]);
		        		$this->_modelProduct->__SET("_lugarPrficha", $_POST["lugarP"][$q]);
			      
			        	$this->_modelProduct->regSolicitudOrdenProduccion();

	            	}
			        
		        	$this->_modelProduct->__SET("_id_solicitud", $_POST["id_solTud"]);
		        	$this->_modelProduct->__SET("_fecha_term", $_POST["fecha_terminacion"]);
				    $this->_modelProduct->actualizarFechaEntregaPd();
			        $this->_modelProduct->actualizarEstadoPed();

		        	//alerta confirmación registro
	            	$_SESSION["mensaje"] = 'swal("Orden Registrada Exitosamente!", "", "success");';
				}else{

					$_SESSION['mensaje'] = "Lobibox.notify('error', {msg: 'Error al registrar la orden', size: 'mini', rounded: true, delay: 2500,});";
				}
	        }

			$pedidosProdu = $this->_modelProduct->consPedidosProd();

			include APP . 'view/_templates/header.php';
			include APP . 'view/produccion/regOrden.php';
			include APP . 'view/_templates/footer.php';
		}

		public function consOrden(){

			$pedidosProdu = $this->_modelProduct->consPedidosProd();
			$ordenesProduccion = $this->_modelProduct->consOrdenesProd();
			$pedidosCliente = $this->_modelProduct->getPedidosCliente();

			include APP . 'view/_templates/header.php';
			include APP . 'view/produccion/consOrden.php';
			include APP . 'view/_templates/footer.php';
		}


		public function editarOrdenProduccion(){

	    	if (isset($_POST["btnModificarOrd"])) {
	    		
	    		$this->_modelProduct->__SET("_estado_prod", $_POST["estadoOp"]);
	        	$this->_modelProduct->__SET("_fecha_term", $_POST["fecha_entregaOp"]);
		        $this->_modelProduct->__SET("_lugar_prod", $_POST["lugarOp"]);
			    $this->_modelProduct->__SET("_id_ordenProd", $_POST["numOrdenp"]);

	    		if ($this->_modelProduct->editOrdenes()) {

	    			$this->_modelProduct->elimnarSolicitudesOrdenes();

	    			for ($q=0; $q < count($_POST["id_fichaTec"]); $q++) { 
	            		
				    	//registrar en tbl_solicitudes_ordenesproduccion
			      		$this->_modelProduct->__SET("_id_solc_prod", $_POST["idSolcProd"][$q]);
				    	$this->_modelProduct->__SET("_id_ordenProd", $_POST["numOrdenp"]);
			        	$this->_modelProduct->__SET("_estadoFih", $_POST["estadoF"][$q]);
			        	$this->_modelProduct->__SET("_cantFab", $_POST["cantFab"][$q]);
			        	$this->_modelProduct->__SET("_cantSat", $_POST["cantSat"][$q]);
			        	$this->_modelProduct->__SET("_lugarPrficha", $_POST["lugarP"][$q]);
				        $this->_modelProduct->regSolicitudOrdenProduccion();
	            	}

	    			$_SESSION["mensaje"] = 'swal("Orden Modificada Exitosamente!", "", "success");';
		    		header("location: " .URL. 'ctrProduccion/consOrden');
	    		}else{
	    			$_SESSION["mensaje"] = "Lobibox.notify('error', {msg: 'Error al modificar la orden', rounded: true, delay: 2500});";
		      		header("location: " .URL. 'ctrProduccion/consOrden');
	    		}	
	    	}
			$ordenesProduccion = $this->_modelProduct->consOrdenesProd();

	    	include APP . 'view/_templates/header.php';
			include APP . 'view/produccion/consOrden.php';
			include APP . 'view/_templates/footer.php';
	    }

		public function consFichasOrdenP()
		{
	        $this->_modelProduct->__SET("_id_ordenProd", $_POST["idOrden"]);
	        $productosAsoOrden = $this->_modelProduct->consProductosOrden();

	        if ($productosAsoOrden) {
	        	echo json_encode(["v"=>$productosAsoOrden]);
	        }
	        else
	        {
	        	echo json_encode(["v"=>null]);
	        }
		}
		
	    public function cancelarOrdenProd(){

	    	$this->_modelProduct->__SET("_id_ordenProd", $_POST["id_orden"]);

	    	if ($this->_modelProduct->cancelOrden()) {
		    	echo json_encode(["r"=>1]);
		    }else{
		    	echo json_encode(["r"=>0]);
		    }
	    }

	    public function consPedidoCliente()
	    {
	    	$this->_modelProduct->__SET("_id_solicitud", $_POST["id_solc"]);
	    	$solicCliente = $this->_modelProduct->consPedidosCliente();

	    	if ($solicCliente) {
		    	echo json_encode(["r"=>$solicCliente]);
		    }else{
		    	echo json_encode(["r"=>null]);
		    }
	    }

	}
