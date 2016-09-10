<?php 
	class mdlObjetivos
	{
		private $Nombre;
		private $Fecha_Inicio;
		private $Fecha_Registro;
		private $Fecha_Fin;
		Private $Id_Estado= 5;
		private $Id_Objetivo;
		private $Cantidad;
		private $Id_Ficha_Tecnica;
		private $CantidadTotal;

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

	    public function getAsoFichas(){

      		$sql = "CALL SP_AsociarF";

      		$query = $this->db->prepare($sql);
      		$query->execute();
      		return $query->fetchAll();
      	}


      	public function RegistrarO(){
      		$sql= "CALL SP_RegistrarObjetivos(?, ?, ?, ?, ?, ?)";
		try{
			$query= $this->db->prepare($sql);
			$query->bindParam(1, $this->Nombre);
			$query->bindParam(2, $this->FechaRegistro);
			$query->bindParam(3, $this->FechaInicio);
			$query->bindParam(4, $this->FechaFin);
			$query->bindParam(5, $this->Id_Estado);
			$query->bindParam(6, $this->CantidadTotal);
			$query->execute();
				
		}catch (PDOException $e){
		}
      	}

      	public function ultimoObjetivo(){

	    	$sql = "CALL SP_UltimoObjetivo";
	    	$query = $this->db->prepare($sql);
	        $query->execute();
	        return $query->fetch();
	    }


      	public function RegistrarObjetivos(){
      		$sql= "CALL SP_RegProductosObje(?, ?, ?)";
		try{
			$query= $this->db->prepare($sql);
			$query->bindParam(1, $this->Id_Objetivo);
			$query->bindParam(2, $this->Cantidad);
			$query->bindParam(3, $this->Id_Ficha_Tecnica);
			$query->execute();
				
		}catch (PDOException $e){
		}
      	}

      	public function getObjetivos()
	    {
	        	$sql= "CALL SP_ListarObjetivos";

      		try{
      			$query = $this->db->prepare($sql);
      			$query->execute();
      			return $query->fetchAll();
      		} catch (PDOException $e){
      		}
	    }

	    public function ListarFichasO(){

	    	// var_dump($this->Id_Objetivo);
	    	// exit();
	    	$sql = 'CALL SP_ListarFichasObj(?)';
	        try {
	        	$query = $this->db->prepare($sql);
	        	$query->bindParam(1, $this->Id_Objetivo);
	        	$query->execute();
	        	return $query->fetchAll();
	        } catch (PDOException $e) {
	   
	        }
	    }

	     public function EliminarRegistro(){
	    $sql = "CALL SP_EliminarObjetivos(?)";

	        try{
	          $query = $this->db->prepare($sql);
	          $query->bindParam(1, $this->Id_Objetivo);   
	          return $query->execute();

	        }catch(PDOException $e){
	        	
	        }
	    }

	      public function modificarObjetivo(){
	        $sql = "CALL SP_ModifivarObjetivo(?, ?, ?, ?, ?, ?)";
	      
	        try {
	        	$query = $this->db->prepare($sql);
	        	$query->bindParam(1, $this->Nombre);
	        	$query->bindParam(2, $this->FechaRegistro);
	        	$query->bindParam(3, $this->FechaInicio);
	        	$query->bindParam(4, $this->FechaFin);
	        	$query->bindParam(5, $this->CantidadTotal);
	        	$query->bindParam(6, $this->Id_Objetivo);	        	    
	        	return $query->execute();

	        } catch (PDOException $e) {
	        	
	        }
      	}


          public function cambiarEstadoCan(){
	        $sql = "CALL SP_CancelarObjetivo(?, ?)";

	        try{
	          $query = $this->db->prepare($sql);
	          $query->bindParam(1, $this->Id_Estado);
	          $query->bindParam(2, $this->Id_Objetivo);
	         
	        
	          return $query->execute();

	        }catch(PDOException $e){
	        	
	        }
      	}




	}
?>