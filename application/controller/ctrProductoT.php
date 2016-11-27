<?php
	class ctrProductoT extends controller{

		
		function __construct(){
		$this->mdlModelU = $this->loadModel("mdlUsuario");
	    $this->mdlModel= $this->loadModel("mdlProductoT");
		}

		public function existenciasProductoT(){

			if($this->validarURL("ctrProductoT/existenciasProductoT")){

				$productos = $this->mdlModel->getProducto();

				include APP . 'view/_templates/header.php';
				include APP . 'view/productoT/productoT.php';
				include APP . 'view/_templates/footer.php';
			}else{
				header('location: '.URL.'home/index');
			}
		}

		public function salida(){

			$mensajeu= "";

			if (isset($_POST["btndescontarP"])) {

				$this->mdlModel->__SET("Cantidad", $_POST["cantActual"]);
				$this->mdlModel->__SET("salida", $_POST["cantidadSalida"]);
				$this->mdlModel->__SET("Id_Ficha_Tallas", $_POST["idft"]);

				if ($this->mdlModel->descontar()){

					$this->mdlModel->__SET("descripcion", $_POST["descripcionSalida"]);
					$this->mdlModel->__SET("Fecha_Salida", $_POST["FechaActual"]);

					if ($this->mdlModel->registrarS()) {
			 		
			 			$ultimaSalida = $this->mdlModel->ultimaSalida();

						$this->mdlModel->__SET("Id_Salida", implode('', $ultimaSalida));
						$this->mdlModel->__SET("Id_Ficha_Tallas", $_POST['idft']);
						$this->mdlModel->RegistrarSP();

						$_SESSION["mensaje"] = "Lobibox.notify('success', {delay: 6000, size: 'mini', msg: 'Salida registrada exitosamente!'});";
						header("location: ".URL."ctrProductoT/existenciasProductoT");
					}
				}else{
					$_SESSION["mensaje"] = "Lobibox.notify('error', {size: 'mini', delayIndicator: false, msg: 'Error al registrar la salida.'});";
				}
			}
		}

		public function VariasSalidas(){

			if (isset($_POST["regMuchasSalidas"])){

				for ($i=0; $i < count($_POST["idft"]); $i++){

					$this->mdlModel->__SET("Cantidad", $_POST["Cantidad"][$i]);
					$this->mdlModel->__SET("salida", $_POST["salida"][$i]);
					$this->mdlModel->__SET("Id_Ficha_Tallas", $_POST["idft"][$i]);

					$this->mdlModel->descontar();
					
					$this->mdlModel->__SET("descripcion", $_POST["descripcionSalidas"]);
					$this->mdlModel->__SET("Fecha_Salida",$_POST["FechaActualSalidas"]);

					if ($this->mdlModel->registrarS()) {

					 	$ultimaSalida = $this->mdlModel->ultimaSalida();

						$this->mdlModel->__SET("Id_Salida", implode('', $ultimaSalida));
						$this->mdlModel->__SET("Id_Ficha_Tallas", $_POST['idft'][$i]);
						$this->mdlModel->__SET("salida", $_POST["salida"][$i]);
						$this->mdlModel->RegistrarSP();

					}
				}
				$_SESSION["mensaje"] = "Lobibox.notify('success', {delay: 6000, size: 'mini', msg: 'Salida registrada exitosamente!'});";
				header("location: ".URL."ctrProductoT/existenciasProductoT");
			}
		}

		public function reporteExistenciasProdT(){
			$_SESSION["arrayExistenciasPT"] = $_POST["arrayExistPT"];
			if($_SESSION["arrayExistenciasPT"]){
				echo json_encode(["r" => 1]);
			}else{
				echo json_encode(["r" => 0]);
			}
		}

		public function reporteProductoTerminado(){
			$existenciasProductoT = $_SESSION["arrayExistenciasPT"];
			require APP.'view/productoT/reporteExistenciasProductoT.php';
		}
	}
?>