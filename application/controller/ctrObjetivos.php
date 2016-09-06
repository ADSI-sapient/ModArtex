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
 			// var_dump( $_POST["Fecha_Inicio"]);
 			// exit();
 			$this->mdlModel->RegistrarO();



 		}
 		

 		 $fichas = $this->mdlModel->getAsoFichas();
			include APP . 'view/_templates/header.php';
			include APP . 'view/productoT/regObjetivo.php';
			include APP . 'view/_templates/footer.php';
		}

		public function listarObjetivos(){
			include APP . 'view/_templates/header.php';
			include APP . 'view/productoT/consObjetivo.php';
			include APP . 'view/_templates/footer.php';
		}
 } ?>