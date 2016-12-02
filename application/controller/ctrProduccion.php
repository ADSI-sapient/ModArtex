<?php
	class ctrProduccion extends Controller{
		private $_modelProduct;

		function __construct(){
			$this->_modelProduct = $this->loadModel('mdlProduccion');
			$this->_modelPedido = $this->loadModel('mdlPedido');
		}

		public function registrarOrdenProduc(){
				$this->_modelProduct->__SET("_estado_prod", 5);
	        	$this->_modelProduct->__SET("_fecha_regist", $_POST["fecha_registro"]);
		        $this->_modelProduct->__SET("_lugar_prod", $_POST["lugarPrd"]);

		        $this->_modelProduct->__SET("_id_solicitud", $_POST["id_solTud"]);
		        $this->_modelProduct->__SET("_fecha_term", $_POST["fecha_terminacion"]);
				// $this->_modelProduct->actualizarFechaEntregaPd();
			     $this->_modelProduct->actualizarEstadoPed();

		        $this->_modelProduct->regOrdenProduccion();
		        $ultimaOrden = $this->_modelProduct->consUltimaOrdenReg();
		        echo json_encode($ultimaOrden);
		}

		public function registraOrdenSolicitud(){
				$this->_modelProduct->__SET("_id_solc_prod", $_POST["id_solic_prodcto"]);
			    $this->_modelProduct->__SET("_id_ordenProd", $_POST["idOrden"]);
		        $this->_modelProduct->__SET("_estadoFih", 5);
		        $this->_modelProduct->__SET("_cantFab", $_POST["cantProducirPed"]);
		        $this->_modelProduct->__SET("_cantSat", $_POST["cantSatelite"]);
		        // $this->_modelProduct->__SET("_lugarPrficha", $_POST["lugarP"]);

		        $_SESSION["mensaje"] = "Lobibox.notify('success', {delay: 6000, size: 'mini', msg: 'La orden se registró correctamente!'});";
			    
			    echo json_encode($this->_modelProduct->regSolicitudOrdenProduccion());
		}

		public function regOrden(){
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
	    	// $this->_modelProduct->__SET("_estado_prod", $_POST["estadoOp"]);
	        // $this->_modelProduct->__SET("_fecha_term", $_POST["fecha_entregaOp"]);


			$idSolPedNuevo = $_POST["idSolPed"];
			if ($idSolPedNuevo != null) {
				$this->_modelProduct->__SET("_id_solicitud", $_POST["idSolAnt"]);
				$this->_modelProduct->regresarAPediente();
			}


			$this->_modelProduct->__SET("_id_ordenProd", $_POST["numOrdenp"]);
		    $this->_modelProduct->__SET("_lugar_prod", $_POST["lugarOp"]);

	    	$this->_modelProduct->elimnarSolicitudesOrdenes();
	    	echo json_encode($this->_modelProduct->editOrdenes());
	    }

	    function registrarSolicitudesOrdenes(){
	    	//registrar en tbl_solicitudes_ordenesproduccion
	    	$this->_modelProduct->__SET("_id_solicitud", $_POST["idPed"]);

			$this->_modelProduct->__SET("_id_solc_prod", $_POST["idSolcProd"]);
			$this->_modelProduct->__SET("_id_ordenProd", $_POST["numOrdenp"]);
			$this->_modelProduct->__SET("_estadoFih", 5);
			$this->_modelProduct->__SET("_cantFab", $_POST["cantFab"]);
			$this->_modelProduct->__SET("_cantSat", $_POST["cantSat"]);
			// $this->_modelProduct->__SET("_lugarPrficha", $_POST["lugarP"]);

			$men = $this->_modelProduct->regSolicitudOrdenProduccion();
			if ($men) {
				$_SESSION["mensaje"] = "Lobibox.notify('success', {delay: 6000, size: 'mini',
					msg: 'La orden se modificó correctamente!'});";	
			}
			$this->_modelProduct->actualizarEstadoPed();
			echo json_encode($men);
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

	    	$this->_modelPedido->__SET("id_estado", 8);
	    	$this->_modelPedido->__SET("id_pedido", $_POST["idSol"]);

	    	if ($this->_modelProduct->cancelOrden() && $this->_modelPedido->cancelPedido()) {
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

	    public function cambiarEstadoOrden(){
	    	$this->_modelProduct->__SET("_id_ordenProd", $_POST["id_orden"]);
	    	$this->_modelProduct->__SET("_estado", $_POST["id_est"]);
	    	echo json_encode($this->_modelProduct->cambiarEstadoOrden());
	    }

	  	public function cambiarEstadoOrdenSol(){
	    	$this->_modelProduct->__SET("_id_ord_solPro", $_POST["id_ordenSoli"]);
	    	$this->_modelProduct->__SET("_estado", $_POST["id_est"]);
	    	echo json_encode($this->_modelProduct->cambiarEstadoOrdenSol());
	    }

	    public function cambiarEstadoSolProd(){
	    	$this->_modelProduct->__SET("_id_solc_prod", $_POST["idSolProd"]);
	    	$this->_modelProduct->__SET("_estado", $_POST["idEstado"]);
	    	echo json_encode($this->_modelProduct->cambiarEstadoSolProd());
	    }

	    public function devolverInsumos(){
	    	$this->_modelPedido->__SET("id_existcolinsu", $_POST["idExisInsCol"]);
	    	$this->_modelPedido->__SET("cant_devolver", $_POST["cantAumentarIns"]);

	    	echo json_encode($this->_modelPedido->devolverExistInsumos());
	    }

	    public function aumentarProdTerm(){
	    	$this->_modelProduct->__SET("_id_ficha_talla", $_POST["idFichaTalla"]);
	    	$this->_modelProduct->__SET("_cantAumentar", $_POST["cantDevolver"]);

	    	echo json_encode($this->_modelProduct->aumentarProductoT());
	    }
	}
