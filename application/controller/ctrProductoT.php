<?php
	class ctrProductoT extends controller{
		function __construct(){}

		public function index(){
	
		}

		public function existenciasProductoT(){
			include APP . 'view/_templates/header.php';
			include APP . 'view/productoT/productoT.php';
			include APP . 'view/_templates/footer.php';
		}

		public function registrarObjetivo(){
			include APP . 'view/_templates/header.php';
			include APP . 'view/productoT/regObjetivo.php';
			include APP . 'view/_templates/footer.php';
		}

		public function listarObjetivos(){
			include APP . 'view/_templates/header.php';
			include APP . 'view/productoT/consObjetivo.php';
			include APP . 'view/_templates/footer.php';
		}
	}
?>