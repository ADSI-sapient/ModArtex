<?php 
	class mdlObjetivos
	{
		private $Nombre;
		private $Fecha_Inicio;
		private $Fecha_Registro;
		private $Fecha_Fin;
		Private $Id_Estado= 5;

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
      		$sql= "CALL SP_RegistrarObjetivos(?, ?, ?, ?, ?)";
		try{
			$query= $this->db->prepare($sql);
			$query->bindParam(1, $this->Nombre);
			$query->bindParam(2, $this->FechaRegistro);
			$query->bindParam(3, $this->FechaInicio);
			$query->bindParam(4, $this->FechaFin);
			$query->bindParam(5, $this->Id_Estado);
			$query->execute();
				
		}catch (PDOException $e){
		}
      	}
	}
?>