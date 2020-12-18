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
	<title>Agregar Producto</title>

	<link rel="stylesheet" href="../../font-awesome/css/all.min.css">
	<link rel="stylesheet" href="../../css/bootstrap.min.css">

	<script src="../../js/jquery-3.4.1.min.js"></script>
	<script src="../../js/popper.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>

	<script src="../../js/index_agregar_producto.js"></script>
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
		<h1>Agregar Producto</h1>
		<hr>
		<form method="post" action="agregar_producto.php" class="formAddProd" enctype="multipart/form-data" autocomplete="off">
			<div class="divFoto">
				<h6><b>Imagen del Producto</b></h6>
				<img id="prod_img" class="prod_img" width="284" height="284" src="" alt="imgProd">
				</br></br>
				<input type="file" class="hidden" name="fileInput" id="fileInput" accept="image/*">
				<a href="" class="btn btn-danger" onclick="document.getElementById('prod_img').src = ''">Borrar Archivo</a>
			</div>
			
			<hr>

			<div class="divGrande">
				<h6><b>Caracteristicas:</b></h6>
				<table cellspacing="3" cellpadding="3">
					<tr>
						<td class="titulo"><label for="titulo_prod">Titulo <span class="text-danger">*</span></label></td>
						<td><input type="text" id="titulo_prod" name="titulo_prod" required placeholder="Ingresar Titulo"></td>
					</tr>
					
					<tr>
						<td class="titulo"><label for="marca_prod">Marca <span class="text-danger">*</span></label></td>
						<td><input type="text" id="marca_prod" name="marca_prod" required placeholder="Ingresar Marca"></td>
					</tr>

					<tr>
						<td class="titulo"><label for="cost_prod">Precio <span class="text-danger">*</span></label></td>
						<td><input type="number" id="cost_prod" name="cost_prod" required placeholder="Ingresar Precio"></td>
					</tr>
				</table>

				<table cellspacing="2" cellpadding="2">
					<tr>
						<td class="titulo"><label for="color_prod">Color <span class="text-danger">*</span></label></td>
						<td><input type="text" id="color_prod" name="color_prod" required placeholder="Ingresar Color"></td>

						<td class="titulo"><label for="talle_prod">Talle <span class="text-danger">*</span></label></td>
						<td><input type="text" id="talle_prod" name="talle_prod" required placeholder="Ingresar Talle"></td>
					</tr>
					
					<tr>
						<td class="titulo"><label for="cat_prod">Categoria </label></td>
						<td><select name="cat_prod">
								<option value="Unisex">Unisex</option>
								<option value="Hombre">Hombre</option>
								<option value="Mujer">Mujer</option>
								<option value="Niños">Niños</option>
								<option value="Bebes">Bebes</option>
							</select>
						</td>

						<td class="titulo"><label for="usado_prod">Estado</label></td>
						<td><select name="usado_prod">
								<option value="Nuevo">Nuevo</option>
								<option value="Usado">Usado</option>
							</select>
						</td>
				</table>
			</div>

			<br></br>

			<hr>
			
			<div class="divDescripcion">
				<label for="info_prod">Descripción <span class="text-danger">*</span></label></br>
				<textarea id="info_prod" name="info_prod" rows="3" cols="50"></textarea>
			</div>

			</br>

			<input type="submit" class="button_add" value="Agregar Producto">
			<a href="./">Volver</a>
		</form>
	</div>
</body>
</html>