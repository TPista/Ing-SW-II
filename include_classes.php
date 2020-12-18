<?php
	include_once('class/mysql_class.php');
	include_once('class/user_class.php');
	include_once('class/product_class.php');

	session_start();

	// Para el debug
	function pr($data, $txt)
	{
	    echo "<pre>";
	    echo $txt."\n";
	    var_dump($data);
	    echo "</pre>";
	}
?>