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
	$prod_id = $_POST['prod_id'];
	$puntaje = $conectorSQL->escape_string($_POST['comentarioPuntaje']);
	$titulo = $conectorSQL->escape_string($_POST['comentarioTitulo']);
	$text = $conectorSQL->escape_string($_POST['comentarioText']);
	$last_dir = $_POST['last_dir'];

	$query = "INSERT INTO comentarios (comentario_prod_id, comentario_cliente_id, comentario_puntaje, comentario_titulo, comentario_texto) VALUES (".$prod_id.",".$_SESSION['users']['usr_id'].",".$puntaje.",\"".$titulo."\",\"".$text."\");";
	$cons = $conectorSQL->insertQuery($query);

	header('Location: ./?id='.$prod_id.'&last_dir='.$last_dir);
?>