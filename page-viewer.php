<div id="info" class="page">
    <?php  
    $frontpage_id = get_option( 'page_on_front' );
    $pages = get_pages( array( 
        'parent' => 0,
        'exclude' => $frontpage_id
    ) ); 
    foreach ( $pages as $page ) {
            $option = '<a href="' . get_page_link( $page->ID ) . '">';
            $option .= $page->post_title;
            $option .= '</a>';
            echo $option;
            
            $sub_pages = get_pages( array(
                'child_of' => $page->ID
                ) );
            $menu_items='<nav><ul>';
            foreach( $sub_pages as $sub_page ) {
                $menu_items .= '<li class="foreground"><a href="' . get_page_link( $sub_page->ID ) . '#info' . '">';
                $menu_items .= $sub_page->post_title;
                $menu_items .= '</li></a>';
            }
            $menu_items .= '</ul></nav>';
            echo $menu_items;
    }
    if( is_page() && !is_front_page() ) {
        while ( have_posts() ) {
            the_post();
            get_template_part( 'content', 'page' );
        } // end of the loop.
    } else {
        
    }
    ?>
</div>