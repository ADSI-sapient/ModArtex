<?php 
	class mdlRoles
	{
		private $Nombre;
		private $Estado= 1;
		private $Id_Rol;
		private $Id_Permisos;
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

	    public function getAsoPermisos(){

      		$sql = "CALL SP_AsociarPermisos";

      		$query = $this->db->prepare($sql);
      		$query->execute();
      		return $query->fetchAll();
      	}

	    public function regRoles()
	    {
	        $sql = "CALL SP_RegRoles(?, ?)";
	        try {
	        	$query = $this->db->prepare($sql);
	        	$query->bindParam(1, $this->Nombre);
	        	$query->bindParam(2, $this->Estado);
	        	return $query->execute();
	        } catch (PDOException $e) {    	
	        }
	    }

	   	public function ultimoRol(){

	    	$sql = "CALL SP_UltimoRol";
	    	$query = $this->db->prepare($sql);
	        $query->execute();
	        return $query->fetch();
	    }


      public function RegPermisosAsociados()
	    {
	        $sql = "CALL SP_RegPermisos(?, ?)";
	        try {
	        	$query = $this->db->prepare($sql);
	        	$query->bindParam(1, $this->Id_Rol);
	        	$query->bindParam(2, $this->Id_Permiso);
	        	return $query->execute();
	        } catch (PDOException $e) {    	
	        }
	    }

	       public function getRoles()
	    {
	        $sql = 'CALL SP_ListarRoles';
	        try {
	        	$query = $this->db->prepare($sql);
	        	$query->execute();
	        	return $query->fetchAll();
	        } catch (PDOException $e) {
	   
	        }
	    }

	    public function ListarPermisos(){
	    	$sql = 'CALL SP_ListarPermisos(?)';
	        try {
	        	$query = $this->db->prepare($sql);
	        	$query->bindParam(1, $this->Id_Rol);
	        	$query->execute();
	        	return $query->fetchAll();
	        } catch (PDOException $e) {
	   
	        }
	    }

	    public function cambiarEstadoRoles(){
	    	$sql = "CALL SP_CambiarEstadoR(?, ?)";

	        try{
	          $query = $this->db->prepare($sql);
	          $query->bindParam(1, $this->Estado);
	          $query->bindParam(2, $this->Id_Rol);
	         
	        
	          return $query->execute();

	        }catch(PDOException $e){
	        	
	        }
	    }

	    public function BorrarPermisos(){
	    $sql = "CALL SP_ModificarRoles(?)";

	        try{
	          $query = $this->db->prepare($sql);
	          $query->bindParam(1, $this->Id_Rol);   
	          return $query->execute();

	        }catch(PDOException $e){
	        	
	        }
	    }

	    public function ModificarNombre(){
	    $sql = "CALL SP_ModificarNombreR(?, ?)";

	        try{
	          $query = $this->db->prepare($sql);
	          $query->bindParam(1, $this->Nombre);
	          $query->bindParam(2, $this->Id_Rol);  
	          return $query->execute();

	        }catch(PDOException $e){
	        	
	        }
	    }

	    public function ValidarExistenciaN(){
		$sql= "CALL SP_ValidarR(?)";
		try{
			$query= $this->db->prepare($sql);
			$query->bindParam(1, $this->Nombre);
			$query->execute();
				return $query->fetchAll();
		}catch (PDOException $e){
		}
	}

	    

	}
?>