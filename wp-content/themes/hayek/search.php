<?php get_header(); ?>
            <div id="columnRight">
                <div id="searchDetail">
                    <form action="">
                        <input type="text" name="s" value="<?php echo get_search_query(); ?>" />
                        <input type="submit" value="Suchen &gt;" class="btn" />
                        <div class="clearfix"></div>
                        <div class="searchQuery"><?php global $wp_query; echo $wp_query->found_posts; ?> Suchergebnisse fur „<?php echo get_search_query(); ?>“</div>
                    </form>
                </div>
                <div class="navPanel">
                    <div id="filters">
                        <?php post_per_page(); ?>			
                    </div>
		<?php
			global $query_string;
			$posts_per_page = (@$_COOKIE['posts_per_page']) ? @$_COOKIE['posts_per_page'] : 4;
			wp_corenavi($query_string.'&posts_per_page='.$posts_per_page); 
			query_posts($query_string.'&posts_per_page='.$posts_per_page);
		?>
                    <div class="clearfix"></div>
                </div>
                <div id="postList" class="searchList">
		<?php while ( have_posts() ) : the_post() ?> 		
                    <div class="item noThumb">
                        <h2><?php echo get_the_title(); ?></h2>
                        <p><?php truncate_post(250); ?>
                           <span class="more"><a class="otherLink" href="<?php echo get_permalink(); ?>"><span>mehr lesen</span> &gt;</a></span>
                        </p>
                    </div>
		<?php endwhile; ?>
                </div>
                <div class="navPanel">
                    <?php wp_corenavi($query_string.'&posts_per_page='.$posts_per_page);  ?>
                    <div class="clearfix"></div>
                </div>
            </div>
	<?php get_sidebar('left'); ?>		
<?php get_footer(); ?>