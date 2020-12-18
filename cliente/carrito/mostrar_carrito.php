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
	$cl_id = $_SESSION['users']['usr_id'];

	// Consulta
	$result = $conectorSQL->selectQuery("SELECT ped_id, usr_dir, usr_pais, prod_id, prod_titulo, prod_cost, prod_marca FROM pedidos JOIN productos ON ped_prod_id=prod_id JOIN usuarios ON ped_cliente_id=usr_id WHERE ped_cliente_id=".$cl_id.";");

	// Hay resultado?
	if( !empty($result) )
	{
		foreach ($result as $asd => $db)
		{
			$foto = "../../fotos_productos/sin_foto.jpg";
			foreach (['.jpg','.jpeg','.png'] as $variable) {
				$path = "../../fotos_productos/".$db['prod_id'].$variable;
		        if( file_exists($path) )
		            $foto = $path;
		    }

		    $href = "../productos/?id=".$db['prod_id']."&last_dir=../carrito/";

			echo "
				<li class='results-item highlighted bg-light'>
					<div class='div_item'>
						<a href=".$href." class='prod_attrs'>
							<div class='div_item_image'>
								<img class='prod_img' width='284' height='284' src='$foto' data-holder-rendered='true'>
							</div>

							<div class='prod_info'>
								<h4>
									<span>".$db['prod_titulo']."</span>
								</h4>

								<div class='prod_cost'>
									<span>
										<strong>$".number_format($db['prod_cost'], 0, '', '.')."</strong>
									</span>
								</div>

								<span>".$db['usr_pais']."</span>
								<span> - ".$db['usr_dir']."</span>
		          			</div>
		          		</a>
			        </div>
		        </li>";
		}
	}
	else
		echo "</br><h5><strong>Tu carrito esta vacio!.</strong></h5>";
?>