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
        
        <div id="frontpage" class="section">     
            <div id="frontpage-container" class="content-area content-centered fixed-width">
                <div id="main-logo-container" class="fixed-width">
                    <img class="fixed-width main-logo" src="<?php echo esc_url( get_template_directory_uri () . '/img/Logo.svg' )?>" alt="neonlicht fotografie Logo"/>
                </div>
            <?php 
            if( is_front_page() ) {
                while ( have_posts() ) {
                    the_post(); ?>
                    <div class="entry-content content-centered fixed-width">
                        <?php get_template_part( 'template-parts/content', 'page' ); ?>
                    </div>
                <?php
                } // end of the loop.
            } else {
                $frontpage_id = get_option( 'page_on_front' ); 
                $fps = get_pages( array( 
                        'include' => $frontpage_id ) );
                if( $fps ) :
                    foreach( $fps as $fp ) : ?>
                        <div class="entry-content content-centered fixed-width">
                            <article class="page foreground">
                                <header class="entry-header">
                                    <h1 class="entry-title">
                                        <?php echo $fp->post_title; ?>
                                    </h1>
                                </header>
                                <div class="entry-content">
                                    <?php 
                                    $content = $fp->post_content;
                                    $content = apply_filters('the_content', $content);
                                    $content = preg_replace('/<p class=\"attachment\">.*?\/p>/','',$content);
                                    echo $content; ?>
                                </div>
                            </article>
                        </div>
                    <?php endforeach;
                endif;
            } ?>
            </div> <!--frontpage-container-->
        </div>  <!--frontpage-->
        <?php
            get_template_part('template-parts/blog-slider');
            get_template_part('template-parts/gallery');
            get_template_part('template-parts/page-viewer');
        ?>
        

<?php get_footer(); ?>
