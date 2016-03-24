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
                $cat_items .= '<li class="foreground"><a href="' . esc_url( get_category_link( $cat ) . '#blog' ) . '" alt="' . esc_attr( sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $cat->name ) ) . '">' . $cat->name . '</a></li>';
            }
            $cat_items .= '</ul></nav>';
            echo $cat_items;
            }?>
        
            <div class="content-area content-centered">
                
                <!-- left navigation panel for newer posts -->
                <?php $prev_post = get_adjacent_post( true, '', false ); ?>
                <?php if ( is_a( $prev_post, 'WP_Post' ) ) : ?>
                <a href="<?php $ppl=explode('"',get_previous_posts_link()); 
                    $ppl_url=$ppl[1];
                    echo esc_url($ppl_url . '#blog'); ?>
                    ">
                    <div id="blog-prev" class="blog-side foreground  slider-item">
                        <h3><?php echo short_title( get_the_title( $prev_post->ID ), '...', 30 ); ?></h3>
                        <?php echo get_the_post_thumbnail( $prev_post->ID, 'thumbnail' ); ?>
                    </div>
                </a>
                <?php else : ?>
                    <div id="blog-prev" class="blog-side invisible slider-item">
                    </div>
                <?php endif ?>
                
                <!-- main panels -->
                <?php
                if( !is_tag() ) :
//                     print( "kein tag!");
                    if ( have_posts() ) :
                        while ( have_posts() ) : the_post(); ?>
                            <div class="slider-item blog-main">
                            <?php get_template_part( 'content', get_post_format() ); ?>
                            </div>
                        <?php endwhile;
                    endif;
                else :
                    $latest_blog_posts = new WP_Query( array( 'posts_per_page' => 2 ) );
                    if ( $latest_blog_posts->have_posts() ) :
                        while ( $latest_blog_posts->have_posts() ) : $latest_blog_posts->the_post(); ?>
                        <div class="slider-item blog-main foreground">
                            <?php get_template_part( 'content', get_post_format() ); ?>
                            </div>
                        <?php endwhile;
                    endif;
                endif;?>          

                <!-- right navigation panel for older posts -->
                <?php $next_post = get_adjacent_post( true, '', true ); ?>
                <?php if ( is_a( $next_post, 'WP_Post' ) ) : ?>
                <a href="<?php $npl=explode('"',get_next_posts_link()); 
                    $npl_url=$npl[1];
                    echo esc_url($npl_url . '#blog'); ?>
                    ">
                    <div id="blog-next" class="blog-side foreground  slider-item">
                    <h3><?php echo short_title( get_the_title( $next_post->ID ), '...', 30); ?></h3>
                        <?php echo get_the_post_thumbnail( $next_post->ID, 'thumbnail' ); ?>
                    </div>
                </a>
                <?php else : ?>
                    <div id="blog-next" class="blog-side invisible slider-item">
                    </div>
                <?php endif ?>
                
            </div>
        </div>
        
        <?php get_template_part('gallery'); ?>
        
        <div id="info" class="page">
            Text über mich und Impressum...
        </div>
<?php get_footer(); ?>
