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
<!--        <header id="page-head">
            <?php
            /*if ( have_posts() ) : while ( have_posts() ) : the_post();
                get_template_part( 'content', get_post_format() );
            endwhile; else:
                // no posts found
            endif;*/ ?>
            <div class="continue-button">
                <a href="#blog">vvv Blog vvv</a>
            </div>
        </header>-->
        
        <div id="fp-headline">
            <a href="#page-head">
                <img src="img/banner_head.png" alt="neonlicht fotografie Logo klein"/>
            </a>
            <nav>
                <ul>
                    <li><a href="#blog">Blog</a></li>
                    <li><a href="#galerie" class="active">Galerie</a></li>
                    <li><a href="#infos">Infos</a></li>
                </ul>
            </nav>
        </div> <!--headline-->
        
        <div id="frontpage" class="section">            
        <?php 
        if( is_front_page() ) {
            while ( have_posts() ) {
                the_post();
                get_template_part( 'content', 'page' );
            } // end of the loop.
        } else {
            $frontpage_id = get_option( 'page_on_front' ); 
            $fps = get_pages( array( 
                    'include' => $frontpage_id ) );
            if( $fps ) :
                foreach( $fps as $fp ) : ?>
                    <header class="section-header">
                        <h1 class="section-heading">
                            <?php echo $fp->post_title; ?>
                        </h1>
                    </header>
                    <div class="entry-content">
                        <?php echo $fp->post_content; ?>
                    </div>
                <?php endforeach;
            endif;
        } ?>
        </div>
        <?php
            get_template_part('blog-slider');
            get_template_part('gallery');
            get_template_part('page-viewer');
        ?>
        

<?php get_footer(); ?>
