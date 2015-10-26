function showHeadline() {
    (function($){
        var content_top = $('#content').offset().top;
        var headline = $('#headline');
        var backbutton = $('body > .show-img-button');
        var ypos = $(window).scrollTop();
        if( ypos > content_top ){
            if( window.innerWidth > 600 )
            {
                headline.css('display', "table");	
            }
            else
            {
                headline.css('display', "none");
            }
            backbutton.css('display', "none");
        }
        else
        {
            headline.css('display', "none");
            backbutton.css('display', "table");
        }
        
    })(jQuery);
}

jQuery( window ).on('resize scroll', showHeadline );