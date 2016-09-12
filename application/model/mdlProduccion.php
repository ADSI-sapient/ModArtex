<?php
	class mdlProduccion{
		private $_db;
		private $_id_solicitud;
		private $_estado_prod;
		private $_fecha_regist;
		private $_fecha_term;
		private $_lugar_prod;
		private $_cantFab;
		private $_cantSat;
		private $_estadoFih;
		private $_lugarPrficha;
		private $_idCliente;

		//
		private $_id_solc_prod;
		private $_id_ordenProd;
		private $_estado;

		private $_id_ord_solPro;

		function __construct($db)
	    {
	        try {
	            $this->_db = $db;
	        } catch (PDOException $e) {
	        	exit('No se pudo establecer la conexión a la base de datos.');
	        }
	    }

		public function __GET($atributo){
			return $this->$atributo;
		}

		public function __SET($atributo, $valor){
			$this->$atributo = $valor;
		}

		public function consPedidosProd()
	    {
	        $sql = "CALL SP_consPedidosProduccion()";
	        $query = $this->_db->prepare($sql);
	        $query->execute();
	        return $query->fetchAll();
	    }

	    public function consProductosPedido()
	    {
	        $sql = "CALL SP_consProductosPedido()";
	        $query = $this->_db->prepare($sql);
	        $query->execute();
	        return $query->fetchAll();
	    }

	    public function regOrdenProduccion()
	    {
	    	$sql = "CALL SP_regOrdenProduccion(?,?)";
	        $query = $this->_db->prepare($sql);
	        $query->bindParam(1, $this->_estado_prod);
	        $query->bindParam(2, $this->_fecha_regist);
	        // $query->bindParam(3, $this->_lugar_prod);
	        return $query->execute();
	    }

	    public function consUltimaOrdenReg()
	    {
	    	$sql = "CALL SP_consUltimaOrden()";
	        $query = $this->_db->prepare($sql);
	        $query->execute();
	        return $query->fetch();
	    }

	    public function regSolicitudOrdenProduccion()
	    {
	    	$sql = "CALL SP_regSolcOrdenProd(?,?,?,?,?,?)";
	        $query = $this->_db->prepare($sql);
	        $query->bindParam(1, $this->_id_solc_prod);
	        $query->bindParam(2, $this->_id_ordenProd);
	        $query->bindParam(3, $this->_estadoFih);
	        $query->bindParam(4, $this->_cantFab);
	        $query->bindParam(5, $this->_cantSat);
	        $query->bindParam(6, $this->_lugarPrficha);
	        return $query->execute();
	    }

	    public function actualizarCantProducir()
	    {
	    	$sql = "CALL SP_actualizarCantidadProd(?,?,?)";
	        $query = $this->_db->prepare($sql);
	        $query->bindParam(1, $this->_id_solc_prod);
	        $query->bindParam(2, $this->_cantFab);
	        $query->bindParam(3, $this->_cantSat);
	        return $query->execute();
	    }

	    public function actualizarEstadoPed()
	    {
	    	$sql = "CALL SP_actualizarEstadoPed(?)";
	        $query = $this->_db->prepare($sql);
	        $query->bindParam(1, $this->_id_solicitud);
	        return $query->execute();
	    }

	    public function consOrdenesProd()
	    {
	        $sql = "CALL SP_consOrdenes()";
	        $query = $this->_db->prepare($sql);
	        $query->execute();
	        return $query->fetchAll();
	    }

	    public function consProductosOrden()
	    {
	        $sql = "CALL SP_consProductosOrden(?)";
	        $query = $this->_db->prepare($sql);
	        $query->bindParam(1, $this->_id_ordenProd);
	        $query->execute();
	        return $query->fetchAll();
	    }

	    public function cancelOrden(){

      		$sql = "CALL SP_cancelarOdenPr(?)";
      		$query = $this->_db->prepare($sql);
      		$query->bindParam(1, $this->_id_ordenProd);
      		$query->execute();
      		return $query;
      	}

      	public function actualizarFechaEntregaPd(){

      		$sql = "CALL SP_actualiarFechaEntPedi(?, ?)";
      		$query = $this->_db->prepare($sql);
      		$query->bindParam(1, $this->_fecha_term);
      		$query->bindParam(2, $this->_id_solicitud);
      		$query->execute();
      		return $query;
      	}

      	public function editOrdenes()
	    {
	    	$sql = "CALL SP_editarOrdenProduccion(?,?)";
	        $query = $this->_db->prepare($sql);
	        // $query->bindParam(1, $this->_estado_prod);
	        $query->bindParam(1, $this->_fecha_term);
	        // $query->bindParam(2, $this->_lugar_prod);
	        $query->bindParam(2, $this->_id_ordenProd);
	        return $query->execute();
	    }

	    public function elimnarSolicitudesOrdenes(){

      		$sql = "CALL SP_eliminarSolicOrdenes(?)";
      		$query = $this->_db->prepare($sql);
      		$query->bindParam(1, $this->_id_ordenProd);
      		$query->execute();
      		return $query;
      	}

      	public function getPedidosCliente(){

      		$sql = "CALL SP_consPedidosCliente()";
      		$query = $this->_db->prepare($sql);
      		$query->execute();
      		return $query->fetchAll();
      	}

      	public function consPedidosCliente(){

      		$sql = "CALL SP_consPedidoCliente(?)";
      		$query = $this->_db->prepare($sql);
      		$query->bindParam(1, $this->_id_solicitud);
      		$query->execute();
      		return $query->fetch();
      	}

      	public function cambiarEstadoOrden(){
      		$sql = "CALL SP_CambiarEstadoOrden(?, ?)";
      		$query = $this->_db->prepare($sql);
      		$query->bindParam(1, $this->_id_ordenProd);
      		$query->bindParam(2, $this->_estado);
      		return $query->execute();
      	}

      	public function cambiarEstadoOrdenSol(){
      		$sql = "CALL SP_CambiarEstadoOrdenSol(?, ?)";
      		$query = $this->_db->prepare($sql);
      		$query->bindParam(1, $this->_id_ord_solPro);
      		$query->bindParam(2, $this->_estado);
      		return $query->execute();
      	}
	}