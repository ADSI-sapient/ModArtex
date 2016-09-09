<?php

	class mdlExistencias{
		private $_db;
		private $_fecha;
		private $_valorEnt;


		private $_idEnt;
		private $_idExis;
		private $_cant;
		private $_valUni;
		private $_valTot;


		private $_cantInsumo;
		private $_valorPro;

		private $_descripcion;
		private $_idSal;

		function __construct($db){
			$this->_db = $db;
		}

		public function __GET($atributo){
			return $this->$atributo;
		}

		public function __SET($atributo, $valor){
			$this->$atributo = $valor;
		}

		public function listarExistencias(){
			$sql = "CALL SP_ListarExistencias()";
			$stm = $this->_db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function regEntrada(){
			$sql = "CALL SP_RegEntrada(?, ?)";
			$stm = $this->_db->prepare($sql);
			$stm->bindParam(1, $this->_fecha);
			$stm->bindParam(2, $this->_valorEnt);
			$stm->execute();

			$sql2 = "CALL SP_ObtIdEntrada()";
			$stm2 = $this->_db->prepare($sql2);
			$stm2->execute();
			return $stm2->fetch();
		}

		public function regEntradaExis(){
			$sql = "CALL SP_RegEntExis(?, ?, ?, ?, ?)";
			$stm = $this->_db->prepare($sql);
			$stm->bindParam(1, $this->_idEnt);
			$stm->bindParam(2, $this->_idExis);
			$stm->bindParam(3, $this->_cant);
			$stm->bindParam(4, $this->_valUni);
			$stm->bindParam(5, $this->_valTot);
			$stm->execute();

			return $this->aumentarCant();
		}

		public function aumentarCant(){
			$sql = "CALL SP_AumentarExisIns(?, ?, ?)";
			$stm = $this->_db->prepare($sql);
			$stm->bindParam(1, $this->_idExis);
			$stm->bindParam(2, $this->_cantInsumo);
			$stm->bindParam(3, $this->_valorPro);
			$stm->execute();
		}

		public function regSalida(){
			$sql = "CALL SP_RegSalidaIns(?, ?)";
			$stm = $this->_db->prepare($sql);
			$stm->bindParam(1, $this->_fecha);
			$stm->bindParam(2, $this->_descripcion);
			$stm->execute();

			$sql2 = "CALL SP_UltimaSalidaIns()";
			$stm2 = $this->_db->prepare($sql2);
			$stm2->execute();

			$this->_idSal = $stm2->fetch()["idSalida"];
		}

		public function regSalExis(){
			$sql = "CALL SP_RegSalExsIns(?, ?, ?)";
			$stm = $this->_db->prepare($sql);
			$stm->bindParam(1, $this->_idSal);
			$stm->bindParam(2, $this->_idExis);
			$stm->bindParam(3, $this->_cant);
			$stm->execute();

			$sql2 = "CALL SP_DisminuirExsIns(?, ?)";
			$stm2 = $this->_db->prepare($sql2);
			$stm2->bindParam(1, $this->_idExis);
			$stm2->bindParam(2, $this->_cantInsumo);
			$stm2->execute();
		}

		public function actualizarExsIns(){
			$sql = "CALL SP_UpdateExisColIns(?, ?)";
			$stm = $this->_db->prepare($sql);
			$stm->bindParam(1, $this->_idExis);
			$stm->bindParam(2, $this->_cant);
			return $stm->execute();
		}
	}