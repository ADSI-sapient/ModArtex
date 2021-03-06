<?php

class ctrBodega extends Controller{
	private $_modelInsumo;
	private $_modelColor;
	private $_modelMedida;
	private $_modelExistencias;

	function __construct(){
		$this->_modelInsumo = $this->loadModel('mdlBodega');
		$this->_modelColor = $this->loadModel('mdlColores');
		$this->_modelMedida = $this->loadModel('mdlMedidas');
		$this->_modelExistencias = $this->loadModel('mdlExistencias');
	}

	public function index(){
		include APP . 'view/_templates/header.php';
		include APP . 'view/bodega/consInsumo.php';
		include APP . 'view/_templates/footer.php';
	}

	public function registrarInsumo(){	

		if (isset($_POST["btnRegIns"])) {
			$this->_modelInsumo->__SET("_codMedida", $_POST["select"]);
			$this->_modelInsumo->__SET("_nombre", $_POST["nombre"]);
			$this->_modelInsumo->__SET("_estado", 1);
			$this->_modelInsumo->__SET("_valPro", $_POST["valor"]);
			$this->_modelInsumo->__SET("_stock", $_POST["stock"]);


			$id = $this->_modelInsumo->registrarInsumo();
			$this->_modelInsumo->__SET("_idInsumo", $id["Id"]);

			$col = explode(',', $_POST['arreglo'][0]);

			foreach ($col as $value2) {
				$this->_modelInsumo->__SET("_idColor", $value2);
				$this->_modelInsumo->regColorInsumo();
			}
		}

		$lista = $this->_modelColor->listar();
		$listaM = $this->_modelMedida->listar();

		include APP . 'view/_templates/header.php';
		include APP . 'view/bodega/regInsumo.php';
		include APP . 'view/_templates/footer.php';
	}

	public function listarInsumos(){
		$lisInsumos = $this->_modelInsumo->listarInsumos();

		$lista = $this->_modelColor->listar();
		$listaM = $this->_modelMedida->listar();

		include APP . 'view/_templates/header.php';
		include APP . 'view/bodega/consInsumo.php';
		include APP . 'view/_templates/footer.php';
	}

	public function cambiarEstado(){
		$this->_modelInsumo->__SET("_idInsumo", $_POST["id"]);
		$this->_modelInsumo->__SET("_estado", $_POST["estado"]);
		$this->_modelInsumo->cambiarEstado();

		echo json_encode(["v"=>1]);
	}

	public function lisColInsu(){
		if (isset($_POST["id"])) {
			$this->_modelInsumo->__SET("_idInsumo", $_POST["id"]);
			$lis = $this->_modelInsumo->listarColorInsumo();
			echo json_encode($lis);
		}
	}

	public function modificarInsumo(){
		$this->_modelInsumo->__SET("_idInsumo", $_POST["id"]);
		$this->_modelInsumo->__SET("_stock", $_POST["stock"]);
		$this->_modelInsumo->__SET("_valPro", $_POST["valor"]);
		$this->_modelInsumo->__SET("_codMedida", $_POST["select"]);
		$this->_modelInsumo->__SET("_nombre", $_POST["nombre"]);

		$this->_modelInsumo->modInsumo();
		$lis = $this->_modelInsumo->listarColorInsumo();

		$col = explode(',', $_POST['arregloCol'][0]);

		foreach ($col as $value2) {
			$band = true;
			foreach ($lis as $val) {
				if ($value2 == $val["id"]) {
					$band = false;
				}
			}
			if ($band) {
				$this->_modelInsumo->__SET("_idColor", $value2);
				$this->_modelInsumo->regColorInsumo();
			}
		}

		header ("location: ".URL."ctrBodega/listarInsumos");
	}

	public function cantidadColIns(){
		$this->_modelInsumo->__SET("_idColor", $_POST["idCol"]);
		$this->_modelInsumo->__SET("_idInsumo", $_POST["idIns"]);
		$cant = $this->_modelInsumo->cantidadColIns();
		echo json_encode($cant);
	}

	public function deleteColor(){
		$this->_modelInsumo->__SET("_idColor", $_POST["idCol"]);
		$this->_modelInsumo->__SET("_idInsumo", $_POST["idIns"]);
		echo json_encode($this->_modelInsumo->deleteColor());
	}

	public function listExistencias(){
		$listEx = $this->_modelExistencias->listarExistencias();

		include APP . 'view/_templates/header.php';
		include APP . 'view/bodega/existencias.php';
		include APP . 'view/_templates/footer.php';
	}


	public function regEntrada(){
		$this->_modelExistencias->__SET("_fecha", $_POST["fechaEnt"]);
		$this->_modelExistencias->__SET("_valorEnt", $_POST["valorTot"]);

		$idEnt = $this->_modelExistencias->regEntrada();
		$this->_modelExistencias->__SET("_idEnt", $idEnt["idEnt"]);

		if (isset($_POST["regUno"])){
			$this->_modelExistencias->__SET("_idExis", $_POST["idExs"]);
			$this->_modelExistencias->__SET("_cant", $_POST["cant"]);
			$this->_modelExistencias->__SET("_valUni", $_POST["valorUni"]);
			$this->_modelExistencias->__SET("_valTot", $_POST["valorTot"]);

			$cantTot = $_POST["cant"] + $_POST["cantActual"];
			$valTot = ($_POST["cantActual"] * $_POST["valPromedio"]) + $_POST["valorTot"];
			$promedio = $valTot/$cantTot;

			$this->_modelExistencias->__SET("_cantInsumo", $cantTot);
			$this->_modelExistencias->__SET("_valorPro", $promedio);

			$this->_modelExistencias->regEntradaExis();
		}elseif (isset($_POST["regMuchos"])) {
			foreach (json_decode($_POST["vec"]) as $val) {
				$this->_modelExistencias->__SET("_idExis", $val[0]->numEx);
				$this->_modelExistencias->__SET("_cant", $val[1]->cantidad);
				$this->_modelExistencias->__SET("_valUni", $val[2]->valorU);
				$this->_modelExistencias->__SET("_valTot", $val[3]->valorT);

				$cantTot = $val[1]->cantidad + $val[4]->cantActual;
				$valTot = ($val[4]->cantActual * $val[5]->valorPromedio) + $val[3]->valorT;
				$promedio = $valTot/$cantTot;

				$this->_modelExistencias->__SET("_cantInsumo", $cantTot);
				$this->_modelExistencias->__SET("_valorPro", $promedio);

				$this->_modelExistencias->regEntradaExis();
			}
		}
		//Comentario
		header("location: ".URL."ctrBodega/listExistencias");
	}

	public function regSalida(){
		$this->_modelExistencias->__SET("_fecha", $_POST["fechaSal"]);
		$this->_modelExistencias->__SET("_descripcion", $_POST["descripcion"]);
		$this->_modelExistencias->regSalida();

		if (isset($_POST["regUnaSal"])) {
			$this->_modelExistencias->__SET("_idExis", $_POST["idExs"]);
			$this->_modelExistencias->__SET("_cant", $_POST["cantSal"]);

			$cantIns = $_POST["cant"] - $_POST["cantSal"];

			$this->_modelExistencias->__SET("_cantInsumo", $cantIns);

			$this->_modelExistencias->regSalExis();
		}
		if (isset($_POST["salIns"])) {
			$array = json_decode($_POST["arraySalIns"]);
			foreach ($array as $valor) {
				$this->_modelExistencias->__SET("_idExis", $valor[0]->idExs);
				$this->_modelExistencias->__SET("_cant", $valor[1]->cantSal);

				$cantIns = $valor[2]->cant - $valor[1]->cantSal;

				$this->_modelExistencias->__SET("_cantInsumo", $cantIns);
				
				$this->_modelExistencias->regSalExis();
			}
		}
		header("location: ".URL."ctrBodega/listExistencias");
	}
}
