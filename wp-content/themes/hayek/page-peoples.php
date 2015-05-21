<?php
/*
Template Name: People page 
*/
get_header(); ?>
            <div id="columnRight">
                <div id="postList" class="institutList">
				
				<?php  
					$taxonomy = APP_IP_CAT;  
					$categories = get_terms($taxonomy); 
					// print_r ($categories);

				foreach ($categories as &$cat) {
					if(get_field('sort', 'ip_category_'.$cat->term_id)){
						$cat->sort=get_field('sort', 'ip_category_'.$cat->term_id);
					}
					else {
						$cat->sort='';
					}				
				}
				unset($cat);
				usort($categories, "compareItems");
					
					foreach($categories as $category) { 
						if(!($category->name=='Historical people')) 
						{
						
					?>
					<div class="itemHead"><?php echo $category->name; ?></div>					
					<?php 					
							query_posts( array(
								'post_type' => APP_INST_PEOPLE_TYPE,
								'post_status' => 'publish',
								 APP_IP_CAT => $category->slug,
							
								'ignore_sticky_posts' => 1,
								'posts_per_page' => -1
							) );
							while (have_posts()) : the_post();
					?>
                    <div class="item" id="<?php echo $category->term_id; ?>">
                        <h2><?php the_title(); ?></h2>
						<?php 						
								if ( has_post_thumbnail() ) { 
									$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
									$first_img = $thumb[0];
						?>
                        <div class="thumb"><a href=""><img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo $first_img; ?>&amp;h=199&amp;w=155&amp;zc=1"  alt="<?php the_title(); ?>" /></a></div>											
						<?php 		
								}
								else {
						?>						
                        <div class="thumb"><a href=""><img src="<?php bloginfo('template_directory')?>/img/tmp/pic13.jpg"  alt="" /></a></div>
						<?php 		
								}							
						?>								
                        <div class="userData">
						<?php 
								echo get_post_meta($post->ID, 'ip_position', true); 
								if(get_post_meta($post->ID, 'ip_town', true)) echo ', '.get_post_meta($post->ID, 'ip_town', true);
								echo ' | ';							
								if(get_post_meta($post->ID, 'ip_email', true)) echo get_post_meta($post->ID, 'ip_email', true);
						?>
						</div>
						<?php the_content(); ?>	

                        <div class="clearfix"></div>
                    </div> 	
                    <?php 							
							endwhile; 
							wp_reset_query();
						}
					}  
					?>					

                    <!-- a href="" class="moreList desktopNone mobileNone">[...]</a -->
                </div>
            </div>
	<?php get_sidebar('left'); ?>		
<?php get_footer(); ?>