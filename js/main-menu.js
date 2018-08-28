(function() {
  var burger = document.querySelector('.burger');
  var nav = document.querySelector('#'+burger.dataset.target);
 
  burger.addEventListener('click', function(){
    burger.classList.toggle('is-active');
    nav.classList.toggle('is-active');
  });
})();
(function() {
  var burger2 = document.querySelector('#btn-men-mobile');
  if(burger2) {
    burger2.addEventListener('click', function(){
      burger2.classList.toggle('is-active');
      $('#user-mobile-men').toggleClass('disp-menu');
      $('#user-mobile-men').toggleClass('is-active');
    });
  }
  
})();


var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
  var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("main-menu").style.top = "0";
  } else {
    document.getElementById("main-menu").style.top = "-70px";
  }
  prevScrollpos = currentScrollPos;
}
