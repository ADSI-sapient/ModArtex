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
	}

	public function listarColores(){
		$lista = $this->_modelColor->listar();

		include APP . 'view/_templates/header.php';
		include APP . 'view/configuracion/colores.php';
		include APP . 'view/_templates/footer.php';	
	}

	public function listarColoresAjax(){
		$lista = $this->_modelColor->listar();
		echo json_encode($lista);
	}

	public function consAsoColor(){
		$this->_modelColor->__SET("_id", $_POST["idColor"]);
		$this->_modelColor->consultaFichaAsoc();
		$this->_modelColor->consultaInsumoAsoc();
	}

	public function registrarColor(){
		$this->_modelColor->__SET("_codigo", $_POST["codigo"]);
		$this->_modelColor->__SET("_nombre", $_POST["nombre"]);

		$validate = $this->_modelColor->validar();
		
		if($validate != false) {
			$_SESSION["mensaje"] = "Lobibox.notify('error', {delay: 6000, size: 'mini',
					msg: 'El color ingresado ya existe'});";
			header ("location: ".URL."ctrConfiguracion/listarColores");
		}else{

		if (isset($_POST["crudCol"])) {
			echo json_encode($this->_modelColor->registrar());
		}
		else{
			if ($this->_modelColor->registrar()) {
				$_SESSION["mensaje"] = "Lobibox.notify('success', {delay: 6000, size: 'mini',
					msg: 'El color ha sido registrado correctamente!'});";
			}
			header ("location: ".URL."ctrConfiguracion/listarColores");
		}
	}
	}

	public function eliminarColor(){
		$this->_modelColor->__SET("_id", $_POST["idColor"]);
		if($this->_modelColor->eliminar()){
			$_SESSION["mensaje"] = "Lobibox.notify('success', {delay: 6000, size: 'mini', msg: 'El color se ha eliminado correctamente'});";
			echo json_encode(true);
		}
	}

	public function modificarColor(){
		$this->_modelColor->__SET("_id", $_POST["id"]);
		$this->_modelColor->__SET("_codigo", $_POST["codigo"]);
		$this->_modelColor->__SET("_nombre", $_POST["nombre"]);

		if (isset($_POST["crudCol"])) {
			echo json_encode($this->_modelColor->modificar());
		}else{
			if ($this->_modelColor->modificar()) {
				$_SESSION["mensaje"] = "Lobibox.notify('success', {delay: 6000, size: 'mini',
					msg: 'El color se actualizó correctamente'});";
			}
			header('location: '.URL.'ctrConfiguracion/listarColores');
		}
	}

	public function listarMedidas(){
		if (isset($_POST["crudMed"])) {
			echo json_encode($lista = $this->_modelMedida->listar());
		}else{
			$lista = $this->_modelMedida->listar();

			include APP . 'view/_templates/header.php';
			include APP . 'view/configuracion/medidas.php';
			include APP . 'view/_templates/footer.php'; 
		}
	}

	public function registrarMedida(){
		$this->_modelMedida->__SET("_nombre", $_POST["nombre"]);
		$this->_modelMedida->__SET("_abreviatura", $_POST["Abr"]);

		if ($this->_modelMedida->validar() != false) {
			$_SESSION["mensaje"] = "Lobibox.notify('error', {delay: 6000, size: 'mini',
					msg: 'La unidad de medida ingresada ya existe'});";
			header('location: '.URL.'ctrConfiguracion/listarMedidas');
		}else{
			if (isset($_POST["crudMed"])) {
				echo json_encode($this->_modelMedida->registrarMedida());
			}else{
				if($this->_modelMedida->registrarMedida()){
					$_SESSION["mensaje"] = "Lobibox.notify('success', {delay: 6000, size: 'mini',
						msg: 'La unidad de medida ha sido registrada correctamente'});";
				}
				header('location: '.URL.'ctrConfiguracion/listarMedidas');
			}
		}
	}

	public function eliminarMedida(){
		$this->_modelMedida->__SET("_codigo", $_POST["cod"]);
		if ($this->_modelMedida->eliminarMedida()) {
			$_SESSION["mensaje"] = "Lobibox.notify('success', {delay: 6000, size: 'mini', msg: 'La unidad de medida se ha eliminado correctamente'});";
			echo json_encode(true);
		}
	}

	public function modificarMedida(){
		$this->_modelMedida->__SET("_codigo", $_POST["cod"]);
		$this->_modelMedida->__SET("_nombre", $_POST["nombre"]);
		$this->_modelMedida->__SET("_abreviatura", $_POST["abr"]);
		if (isset($_POST["crudMed"])) {
			echo json_encode($this->_modelMedida->modificarMedida());
		}else{
			if($this->_modelMedida->modificarMedida()){
				$_SESSION["mensaje"] = "Lobibox.notify('success', {delay: 6000, size: 'mini',
				msg: 'La unidad de medidas se modifico correctamente'});";
			}
			header('location: '.URL.'ctrConfiguracion/listarMedidas');
		}
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

				$mensajeR = "Lobibox.notify('success', {size: 'mini', delayIndicator: 6000, msg: 'Rol registrado exitosamente'});"; 
				}
			}else{
			    // alert("Error al registrar");
			 	}
			}else{
				$mensajeR = "Lobibox.notify('error', {size: 'mini', delayIndicator: 6000, msg: 'Este nombre de usuario ya se encuentra en la base de datos'});"; 
			}
			$_SESSION["mensaje"] = $mensajeR;
	        }


	    
	        
	    if (isset($_POST["btnModificarRol"])) {
	    	
	      	if ($_POST["idRol"] != 1) {
				$this->_modelRoles->__SET("Id_Rol", $_POST["idRol"] );
				$this->_modelRoles->__SET("Nombre", $_POST["Nombre"] );
				$this->_modelRoles->BorrarPermisos() && $this->_modelRoles->ModificarNombre();

				// echo json_encode($listas);
				for ($i=0; $i < count($_POST["Idpermiso"]); $i++) { 
					$this->_modelRoles->__SET("Id_Permiso", $_POST['Idpermiso'][$i]);
					$this->_modelRoles->regPermisosAsociados();

					$mensajeR = "Lobibox.notify('success', {size: 'mini', delayIndicator: 6000, msg: 'Rol modificado exitosamente'});";
				}
	      	}else{
	      		$mensajeR = "Lobibox.notify('error', {size: 'mini', delayIndicator: 6000, msg: 'El rol administrador no se puede modificar'});";
	      	}
	      	$_SESSION["mensaje"] = $mensajeR;
		}


	    $permisos = $this->_modelRoles->getAsoPermisos();
	    $roles = $this->_modelRoles->getRoles();
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

	public function validateColor(){
		$this->_modelColor->__SET("_nombre", $_POST["nombre"]);
		echo json_encode($this->_modelColor->validar());
	}

	public function validateMedida(){
		$this->_modelMedida->__SET("_nombre", $_POST["nombre"]);
		$this->_modelMedida->__SET("_abreviatura", $_POST["Abr"]);
		echo json_encode($this->_modelMedida->validar());
	}
}
