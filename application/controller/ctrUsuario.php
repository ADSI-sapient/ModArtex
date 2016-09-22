<?php 
class CtrUsuario extends Controller{
	private $mdlModel = null;

	function __construct(){
	    $this->mdlModel = $this->loadModel("mdlUsuario");
	}

	//Registrar usuario
	public function regUsuario(){
		//Validar permisos y consultar rol
	    if($this->validarURL("ctrUsuario/regUsuario")){
			$rol = $this->mdlModel->consultarRol();

		    if (isset($_POST["btnRegistrar"])) {

				$this->mdlModel->__SET("Num_Documento", $_POST["documento"]);
				$this->mdlModel->__SET("Usuario", $_POST["nombre_usuario"]);
				$this->mdlModel->__SET("Email", $_POST["email"]);

				$validar = $this->mdlModel->ValidarExistenciaD();
		        $validarU= $this->mdlModel->ValidarExistenciaU();
				$validarE= $this->mdlModel->validarExistenciaE();		
		        //Validar que no se repita el documento
				if ($validar == null){

					//Validar que no se repita el nombre de usuario
					if ($validarU == null) {
						//Validar que no se repita el correo
			
						if ($validarE == null) {
							$this->mdlModel->__SET("Tipo_Documento", $_POST["tipo_documento"]);
					        $this->mdlModel->__SET("Nombre", $_POST["nombre"]);
					        $this->mdlModel->__SET("Apellido", $_POST["apellido"]);
					       	$this->mdlModel->__SET("Telefono", $_POST["telefono"]);
					       	$this->mdlModel->__SET("Direccion", $_POST["direccion"]);
					       	$this->mdlModel->__SET("Clave", sha1($_POST["clave"]));
					       	$this->mdlModel->__SET("Tbl_Roles_Id_Rol", $_POST["rol"]);

					       
					        //Registrar usuario
							if($this->mdlModel->regUsuario() && $this->mdlModel->registroUsuario()){
								$mensajeu = "Lobibox.notify('success', {size: 'mini', msg: 'Usuario registrado exitosamente!', delay: 6000});"; 
							}else{
								$mensajeu = "Lobibox.notify('error', {size: 'mini', msg: 'No se puedo registrar el usuario'});"; 
							}
						}else{
							$mensajeu = "Lobibox.notify('error', {size: 'mini', msg: 'El correo ingresado ya se encuentra en la base de datos'});";
						}
						//Final de la validación del correo
					}else{
						$mensajeu = "Lobibox.notify('error', {size: 'mini', msg: 'El nombre de usuario ya se encuentra en la base de datos'});";
					}
					//Final de la validación del nombre de usuario
				 }else{
				    $mensajeu= "Lobibox.notify('error', {size: 'mini', msg: 'Existe un usuario con este documento'});"; 
				}
				$_SESSION["mensaje"] = $mensajeu;
			}	//Final de la validación del documento
	     	require APP . 'view/_templates/header.php';
        	require APP . 'view/usuario/regUsuario.php';
        	require APP . 'view/_templates/footer.php';

	        }else{
	        	header('location: '.URL.'home/index');
	        }
	}
	
	    //FInal del registro de usuario

	    public function consUsuario(){
	    	if($this->validarURL("ctrUsuario/consUsuario")){
	    		$rol = $this->mdlModel->consultarRol();
		    		$usuarios = $this->mdlModel->getUsuario();
	
			    	require APP . 'view/_templates/header.php';
			    	require APP . 'view/usuario/consUsuario.php';
			    	require APP . 'view/_templates/footer.php';
		    }else{
		    	header('location: '.URL.'home/index');
	    	}
	    }

	public function edit(){

		 if (isset($_POST["btonModificar"])) {
	# code...
	    $this->mdlModel->__SET("Nombre", $_POST["nombre"]);
      	$this->mdlModel->__SET("Apellido", $_POST["apellido"]);     
	    $this->mdlModel->__SET("Email", $_POST["email"]);
	    $this->mdlModel->__SET("Num_Documento", $_POST["documento"]);
	    $this->mdlModel->__SET("Usuario", $_POST["nombre_usuario"]);
	    $this->mdlModel->__SET("Tbl_Roles_Id_Rol", $_POST["rol"]);
	    
		 
		if ($this->mdlModel->modificarPersona() && $this->mdlModel->modificarUsuario()) {
			

	  		$mensajeu = "Lobibox.notify('success', {size: 'mini', msg: 'Usuario modificado exitosamente!'});";
	  		header("location: ".URL."ctrUsuario/consUsuario");
			}else{

				$mensajeu = "Lobibox.notify('error', {size: 'mini', msg: 'Error! No se pudo modificar el usuario'});";
				header("location: ".URL."ctrUsuario/consUsuario");
				
			}
		  $_SESSION["mensaje"] = $mensajeu;

		    $usuarios = $this->mdlModel->getUsuario();

		    require APP . 'view/_templates/header.php';
	        require APP . 'view/usuario/consUsuario.php';
	        require APP . 'view/_templates/footer.php';
	    }
	}


	public function cambiarEstado(){
		$this->mdlModel->__SET("Num_Documento", $_POST["Num_Documento"]);
	    $this->mdlModel->__SET("Estado", $_POST["Estado"]);

		$usuarios = $this->mdlModel->cambiarEstado();

		if ($usuarios) {
			$_SESSION["mensaje"] = "Lobibox.notify('success', {size: 'mini', msg: 'El estado ha sido modificado!'})";
		    echo json_encode(["v"=>1]);
		}else{
			$_SESSION["mensaje"] = "Lobibox.notify('error', {size: 'mini', msg: 'Error al cambiar el estado'})";
		    echo json_encode(["v"=>0]);
		}
	}
}
?>