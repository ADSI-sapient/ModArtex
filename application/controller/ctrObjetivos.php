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

 			if ($_POST["FechaInicio"] <= $_POST["FechaFin"] ) {
 				
	 			$this->mdlModel->RegistrarO();

	 			$ultimoObjetivo = $this->mdlModel->ultimoObjetivo();
			    $this->mdlModel->__SET("Id_Objetivo", implode('', $ultimoObjetivo));

				for ($i=0; $i < count($_POST["Id_Ficha_Tecnica"]); $i++){
					$this->mdlModel->__SET("Id_Ficha_Tecnica", $_POST["Id_Ficha_Tecnica"][$i]);
					$this->mdlModel->__SET("Cantidad", $_POST["CantidadO"][$i]);
					$this->mdlModel->RegistrarObjetivos();
			        $_SESSION['alert'] = "Lobibox.notify('success', {size: 'mini', msg: 'Objetivo registrado exitosamente!'});";	
	 			}
			}else{
					
			}
			
 		}
 		
 		    $fichas = $this->mdlModel->getAsoFichas();
			include APP . 'view/_templates/header.php';
			include APP . 'view/productoT/regObjetivo.php';
			include APP . 'view/_templates/footer.php';
		}

		public function listarObjetivos(){

			   if (isset($_POST["btnModificarObj"])) {
			   	$this->mdlModel->__SET("Id_Estado", $_POST["Id_Estado"]);


				   	if ($_POST ["Id_Estado"] == 5) {
				   		$this->mdlModel->__SET("Id_Objetivo", $_POST["Id_Objetivo"]);

				   		$this->mdlModel->EliminarRegistro();

				   		$this->mdlModel->__SET("Nombre", $_POST["Nombre"]);
 						$this->mdlModel->__SET("FechaRegistro", $_POST["FechaRegistro"]);
 						$this->mdlModel->__SET("FechaInicio", $_POST["FechaInicio"]);
 						$this->mdlModel->__SET("FechaFin", $_POST["FechaFin"]);
 						$this->mdlModel->__SET("CantidadTotal", $_POST["CantidadTotalN"]);
 						$this->mdlModel->modificarObjetivo();

 						
						$this->mdlModel->__SET("Id_Objetivo", $_POST["Id_Objetivo"]);

						for ($i=0; $i < count($_POST["Id_Ficha_Tecnica"]); $i++){
						$this->mdlModel->__SET("Id_Ficha_Tecnica", $_POST["Id_Ficha_Tecnica"][$i]);
						$this->mdlModel->__SET("Cantidad", $_POST["CantidadN"][$i]);
						$this->mdlModel->RegistrarObjetivos();
						}	
				   	}
				   	else{

				   	}
			   }

 			$fichas = $this->mdlModel->getAsoFichas();
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

		public function cancelarobjetivo(){
			// var_dump($_POST["Id_Objetivo"]); 
			// exit();
		$this->mdlModel->__SET("Id_Objetivo", $_POST["Id_Objetivo"]);
	    $this->mdlModel->__SET("Id_Estado", 8);	

		if ($this->mdlModel->cancelarObjetivo()) {
		    	echo json_encode(["r"=>1]);
		    }else{
		    	echo json_encode(["r"=>0]);
		    }
		}


		public function listar_GraficasOb(){
			$this->mdlModel->__SET("FechaInicio", $_POST["FechaInicio"]);
			$this->mdlModel->__SET("FechaFin", $_POST["FechaFin"]);

			$grafi = $this->mdlModel->GraficasFecha();
			// $grafis = $this->mdlModel->GraficasRefencias();

			$objetivo = [];
			$refObj = [];
			// $refPro = [];

			foreach ($grafi as $value) {
				$objetivo[] = $value["Nombre"]." ".$value["Referencia"];
				$refObj[] = $value["Cantidad"];
				// $refPro[] = $value[__SET("Referencia")];

				// mandar la referencia por set
				// luego llamar este metodo GraficasRefencias
				// $refPro en este array se mete lo que devuelve el metodo
			}
			echo json_encode(["objetivo"=>$objetivo, "refObj"=>$refObj]);

		}	
 }