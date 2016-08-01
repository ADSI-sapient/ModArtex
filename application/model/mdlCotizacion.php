<?php 

	class mdlCotizacion {

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
		private $Id_Solicitud;
		private $Id_tipoSolicitud;
		private $Referencia;
		private $Valor_Produccion;
		private $cod;
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

			$sql = "SELECT s.Id_Solicitud, s.Num_Documento, s.Id_Estado, s.Valor_Total, s.Fecha_Registro, t.Fecha_Vencimiento FROM tbl_solicitudes_tipo t JOIN tbl_solicitudes s ON t.Id_Solicitud = s.Id_Solicitud WHERE s.Id_Estado = 1";
			$query = $this->db->prepare($sql);
			$query->execute();
			return $query->fetchAll();
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
			$sql = "SELECT MAX(Id_Solicitud) AS Id_Solicitud FROM tbl_solicitudes";
			try {
				
				$query = $this->db->prepare($sql);
				$query->execute();
				return $query->fetch();
			} catch (PDOException $e) {
				
			}
		}

		public function ultimaSolicitud_Tipo(){
			$sql = "SELECT MAX(Id_Solicitudes_Tipo) AS Id_Tipo_Solicitud FROM tbl_solicitudes_tipo";
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
			$sql = "SELECT Num_Documento,Id_tipo, Tipo_Documento, Nombre, Apellido, Estado, Telefono, Direccion,Email FROM tbl_persona WHERE Id_tipo = 2";
			try {
				$query = $this->db->prepare($sql);
				$query->execute();
				return $query->fetchAll();

			} catch (PDOException $e) {
				
			}
		}	

		public function modiCotizacion(){

			$sql = "UPDATE tbl_solicitudes SET Num_Documento = ?, Id_Estado = ? WHERE Id_Solicitud = ?";
			try{
				$query = $this->db->prepare($sql);
				$query->bindParam(1, $this->Num_Documento);
				$query->bindParam(2, $this->Id_Estado);
				return $query->execute();

			}catch (PDOException $e){

			}
		}

		public function modCotizacion(){
			$sql = "UPDATE tbl_solicitudes_tipo SET Fecha_Vencimiento = ? WHERE Id_Solicitudes_Tipo = ?";
			$query = $this->db->prepare($sql);
			$query->bindParam(1, $this->Fecha_Vencimiento);
			return $query->execute();
		}

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

		public function facturaVenta(){
			$sql = "SELECT p.Num_Documento, p.Id_Tipo, p.Tipo_Documento, p.Nombre, p.Apellido, p.Telefono, p.Direccion, p.Email, s.Id_Solicitud, s.Id_Estado, s.Fecha_Registro, t.Fecha_Vencimiento, s.Valor_Total FROM tbl_persona p INNER JOIN tbl_solicitudes s ON p.Num_Documento = s.Num_Documento INNER JOIN tbl_solicitudes_tipo t ON s.Id_Solicitud = t.Id_Solicitud ";
			$query = $this->db->prepare($sql);
			$query->bindParam(1, $cod);
			$query->execute();
			return $query->fetchAll();                      
		}

		public function facturaFicha(){
			$sql = "SELECT Referencia, Valor_Produccion,Estado FROM tbl_fichas_tecnicas WHERE Estado = 1";
			$query = $this->db->prepare($sql);
			$query->execute();
			return $query->fetchAll();
		}
}  	