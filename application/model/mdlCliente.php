<?php 
class mdlCliente
{
	private $estado;
	private $tipo_documento;
	private $documento;
	private $nombre;
	private $apellido;
	private $telefono;
	private $email;
	private $codigo;
	private $db;

	public function __SET($atributo, $valor){
		$this->$atributo = $valor;
	}

	public function __GET($atributo){
		return $this->atributo;
	}

	function __construct($db)
	{
	    try {
	        $this->db = $db;
	    } catch (PDOException $e) {
	        exit('No se pudo establecer la conexión a la base de datos.');
	    }
	}

	public function regCliente()
	{
	    $consulta = "INSERT INTO cliente VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

	    try {
	       	$query = $this->db->prepare($sql);
	       	$query->bindParam(1, $this->estado);
	        $query->bindParam(2, $this->tipo_documento);
	        $query->bindParam(3, $this->documento);
	        $query->bindParam(4, $this->nombre);
	        $query->bindParam(5, $this->apellido);
	        $query->bindParam(7, $this->email);
	        $query->bindParam(6, $this->telefono);
	        $query->bindParam(8, $this->codigo);
	       	return $query->execute();

	    } catch (PDOException $e) {
	    }
	}
	        
	    public function getCliente()
	    {
	        	$sql= "CALL SP_clientes";

      		try{
      			$query = $this->db->prepare($sql);
      			$query->execute();
      			return $query->fetchAll();
      		} catch (PDOException $e){
      		}
	    }
	}
?>