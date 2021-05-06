document.addEventListener("DOMContentLoaded", function(){
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
          document.getElementById('navbar_top').classList.add('fixed-nav', 'shadow-own');
        } else {
          document.getElementById('navbar_top').classList.remove('fixed-nav', 'shadow-own');
           // remove padding top from body
          document.body.style.paddingTop = '0';
        }
    });
  });
  
  function openNav() {
    document.getElementById("mySidenav").classList.add('active');
    document.getElementById("mySidenav-wrape").classList.add('show__sidenav__menu__wrapper');
  }
  
  function closeNav() {
    document.getElementById("mySidenav").classList.remove('active');
    document.getElementById("mySidenav-wrape").classList.remove('show__sidenav__menu__wrapper');
  }
  
  if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
      $("#mySidenav").swipe({
          swipeStatus:function(event, phase, direction, distance, duration, fingers)
            {
          if (phase=="move" && direction =="left") {
             $("#mySidenav").removeClass("active");
             $("#mySidenav-wrape").removeClass("show__sidenav__menu__wrapper");
          }
        }
      });
  }