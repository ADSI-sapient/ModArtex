<?php 
	class mdlFicha
	{
		private $referencia;
		private $fecha_reg;
		private $estado;
		private $color;
		private $id_talla;
		private $stock_min;
		private $valor_produccion;
		private $valor_producto;
		private $id_insumo;
		private $cant_necesaria;
		private $valor_insumo;
		private $nombreInsumo;
		private $db;

		public function __SET($atributo, $valor){
			$this->$atributo = $valor;
		}

		public function __GET($atributo){
			return $this->$atributo;
		}

		function __construct($db)
	    {
	        try {
	            $this->db = $db;
	        } catch (PDOException $e) {
	        	exit('No se pudo establecer la conexión a la base de datos.');
	        }
	    }

	    public function regFicha()
	    {
	        $sql = "INSERT INTO tbl_fichas_tecnicas VALUES (?, ?, ?, ?, ?, ?, ?)";

	        try {
	        	$query = $this->db->prepare($sql);
	        	$query->bindParam(1, $this->referencia);
	        	$query->bindParam(2, $this->fecha_reg);
	        	$query->bindParam(3, $this->estado);
	        	$query->bindParam(4, $this->color);
	        	$query->bindParam(5, $this->stock_min);
	        	$query->bindParam(6, $this->valor_produccion);
	        	$query->bindParam(7, $this->valor_producto);

	        	return $query->execute();

	        } catch (PDOException $e) {
	        	
	        }
	    }

	    public function validarReferencia(){

	    	$sql = "CALL SP_ValidarReferencia(?)";
	    	$query = $this->db->prepare($sql);
	    	$query->bindParam(1, $this->referencia);
	    	$query->execute();
	    	return $query->fetch();
	    }

	    public function ultimaFicha(){

	    	$sql = "CALL SP_UltimaFicha";
	    	$query = $this->db->prepare($sql);
	        $query->execute();
	        return $query->fetch();
	    }
	    
      	public function regInsumosAso(){

      		$sql = "INSERT INTO tbl_insumos_fichastecnicas VALUES (?,?,?,?)";
      		$query = $this->db->prepare($sql);
      		$query->bindParam(1, $this->id_insumo);
      		$query->bindParam(2, $this->referencia);
      		$query->bindParam(3, $this->cant_necesaria);
      		$query->bindParam(4, $this->valor_insumo);
      		$query->execute();
      		return $query;
      	}

      	public function regTallasAso(){

      		$sql = "INSERT INTO tbl_fichastecnicas_tallas VALUES (?,?)";
      		$query = $this->db->prepare($sql);
      		$query->bindParam(1, $this->referencia);
      		$query->bindParam(2, $this->id_talla);
      		$query->execute();
      		return $query;
      	}

	    public function getFichas()
	    {
	        $sql = "SELECT Referencia, Fecha_Registro, Estado, Color, Stock_Minimo, Valor_Produccion, Valor_Producto FROM tbl_fichas_tecnicas ORDER BY Fecha_Registro DESC";

	        try {
	        	$query = $this->db->prepare($sql);
	        	$query->execute();
	        	return $query->fetchAll();
	        } catch (PDOException $e) {
	   
	        }
	    }

	    public function insumosAsociadosFicha(){

	    	$sql = "CALL SP_InsumosAsoFicha(?)";

	        try {
	        	$query = $this->db->prepare($sql);
	        	$query->bindParam(1, $this->referencia);
	        	$query->execute();
	        	return $query->fetchAll();
	        } catch (PDOException $e) {
	   
	        }
	    }

	   	public function tallasAsociadasFicha(){

	    	$sql = "CALL SP_TallasAsoFicha(?)";

	        try {
	        	$query = $this->db->prepare($sql);
	        	$query->bindParam(1, $this->referencia);
	        	$query->execute();
	        	return $query->fetchAll();
	        } catch (PDOException $e) {
	   
	        }
	    }

	    public function insertarInsumoAsoFicha(){

	    	$sql = "CALL SP_InsertarInsumoAso(?, ?)";

	        try {
	        	$query = $this->db->prepare($sql);
	        	$query->bindParam(1, $this->id_insumo);
	        	$query->bindParam(2, $this->referencia);
	        	$query->execute();
	        	return $query;
	        } catch (PDOException $e) {
	   
	        }

	    }

	    // public function insertarTallaAsoFicha(){

	    // 	$sql = "CALL SP_InsertarTallaAso(?, ?)";

	    //     try {
	    //     	$query = $this->db->prepare($sql);
	    //     	$query->bindParam(1, $this->id_talla);
	    //     	$query->bindParam(2, $this->referencia);
	    //     	$query->execute();
	    //     	return $query;
	    //     } catch (PDOException $e) {
	   
	    //     }

	    // }

	    public function eliminarInsumoAsoFicha(){

	    	$sql = "CALL SP_DeleteInsumosAso(?)";

	        try {
	        	$query = $this->db->prepare($sql);
	        	$query->bindParam(1, $this->referencia);
	        	$query->execute();
	        	return $query;
	        } catch (PDOException $e) {
	   
	        }
	    }

	    public function eliminarTallaAsoFicha(){

	    	$sql = "CALL SP_DeleteTallasAso(?)";

	        try {
	        	$query = $this->db->prepare($sql);
	        	$query->bindParam(1, $this->referencia);
	        	$query->execute();
	        	return $query;
	        } catch (PDOException $e) {
	   
	        }
	    }

	    public function modificarFicha(){
	    	
	        $sql = "UPDATE tbl_fichas_tecnicas SET Color = ?, Stock_Minimo = ?, Valor_Produccion = ?, Valor_Producto = ? WHERE Referencia = ?";

	        try{
	          $query = $this->db->prepare($sql);
	        	$query->bindParam(1, $this->color);
	        	$query->bindParam(2, $this->stock_min);
	        	$query->bindParam(3, $this->valor_produccion);
	        	$query->bindParam(4, $this->valor_producto);
	        	$query->bindParam(5, $this->referencia);

	          return $query->execute();

	        }catch(PDOException $e){
	        	
	        }
      	}

      	public function cambiarEstado(){
      		
	        $sql = "CALL SP_CambiarEstadoFicha(?, ?)";

	        try{
	          $query = $this->db->prepare($sql);
	          $query->bindParam(1, $this->referencia);
	          $query->bindParam(2, $this->estado);
	        
	          return $query->execute();

	        }catch(PDOException $e){
	        	
	        }
      	}

      	public function getAsoInsumos(){

      		$sql = "SELECT Id_Insumo, Id_Medida, Nombre, Cantidad, Valor FROM tbl_insumos";

      		$query = $this->db->prepare($sql);
      		$query->execute();
      		return $query->fetchAll();
      	}

      	public function getAsoTallas(){

      		$sql = "SELECT Id_Talla, Nombre FROM tbl_tallas";

      		$query = $this->db->prepare($sql);
      		$query->execute();
      		return $query->fetchAll();
      	}

	}
?>