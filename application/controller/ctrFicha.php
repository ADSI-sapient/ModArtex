<?php 
	class ctrFicha extends Controller
	{
		private $mdlModel = null;

	    function __construct(){
	        $this->mdlModel = $this->loadModel("mdlFicha");
	    }

	    public function consFicha(){
	    	$mensaje = "";
	    	$msjEditFicha = "";

	        $insumos = $this->mdlModel->getAsoInsumos();
	        $tallas = $this->mdlModel->getAsoTallas();
	    	$fichas = $this->mdlModel->getFichas();
	    	
	    	require APP . 'view/_templates/header.php';
	        require APP . 'view/ficha/consFicha.php';
	        require APP . 'view/_templates/footer.php';
	    }
	    // comentario
	    public function consAsoInsumos(){
	    	$mensaje = "";
	    	$msjEditFicha = "";

	    	$insumos = $this->mdlModel->getAsoInsumos();
	        require APP . 'view/_templates/header.php';
	        require APP . 'view/ficha/regFicha.php';
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
			    	$this->mdlModel->__SET("color", $_POST["color"]);
			 		$this->mdlModel->__SET("estado", 1);
			    	$this->mdlModel->__SET("valor_produccion", $_POST["vlr_produccion"]);

					if($this->mdlModel->regFicha()){

						//Registro en tabla producto
						$this->mdlModel->__SET("cantidad", 123);
						$this->mdlModel->__SET("stock_min", $_POST["stock_min"]);
						$this->mdlModel->__SET("valor_producto", $_POST["vlr_producto"]);
						$this->mdlModel->regProducto();

						$ultima = $this->mdlModel->ultimaFicha()["referencia"];
					 	//Registro de insumos asociados
						// for ($i=0; $i < count($_POST['idInsumo']); $i++) { 
						        		
						// 	$this->mdlModel->__SET("referencia", $ultima);
						//   	$this->mdlModel->__SET("id_insumo", $_POST['idInsumo'][$i]);
						//   	$this->mdlModel->__SET("cant_necesaria", $_POST['cantNecesaria'][$i]);
						//   	$this->mdlModel->__SET("valor_insumo", $_POST['valorInsumo'][$i]);
						//   	$this->mdlModel->regInsumosAso();
						// }

						//Registro de tallas asociadas
						
						for ($t=0; $t < count($_POST['tallas']); $t++) {
							
						  	$this->mdlModel->__SET("referencia", $ultima);
						  	$this->mdlModel->__SET("id_talla", $_POST['tallas'][$t]);
						  	$retornoTallas = $this->mdlModel->regTallasAso();
						}

						$mensaje = "Lobibox.notify('success', {msg: 'Ficha Registrada Exitosamente!', rounded: true, delay: 3000});";

					}else{

						$mensaje = "Lobibox.notify('error', {msg: 'Error al registrar la ficha', rounded: true, delay: 2500});";
					}
	        		
	        	// }else{

	        	// 	// $msjFichaExiste = "Lobibox.notify('error', {msg: 'La ficha ya existe', rounded: true, delay: 3000,});";
	        	// 	$msjFichaExiste = "Lobibox.alert('error', {msg: 'La ficha que intenta registrar ya existe'});";
	        	// }
	      	}
	       
	        $insumos = $this->mdlModel->getAsoInsumos();
	        

	        require APP . 'view/_templates/header.php';
        	require APP . 'view/ficha/regFicha.php';
        	require APP . 'view/_templates/footer.php';
	    }

	    public function editFicha(){

	    	$mensaje = "";
		    $msjEditFicha = "";

		    if(isset($_POST["btn-modificar-ficha"])){

		      	$this->mdlModel->__SET("referencia", $_POST["referencia"]);
	            $this->mdlModel->__SET("color", $_POST["color"]);
	            $this->mdlModel->__SET("valor_produccion", $_POST["vlr_produccion"]);

		      if($this->mdlModel->modificarFicha()){

				$this->mdlModel->__SET("cantidad", 456);
		      	$this->mdlModel->__SET("stock_min", $_POST["stock_min"]);
	            $this->mdlModel->__SET("valor_producto", $_POST["vlr_producto"]);
	            $this->mdlModel->modificarProducto();

		      	// $this->mdlModel->eliminarInsumoAsoFicha();
		      	$this->mdlModel->eliminarTallaAsoFicha();

				// //Registro de insumos asociados
				// for ($i=0; $i < count($_POST['idInsumo']); $i++) { 
						        		
				// 	$this->mdlModel->__SET("id_insumo", $_POST['idInsumo'][$i]);
				// 	$this->mdlModel->__SET("cant_necesaria", $_POST['cantNecesaria'][$i]);
				// 	$this->mdlModel->__SET("valor_insumo", $_POST['valorInsumo'][$i]);
				// 	$this->mdlModel->regInsumosAso();
				// }

				//Registro de tallas asociadas
				for ($t=0; $t < count($_POST['tallas']); $t++) { 

					$this->mdlModel->__SET("id_talla", $_POST['tallas'][$t]);
					$retornoTallas = $this->mdlModel->regTallasAso();
				}

		    	$msjEditFicha = 'location.href = uri+"ctrFicha/consFicha";';
		    	// $msjEditFicha = 'alert("Ficha modificada exitosamente"); location.href = uri+"ctrFicha/consFicha";';
		    	// $mensaje2 = 'Lobibox.notify("success", {msg: "Ficha Modificada Exitosamente!", rounded: true, delay: 5000}); location.href = uri+"ficha/consFicha";';
		    	 // $mensaje2 = 'swal("Ficha Modificada Exitosamente", "", "success"); location.href = uri+"ficha/consFicha";';

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

		public function cambiarEstado(){

	    	$mensaje = "";
		    $msjEditFicha = "";
		    $this->mdlModel->__SET("referencia", $_POST["referencia"]);
	        $this->mdlModel->__SET("estado", $_POST["estado"]);

		    $fichas = $this->mdlModel->cambiarEstado();

		    if ($fichas) {
		    	echo json_encode(["v"=>1]);
		    }else{
		    	echo json_encode(["v"=>0]);
		    }
		}

		public function cargarInsumosAsociados(){

	    	$mensaje = "";
		    $msjEditFicha = "";

		    $this->mdlModel->__SET("referencia", $_POST["referencia"]);

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

		    $this->mdlModel->__SET("referencia", $_POST["referencia"]);

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