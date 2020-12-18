<?php
	session_start();

	if( isset($_SESSION['users']) )
	{
		if( $_SESSION['users']['usr_tipo_cuenta'] != "Administrador" )
			header('Location: ../cliente/');
	}
	else {
		header('Location: ../');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Inicio</title>

	<link rel="stylesheet" href="../font-awesome/css/all.min.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">

	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/canvasjs.min.js"></script>

	<link rel="stylesheet" href="../css/index_admin.css">
	<script src="../js/index_admin.js"></script>
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
					<a class="nav-link" href="productos/">Mis Productos</a>
				</li>
				<li class="nav-item">
		        	<a class="nav-link" href="historial_ventas/">Historial de Ventas</a>
				</li>
			</ul>

			<!-- Medio -->
			<ul class="navbar-nav mr-auto">
				<a class="navbar-brand" href="contacto/">CAPICA S.A</a>
			</ul>

			<!-- Derecha -->
		    <ul class="navbar-nav ml-auto nav-flex-icons">
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

	<div class="container">
		<h2>
			<strong>Estadisticas de Administrador</strong>
		</h2>

		<div class="myTop">
			<div class="divPyV">
				<div class="card shadow">
					<h4 class="card-header">Productos y Ventas</h4>
					<div class="card-block">
						<div id="barchart"></div>
					</div>
				</div>
			</div>
			
			<div class="divVA">
				<div class="card shadow">
					<h4 class="card-header">Ventas Acumuladas</h4>
					<div class="card-block">
						<div id="otherchart"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="myBott">
			<div class="divMisPr">
				<div class="card shadow">
					<h4 class="card-header">Grafico de mis productos</h4>
					<div class="card-block">
						<div id="piechart"></div>
					</div>
				</div>
			</div>
			
			<div class="divPyC">
				<div class="card shadow">
					<h4 class="card-header">Productos y Costos</h4>
					<div class="card-block">
						<div id="chart"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>