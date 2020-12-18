<?php
	session_start();

	if( isset($_SESSION['users']) )
	{
		if( $_SESSION['users']['usr_tipo_cuenta'] != "Cliente" )
			header('Location: ../../admin/');
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
	<title>Historial de Compras</title>

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

	<script src="../../js/index_historial_compras.js"></script>
	<link rel="stylesheet" href="../../css/index_historial_compras.css">
</head>

<body>
	<nav class="mb-1 navbar navbar-expand-lg bg-primary navbar-dark orange lighten-1">
		<div class="collapse navbar-collapse">
			<!-- Izquierda -->
		    <ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="../">Inicio</a>
				</li>
				<li class="nav-item active">
		        	<a class="nav-link" href="./">Historial de Compras</a>
				</li>
			</ul>

			<!-- Medio -->
			<ul class="navbar-nav mr-auto">
				<a class="navbar-brand" href="../contacto/">CAPICA S.A</a>
			</ul>

			<!-- Derecha -->
		    <ul class="navbar-nav ml-auto nav-flex-icons">
		    	<form class="form-inline my-2 my-lg-0" method="get" action="../buscar/">
            		<input class="form-control mr-sm-2" type="search" name="name" placeholder="Search..." aria-label="Search">
          		</form>
	            <li class="nav-item dropdown">
					<a class="nav-link" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-shopping-cart"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="../carrito/">Ver Carrito</a>
					</div>
	            </li>
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
	<h1 align="center">Mi historial de Compras</h1>
	</br>

	<div class="container">
		<div class="row">			
			<div class="row table-responsive">
				<table class="table table-striped table-bordered" style="width:100%" id="mitabla">
					<thead>
						<tr>
							<th>Vendedor</th>
							<th>Producto</th>
							<th>Precio ($)</th>
							<th>Dia y Hora Comprado</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>