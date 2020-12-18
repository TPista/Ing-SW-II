$(document).ready( function(){
	function mostrar_productos() {
    $.ajax({
      url: 'mostrar_carrito.php',
      method: "POST",
      success: function(data){
				$('.resultsList').html(data);
			}
    });
  }

  mostrar_productos();
});