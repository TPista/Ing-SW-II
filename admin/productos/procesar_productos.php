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

	// Conexion
	$conectorSQL = ConectorMySql::getInstance();

	// Un poco de seguridad..
	$id = $_SESSION['users']['usr_id'];
	
	/* Array que contiene los nombres de las columnas de la tabla*/
	$aColumnas = array( 'prod_id', 'prod_titulo', 'prod_cost', 'prod_marca','prod_categoria', 'prod_usado' );
	
	/* Ordenacion */
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= $aColumnas[ intval( $_GET['iSortCol_'.$i] ) ]."
				".$_GET['sSortDir_'.$i] .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
			$sOrder = "";
	}
	
	/* Filtracion */
	$sWhere = "";
	if ( $_GET['sSearch'] != "" )
	{
		$sWhere = " AND (";
		for ( $i = 0 ; $i < count($aColumnas) ; $i++ )
			$sWhere .= $aColumnas[$i]." LIKE '%".$_GET['sSearch']."%' OR ";
		
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	
	/* Filtrado de columna individual */
	for ( $i = 0; $i < count($aColumnas); $i++ )
	{
		if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
				$sWhere .= " AND ";
			$sWhere .= $aColumnas[$i]." LIKE '%".$_GET['sSearch_'.$i]."%' ";
		}
	}
	
	/*
	FOUND_ROWS es una función de información que se usa después de otra para obtener información sobre lo que sucedió. 
	Se usa porque si pongo COUNT(*) me devuelve otra cosa.
	*/
	$sQuery = "SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumnas))." FROM productos WHERE prod_adm_id=".$id." $sWhere $sOrder;";
	$rResult = $conectorSQL->selectQuery($sQuery);
	
	/* Data set length after filtering */
	$rResultFilterTotal = $conectorSQL->selectQuery("SELECT FOUND_ROWS();")[0];
	$iFilteredTotal = $rResultFilterTotal[0];
	
	/* Total data set length */
	$rResultTotal = $conectorSQL->selectQuery("SELECT COUNT(*) FROM productos WHERE prod_adm_id=".$id.";")[0];
	$iTotal = $rResultTotal[0];
	
	/* Output */
	$output = array(
	"sEcho" => intval($_GET['sEcho']),
	"iTotalRecords" => $iTotal,
	"iTotalDisplayRecords" => $iFilteredTotal,
	"aaData" => array()
	);
	
	foreach ($rResult as $asd => $aRow)
	{
		$row = array();
		for ( $i=0 ; $i < count($aColumnas) ; $i++ )
		{
			if ( $aColumnas[$i] == "version" )
				$row[] = ($aRow[ $aColumnas[$i] ] == "0") ? '-' : $aRow[ $aColumnas[$i] ];
			else if ( $aColumnas[$i] != ' ' )
				$row[] = $aRow[ $aColumnas[$i] ];
		}

		$row[] ="<td>
					<a href='index_modificar_producto.php?id=".$aRow['prod_id']."'>
						<i class='fa fa-edit'></i>
					</a>
				</td>";
		$row[] ="<td>
					<a href='#' data-href='eliminar_producto.php?id=".$aRow['prod_id']."' data-toggle='modal' data-target='#confirm-delete'>
					<i class='fa fa-trash' style='color:red'></i>
					</a>
				</td>";
		
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
?>