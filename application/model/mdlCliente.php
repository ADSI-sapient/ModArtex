<?php 
class mdlCliente
{
		private $Tipo_Documento;
		private $Num_Documento;
		private $Estado = 1;
		private $Nombre;
		private $Epellido;
		private $Email;
		private $Rol;
		private $db;
		private $Id_Tipo = 2;
		private $Telefono;
		private $Direccion;
		private $infoAdicional;

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

	    public function regCliente()
	    {
	        $sql = "CALL SP_RegPersona(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	        try {
	        	$query = $this->db->prepare($sql);
	        
	        	$query->bindParam(1, $this->Id_Tipo);
	        	$query->bindParam(2, $this->Tipo_Documento);
	        	$query->bindParam(3, $this->Nombre);
	        	$query->bindParam(4, $this->Apellido);
	        	$query->bindParam(5, $this->Estado);
	        	$query->bindParam(6, $this->Telefono);
	        	$query->bindParam(7, $this->Direccion);
	        	$query->bindParam(8, $this->Email);
	        	$query->bindParam(9, $this->Num_Documento);
	        	$query->bindParam(10, $this->infoAdicional);
	    
	        	return $query->execute();
	        } catch (PDOException $e) {    	
	        }
	    }
	        
	    public function getCliente()
	    {
	        	$sql= "CALL SP_ListarClientes";

      		try{
      			$query = $this->db->prepare($sql);
      			$query->execute();
      			return $query->fetchAll();
      		} catch (PDOException $e){
      		}
	    }
	
	    public function ValidarExistenciaD(){
		$sql= "CALL SP_ValidarD(?)";
		try{
			$query= $this->db->prepare($sql);
			$query->bindParam(1, $this->Num_Documento);
			$query->execute();
				return $query->fetchAll();
		}catch (PDOException $e){
		}
	}

		public function validarExistenciaE(){
		$sql= "CALL SP_ValidarE(?)";
		try {
			$query= $this->db->prepare($sql);
			$query->bindParam(1, $this->Email);
			$query->execute();
				return $query->fetchAll();
		} catch (Exception $e) {
		}
	}

	        public function cambiarEstado(){
	        $sql = "CALL SP_CambiarEstadoP(?, ?)";

	        try{
	          $query = $this->db->prepare($sql);
	          $query->bindParam(1, $this->Estado);
	          $query->bindParam(2, $this->Num_Documento);
	         
	        
	          return $query->execute();

	        }catch(PDOException $e){
	        	
	        }
      	}

      	  public function modificarCliente(){
	        $sql = "CALL SP_ModificarClientes(?, ?, ?, ?, ?, ?, ?)";
	      
	        try {
	        	$query = $this->db->prepare($sql);
	        	$query->bindParam(6, $this->Num_Documento);
	        	$query->bindParam(1, $this->Nombre);
	        	$query->bindParam(2, $this->Apellido);
	        	$query->bindParam(3, $this->Telefono);
	        	$query->bindParam(4, $this->Direccion);
	        	$query->bindParam(5, $this->Email);     	    
	        	$query->bindParam(7, $this->infoAdicional);	        	    
	        	return $query->execute();

	        } catch (PDOException $e) {
	        	
	        }
      	}

}