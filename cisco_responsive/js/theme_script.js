jQuery(document).ready(function($){

    $("div#mobile_search_top").click(function(){
        $("div#mobile_search").slideToggle();
    });
    $.slidebars({
        scrollLock: true // true or false
    });
    $('header').on('click', function() {
        $.slidebars.close()
    });

    $('.sb-slidebar nav > ul > li:has(ul)').addClass("has-sub");

    $('.sb-slidebar nav > ul > li > a').click(function() {
        var checkElement = $(this).next();
    
        $('.sb-slidebar nav li').removeClass('active');
        $(this).closest('li').addClass('active');   
    
    
        if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
            $(this).closest('li').removeClass('active');
            checkElement.slideUp('normal');

        }
    
        if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
            $('.sb-slidebar nav ul ul:visible').slideUp('normal');
            checkElement.slideDown('normal');
        }
    
        if (checkElement.is('ul')) {
            return false;
        } else {
            return true;  
        }       
    });

    /*$('#normal_menu li').on('mouseover', function() {
    var li$ = $(this);
    li$.parent('ul').find('li').removeClass('topactive');
    li$.addClass('topactive');
})
.on('mouseout', function() {
    var li$ = $(this);
    li$.removeClass('topactive');
    li$.parent('ul').find('li.current').addClass('topactive');
}); */

    $("img.lazy").lazyload({
    effect : "fadeIn"
    });





});




