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
	$id = $_GET['id'];

	// Consultamos db
	$result = $conectorSQL->selectQuery("SELECT * FROM productos WHERE prod_id = ".$id.";")[0];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Modificar Producto</title>

	<link rel="stylesheet" href="../../font-awesome/css/all.min.css">
	<link rel="stylesheet" href="../../css/bootstrap.min.css">

	<script src="../../js/jquery-3.4.1.min.js"></script>
	<script src="../../js/popper.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>

	<script src="../../js/index_modificar_producto.js"></script>
	<link rel="stylesheet" href="../../css/index_agregar_producto.css">
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
		<input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
		<h1>Modificar Producto</h1>
		<hr>

		<form method="post" action="modificar_producto.php" class="formAddProd" enctype="multipart/form-data" autocomplete="off">
			<div class='divFoto'>
				<h6><b>Imagen del Producto</b></h6>
				<?php
					$foto = "../../fotos_productos/sin_foto.jpg";

					foreach (['.jpg','.jpeg','.png'] as $variable) {
			            $path = "../../fotos_productos/".$id.$variable;
			            if( file_exists($path) )
			            {
			                $foto = $path;
			                $var = 1;
			            }
			        }

					// Hay foto?
					if( !empty($var) )
					{
						echo "
							<img id='prod_img' class='prod_img' src='$foto' alt='imgProd'>
							</br></br>
							<input type='file' class='hidden' name='fileInput' id='fileInput'>
							<a href='borrar_foto_producto.php?id=".$id."' class='btn btn-danger'>
								Borrar Archivo
							</a>";
					}
					else
					{
						echo "
							<img id='prod_img' class='prod_img' width='284' height='284' src='$foto' alt='imgProd'>
							</br></br>
							<input type='file' class='hidden' name='fileInput' id='fileInput' accept=\"image/*\">
							<a href='' class='btn btn-danger' onclick=\"document.getElementById('prod_img').src = ''\">Borrar Archivo</a>";
					}
				?>
			</div>

			<hr>
				
			<div class="divGrande">
				<h6><b>Caracteristicas:</b></h6>
				<table cellspacing="3" cellpadding="3">
					<tr>
						<td class="titulo"><label for="titulo_prod">Titulo <span class="text-danger">*</span></label></td>
						<td><input type="text" id="titulo_prod" name="titulo_prod" required value="<?php echo $result['prod_titulo']; ?>"></td>
					</tr>

					<tr>
						<td class="titulo"><label for="marca_prod">Marca <span class="text-danger">*</span></label></td>
						<td><input type="text" id="marca_prod" name="marca_prod" required value="<?php echo $result['prod_marca']; ?>"></td>
					</tr>

					<tr>
						<td class="titulo"><label for="cost_prod">Precio <span class="text-danger">*</span></label></td>
						<td><input type="number" id="cost_prod" name="cost_prod" required value="<?php echo $result['prod_cost']; ?>"></td>
					</tr>
				</table>

				<table cellspacing="2" cellpadding="2">
					<tr>
						<td class="titulo"><label for="color_prod">Color <span class="text-danger">*</span></label></td>
						<td><input type="text" id="color_prod" name="color_prod" required value="<?php echo $result['prod_color']; ?>"></td>

						<td class="titulo"><label for="talle_prod">Talle <span class="text-danger">*</span></label></td>
						<td><input type="text" id="talle_prod" name="talle_prod" required value="<?php echo $result['prod_talle']; ?>"></td>
					</tr>
					
					<tr>
						<td class="titulo"><label for="cat_prod">Categoria </label></td>
						<td><select name="cat_prod">
								<option value="Unisex" <?php if( $result['prod_categoria'] == "Unisex" ) echo 'selected="selected"'; ?> >Unisex</option>
								<option value="Hombre" <?php if( $result['prod_categoria'] == "Hombre" ) echo 'selected="selected"'; ?> >Hombre</option>
								<option value="Mujer" <?php if( $result['prod_categoria'] == "Mujer" ) echo 'selected="selected"'; ?> >Mujer</option>
								<option value="Niños" <?php if( $result['prod_categoria'] == "Niños" ) echo 'selected="selected"'; ?> >Niños</option>
								<option value="Bebes" <?php if( $result['prod_categoria'] == "Bebes" ) echo 'selected="selected"'; ?> >Bebes</option>
							</select>
						</td>

						<td class="titulo"><label for="usado_prod">Estado</label></td>
						<td><select name="usado_prod">
								<option value="Nuevo" <?php if( $result['prod_usado'] == "Nuevo" ) echo 'selected="selected"'; ?> >Nuevo</option>
								<option value="Usado" <?php if( $result['prod_usado'] == "Usado" ) echo 'selected="selected"'; ?> >Usado</option>
							</select>
						</td>
				</table>
			</div>

			<br></br>

			<hr>
			
			<div class="divDescripcion">
				<label for="info_prod">Descripción</label></br>
				<textarea id="info_prod" name="info_prod" rows="3" cols="50">
					<?php echo $result['prod_descripcion']; ?>
				</textarea>
			</div>

			</br>
			<input type="hidden" id="id" name="id" value="<?php echo $result['prod_id']; ?>">

			<input type="submit" class="button_add" value="Guardar">
			<br>
			<a href="./" class="btn btn-default">Regresar</a>
		</form>
	</div>
</body>
</html>