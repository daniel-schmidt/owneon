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
        <h1>Hallo und so!</h1>
        <p> hier könnte viel viel Text über allen möglichen blödsinn stehen. </p>
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
               
       
        <?php get_template_part('blog-slider'); ?>
        <?php get_template_part('gallery'); ?>
        
        <div id="info" class="page">
            Text über mich und Impressum...
        </div>
<?php get_footer(); ?>
