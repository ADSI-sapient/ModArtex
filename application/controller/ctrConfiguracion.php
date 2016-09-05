<?php
class ctrConfiguracion extends Controller{
	private $_modelColor;
	private $_modelMedida;
	private $_modelRoles;

	public $mensaje = "";


	function __construct(){
		$this->_modelColor = $this->loadModel('mdlColores');
		$this->_modelMedida = $this->loadModel('mdlMedidas');
		$this->_modelRoles = $this->loadModel('mdlRoles');
	}

	public function index(){
		$lista = $this->_modelColor->listar();

		include APP . 'view/_templates/header.php';
		include APP . 'view/configuracion/colores.php';
		include APP . 'view/_templates/footer.php';


		if ($mensaje != "") {
			echo("<script> swal('Hay cantidades asociadas a este registro', 'Regristro exitoso'); </script>");
		}
	}

	public function listarColores(){
		$lista = $this->_modelColor->listar();

		include APP . 'view/_templates/header.php';
		include APP . 'view/configuracion/colores.php';
		include APP . 'view/_templates/footer.php';	
	}

	public function registrarColor(){
		$this->_modelColor->__SET("_codigo", $_POST["codigo"]);
		$this->_modelColor->__SET("_nombre", $_POST["nombre"]);
		if ($this->_modelColor->registrar()) {
			$mensaje = "swal('Hay cantidades asociadas a este registro', 'Regristro exitoso')";
		}

		header ("location: ".URL."ctrConfiguracion/listarColores");
	}

	public function eliminarColor(){
		$this->_modelColor->__SET("_id", $_GET["id"]);
		$this->_modelColor->eliminar();

		header("location: ".URL."ctrConfiguracion/listarColores");
	}

	public function modificarColor(){
		$this->_modelColor->__SET("_id", $_POST["id"]);
		$this->_modelColor->__SET("_codigo", $_POST["codigo"]);
		$this->_modelColor->__SET("_nombre", $_POST["nombre"]);
		$this->_modelColor->modificar();

		header('location: '.URL.'ctrConfiguracion/listarColores');
	}

	public function listarMedidas(){
		$lista = $this->_modelMedida->listar();

		include APP . 'view/_templates/header.php';
		include APP . 'view/configuracion/medidas.php';
		include APP . 'view/_templates/footer.php'; 
	}

	public function registrarMedida(){
		$this->_modelMedida->__SET("_nombre", $_POST["nombre"]);
		$this->_modelMedida->__SET("_abreviatura", $_POST["Abr"]);
		$this->_modelMedida->registrarMedida();

		header('location: '.URL.'ctrConfiguracion/listarMedidas?message=1');
	}

	public function eliminarMedida(){
		$this->_modelMedida->__SET("_codigo", $_GET["cod"]);
		$this->_modelMedida->eliminarMedida();

		header('location: '.URL.'ctrConfiguracion/listarMedidas?message=3');
	}

	public function modificarMedida(){
		$this->_modelMedida->__SET("_codigo", $_POST["cod"]);
		$this->_modelMedida->__SET("_nombre", $_POST["nombre"]);
		$this->_modelMedida->__SET("_abreviatura", $_POST["abr"]);
		$this->_modelMedida->modificarMedida();

		header('location: '.URL.'ctrConfiguracion/listarMedidas?message=2');
	}

	public function RegistrarRoles(){

		if (isset($_POST["btnRegistrarR"])) {
			$this->_modelRoles->__SET("Nombre", $_POST["nombre"]);
			$validar = $this->_modelRoles->ValidarExistenciaN();

			if ($validar==null) {
				
				if($this->_modelRoles->regRoles()){
				$ultimoRol = $this->_modelRoles->ultimoRol()["rol"];
				for ($i=0; $i < count($_POST["Idpermiso"]); $i++) { 

				$this->_modelRoles->__SET("Id_Rol",$ultimoRol);
				$this->_modelRoles->__SET("Id_Permiso", $_POST['Idpermiso'][$i]);
				$this->_modelRoles->regPermisosAsociados();

				$mensajeR = "Lobibox.notify('success', {size: 'mini', rounded: true, delayIndicator: false, msg: 'Rol registrado exitosamente'});"; 
				}
			}else{
			    // alert("Error al registrar");
			 	}
			}else{
				$mensajeR = "Lobibox.notify('error', {size: 'mini', rounded: true, delayIndicator: false, msg: 'Este nombre de usuario ya se encuentra en la base de datos'});"; 
			}
			$_SESSION["mensaje"] = $mensajeR;
	        }

	    $permisos = $this->_modelRoles->getAsoPermisos();
	    $roles = $this->_modelRoles->getRoles();
	        
	    if (isset($_POST["btnModificarRol"])) {
	      	if ($_POST["idRol"] != 1) {
				$this->_modelRoles->__SET("Id_Rol", $_POST["idRol"] );
				$this->_modelRoles->__SET("Nombre", $_POST["Nombre"] );
				$this->_modelRoles->BorrarPermisos() && $this->_modelRoles->ModificarNombre();

				// echo json_encode($listas);
				for ($i=0; $i < count($_POST["Idpermiso"]); $i++) { 
					$this->_modelRoles->__SET("Id_Permiso", $_POST['Idpermiso'][$i]);
					$this->_modelRoles->regPermisosAsociados();

					$mensajeR = "Lobibox.notify('success', {size: 'mini', rounded: true, delayIndicator: false, msg: 'Rol modificado exitosamente'});";
				}
	      	}else{
	      		$mensajeR = "Lobibox.notify('error', {size: 'mini', rounded: true, delayIndicator: false, msg: 'El rol administrador no se puede modificar'});";
	      	}
	      	$_SESSION["mensaje"] = $mensajeR;
		}

		include APP . 'view/_templates/header.php';
		include APP . 'view/configuracion/roles.php';
		include APP . 'view/_templates/footer.php';	
	}

	public function listarR(){

		$this->_modelRoles->__SET("Id_Rol", $_POST["rol"]);
		$listas = $this->_modelRoles->ListarPermisos();
		echo json_encode($listas);	
	}

	public function cambiarEstadoRol(){
		$this->_modelRoles->__SET("Id_Rol", $_POST["Id_Rol"]);
		$this->_modelRoles->__SET("Estado", $_POST["Estado"]);

		$roles = $this->_modelRoles->cambiarEstadoRoles();

		if ($roles) {
			echo json_encode(["v"=>1]);
		}else{
			echo json_encode(["v"=>0]);
		}
	}
}
