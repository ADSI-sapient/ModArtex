<?php 
	class ctrFicha extends Controller
	{
		private $mdlModel = null;

		//Constructor
	    function __construct(){
	        $this->mdlModel = $this->loadModel("mdlFicha");
	    }

	    public function consFicha(){
	    	$mensaje = "";
	    	$msjEditFicha = "";

	        $insumos = $this->mdlModel->getAsoInsumos();
	        $insumosHabAsociar = $this->mdlModel->consInsumosRegFicha();
	        $tallas = $this->mdlModel->getAsoTallas();
	    	$fichas = $this->mdlModel->getFichas();

	    	require APP . 'view/_templates/header.php';
	        require APP . 'view/ficha/consFicha.php';
	        require APP . 'view/_templates/footer.php';
	    }

	   	public function regFicha(){
	        $mensaje = "";
	    	$msjEditFicha = "";
	    	$msjFichaExiste = "";
	        if (isset($_POST["btnRegFicha"])) {

	        	$this->mdlModel->__SET("referencia", $_POST["referencia"]);
	        	// $validarRef = $this->mdlModel->validarReferencia();
	        	// if ($validarRef == null) {

	        		$this->mdlModel->__SET("fecha_reg", $_POST["fecha_reg"]);
			    	$this->mdlModel->__SET("color", 2);
			 		$this->mdlModel->__SET("estado", 1);
			    	$this->mdlModel->__SET("valor_produccion", $_POST["vlr_produccion"]);
			    	$this->mdlModel->__SET("cantidad", 0);
					$this->mdlModel->__SET("stock_min", $_POST["stock_min"]);
					$this->mdlModel->__SET("valor_producto", $_POST["vlr_producto"]);

					if($this->mdlModel->regFicha()){
						//Registro en tabla producto
						//$this->mdlModel->regProducto();
						$ultima = $this->mdlModel->ultimaFicha()["id_ficha"];

					 	//Registro de insumos asociados a la ficha va a tbl insumos_fichas
						for ($i=0; $i < count($_POST['idInsumo']); $i++) { 
						        		
						  	$this->mdlModel->__SET("id_insumo", $_POST['idInsumo'][$i]);
						  	$this->mdlModel->__SET("cant_necesaria", $_POST['cantNecesaria'][$i]);
						  	$this->mdlModel->__SET("valor_insumo", $_POST['valorInsumo'][$i]);
							$this->mdlModel->__SET("id_fichaT", $ultima);
						  	$this->mdlModel->regInsumosAso();
						}

						//Registro de tallas asociadas
						for ($t=0; $t < count($_POST['tallas']); $t++) {
							
						  	$this->mdlModel->__SET("id_fichaT", $ultima);
						  	$this->mdlModel->__SET("id_talla", $_POST['tallas'][$t]);
						  	$retornoTallas = $this->mdlModel->regTallasAso();
						}

						// $mensaje = "Lobibox.notify('success', {msg: 'Ficha Registrada Exitosamente!', rounded: true, delay: 3000});";

					}else{

						// $mensaje = "Lobibox.notify('error', {msg: 'Error al registrar la ficha', rounded: true, delay: 2500});";
					}
	        		
	        	// }else{

	        	// 	// $msjFichaExiste = "Lobibox.notify('error', {msg: 'La ficha ya existe', rounded: true, delay: 3000,});";
	        	// 	// $msjFichaExiste = "Lobibox.alert('error', {msg: 'La ficha que intenta registrar ya existe'});";
	        	// }
	      	}
	       
	        $insumosHabAsociar = $this->mdlModel->consInsumosRegFicha();
	        // $insumos = $this->mdlModel->consInsumosRegFicha();
	        
	        require APP . 'view/_templates/header.php';
        	require APP . 'view/ficha/regFicha.php';
        	require APP . 'view/_templates/footer.php';
	    }

	    public function editFicha(){

	    	$mensaje = "";
		    $msjEditFicha = "";

		    if(isset($_POST["btn-modificar-ficha"])){

		      	$this->mdlModel->__SET("id_fichaT", $_POST["idFicha_Tec"]);
	            $this->mdlModel->__SET("color", 1);
	            $this->mdlModel->__SET("valor_produccion", $_POST["vlr_produccion"]);
	            $this->mdlModel->__SET("cantidad", 456);
		      	$this->mdlModel->__SET("stock_min", $_POST["stock_min"]);
	            $this->mdlModel->__SET("valor_producto", $_POST["vlr_producto"]);

		      if($this->mdlModel->modificarFicha()){
	            //$this->mdlModel->modificarProducto();

	            //Elimina todos los insumos asociados a la ficha
		      	$this->mdlModel->eliminarInsumoAsoFicha();
		      	
				//Registro de insumos asociados
				for ($i=0; $i < count($_POST['idInsumo']); $i++) { 
						        		
					$this->mdlModel->__SET("id_insumo", $_POST['idInsumo'][$i]);
					$this->mdlModel->__SET("cant_necesaria", $_POST['cantNecesaria'][$i]);
					$this->mdlModel->__SET("valor_insumo", $_POST['valorInsumo'][$i]);
					$this->mdlModel->__SET("id_fichaT", $_POST["idFicha_Tec"]);
					$this->mdlModel->regInsumosAso();
				}

				//Elimina todas las tallas asociadas a la ficha
				$this->mdlModel->eliminarTallaAsoFicha();
				//Registra nuevas tallas
				for ($t=0; $t < count($_POST['tallas']); $t++) { 

					$this->mdlModel->__SET("id_talla", $_POST['tallas'][$t]);
				 	$this->mdlModel->regTallasAso();
				}

		    	// $msjEditFicha = 'location.href = uri+"ctrFicha/consFicha";';
		    	// $msjEditFicha = 'alert("Ficha modificada exitosamente"); location.href = uri+"ctrFicha/consFicha";';
		    	// $mensaje2 = 'Lobibox.notify("success", {msg: "Ficha Modificada Exitosamente!", rounded: true, delay: 5000}); location.href = uri+"ficha/consFicha";';
		    	 // $mensaje2 = 'swal("Ficha Modificada Exitosamente", "", "success"); location.href = uri+"ficha/consFicha";';

		    	header("location: " .URL. 'ctrFicha/consFicha');

		      }else{
		      	$msjEditFicha = "Lobibox.notify('error', {msg: 'No se pudo modificar la ficha',
			       rounded: true, delay: 2500});";
		      }
	
		    }

		    $fichas = $this->mdlModel->getFichas();

		    require APP . 'view/_templates/header.php';
	        require APP . 'view/ficha/consFicha.php';
	        require APP . 'view/_templates/footer.php';
		}

		public function cambiarEstadoFicha(){

	    	$mensaje = "";
		    $msjEditFicha = "";
		    $this->mdlModel->__SET("id_fichaT", $_POST["referencia"]);
	        $this->mdlModel->__SET("estado", $_POST["estado"]);

		    $fichas = $this->mdlModel->cambiarEstadoFicha();

		    if ($fichas) {
		    	echo json_encode(["v"=>1]);
		    }else{
		    	echo json_encode(["v"=>0]);
		    }
		}

		public function cargarInsumosAsociados(){

	    	$mensaje = "";
		    $msjEditFicha = "";

		    $this->mdlModel->__SET("id_fichaT", $_POST["referencia"]);

		    $insumosAsociados = $this->mdlModel->insumosAsociadosFicha();
		    
		    if ($insumosAsociados) {
		    	// echo json_encode(["r"=>1]);
		    	echo json_encode(["r"=>$insumosAsociados]);
		    }else{
		    	echo json_encode(["r"=>null]);
		    }
		}

		public function cargarTallasAsociadas(){

	    	$mensaje = "";
		    $msjEditFicha = "";

		    $this->mdlModel->__SET("id_fichaT", $_POST["referencia"]);

		    $tallasAsociadas = $this->mdlModel->tallasAsociadasFicha();

		    if ($tallasAsociadas) {
		    	echo json_encode(["r"=>$tallasAsociadas]);
		    }else{
		    	echo json_encode(["r"=>null]);
		    }
		}

		public function eliminarInsumoAsociado(){

		    $this->mdlModel->__SET("id_insumo", $_POST["id_insumo"]);
		    $this->mdlModel->__SET("referencia", $_POST["referencia"]);

		    $insumoEliminado = $this->mdlModel->eliminarInsumoAsoFicha();

		    if ($insumoEliminado) {
		    	echo json_encode(["r"=>1]);
		    }else{
		    	echo json_encode(["r"=>0]);
		    }
		}

		// public function insertarInsumoAsociado(){

		//     $this->mdlModel->__SET("id_insumo", $_POST["id_insumo"]);
		//     $this->mdlModel->__SET("referencia", $_POST["referencia"]);

		//     for ($i=0; $i < count($_POST["id_insumo"]); $i++) { 
						        		
		// 		$this->mdlModel->__SET("referencia", $_POST["referencia"]);
		// 		$this->mdlModel->__SET("id_insumo", $_POST["id_insumo"][$i]);
		// 		$insumoAgregado = $this->mdlModel->insertarInsumoAsoFicha();
		// 	}

		//     if ($insumoAgregado) {
		//     	echo json_encode(["r"=>1]);
		//     }else{
		//     	echo json_encode(["r"=>0]);
		//     }
		// }
	}
?>