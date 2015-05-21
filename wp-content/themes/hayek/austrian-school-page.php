<?php
/**
Template Name: Austrian School and child
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
		    ?>				
                   <div class="sameBlocks">
                        <h3>Alle wichtigen Personlichkeiten auf einen Blick</h3>		   
		   <?php        if($post->post_parent)
					$post_parent=$post->post_parent;					
				else
					$post_parent=$post->ID;		   
				$args = array(
					'post_type' => 'page',
					'post_parent' => $post_parent,
					'posts_per_page' => 14
				);		
				query_posts( $args ); 
					while (have_posts()) : the_post();
						$thumb = catch_that_image();
		   ?>
                        <div class="item">
                            <a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo $thumb; ?>&amp;h=108&amp;w=80&amp;zc=1" width="80" height="108" alt="" /></a>
                            <span><b><?php echo get_post_meta($post->ID, 'school_name', true); ?></b> (<?php echo get_post_meta($post->ID, 'school_year', true); ?>)<br/><?php echo get_post_meta($post->ID, 'school_about', true); ?></span>
                        </div>
		 <?php 
					endwhile; 
				wp_reset_query();
		?>
                        <div class="clearfix"></div>
                    </div>							
							
				<?php							
						endwhile; 
					endif; 
				?>	
                </div>
            </div>
	<?php get_sidebar('left'); ?>		
<?php get_footer(); ?>