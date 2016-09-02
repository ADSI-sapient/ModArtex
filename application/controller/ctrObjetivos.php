<?php 

 class ctrObjetivos extends controller
 {
 	
 	function __construct()
 	{
 		$this->mdlModel= $this->loadModel("mdlObjetivos");
 	}


 	public function registrarObjetivo(){


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