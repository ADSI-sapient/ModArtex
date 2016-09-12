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
			$mensajeu= "";
					if ($_POST["Cantidad"] >= 1) {

						if ($_POST["salida"] <= $_POST["Cantidad"]) {

					$this->mdlModel->__SET("Cantidad", $_POST["Cantidad"]);
					$this->mdlModel->__SET("Id_Ficha_Tecnica", $_POST["idf"]);
					$this->mdlModel->__SET("salida", $_POST["salida"]);

					if ($this->mdlModel->descontar()){

				
					 $this->mdlModel->__SET("descripcion", $_POST["descripcion"]);
					 $this->mdlModel->__SET("Fecha_Salida", $_POST["FechaActual"]);
					 if ($this->mdlModel->registrarS()) {
					 		
					 	$ultimaSalida = $this->mdlModel->ultimaSalida();

						$this->mdlModel->__SET("Id_Salida", implode('', $ultimaSalida));
						$this->mdlModel->__SET("Id_Ficha_Tecnica", $_POST['idf']);
						$this->mdlModel->RegistrarSP();

						$mensajeu = "Lobibox.notify('succes', {size: 'mini', rounded: true, delayIndicator: false, msg: 'Salida registrada exitosamente'});";

						}
					}	
						}else {
					$mensajeu = "Lobibox.notify('error', {size: 'mini', rounded: true, delayIndicator: false, msg: 'La cantidad que desea registrar es mayor a la cantidad existente'});";
					}	
				}else{
					$mensajeu = "Lobibox.notify('error', {size: 'mini', rounded: true, delayIndicator: false, msg: 'No hay productos para registrar'});";
				}

				$_SESSION["mensaje"] = $mensajeu;
			$productos = $this->mdlModel->getProducto();

			include APP . 'view/_templates/header.php';
			include APP . 'view/productoT/productoT.php';
			include APP . 'view/_templates/footer.php';
		}


		public function VariasSalidas(){

			if ($_POST["Cantidad"] >= 1) {

				if ($_POST["salida"] <= $_POST["Cantidad"]){

					for ($i=0; $i < count($_POST["idf"]); $i++){

					$this->mdlModel->__SET("Cantidad", $_POST["Cantidad"][$i]);
					$this->mdlModel->__SET("Id_Ficha_Tecnica", $_POST["idf"][$i]);
					$this->mdlModel->__SET("salida", $_POST["salida"][$i]);
					$this->mdlModel->descontar();
					
	
					 $this->mdlModel->__SET("descripcion", $_POST["descripcion"]);
					 $this->mdlModel->__SET("Fecha_Salida",$_POST["FechaActual"]);
					 if ($this->mdlModel->registrarS()) {
					 		
					 	$ultimaSalida = $this->mdlModel->ultimaSalida();

					for ($i=0; $i < count($_POST["idf"]); $i++) { 

						$this->mdlModel->__SET("Id_Salida", implode('', $ultimaSalida));
						$this->mdlModel->__SET("Id_Ficha_Tecnica", $_POST['idf'][$i]);
						$this->mdlModel->__SET("Cantidad", $_POST["salida"][$i]);
						$this->mdlModel->RegistrarSP();

						$mensajeu = "Lobibox.notify('succes', {size: 'mini', rounded: true, delayIndicator: false, msg: 'Salida registrada exitosamente'});";
						}
					}
						
				}
			}else{
				$mensajeu = "Lobibox.notify('error', {size: 'mini', rounded: true, delayIndicator: false, msg: 'La cantidad que desea registrar es mayor a la cantidad existente'});";
			}
			}else{
				$mensajeu = "Lobibox.notify('error', {size: 'mini', rounded: true, delayIndicator: false, msg: 'No hay productos para registrar'});";
			}

			$_SESSION["mensaje"] = $mensajeu;
			$productos = $this->mdlModel->getProducto();

			include APP . 'view/_templates/header.php';
			include APP . 'view/productoT/productoT.php';
			include APP . 'view/_templates/footer.php';
		}


		
	}
?>