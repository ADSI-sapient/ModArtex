<?php 
	class mdlUsuario
	{
		private $Tipo_Documento;
		private $Num_Documento;
		private $Estado = 1;
		private $Nombre;
		private $Epellido;
		private $Usuario;
		private $Clave;
		private $Email;
		private $Rol;
		private $db;
		private $Id_Tipo = 1;
		private $Telefono;
		private $Direccion;
		private $Tbl_Roles_Id_Rol;


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
	        $sql = "CALL SP_RegPersona(?, ?, ?, ?, ?, ?, ?, ?, ?)";
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
	    
	        	return $query->execute();
	        } catch (PDOException $e) {    	
	        }
	    }

	    public function registroUsuario(){

	       $sql= "CALL SP_RegUsuario (?, ?, ?, ?)";

	       try{
	       	$query= $this->db->prepare($sql);
	       	$query->bindParam(4, $this->Num_Documento);
	       	$query->bindParam(1, $this->Tbl_Roles_Id_Rol);
	       	$query->bindParam(2, $this->Usuario);
	       	$query->bindParam(3, $this->Clave);
	       	return $query->execute();
	       }catch (PDOException $e){
	       }
	    	//Validar existencia del documento
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

	// //Validar existencia del nombre de usuario
	// public function validarExistenciaU(){
	// 	$sql= "CALL SP_ValidarU(?)";
	// 	try {
	// 		$query= $this->db->prepare($sql);
	// 		$query->bindParam(1, $this->Usuario);
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
	        $sql = 'CALL SP_ListarUsuarios';
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
      		$sql= "CALL SP_ConsultarRoles";

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