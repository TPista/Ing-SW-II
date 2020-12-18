<?php
	require '../../include_classes.php';

	if( isset($_SESSION['users']) )
	{
		if( $_SESSION['users']['usr_tipo_cuenta'] != "Administrador" )
			header('Location: ../../cliente/');
	}
	else {
		header('Location: ../../');
	}

	// Conexion
	$conectorSQL = ConectorMySql::getInstance();

	// Un poco de seguridad..
	$id = $_POST['id'];
	$p_titulo = $conectorSQL->escape_string($_POST['titulo_prod']);
	$p_cost = $_POST['cost_prod'];
	$p_marca = $conectorSQL->escape_string($_POST['marca_prod']);
	$p_color = $conectorSQL->escape_string($_POST['color_prod']);
	$p_cat = $conectorSQL->escape_string($_POST['cat_prod']);
	$p_talle = $conectorSQL->escape_string($_POST['talle_prod']);
	$p_usado = $conectorSQL->escape_string($_POST['usado_prod']);
	$p_info = $conectorSQL->escape_string($_POST['info_prod']);

	// Consultamos db
	$query = "UPDATE productos SET prod_titulo=\"".$p_titulo."\", prod_cost=".$p_cost.", prod_marca=\"".$p_marca."\", prod_categoria=\"".$p_cat."\", prod_talle=\"".$p_talle."\", prod_color=\"".$p_color."\", prod_usado=\"".$p_usado."\", prod_descripcion=\"".$p_info."\" WHERE prod_id=".$id.";";

	$result = $conectorSQL->updateQuery($query);

	// Agregamos la foto del producto (si la hay)
	if( !$_FILES['fileInput']['error'] )
	{
		/* Tipos de archivos permitidos -> para que no suban cualquier archivo como foto */
		$permitidos = array( "image/jpg", "image/png", "image/jpeg" );
		
		if( in_array($_FILES['fileInput']['type'], $permitidos) )
		{
			$terminacion = explode('.', $_FILES['fileInput']['name'])[1];
			$foto = "../../fotos_productos/".$id.".".$terminacion;

			// Si existe la borramos
			if( file_exists($foto) )
				unlink($foto);
			
			// Copiamos la nueva
			$result = @move_uploaded_file($_FILES['fileInput']['tmp_name'], $foto);
			
			if( $result )
				echo "Archivo Guardado";
			else
				echo "Error al guardar archivo";
		}
		else
			echo "Archivo no permitido o excede el tamaño";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Eliminar Productos</title>

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
			padding-top: 10px;
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
					<a class="nav-link active" href="./">Mis Productos</a>
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
	
	<div class="container">
		<?php
		if( $result )
			echo "<h3>Producto actualizado correctamente!</h3>";
		else
			echo "<h3>ERROR AL ACTUALIZAR PRODUCTO</h3>";
		?>
		<br>
		<a href="./" class="btn btn-primary">Regresar</a>
	</div>
</body>
</html>