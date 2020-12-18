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

	// Datos
	$prod_id = $_GET['id'];
	$last_dir = $_GET['last_dir'];
	$_SESSION['last_prod_id'] = $prod_id;
	
	// Datos del producto
	$result = $conectorSQL->selectQuery("CALL mostrar_producto(".$prod_id.");");
	$db = $result[0];

	// Esta en el carrito?
	$data = $conectorSQL->selectQuery("CALL producto_en_carrito(".$prod_id.",".$_SESSION['users']['usr_id'].");");

	/* Para el select */
	function comboPuntaje($index=-1)
    {
        $valores = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10");
        $selected = "";
        for( $i = 0; $i < count($valores); $i++)
        {
            if( $index == $i )
                $selected = 'selected = "selected"';
            else
                $selected = "";
            echo '<option value="'.$valores[$i].'" '.$selected.'>'.$valores[$i].'</option>';
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Mostrar Producto</title>

	<link rel="stylesheet" href="../../font-awesome/css/all.min.css">
	<link rel="stylesheet" href="../../css/bootstrap.min.css">

	<script src="../../js/jquery-3.4.1.min.js"></script>
	<script src="../../js/popper.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>

	<script src="../../js/index_mostrar_producto_opiniones.js"></script>
	<link rel="stylesheet" href="../../css/index_mostrar_producto.css">
</head>

<body>
	<nav class="mb-1 navbar navbar-expand-lg bg-primary navbar-dark orange lighten-1">
		<div class="collapse navbar-collapse">
			<!-- Izquierda -->
		    <ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="../">Inicio</a>
				</li>
				<li class="nav-item">
		        	<a class="nav-link" href="../historial_compras/">Historial de Compras</a>
				</li>
			</ul>

			<!-- Medio -->
			<ul class="navbar-nav mr-auto">
				<a class="navbar-brand" href="../contacto/">CAPICA S.A</a>
			</ul>

			<!-- Derecha -->
		    <ul class="navbar-nav ml-auto nav-flex-icons">
		    	<form class="form-inline my-2 my-lg-0" method="get" action="../buscar/">
            		<input class="form-control mr-sm-2" type="search" name="name" placeholder="Search..." aria-label="Search">
          		</form>
	            <li class="nav-item dropdown">
					<a class="nav-link" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-shopping-cart"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="../carrito/">Ver Carrito</a>
					</div>
	            </li>
		    	<li class="nav-item dropdown">
		        	<a class="nav-link" id="navbarDropdownMenuLink" data-toggle="dropdown"
		          	aria-haspopup="true" aria-expanded="false">
		          		<i class="fa fa-fw fa-user"></i>
		        	</a>
		        	<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
		          		<a class="dropdown-item" href="../config/">Editar Perfil</a>
		          		<a class="dropdown-item" href="../../logout.php">Cerrar Sesión</a>
		        	</div>
		      	</li>
		    </ul>

		</div>
	</nav>

	<a href="<?php echo $last_dir; ?>" class="aIcon">
		<i class="fa fa-arrow-circle-left"></i>
	</a>

	<div class="container u-clearfix">
		<?php
		if( !empty($result) ) {?>
			<div class="layout-col layout-col--left">
				<div class="divFoto">
				<?php

				$foto = "../../fotos_productos/sin_foto.jpg";
				foreach (['.jpg','.jpeg','.png'] as $variable) {
					$path = "../../fotos_productos/".$prod_id.$variable;
			        if( file_exists($path) )
			            $foto = $path;
			    }

				echo "<img class='prod_img' width='400' height='400' src='$foto' data-holder-rendered='true'>";
				?>
				</div>
				
				<section class="ui-view-more vip-section-specs">
					<h2 class="main-section__title">Caracteristicas</h2>
					<div class="specs-wrapper">
						<section class="specs-container specs-primary specs-layout-default u-clearfix">
							<ul class="specs-list specs-list-primary specs-structure-medium">
								<li class="specs-item specs-item-primary" style="list-style:none;">
									<strong>Marca</strong><br/>
									<span><?php echo $db['prod_marca']; ?></span>
								</li>
								<li class="specs-item specs-item-primary" style="list-style:none;">
									<strong>Talle</strong><br/>
									<span><?php echo $db['prod_talle']; ?></span>
								</li>
								<li class="specs-item specs-item-primary" style="list-style:none;">
									<strong>Color</strong><br/>
									<span><?php echo $db['prod_color']; ?></span>
								</li>
								<li class="specs-item specs-item-primary" style="list-style:none;">
									<strong>Categoria</strong><br/>
									<span><?php echo $db['prod_categoria']; ?></span>
								</li>
							</ul>
						</section>
					</div>
				</section>
				
				<section class="item-description">
					<h2 class="main-section__title item-description__title">Descripción</h2>
					<div class="item-description__text">
						<?php echo $db['prod_descripcion']; ?>
					</div>
				</section>

				<section class="ui-view-more">
					<h2 class="main-section__title">Opiniones del producto</h2>
					<div class="mostrarOpiniones">
					</div>
				</section>
			</div>

			<div class="layout-col layout-col--right">
				<div>
					<section class="short-description core-item short-description--static" style="min-height: 400px;">
						<div class="divInfoProducto">
							<dl class="vip-title-info">
								<div class="item-condition">
									<?php echo $db['prod_usado']; ?>
								</div>
							</dl>
							<header class="item-title" data-js-item-title>
								<h1>
									<?php echo $db['prod_titulo']; ?>
								</h1>
							</header>

							<fieldset class="item-price">
								<span class="spanCost">
									$<?php echo number_format($db['prod_cost'], 0, '', '.'); ?>
								</span>
							</fieldset>
							<br><br><br><br>
							<div class="divButtons">
								<form action="comprar_producto.php" method="post">
									<input type="hidden" name="p_id" value="<?php echo $prod_id; ?>">
									<input type='hidden' name='last_dir' value='<?php echo $last_dir; ?>'>
									<input type="hidden" name="adm_id" value="<?php echo $db['usr_id']; ?>">
									<input type="hidden" name="p_titulo" value="<?php echo $db['prod_titulo']; ?>">
									<input type="hidden" name="p_cost" value="<?php echo $db['prod_cost']; ?>">
									<input type="submit" class="btn btn-primary" value="Comprar ahora">
								</form>
								<form action='carrito_producto.php' method='post'>
									<input type='hidden' name='p_id' value='<?php echo $prod_id; ?>'>
									<input type='hidden' name='last_dir' value='<?php echo $last_dir; ?>'>
								<?php
								if( !$data )
									echo "<input type='submit' class='btn btn-success' value='Agregar al Carrito'>";
								else
									echo "<input type='submit' class='btn btn-danger' value='Eliminar del Carrito'>";
								?>
								</form>
							</div>
						</div>
					</section>
					
					<section class="ui-view-more infoVendedor">
						<p class="card-title">Informacion del Vendedor</p>
						<div><?php echo $db['usr_name']; ?></div>
						<div><?php echo $db['usr_email']; ?></div>
						<div><?php echo $db['usr_pais']; ?></div>
						<div><?php echo $db['usr_dir']; ?> (Cod. Postal: <?php echo $db['usr_cod_postal']; ?>)</div>
					</section>

					<section class="vip-section-questions ui-view-more">
						<h2 class="main-section__title">Deja tu opinion</h2>
						<p>- Escribe tu opinion acerca del producto</p>
						<form method="post" action="crear_nueva_opinion.php">
							<div class="divComentarios">
								<input type="text" class="comentarioTitulo" name="comentarioTitulo" placeholder="Titulo" required>
								<textarea class="comentarioText" name="comentarioText" type="text" placeholder="Escribe tu comentario..." rows="5" cols="50" maxlength="2000" required></textarea>
								<label for="comentarioPuntaje">Puntaje </label>
								<select name="comentarioPuntaje">
									<?php comboPuntaje(5); ?>
                    			</select>
                    			<br><br>
								<input type="hidden" name="prod_id" value="<?php echo $prod_id; ?>">
								<input type='hidden' name='last_dir' value='<?php echo $last_dir; ?>'>
								<input class="btn btn-primary" type="submit" value="Comentar">
							</div>
						</form>
					</section>
				</div>
			</div>
		<?php } ?>
	</div>
</body>
</html>