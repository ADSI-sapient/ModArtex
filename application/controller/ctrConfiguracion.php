<?php
	class ctrConfiguracion extends Controller{
		private $_modelColor;
		private $_modelMedida;

		function __construct(){
			$this->_modelColor = $this->loadModel('mdlColores');
			$this->_modelMedida = $this->loadModel('mdlMedidas');
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

			if (isset($_GET["mes"])) {
				if ($_GET["mes"] == 1) {
					echo '<script type="text/javascript">
						swal("Confirmación", "Se elimino correctamente el color", "success")
					</script>';
				}
				if ($_GET["mes"] == 2) {
					echo '<script type="text/javascript">
						swal("Registro exitoso", "Se registro exitosamente el color", "success")
					</script>';
				}
				if ($_GET["mes"] == 3) {
					echo '<script type="text/javascript">
						swal("Modificación exitosa", "Se modifico exitosamente el color", "success")
					</script>';
				}
			}
		}

		public function registrarColor(){
			$this->_modelColor->__SET("_codigo", $_POST["codigo"]);
			$this->_modelColor->__SET("_nombre", $_POST["nombre"]);
			$this->_modelColor->registrar();

			header ("location: ".URL."ctrConfiguracion/listarColores?mes=2");
		}

		public function eliminarColor(){
			$this->_modelColor->__SET("_id", $_GET["id"]);
			$this->_modelColor->eliminar();

			header("location: ".URL."ctrConfiguracion/listarColores?mes=1");
		}

		public function modificarColor(){
			$this->_modelColor->__SET("_id", $_POST["id"]);
			$this->_modelColor->__SET("_codigo", $_POST["codigo"]);
			$this->_modelColor->__SET("_nombre", $_POST["nombre"]);
			$this->_modelColor->modificar();
			
			header('location: '.URL.'ctrConfiguracion/listarColores?mes=3');
		}

		public function listarMedidas(){
			$lista = $this->_modelMedida->listar();

			include APP . 'view/_templates/header.php';
			include APP . 'view/configuracion/medidas.php';
			include APP . 'view/_templates/footer.php'; 

			if (isset($_GET["message"])) {
				if ($_GET["message"] == 1) {
					echo '<script type="text/javascript">
						swal("Registro exitoso", "Se registro exitosamente la unidad de medida", "success")
					</script>';
				}
				if ($_GET["message"] == 2) {
					echo '<script type="text/javascript">
						swal("Modificación exitosa", "Se modifico correctamente la unidad de medida", "success")
					</script>';
				}
				if ($_GET["message"] == 3) {
					echo '<script type="text/javascript">
						swal("Confirmación", "Se elimino correctamente la unidad de medida", "success")
					</script>';
				}
			}
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
	}
?>