<div id="galerie" class="page">


    <?php // menu buttons from gallery categories
    $main_terms = get_terms( 'galerie_kategorie', array(
        'orderby' => 'slug',
        'parent' => 0
    ) );
    if ( ! empty( $main_terms ) && ! is_wp_error( $main_terms ) ) {
        foreach( $main_terms as $main_term ) {
            
            // main gallery button
            echo '<a href="' . esc_url( get_category_link( $main_term ) . '#galerie' ) . '" alt="' . esc_attr( sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $main_term->name ) ) . '">'
            . '<h1>' . $main_term->name . '</h1>' .
            '</a>';
            $terms = get_terms( 'galerie_kategorie', array(
                'orderby' => 'name',
                'parent' => $main_term->term_id
            ) );
            
            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            $term_items='<nav><ul>';
            foreach ( $terms as $term ) {
                $term_items .= '<li class="foreground"><a href="' . esc_url( get_category_link( $term ) . '#galerie' ) . '" alt="' . esc_attr( sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $term->name ) ) . '">' . $term->name . '</a></li>';
            }
            $term_items .= '</ul></nav>';
            echo $term_items;
            }
        }
    }
    ?>
    
    
    <div class="content-area full-width">
        <div class="foreground full-width">
        <?php if ( is_tax() ) {
            $curr_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            $sub_terms = get_terms( 'galerie_kategorie', array(
                'orderby' => 'slug',
                'order' => 'DESC',
                'parent' => $curr_term->term_id 
            ) );
            
            // if we are in the lowest level, we display the other 
            if ( empty( $sub_terms ) ) {
                $parent = get_term($curr_term->parent, get_query_var('taxonomy') );
                $sub_terms = get_terms( get_query_var('taxonomy'), array(
                    'orderby' => 'name',
                    'parent' => $parent->term_id
                ) );
            }
            
            if ( ( !empty( $sub_terms ) || !is_wp_error( $sub_terms ) ) && !in_array($curr_term, $main_terms) ) {
                $term_items='<nav class="submenu"><ul>';
                foreach ( $sub_terms as $term ) {
                    $term_items .= '<li><a href="' . esc_url( get_category_link( $term ) . '#galerie' ) . '" alt="' . esc_attr( sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $term->name ) ) . '">' . $term->name . '</a></li>';
                }
                $term_items .= '</ul></nav>';
                echo $term_items;
            }
        }
        ?>
            
            <div id="gallery-container">
                <?php 
                // if we are a Taxonomy, we display every item from the main loop
                                
                if( is_tax() ) :
                        
                    // left navigation panel for newer posts
                    $ppl_link = get_previous_posts_link();
                    if( isset( $ppl_link ) ) :
                    ?>
                        <a href="<?php $ppl=explode('"', $ppl_link ); 
                            $ppl_url=$ppl[1];
                            echo esc_url($ppl_url . '#galerie'); ?>
                            ">
                            zurück
                        </a>
                    <?php else : ?>
                        <!-- do something if there is no previous post? -->
                    <?php endif; ?>
                        
                    <!-- the main loop, putting out the attached images -->
                    <div id="image-container" class="slider-item">
                        <?php 
                        if ( have_posts() ) : ?>
                            <div id="img-row-1" class="img-row">
                            <?php $count = 0;
                            while ( have_posts() ) : the_post();
                                echo '<a href="' . esc_url(wp_get_attachment_url( get_the_ID() )) . '">'.wp_get_attachment_image( get_the_ID(), $size='medium' ) .'</a>';
                                    if( $count == 3 ) :
                                        echo '</div><div id="img-row-2" class="img-row">';
                                    endif;
                                    $count++;
                            endwhile; ?>
                            </div>
                        <?php 
                        endif; ?>
                    </div> <!--image-container-->
                    <?php
                        // right navigation panel for older posts
                        $npl_link = get_next_posts_link();
                        if( isset( $npl_link ) ) :
                        ?>
                            <a href="<?php $npl=explode('"', $npl_link ); 
                                $npl_url=$npl[1];
                                echo esc_url($npl_url . '#galerie'); ?>
                                ">
                                weiter
                            </a>
                        <?php else : ?>
                            <!-- do something if there is no previous post? -->
                        <?php endif;
                    
                    // we are not in Gallery mode, so we display some (random) images
                    else : ?>
                    
                    <div id="image-container" class="slider-item">
                        <?php
                        // main output of the latest images from gallery
                        $args = array(
                            'post_type' => 'attachment',
                            'tax_query' => 'Galerie',
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
                        
<!--                    Link to next page of all-images gallery -->
                        <div id="gallery-next" class="slider-item">
                            <a href="<?php echo esc_url( get_term_link( 'Galerie', 'galerie_kategorie' ) . '&paged=2#galerie' ); ?>">more</a>
                        </div>
                    <?php endif;  // non-gallery mode ?>                
            </div> <!--gallery-containre-->
        </div>  <!--foreground-->
    </div>
</div> <!--galerie-->