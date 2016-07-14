<?php
	class ctrBodega extends Controller{
		private $_modelInsumo;
		private $_modelColor;
		private $_modelMedida;

		function __construct(){
			$this->_modelInsumo = $this->loadModel('mdlBodega');
			$this->_modelColor = $this->loadModel('mdlColores');
			$this->_modelMedida = $this->loadModel('mdlMedidas');
		}

		public function index(){
			include APP . 'view/_templates/header.php';
			include APP . 'view/bodega/consInsumo.php';
			include APP . 'view/_templates/footer.php';
		}

		public function registrarInsumo(){	

			if (isset($_POST["btnRegIns"])) {
				$this->_modelInsumo->__SET("_codMedida", $_POST["select"]);
				$this->_modelInsumo->__SET("_nombre", $_POST["nombre"]);
				$this->_modelInsumo->__SET("_estado", 1);
				$this->_modelInsumo->__SET("_stock", $_POST["stock"]);

					
				$id = $this->_modelInsumo->registrarInsumo()[0];
				$this->_modelInsumo->__SET("_idInsumo", $id);

				$this->_modelInsumo->crearExistencias();

				$col = explode(',', $_POST['arreglo'][0]);

				foreach ($col as $value2) {
					$this->_modelInsumo->__SET("_idColor", $value2);

					$this->_modelInsumo->regColorInsumo();
				}
			}

			$lista = $this->_modelColor->listar();
			$listaM = $this->_modelMedida->listar();

			include APP . 'view/_templates/header.php';
			include APP . 'view/bodega/regInsumo.php';
			include APP . 'view/_templates/footer.php';
		}

		public function listarInsumos(){
			$lisInsumos = $this->_modelInsumo->listarInsumos();

			$lista = $this->_modelColor->listar();
			$listaM = $this->_modelMedida->listar();

			include APP . 'view/_templates/header.php';
			include APP . 'view/bodega/consInsumo.php';
			include APP . 'view/_templates/footer.php';
		}

		public function cambiarEstado(){
			$this->_modelInsumo->__SET("_idInsumo", $_POST["id"]);
			$this->_modelInsumo->__SET("_estado", $_POST["estado"]);
			$this->_modelInsumo->cambiarEstado();

			echo json_encode(["v"=>1]);
		}

		public function lisColInsu(){
				if (isset($_POST["id"])) {
					$this->_modelInsumo->__SET("_idInsumo", $_POST["id"]);
					$lis = $this->_modelInsumo->listarColorInsumo();
					echo json_encode($lis);
			}
		}

		public function modificarInsumo(){
			$this->_modelInsumo->__SET("_idInsumo", $_POST["id"]);
			$this->_modelInsumo->__SET("_stock", $_POST["stock"]);
			$this->_modelInsumo->__SET("_codMedida", $_POST["select"]);
			$this->_modelInsumo->__SET("_nombre", $_POST["nombre"]);

			$this->_modelInsumo->modiInsumo();
			$this->_modelInsumo->deleteColor();

			$col = explode(',', $_POST['arreglo'][0]);
				
				foreach ($col as $value2) {
					$this->_modelInsumo->__SET("_idColor", $value2);
					$this->_modelInsumo->regColorInsumo();
				}

			$this->listarInsumos();
		}

		public function listExistencias(){
			include APP . 'view/_templates/header.php';
			include APP . 'view/bodega/existencias.php';
			include APP . 'view/_templates/footer.php';
		}
	}
