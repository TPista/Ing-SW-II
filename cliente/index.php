<?php
	require '../include_classes.php';
	include_once('../class/carr_class.php'); // Solo se usa aca

	if( isset($_SESSION['users']) )
	{
		if( $_SESSION['users']['usr_tipo_cuenta'] != "Cliente" )
			header('Location: ../admin/');
	}
	else {
		header('Location: ../');
	}

	// Carrousel
	$carr_new = new Carrousel(1, "Productos Nuevos", "productos_carrousel_nuevo");
	$carr_used = new Carrousel(2, "Productos Usados", "productos_carrousel_usado");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Inicio</title>

	<link rel="stylesheet" href="../font-awesome/css/all.min.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">

	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="../css/index_cliente.css">
</head>

<body>
	<nav class="mb-1 navbar navbar-expand-lg bg-primary navbar-dark orange lighten-1">
		<div class="collapse navbar-collapse">
			<!-- Izquierda -->
		    <ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link active" href="./">Inicio</a>
				</li>
				<li class="nav-item">
		        	<a class="nav-link" href="historial_compras/">Historial de Compras</a>
				</li>
			</ul>

			<!-- Medio -->
			<ul class="navbar-nav mr-auto">
				<a class="navbar-brand" href="contacto/">CAPICA S.A</a>
			</ul>

			<!-- Derecha -->
		    <ul class="navbar-nav ml-auto nav-flex-icons">
				<form class="form-inline my-2 my-lg-0" method="get" action="buscar/">
            		<input class="form-control mr-sm-2" type="search" name="name" placeholder="Search..." aria-label="Search">
          		</form>
	            <li class="nav-item dropdown">
					<a class="nav-link" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-shopping-cart"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="carrito/">Ver Carrito</a>
					</div>
	            </li>
		    	<li class="nav-item dropdown">
		        	<a class="nav-link" id="navbarDropdownMenuLink" data-toggle="dropdown"
		          	aria-haspopup="true" aria-expanded="false">
		          		<i class="fa fa-fw fa-user"></i>
		        	</a>
		        	<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
		          		<a class="dropdown-item" href="config/">Editar Perfil</a>
		          		<a class="dropdown-item" href="../logout.php">Cerrar Sesión</a>
		        	</div>
		      	</li>
		    </ul>
		</div>
	</nav>

	<h1>Inicio</h1>

	<div class="global">
		<?php $carr_new->crear_carrousel(); ?>
		<br><br>
		<?php $carr_used->crear_carrousel(); ?>
	</div>
</body>
</html>