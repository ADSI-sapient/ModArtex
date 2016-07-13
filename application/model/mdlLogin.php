<?php 
	class mdlLogin{

		private $db;
        private $codigo;
		private $usuarios;
		private $clave;
		private $id_rol;
		private $email;
        private $r;

		function __SET($nombre, $valor){
			$this->$nombre = $valor;
		}

		function __GET($nombre){
			return $this->$nombre;
		}

	    function __construct($db)
	    {
	        try {
	            $this->db = $db;
	        } catch (PDOException $e) {
	        	exit('No se pudo establecer la conexión a la base de datos.');
	        }
	    }

	    public function consultarUsuarioLogin($usuario){
            $consulta = 'CALL SP_userLogin(?)';
            $query = $this->db->prepare($consulta);
            $query->bindParam(1, $usuario);
            $query->execute();
            return $query->fetch();
        }

        public function obtenerPermisos(){
        	$sql = "CALL SP_solicitarPermisos(?)";
        	$query = $this->db->prepare($sql);
        	$query->bindParam(1, $this->id_rol);
        	$query->execute();
        	return $query->fetchAll();
        }

        public function cambiarClave(){
            $sql = "CALL SP_cambiarClave(?, ?)";
            $stm = $this->db->prepare($sql);
            $stm->bindParam(1, $this->codigo);
            $stm->bindParam(2, $this->clave);
            return $stm->execute();
        }

        public function traerEmails(){
            $sql = "CALL SP_mails()";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        }
    }


