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

	public function registrarInsumo(){	
		if($this->validarURL("ctrBodega/registrarInsumo")){
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

			$_SESSION["mensaje"] = "Lobibox.notify('success', {delay: 6000, size: 'mini', msg: 'El insumo se registro correctamente!'});";
		}

		$lista = $this->_modelColor->listar();
		$listaM = $this->_modelMedida->listar();

		include APP . 'view/_templates/header.php';
		include APP . 'view/bodega/regInsumo.php';
		include APP . 'view/_templates/footer.php';
		}else{
			header('location: '.URL.'home/index');
		}
	}

	public function regColorInsumo(){
		$this->_modelInsumo->__SET("_idColor", $_POST["IdCol"]);
		$this->_modelInsumo->__SET("_idInsumo", $_POST["idIns"]);
		$this->_modelInsumo->__SET("_cant", 0);
		$this->_modelInsumo->__SET("_valPro", $_POST["valIns"]);
		$this->_modelInsumo->__SET("_stock", $_POST["stock"]);

		echo json_encode($this->_modelInsumo->regColorInsumo());
	}

	public function listarInsumos(){
		if($this->validarURL("ctrBodega/listarInsumos")){
			$lisInsumos = $this->_modelInsumo->listarInsumos();
	
			$lista = $this->_modelColor->listar();
			$listaM = $this->_modelMedida->listar();
	
			include APP . 'view/_templates/header.php';
			include APP . 'view/bodega/consInsumo.php';
			include APP . 'view/_templates/footer.php';
		}
	}

	public function cambiarEstado(){
		$this->_modelInsumo->__SET("_idInsumo", $_POST["id"]);
		$this->_modelInsumo->__SET("_estado", $_POST["estado"]);
		$this->_modelInsumo->cambiarEstado();

		$_SESSION["mensaje"] = "Lobibox.notify('success', {delay: 6000, size: 'mini',
		msg: 'Se cambió el estado del insumo correctamente!'});";

		echo json_encode(["v"=>1]); 
	}

	public function lisColInsu(){
		if (isset($_POST["id"])) {
			$this->_modelInsumo->__SET("_idInsumo", $_POST["id"]);
			$lis = $this->_modelInsumo->listarColorInsumo();
			echo json_encode($lis);
		}
	}

	public function modificarColorInsumo(){
		$this->_modelInsumo->__SET("_idColIns", $_POST["idColIns"]);
		$this->_modelInsumo->__SET("_cant", $_POST["cantidadIns"]);
		$this->_modelInsumo->__SET("_valPro", $_POST["valIns"]);
		$this->_modelInsumo->__SET("_stock", $_POST["stock"]);

		echo json_encode($this->_modelInsumo->modiExistencia());
	}

	public function modificarInsumo(){
		$this->_modelInsumo->__SET("_idInsumo", $_POST["id"]);
		$this->_modelInsumo->__SET("_codMedida", $_POST["select"]);
		$this->_modelInsumo->__SET("_nombre", $_POST["nombre"]);

		echo json_encode($this->_modelInsumo->modInsumo());

		$_SESSION["mensaje"] = "Lobibox.notify('success', {delay: 6000, size: 'mini',
					msg: 'El insumo se modificó correctamente!'});";
	}

	public function cantidadColIns(){
		$this->_modelInsumo->__SET("_idColIns", $_POST["idColIns"]);
		$cant = $this->_modelInsumo->cantidadColIns();
		echo json_encode($cant);
	}

	public function validateFichasAsoc(){
		$this->_modelInsumo->__SET("_idColIns", $_POST["idColIns"]);
		$fichasAsoc = $this->_modelInsumo->fichasAsociadas();
		$entradasAsoc = $this->_modelInsumo->entradasAsoc();
		$salidasAsoc = $this->_modelInsumo->salidasAsoc();

		if ($fichasAsoc == null && $entradasAsoc == null && $salidasAsoc == null) {
			echo json_encode(true);
		}else{
			echo json_encode(false);
		}
	}

	public function borrarColorInsumo(){
		$this->_modelInsumo->__SET("_idColIns", $_POST["idColIns"]);
		echo json_encode($this->_modelInsumo->deleteColorIns());
	}

	public function listExistencias(){
		if($this->validarURL("ctrBodega/listExistencias")){
			$listEx = $this->_modelExistencias->listarExistencias();
			include APP . 'view/_templates/header.php';
			include APP . 'view/bodega/existencias.php';
			include APP . 'view/_templates/footer.php';
		}else{
			header('location: '.URL.'home/index');
		}	
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
			$this->_modelExistencias->__SET("_valorPro", round($promedio, 2));

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
				$this->_modelExistencias->__SET("_valorPro", round($promedio, 2));

				$this->_modelExistencias->regEntradaExis();
			}
		}
		$_SESSION["mensaje"] = "Lobibox.notify('success', {delay: 6000, size: 'mini',
					msg: 'La entrada ha sido registrada correctamente!'});";
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
		$_SESSION["mensaje"] = "Lobibox.notify('success', {delay: 6000, size: 'mini',
					msg: 'La salida ha sido registrida correctamente!'});";
		header("location: ".URL."ctrBodega/listExistencias");
	}


	public function actualizarExsIns(){
		$this->_modelExistencias->__SET("_idExis", $_POST["idExs"]);	
		$this->_modelExistencias->__SET("_cant", $_POST["cantidad"]);

		echo json_encode($this->_modelExistencias->actualizarExsIns());	
	}

	public function reporteExistencias(){
		$_SESSION["arrayExistencias"] = $_POST["arrayExist"];
		if($_SESSION["arrayExistencias"]){
			echo json_encode(["r" => 1]);
		}else{
			echo json_encode(["r" => 0]);
		}
	}
	
	public function reporteInsumos(){
		$existencias = $_SESSION["arrayExistencias"];
		require APP.'view/bodega/reporteExistenciasIns.php';
	}


	public function validarNomIns(){
		$this->_modelExistencias->__SET("_nombre", $_POST["nomIns"]);
		$valIns = $this->_modelExistencias->validarNomInsumo();
		echo json_encode($valIns);
	}
}
