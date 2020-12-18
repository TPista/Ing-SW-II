<?php
class User {
	// Data
	private $id;
	private $name;
	private $password;
	private $email;
	private $pregunta;
	private $respuesta;
	private $direccion;
	private $cod_postal;
	private $pais;
	private $tipo;
	private $ultima_mod;
	private $fecha_creada;

	private $conectorMySQL;

	public function getId(){
	    return $this->id;
	}

	public function setId($id){
	    $this->id = $id;
	}

	public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getPass(){
        return $this->password;
    }

    public function setPass($password){
        $this->password = $password;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getPregunta(){
	    return $this->pregunta;
	}

	public function setPregunta($pregunta){
	    $this->pregunta = $pregunta;
	}

	public function getRespuesta(){
	    return $this->respuesta;
	}

	public function setRespuesta($respuesta){
	    $this->respuesta = $respuesta;
	}

	public function getDireccion(){
	    return $this->direccion;
	}

	public function setDireccion($direccion){
	    $this->direccion = $direccion;
	}

	public function getCod_Postal(){
	    return $this->cod_postal;
	}

	public function setCod_Postal($cod_postal){
	    $this->cod_postal = $cod_postal;
	}

	public function getPais(){
	    return $this->pais;
	}

	public function setPais($pais){
	    $this->pais = $pais;
	}

	public function getTipo(){
	    return $this->tipo;
	}

	public function setTipo($tipo){
	    $this->tipo = $tipo;
	}

	public function getUltima_Mod(){
	    return $this->ultima_mod;
	}

	public function setUltima_Mod($ultima_mod){
	    $this->ultima_mod = $ultima_mod;
	}

	public function getFecha_Creada(){
	    return $this->fecha_creada;
	}

	public function setFecha_Creada($fecha_creada){
	    $this->fecha_creada = $fecha_creada;
	}
	
	public function __construct($id=0) {
		$this->conectorMySQL = ConectorMySql::getInstance();

		if( !$id )
		{
			$this->id= "";
			$this->name = "";
			$this->password = "";
			$this->email = "";
        	$this->respuesta = "";
			$this->pregunta = "";
			$this->direccion = "";
			$this->cod_postal = "";
			$this->pais = "";
			$this->tipo = "";
			$this->ultima_mod = "";
			$this->fecha_creada = "";
		}
		else
			$this->load_client_data($id);
	}

	// Cargamos la data del cliente con 'X' id
	private function load_client_data($id) {
		$query = "SELECT * FROM usuarios WHERE usr_id = ".$id.";";
        $retorno = true;

        try {
            $arrayRetorno = $this->conectorMySQL->selectQuery($query);
            
            if( count($arrayRetorno) != 0 )
            {
                $producto = $arrayRetorno[0];
                
                foreach( $producto as $indice => $valor ) {
                    if( $producto[$indice] === null )
                        $producto[$indice] = "null";
                }

                $this->setId               	($producto['usr_id']);
                $this->setName              ($producto['usr_name']);
                $this->setPass              ($producto['usr_pw']);
                $this->setEmail             ($producto['usr_email']);
                $this->setPregunta          ($producto['usr_preg']);
                $this->setRespuesta         ($producto['usr_resp']);
                $this->setDireccion         ($producto['usr_dir']);
                $this->setCod_Postal       	($producto['usr_cod_postal']);
                $this->setPais              ($producto['usr_pais']);
                $this->setTipo 				($producto['usr_tipo_cuenta']);
                $this->setUltima_Mod        ($producto['usr_ultima_mod']);
                $this->setFecha_Creada		($producto['usr_tcreated']);
            }
        }
        catch(Exception $e) {
            $retorno = false;
        }
        return $retorno;
	}

	// Guardamos la data del cliente (solo usar en registro)
	public function registrar_cliente($name, $pw_reg, $email, $tipo, $preg, $resp_reg, $dir_reg, $pais, $cp)
	{
		$query = "INSERT INTO usuarios (usr_name, usr_pw, usr_email, usr_tipo_cuenta, usr_preg, usr_resp, usr_dir, usr_pais, usr_cod_postal) VALUES (\"".$name."\",\"".$pw_reg."\",\"".$email."\",\"".$tipo."\",\"".$preg."\",\"".$resp_reg."\",\"".$dir_reg."\",\"".$pais."\",".$cp.");";
        $retorno = true;

        try {
            $retorno = $this->conectorMySQL->insertQuery($query);
        }
        catch(Exception $e) {
            $retorno = false;
        }

        return $retorno;
	}

	// Devuelve si el usuario escribio un nombre aceptable (usamos regex)
	public function valid_username($user)
	{
		return preg_match('/^[A-Za-z][A-Za-z0-9]{2,31}$/', $user);
	}

	// Devuelve si escribio bien el email
	public function valid_email($email)
	{
		// Agregando la ultima parte chequea que despues del @ haya un '.'
		return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email);
	}

	// Devuelve si el usuario escribio un nombre aceptable (usamos regex)
	public function valid_pass($pw)
	{
		$len = strlen($pw);
		return (2 <= $len && $len <= 31);
	}

	// Devuelve si existe un usuario con ese nombre/email
	public function credentials_exists($user, $email)
	{
		$query = "SELECT usr_id FROM usuarios WHERE usr_name='".$user."' OR usr_email='".$email."';";
        $retorno = true;

        try {
            $arrayRetorno = $this->conectorMySQL->selectQuery($query);
            
            if( count($arrayRetorno) < 1 )
            	$retorno = false;
        }
        catch(Exception $e) {
            $retorno = false;
        }

        return $retorno;
	}

	// Compara dos contraseñas
	public function compare_pw($pw, $pw2)
	{
		return ($pw == $pw2);
	}

	// Update single data (usar para configuracion)
	public function update_field($field, $new_val)
	{
		$id = $this->id;

		$query = "UPDATE usuarios SET $field='".$new_val."', usr_ultima_mod=NOW() WHERE usr_id=".$id.";";
		$retorno = true;

		try {
			$retorno = $this->conectorMySQL->updateQuery($query);
        }
        catch(Exception $e) {
            $retorno = false;
        }

        return $retorno;
	}

	public function delete_user()
	{
		// Vars
		$id = $this->id;
		$tipo = $this->tipo;
		$var = ($tipo == "Cliente") ? 0 : 1;
		$retorno = true;

		try {
			$retorno = $this->conectorMySQL->deleteQuery("CALL eliminar_usuario( ".$id.", ".$var." );");
		}
		catch(Exception $e) {
            $retorno = false;
        }

        return $retorno;
	}
}
?>
