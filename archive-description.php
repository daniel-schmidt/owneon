<h2>
<?php
    if ( is_category() ) :
            single_cat_title();

    elseif ( is_tag() ) :
            single_tag_title();

    elseif ( is_author() ) :
            printf( __( 'Author: %s', 'owneon' ), '<span class="vcard">' . get_the_author() . '</span>' );

    elseif ( is_day() ) :
            printf( __( 'Day: %s', 'owneon' ), '<span>' . get_the_date() . '</span>' );

    elseif ( is_month() ) :
            printf( __( 'Month: %s', 'owneon' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'owneon' ) ) . '</span>' );

    elseif ( is_year() ) :
            printf( __( 'Year: %s', 'owneon' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'owneon' ) ) . '</span>' );

    elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
            _e( 'Asides', 'owneon' );

    elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
            _e( 'Galleries', 'owneon');

    elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
            _e( 'Images', 'owneon');

    elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
            _e( 'Videos', 'owneon' );

    elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
            _e( 'Quotes', 'owneon' );

    elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
            _e( 'Links', 'owneon' );

    elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
            _e( 'Statuses', 'owneon' );

    elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
            _e( 'Audios', 'owneon' );

    elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
            _e( 'Chats', 'owneon' );

    else :
//             _e( 'Archives', 'owneon' );

    endif;
?>
</h2>
<?php
    if( is_archive() && !is_tax() ) :
        // Show an optional term description.
        $term_description = term_description();
        if ( ! empty( $term_description ) ) :
                printf( '<div class="taxonomy-description">%s</div>', $term_description );
        endif;
    endif;
?>