<?php   

$main_categories = get_categories( array(
    'orderby' => 'name',
    'parent'  => 0
) );

foreach ( $main_categories as $category ) :
?>
 <div id="blog" class="section">
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
            <header class="section-header">
                <?php
                printf( '<h1 class="section-heading"><a href="%1$s">%2$s</a></h1>',
                    esc_url( get_category_link( $category->term_id )  ),
                    esc_html( $category->name )
                );
                
                
                $categories = get_categories( array(
                    'orderby' => 'name',
                    'childless' => true
                ) );
                if( ! empty( $categories ) ) {
                    $cat_items='<nav class="section-menu-container"><ul class="section-menu">';
                    foreach ( $categories as $cat ) {
                        $cat_items .= '<li class="foreground section-menu-item"><a class="blog-link" href="' . esc_url( get_category_link( $cat )  ) . '" alt="' . esc_attr( sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $cat->name ) ) . '">' . $cat->name . '</a></li>';
                    }
                    $cat_items .= '</ul></nav>';
                    echo $cat_items;
                }?>
            </header>
            <div class="content-area content-centered">
                <div id="blog-description" class="foreground full-width">
                    <?php 
                    // include with keeping variables available
                    include(locate_template('template-parts/archive-description.php'));
                    ?>
                </div><!-- blog-description -->
                <?php
                if( is_archive() && !is_tax() ) : ?>
                    <div class="blog-slider-content">
                    <!-- left navigation panel for newer posts -->
                    <div id='prev-container' class="nav-container slider-item">
                        <?php 
                        $curr_cat = get_query_var( 'cat' );
                        $paged_query_var = (int) get_query_var( 'paged' );
                        $paged = $paged_query_var;
                        if( $paged > 0 ) {
                            $paged--;
                            $args = $wp_query->query_vars;
                            $args['paged'] = $paged;
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
                                        <h3><?php echo the_title( '', '', FALSE ); ?></h3>
                                        <?php echo get_the_post_thumbnail( null, 'small' ); ?>
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
                    
                    <!-- right navigation panel for older posts -->
                    <div id='next-container' class="nav-container slider-item">
                        <?
                        $paged = $paged_query_var;
                        if( $paged == 0 ) $paged = 1;
                        $paged++;
                        
                        $args = $wp_query->query_vars;
                        $args['paged'] = $paged;

                        $next_posts = new WP_Query( $args );

                        if( $next_posts->have_posts() ) :
                            while( $next_posts->have_posts() ) :
                            $next_posts->the_post();?>
                                <a href="<?php $npl=explode('"',get_next_posts_link()); 
                                    $npl_url=$npl[1];
                                    echo esc_url($npl_url . '#blog'); ?>
                                    ">
                                    <div class="blog-side blog-next foreground">
                                        <h3><?php echo the_title( '', '', FALSE ); ?></h3>
                                        <?php echo get_the_post_thumbnail( null, 'small' ); ?>
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
                    
                    <!-- main panels with the loop -->
                    <?php
                    if ( have_posts() ) : ?>
                        <div class="blog-main-container">
                            <?php 
                            while ( have_posts() ) : the_post(); ?>
                                <div class="slider-item blog-main">
                                <?php get_template_part( 'template-parts/content', get_post_format() ); ?>
                                </div>
                            <?php 
                            endwhile; ?>
                        </div>
                    <?php
                    endif;  // the main loop ?>
                    </div> <!--blog-slider-content-->
                <?php    
                else :
                    // we are not displaying an archive query ?>
                    <div id='prev-container' class="nav-container slider-item">
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
                        
                        // rotate posts, in order to output preview posts first, such that they can float to the right past main container
                        $loaded_posts = $latest_blog_posts->posts;
                        array_push($loaded_posts, array_shift($loaded_posts));
                        array_push($loaded_posts, array_shift($loaded_posts));
                        $latest_blog_posts->posts = $loaded_posts;

                        ?>
<!--                        <div class="blog-main-container">-->
                        <?php
                        while ( $latest_blog_posts->have_posts() ) : $latest_blog_posts->the_post();
                            if( $count < 2 ):
                                if( $count == 0 ) :
                                    echo '<div id="next-container" class="nav-container slider-item">';
                                endif;
                                $cat_link = get_category_link( $main_categories[0]->term_id );
                                $cat_link = substr_replace( $cat_link, '&paged=2', -5, 0 );
                                ?>
                                    
                                    <a href="<?php echo esc_url( $cat_link ) ?>">
                                    <div class="blog-side blog-next foreground">
                                        <h3><?php echo the_title( '', '', FALSE ); ?></h3>
                                        <?php echo get_the_post_thumbnail( null, 'small' ); ?>
                                    </div>
                                    </a>
                            <?php
                            else :
                                if( $count == 2 ) : ?>
                                    </div><div class="blog-main-container">
                                <?php
                                endif; ?>
                                <div class="slider-item blog-main">
                                <?php get_template_part( 'template-parts/content', get_post_format() ); ?>
                                </div>
                            <?php
                            endif;
                            $count++;
                        endwhile; ?>
                       </div>
                    <?php endif;
                    wp_reset_postdata();
                    
                endif;?>          

            </div>
        </div>
<?php endforeach; //looping through all top level categories?>