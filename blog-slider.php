 <div id="blog" class="page">
<!--            <div class='post-filters'>
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
            </div>-->
            <?php   
            
            $main_categories = get_categories( array(
                'orderby' => 'name',
                'parent'  => 0
            ) );
            
            foreach ( $main_categories as $category ) {
                printf( '<a href="%1$s"><h1>%2$s</h1></a>',
                    esc_url( get_category_link( $category->term_id ) . '#blog' ),
                    esc_html( $category->name )
                );
            }
            
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
                if( is_category() ) : ?>
                    <!-- left navigation panel for newer posts -->
                    <div id='prev-container' class="slider-item">
                        <?php 
                        $curr_cat = get_query_var( 'cat' );
                        $paged_query_var = (int) get_query_var( 'paged' );
                        $paged = $paged_query_var;
                        if( $paged > 0 ) {
                            $paged--;
                            $args = array(
                                    'orderby' => 'date',
                                    'cat' => $curr_cat,
                                    'paged' => $paged
                                );
                
                            $prev_posts = new WP_Query( $args );
                        }
                        if( isset( $prev_posts ) && $prev_posts->have_posts() ) :
                            //  we have a previous post, show nav divs
                            while( $prev_posts->have_posts() ) :
                            $prev_posts->the_post();?>
                                <a href="<?php $ppl=explode('"',get_previous_posts_link());
                                    $ppl_url=$ppl[1];
                                    echo esc_url($ppl_url . '#blog'); ?>
                                    ">
                                    <div class="blog-side blog-prev foreground">
                                        <h3><?php echo short_title( the_title( '', '', FALSE ), '...', 30 ); ?></h3>
                                        <?php echo get_the_post_thumbnail( null, 'thumbnail' ); ?>
                                    </div>
                                </a>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <!-- if there is no previous post, insert an invisible placeholder -->
                            <div class="blog-side blog-prev invisible"></div>
                        <?php endif;
                        wp_reset_postdata();
                        ?>
                    </div> <!-- left navigation panel -->
                    
                    <!-- main panels with the loop -->
                    <?php
                    if ( have_posts() ) :
                        while ( have_posts() ) : the_post(); ?>
                            <div class="slider-item blog-main">
                            <?php get_template_part( 'content', get_post_format() ); ?>
                            </div>
                        <?php 
                        endwhile;
                    endif;  // the main loop ?>
                    
                    <!-- right navigation panel for older posts -->
                    <div id='next-container' class="slider-item">
                        <?
                        $paged = $paged_query_var;
                        if( $paged == 0 ) $paged = 1;
                        $paged++;
                        $args = array(
                                'orderby' => 'date',
                                'cat' => $curr_cat,
                                'paged' => $paged
                            );
            
                        $next_posts = new WP_Query( $args );

                        if( $next_posts->have_posts() ) :
                            while( $next_posts->have_posts() ) :
                            $next_posts->the_post();?>
                                <a href="<?php $npl=explode('"',get_next_posts_link()); 
                                    $npl_url=$npl[1];
                                    echo esc_url($npl_url . '#blog'); ?>
                                    ">
                                    <div class="blog-side blog-next foreground">
                                        <h3><?php echo short_title( the_title( '', '', FALSE ), '...', 30); ?></h3>
                                        <?php echo get_the_post_thumbnail( null, 'thumbnail' ); ?>
                                    </div>
                                </a>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <!-- if there is no previous post, insert an invisible placeholder -->
                            <div class="blog-side blog-next invisible">
                            </div>
                        <?php endif;
                        
                        wp_reset_postdata(); ?>
                    </div>  <!-- right navigation panel -->
                    
                <?php    
                else :
                    // we are not displaying a category ?>
                    <div id='prev-container' class="slider-item">
                        <div class="blog-side blog-prev invisible"></div>
                    </div>
                    <?php 
                    $args = array(
                            'orderby' => 'date',
                            'posts_per_page' => 4
                        );
	
                    $latest_blog_posts = new WP_Query( $args );
                    if ( $latest_blog_posts->have_posts() ) :
                        $count = 0;
                        while ( $latest_blog_posts->have_posts() ) : $latest_blog_posts->the_post();
                            if( $count < 2 ): ?>
                                <div class="slider-item blog-main foreground">
                                    <?php get_template_part( 'content', get_post_format() ); ?>
                                </div>
                            <?php
                            else :?>
                                <div id='next-container' class="slider-item">
                                    <a href="<?php echo esc_url( get_category_link( $main_categories[0]->term_id ) . '&paged=2#blog' ) ?>">
                                    <div class="blog-side blog-next foreground">
                                        <h3><?php echo short_title( the_title( '', '', FALSE ), '...', 30); ?></h3>
                                        <?php echo get_the_post_thumbnail( null, 'thumbnail' ); ?>
                                    </div>
                                    </a>
                                </div>
                            <?php
                            endif;
                            $count++;
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    
                endif;?>          

            </div>
        </div>