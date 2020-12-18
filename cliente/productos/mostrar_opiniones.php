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
	$prod_id = $_SESSION['last_prod_id'];

	$result = $conectorSQL->selectQuery("SELECT comentario_puntaje, comentario_titulo, comentario_texto FROM comentarios WHERE comentario_prod_id=".$prod_id.";");

	if( !empty($result) )
	{
		$result2 = $conectorSQL->selectQuery("SELECT ROUND(AVG(comentario_puntaje),2) AS promedio FROM comentarios WHERE comentario_prod_id=".$prod_id.";")[0];

		echo "<h6><u>Puntuación promedio:</u> ".$result2['promedio']."</h6>";

		foreach ($result as $asd => $db)
			echo "
				<article class='opinionArticulo'>
					<h4>( ".$db['comentario_puntaje']." ) ".$db['comentario_titulo']."</h4>
					<div>".$db['comentario_texto']."</div>
				</article>";
	}
	else
		echo "Este producto no tiene opiniones.";
?>