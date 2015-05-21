<?php
/**
 * @package WordPress
 * @subpackage mr-basil_9
 */
 get_header(); 
?>
            <div id="columnRight">
                <div class="navPanel">
                    <div id="filters">
                        <?php post_per_page(); ?>			
                    </div>
		<?php
			global $query_string;
			$posts_per_page = (@$_COOKIE['posts_per_page']) ? @$_COOKIE['posts_per_page'] : 4;
			wp_corenavi($query_string.'&posts_per_page='.$posts_per_page); 
		?>
                    <div class="clearfix"></div>
                </div>
                <div id="postList" class="blogList">
		
			<?php				
				query_posts($query_string.'&posts_per_page='.$posts_per_page);
				if (have_posts()) : 
					while (have_posts()) : the_post(); 
						$thumb = catch_that_image(); 
			?>
		
                    <div class="item">
                        <h2><?php the_title(); ?></h2>
                        <div class="thumb"><a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo $thumb; ?>&amp;h=161&amp;w=215&amp;zc=1"  alt="<?php the_title(); ?>" /></a></div>
                        <div class="date"><?php echo get_the_date('d.m.Y | g:i'); ?></div>
			
				<p><?php truncate_post(150); ?></p>
				
                        <p class="more"><a class="otherLink" href="<?php the_permalink(); ?>"><span>mehr lesen</span> &gt;</a></p>
                        <div class="clearfix"></div>
                    </div>
		    	<?php 
					endwhile; 
				endif; 
			?>
		    <input type="hidden" value="2" id="morepgd" name="morepgd">
                    <a href="" class="moreList desktopNone mobileNone">[...]</a>
                </div>
                <div class="navPanel mobileNone tabletNone">
                    <?php wp_corenavi($query_string.'&posts_per_page='.$posts_per_page);  ?>
                    <div class="clearfix"></div>
                </div>
            </div>
	<?php get_sidebar('left'); ?>		
<?php get_footer(); ?>