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
		private $db;

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
	        $sql = " CALL SP_ConsultarPedidos";
	        $query = $this->db->prepare($sql);
	        $query->execute();
	        return $query->fetchAll();
	    }

	    public function regPedido()
	    {
	        $sql = "INSERT INTO tbl_pedidos VALUES (NULL, ?, ?, ?, ?, ?)";
	        $query = $this->db->prepare($sql);
	        $query->bindParam(1, $this->id_estado);
	        $query->bindParam(2, $this->fecha_registro);
	        $query->bindParam(3, $this->fecha_entrega);
	        $query->bindParam(4, $this->vlr_total);
	        $query->bindParam(5, $this->id_cliente);
	        return $query->execute();
	    }

	    public function getClientes(){

	    	$sql = "SELECT Num_Documento, Nombre, Telefono, Email FROM tbl_persona WHERE Id_Tipo = 2";
	        $query = $this->db->prepare($sql);
	        $query->execute();
	        return $query->fetchAll();
	    }

	   	public function ultimoPedido(){

	    	$sql = "CALL SP_UltimoPedido";
	    	$query = $this->db->prepare($sql);
	        $query->execute();
	        return $query->fetch();
	    }

	    public function regFichasAsociadas(){

      		$sql = "INSERT INTO tbl_pedidos_fichastecnicas VALUES (?,?)";
      		$query = $this->db->prepare($sql);
      		$query->bindParam(1, $this->id_pedido);
      		$query->bindParam(2, $this->id_ficha);
      		$query->execute();
      		return $query;
      	}

      	public function editPedidos(){

      		$sql = "UPDATE tbl_pedidos SET Fecha_Entrega = ? , Valor_Total = ? WHERE Id_Pedido = ?";
      		$query = $this->db->prepare($sql);
      		$query->bindParam(1, $this->fecha_entrega);
      		$query->bindParam(2, $this->vlr_total);
      		$query->bindParam(3, $this->id_pedido);
      		$query->execute();
      		return $query;
      	}    

      	public function modificarEstadoPedido(){

      		$sql = "UPDATE tbl_pedidos SET Id_Estado = ? WHERE Id_Pedido = ?";
      		$query = $this->db->prepare($sql);
      		$query->bindParam(1, $this->id_estado);
      		$query->bindParam(2, $this->id_pedido);
      		$query->execute();
      		return $query;
      	}

      	public function getFichasHabilitadas(){

      		$sql = "SELECT f.Referencia, f.Fecha_Registro, f.Estado, f.Color, p.Stock_Minimo, f.Valor_Produccion, p.Valor_Producto FROM tbl_fichas_tecnicas f JOIN tbl_productos p ON f.Referencia = p.Referencia WHERE f.Estado = 1 ORDER BY f.Fecha_Registro DESC";
      		$query = $this->db->prepare($sql);
	        $query->execute();
	        return $query->fetchAll();
      	}
	}

?>