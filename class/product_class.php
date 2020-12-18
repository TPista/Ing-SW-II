<?php
class Producto {
	private $id;
    private $id_admin;
    private $titulo;
    private $costo;
    private $marca;
    private $categoria;
    private $talle;
    private $color;
    private $usado;
    private $descripcion;

    private $pais;
    private $direccion;
    private $cp;

    private $conectorMySQL;

    public function getCod_Postal(){
        return $this->cp;
    }

    public function setCod_Postal($cp){
        $this->cp = $cp;
    }

    public function getPais(){
        return $this->pais;
    }

    public function setPais($pais){
        $this->pais = $pais;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }

	public function getDescripcion(){
	    return $this->descripcion;
	}

	public function setDescripcion($descripcion){
	    $this->descripcion = $descripcion;
	}

	public function getUsado(){
	    return $this->usado;
	}

	public function setUsado($usado){
	    $this->usado = $usado;
	}

	public function getColor(){
	    return $this->color;
	}

	public function setColor($color){
	    $this->color = $color;
	}

	public function getTalle(){
	    return $this->talle;
	}

	public function setTalle($talle){
	    $this->talle = $talle;
	}

	public function getCategoria(){
	    return $this->categoria;
	}

	public function setCategoria($categoria){
	    $this->categoria = $categoria;
	}

	public function getMarca(){
	    return $this->marca;
	}

	public function setMarca($marca){
	    $this->marca = $marca;
	}

	public function getCosto(){
	    return $this->costo;
	}

	public function setCosto($costo){
	    $this->costo = $costo;
	}

	public function getTitulo(){
	    return $this->titulo;
	}

	public function setTitulo($titulo){
	    $this->titulo = $titulo;
	}

	public function getId_admin(){
	    return $this->id_admin;
	}

	public function setId_admin($id_admin){
	    $this->id_admin = $id_admin;
	}

	public function getId(){
	    return $this->id;
	}

	public function setId($id){
	    $this->id = $id;
	}

	public function __construct($id = "") {
        $this->conectorMySQL = ConectorMySql::getInstance();
        
        if( !$id )
        {
            $this->id               		= "";
            $this->id_admin                 = "";
            $this->titulo                   = "";
            $this->costo                  	= "";
            $this->marca                	= "";
            $this->categoria                = "";
            $this->talle             		= "";
            $this->color        			= "";
            $this->usado                    = "";
            $this->descripcion 				= "";
            $this->pais 					= "";
            $this->cp 						= "";
        }
        else
            $this->load_product($id);    
    }

    private function load_product($id) {  
        $query = "CALL mostrar_producto(".$id.");";
        $retorno = true;

        try {
            $arrayRetorno = $this->conectorMySQL->selectQuery($query);
            
            if( count($arrayRetorno) != 0 ) {
                $producto = $arrayRetorno[0];
                
                foreach ($producto as $indice => $valor ) {
                    if ($producto[$indice] === null)
                        $producto[$indice] = "null";
                }

                $this->setId_admin                 	($producto['usr_id']);
                $this->setDescripcion 				($producto['usr_descripcion']);
                $this->setPais						($producto['usr_pais']);
                $this->setCod_Postal				($producto['usr_cod_postal']);
                $this->setId               			($producto['prod_id']);
                $this->setTitulo                   	($producto['prod_titulo']);
                $this->setCosto                  	($producto['prod_cost']);
                $this->setMarca                		($producto['prod_marca']);
                $this->setCategoria                 ($producto['prod_categoria']);
                $this->setTalle             		($producto['prod_talle']);
                $this->setColor       				($producto['prod_color']);
                $this->setUsado                  	($producto['prod_usado']);
            }
        }
        catch(Exception $e) {
            $retorno = false;
        }
        return $retorno;
    }

    public static function obtenerProductosBuscador($buscar) {
        $query = "SELECT prod_id, usr_dir, usr_pais, prod_titulo, prod_cost, prod_marca FROM productos JOIN usuarios ON prod_adm_id=usr_id WHERE prod_titulo LIKE "%'.$buscar.'%";";

        try {
            $arrayRetorno = $this->conectorMySQL->selectQuery($query);

            if (is_array($arrayRetorno) && count($arrayRetorno) > 0) {
                $retorno = array();
                
                foreach($arrayRetorno as $producto){
                    $oProducto = $this->cargarProducto($producto);
                    $retorno[] = $oProducto;
                }
            }else {
                $retorno = array();
                $error = "No se encontro";
            }
        }
        catch(Exception $e) {
            echo $error;
        }
        return $retorno;
    }

    public static function prod_path_foto($id) {
    	$foto = "../../fotos_productos/sin_foto.jpg";
		foreach (['.jpg','.jpeg','.png'] as $variable) {
			$path = "../../fotos_productos/".$id.$variable;
	        if( file_exists($path) )
	            $foto = $path;
	    }

	    return $foto;
    }

    public static function prod_delete_photo($id) {
    	$result = false;

    	foreach (['.jpg','.jpeg','.png'] as $variable) {
            $path = "../../fotos_productos/".$id.$variable;
            if( file_exists($path) ) {
            	$result = true;
                unlink($path) or die("Couldn't delete file");
            }
        }

        return $result;
    }
}
?>