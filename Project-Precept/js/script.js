var documentEl = $(document);
var parallaxbg = $('.info_header');
documentEl.on('scroll', function(){
        var currentScrollPos = documentEl.scrollTop();
        parallaxbg.css('background-position', '0' + -currentScrollPos/3 + 'px');
});

$(window).scroll(function() {
       if ($(this).scrollTop() > 0){  
          $('.header').addClass("scroll_header"); 
          $('.logo').addClass("scroll_logo");
           $('.navigation').addClass("scroll_nav");
       }
       else{
          $('.header').removeClass("scroll_header");
          $('.logo').removeClass("scroll_logo");
          $('.navigation').removeClass("scroll_nav");
      }
});



var slideIndex = 0;
showSlides();


function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
       slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex> slides.length) {slideIndex = 1}
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
    setTimeout(showSlides, 6000); 
}


