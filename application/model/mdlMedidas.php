<?php

	class mdlMedidas
	{
		private $_db;
		private $_codigo;
		private $_nombre;
		private $_abreviatura;

		function __construct($db){
			try {
				$this->_db = $db;
			} catch (PDOException $e) {
				exit('No se pudo establecer la conexión a la base de datos.');
			}
		}

		public function __GET($atributo){
			return $this->$atributo;
		}

		public function __SET($atributo, $valor){
			$this->$atributo = $valor;
		}

		public function listar(){
			$sql = "CALL SP_listarMedidas()";
			$stm = $this->_db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function registrarMedida(){
			$sql = "CALL SP_registrarMedidas(?, ?)";
			$stm = $this->_db->prepare($sql);
			$stm->bindParam(1, $this->_abreviatura);
			$stm->bindParam(2, $this->_nombre);
			return $stm->execute();
		}

		public function eliminarMedida(){
			$sql = "CALL SP_eliminarMedida(?)";
			$stm = $this->_db->prepare($sql);
			$stm->bindParam(1, $this->_codigo);
			return $stm->execute(); 
		}

		public function modificarMedida(){
			$sql = "CALL SP_modificarMedida(?, ?, ?)";
			$stm = $this->_db->prepare($sql);
			$stm->bindParam(1, $this->_codigo);
			$stm->bindParam(2, $this->_abreviatura);
			$stm->bindParam(3, $this->_nombre);
			return $stm->execute();
		}

		public function validar(){
			$sql = "CALL SP_ValidarMedida(?, ?)";
			$stm =$this->_db->prepare($sql);
			$stm->bindParam(1, $this->_nombre);
			$stm->bindParam(2, $this->_abreviatura);
			$stm->execute();
			return $stm->fetch();
		}
	}