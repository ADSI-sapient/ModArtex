<?php
	class mdlProduccion{
		private $_db;
		private $_id_solicitud;

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

	}