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

	// Clase Usuario
	$id = $_SESSION['users']['usr_id'];
	$usr = new User($id);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Editar Perfil</title>

	<link rel="stylesheet" href="../../font-awesome/css/all.min.css">
	<link rel="stylesheet" href="../../css/bootstrap.min.css">

	<script src="../../js/jquery-3.4.1.min.js"></script>
	<script src="../../js/popper.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="../../css/index_configurar_admin.css">
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
	
	<div class="container-table">
		<div class="wrap-table">
			<h2>Editar Informacion Personal</h2></br>
			<div class="table">
				<form method="post">
					<table>
						<thead>
							<tr class="table-head">
								<th class="column1">Tipo</th>
								<th class="column2">Datos</th>
								<th class="column3">Editar</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="column1">Usuario</td>
								<td class="column2"><?php echo $usr->getName();?></td>
								<td class="column3">
									<a href="index_editar_registro.php?name=Usuario&id=usr_name">
									<i class="fa fa-edit"></i>
									</a>
								</td>
							</tr>

							<tr>
								<td class="column1">Constraseña</td>
								<td class="column2">
									<?php
										$len = strlen($usr->getPass());

										for( $i = 0; $i < $len; ++$i )
											echo "*";
									?>
								</td>
								<td class="column3">
									<a href="index_editar_registro.php?name=Contraseña&id=usr_pw">
									<i class="fa fa-edit"></i>
									</a>
								</td>
							</tr>
							
							<tr>
								<td class="column1">Email</td>
								<td><?php echo $usr->getEmail();?></td>
								<td>
									<a href="index_editar_registro.php?name=Email&id=usr_email">
									<i class="fa fa-edit"></i>
									</a>
								</td>
							</tr>
							
							<tr>
								<td class="column1">Pregunta de seguridad</td>
								<td class="column2"><?php echo $usr->getPregunta();?></td>
								<td class="column3">-</td>
							</tr>

							<tr>
								<td class="column1">Respuesta de seguridad</td>
								<td class="column2">
									<?php
										$len = strlen($usr->getRespuesta());

										for( $i = 0; $i < $len; ++$i )
											echo "*";
									?>	
								</td>
								<td class="column3">
									<a href="index_editar_registro.php?name=Respuesta+de+Seguridad&id=usr_resp">
									<i class="fa fa-edit"></i>
									</a>
								</td>
							</tr>

							<tr>
								<td class="column1">Pais</td>
								<td class="column2"><?php echo $usr->getPais();?></td>
								<td class="column3">-</td>
							</tr>
							
							<tr>
								<td class="column1">Dirección</td>
								<td class="column2"><?php echo $usr->getDireccion();?></td>
								<td class="column3">
									<a href="index_editar_registro.php?name=Direccion&id=usr_dir">
									<i class="fa fa-edit"></i>
									</a>
								</td>
							</tr>

							<tr>
								<td class="column1">Codigo Postal</td>
								<td class="column2"><?php echo $usr->getCod_Postal();?></td>
								<td class="column3">
									<a href="index_editar_registro.php?name=Codigo+Postal&id=usr_cod_postal">
									<i class="fa fa-edit"></i>
									</a>
								</td>
							</tr>

							<tr>
								<td class="column1">Tipo de Usuario</td>
								<td class="column2"><?php echo $usr->getTipo();?></td>
								<td class="column3">-</td>
							</tr>
							
							<tr>
								<td class="column1">Fecha de creacion</td>
								<td class="column2"><?php echo $usr->getFecha_Creada();?></td>
								<td class="column3">-</td>
							</tr>
							
							<tr>
								<td class="column1">Fecha de ultima modificacion</td>
								<td class="column2"><?php echo $usr->getUltima_Mod();?></td>
								<td class="column3">-</td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
			<br>
			<a href="index_eliminar_usuario.php" class="btn btn-danger">Eliminar cuenta</a>
		</div>
	</div>
</body>
</html>