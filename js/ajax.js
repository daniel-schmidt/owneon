jQuery( document ).ready( function($) {
    
    queryObject = JSON.parse( owneonajax.query_vars ); // get query vars from php
    var page = parseInt( queryObject.paged );   // read initial page number from queryObject
    if( isNaN( page ) ) {
        page = 1;
    }
    
    $( 'body' ).on( 'click', '#primary-menu a, a.gallery-link, a.info-link', function( e ) {
        e.preventDefault();
        var url = this.href;
        var hash = this.hash;
        $.scrollTo( hash, 1000 );
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
    } );
    
    $( 'body' ).on( 'click', 'a.blog-link', function( e ) {
        e.preventDefault();
        var url = this.href;        
        
        console.log( queryObject );
        page++;
        console.log( page );
        $.ajax( {
            url: owneonajax.ajaxurl,
            type: 'post',
            data: {
                action: 'ajax_pagination',
                query_vars: owneonajax.query_vars,
                page: page
            },
            success: function( html ) {
                $( 'article' ).remove();
                $( '.blog-main-container' ).append( html );
            }
        } )
    } );
    
    
    
} );