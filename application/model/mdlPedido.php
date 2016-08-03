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
	        $sql = " CALL SP_ConsPedidos";
	        $query = $this->db->prepare($sql);
	        $query->execute();
	        return $query->fetchAll();
	    }

	    public function regPedido()
	    {
	        $sql = "INSERT INTO tbl_solicitudes VALUES (NULL, ?, ?, ?, ?)";
	        $query = $this->db->prepare($sql);
	        $query->bindParam(1, $this->id_cliente);
	        $query->bindParam(2, $this->id_estado);
	        $query->bindParam(3, $this->fecha_registro);
	        $query->bindParam(4, $this->vlr_total);
	        return $query->execute();
	    }

	    // public function getFichasHabilitadas(){

	    // 	$sql = "CALL SP_ListarFichasParaAsociar";
	    // 	$query = $this->db->prepare($sql);
	    //     $query->execute();
	    //     return $query->fetchAll();
	    // }

	    public function getClientes(){

	    	$sql = "SELECT Num_Documento, Nombre, Telefono, Email FROM tbl_persona WHERE Id_Tipo = 2 and Estado = 1";
	        $query = $this->db->prepare($sql);
	        $query->execute();
	        return $query->fetchAll();
	    }

	   	public function ultimoPedido(){

	    	$sql = "CALL SP_UltimoPedidoRegistrado";
	    	$query = $this->db->prepare($sql);
	        $query->execute();
	        return $query->fetch();
	    }

	    public function regTipoSolicitud(){

	    	$sql = "INSERT INTO tbl_solicitudes_tipo VALUES (NULL, ?, ?, ?)";
	    	$query = $this->db->prepare($sql);
	    	$query->bindParam(1, $this->id_pedido);
	    	$query->bindParam(2, $this->id_tipoSolicitud);
	    	$query->bindParam(3, $this->fecha_entrega);
	    	$query->execute();
	    	return $query;
	    }

	    public function ultimoIdTipoSolicitud(){

	    	$sql = "CALL SP_UltimoIdTipoSolicitud";
	    	$query = $this->db->prepare($sql);
	        $query->execute();
	        return $query->fetch();
	    }

	    public function regFichasAsociadas(){

      		$sql = "INSERT INTO tbl_solicitudes_producto VALUES (NULL,?,?,?,?,?,?)";
      		$query = $this->db->prepare($sql);
      		$query->bindParam(1, $this->id_solicitudes_tipo);
      		$query->bindParam(2, $this->id_ficha);
      		$query->bindParam(3, $this->cant_existencias);
      		$query->bindParam(4, $this->estado);
      		$query->bindParam(5, $this->cant_producir);
      		$query->bindParam(6, $this->subtotal);
      		$query->execute();
      		return $query;
      	}

      	public function editPedidos(){

      		// $sql = "UPDATE tbl_solicitudes s JOIN tbl_solicitudes_tipo st ON s.Id_Solicitud = st.Id_Solicitud SET st.Fecha_Entrega = ?, s.Valor_Total = ?, s.Id_Estado = ? WHERE st.Id_Solicitud = ?";

      		$sql = "UPDATE tbl_solicitudes s JOIN tbl_solicitudes_tipo st ON s.Id_Solicitud = st.Id_Solicitud SET st.Fecha_Entrega = ?, s.Valor_Total = ?, s.Num_Documento = ? s.Id_Estado = ? WHERE st.Id_Solicitud = ?";

      		$query = $this->db->prepare($sql);
      		$query->bindParam(1, $this->fecha_entrega);
      		$query->bindParam(2, $this->vlr_total);
      		$query->bindParam(3, $this->id_cliente);
      		$query->bindParam(4, $this->id_estado);
      		$query->bindParam(5, $this->id_pedido);
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

      		$sql = "SELECT f.Referencia, f.Estado, c.Codigo_Color, f.Fecha_Registro, p.Stock_Minimo, f.Valor_Produccion, p.Valor_Producto FROM tbl_fichas_tecnicas f JOIN tbl_productos p ON f.Referencia = p.Referencia JOIN tbl_colores c ON f.Id_Color = c.Id_Color WHERE f.Estado = 1 ORDER BY f.Fecha_Registro DESC";
      		
      		$query = $this->db->prepare($sql);
	        $query->execute();
	        return $query->fetchAll();
      	}

      	public function cargarProductosAsoPed(){
      		$sql = "SELECT sp.Id_Producto, c.Codigo_Color, p.Valor_Producto, sp.Cantidad_Producir, sp.Subtotal FROM tbl_solicitudes s JOIN tbl_solicitudes_tipo st ON s.Id_Solicitud = st.Id_Solicitud JOIN tbl_solicitudes_producto sp ON st.Id_Solicitudes_Tipo = sp.Id_Solicitudes_Tipo JOIN tbl_productos p ON sp.Id_Producto=p.Referencia JOIN tbl_fichas_tecnicas ft ON p.Referencia=ft.Referencia JOIN tbl_colores c ON ft.Id_Color=c.Id_Color WHERE s.Id_Solicitud = ?";
      		$query = $this->db->prepare($sql);
      		$query->bindParam(1, $this->id_cliente);
	        $query->execute();
	        return $query->fetchAll();
      	}

      	//eliminar las asociaciones de productos de un pedido.
      	public function eliminarAsoFichasPedido(){

      		$sql = "DELETE FROM tbl_solicitudes_producto WHERE Id_Solicitudes_Tipo = ?";
      		$query = $this->db->prepare($sql);
      		$query->bindParam(1, $this->id_solicitudes_tipo);
      		$query->execute();
      		return $query;
      	}

      	public function traerIdSolTipo(){

      		$sql = "SELECT Id_Solicitudes_Tipo FROM tbl_solicitudes_tipo WHERE Id_Solicitud = ?";
      		
      		$query = $this->db->prepare($sql);
      		$query->bindParam(1, $this->id_pedido);
	        $query->execute();
	        return $query->fetch();
      	}

      	public function cancelPedido(){

      		$sql = "UPDATE tbl_solicitudes SET Id_Estado = ? WHERE Id_Solicitud = ?";
      		$query = $this->db->prepare($sql);
      		$query->bindParam(1, $this->id_estado);
      		$query->bindParam(2, $this->id_pedido);
      		$query->execute();
      		return $query;


      	}
	}

?>