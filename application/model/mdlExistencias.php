<?php

	class mdlExistencias{
		private $_db;

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
	}