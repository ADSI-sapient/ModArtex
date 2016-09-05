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
	        	$this->_modelProduct->__SET("_estado_prod", $_POST["estadoProdu"]);
	        	$this->_modelProduct->__SET("_fecha_regist", $_POST["fecha_registro"]);
	        	$this->_modelProduct->__SET("_fecha_term", $_POST["fecha_terminacion"]);
	        	$this->_modelProduct->__SET("_lugar_prod", $_POST["lugar"]);

	            if ($this->_modelProduct->regOrdenProduccion()) {

	            	//retorna id ultima orden de produccion registrada
	            	$ultimaOrden = $this->_modelProduct->consUltimaOrdenReg();

	         	    for ($q=0; $q < count($_POST["id_fichaTec"]); $q++) { 
	            		
			        	//registrar en tbl_solicitudes_ordenesproduccion
		        		$this->_modelProduct->__SET("_id_solc_prod", $_POST["id_solic_prodcto"][$q]);
			        	$this->_modelProduct->__SET("_id_ordenProd", implode('', $ultimaOrden));
			        	$this->_modelProduct->regSolicitudOrdenProduccion();

		        		$this->_modelProduct->__SET("_cantFab", $_POST["cantProducirPed"][$q]);
		        		$this->_modelProduct->__SET("_cantSat", $_POST["cantSatelite"][$q]);
			        	$this->_modelProduct->actualizarCantProducir();
	            	}
			        
	        		$this->_modelProduct->__SET("_id_solicitud", $_POST["id_solTud"]);
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

			$ordenesProduccion = $this->_modelProduct->consOrdenesProd();
			$clientes = $this->_modelPedido->getClientes();

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

	}
