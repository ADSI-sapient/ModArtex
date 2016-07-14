<?php
	class mdlBodega{
		private $_db;

		private $_cant = 0;
		private $_valPro = 0;

		private $_stock;

		private $_idColor;
		private $_idInsumo;

		private $_codMedida;
		private $_nombre;
		private $_estado;

		function __construct($db){
			$this->_db = $db;
		}

		public function __GET($atributo){
			return $this->$atributo;
		}

		public function __SET($atributo, $valor){
			$this->$atributo = $valor;
		}

		public function registrarInsumo(){
			$sql = "CALL SP_regInsumo(?, ?, ?)";
			$stm = $this->_db->prepare($sql);
			$stm->bindParam(1, $this->_codMedida);
			$stm->bindParam(2, $this->_nombre);
			$stm->bindParam(3, $this->_estado);
			$stm->execute();

			return $this->obtenerId();
		}

		public function obtenerId(){
			$sql = "CALL SP_obtenerId";
			$stm = $this->_db->prepare($sql);
			$stm->execute();
			return $stm->fetch();
		}

		public function regColorInsumo(){
			$sql = "CALL SP_regColorInsumo(?, ?)";
			$stm = $this->_db->prepare($sql);
			$stm->bindParam(1, $this->_idColor);
			$stm->bindParam(2, $this->_idInsumo);
			return $stm->execute();
		}

		public function crearExistencias(){
			$sql = "CALL SP_crearExistencias(?, ?, ?, ?)";
			$stm = $this->_db->prepare($sql);
			$stm->bindParam(1, $this->_idInsumo);
			$stm->bindParam(2, $this->_cant);
			$stm->bindParam(3, $this->_valPro);
			$stm->bindParam(4, $this->_stock);
			return $stm->execute();
		}

		public function listarInsumos(){
			$sql = "CALL SP_listarInsumos()";
			$stm = $this->_db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function listarColorInsumo(){
			$sql = "CALL SP_listarColorInsumo(?)";
			$stm = $this->_db->prepare($sql);
			$stm->bindParam(1, $this->_idInsumo);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function cambiarEstado(){
			$sql = "CALL SP_cambiarEstadoIns(?, ?)";
			$stm = $this->_db->prepare($sql);
			$stm->bindParam(1, $this->_idInsumo);
			$stm->bindParam(2, $this->_estado);
			return $stm->execute();
		}

		public function modiInsumo(){
			$sql = "CALL SP_modificarInsumo(?, ?, ?)";
			$stm = $this->_db->prepare($sql); 
			$stm->bindParam(1, $this->_idInsumo);
			$stm->bindParam(2, $this->_codMedida);
			$stm->bindParam(3, $this->_nombre);
			$stm->execute();

			$this->modiExistencia();
		}

		public function modiExistencia(){
			$sql = "CALL SP_modificarExistencia(?, ?)";
			$stm = $this->_db->prepare($sql);
			$stm->bindParam(1, $this->_idInsumo);
			$stm->bindParam(2, $this->_stock);
			return $stm->execute();
		}

		public function deleteColor(){
			$sql = "CALL SP_borrarColores(?)";
			$stm = $this->_db->prepare($sql);
			$stm->bindParam(1, $this->_idInsumo);
			return $stm->execute();
		}
	}