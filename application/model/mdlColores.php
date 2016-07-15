<?php
	class mdlColores{
		private $_id;
		private $_codigo;
		private $_nombre;
		private $_db;


		function __construct($db){
			try {
				$this->_db = $db;
			} catch (PDOException $e) {
				exit('No se pudo establecer la conexión a la base de datos.');
			}
		}

		public function __SET($atributo, $valor){
			$this->$atributo = $valor;
		}

		public function __GET($atributo){
			return $this->$atributo;
		}

		public function listar(){
			$sql = "CALL SP_listarColores";
			$stm = $this->_db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function registrar(){
			$sql = "CALL SP_registrarColores(?, ?)";
			$stm = $this->_db->prepare($sql);
			$stm->bindParam(1, $this->_codigo);
			$stm->bindParam(2, $this->_nombre);
			return $stm->execute();
		}


		public function eliminar(){
			$sql = "CALL SP_eliminarColor(?)";
			$stm = $this->_db->prepare($sql);
			$stm->bindParam(1, $this->_id);
			return $stm->execute();
		}
		
		public function modificar(){
			$sql = "CALL SP_modificarColor(?, ?, ?)";
			$stm =$this->_db->prepare($sql);
			$stm->bindParam(1, $this->_id);
			$stm->bindParam(2, $this->_codigo);
			$stm->bindParam(3, $this->_nombre);
			return $stm->execute();
		}
	}
