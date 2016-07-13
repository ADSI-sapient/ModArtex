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
	        $sql = "INSERT INTO usuario VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

	        try {
	        	$query = $this->db->prepare($sql);
	        	$query->bindParam(1, $this->tipo_documento);
	        	$query->bindParam(2, $this->documento);
	        	$query->bindParam(3, $this->estado);
	        	$query->bindParam(4, $this->nombre);
	        	$query->bindParam(5, $this->apellido);
	        	$query->bindParam(6, $this->nombre_usuario);
	        	$query->bindParam(7, $this->clave);
	        	$query->bindParam(8, $this->email);
	        	$query->bindParam(9, $this->codigo);
	        	$query->bindParam(10, $this->rol);

	    
	        	return $query->execute();

	        } catch (PDOException $e) {
	        	
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