<?php
class ConectorMySql {
	// IP
	private $server;

	// Base de datos a la que se conecta por default
	private $defaultDatabase;

	// Usr/Pw
	private $user;
	private $password;

	// Guarda la conexion
	private $connection;

	// Tipo de base de datos
	private $driver;
	
	// Instancia singleton
	private static $instancia_conector;
	
	private function __construct($defaultDatabase){
		$this->defaultDatabase = $defaultDatabase;
		$this->server = "localhost";
		$this->user = "root";
        $this->password = '';
		$this->driver = "mysqli";
		$this->openConnection();
	}
	
	public static function getInstance($defaultDatabase = ""){
		if (!isset(self::$instancia_conector))
		{
			if ($defaultDatabase == "")
				$defaultDatabase = "test"; // mi db se llama test
			
			self::$instancia_conector = new ConectorMySql($defaultDatabase);
		}
		
		return (self::$instancia_conector);			
	}
	
	public function __destruct(){
        try{
			$this->closeConnection();
		}
        catch(Exception $e){
            echo $e->getMessage();
        }
	}
	
	public function escape_string($string) {
		$result = $this->connection->real_escape_string($string);
		return $result;
	}
	
	private function openConnection(){
		$retorno = true;
		
		try {
		 	$this->connection = new mysqli($this->server, $this->user, $this->password, $this->defaultDatabase );	
		}
	 	catch(Exception $e){
	 		print_r($e);
			echo "Error al conectarse con la base de datos.";
	 		$this->connection = null;
			$retorno = false;	
	 	}
		
	 	return $retorno;
	}
	

	private function closeConnection(){
		if($this->connection)
			$this->connection->close();
	}
    
    public function getConnection(){
        return $this->connection;
    }
	
	public function selectQuery($query){
        $arrayRetorno = array();
		
		$result = $this->connection->query($query);     
        if($result){
            while ($row = $result->fetch_array()){
                $arrayRetorno[] = $row;
            }
            // Free result set
            $result->close();
            $this->connection->next_result();
        }
        
		return $arrayRetorno;
	}
	
	
	public function insertQuery($query){
		$queryRealizada = $this->connection->query($query);
		
		$retorno = true;
		if ($queryRealizada === false){			
			echo "<b>Ha habido un problema en la insercion de los datos. Inténtelo nuevamente.</b>";
			$retorno = false;
		}
        $this->connection->next_result();
		
		return $retorno;
	}
	
	public function deleteQuery($query){
		$queryRealizada = $this->connection->query($query);
		
		$retorno = true;
		if ($queryRealizada === false){			
			echo "<b>Ha habido un problema en la eliminación de datos. Inténtelo nuevamente.</b>";
			$retorno = false;
		}
        $this->connection->next_result();
		
		return $retorno;
	}

	public function updateQuery($query){
		$queryRealizada = $this->connection->query($query);
		
		$retorno = true;
		if ($queryRealizada === false){			
			echo "<b>Ha habido un problema en la modificación de datos. Inténtelo nuevamente.</b>";
			$retorno = false;
		}
		
		return $retorno;
	}
}
?>
