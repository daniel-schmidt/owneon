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
                <?php
                if( !is_tax() ) : ?>
                    <!-- left navigation panel for newer posts -->
                    <?php $prev_post = get_adjacent_post( true, '', false ); ?>
                    
                    <?php if ( is_a( $prev_post, 'WP_Post' ) ) : ?>
                        <!-- we have a previous post, show nav div -->
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
                        <!-- if there is no previous post, insert an invisible placeholder -->
                        <div id="blog-prev" class="blog-side invisible slider-item"></div>
                    <?php endif ?>
                
                    <!-- main panels with the loop -->
                    <?php
                    if ( have_posts() ) :
                        while ( have_posts() ) : the_post(); ?>
                            <div class="slider-item blog-main">
                            <?php get_template_part( 'content', get_post_format() ); ?>
                            </div>
                        <?php endwhile;
                    endif;
                    
                    // right navigation panel for older posts
                    $next_post = get_adjacent_post( true, '', true );
                    
                    if ( is_a( $next_post, 'WP_Post' ) ) : ?>
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
                        <!-- if there is no previous post, insert an invisible placeholder -->
                        <div id="blog-next" class="blog-side invisible slider-item">
                        </div>
                    <?php endif;
                    
                else :
                    // we are displaying a taxonomoy term
                    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                    $args = array(
                            'cat' => 12,
                            'post_type' => 'post',
                            'posts_per_page' => 2,
                            'paged' => $paged
//                             'orderby' => 'rand'
                        );
                    $latest_blog_posts = new WP_Query( $args );
                    if ( $latest_blog_posts->have_posts() ) :
                        while ( $latest_blog_posts->have_posts() ) : $latest_blog_posts->the_post(); ?>
                        <div class="slider-item blog-main foreground">
                            <?php get_template_part( 'content', get_post_format() ); ?>
                            </div>
                        <?php endwhile;
                    endif;
                    wp_reset_postdata();
                endif;?>          

                
            </div>
        </div>