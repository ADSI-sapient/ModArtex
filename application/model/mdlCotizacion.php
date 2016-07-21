<?php 

	class mdlCotizacion {

		private $Id_PedidosCotizaciones;
		private $Fecha_Registro;
		private $Id_Estado;
		private $Fecha_Vencimiento;
		private $Valor_Total;
		private $Num_Documento;
		private $Estado_In_Ha;
		// private $Num_Documento;
		private $Nombre;
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

			$sql = "SELECT Id_PedidosCotizaciones, Num_Documento, Id_Estado, Fecha_Vencimiento, Fecha_Registro, Valor_Total, Estado_In_Ha FROM tbl_solicitudes ORDER BY Id_PedidosCotizaciones ";
			$query = $this->db->prepare($sql);
			$query->execute();
			return $query->fetchAll(2);
		}

		public function regCotizacion(){

			$sql = "INSERT INTO cotizaciones (fechaRegistro, estado, fechaVencimiento, valorTotal, cliente) VALUES (?,?,?,?,?)";
			try{
				  $query = $this->db->prepare($sql);
				  $query->bindParam(1, $this->fechaRegistro);
				  $query->bindParam(2, $this->estado);
				  $query->bindParam(3, $this->fechaVencimiento);
				  $query->bindParam(4, $this->valorTotal);
				  $query->bindParam(5, $this->cliente);
                  return $query->execute();

			    }catch (PDOException $e) {
			     }
			}

		public function getCliente(){
			$sql = "SELECT Num_Documento, Nombre, Email FROM tbl_persona";
			try {
				   $query = $this->db->prepare($sql);
				   $query->execute();
				   return $query->fetchAll(2);

			} catch (PDOException $e) {
				
			}
		}	

			public function modiCotizacion(){

				$sql = "UPDATE cotizaciones SET estado = ?, fechaVencimiento = ?, valorTotal = ?, cliente = ? WHERE codigo = ?";
				
				try{

					$query = $this->db->prepare($sql);
					$query->bindParam(1, $this->estado);
					$query->bindParam(2, $this->fechaVencimiento);
					$query->bindParam(3, $this->valorTotal);
					$query->bindParam(4, $this->cliente);
					$query->bindParam(5, $this->codigo);

					return $query->execute();

				}catch (PDOException $e){

				}
			}
			public function cambiarEstado(){
				$sql = "CALL SP_ModificarEstadoCoti (?,?)";

				try {
					
				$query = $this->db->prepare($sql);
				$query->bindParam(1, $this->codigo);
				$query->bindParam(2, $this->tado);
				$query->execute();
				return $query;

				}catch (PDOException $e) {
					
				}
            } 
   }  