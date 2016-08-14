jQuery( document ).ready( function($) {
    
    function loadContent( url, hash ) {
        $( hash + ' .content-container' )
//         .animate({'margin-left': '+=2000'}, 800)
        .remove();
        
        $( hash + ' .content-area' ).load( url + ' ' + hash + ' .content-container' )
        .hide()
//         .fadeIn('slow')
        .css('margin-left', '-2000px')
        .show()
        .animate({'margin-left': '+=2000'},500)
        ;
    };
    
    $( 'body' ).on( 'click', '#primary-menu a, a.blog-link, a.gallery-link, a.info-link', function( e ) {
        e.preventDefault();
        var url = this.href;
        var hash = this.hash;
        $.scrollTo( hash, 1000 );
        var $this = $(this);
     
        loadContent( url, hash );
        
        history.pushState('', $this.text, url );
    } );
    
    window.onpopstate = function() {
        var url = location.pathname;
        var hash = location.hash;
//         console.log( url, hash );
        loadContent( url, hash );
    };
    
} );