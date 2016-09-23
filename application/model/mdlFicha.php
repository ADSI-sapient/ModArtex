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
		private $cantidad;
		private $id_insumo;
		private $cant_necesaria;
		private $valor_insumo;
		private $nombreInsumo;
		private $id_fichaT;
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
	        $sql = "CALL SP_regFichaTecnica(?,?,?,?,?,?,?,?)";
	        try {
	        	$query = $this->db->prepare($sql);
	        	$query->bindParam(1, $this->referencia);
	        	$query->bindParam(2, $this->color);
	        	$query->bindParam(3, $this->fecha_reg);
	        	$query->bindParam(4, $this->estado);
	        	$query->bindParam(5, $this->valor_produccion);
	        	$query->bindParam(6, $this->cantidad);
	        	$query->bindParam(7, $this->stock_min);
	        	$query->bindParam(8, $this->valor_producto);
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
      		$sql = "CALL SP_regInsumosAsoF(?,?,?,?)";
      		$query = $this->db->prepare($sql);
      		$query->bindParam(1, $this->id_insumo);
      		$query->bindParam(2, $this->cant_necesaria);
      		$query->bindParam(3, $this->valor_insumo);
      		$query->bindParam(4, $this->id_fichaT);
      		$query->execute();
      		return $query;
      	}

      	public function regTallasAso(){
      		$sql = "CALL SP_RegTallasAsociadas(?,?)";
      		$query = $this->db->prepare($sql);
      		$query->bindParam(1, $this->id_talla);
      		$query->bindParam(2, $this->id_fichaT);
      		$query->execute();
      		return $query;
      	}
	    public function getFichas()
	    {
	        $sql = "CALL SP_ListarFichasTecnicas";
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
	        	$query->bindParam(1, $this->id_fichaT);
	        	$query->execute();
	        	return $query->fetchAll();
	        } catch (PDOException $e) {
	   
	        }
	    }
	   	public function tallasAsociadasFicha(){
	    	$sql = "CALL SP_ConsTallasAsoFicha(?)";
	        try {
	        	$query = $this->db->prepare($sql);
	        	$query->bindParam(1, $this->id_fichaT);
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

	    public function eliminarInsumoAsoFicha(){
	    	$sql = "CALL SP_DeleteInsumosAso(?)";
	        try {
	        	$query = $this->db->prepare($sql);
	        	$query->bindParam(1, $this->id_fichaT);
	        	$query->execute();
	        	return $query;
	        } catch (PDOException $e) {
	   
	        }
	    }
	    public function eliminarTallaAsoFicha(){
	    	$sql = "CALL SP_DeleteTallasAso(?)";
	        try {
	        	$query = $this->db->prepare($sql);
	        	$query->bindParam(1, $this->id_fichaT);
	        	$query->execute();
	        	return $query;
	        } catch (PDOException $e) {
	   
	        }
	    }

	    public function modificarFicha(){
	    	
	        $sql = "CALL SP_modificarFicha(?,?,?,?,?)";

	        try{
	          $query = $this->db->prepare($sql);
	        	$query->bindParam(1, $this->color);
	        	$query->bindParam(2, $this->valor_produccion);
	        	$query->bindParam(3, $this->stock_min);
	        	$query->bindParam(4, $this->valor_producto);
	        	$query->bindParam(5, $this->id_fichaT);
	          return $query->execute();
	        }catch(PDOException $e){
	        	
	        }
      	}
      	public function cambiarEstadoFicha(){
      		
	        $sql = "CALL SP_CambiarEstadoFicha(?,?)";
	        try{
	          $query = $this->db->prepare($sql);
	          $query->bindParam(1, $this->id_fichaT);
	          $query->bindParam(2, $this->estado);
	        
	          return $query->execute();
	        }catch(PDOException $e){
	        	
	        }
      	}

      	public function getAsoInsumos(){
      		$sql = "CALL SP_getAsoInsumos";
      		$query = $this->db->prepare($sql);
      		$query->execute();
      		return $query->fetchAll();
      	}

      	public function consInsumosRegFicha(){
      		$sql = "CALL SP_consInsumosRegFicha";
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
      	public function consColoresFicha(){
      		$sql = "SELECT * FROM tbl_colores";
      		$query = $this->db->prepare($sql);
      		$query->execute();
      		return $query->fetchAll();
      	}
      	public function validColorFichaReg(){
      		$sql = "CALL SP_validColorFichaReg(?,?)";
      		$query = $this->db->prepare($sql);
      		$query->bindParam(1, $this->referencia);
	        $query->bindParam(2, $this->color);
      		$query->execute();
      		return $query->fetchAll();
      	}
      	public function consColorFicha(){
      		$sql = "CALL SP_consColorFicha(?)";
      		$query = $this->db->prepare($sql);
      		$query->bindParam(1, $this->id_fichaT);
      		$query->execute();
      		return $query->fetch();
      	}
      	public function validColorFichaMod(){
      		$sql = "CALL SP_validColorFichaMod(?)";
      		$query = $this->db->prepare($sql);
      		$query->bindParam(1, $this->id_fichaT);
      		$query->execute();
      		return $query->fetchAll();
      	}
	}
?>