jQuery( document ).ready( function($) {
    console.log( 'Hallo Ajax!');
//     $( 'a.gallery-link' ).on( 'click', function( e ) {
    $( 'body' ).on( 'click', 'a.gallery-link', function( e ) {
        e.preventDefault();
        var url = this.href;
        
        $( '.gallery-curr-item' ).removeClass( 'gallery-curr-item' );
        $( this ).addClass( 'gallery-curr-item' );

        
        $( '#galerie .content-container' ).remove();
        // TODO: this works only if we have only one galerie
        $( '#galerie .content-area' ).load( url + ' #galerie .content-container' ).hide().fadeIn('slow');
        $.scrollTo('#galerie', 800);
    } );
    
    $( 'body' ).on( 'click', 'a.blog-link', function( e ) {
        e.preventDefault();
        var url = this.href;
        
        $( '#blog .content-container' ).remove();
        // TODO: this works only if we have only one galerie
        $( '#blog .content-area' ).load( url + ' #blog .content-container' ).hide().fadeIn('slow');
        $.scrollTo('#blog', 800);
    } );
    
    $( 'body' ).on( 'click', '#primary-menu a', function( e ) {
        e.preventDefault();
        var url = this.href;
        var hash = this.hash;
        console.log(hash);
        $.scrollTo( hash, 800 );
        $( hash + ' .content-container' ).remove();
        $( hash + ' .content-area' ).load( url + ' ' + hash + ' .content-container' ).hide().fadeIn('slow');
    } );
    
} );