$(document).ready( function(){
  var car_num = 1;
  var slide_num = 1;
  var tipo = "Nuevo";

  $.ajax({
    url: 'mostrar_slides.php',
    method: "POST",
    data: { car_num: car_num, slide_num: slide_num, tipo: tipo },
    success: function(data){
      $('.slide_one').html(data);
    }
  });

  car_num = 1;
  slide_num = 2;

  $.ajax({
    url: 'mostrar_slides.php',
    method: "POST",
    data: { car_num: car_num, slide_num: slide_num, tipo: tipo },
    success: function(data){
      $('.slide_two').html(data);
    }
  });

  car_num = 2;
  slide_num = 1;

  $.ajax({
    url: 'mostrar_slides.php',
    method: "POST",
    data: { car_num: car_num, slide_num: slide_num, tipo: tipo },
    success: function(data){
      $('.slide_three').html(data);
    }
  });

  $(".carousel-control-prev").change( function() {
    car_num = 1;
    slide_num = 2;

    $.ajax({
      url: 'mostrar_slides.php',
      method: "POST",
      data: { car_num: car_num, slide_num: slide_num, tipo: tipo },
      success: function(data){
        $('.slide_three').html(data);
      }
    });
  });
})