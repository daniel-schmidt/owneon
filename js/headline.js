jQuery( document ).ready( function($){
    var content_top, headline, backbutton
    content_top = $('#content').offset().top;
    headline = $('#headline');
    backbutton = $('body > .show-img-button');

    function showHeadline() {
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
    }

    $( window ).on('resize scroll', showHeadline );
});