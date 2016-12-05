<?php  

	class ctrPedido extends Controller
	{
		private $mdlModel = null;

		function __construct()
		{
	        $this->mdlModel = $this->loadModel("mdlPedido");
	        $this->mdlModelF = $this->loadModel("mdlFicha");
		}

		//método que permite listar todos los pedidos registrados.
		public function consPedido()
		{
			if($this->validarURL("ctrPedido/consPedido")){
				$pedidos = $this->mdlModel->getPedidos();
				$clientes = $this->mdlModel->getClientes();
				$productosHab = $this->mdlModel->getFichasHabilitadas();
				
		        require APP . 'view/_templates/header.php';
		        require APP . 'view/pedido/consPedido.php';
	        	require APP . 'view/_templates/footer.php';
	        }else{
	        	header('location: '.URL.'home/index');
	        }	
		}

		//método que permite registrar una solicitud de tipo pedido
		public function regPedido()
	    {
	    	if($this->validarURL("ctrPedido/regPedido")){
	        if (isset($_POST["btnRegPedido"])) {

	        	//registro de nueva solicitud
	        	$this->mdlModel->__SET("id_cliente", $_POST["id_cliente"]);
	        	$this->mdlModel->__SET("fecha_registro", $_POST["fecha_reg"]);
	        	$this->mdlModel->__SET("vlr_total", $_POST["vlr_total"]);

	            if ($this->mdlModel->regPedido()) {

	            	//retorna ultima solicitud tipo pedido registrada
	            	$ultimoPedido = $this->mdlModel->ultimoPedido()["id_solicitud"];

		        	//registro del tipo de solicitud en este caso de tipo 2 (Pedido)
		        	$this->mdlModel->__SET("id_pedido", $ultimoPedido);
		        	$this->mdlModel->__SET("id_tipoSolicitud", 2);
		        	$this->mdlModel->__SET("fecha_entrega", date("Y-m-d", strtotime($_POST["fecha_entrega"])));
		        	$this->mdlModel->__SET("id_estado", 5);
		        	$this->mdlModel->regTipoSolicitud();

		        	//Registro de fichas asociadas al pedido
	            	$ultimoIdTipoSolicitud = $this->mdlModel->ultimoIdTipoSolicitud()["ult_id_soltipo"];
		        	for ($f=0; $f < count($_POST['idFichaTalla']); $f++) { 
		        		
		        		$this->mdlModel->__SET("id_solicitudes_tipo", $ultimoIdTipoSolicitud);
		        		$this->mdlModel->__SET("cant_existencias", $_POST['cantExisUsar'][$f]);
		        		$this->mdlModel->__SET("estado", "j");
		        		$this->mdlModel->__SET("cant_producir", $_POST['cantProducir'][$f]);
						$this->mdlModel->__SET("subtotal", $_POST['subTotal'][$f]);
		        		$this->mdlModel->__SET("id_ficha_talla", $_POST['idFichaTalla'][$f]);
		        		$this->mdlModel->__SET("cantidadPT", $_POST['cantProductT'][$f]);
		        		$this->mdlModel->regFichasAsociadas(); 
		        	}


		        	//Si se registra el pedido y los productos asociados, se realiza un descuento de existencias de insumos.
		        	$idsPed = 0;
					$cantPed = 0;
	    			$arrInsPed = implode(",", $_POST["arrInsums"]);
					$arrayInsumosPed = explode(',', $arrInsPed);

					for ($i=0; $i < count($arrayInsumosPed); $i = $i + 2) { 
						$idsPed .=",".$arrayInsumosPed[$i];
					}
					for ($i=1; $i < count($arrayInsumosPed); $i = $i + 2) { 
						$cantPed .=",".$arrayInsumosPed[$i];
					}

					$idesPed = explode(',', $idsPed);
					$cantidadesPed = explode(',', $cantPed);

					for ($i=1; $i < count($idesPed); $i++) { 
						$this->mdlModel->__SET("idExisInsPed", $idesPed[$i]);
						$this->mdlModel->__SET("canDescInsPed", $cantidadesPed[$i]);
						$this->mdlModel->descontarExistenciasInsPed();
					}

	            	$_SESSION["mensaje"] = "Lobibox.notify('success', {size: 'mini', delay: 6000, msg: 'Pedido registrado exitosamente'});";
				}else{

					$_SESSION['mensaje'] = "Lobibox.notify('error', {msg: 'Error al registrar el pedido', size: 'mini', rounded: true, delay: 6000});";
				}
	        }

	        $fichas = $this->mdlModel->getFichasHabilitadas();
	        $clientes = $this->mdlModel->getClientes();

	        require APP . 'view/_templates/header.php';
        	require APP . 'view/pedido/regPedido.php';
        	require APP . 'view/_templates/footer.php';
        	}else{
        		header('location: '.URL.'home/index');
        	}
	    }

	    public function editarPedido(){

	    	if (isset($_POST["btnModificarPed"])) {
	    		$this->mdlModel->__SET("id_cliente", $_POST["doc_cliente"]);
	    		$this->mdlModel->__SET("id_pedido", $_POST["id_pedido"]);
	    		$this->mdlModel->__SET("fecha_entrega", date("Y-m-d", strtotime($_POST["fecha_entrega"])));
	    		$this->mdlModel->__SET("vlr_total", $_POST["valor_total"]);
	    		
	    		if ($this->mdlModel->editPedidos()) {

	    			$IdSolitudesTipo = $this->mdlModel->traerIdSolTipo();
		        	$this->mdlModel->__SET("id_solicitudes_tipo", implode('', $IdSolitudesTipo));
	    			
	    			//elimina productos(fichas) asociadas al pedido
	    			$this->mdlModel->eliminarAsoFichasPedido();

	    			//se editan las asociaciones de productos que tiene el pedido
	    			for ($f=0; $f < count($_POST["idFichaTalla"]); $f++) { 
	    				$idFicha = $_POST["idFicha"][$f];

		        		$this->mdlModel->__SET("id_ficha_talla", $_POST['idFichaTalla'][$f]);

		        			$idsPed = 0;
							$cantPed = 0;
	    					$arrInsPed = implode(",", $_POST["arrayInsumosPedMod"]);
							$arrayInsumosPed = explode(',', $arrInsPed);
		
							for ($i=0; $i < count($arrayInsumosPed); $i = $i + 2) { 
								$idsPed .=",".$arrayInsumosPed[$i];
							}
							for ($i=1; $i < count($arrayInsumosPed); $i = $i + 2) { 
								$cantPed .=",".$arrayInsumosPed[$i];
							}
		
							$idesPed = explode(',', $idsPed);
							$cantidadesPed = explode(',', $cantPed);

	    				if ($_POST["cantDescInsUpdPed"][$f] > 0) {

							for ($i=1; $i < count($idesPed); $i++) { 
								$this->mdlModel->__SET("idExisInsPed", $idesPed[$i]);
								$this->mdlModel->__SET("canDescInsPed", $cantidadesPed[$i]);
								$this->mdlModel->descontarExistenciasInsPed();
							}
	    				}



	    				if ($_POST["cantDevolverInsUpdPed"][$f] > 0) {

	    					$this->mdlModel->__SET("id_ficha", $idFicha);
	    					$insNecesarios = $this->mdlModel->validarExisteIns();

			        			for ($i=0; $i < count($insNecesarios); $i++) { 
			        				$canNecesario = $insNecesarios[$i]["Cant_Necesaria"];
			        				$cantDevolverIns = $canNecesario * $_POST["cantDevolverInsUpdPed"][$f];
				        			$this->mdlModel->__SET("cant_devolver", $cantDevolverIns);
				        			$this->mdlModel->__SET("id_existcolinsu", $insNecesarios[$i]["Id_Existencias_InsCol"]);
				        			$this->mdlModel->devolverExistInsumos();
			        			}
	    				}
	    				
	    				//registrar en tabla detalle tbl_solicitudes_producto
	    				$this->mdlModel->__SET("cant_existencias", $_POST['cantUsarProTerUpdPed'][$f]);
		        		$this->mdlModel->__SET("estado", "");
						$this->mdlModel->__SET("cant_producir", $_POST["cantProducir"][$f]);
	    				$this->mdlModel->__SET("subtotal", $_POST["subTotal"][$f]);

	    				$this->mdlModel->__SET("cantidadPT", $_POST["intSpanUpdaProdPed"][$f]);
		        		$this->mdlModel->regFichasAsociadas();
		        	}
	    			$_SESSION["mensaje"] = "Lobibox.notify('success', {size: 'mini', delay: 6000, msg: 'Pedido modificado exitosamente!'});";
		    		header("location: " .URL. 'ctrPedido/consPedido');
	    		}else{
	    			$_SESSION["mensaje"] = "Lobibox.notify('error', {msg: 'Error al modificar el pedido', rounded: true, delay: 6000});";
		      		header("location: " .URL. 'ctrPedido/consPedido');
	    		}	
	    	}
	    	$pedidos = $this->mdlModel->getPedidos();
	        require APP . 'view/_templates/header.php';
	        require APP . 'view/pedido/consPedido.php';
	        require APP . 'view/_templates/footer.php';
	    }
	    
	    //carga los productos asociados al pedido
	    public function cargarProAsoPedido(){

	    	$this->mdlModel->__SET("id_pedido", $_POST["idPed"]);
	    	$productosAsoPed = $this->mdlModel->cargarProductosAsoPed();
	    	if ($productosAsoPed) {
		    	echo json_encode(["r"=>$productosAsoPed]);
		    }else{
		    	echo json_encode(["r"=>null]);
		    }
	    }

	    public function cancelarPedido(){

	    	$this->mdlModel->__SET("id_estado", 8);
	    	$this->mdlModel->__SET("id_pedido", $_POST["id_Pedido"]);

	    	if ($this->mdlModel->cancelPedido()) {
		    	echo json_encode(["r"=>1]);
		    }else{
		    	echo json_encode(["r"=>0]);
		    }
	    }

	    public function validaExistInsumos(){

	    	$this->mdlModel->__SET("id_ficha", $_POST['id_fichat']);
	    	$cantidInsumos = $this->mdlModel->validarExisteIns();

	    	if ($cantidInsumos) {
	    		echo json_encode(["r"=>$cantidInsumos]);
	    	}else{
	    		echo json_encode(["r"=>null]);
	    	}
	    }
	}
?>