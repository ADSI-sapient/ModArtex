<?php 

	class mdlCotizacion {

		private $Id_PedidosCotizaciones;
		private $Fecha_Registro;
		private $Id_Estado  = 1;
		private $Fecha_Vencimiento;
		private $Valor_Total;
		private $Num_Documento;
		private $Estado_In_Ha;
		private $Id_tipo;
		private $Tipo_Documento;
		private $Nombre;
		private $Apellido;
		private $Estado;
		private $Telefono;
		private $Direccion;
		private $Email;
		private $db;

		public function __SET($atributo, $valor){
			$this->$atributo = $valor;
		}

		public function __GET($atributo){
			return $this->$atributo;
		}

		function __construct($db){
		    try {
		     $this->db = $db;

		    } catch (PDOException $e) {
		         exit('No se puedo conectar');
	        }
		}

		public function getCotizacion(){

			$sql = "SELECT Id_PedidosCotizaciones, Num_Documento, Id_Estado, Fecha_Vencimiento, Valor_Total FROM tbl_solicitudes ORDER BY Id_PedidosCotizaciones ";
			$query = $this->db->prepare($sql);
			$query->execute();
			return $query->fetchAll(2);
		}

		public function regCotizacion(){

			$sql = "CALL SP_regSolicitud(?,?,?,?)";
			try{
				$query = $this->db->prepare($sql);
				$query->bindParam(1, $this->Num_Documento);
				$query->bindParam(2, $this->Id_Estado);
				$query->bindParam(3, $this->Fecha_Registro);
				$query->bindParam(4, $this->Valor_Total);
				return $query->execute();

			}catch (PDOException $e) {
			}
		}

		public function ultimaSolicitud(){
			$sql = "SELECT MAX(Id_PedidosCotizaciones) AS Id_Solicitud FROM tbl_solicitudes";
			try {
				
				$query = $this->db->prepare($sql);
				$query->execute();
				return $query->fetch();
			} catch (PDOException $e) {
				
			}
		}

		public function ultimaSolicitud_Tipo(){
			$sql = "SELECT MAX(Id_PedidosCotizaciones_Tipo) AS Id_Tipo_Solicitud FROM tbl_solicitudes_tipo";
			try {
				$query = $this->db->prepare($sql);
				$query->execute();
				return $query->fetch();
			} catch (PDOException $e) {
				
			}
		}

		public function registra_Tipo(){
			$sql = "INSERT INTO tbl_solicitudes_tipo VALUES (null,?,?,null,?)";
			$query = $this->db->prepare($sql);
			$query->bindParam(1, $this->Id_Solicitud);
			$query->bindParam(2, $this->Id_tipoSolicitud);
			$query->bindParam(3, $this->Fecha_Vencimiento);
			return $query->execute();
		}	

		public function regProducto_Aso(){
			$sql = "INSERT INTO tbl_solicitudes_producto VALUES (null,?,?,?,?,?,?)";
			$query = $this->db->prepare($sql);
			$query->bindParam(1, $this->Id_tipoSolicitud);
			$query->bindParam(2, $this->referencia);
			$query->bindParam(3, $this->Cantidad_existencias);
			$query->bindParam(4, $this->Estado_);
			$query->bindParam(5, $this->Cantidad_Producir);
			$query->bindParam(6, $this->subtotal);
			return $query->execute();
		}
		public function getCliente(){
			$sql = "SELECT Num_Documento,Id_tipo,Tipo_Documento,Nombre,Apellido,Estado,Telefono,Direccion,Email FROM tbl_persona";
			try {
				$query = $this->db->prepare($sql);
				$query->execute();
				return $query->fetchAll(2);

			} catch (PDOException $e) {
				
			}
		}	

		public function modiCotizacion(){

			$sql = "UPDATE tbl_solicitudes SET Id_Estado = ?, Fecha_Registro = ?, Valor_Total = ?, Num_Documento = ? WHERE Id_PedidosCotizaciones = ?";
			
			try{

				$query = $this->db->prepare($sql);
				$query->bindParam(1, $this->Id_Estado);
				$query->bindParam(2, $this->Fecha_Registro);
				$query->bindParam(3, $this->Valor_Total);
				$query->bindParam(4, $this->Num_Documento);
				$query->bindParam(5, $this->Id_PedidosCotizaciones);

				return $query->execute();

			}catch (PDOException $e){

			}
		}

		// public function Modicotizacion(){
		// 	$sql = "UPDATE tbl_solicitudes SET Id_Estado = ?,Fecha_Vencimiento = ?,";
		// 	$query = $this->db->prepare($sql);
		// 	$query->bindParam(1, $this->Id_Estado);
		// 	$query->bindParam(2, $this->Fecha_Vencimiento);
		// 	return $query->execute();
		// }

		public function cambiarEstado(){
			$sql = "CALL SP_ModificarEstadoCoti(?,?)";

			try {
				$query = $this->db->prepare($sql);
				$query->bindParam(1, $this->codigo);
				$query->bindParam(2, $this->tado);
				$query->execute();
				return $query;
			}catch (PDOException $e) {
				
			}
		}

		public function getFichas(){
			$sql = "CALL SP_ListarFichasTecnicas";
			try {
				$query = $this->db->prepare($sql);
				$query->execute();
				return $query->fetchAll();
			} catch (PDOException $e) {
				
			}
		} 
	}  
