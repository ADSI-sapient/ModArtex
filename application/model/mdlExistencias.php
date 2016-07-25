<?php

	class mdlExistencias{
		private $_db;
		private $_cant;
		private $_valorUni;
		private $_valorTot;

		private $_idEnt;
		private $_idExis;

		private $_cantInsumo;
		private $_valorPro;

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
			$sql = "CALL SP_RegEntrada(?, ?, ?)";
			$stm = $this->_db->prepare($sql);
			$stm->bindParam(1, $this->_cant);
			$stm->bindParam(2, $this->_valorUni);
			$stm->bindParam(3, $this->_valorTot);
			$stm->execute();

			$sql2 = "CALL SP_ObtIdEntrada()";
			$stm2 = $this->_db->prepare($sql2);
			$stm2->execute();
			return $stm2->fetch();
		}

		public function regEntradaExis(){
			$sql = "CALL SP_RegEntExis(?, ?)";
			$stm = $this->_db->prepare($sql);
			$stm->bindParam(1, $this->_idEnt);
			$stm->bindParam(2, $this->_idExis);
			$stm->execute();

			$this->aumentarCant();
		}

		public function aumentarCant(){
			$sql = "CALL SP_ActualizarExis(?, ?, ?)";
			$stm = $this->_db->prepare($sql);
			$stm->bindParam(1, $this->_idExis);
			$stm->bindParam(2, $this->_cantInsumo);
			$stm->bindParam(3, $this->_valorPro);
			$stm->execute();
		}
	}