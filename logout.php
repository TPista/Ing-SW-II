<?php
	
	// Cargamos las variables
	session_start();
	
	// Las sacamos de las variables globales
	session_unset();
	
	// Destruimos la sesion
	session_destroy();
	
	// Redireccionamos a la pagina del login
	header( 'Location: ./' );
?>