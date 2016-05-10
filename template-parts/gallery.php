<?php
$main_terms = get_terms( 'galerie_kategorie', array(
    'orderby' => 'slug',
    'parent' => 0
) );
if ( ! empty( $main_terms ) && ! is_wp_error( $main_terms ) ) {
    foreach( $main_terms as $main_term ) {
    ?>
    <div id="<?php echo $main_term->slug?>" class="galerie section">
        <header class="section-header">
            <?php // menu buttons from gallery categories
            $curr_term = '';
                    
                    // main gallery button
                    echo '<h1 class="section-heading"><a class="gallery-link" href="' . esc_url( get_category_link( $main_term ) ) . '" alt="' . esc_attr( sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $main_term->name ) ) . '">'
                    . $main_term->name . '</a></h1>';
                    $terms = get_terms( 'galerie_kategorie', array(
                        'orderby' => 'name',
                        'parent' => $main_term->term_id
                    ) );
                    
                    if( is_tax() ) {
                        $curr_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
                        $parent = get_term($curr_term->parent, get_query_var('taxonomy') );
                        $sub_terms = get_terms( 'galerie_kategorie', array(
                            'orderby' => 'slug',
                //             'order' => 'DESC',
                            'parent' => $curr_term->term_id 
                        ) );
                        
                        // if we are in the lowest level, we display the other 
                        if ( empty( $sub_terms ) && !in_array( $curr_term, $terms ) ) {
                            $sub_terms = get_terms( get_query_var('taxonomy'), array(
                                'orderby' => 'slug',
                                'parent' => $parent->term_id
                            ) );
                        }
                    }
                    
                    // second level of terms as menu
                    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                    $term_items='<nav class="section-menu-container"><ul class="section-menu">';
                    foreach ( $terms as $term ) {
                        $term_items .= '<li class="foreground section-menu-item"><a class="gallery-link';
                        if( $curr_term == $term || $parent==$term ) {
                            $term_items .= ' gallery-curr-item';
                        }
                        $term_items .= '" href="' . esc_url( get_category_link( $term ) ) . '" alt="' . esc_attr( sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $term->name ) ) . '">' . $term->name . '</a></li>';
                    }
                    $term_items .= '</ul></nav>';
                    echo $term_items;
                    }
            ?>
        </header>
        
        <div class="content-area foreground full-width">
            <div id="gallery-container">

                <?php 
                // if we are a Taxonomy, we display every item from the main loop
                if( is_tax() ) {
                    $ancestors = get_ancestors( $curr_term->term_id, 'galerie_kategorie' );
                } else {
                    $ancestors = array();
                }

                if( is_tax() 
                    && ( $curr_term == $main_term || in_array( $main_term->term_id, $ancestors ) ) ) : ?>
                                            
                    <!-- the main loop, putting out the attached images -->
                    <div id="image-container" class="slider-item">
                        <?php 
                        if ( have_posts() ) : ?>
    <!--                         <div id="img-row-1" class="img-row"> -->
                            <?php $count = 0;
                            while ( have_posts() ) : the_post();
                                echo '<a href="' . esc_url(wp_get_attachment_url( get_the_ID() )) . '">'.wp_get_attachment_image( get_the_ID(), $size='medium' ) .'</a>';
                                    if( $count == 3 ) :
    //                                     echo '</div><div id="img-row-2" class="img-row">';
                                    endif;
                                    $count++;
                            endwhile; ?>
    <!--                         </div> -->
                        <?php 
                        endif; ?>
                    </div> <!--image-container-->
                
                    <div id="galerie-aside" class="slider-item">
    <!--            navigation panel for newer posts -->
                        <?php 
                        if( $curr_term->parent == $main_term->term_id ) :
                            // first level categories display their name
                            echo '<h2>Kategorie: ' . $curr_term->name . '</h2>';
                        elseif ( !in_array( $curr_term, $main_terms ) ) :
                            // second-level cats display their parents name, zero-level cat displays nothing
                            echo '<h2>Kategorie: ' . $parent->name . '</h2>';
                        endif; ?>
                        
                        <?php                            
                        if ( !empty( $sub_terms ) && !is_wp_error( $sub_terms ) && !in_array( $curr_term, $main_terms ) ) { ?>
                        <nav id="galerie-subcat-menu" class="submenu">
                            <h3>Unterkategorien:</h3>
                            <?php
                            $term_items='<ul>';
                            foreach ( $sub_terms as $term ) {
                                $term_items .= '<li><a class="gallery-link';
                                if( $curr_term == $term ) {
                                    $term_items .= ' class="gallery-curr-subitem"';
                                }
                                $term_items .= '" href="' . esc_url( get_category_link( $term ) ) . '" alt="' . esc_attr( sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $term->name ) ) . '">' . $term->name . '</a></li>';
                            }
                            $term_items .= '</ul>';
                            echo $term_items; ?>
                        </nav>
                        <?php } ?>
                        
                        <p class="galerie-description">
                            <?php echo $curr_term->description; ?>
                        </p>
                        
                        <nav id="galerie-paging" class="submenu">
                            <div id="galerie-prev">
                                <?php
                                $ppl_link = get_previous_posts_link();
                                if( isset( $ppl_link ) ) :
                                ?>
                                    <a class="gallery-link" href="<?php $ppl=explode('"', $ppl_link ); 
                                        $ppl_url=$ppl[1];
                                        echo esc_url($ppl_url . '#' . $main_term->slug); ?>
                                        ">
                                        neuere Bilder
                                    </a>
                                <?php else : ?>
                                    <!-- do something if there is no previous post? -->
                                <?php endif; ?>
                            </div>  <!-- navigation panel for newer posts -->
                            <!-- navigation panel for older posts -->
                            <div id="galerie-next">
                            <?php
                        
                                $npl_link = get_next_posts_link();
                                if( isset( $npl_link ) ) :
                                ?>
                                    <a class="gallery-link" href="<?php $npl=explode('"', $npl_link ); 
                                        $npl_url=$npl[1];
                                        echo esc_url($npl_url . '#' . $main_term->slug); ?>
                                        ">
                                        ältere Bilder
                                    </a>
                                <?php else : ?>
                                    <!-- do something if there is no previous post? -->
                                <?php endif; ?>
                            </div> <!-- right navigation panel for older posts -->
                        </nav> <!-- galerie-paging -->
                    </div> <!-- galerie-aside -->
                    <?php
                    else : 
                    // we are not in Gallery mode, so we display some (random) images ?>
                    <div id="image-container" class="slider-item">
                        <?php
                        
                        // main output of the latest images from gallery
                        $args = array(
                            'post_type' => 'attachment',
                            'tax_query' => array( array(
                                    'taxonomy' => 'galerie_kategorie',
                                    'terms' => $main_term->term_id,
                                    ), ),
                            'posts_per_page' => 8//,
    //                             'orderby' => 'rand'
                        );
                        $attachments = get_posts( $args );
                    
                        if ( $attachments ) {
                            echo '<div id="img-row-1" class="img-row">';
                            $count = 0;
                            foreach ( $attachments as $post ) {
                                    setup_postdata( $post );
                                    echo '<a href="' . esc_url(wp_get_attachment_url( $post->ID )) . '">'.wp_get_attachment_image( $post->ID, $size='medium' ) .'</a>';
                                    if( $count == 3 ) {
                                        echo '</div><div id="img-row-2" class="img-row">';
                                    }
                                    $count++;
                            }
                            wp_reset_postdata();
                            echo '</div>';
                        }
                        wp_reset_postdata(); ?>
                        
                        </div> <!--image-container-->
                        

                        
                         <div id="galerie-aside" class="slider-item">
                                                
                        <p class="galerie-description">
                            <?php $galerie_term = get_term_by( 'name', $main_term->name, 'galerie_kategorie');
                                echo $galerie_term->description;?>
                        </p>
                        
                        <nav id="galerie-paging" class="submenu">
                            <div id="galerie-prev">
                            </div>  <!-- navigation panel for newer posts -->
                            <!-- navigation panel for older posts -->
                            <div id="galerie-next">
                                <?php
                                    $cat_link = get_term_link( $main_term->term_id, 'galerie_kategorie' );
                                    $cat_link = substr_replace( $cat_link, '&paged=2', -8, 0 ); ?>
                                <a class="gallery-link" href="<?php echo esc_url( $cat_link ); ?>">ältere Bilder</a>
                            </div> <!-- right navigation panel for older posts -->
                        </nav> <!-- galerie-paging -->
                    </div> <!-- galerie-aside -->
                        
                    <?php endif;  // non-gallery mode ?>                
            </div> <!--gallery-containre-->
        </div>
    </div> <!--galerie-->
    <?php
    } // end foreach main_term
} // end if main_terms not empty ?>
    