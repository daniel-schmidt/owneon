jQuery( document ).ready( function($) {
    console.log( 'Hallo Ajax!');
//     $( 'a.gallery-link' ).on( 'click', function( e ) {
    $( 'body' ).on( 'click', 'a.gallery-link', function( e ) {
        console.log( 'Link clicked!' );
        e.preventDefault();
        
        $( '.gallery-curr-item' ).removeClass( 'gallery-curr-item' );
        $( this ).addClass( 'gallery-curr-item' );
        
        var url = this.href;
        
        $( '#gallery-container' ).remove();
//         $( '#gallery-container' ).load( url + ' #image-container' ).hide().fadeIn('slow');
        // TODO: this works only if we have only one galerie
        $( '#galerie .content-area' ).load( url + ' #gallery-container' ).hide().fadeIn('slow');
    } );
    
    $( 'body' ).on( 'click', 'a.blog-link', function( e ) {
        console.log( 'Blog Link clicked!' );
        e.preventDefault();
        
        var url = this.href;
        
        $( '#blog-content-container' ).remove();
//         $( '#gallery-container' ).load( url + ' #image-container' ).hide().fadeIn('slow');
        // TODO: this works only if we have only one galerie
        $( '#blog .content-area' ).load( url + ' #blog-content-container' ).hide().fadeIn('slow');
    } );
    
} );