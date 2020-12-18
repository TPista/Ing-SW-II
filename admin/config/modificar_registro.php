<?php
	require '../../include_classes.php';

	if( isset($_SESSION['users']) )
	{
		if( $_SESSION['users']['usr_tipo_cuenta'] != "Administrador" )
			header('Location: ../../cliente/');
	}
	else
		header('Location: ../../');

	// Conector
	$conectorSQL = ConectorMySql::getInstance();

	// User Class
	$id = $_SESSION['users']['usr_id'];
	$usr = new User($id);

	// Vars
	$new_val = $conectorSQL->escape_string($_POST['new_val']);
	$error = "";
	$error = filtrar_datos($usr, $new_val);

	// Funcion que hace todos los chequeos
	function filtrar_datos($usr, $new_val)
	{
		// Array con los campos y sus valores actuales
		$campos = array(
			'usr_dir' => $usr->getDireccion(),
			'usr_email' => $usr->getEmail(),
			'usr_name' => $usr->getName(),
			'usr_resp' => $usr->getRespuesta(),
			'usr_cod_postal' => $usr->getCod_Postal(),
			'usr_dir' => $usr->getDireccion(),
			'usr_pw' => $usr->getPass() );
		$curr_val = '';
		$error = "";
		$result = true;

		// Nos fijamos cual recibimos para ver que hacer
		foreach ($campos as $key => $value) {
			if( isset($_POST[$key]) ) {
				$field = $key;
				$curr_val = $value;
			}
		}

		// Comparamos con el actual para ver que no sean iguales
		if( $new_val == $curr_val )
		{
			$result = false;
			$error = "<b>El registro ingresado es igual al anterior!</b>";
		}

		// Chequeos extra para el nombre y el email
		if( $result && ( $field == 'usr_name' || $field == 'usr_email') )
		{
			// Email/Usuario valido?
			if( $field == 'usr_name' ) {
				$result = $usr->valid_username($new_val);

				if( !$result )
					$error = "<b>Nombre invalido de usuario!</b><br>
								Recuerda:<br>
								- Entre 3 y 31 caracteres.<br>
								- Solo letras y números.<br><br>";
			}
			else {
				$result = $usr->valid_email($new_val);

				if( !$result )
					$error = "<b>Email invalido! Debe contener un '@'!</b><br>";
			}

			// Chequeamos si existe
			if( $result && $usr->credentials_exists($new_val, $new_val) )
			{
				$result = false;
				$error = "<b>El Usuario/Email ingresado esta en uso!</b><br>";
			}
		}

		// Si es contraseña..
		if( $result && $field == 'usr_pw' )
		{
			$result = $usr->valid_pass($new_val);
			
			if( !$result )
				$error = "<b>Contraseña invalida! Debe tener entre 2 y 31 caracteres.</b><br>";
		}

		// Llegamos sin errores..
		if( $result )
		{
			$result = $usr->update_field($field, $new_val);

			if( !$result )
				$error = "<b>Error al ingresar datos en la tabla</b>";
			else
				$_SESSION["users"][$field] = $new_val;
		}

		return $error;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Modificar Registro</title>

	<link rel="stylesheet" href="../../font-awesome/css/all.min.css">
	<link rel="stylesheet" href="../../css/bootstrap.min.css">

	<script src="../../js/jquery-3.4.1.min.js"></script>
	<script src="../../js/popper.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>

	<style type="text/css">
		body {
			background-color: #ebebeb;
			text-align: center;
		}
	</style>
</head>

<body>
	<nav class="mb-1 navbar navbar-expand-lg bg-primary navbar-dark orange lighten-1">
		<div class="collapse navbar-collapse">
			<!-- Izquierda -->
		   <ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="../">Inicio</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../productos/">Mis Productos</a>
				</li>
				<li class="nav-item">
		        	<a class="nav-link" href="../historial_compras/">Historial de Compras</a>
				</li>
			</ul>

			<!-- Medio -->
			<ul class="navbar-nav mr-auto">
				<a class="navbar-brand" href="../contacto/">CAPICA S.A</a>
			</ul>

			<!-- Derecha -->
		    <ul class="navbar-nav ml-auto nav-flex-icons">
		    	<li class="nav-item dropdown">
		        	<a class="nav-link active" id="navbarDropdownMenuLink" data-toggle="dropdown"
		          	aria-haspopup="true" aria-expanded="false">
		          		<i class="fa fa-fw fa-user"></i>
		        	</a>
		        	<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
		          		<a class="dropdown-item" href="./">Editar Perfil</a>
		          		<a class="dropdown-item" href="../../logout.php">Cerrar Sesión</a>
		        	</div>
		      	</li>
		    </ul>

		</div>
	</nav>

	<br/><br/>

	<div class="container">
		<?php
		if( empty($error) )
			echo "<h3>REGISTRO MODIFICADO!</h3>";
		else
			echo "<h3>Error al modificar</h3><br>".$error;
		?>
		<br/>
		<a href="./" class="btn btn-primary">Regresar</a>
	</div>
</body>
</html>
