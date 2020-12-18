<?php
	session_start();

	if( isset($_SESSION['users']) )
	{
		if( $_SESSION['users']['usr_tipo_cuenta'] != "Administrador" )
			header('Location: ../../cliente/');
	}
	else {
		header('Location: ../../');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Eliminar Usuario</title>

	<link rel="stylesheet" href="../../font-awesome/css/all.min.css">
	<link rel="stylesheet" href="../../css/bootstrap.min.css">

	<script src="../../js/jquery-3.4.1.min.js"></script>
	<script src="../../js/popper.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="../../css/index_eliminar_usuario.css">
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
		        	<a class="nav-link" href="../historial_ventas/">Historial de Ventas</a>
				</li>
			</ul>

			<!-- Medio -->
			<ul class="navbar-nav mr-auto">
				<a class="navbar-brand" href="../contacto/">CAPICA S.A</a>
			</ul>

			<!-- Derecha -->
		    <ul class="navbar-nav ml-auto nav-flex-icons">
	            <li class="nav-item dropdown">
					<a class="nav-link" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-shopping-cart"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="../pedidos/">Ver Carrito</a>
					</div>
	            </li>
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

	<div class="container">
		<h1>Eliminar Usuario</h1>
		<p>Al eliminar el usuario se borraran todos los datos y perderá todo, no hay vuelta atrás.</p>
		<p>Desea continuar?</p>
		<div class="divBotones">
			<a href="eliminar_usuario.php" class="btn btn-danger">Eliminar</a>
			<a href="./" class="btn btn-primary">Regresar</a>
		</div>
	</div>
</body>
</html>