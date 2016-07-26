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
	    	$mensaje = "";

		    if (isset($_POST["btnRegistrar"])) {

				$this->mdlModel->__SET("Num_Documento", $_POST["documento"]);
				$this->mdlModel->__SET("Usuario", $_POST["nombre_usuario"]);
				$this->mdlModel->__SET("Email", $_POST["email"]);

				$validar = $this->mdlModel->ValidarExistenciaD();
		        // $validarU= $this->mdlModel->ValidarExistenciaU();
				$validarE= $this->mdlModel->validarExistenciaE();		
		        //Validar que no se repita el documento
				if ($validar == null){
					// var_dump($_POST["rol"]);
					// exit();
					//Validar que no se repita el nombre de usuario
					// if ($validarU == null) {
						//Validar que no se repita el correo
			
						if ($validarE == null) {
							$this->mdlModel->__SET("Tipo_Documento", $_POST["tipo_documento"]);
					        $this->mdlModel->__SET("Nombre", $_POST["nombre"]);
					        $this->mdlModel->__SET("Apellido", $_POST["apellido"]);
					       	$this->mdlModel->__SET("Telefono", $_POST["telefono"]);
					       	$this->mdlModel->__SET("Direccion", $_POST["direccion"]);
					       	$this->mdlModel->__SET("Clave", $_POST["clave"]);
					       	$this->mdlModel->__SET("Tbl_Roles_Id_Rol", $_POST["rol"]);

					       
					        //Registrar usuario
							if($this->mdlModel->regUsuario() && $this->mdlModel->registroUsuario()){
								$mensaje = "Lobibox.notify('success', {size: 'mini', rounded: true, delayIndicator: false, msg: 'Usuario registrado exitosamente!'});"; 
							}else{
								$mensaje = "Lobibox.notify('error', {size: 'mini', rounded: true, delayIndicator: false, msg: 'No se puedo registrar el usuario'});"; 
							}
						}else{
							$mensaje = "Lobibox.notify('error', {size: 'mini', rounded: true, delayIndicator: false, msg: 'El correo ingresado ya se encuentra en la base de datos'});";
						}
						//Final de la validación del correo
					}else{
						$mensaje = "Lobibox.notify('error', {size: 'mini', rounded: true, delayIndicator: false, msg: 'El nombre de usuario ya se encuentra en la base de datos'});";
					}
					//Final de la validación del nombre de usuario
				// }else{
				//     $mensaje= "Lobibox.notify('error', {size: 'mini', rounded: true, delayIndicator: false, msg: 'Existe un usuario con este documento'});"; 
				}
				//Final de la validación del documento
			
	     	require APP . 'view/_templates/header.php';
        	require APP . 'view/usuario/regUsuario.php';
        	require APP . 'view/_templates/footer.php';

	        }else{
	        	header('location: '.URL.'home/index');
	        }
	    }

	
	    //FInal del registro de usuario

	    public function consUsuario()
	    {
	    	$rol = $this->mdlModel->consultarRol();
	    	if($this->validarURL("ctrUsuario/regUsuario")){
		    	$mensaje = "";
		    	$mensaje2 = "";
		    	$usuarios = $this->mdlModel->getUsuario();

		        require APP . 'view/_templates/header.php';
		        require APP . 'view/usuario/consUsuario.php';
		        require APP . 'view/_templates/footer.php';
	    	}else{
	    		header('location: '.URL.'home/index');
	    	}
	    }

	public function edit(){
		$mensaje2 = "";
		// if(isset($_POST["btnModificar"])){

		    	
		// $this->mdlModel->__SET("tipo_documento", $_POST["tipo_documento"]);
	    // $this->mdlModel->__SET("documento", $_POST["documento"]);
	    $this->mdlModel->__SET("nombre", $_POST["nombre"]);
        $this->mdlModel->__SET("apellido", $_POST["apellido"]);
        $this->mdlModel->__SET("nombre_usuario", $_POST["nombre_usuario"]);
	    $this->mdlModel->__SET("email", $_POST["email"]);
	    $this->mdlModel->__SET("rol", $_POST["rol"]);
	    $this->mdlModel->__SET("codigo", $_POST["codigo"]);
	  	$this->mdlModel->modificarUsuario();

		if($this->mdlModel->modificarUsuario()){
			//$mensaje2 = 'alert("Modificó"); $("#myModal3").hide();';
			$mensaje2 = 'alert("Modificó correctamente");';
			header('location: '.URL.'ctrUsuario/consUsuario');
		}else{
		  	$mensaje2 = "alert('Error al modificar')";
		      }

		      //header("location: ".URL."usuario/consUsuario")

		    $usuarios = $this->mdlModel->getUsuario();

		    require APP . 'view/_templates/header.php';
	        require APP . 'view/usuario/consUsuario.php';
	        require APP . 'view/_templates/footer.php';
		}


	public function cambiarEstado(){
		$this->mdlModel->__SET("codigo", $_POST["codigo"]);
	    $this->mdlModel->__SET("estado", $_POST["estado"]);

		$usuarios = $this->mdlModel->cambiarEstado();

		if ($usuarios) {
		    echo json_encode(["v"=>1]);
		}else{
		    echo json_encode(["v"=>0]);
		}
	}
}
?>