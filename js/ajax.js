jQuery( document ).ready( function($) {
    console.log( 'Hallo Ajax!');
    $( 'a.gallery-link' ).on( 'click', function( e ) {
        console.log( 'Link clicked!' );
        e.preventDefault();
        
        $( '.gallery-curr-item' ).removeClass( 'gallery-curr-item' );
        $( this ).addClass( 'gallery-curr-item' );
        
        var url = this.href;
        
        $( '#image-container' ).remove();
        $( '#gallery-container' ).load( url + ' #gallery-container' ).hide().fadeIn('slow');
    } );
} );