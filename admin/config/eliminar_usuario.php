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

	// Conector
	$conectorSQL = ConectorMySql::getInstance();

	// Clase Usuario
	$id = $_SESSION['users']['usr_id'];
	$usr = new User($id);

	// Obtener todos los productos del usuario, y borrar la foto.
	$query = "SELECT prod_id FROM productos WHERE prod_adm_id = ".$id.";";
	$result = $conectorSQL->selectQuery($query);

	// Tiene productos subidos?
	if( !empty($result) )
	{
		foreach ($result as $key => $value) {
			$prod_id = intval($value['prod_id']);
			eliminarFoto($prod_id);
		}
	}

	function eliminarFoto($id)
	{
		foreach (['.jpg','.jpeg','.png'] as $variable) {
            $path = "../../fotos_productos/".$id.$variable;
            if( file_exists($path) )
                unlink($path) or die("Couldn't delete file");
        }
	}

	// Borramos la cuenta
	$usr->delete_user();
	header('Location: ../../logout.php');
?>