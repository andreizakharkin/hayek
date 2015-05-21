<?php
/**
 * @package WordPress
 * @subpackage mr-basil_9
 */
 get_header(); 
?>
            <div id="columnRight">
                <div class="contentText">
			<?php 
				if (have_posts()) : 
					while (have_posts()) : 
						the_post();
						$thumb = catch_that_image();
			?>		
                    <h1><?php the_title(); ?></h1>
     			<?php 
						if ( has_post_thumbnail() ) { 
							$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
							$first_img = $thumb[0];
			?>
			<p><img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo $first_img; ?>&amp;h=432&amp;w=683&amp;zc=1" alt="<?php the_title(); ?>" width="100%" /></p>
			<?php 		
						} 
						the_content(); 						
			?>
                    <p class="backLink"><a class="otherLink" href="javascript:history.back()">&lt; <span>Zurück zur Übersicht</span></a></p>
		    <?php 

					endwhile; 
				endif; 
			?>		    
                </div>
            </div>
	<?php get_sidebar('left'); ?>		
<?php get_footer(); ?>