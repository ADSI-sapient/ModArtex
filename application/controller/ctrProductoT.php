<?php
	class ctrProductoT extends controller{

		function __construct(){
		$this->mdlModelU = $this->loadModel("mdlUsuario");
	    $this->mdlModel= $this->loadModel("mdlProductoT");
		}

		public function existenciasProductoT(){

			$productos = $this->mdlModel->getProducto();

			
			include APP . 'view/_templates/header.php';
			include APP . 'view/productoT/productoT.php';
			include APP . 'view/_templates/footer.php';
		}


		public function salida(){

					if ($_POST["Cantidad"] >= 1) {

					$this->mdlModel->__SET("Cantidad", $_POST["Cantidad"]);
					$this->mdlModel->__SET("Id_Ficha_Tecnica", $_POST["idf"]);
					$this->mdlModel->__SET("salida", $_POST["salida"]);

					if ($this->mdlModel->descontar()){

				
					 $this->mdlModel->__SET("descripcion", $_POST["descripcion"]);
					 if ($this->mdlModel->registrarS()) {
					 		
					 	$ultimaSalida = $this->mdlModel->ultimaSalida();

						$this->mdlModel->__SET("Id_Salida", implode('', $ultimaSalida));
						$this->mdlModel->__SET("Id_Ficha_Tecnica", $_POST['idf']);
						$this->mdlModel->RegistrarSP();

						}
					}	
				}
			$productos = $this->mdlModel->getProducto();

			include APP . 'view/_templates/header.php';
			include APP . 'view/productoT/productoT.php';
			include APP . 'view/_templates/footer.php';
		}


		public function VariasSalidas(){

			if ($_POST["Cantidad"] >= 1) {
					$this->mdlModel->__SET("Cantidad", implode('', $_POST["Cantidad"]));
					$this->mdlModel->__SET("Id_Ficha_Tecnica", implode('', $_POST["idf"]));
					$this->mdlModel->__SET("salida", implode('', $_POST["salida"]));

					if ($this->mdlModel->descontar()){

					 $this->mdlModel->__SET("descripcion", implode('', $_POST["descripcion"]));

					 if ($this->mdlModel->registrarS()) {
		
					 	$ultimaSalida = $this->mdlModel->ultimaSalida();

				for ($i=0; $i < count($_POST["idf"]); $i++) { 

				$this->mdlModel->__SET("Id_Salida", implode('', $ultimaSalida));
				$this->mdlModel->__SET("Id_Ficha_Tecnica", $_POST['idf'][$i]);
				$this->mdlModel->RegistrarSP();
						}
					}	
				}
			}
			$productos = $this->mdlModel->getProducto();




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