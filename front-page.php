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
            <div class='post-filters'>
                <form>
                <select name="orderby">
                        <option value='post_date'>Order By Date</option>
                        <option value='post_title'>Order By Title</option>
                        <option value='rand'>Random Order</option>
                </select>
                <select name="order">
                        <option value='DESC'>Descending</option>
                        <option value='ASC'>Ascending</option>
                </select>
                <select name="thumbnail">
                        <option value='all'>All Posts</option>
                        <option value='only_thumbnailed'>Posts With Thumbnails</option>
                </select>
                <input type="submit" value="Submit">
                </form>
            </div>
            <?php            
            $categories = get_categories( array(
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
                    owneon_paging_nav();
                endif;?>          

                <div id="blog-next" class="blog-side foreground slider-item">
                    <h3>Weiße Weihnachten</h3>
                    <?php next_post_link(); ?>
                    <img src="content/koptisches_kairo06.jpg" alt="koptisches kairo 06"/>
                </div>

            </div>
        </div>
        
        <?php get_template_part('gallery'); ?>
        
        <div id="info" class="page">
            Text über mich und Impressum...
        </div>
<?php get_footer(); ?>
