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
					?>					
                    
                    <div class="icons">			
                        <div class="item print"><a href="javascript:window.print()"><img src="<?php bloginfo('template_directory')?>/img/icon_print.png" alt="" /></a></div>
			<?php echo do_shortcode( '[share-buttons]' )  ?>
                        <div class="clearfix"></div>
                    </div>
                    <?php 
						the_content(); 
						$category = get_the_category(); 
					?>
                    <p class="backLink"><a class="otherLink" href="<?php echo get_category_link($category[0]->cat_ID); ?>">&lt; <span>Zurück zum <?php echo $category[0]->cat_name; ?></span></a></p>
				<?php 
						endwhile; 
					endif; 
				?>	
                </div>
            </div>
	<?php get_sidebar('left'); ?>		
<?php get_footer(); ?>