$(document).ready(function () {
	
  $(".carousel").carousel({
    interval: 5000,
    pause: true,
    touch: true
  });

  $(".carousel .carousel-control-prev").on("click", function () {
    $(".carousel").carousel("prev");
  });

  $(".carousel .carousel-control-next").on("click", function () {
    $(".carousel").carousel("next");
  });

});