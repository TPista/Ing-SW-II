$(document).ready(function() {

  $(document).on('click', '#eliminar', function(){
    var id = $(this).data("id_eliminar");
    
    $.ajax({
      url: 'remover_producto.php',
      method: "POST",
      data: { id: id },
      success: function(data){
        obtener_productos();
      }
    });
  }

  function obtener_productos(){
    $.ajax({
      url: 'delete_productos.php',
      method: "POST",
      success: function(data){
        $('#productosParaEliminar').html(data)
      }
    });
  }

  obtener_productos();
});