$(document).ready( function() {
	$('#mitabla').DataTable({
		"order": [[0, "asc"]],
		"language":{
			"processing":     "Procesando...",
		    "lengthMenu":     "Mostrar _MENU_ registros",
		    "zeroRecords":    "No has subido ningun producto!",
		    "sEmptyTable":     "No has subido ningun producto!",
		    "info":           "Tienes un total de _TOTAL_ producto(s)",
		    "infoEmpty":      "No subiste productos!",
		    "infoFiltered":   "(filtrado de un total de _MAX_ registros)",
		    "sInfoPostFix":    "",
		    "search":         "Buscar: ",
		    "loadingRecords": "Cargando..."
		},
		"aoColumnDefs": [
		     { 'bSortable': false, 'aTargets': [ 6 ] }, // La columna de edit no se ordena
		     { 'bSortable': false, 'aTargets': [ 7 ] }  // la columna de remover no se ordena
   		],
  		"lengthMenu": [[10,25,50, -1],[10,25,50,"Mostrar Todo"]],
  		"paging": false,
    	"lengthChange": true,
    	"searching": true,
    	"ordering": true,
    	"info": true,
    	"autoWidth": true,
  		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "procesar_productos.php"
	});

	$('#confirm-delete').on('show.bs.modal', function(e) {
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
		$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
	});
});