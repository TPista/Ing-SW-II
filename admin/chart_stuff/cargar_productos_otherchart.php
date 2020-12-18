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
	$result = $conectorSQL->selectQuery("SELECT SUM(vendido_prod_cost) AS total, vendido_prod_titulo FROM prod_vendidos WHERE vendido_adm_id=".$id." GROUP BY vendido_prod_titulo;");

	$data_points = array();
    
   	foreach ($result as $asd => $value) {
        $point = array("valorx" => $value["vendido_prod_titulo"], "valory" => $value["total"]);
        array_push($data_points, $point);
    }
    
    echo json_encode($data_points);
?>