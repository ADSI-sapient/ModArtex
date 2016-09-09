<?php 

 class ctrObjetivos extends controller
 {
 	
 	function __construct()
 	{
 		$this->mdlModel= $this->loadModel("mdlObjetivos");
 	}


 	public function registrarObjetivo(){

 		  if (isset($_POST["btnRegObjetivo"])) {

 			$this->mdlModel->__SET("Nombre", $_POST["Nombre"]);
 			$this->mdlModel->__SET("FechaRegistro", $_POST["FechaRegistro"]);
 			$this->mdlModel->__SET("FechaInicio", $_POST["FechaInicio"]);
 			$this->mdlModel->__SET("FechaFin", $_POST["FechaFin"]);
 			$this->mdlModel->__SET("CantidadTotal", $_POST["CantidadTotal"]);
 			$this->mdlModel->RegistrarO();

 			$ultimoObjetivo = $this->mdlModel->ultimoObjetivo();
		    $this->mdlModel->__SET("Id_Objetivo", implode('', $ultimoObjetivo));

			for ($i=0; $i < count($_POST["Id_Ficha_Tecnica"]); $i++){

				$this->mdlModel->__SET("Id_Ficha_Tecnica", $_POST["Id_Ficha_Tecnica"][$i]);
				$this->mdlModel->__SET("Cantidad", $_POST["CantidadO"][$i]);
			
				$this->mdlModel->RegistrarObjetivos();
			}
 		}
 		
 		    $fichas = $this->mdlModel->getAsoFichas();
			include APP . 'view/_templates/header.php';
			include APP . 'view/productoT/regObjetivo.php';
			include APP . 'view/_templates/footer.php';
		}

		public function listarObjetivos(){

			$objetivos = $this->mdlModel->getObjetivos();
			include APP . 'view/_templates/header.php';
			include APP . 'view/productoT/consObjetivo.php';
			include APP . 'view/_templates/footer.php';
		}

		public function listarF(){

		$this->mdlModel->__SET("Id_Objetivo", $_POST["objetivo"]);
		$listasO = $this->mdlModel->ListarFichasO();
		echo json_encode($listasO);	
		}

 } ?>