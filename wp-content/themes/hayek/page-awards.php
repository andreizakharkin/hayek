<?php
/*
Template Name: People awards 
*/
get_header(); ?>
            <div id="columnRight">
                <div id="postList">
			<?php 					
				query_posts( array(
					'post_type' => APP_AWARDS_TYPE,
					'post_status' => 'publish',					
					'ignore_sticky_posts' => 1,
					'posts_per_page' => -1
				) );
				while (have_posts()) : the_post();
			?>		
                    <div class="item">
                        <h2><?php the_title(); ?></h2>
			<?php 						
					if ( has_post_thumbnail() ) { 
						$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
						$first_img = $thumb[0];
			?>
                        <div class="thumb"><a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo $first_img; ?>&amp;h=161&amp;w=215&amp;zc=1"  alt="<?php the_title(); ?>" /></a></div>											
			<?php 		
					}							
			?>
			<p>
                        <?php truncate_post(150); ?>
			</p>
                        <p class="more"><a class="otherLink" href="<?php the_permalink(); ?>"><span>mehr lesen</span> &gt;</a></p>
                        <div class="clearfix"></div>
                    </div>
			<?php 							
				endwhile; 
				wp_reset_query();			
			?>		    
                    <!-- a href="" class="moreList desktopNone mobileNone">[...]</a -->
                </div>
            </div>
	<?php get_sidebar('left'); ?>		
<?php get_footer(); ?>