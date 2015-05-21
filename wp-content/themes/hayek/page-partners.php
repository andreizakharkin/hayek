<?php
/*
Template Name: Page partners 
*/
get_header(); ?>
            <div id="columnRight">
                <div id="postList">
			<?php 					
				while (have_posts()) : the_post();
					the_content();							
				endwhile; 							
			?>		    
                    <a href="" class="moreList desktopNone mobileNone">[...]</a>
                </div>
            </div>
	<?php get_sidebar('left'); ?>		
<?php get_footer(); ?>