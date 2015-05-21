<?php
/**
 * @package WordPress
 * @subpackage mr-basil_9
 */
 get_header(); 
?>
            <div id="columnRight">	
		<?php include_once "slider.php"; ?>

                <div id="postList">
		
			<?php
				$nt_post_main = get_option('nt_post_main_blog'); 				
				$nt_post_main = explode(",", $nt_post_main);
			
				query_posts( array(
					'post_type' => 'any',
					'post_status' => 'publish',										
					'post__in' => $nt_post_main,
				
				) );
					
				while ( have_posts() ) : the_post();
					$thumb = catch_that_image(); 
			?>		
			
                    <div class="item">
                        <h2><?php the_title(); ?></h2>
                        <div class="thumb"><a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo $thumb; ?>&amp;h=240&amp;w=320&amp;zc=1img/tmp/pic01.jpg"  alt="<?php the_title(); ?>" /></a></div>
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