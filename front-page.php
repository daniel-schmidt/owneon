<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package owneon
 */
 get_header(); ?>
        <header id="page-head">
<!--            <img src="img/banner_owneon.svg" alt="neonlicht fotografie Logo"/>
            <p>
                Hier gibt es selbstgemachte Fotografien und Blogtexte über das Fotografieren und das Leben selbst. Sieh dich um und entdecke!
            </p>
            <blockquote>
                Neonlicht, schimmerndes Neonlicht
                und wenn die Nacht anbricht, ist diese Stadt aus Licht.

                    – Kraftwerk
            </blockquote>-->
            
<!--        Output of the page assigned as startpage in the backend.
            Greetings, etc.-->
            <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post();
                get_template_part( 'content', get_post_format() );
            endwhile; else:
                // no posts found
            endif; ?>
            <div class="continue-button">
                <a href="#blog">vvv Blog vvv</a>
            </div>
        </header>
        
        <div id="fp-headline">
            <a href="#page-head">
                <img src="img/banner_head.png" alt="neonlicht fotografie Logo klein"/>
            </a>
            <nav>
                <ul>
                    <li><a href="#blog">Blog</a></li>
                    <li><a href="#galerie" class="active">Galerie</a></li>
                    <li><a href="#info">Infos</a></li>
                </ul>
            </nav>
        </div> <!--headline-->
               
        <div id="blog" class="page">
            
            <?php $categories = get_categories( array(
                'orderby' => 'name',
                'childless' => true
            ) );
            if( ! empty( $categories ) ) {
            $cat_items='<nav><ul>';
            foreach ( $categories as $cat ) {
                $cat_items .= '<li class="foreground"><a href="' . esc_url( get_category_link( $cat ) ) . '" alt="' . esc_attr( sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $cat->name ) ) . '">' . $cat->name . '</a></li>';
            }
            $cat_items .= '</ul></nav>';
            echo $cat_items;
            }?>
        
            <div class="content-area content-centered">

                <div id="blog-prev" class="blog-side foreground  slider-item">
                    <h3>Über den Wolken – Besteigung des Fuji</h3>
                    <img src="content/koptisches_kairo04.jpg" alt="koptisches kairo 04"/>
                </div>
                
                
                <?php $latest_blog_posts = new WP_Query( array( 'posts_per_page' => 2 ) );

                if ( $latest_blog_posts->have_posts() ) :
                    while ( $latest_blog_posts->have_posts() ) : $latest_blog_posts->the_post(); ?>
                        <div class="slider-item blog-main foreground">
                        <?php get_template_part( 'content', get_post_format() ); ?>
                        </div>
                    <?php endwhile;
                endif;?>          
                <!--<article  id="blog-left" class="blog-main foreground slider-item">
                    <header class="entry-header">
                        <h2>Kyoto – überall Tempel!</h2>
                        <p> Veröffentlicht am 24. Januar 2016 </p>
                    </header>
                    <div class="entry-content">
                        <img src="content/koptisches_kairo02.jpg" alt="koptisches kairo 02"/>
                        <p>
                            Nachdem es in meinem letzten Reisebericht im vergangenen Jahr um religiöse Stätten in Ägypten ging, mache ich nun thematisch passend weiter mit einem Bericht aus Japan. Während ich es mit meiner Freundin in Kairo geschafft hatte, an einem Tag Gebäude von vier unterschiedlichen Religionsgemeinschaften 1 zu besichtigen, gibt es in Kyoto eine noch viel unüberschaubarere Menge an Tempeln und Schreinen.
                        </p>
                    </div>
                    <footer class="entry-meta">
                    </footer>
                </article>
                
                <article id="blog-right" class="blog-main foreground slider-item">
                    <header class="entry-header">
                        <h2>Jena - Herbst auf Napoleons Schlachtfeld</h2>
                        <p> Veröffentlicht am 18. Oktober 2015 </p>
                    </header>
                    <div class="entry-content">
                        <img src="content/koptisches_kairo03.jpg" alt="koptisches kairo 03"/>
                        <p>
                            Schon der letzte Beitrag zeigte, dass es hier im Saaletal sehr schöne Ecken gibt. Heute geht es um meinen Lieblingsplatz in der direkten Umgebung von Jena: den Napoléonstein. Ich war dort vor zwei Wochen und habe einen der letzten wärmeren Herbsttage zum fotografieren genutzt.
                        </p>
                    </div>
                    <footer class="entry-meta">
                    </footer>
                </article>-->

                <div id="blog-next" class="blog-side foreground slider-item">
                    <h3>Weiße Weihnachten</h3>
                    <img src="content/koptisches_kairo06.jpg" alt="koptisches kairo 06"/>
                </div>

            </div>
        </div>
        
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
                        $term_items .= '<li class="foreground"><a href="' . esc_url( get_category_link( $term ) ) . '" alt="' . esc_attr( sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $term->name ) ) . '">' . $term->name . '</a></li>';
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
                                    'posts_per_page' => 8,
                                    'orderby' => 'rand'
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
        
        <div id="info" class="page">
            Text über mich und Impressum...
        </div>
<?php get_footer(); ?>
