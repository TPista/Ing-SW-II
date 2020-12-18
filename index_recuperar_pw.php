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
	
	// Hay algun parametro vacio?
	if( !empty($_POST['user_rec']) && !empty($_POST['resp_recu']) )
	{
		// Conexion
		$conectorSQL = ConectorMySql::getInstance();

		// Un poco de seguridad..
		$usr = $conectorSQL->escape_string($_POST['user_rec']);
		$resp = $conectorSQL->escape_string($_POST['resp_recu']);
		$preg = $conectorSQL->escape_string($_POST['preg_recu']);

		// Consultamos db
		$cons = "SELECT usr_pw FROM usuarios
		WHERE (usr_name LIKE BINARY '".$usr."' OR usr_email LIKE BINARY '".$usr."') AND
		usr_preg = \"".$preg."\" AND usr_resp LIKE BINARY '".$resp."';";

		// Resultado
		$result = $conectorSQL->selectQuery($cons);
		
		// Ejecutamos la consulta
		if( !empty($result) ) {
			$pw = $result[0][0];
			echo "<script type='text/javascript'>alert('Tu contraseña es: ".$pw."')</script>";
		}
		else
			echo "<script type='text/javascript'>alert('Usuario/Respuesta erroneas')</script>";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Recuperar Contraseña</title>
	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/index_rec_pw.css">
</head>

<body>
	<nav class="mb-1 navbar navbar-expand-lg bg-primary navbar-dark orange lighten-1">
		<ul class="navbar-nav m-auto">
			<a class="navbar-brand" href="./">CAPICA S.A</a>
		</ul>
	</nav>
	
	<div class="container">
		<h1>Recuperar Contraseña</h1>
		<hr><br/>
		<form id="formdata" class="was-validated" action="index_recuperar_pw.php" method="post">
			<table cellspacing="3" cellpadding="3">
				<h6>Elegir pregunta de seguridad que eligió cuando se registró</h6></td>
				<select name="preg_recu">
					<option value="Cual es el nombre de mi madre?">Cual es el nombre de mi madre?</option>
					<option value="Cual es el nombre de mi mascota?">Cual es el nombre de mi mascota?</option>
					<option value="Nombre de tu club favorito de futbol">Nombre de tu club favorito de futbol</option>
				</select>
				<hr>
				<tr>
					<td><label for="user_rec">Usuario <span class="text-danger">*</span></label></td>
					<td><input type="text" id="user_rec" name="user_rec" required placeholder="Usuario/email"></td>
				</tr>
				<tr>
					<td><label for="resp_recu">Respuesta Seguridad <span class="text-danger">*</span></label></td>
					<td><input type="text" id="resp_recu" name="resp_recu" required placeholder="Respuesta a la pregunta"></td>
				</tr>
			</table>
			<br/>
			<input type="submit" value="Recuperar Contraseña">
			<p><a href="./">Volver a login</a></p>
		</form>
	</div>
</body>
</html>