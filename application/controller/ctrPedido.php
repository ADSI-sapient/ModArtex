<?php  

	class Pedido extends Controller
	{
		private $mdlModel = null;

		function __construct()
		{
	        $this->mdlModel = $this->loadModel("mdlPedido");
	        $this->mdlModelF = $this->loadModel("mdlFicha");
		}

		public function consPedido()
		{
			$msgModPedido = "";
			$msgRegPedido = "";
			$msgModEstadoPedido ="";
			
			$pedidos = $this->mdlModel->getPedidos();

	        require APP . 'view/_templates/header.php';
	        require APP . 'view/pedido/consPedido.php';
	        require APP . 'view/_templates/footer.php';
		}

		public function regPedido()
	    {

	    	$msgModPedido = "";
			$msgRegPedido = "";
			$msgModEstadoPedido ="";

	        if (isset($_POST["btnRegPedido"])) {

	        	$this->mdlModel->__SET("id_estado", 1);
	        	$this->mdlModel->__SET("fecha_registro", $_POST["fecha_reg"]);
	      		$this->mdlModel->__SET("fecha_entrega", date("Y-m-d", strtotime($_POST["fecha_entrega"])));
	        	$this->mdlModel->__SET("vlr_total", $_POST["vlr_total"]);
	        	$this->mdlModel->__SET("id_cliente", $_POST["cliente"]);

	            if ($this->mdlModel->regPedido()) {


	            	$ultimoPedido = $this->mdlModel->ultimoPedido()["id_pedido"];

		        	//Registro de fichas asociadas
		        	for ($f=0; $f < count($_POST['idFicha']); $f++) { 
		        		
		        		$this->mdlModel->__SET("id_pedido", $ultimoPedido);
		        		$this->mdlModel->__SET("id_ficha", $_POST['idFicha'][$f]);
		        		$this->mdlModel->regFichasAsociadas();
		        	}

	            	$msgRegPedido = "Lobibox.notify('success', {msg: 'Pedido Registrado Exitosamente!', rounded: true, delay: 3000});";
		        	
				}else{

					$msgRegPedido = "Lobibox.notify('error', {msg: 'Error al registrar el pedido', rounded: true, delay: 2500,});";
				}
	        }

	        $fichas = $this->mdlModelF->getFichas();

	        $clientes = $this->mdlModel->getClientes();

	        require APP . 'view/_templates/header.php';
        	require APP . 'view/pedido/regPedido.php';
        	require APP . 'view/_templates/footer.php';
	    }


	    public function editarPedido(){

	    	
	    	$msgModPedido = "";
			$msgRegPedido = "";
			$msgModEstadoPedido ="";
	    	if (isset($_POST["btnModificarPed"])) {
	    		
	    		$this->mdlModel->__SET("id_pedido", $_POST["id_pedido"]);
	    		$this->mdlModel->__SET("fecha_entrega", date("Y-m-d", strtotime($_POST["fecha_entrega"])));
	    		$this->mdlModel->__SET("vlr_total", $_POST["valor_total"]);

	    		if ($this->mdlModel->editPedidos()) {
	    			$msgModPedido = "alert('Pedido modificado'); location.href=uri+'pedido/consPedido'";
	    		}else{
	    			$msgModPedido = "alert('Error al modificar el pedido')";
	    		}
	    	}

	    	$pedidos = $this->mdlModel->getPedidos();

	        require APP . 'view/_templates/header.php';
	        require APP . 'view/pedido/consPedido.php';
	        require APP . 'view/_templates/footer.php';
	    }

	    public function cambiarEstadoPedido(){

	    	$msgModPedido = "";
			$msgRegPedido = "";
			$msgModEstadoPedido = "";
	    	if (isset($_POST["btnCambiarEstadoPed"])) {
	    		
	    		$this->mdlModel->__SET("id_estado", $_POST["estadoMod"]);
	    		$this->mdlModel->__SET("id_pedido", $_POST["id_pedidoMod"]);


	    		if ($this->mdlModel->modificarEstadoPedido()) {

	    		$msgModEstadoPedido = "alert('Estado modificado'); location.href=uri+'pedido/consPedido'";

	    			// $msgModEstadoPedido = "Lobibox.alert('success', {msg: 'Estado modificado'}); location.href=uri+'pedido/consPedido'";

	    		}else{
	    			$msgModEstadoPedido = "alert('Error al cambiar el estado')";
	    		}
	    	}

	    	$pedidos = $this->mdlModel->getPedidos();

	        require APP . 'view/_templates/header.php';
	        require APP . 'view/pedido/consPedido.php';
	        require APP . 'view/_templates/footer.php';

	    }
	}
?>