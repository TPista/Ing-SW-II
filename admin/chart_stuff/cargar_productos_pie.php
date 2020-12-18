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
	$query = "SELECT prod_titulo, prod_cost FROM productos WHERE prod_adm_id=".$id.";";
	$result = $conectorSQL->selectQuery($query);

	$data_points = array();

	foreach ($result as $asd => $value) {
		$point = array(
        	"valory" => $value["prod_cost"],
        	"valorx" => $value["prod_titulo"]
        );
        array_push($data_points, $point);
	}

    /*
    while ( $row = $consulta->fetch_array() ) {
        $point = array(
        	"valory" => $row['prod_cost'],
        	"valorx" => $row['prod_titulo']
        );
        array_push($data_points, $point);
    }*/
    
    echo json_encode($data_points);
?>