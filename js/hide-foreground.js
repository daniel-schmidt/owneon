jQuery( document ).ready( function($) {    
    var $button, overhead, img_ratio, w_ratio, target_width, target_height;
    $button = $('.show-img-button');
    // initialize site to start scrolled down
//     w_height = $( window ).height();
//     w_width = $( window ).width();
    overhead = window.innerHeight-$('#content').offset().top-parseInt($('#masthead').css('margin-top'));
    $( '.site' ).css( {'margin-top': (overhead) + "px"} );  
    $( 'html, body' ).scrollTop(overhead);  
    w_ratio = window.innerWidth/window.innerHeight;
    var ypos = $( window ).scrollTop();
    // click scrolles page up or down

    // calculate new size to fit image into the window
    function set_covering(){
        img_ratio = img_width/img_height;
        // set initial size of image
        if( w_ratio > img_ratio ) {
            img_width = window.innerWidth;
            img_height = img_width / img_ratio;
        } else {
            img_height = window.innerHeight;
            img_width = img_height * img_ratio;
        }
        $('#background').css({ 'background-size': img_width + "px " + img_height + "px"});
    }
    
    function shrink_to_contain(){
        var x = 1-ypos/overhead;
        if( w_ratio > img_ratio ) {
        target_height = window.innerHeight;
            target_width = target_height * img_ratio;
        } else {
            target_width = window.innerWidth;
            target_height = target_width / img_ratio;
        }
        $('#background').css({ 'background-size': (img_width*(1-x)+ x*target_width) + "px " + (img_height*(1-x)+x*target_height) + "px"
        });
    }
    
    // logic for resizing image to move from cover to contain:
    set_covering();
    
    $( window ).on('scroll', function(){
        ypos = $( window ).scrollTop();

        if( ypos >= overhead/2 ) {
            $button.css('background-position', "right top");
            $button.children().text('Hintergrund angucken');
        } else {
            $button.children().text('zurück zum Text');
            $button.css('background-position', "right -4.5rem");
        }

        if( ypos < overhead ) {
            shrink_to_contain();
        } else {
            set_covering();
        }
    });
    
    $( window ).on('resize', function(){
        w_ratio = window.innerWidth/window.innerHeight;
//         overhead = window.innerHeight-$('#content').offset().top-parseInt($('#masthead').css('margin-top'));
        if( ypos < overhead ) {
            shrink_to_contain();
        } else {
            set_covering();
        }
    });
    
    $button.on('click', function(){
        if( $( window ).scrollTop() >= overhead/2 ) {
        $( 'html, body' ).animate({scrollTop:0},"slow");
        } else {
        $( 'html, body' ).animate({scrollTop:overhead},"slow");
        }
    });
});