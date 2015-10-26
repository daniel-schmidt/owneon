// Scrolling main navigation
var navi, headline, content_top;

jQuery( document ).ready( function($) { 
  navi = $( '.main-navigation' );
  headline = $('#headline'); 
  content_top = $('#content').offset().top;
  if(headline.length>0){
    content_top -= headline.height();
  }
});

jQuery( window ).on('resize scroll', function(){
    var ypos = jQuery( window ).scrollTop();
    if( window.innerWidth > 600 )
    {
        if ( ypos < content_top ) {
            navi.css( {'position': "relative", 'top': "0"} );
        }
        else {
            if( headline.length>0 ) {
            navi.css({ 'position': "fixed", 'top': headline.height()+"px"} );
            } else {	
            navi.css({ 'position': "fixed"} );
            }
        }
    };
});