    <?php  
    $frontpage_id = get_option( 'page_on_front' );
    $pages = get_pages( array( 
        'parent' => 0,
        'exclude' => $frontpage_id
    ) ); 
    foreach ( $pages as $page ) : ?>
        <div id="<?php echo $page->post_name; ?>" class="section">
            <header class="section-header">
                <h1 class="section-heading">
                    <a href=" <?php echo get_page_link( $page->ID ) ?> ">
                        <?php echo $page->post_title; ?>
                    </a>
                </h1>
                
                <?php            
                $sub_pages = get_pages( array(
                    'child_of' => $page->ID
                    ) );
                $menu_items='<nav class="section-menu-container"><ul class="section-menu">';
                foreach( $sub_pages as $sub_page ) {
                    $menu_items .= '<li class="foreground section-menu-item"><a href="' . get_page_link( $sub_page->ID ) . '">';
                    $menu_items .= $sub_page->post_title;
                    $menu_items .= '</li></a>';
                }
                $menu_items .= '</ul></nav>';
                echo $menu_items; ?>
            </header>
            <div class="content-area content-centered fixed-width">
                <?php 
                $count = 0;
                    if( have_posts() ) :
                        while ( have_posts() ) :
                            the_post();
                            
                            // if we are displaying a page, show it in the correct section
                            if( is_page() 
                                && !is_front_page()
                                && get_the_ID() == $page->ID
                                || in_array( $page->ID, get_post_ancestors( get_the_ID() ) ) ) :
                                
                                get_template_part( 'template-parts/content', 'page' );
                            elseif( $count == 0 ) :
                                // we are not active for the current post, so we display the main page, but only once ?>
                                <article id="post-<?php $page->ID; ?>" <?php post_class( $page->ID ); ?>>
                                    <header class="entry-header">
                                            <h1 class="entry-title"><?php echo $page->post_title; ?></h1>
                                    </header><!-- .entry-header -->

                                    <div class="entry-content">
                                            <?php echo $page->post_content; ?>
                                            <?php
                                                    wp_link_pages( array(
                                                            'before' => '<div class="page-links">' . __( 'Pages:', 'owneon' ),
                                                            'after'  => '</div>',
                                                    ) );
                                            ?>
                                    </div><!-- .entry-content -->
                                    <?php edit_post_link( __( 'Edit', 'owneon' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
                                </article><!-- #post-## -->
                            <?php 
                            $count++;
                            endif;
                        endwhile; // end of the loop.    
                    rewind_posts();
                endif; ?>
            </div> <!-- content-area -->
        </div> <!-- section -->
    <?php endforeach;
    ?>