<?php
	require 'include_classes.php';

	if( isset($_SESSION['users']) )
	{
		if( $_SESSION['users']['usr_tipo_cuenta'] == "Administrador" )
			header('Location: admin/');
		else if( $_SESSION['users']['usr_tipo_cuenta'] == "Cliente" )
			header('Location: cliente/');
	}

	// Errores y demas
	$result = true;
	$error = "";

	// Conexion
	$conectorSQL = ConectorMySql::getInstance();

	// Usuario
	$usr = new User();

	// Usuario valido?
	$name = $conectorSQL->escape_string($_POST['user_reg']);

	if( !($usr->valid_username($name)) )
	{
		$result = false;
		$error = "<b>Nombre invalido de usuario!</b><br>
				Recuerda:<br>
				- Entre 3 y 31 caracteres.<br>
				- Solo letras y números.<br><br>";
	}

	// Email valido?
	$email = $conectorSQL->escape_string($_POST['email_reg']);

	if( !($usr->valid_email($email)) && $result )
	{
		$result = false;
		$error = "<b>Email invalido! Debe contener un '@'!</b><br>";
	}

	// El usuario ya existe?
	if( $usr->credentials_exists($name, $email) && $result )
	{
		$result = false;
		$error = "<b>Usuario/Email en uso! Intenta con otro</b><br>";
	}

	// Contraseñas
	$pw_reg = $conectorSQL->escape_string($_POST['pw_reg']);
	$pw2_reg = $conectorSQL->escape_string($_POST['pw2_reg']);

	// Longitud de contraseña
	if( !($usr->valid_pass($pw_reg)) )
	{
		$result = false;
		$error = "<b>La contraseña debe tener entre 2 y 31 caracteres!</b><br>";
	}

	// Contraseñas coinciden?
	if( !($usr->compare_pw($pw_reg, $pw2_reg) ) )
	{
		$result = false;
		$error = "<b>Las contraseñas no coinciden!</b><br>";
	}
	
	// Si no hay errores, seguimos...
	if( $result )
	{
		// Un poco de seguridad..
		$resp_reg = $conectorSQL->escape_string($_POST['resp_reg']);
		$dir_reg = $conectorSQL->escape_string($_POST['dir_reg']);
		$pais = $conectorSQL->escape_string($_POST['pais_reg']);
		$cp = $_POST['cp_reg'];
		$tipo = $conectorSQL->escape_string($_POST['reg_tipo_cuenta']);
		$preg = $conectorSQL->escape_string($_POST['preg_reg']);

		$result = $usr->registrar_cliente($name,$pw_reg,$email,$tipo,$preg,$resp_reg,$dir_reg,$pais,$cp);

		if( !$result )
			$error = "Error al crear la cuenta!";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<Title>Registro</title>

	<link rel="stylesheet" href="css/index_signup.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<style type="text/css">
		body {
			background-color: #ebebeb;
		}
	</style>
</head>

<body>
	<nav class="mb-1 navbar navbar-expand-lg bg-primary navbar-dark orange lighten-1">
		<ul class="navbar-nav m-auto">
			<a class="navbar-brand" href="./">CAPICA S.A</a>
		</ul>
	</nav>

	</br>
	<h2>Registrarme</h2>
	</br>

	<div class="container">
	<?php
		if( $result )
			echo "
	    	<h6><b>Sus datos han sido registrados éxitosamente!</b></h6>
	    	<p><a href='./'>Loguearme</a></p>";
	    else
	    	echo $error."<p><a href='index_signup.php'>Intentalo de nuevo!</a></p>";
	?>
</div>
</body>
</html>