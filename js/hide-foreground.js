jQuery( document ).ready( 
function($) { 
  var button = $('.show-img-button');
  // initialize site to start scrolled down
  var w_height = $( window ).height();
  var w_width = $( window ).width();
  var overhead = w_height-$('#content').offset().top-parseInt($('#masthead').css('margin-top'));
  $( '.site' ).css( {'margin-top': (overhead) + "px"} );  
  $( 'html, body' ).scrollTop(overhead);  
  // click scrolles page up or down
  button.click(function(){
    if( $( window ).scrollTop() >= overhead/2 ) {
      $( 'html, body' ).animate({scrollTop:0},"slow");
    } else {
      $( 'html, body' ).animate({scrollTop:overhead},"slow");
    }
  });
  // calculate new size to fit image into the window
  var img_ratio = img_width/img_height;
  var w_ratio = w_width/w_height;
  // on scrolling events:
  $( window ).scroll( function(){
    var ypos = $( window ).scrollTop();
    
    if( ypos >= overhead/2 ) {
      button.css('background-position', "right top");
      button.children().text('Hintergrund angucken');
    } else {
      button.children().text('zurück zum Text');
      button.css('background-position', "right -4.5rem");
    }
    
    if( ypos < overhead ) {
      var target_width;
      var target_height;
      var x = 1-ypos/overhead;
      if( w_ratio > img_ratio ) {
	target_height = w_height;
	target_width = target_height * img_ratio;
      } else {
	target_width = w_width;
	target_height = target_width / img_ratio;
      }
      $('#background').css({ 'background-size': (img_width*(1-x)+ x*target_width) + "px " + (img_height*(1-x)+x*target_height) + "px"
      });
    }
  });
});