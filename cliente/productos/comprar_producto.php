<?php
	require '../../include_classes.php';

	if( isset($_SESSION['users']) )
	{
		if( $_SESSION['users']['usr_tipo_cuenta'] != "Cliente" )
			header('Location: ../../admin/');
	}
	else {
		header('Location: ../../');
	}

	// Conexion
	$conectorSQL = ConectorMySql::getInstance();

	// Un poco de seguridad..
	$cl_id = $_SESSION['users']['usr_id'];
	$prod_id = $_POST['p_id'];
	$adm_id = $_POST['adm_id'];
	$p_titulo = $conectorSQL->escape_string($_POST['p_titulo']);
	$p_cost = $_POST['p_cost'];
	$href = "./?id=".$prod_id."&last_dir=".$_POST['last_dir'];

	$query = "CALL comprar_producto(".$prod_id.", ".$adm_id.", ".$cl_id.", \"".$p_titulo."\", ".$p_cost.");";
	$cons = $conectorSQL->insertQuery($query);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Comprar Producto</title>

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

		h3 {
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
		        	<a class="nav-link" href="../historial_compras/">Historial de Compras</a>
				</li>
			</ul>

			<!-- Medio -->
			<ul class="navbar-nav mr-auto">
				<a class="navbar-brand" href="../contacto/">CAPICA S.A</a>
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
	
	<br/>
	<h1>Comprar Producto</h1>
	</br>
	
	<div class="container">
		<?php
			if( $cons )
				echo "<h3>Felicidades!\n Compraste \"".$p_titulo."\" por un increible precio de $".$p_cost."</h3>";
			else
				echo "<h3>ERROR AL COMPRAR PRODUCTO</h3>";
		?>
		<br>
		<a href="<?php echo $href; ?>" class="btn btn-primary">Regresar al producto</a>
	</div>

</body>
</html>