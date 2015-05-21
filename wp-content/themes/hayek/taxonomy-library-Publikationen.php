<?php
	get_header(); 
?>
            <div id="columnRight">
                <div class="navPanel">
                    <div id="filters">
                        <?php post_per_page(); ?>
			<?php post_cat(); ?>
                    </div>
			<?php
				global $query_string;
				$posts_per_page = (@$_COOKIE['posts_per_page']) ? @$_COOKIE['posts_per_page'] : 4;
				$order_cat = (@$_COOKIE['order_cat']) ? @$_COOKIE['order_cat'] : 'all';
				if(!$order_cat=='all') { $order_cat='&'.APP_LIBRARY_CAT.'='.$order_cat; }
				else { $order_cat=''; }
				wp_corenavi($query_string.'&posts_per_page='.$posts_per_page.$order_cat); 
			?>
                    <div class="clearfix"></div>
                </div>
                <div id="postList" class="blogList publicationList">
			<?php 	
				query_posts($query_string.'&posts_per_page='.$posts_per_page);
				while (have_posts()) : the_post();
					$thumb = catch_that_image();
			?>
		<div class="item">
                        <h2><?php the_title(); ?></h2>			
			<div class="thumb"><a href=""><img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo $thumb; ?>&amp;h=180&amp;w=130&amp;zc=1"  alt="<?php the_title(); ?>" /></a></div>
			<div class="date"><b><?php echo get_post_meta($post->ID, 'library_authors', true); ?></b></div>
			<div class="date"><b>&euro; <?php echo get_post_meta($post->ID, 'library_price', true); ?>,-</b></div>
			<p><?php truncate_post(150); ?></p>
			<a class="btn" href="/library_order/">Zur Buchbestellung &gt;</a>
                        <div class="clearfix"></div>
                </div>			
			<?php								
				endwhile; 							
			?>	    
		    <input type="hidden" value="2" id="morepgd" name="morepgd">
                    <a href="" class="moreList desktopNone mobileNone">[...]</a>
                </div>
                <div class="navPanel mobileNone tabletNone">
                    <?php wp_corenavi($query_string.'&posts_per_page='.$posts_per_page.$order_cat);  ?>
                    <div class="clearfix"></div>
                </div>
            </div>

	<?php get_sidebar('left'); ?>		
<?php get_footer(); ?>