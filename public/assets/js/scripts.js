// script suavizar scroll de rolagem com links de navegacao  
$('.scroll a[href^="#"]').on('click', function(e) {
    e.preventDefault();
    var id = $(this).attr('href'),
        targetOffset = $(id).offset().top;

    $('html, body').animate({
        scrollTop: targetOffset - 150
    }, 500);
});


// script carregamento de pagina
$(window).on('load', function() {
    $('#preloader .inner').fadeOut();
    $('#preloader').delay(350).fadeOut('slow');
    $('body').delay(350).css({
        'overflow': 'visible'
    });
})

// script reduzir altura do navegador quando usar scroll de rolagem  
$(window).scroll(function() {
    if ($(document).scrollTop() > 50) {
        $('.navegador').addClass('sticky');
    } else {
        $('.navegador').removeClass('sticky');
    }
});





$('#owl-banner').owlCarousel({
    loop:true,
    margin:30,
    nav:true,
    animateOut: 'fadeOut',
    
    autoplay:true,
    autoplayTimeout:4000,
    autoplayHoverPause:true,
    responsive:{
        0:{
            items:1
        },
     
    }
})

$('#owl-produtos').owlCarousel({
    loop:true,
    margin:30,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        750:{
            items:2
        },
        1000:{
            items:4
        }
    }
})
$('#owl-blog').owlCarousel({
    loop:true,
    margin:30,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        750:{
            items:2
        },
        1000:{
            items:4
        }
    }
})


document.querySelector("html").classList.add('js');

var fileInput  = document.querySelector( ".input-file" ),  
    button     = document.querySelector( ".input-file-trigger" ),
    the_return = document.querySelector(".file-return");
      
button.addEventListener( "keydown", function( event ) {  
    if ( event.keyCode == 13 || event.keyCode == 32 ) {  
        fileInput.focus();  
    }  
});
button.addEventListener( "click", function( event ) {
   fileInput.focus();
   return false;
});  
fileInput.addEventListener( "change", function( event ) {  
    the_return.innerHTML = this.value;  
}); 