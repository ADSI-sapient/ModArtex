<?php 

class CtrUsuario extends Controller
{
	private $mdlModel = null;

	function __construct(){
		$this->mdlModel = $this->loadModel("mdlUsuario");
	}


	public function regUsuario(){

		if($this->validarURL("ctrUsuario/regUsuario")){

			$rol = $this->mdlModel->consultarRol();
			$mensaje = "";
			if (isset($_POST["btnRegistrar"])) {

				$this->mdlModel->__SET("tipo_documento", $_POST["tipo_documento"]);
				$this->mdlModel->__SET("documento", $_POST["documento"]);
				$this->mdlModel->__SET("estado", $_POST["estado"]);
				$this->mdlModel->__SET("nombre", $_POST["nombre"]);
				$this->mdlModel->__SET("apellido", $_POST["apellido"]);
				$this->mdlModel->__SET("nombre_usuario", $_POST["nombre_usuario"]);
				$this->mdlModel->__SET("clave", sha1($_POST["clave"]));
				$this->mdlModel->__SET("email", $_POST["email"]);
				$this->mdlModel->__SET("rol", $_POST["rol"]);

	            // echo '<script>swal("Usuario registrada exitosamente!", "", "success")</script>';

				if($this->mdlModel->regUsuario()){
					$mensaje = "swal('Usuario registrada exitosamente!', '', 'success')";
				}else{
					$mensaje = "alert('No se pudo registrar el usuario')";
				}
			}

	        // va redireccionar acá despues de realizar el registro.
	        //header('location: ' . URL . 'usuario/regUsuario');

			require APP . 'view/_templates/header.php';
			require APP . 'view/usuario/regUsuario.php';
			require APP . 'view/_templates/footer.php';

		}else{
			header('location: '.URL.'home/index');
		}
	}

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

		$mensaje = "";
		$mensaje2 = "";
		    // if(isset($_POST["btnModificar"])){


		      	// $this->mdlModel->__SET("tipo_documento", $_POST["tipo_documento"]);
	        //     $this->mdlModel->__SET("documento", $_POST["documento"]);
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

	    	// $mensaje = "";
		    // $mensaje2 = "";
		$this->mdlModel->__SET("codigo", $_POST["codigo"]);
		$this->mdlModel->__SET("estado", $_POST["estado"]);

		$usuarios = $this->mdlModel->cambiarEstado();

		if ($usuario) {
			echo json_encode(["v"=>1]);
		}else{
			echo json_encode(["v"=>0]);
		}

		require APP . 'view/_templates/header.php';
		require APP . 'view/ficha/consUsuario.php';
		require APP . 'view/_templates/footer.php';
	}
}
