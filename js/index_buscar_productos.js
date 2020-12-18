$(document).ready( function(){
    /**
     * @param String name
     * @return String
     */
    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }

	function mostrar_productos() {
        var name = getParameterByName('name');
        var tipo = getParameterByName('tipo');
        var cat = getParameterByName('cat');
        console.log(name);
        console.log(tipo);
        console.log(cat);

		$.ajax({
        	url: 'mostrar_productos_busqueda.php',
        	method: "POST",
          data: { name: name, tipo: tipo, cat: cat },
        	success: function(data){
				$('.resultsList').html(data);
			}
      	});
    }

    mostrar_productos();
});