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
	$id = $_SESSION['users']['usr_id'];

	// Consultamos db
	$result = $conectorSQL->selectQuery("SELECT prod_titulo, prod_cost FROM productos WHERE prod_adm_id=".$id."");

	$data_points = array();

	foreach ($result as $asd => $value) {
		$point = array("valorx" => $value["prod_titulo"], "valory" => $value["prod_cost"]);
		array_push($data_points, $point);
	}
    
    echo json_encode($data_points);
?>