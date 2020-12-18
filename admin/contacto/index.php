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
	<title>Contacto</title>

	<link rel="stylesheet" href="../../font-awesome/css/all.min.css">
	<link rel="stylesheet" href="../../css/bootstrap.min.css">

	<script src="../../js/jquery-3.4.1.min.js"></script>
	<script src="../../js/popper.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="../../css/index_contacto.css">
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
				<a class="navbar-brand" href="./">CAPICA S.A</a>
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
	<h1 align="center">Contacto</h1>
	</br>

	<div class="container">
		<div class="contactInfo">
			<div class="infoNosotros">
				<h4 class="Titulo">Nuestros datos</h4>
				<span class="infoTitulo">Teléfono:</span> <span class="infoDatos">15-5555-5555</span><br>
				<span class="infoTitulo">Email:</span> <span class="infoDatos">capica@gmail.com</span><br>
				<span class="infoTitulo">Redes Sociales:</span>
					<a href="https://facebook.com/CAPICA" class="aIcono">
			 			<i class="fab fa-facebook fa-2x"></i>
			 		</a>
			 		<a href="https://twitter.com/CAPICA" class="aIcono">
			 			<i class="fab fa-twitter fa-2x"></i>
			 		</a>
			 		<a href="https://instagram.com/CAPICA" class="aIcono">
			 			<i class="fab fa-instagram fa-2x"></i>
			 		</a>
			</div>
			<hr>
			<div class="infoLocal">
				<h4 class="Titulo">Nuestra sucursal</h4>
				<span class="infoSubTitulo">Zabala 1837, Buenos Aires</span><br><br>
				<span class="infoTitulo">Horarios:</span>
				<ol class="orderList">
					<li><span class="infoSubTitulo">Lunes:</span> <span class="infoDatos">9-18hs</span></li>
					<li><span class="infoSubTitulo">Martes:</span> <span class="infoDatos">9-18hs</span></li>
					<li><span class="infoSubTitulo">Miercoles:</span> <span class="infoDatos">9-18hs</span></li>
					<li><span class="infoSubTitulo">Jueves:</span> <span class="infoDatos">8-16hs</span></li>
					<li><span class="infoSubTitulo">Viernes:</span> <span class="infoDatos">9-15hs</span></li>
				</ol>
			</div>
		</div>

		<div class="googleMap">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3285.594292162437!2d-58.44434421500386!3d-34.563826281811295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcb5c8936d7be3%3A0x864ef69ee3e2d3f!2sUniversidad+de+Belgrano!5e0!3m2!1ses!2sar!4v1563051220681!5m2!1ses!2sar" width="600" height="450" frameborder="0" style="border:0" allowfullscreen>
			</iframe>
		</div>
	</div>
</body>
</html>