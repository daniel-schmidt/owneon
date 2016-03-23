<div id="galerie" class="page">

    <?php $main_terms = get_terms( 'galerie_kategorie', array(
        'orderby' => 'name',
        'parent' => 0
    ) );
    
    if ( ! empty( $main_terms ) && ! is_wp_error( $main_terms ) ) {
        foreach( $main_terms as $main_term ) {
            echo '<h1>' . $main_term->name . '</h1>';
            
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
            <nav class="submenu">
                <ul>
                    <li>Japan 2015</li>
                    <li class="active">Ägypten 2015</li>
                    <li>München 2014</li>
                    <li>Schweden 2013</li>
                    <li>Pfaffenstein 2013</li>
                </ul>
            </nav>
            
            <div id="gallery-container">
            
                <div id="gallery-prev" class="slider-item">
                    <a href=#gallery>prev</a>
                </div>
                
                <div id="image-container" class="slider-item">
                    <?php 
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
                    ?>
                </div> <!--image-container-->
            
                <div id="gallery-next" class="slider-item">
                    <a href=#gallery>more</a>
                </div>
                
            </div> <!--gallery-containre-->
        </div>  <!--foreground-->
    </div>
</div> <!--galerie-->