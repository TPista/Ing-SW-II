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
	$prod_id = $_POST['p_id'];
	$cl_id = $_SESSION['users']['usr_id'];
	$last_dir = $_POST['last_dir'];

	$cons = $conectorSQL->updateQuery("CALL producto_al_carrito(".$prod_id.",".$cl_id.");");

	header('Location: ./?id='.$prod_id.'&last_dir='.$last_dir);
?>