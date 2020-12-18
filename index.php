<?php
	session_start();

	if( isset($_SESSION['users']) )
	{
		if( $_SESSION['users']['usr_tipo_cuenta'] == "Administrador" )
			header('Location: admin/');
		else if( $_SESSION['users']['usr_tipo_cuenta'] == "Cliente" )
			header('Location: cliente/');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Login</title>

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/index_login.css">
</head>
<body>
	<nav class="mb-1 navbar navbar-expand-lg bg-primary navbar-dark orange lighten-1">
		<ul class="navbar-nav m-auto">
			<a class="navbar-brand" href="./">CAPICA S.A</a>
		</ul>
	</nav>
	
	<div class="container">
		<h1>Login</h1>
		<form action="login.php" class="was-validated" id="form_login" method="post">
			<div class="divLogin">
				<input type="text" id="user_lg" name="user_lg" required placeholder="Usuario o Email" />
				<input type="password" id="pw_lg" name="pw_lg" required placeholder="Contraseña" />

				<p><a href="index_recuperar_pw.php">Olvidaste tu contraseña?</a></p>

				<input type="submit" class="button_lg" value="Inicar Sesion">
			</div>
		</form>
		<p>No estas registrado? <a href="index_signup.php">Registrarme</a></p>
	</div>
</body>
</html>