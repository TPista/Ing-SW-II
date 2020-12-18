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
	
	$id = $_GET['id'];

	eliminarFoto($id);
	
	function eliminarFoto($id)
	{
		foreach (['.jpg','.jpeg','.png'] as $variable) {
            $path = "../../fotos_productos/".$id.$variable;
            if( file_exists($path) )
                unlink($path) or die("Couldn't delete file");
        }
	}

	header('Location: ./index_modificar_producto.php?id='.$id);
?>