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
	$result = $conectorSQL->deleteQuery("CALL eliminar_producto(".$id.");");
	
	// Borramos la foto del producto
	eliminarFoto($id);
	
	function eliminarFoto($id)
	{
		foreach (['.jpg','.jpeg','.png'] as $variable) {
            $path = "../../fotos_productos/".$id.$variable;
            if( file_exists($path) )
                unlink($path) or die("Couldn't delete file");
        }
	}
	
	header('Location: ./');
?>