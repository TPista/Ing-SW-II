<?php
class Carrousel {
	private $carrousel_id;
	private $carrousel_name;
	private $carrousel_sp;
	private $carrousel_sp_count;

	private $conectorMySQL;

	public function __construct($id="", $name="", $sp="") {
		$this->conectorMySQL = ConectorMySql::getInstance();

		$this->carrousel_id = $id;
		$this->carrousel_name = $name;
		$this->carrousel_sp = $sp;
		$this->carrousel_sp_count = "count_".$sp;

		/*
		IMPORTANTE: tiene que haber 2 SP's. Uno para obtener productos (ej: producto_rojo) y otro
					igual para contar, pero que empiece con 'count_*' (ej: count_producto_rojo).
		*/
	}

	// Devuelve la cantidad de productos en X carrousel e Y slide (ej carrousel 1, slide 2)
	public function contar_prod_carrousel($slide_num) {
		// Query
		$query = "CALL ".$this->carrousel_sp_count."(".$slide_num.");";
		$result = 0;

		try {
			$consulta = $this->conectorMySQL->selectQuery($query)[0];
			$result = intval($consulta['total']);
		}
		catch(Exception $e) {
            $result = 0;
        }
		
		return $result;
	}

	// Crear carrousel
	public function crear_carrousel() {
		// array( slide => cant_de_prod )
		$count_slide = array(
						'1' => $this->contar_prod_carrousel(1),
						'2' => $this->contar_prod_carrousel(2) );
		$count = 0;
		$active = "";
		$asd = false;
		$num = $this->carrousel_id;

		echo "
		<h2>$this->carrousel_name</h2>
		<div id='$num' name='carousel' class='carousel slide' data-ride='carousel'>
		  	<div class='carousel-inner'>";
			  	foreach ($count_slide as $key => $value) {
			  		// Hay mas de 1 producto en la slide
			  		if( $value > 0 )
			  		{
			  			$count++;

			  			if( !$active && !$asd )
			  			{
			  				$asd = true;
			  				$active = "active";
			  			}

		 				echo"
			  			<div class='carousel-item $active'>
			  				<div class='container'>
				  				<div class='row'>";
				  					$this->cargar_productos_en_carrousel($key);
				  		echo"	</div>
				  			</div>
			  			</div>";

			  			$active = "";
			  		}
			  	}
		echo "</div>";

		// Las flechas si hay mas de un producto en cada slide
		if( $count >= 2 ) {
			echo "
				<a class='carousel-control-prev' href='#$num' role='button' data-slide='prev'>
		    	<span class='carousel-control-prev-icon' style='filter: invert(100%);' aria-hidden='true'></span>
		    	<span class='sr-only'>Previous</span>
		  		</a>

		  		<a class='carousel-control-next' href='#$num' role='button' data-slide='next'>
		    	<span class='carousel-control-next-icon' style='filter: invert(100%);' aria-hidden='true'></span>
		    	<span class='sr-only'>Next</span>
		  		</a>";
		}

		echo "</div>";
	}

	// Cargamos los productos dentro del carrousel
	public function cargar_productos_en_carrousel($slide_num) {
		// A cual SP cosultamos?
		$query = "CALL ".$this->carrousel_sp."(".$slide_num.");";

		try {
			// Query
			$result = $this->conectorMySQL->selectQuery($query);

			// Hay Resultados?
			if( !empty($result) )
			{
				foreach ($result as $asd => $db) {
					$foto = "../fotos_productos/sin_foto.jpg";
					foreach (['.jpg','.jpeg','.png'] as $variable) {
						$path = "../fotos_productos/".$db['prod_id'].$variable;
				        if( file_exists($path) )
				            $foto = $path;
				    }

				    // La url con el id del producto y la pag actual para poder redireccionar despues
				    $href = "productos/?id=".$db['prod_id']."&last_dir=../";;

					echo "
					<div class='col-md-4'>
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
											<strong>
												$".number_format($db['prod_cost'], 0, '', '.')."
											</strong>
										</span>
									</div>
								</div>
							</a>
				        </div>
				   	</div>";
				}
			}
		}
		catch(Exception $e) {
           echo "Error en carrousel!";
        }
	}
}
?>