<?php
	require 'include_classes.php';

	// Ya esta logueado?
	if( isset($_SESSION['users']) )
	{
		if( $_SESSION['users']['usr_tipo_cuenta'] == "Administrador" )
			header('Location: admin/');
		else if( $_SESSION['users']['usr_tipo_cuenta'] == "Cliente" )
			header('Location: cliente/');
	}

	// Conexion
	$conectorSQL = ConectorMySql::getInstance();

	// Un poco de seguridad..
	$usr = $conectorSQL->escape_string($_POST['user_lg']);
	$pw = $conectorSQL->escape_string($_POST['pw_lg']);
	
	// Consultamos db
	$cons = "SELECT * FROM usuarios WHERE (usr_name LIKE BINARY '".$usr."' OR usr_email LIKE BINARY '".$usr."') AND usr_pw LIKE BINARY '".$pw."';";

	// Resultado
	$result = $conectorSQL->selectQuery($cons);
	
	// Encontramos el resultado?
	if( !empty($result) )
	{	
		// Asignamos las variables
		$_SESSION['users'] = $result[0];

		if( $_SESSION['users']['usr_tipo_cuenta'] == 'Cliente' )
			header('Location: cliente/');
		else
			header('Location: admin/');
	}
	else {
		echo "
		<script>
			alert('Usuario/Contraseña incorrectos!');
			window.location.href='./';
		</script>";
	}
?>