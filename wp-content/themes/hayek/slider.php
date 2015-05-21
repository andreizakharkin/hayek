<?php
/**
 * @package WordPress
 * @subpackage mr-basil_9
 */
?>
                <ul class="bxslider">
		
			<?php
				$nt_post_main = get_option('nt_post_main'); 
				$nt_post_main = explode(",", $nt_post_main); 			
				
				foreach($nt_post_main as $post) {				
					setup_postdata($post);			
					$thumb = catch_that_image(); 
			?>
			
                    <li>
                        <div class="caption">
                            <h2><?php the_title(); ?></h2>
                            <div class="date"><?php  echo get_the_date('d.m.Y | G:i');  ?></div>
                        </div>
                        <a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo $thumb; ?>&amp;h=432&amp;w=683&amp;zc=1" alt="<?php the_title(); ?>" /></a>
                    </li>
		    
 			<?php  
				}
				wp_reset_query();
			?>		    
		    
                </ul>