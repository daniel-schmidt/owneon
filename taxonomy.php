<?php get_header(); ?>
<?php get_sidebar(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <header class="entry-header">
	<h1 class="entry-title"><?php echo get_queried_object()->name; ?></h1>
	<p class="tax-description"><?php echo get_queried_object()->description; ?></p>
      </header>

      <div class="entry-content">
      <?php 
      $gallery_shortcode = '[fsg_photobox include="';
// 	$gallery_shortcode = '[gallery ids="';
	if ( have_posts() ) : 
	  while ( have_posts() ) : the_post();

	    $postID = get_the_ID();
	    if ( wp_attachment_is_image( $postID ) ) :
	      $gallery_shortcode = $gallery_shortcode . $postID  . ', '; // intval( $post->post_parent )
// 	      echo $gallery_shortcode;
// 	      the_attachment_link( postID, false, false, true );
	    else :
	      echo get_the_excerpt();
	      echo " - ";
	      the_attachment_link();
	      echo "<br>";
	    endif; // end check for images
	  endwhile; // the Loop
	endif; // end have_posts
	$gallery_shortcode = substr( $gallery_shortcode, 0, -2); // removing last colon
	      $gallery_shortcode = $gallery_shortcode . '" rows="4" cols="4"]';
// 	$gallery_shortcode = $gallery_shortcode . '" columns="5"]';	
// 	      echo $gallery_shortcode;
	remove_filter( 'the_content', 'prepend_attachment');
	echo apply_filters( 'the_content', $gallery_shortcode );
	?>
      </div>
    </article>
  </main>
</div><!--#primary-->
<?php get_footer();  ?>