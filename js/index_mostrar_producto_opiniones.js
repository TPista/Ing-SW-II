$(document).ready( function(){
	function mostrar_opiniones() {
		$.ajax({
        	url: 'mostrar_opiniones.php',
        	method: "POST",
        	success: function(data){
				$('.mostrarOpiniones').html(data);
			}
      	});
    }

    mostrar_opiniones();
});