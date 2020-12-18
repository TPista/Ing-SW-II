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

	// User Class
	$id = $_SESSION['users']['usr_id'];
	$usr = new User($id);

	// Obtenemos los datos de la otra pag
	$field = $_GET['id'];
	$name = str_replace("+", " ", $_GET['name']);

	$data = get_field_data($usr, $field);
	$prefix = get_prefix($field, $name);
	$type = get_field_type($field);

	// Obtenemos el tipo de campo necesitamos
	function get_field_type($field)
	{
		if( $field == "usr_email" )
			return "email";
		else if( $field == "usr_cod_postal" )
			return "number";
		else
			return "text";
	}

	// Obtenemos la informacion segun el campo
	function get_field_data($usr, $field)
	{
		$campos = array(
			'usr_dir' => $usr->getDireccion(),
			'usr_email' => $usr->getEmail(),
			'usr_name' => $usr->getName(),
			'usr_resp' => $usr->getRespuesta(),
			'usr_cod_postal' => $usr->getCod_Postal(),
			'usr_dir' => $usr->getDireccion(),
			'usr_pw' => $usr->getPass());
		$data = '';

		foreach ($campos as $key => $value) {
			if( $field == $key )
				$data = $value;
		}

		return $data;
	}

	// Para imprimir los datos
	function pr_data($field, $data)
	{
		if( $field=="usr_pw" OR $field=="usr_resp" )
		{
			$len = strlen($_SESSION['users'][$data]);

			for( $i = 0; $i < $len; ++$i )
				echo "*";
		}
		else
			echo $_SESSION['users'][$data];
	}

	// Para imprimir el prefijo
	function get_prefix($field)
	{
		$str = "Nuev";

		if( $field == "usr_email" || $field == "usr_name" || $field == "usr_cod_postal" )
			$str .= "o";
		else
			$str .= "a";

		return $str;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Editar Usuario</title>

	<link rel="stylesheet" href="../../font-awesome/css/all.min.css">
	<link rel="stylesheet" href="../../css/bootstrap.min.css">

	<script src="../../js/jquery-3.4.1.min.js"></script>
	<script src="../../js/popper.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
	<style type="text/css">
		body { background-color: #ebebeb; }
		h2 { text-align: center; }
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

	<br/><br/>

	<div class="container">
		<h2>Editar <?php echo $name;?></h2>
		</br>
		
		<form class="form-horizontal" method="POST" action="modificar_registro.php" autocomplete="off">
			<?php
			echo "
			<div class='form-group'>
				<label class='col-sm-2 control-label'>
					$name Actual
				</label>
				<div class='col-sm-10'>
					<input type='text' class='form-control' id=$field name=$field placeholder=$data readonly>
				</div>
			</div>

			<div class='form-group'>
				<label class='col-sm-2 control-label'>$prefix $name</label>
				<div class='col-sm-10'>
					<input type=".$type." class='form-control' name='new_val' placeholder='$prefix $name' required autofocus>
				</div>
			</div>";
			?>

			<br/>

			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary">Guardar</button>
					<a href="./" class="btn btn-default">Regresar</a>
				</div>
			</div>
		</form>
	</div>

</body>
</html>