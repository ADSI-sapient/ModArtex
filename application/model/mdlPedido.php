<?php  

	class mdlPedido
	{
		private $fecha_registro;
		private $fecha_entrega;
		private $id_pedido;
		private $id_estado;
		private $vlr_total;
		private $id_cliente;
		private $id_ficha;
		private $id_tipoSolicitud;
		private $id_solicitudes_tipo;
		private $cant_producir;
		private $subtotal;
		private $cant_existencias;
		private $estado;
		private $cant_descontar;
		private $id_existcolinsu;
		private $db;

		private $cantidadPT;

		function __construct($db)
	    {
	        try {
	            $this->db = $db;
	        } catch (PDOException $e) {
	        	exit('No se pudo establecer la conexión a la base de datos.');
	        }
	    }

	    public function __SET($atributo, $valor){
			$this->$atributo = $valor;
		}

		public function __GET($atributo){
			return $this->$atributo;
		}

	    public function getPedidos()
	    {
	        $sql = " CALL SP_ConsPedidos()";
	        $query = $this->db->prepare($sql);
	        $query->execute();
	        return $query->fetchAll();
	    }

	    public function regPedido()
	    {
	        $sql = "CALL SP_registrarPedido(?,?,?,?)";
	        $query = $this->db->prepare($sql);
	        $query->bindParam(1, $this->id_cliente);
	        $query->bindParam(2, $this->id_estado);
	        $query->bindParam(3, $this->fecha_registro);
	        $query->bindParam(4, $this->vlr_total);
	        return $query->execute();
	    }

	    public function getClientes(){

	    	$sql = "CALL SP_consClientesHab()";
	        $query = $this->db->prepare($sql);
	        $query->execute();
	        return $query->fetchAll();
	    }

	   	public function ultimoPedido(){

	    	$sql = "CALL SP_UltimoPedidoRegistrado()";
	    	$query = $this->db->prepare($sql);
	      $query->execute();
	      return $query->fetch();
	    }

	    public function regTipoSolicitud(){

	    	$sql = "CALL SP_registrarTipoSolicitud(?,?,?)";
	    	$query = $this->db->prepare($sql);
	    	$query->bindParam(1, $this->id_pedido);
	    	$query->bindParam(2, $this->id_tipoSolicitud);
	    	$query->bindParam(3, $this->fecha_entrega);
	    	$query->execute();
	    	return $query;
	    }

	    public function ultimoIdTipoSolicitud(){

	    	$sql = "CALL SP_UltimoIdTipoSolicitud()";
	    	$query = $this->db->prepare($sql);
	      $query->execute();
	      return $query->fetch();
	    }

	    public function regFichasAsociadas()
	    {
      		$sql = "CALL SP_registrarFichasAsoPed(?,?,?,?,?,?)";
      		$query = $this->db->prepare($sql);
      		$query->bindParam(1, $this->id_solicitudes_tipo);
      		$query->bindParam(2, $this->cant_existencias);
      		$query->bindParam(3, $this->estado);
      		$query->bindParam(4, $this->cant_producir);
      		$query->bindParam(5, $this->subtotal);
      		$query->bindParam(6, $this->id_ficha);
      		$query->execute();

      		$sql2 = "UPDATE tbl_fichas_tecnicas SET Cantidad = ? WHERE Id_Ficha_Tecnica = ?";
      		$query2 = $this->db->prepare($sql2);
      		$query2->bindParam(1, $this->cantidadPT);
      		$query2->bindParam(2, $this->id_ficha);
      		$query2->execute();

      		return $query;
      	}

      	public function descExistInsumos()
      	{
      		$sql = "CALL SP_descExistenciasInsumos(?,?,?)";
      		$query = $this->db->prepare($sql);
      		$query->bindParam(1, $this->id_ficha);
      		$query->bindParam(2, $this->id_existcolinsu);
      		$query->bindParam(3, $this->cant_descontar);
      		$query->execute();
      		return $query;
      	}

      	public function editPedidos()
      	{
      		$sql ="CALL SP_EditarPedido(?,?,?,?)";
      		$query = $this->db->prepare($sql);
      		$query->bindParam(1, $this->fecha_entrega);
      		$query->bindParam(2, $this->vlr_total);
      		$query->bindParam(3, $this->id_cliente);
      		$query->bindParam(4, $this->id_pedido);
      		$query->execute();
      		return $query;
      	}    

      	// public function modificarEstadoPedido()
      	// {
      	// 	$sql = "UPDATE tbl_pedidos SET Id_Estado = ? WHERE Id_Pedido = ?";
      	// 	$query = $this->db->prepare($sql);
      	// 	$query->bindParam(1, $this->id_estado);
      	// 	$query->bindParam(2, $this->id_pedido);
      	// 	$query->execute();
      	// 	return $query;
      	// }

      	public function getFichasHabilitadas()
      	{
      		$sql = "CALL SP_consProductosHab()";

      		$query = $this->db->prepare($sql);
	            $query->execute();
	            return $query->fetchAll();
      	}

      	public function cargarProductosAsoPed(){
      		
      		$sql = "CALL SP_CargarProduAsoPed(?)";

      		$query = $this->db->prepare($sql);
      		$query->bindParam(1, $this->id_pedido);
	        $query->execute();
	        return $query->fetchAll();
      	}

      	//eliminar las asociaciones de productos que tiene un pedido.
      	public function eliminarAsoFichasPedido()
      	{
      		$sql = "CALL SP_eliminarFichasAsoPed(?)";
      		$query = $this->db->prepare($sql);
      		$query->bindParam(1, $this->id_solicitudes_tipo);
      		$query->execute();
      		return $query;
      	}

      	public function traerIdSolTipo(){

      		$sql = "CALL SP_ultimoIdSolicitudTipo(?)";
      		$query = $this->db->prepare($sql);
      		$query->bindParam(1, $this->id_pedido);
      	      $query->execute();
      	      return $query->fetch();
      	}

      	public function cancelPedido(){

      		$sql = "CALL SP_cancelarPedido(?,?)";
      		$query = $this->db->prepare($sql);
      		$query->bindParam(1, $this->id_estado);
      		$query->bindParam(2, $this->id_pedido);
      		$query->execute();
      		return $query;
      	}

      	public function validarExisteIns(){

      		$sql = "CALL SP_validarExistenciasInsu(?)";
      		$query = $this->db->prepare($sql);
      		$query->bindParam(1, $this->id_ficha);
      		$query->execute();
      		return $query->fetchAll();
      	}
	}

?>