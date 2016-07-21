<?php 
	class mdlUsuario
	{
		private $tipo_documento;
		private $documento;
		private $estado;
		private $nombre;
		private $apellido;
		private $nombre_usuario;
		private $clave;
		private $email;
		private $rol;
		private $codigo;
		private $db;

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

	    public function regUsuario()
	    {
	        $sql = "CALL SP_RegPersona( ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	        try {
	        	$query = $this->db->prepare($sql);
	        	
	        	$query->bindParam(1, $this->Num_Documento);
	        	$query->bindParam(2, $this->Id_Tipo);
	        	$query->bindParam(3, $this->Tipo_Documento);
	        	$query->bindParam(4, $this->Nombre);
	        	$query->bindParam(5, $this->Apellido);
	        	$query->bindParam(6, $this->Estado);
	        	$query->bindParam(7, $this->Telefono);
	        	$query->bindParam(8, $this->Direccion);
	        	$query->bindParam(9, $this->Email);
	        
	    
	        	return $query->execute();
	        } catch (PDOException $e) {
	        	
	        }

	       $sql= "SP_RegUsuario (?, ?, ?, ?)";
	       try{
	       	$query= $this->db->prepare($sql);
	       	$query->bindParam(1, $this->Num_Documento);
	       	$query->bindParam(2, $this->Tbl_Roles_Id_Rol);
	       	$query->bindParam(3, $this->Usuario);
	       	$query->bindParam(4, $this->Clave);
	       	return $query->execute();
	       }catch (PDOException $e){

	       }
	    }
	    	//Validar existencia del documento
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

	//Validar existencia del nombre de usuario
	// public function validarExistenciaU(){
	// 	$sql= "CALL SP_ValidarU(?)";
	// 	try {
	// 		$query= $this->db->prepare($sql);
	// 		$query->bindParam(1, $this->nombre_usuario);
	// 		$query->execute();
	// 			return $query->fetchAll();
	// 	} catch (Exception $e) {
	// 	}
	// }

	//Validar existencia del email
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
	        
	    public function getUsuario()
	    {
	        $sql = 'CALL SP_Listar';

	        try {
	        	$query = $this->db->prepare($sql);
	        	$query->execute();
	        	return $query->fetchAll();
	        } catch (PDOException $e) {
	   
	        }
	    }


	    public function modificarUsuario(){
	        $sql = "UPDATE usuario SET  nombre = ?, apellido = ?, nombre_Usuario = ?, email = ?, Id_rol = ? WHERE codigo = ?";

	      
	        try {
	        	$query = $this->db->prepare($sql);
	        	// $query->bindParam(1, $this->tipo_documento);
	        	// $query->bindParam(2, $this->documento);
	        	$query->bindParam(1, $this->nombre);
	        	$query->bindParam(2, $this->apellido);
	        	$query->bindParam(3, $this->nombre_usuario);
	        	$query->bindParam(4, $this->email);
	        	$query->bindParam(5, $this->rol);
	        	$query->bindParam(6, $this->codigo);

	    
	        	return $query->execute();

	        } catch (PDOException $e) {
	        	
	        }
      	}

      	public function consultarRol(){
      		$sql= "CALL SP_consultarRoles";

      		try{
      			$query = $this->db->prepare($sql);
      			$query->execute();
      			return $query->fetchAll();
      		} catch (PDOException $e){

      		}
      	}


          	public function cambiarEstado(){
	        $sql = "CALL SP_CambiarEstadoU(?, ?)";

	        try{
	          $query = $this->db->prepare($sql);
	          $query->bindParam(1, $this->codigo);
	          $query->bindParam(2, $this->estado);
	        
	          return $query->execute();

	        }catch(PDOException $e){
	        	
	        }
      	}

	}
?>