<?php 
class mdlProductoT
{
		private $Referencia;
		private $Nombre;
		private $Color;
		private $Talla;
		private $Cantidad;
		private $Valor_Produccion;
		private $Stock_Minimo;
		private $Id_Ficha_Tallas;


	public function __SET($atributo, $valor){
		$this->$atributo = $valor;
	}

	public function __GET($atributo){
		return $this->atributo;
	}

	function __construct($db)
	{
	    try {
	        $this->db = $db;
	    } catch (PDOException $e) {
	        exit('No se pudo establecer la conexión a la base de datos.');
	    }
	}

	  
	        
	    public function getProducto()
	    {
	        	$sql= "CALL SP_ListarProductoT";

      		try{
      			$query = $this->db->prepare($sql);
      			$query->execute();
      			return $query->fetchAll();
      		} catch (PDOException $e){
      		}
	    }

	    public function descontar(){
	    	$sql= "CALL SP_DescontarP(?, ?, ?)";

	    	try{
      			$query = $this->db->prepare($sql);
      			$query->bindParam(1, $this->Cantidad);
      			$query->bindParam(2, $this->Id_Ficha_Tallas);
      			$query->bindParam(3, $this->salida);
      			return $query->execute();
      		} catch (PDOException $e){
      		}
	    }
	   
	    public function RegistrarS(){
 			$sql= "CALL SP_RegistrarS(?, ?)";

	    	 try{
      			$query = $this->db->prepare($sql);
      			$query->bindParam(1, $this->descripcion);
      			$query->bindParam(2, $this->Fecha_Salida);
      			return $query->execute();
      		} catch (PDOException $e){
      		}
	    
	    }

	      	public function ultimaSalida(){

	    	$sql = "CALL SP_UltimaSalida";
	    	$query = $this->db->prepare($sql);
	        $query->execute();
	        return $query->fetch();
	    }


	     public function RegistrarSP(){
 			$sql= "CALL SP_RegistrarSPro(?, ?, ?)";

	    	 try{
      			$query = $this->db->prepare($sql);
      			$query->bindParam(1, $this->Id_Salida);
      			$query->bindParam(2, $this->salida);
      			$query->bindParam(3, $this->Id_Ficha_Tallas);
      			return $query->execute();
      		} catch (PDOException $e){
      		}
	    
	    }

      	
}