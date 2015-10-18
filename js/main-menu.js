// Scrolling main navigation
jQuery( document ).ready( function($) { 
  var navi = $( '.main-navigation' );
  var headline = $('#headline'); 
  var content_top = $('#content').offset().top;
  if(headline.length>0){
    content_top -= headline.height();
  }  
  $( window ).scroll( function(){
    var ypos = $( window ).scrollTop();
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
  });
});