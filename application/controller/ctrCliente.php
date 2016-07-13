<?php 
class CtrCliente extends Controller
{
	private $mdlModel = null;

	function __construct(){
	    $this->mdlModelU = $this->loadModel("mdlUsuario");
	    $this->mdlModel= $this->loadModel("mdlCliente");
	}


	public function regCliente()
	{
	   	if($this->validarURL("ctrUsuario/regUsuario")){

	   	$rol = $this->mdlModelU->consultarRol();
	    $mensaje = "";
	    if (isset($_POST["btnRegistrarC"])) {
	    	$this->mdlModel->__SET("estado", $_POST["estado"]);
			$this->mdlModel->__SET("tipo_documento", $_POST["tipo_documento"]);
	        $this->mdlModel->__SET("documento", $_POST["documento"]);
	        $this->mdlModel->__SET("nombre", $_POST["nombre"]);
	        $this->mdlModel->__SET("apellido", $_POST["apellido"]);
	        $this->mdlModel->__SET("email", $_POST["email"]);
	        $this->mdlModel->__SET("telefono", $_POST["telefono"]);
			
			if($this->mdlModel->regCliente()){
			        $mensaje = "alert('Cliente registrada exitosamente!', '', 'success')";
			    }else{
			    	$mensaje = "alert('No se pudo registrar el usuario')";
			 	}
	        }

	     	require APP . 'view/_templates/header.php';
        	require APP . 'view/cliente/regCliente.php';
        	require APP . 'view/_templates/footer.php';

	        }else{
	        	header('location: '.URL.'home/index');
	        }
	    }

	    public function consCliente()
	    {
	    	$rol = $this->mdlModelU->consultarRol();
	    	if($this->validarURL("ctrUsuario/regUsuario")){
		    	$mensaje = "";
		    	$mensaje2 = "";

		    	$clientes = $this->mdlModel->getCliente();

		        require APP . 'view/_templates/header.php';
		        require APP . 'view/cliente/consCliente.php';
		        require APP . 'view/_templates/footer.php';
	    	}else{
	    		header('location: '.URL.'home/index');
	    	}
	    }
	}
?>