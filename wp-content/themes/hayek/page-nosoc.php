<?php
/**
Template Name: Page without social links 
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
							the_content(); 
						endwhile; 
					endif; 
				?>	
                </div>
            </div>
	<?php get_sidebar('left'); ?>		
<?php get_footer(); ?>