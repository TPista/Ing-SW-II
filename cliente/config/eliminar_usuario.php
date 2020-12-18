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

	// Clase Usuario
	$id = $_SESSION['users']['usr_id'];
	$usr = new User($id);

	// Borramos la cuenta
	$usr->delete_user();
	header('Location: ../../logout.php');
?>