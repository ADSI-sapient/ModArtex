<?php
	class ctrProduccion extends Controller{
		private $_modelProduct;

		function __construct(){
			$this->_modelProduct = $this->loadModel('mdlProduccion');
		}

		public function regOrden(){
			include APP . 'view/_templates/header.php';
			include APP . 'view/produccion/regOrden.php';
			include APP . 'view/_templates/footer.php';
		}

		public function listarOrdenes(){
			include APP . 'view/_templates/header.php';
			include APP . 'view/produccion/consOrden.php';
			include APP . 'view/_templates/footer.php';
		}


	}
