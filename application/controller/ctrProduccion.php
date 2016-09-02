<?php
	class ctrProduccion extends Controller{
		private $_modelProduct;

		function __construct(){
			$this->_modelProduct = $this->loadModel('mdlProduccion');
		}

		public function regOrden(){

			if (isset($_POST["btnRegistrarProdu"])) {

	        	//registro nueva orden de produccion
	        	$this->_modelProduct->__SET("estado_prod", $_POST["estadoProdu"]);
	        	$this->_modelProduct->__SET("fecha_regist", $_POST["fecha_registro"]);
	        	$this->_modelProduct->__SET("fecha_term", $_POST["fecha_terminacion"]);

	            if ($this->_modelProduct->regOrdenProduccion()) {

	            	//retorna id ultima orden de produccion registrada
	            	$ultimaOrden = $this->_modelProduct->ultimaOrdenProdu()["id_orden"];

		        	//registrar en tbl_solicitudes_ordenesproduccion
	        		$this->_modelProduct->__SET("id_solc_prod", $_POST["id_solic_productos"]);
		        	$this->_modelProduct->__SET("id_ordenProd", $ultimaOrden);
	        		$this->_modelProduct->__SET("estado", $_POST["estado"]);
	        		$this->_modelProduct->__SET("lugar_prod", $_POST["lugar"]);
		        	$this->_modelProduct->regSolicitudOrdenProduccion();

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
			include APP . 'view/_templates/header.php';
			include APP . 'view/produccion/consOrden.php';
			include APP . 'view/_templates/footer.php';
		}

		public function productosPedido()
		{
	        $this->_modelProduct->__SET("id_solicitud", $_POST["id_solit"]);
	        $productosPed = $this->_modelProduct->consProductosPedido();

		}
	}
