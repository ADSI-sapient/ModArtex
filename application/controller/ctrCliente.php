<?php 
class CtrCliente extends Controller{
	private $mdlModel = null;

	function __construct(){
	    $this->mdlModelU = $this->loadModel("mdlUsuario");
	    $this->mdlModel= $this->loadModel("mdlCliente");
	}

	//Registrar usuario
	public function regCliente(){
		//Validar permisos y consultar rol
	    if($this->validarURL("ctrCliente/regCliente")){
			$rol = $this->mdlModelU->consultarRol();
	    	$mensajec = "";

		    if (isset($_POST["btnRegistrarC"])) {

				$this->mdlModel->__SET("Num_Documento", $_POST["documento"]);
				$this->mdlModel->__SET("Email", $_POST["email"]);


				$validar = $this->mdlModel->ValidarExistenciaD();
				$validarE= $this->mdlModel->validarExistenciaE();

		        //Validar que no se repita el documento
				if ($validar == null){

						//Validar que no se repita el correo
						if ($validarE == null || $_POST["email"] == "") {
							$this->mdlModel->__SET("Tipo_Documento", $_POST["tipo_documento"]);
					        $this->mdlModel->__SET("Nombre", $_POST["nombre"]);
					        $this->mdlModel->__SET("Apellido", $_POST["apellido"]);
					       	$this->mdlModel->__SET("Telefono", $_POST["telefono"]);
					       	$this->mdlModel->__SET("Direccion", $_POST["direccion"]);
					       	$this->mdlModel->__SET("infoAdicional", $_POST["infoAdicional"]);
					       
					    	//Registrar usuario
							if($this->mdlModel->regCliente()){
								$mensajec = "Lobibox.notify('success', {size: 'mini', msg: 'Cliente registradó exitosamente!'});"; 
							}else{
								$mensajec = "Lobibox.notify('error', {size: 'mini', msg: 'No se pudo registrar el cliente'});"; 
							}
						}else{
							$mensajec = "Lobibox.notify('warning', {size: 'mini', msg: 'El correo ingresado ya se encuentra en la base de datos'});";
						}
						//Final de la validación del correo
				 }else{
				    $mensajec= "Lobibox.notify('warning', {size: 'mini', msg: 'Ya existe un cliente con este documento'});"; 
				}
				$_SESSION["mensaje"] = $mensajec;
			}	//Final de la validación del documento
	     	require APP . 'view/_templates/header.php';
        	require APP . 'view/cliente/regCliente.php';
        	require APP . 'view/_templates/footer.php';

	        }else{
	        	header('location: '.URL.'home/index');
	        }
	}
	
	    //FInal del registro de usuario

	    public function consCliente(){
	    	if($this->validarURL("ctrCliente/consCliente")){
	    	$rol = $this->mdlModelU->consultarRol();
		    	$clientes = $this->mdlModel->getCliente();
		 
		        require APP . 'view/_templates/header.php';
		        require APP . 'view/cliente/consCliente.php';
		        require APP . 'view/_templates/footer.php';
	    	}else{
	    		header('location: '.URL.'home/index');
	    	}
	    }

	public function edit(){
		
		$this->mdlModel->__SET("Num_Documento", $_POST["Num_Documento"]);
		$this->mdlModel->__SET("Nombre", $_POST["Nombre"]);
		$this->mdlModel->__SET("Apellido", $_POST["Apellido"]);
		$this->mdlModel->__SET("Telefono", $_POST["Telefono"]);
		$this->mdlModel->__SET("Direccion", $_POST["Direccion"]);
		$this->mdlModel->__SET("Email", $_POST["Email"]);
		$this->mdlModel->__SET("infoAdicional", $_POST["infoAdicionalMod"]);

	  	// $this->mdlModel->modificarCliente();

		if($this->mdlModel->modificarCliente()){
			 $mensajecm= "Lobibox.notify('success', {size: 'mini', msg: ' Cliente modificado exitosamente'});";

			header('location: '.URL.'ctrCliente/consCliente');
		}else{
		  	$mensajecm= "Lobibox.notify('error', {size: 'mini', msg: ' Error al modificar'});";
		      }
		      //header("location: ".URL."usuario/consUsuario")

		    $clientes = $this->mdlModel->getCliente();

		    require APP . 'view/_templates/header.php';
	        require APP . 'view/cliente/consCliente.php';
	        require APP . 'view/_templates/footer.php';
	         $_SESSION["mensaje"] = $mensajecm;
		}


	public function CambiarEstado(){
		$this->mdlModel->__SET("Num_Documento", $_POST["Num_Documento"]);
	    $this->mdlModel->__SET("Estado", $_POST["Estado"]);

		$clientes = $this->mdlModel->cambiarEstado();

		if ($clientes) {
			$_SESSION["mensaje"] = "Lobibox.notify('success', {size: 'mini', msg: 'El estado ha sido modificado'})";
		    echo json_encode(["v"=>1]);
		}else{
			$_SESSION["mensaje"] = "Lobibox.notify('warning', {msg: 'Error al cambiar el estado', rounded: true, delay: false})";
		    echo json_encode(["v"=>0]);
		}
		}

		     
	}


