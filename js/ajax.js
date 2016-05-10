jQuery( document ).ready( function($) {
    
    $( 'body' ).on( 'click', '#primary-menu a, a.blog-link, a.gallery-link', function( e ) {
        e.preventDefault();
        var url = this.href;
        var hash = this.hash;
        $.scrollTo( hash, 800 );
        $( hash + ' .content-container' )
//         .animate({'margin-left': '+=2000'}, 800)
        .remove();

        $( hash + ' .content-area' ).load( url + ' ' + hash + ' .content-container' )
        .hide()
//         .fadeIn('slow')
        .css('margin-left', '-2000px')
        .show()
        .animate({'margin-left': '+=2000'},800)
        ;
    } );
    
} );