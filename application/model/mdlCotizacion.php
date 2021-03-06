<?php 

	class mdlCotizacion {

		private $Fecha_Registro;
		private $Id_Estado  = 1;
		private $Fecha_Vencimiento;
		private $Valor_Total;
		private $Num_Documento;
		private $Cantidad;
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
		private $Fecha_Entrega;
		private $Codigo_Color;
		private $Valor_Producto;
		private $Subtotal;
		private $Id_Cliente;
		private $Stock_Minimo;
		private $Id_Color;
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

			$sql = "SELECT s.Id_Solicitud, s.Num_Documento, s.Id_Estado, s.Valor_Total, s.Fecha_Registro, t.Fecha_Entrega, t.Fecha_Vencimiento, e.Nombre_Estado, p.Nombre FROM tbl_solicitudes_tipo t INNER JOIN tbl_solicitudes s ON t.Id_Solicitud = s.Id_Solicitud INNER JOIN tbl_estado e ON e.Id_Estado = s.Id_Estado INNER JOIN tbl_persona p ON p.Num_Documento = s.Num_Documento WHERE t.Id_Tipo = 1";
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
			$query->bindParam(2, $this->Cantidad_existencias);
			$query->bindParam(3, $this->Estado_);
			$query->bindParam(4, $this->Cantidad_Producir);
			$query->bindParam(5, $this->subtotal);
			$query->bindParam(6, $this->referencia);
			return $query->execute();
		}
		
		public function getCliente(){
			$sql = "SELECT p.Num_Documento, t.Nombre AS Tipo_Nombre, p.Tipo_Documento, p.Nombre, p.Apellido, p.Estado, p.Telefono, p.Direccion, p.Email FROM tbl_persona p INNER JOIN tbl_tipopersona t ON t.Id_tipo = p.Id_tipo WHERE t.Id_tipo = 2";
			try {
				$query = $this->db->prepare($sql);
				$query->execute();
				return $query->fetchAll();

			} catch (PDOException $e) {
				
			}
		}	

		public function modiCotizacion(){

			$sql = "UPDATE tbl_solicitudes s INNER JOIN tbl_solicitudes_tipo t ON s.Id_Solicitud = t.Id_Solicitud INNER JOIN tbl_estado e ON s.Id_Estado = e.Id_Estado SET s.Num_Documento = ?, s.Id_Estado = ?, t.Fecha_Vencimiento = ? WHERE s.Id_Solicitud = ? AND e.Id_Estado <= 4";
			try{
				$query = $this->db->prepare($sql);
				$query->bindParam(1, $this->Num_Documento);
				$query->bindParam(2, $this->Id_Estado);
				$query->bindParam(3, $this->Fecha_Vencimiento);
				$query->bindParam(4, $this->Id_Solicitud);
				return $query->execute();

			}catch (PDOException $e){

			}
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
			$sql = "SELECT p.Num_Documento, p.Id_Tipo, p.Tipo_Documento, p.Nombre, p.Apellido, p.Telefono, p.Direccion, p.Email, s.Id_Solicitud, s.Id_Estado, s.Fecha_Registro, t.Fecha_Vencimiento, s.Valor_Total, f.Referencia, f.Valor_Produccion, f.Estado, f.Cantidad FROM tbl_persona p INNER JOIN tbl_solicitudes s ON p.Num_Documento = s.Num_Documento INNER JOIN tbl_solicitudes_tipo t ON s.Id_Solicitud = t.Id_Solicitud INNER JOIN tbl_solicitudes_producto sp ON t.Id_Solicitudes_Tipo = sp.Id_Solicitudes_Tipo INNER JOIN tbl_fichas_tecnicas f ON sp.Id_Ficha_Tecnica = f.Id_Ficha_Tecnica WHERE f.Estado = 1 AND s.Id_Solicitud = ?";
			$query = $this->db->prepare($sql);
			$query->bindParam(1, $this->Id_Solicitud);
			$query->execute();
			return $query->fetchAll();                      
		}

		public function converPedido(){
			$sql = "INSERT INTO tbl_solicitudes_tipo VALUES (NULL, ?,?,?,NULL)";
			$query = $this->db->prepare($sql);
			$query->bindParam(1, $this->Id_Solicitud);
			$query->bindParam(2, $this->Id_tipoSolicitud);
			$query->bindParam(3, $this->Fecha_Entrega);
			$query->execute();
			

			$sql2 = "UPDATE tbl_solicitudes SET Id_Estado = 5 WHERE Id_Solicitud = ?";
			$query2 = $this->db->prepare($sql2);
			$query2->bindParam(1, $this->Id_Solicitud);
			$query2->execute();

			return $query;
		}

		public function PedidoAsociado(){
			$sql = "SELECT f.Referencia, c.Codigo_Color, sp.Cantidad_Producir, f.Valor_Producto, sp.Subtotal FROM tbl_solicitudes s JOIN tbl_solicitudes_tipo st ON s.Id_Solicitud = st.Id_Solicitud JOIN tbl_solicitudes_producto sp ON st.Id_Solicitudes_Tipo = sp.Id_Solicitudes_Tipo JOIN tbl_fichas_tecnicas f ON sp.Id_Ficha_Tecnica = f.Id_Ficha_Tecnica JOIN tbl_colores c ON f.Id_Color = c.Id_Color WHERE s.Id_Solicitud = ?";
            $query = $this->db->prepare($sql);
            $query->bindParam(1, $this->Cliente);
            $query->execute();
            return $query; 
		}

		public function fichasHabilitadas(){

      		$sql = "SELECT f.Referencia, f.Estado, c.Codigo_Color, f.Fecha_Registro, f.Stock_Minimo, f.Valor_Produccion, f.Valor_Producto FROM tbl_fichas_tecnicas f JOIN tbl_colores c ON f.Id_Color = c.Id_Color WHERE f.Estado = 1 ORDER BY f.Fecha_Registro DESC";
      		$query = $this->db->prepare($sql);
	        $query->execute();
	        return $query->fetchAll();
      	}
}  	