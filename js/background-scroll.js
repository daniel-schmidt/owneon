jQuery( document ).ready( function($) {
//   $( window ).scroll( function(){
//     var ypos = $( window ).scrollTop();
//     var visible = $( window ).height();
//     const img_height = 1080;
//     var max_scroll = img_height - visible;
//     var doc_height = $( document ).height();
//     const scroll_factor = max_scroll/(doc_height-img_height);
//     if ( max_scroll > scroll_factor * ypos) {
//       $('body').css('background-position', "center -" + scroll_factor * ypos + "px");
//     }
// 
//     // Scrolling main navigation
//     var navi = $( '.main-navigation' );
//     var menu_height = navi.height();
//     if ( ypos < 90 ) {
//       navi.css( {'position': "relative", 'top': 0} );
//     }
//     else if ( ypos > ( doc_height - menu_height - 90 ) ) {
//       var topstr = (doc_height - menu_height - 200) + 'px';
//       navi.css( {'position': "relative", 'top': topstr } );
//     }
//     else {
//       navi.css({ 'top': "20px", 'position': "fixed"} );
//     }
//   });  
});