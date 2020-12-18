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
	<title>Historial de Ventas</title>

	<link rel="stylesheet" href="../../font-awesome/css/all.min.css">
	<link rel="stylesheet" href="../../css/bootstrap.min.css">

	<link rel="stylesheet" href="../../css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="../../css/buttons.bootstrap4.min.css">

	<script src="../../js/jquery-3.4.1.min.js"></script>
	<script src="../../js/popper.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
	<script src="../../js/jquery.dataTables.min.js"></script>

	<script src="../../js/dataTables.bootstrap4.min.js"></script>
	<script src="../../js/dataTables.buttons.min.js"></script>
	<script src="../../js/buttons.bootstrap4.min.js"></script>

	<script src="../../js/jszip.min.js"></script>
	
	<script src="../../js/pdfmake/pdfmake.min.js"></script>
	<script src="../../js/pdfmake/vfs_fonts.js"></script>
	<script src="../../js/buttons.html5.min.js"></script>
	<script src="../../js/buttons.print.min.js"></script>
	<script src="../../js/buttons.colVis.min.js"></script>

	<script src="../../js/index_historial_ventas.js"></script>
	<link rel="stylesheet" href="../../css/index_historial_ventas.css">
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
		        	<a class="nav-link active" href="./">Historial de Ventas</a>
				</li>
			</ul>

			<!-- Medio -->
			<ul class="navbar-nav mr-auto">
				<a class="navbar-brand" href="../contacto/">CAPICA S.A</a>
			</ul>

			<!-- Derecha -->
		    <ul class="navbar-nav ml-auto nav-flex-icons">
		    	<li class="nav-item dropdown">
		        	<a class="nav-link" id="navbarDropdownMenuLink" data-toggle="dropdown"
		          	aria-haspopup="true" aria-expanded="false">
		          		<i class="fa fa-fw fa-user"></i>
		        	</a>
		        	<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
		          		<a class="dropdown-item" href="../config/">Editar Perfil</a>
		          		<a class="dropdown-item" href="../../logout.php">Cerrar Sesión</a>
		        	</div>
		      	</li>
		    </ul>

		</div>
	</nav>
	
	</br>
	<h1 align="center">Mi historial de Ventas</h1>
	</br>

	<div class="container">
		<div class="row">	
			<div class="row table-responsive">
				<table class="table table-striped table-bordered" style="width:100%" id="mitabla">
					<thead>
						<tr>
							<th>Producto</th>
							<th>Comprador</th>
							<th>Precio ($)</th>
							<th>Dia Vendido</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>