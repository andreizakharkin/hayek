<?php
/*
Template Name: Page events 
*/
get_header(); ?>
            <div id="columnRight">
                <div class="navPanel">
                    <div id="filters">
                        <?php post_per_page(); ?>
                        <?php post_per_month(); ?>
                        <?php post_per_year(); ?>
                    </div>
		<?php							
			$posts_per_page = (@$_COOKIE['posts_per_page']) ? @$_COOKIE['posts_per_page'] : 4;
			$paged = ($_GET["pgd"]) ? $_GET["pgd"] : 1;
			$order_year = (@$_COOKIE['order_year']) ? @$_COOKIE['order_year'] : 'all';
			$order_month = (@$_COOKIE['order_month']) ? @$_COOKIE['order_month'] : 'all';
			$date_order = '';
			$month_year='';
			$order="";
			if($order_year=="all") {
				$order_year="%";				
			}			
			if($order_month=="all") {
				$order_month="%";
			}
			else {
				$order_month=date('m',strtotime('01 '.$order_month.' 2001'));
			}			
			$order="%.".$order_month.".".$order_year;
			
			global $wpdb; 
			$mbsqlstr ="select distinct p.id from $wpdb->posts p, $wpdb->postmeta pm
				where p.post_type = '".APP_EVENTS_TYPE."' AND p.post_status = 'publish'
				AND pm.post_id=p.id AND pm.meta_key='events_date' and pm.meta_value like ('".$order."')";			
			$post_id=$wpdb->get_col($mbsqlstr);				
			$mb_query_string=array(
						'post_type' => APP_EVENTS_TYPE,
						'post_status' => 'publish',
						'paged' => $paged,
						'posts_per_page' => -1,
						'ignore_sticky_posts' => 1,
						'post__in' => $post_id					
				);			
			$agenda=get_posts($mb_query_string);						
		?>				
			
		<?php			
			foreach( $agenda as $post ) : setup_postdata( $post );
				$custom_date = get_post_meta($post->ID, 'events_date', true);	
				$evento = strtotime($custom_date);	
				$date_order[$evento] = $post->ID;
			endforeach; 
			ksort($date_order);
			$date_order=array_reverse($date_order,true);
			
			wp_corenavi( array(
						'post_type' => APP_EVENTS_TYPE,
						'post_status' => 'publish',
						'paged' => $paged,
						'posts_per_page' => $posts_per_page,
						'ignore_sticky_posts' => 1,
						'post__in' => $date_order,
						'orderby' => 'post__in',
						'order' => 'DESC '						
				),true ); 							
			$flag=true;
		?>
                    <div class="clearfix"></div>
                </div>
                <div id="postList" class="instList">
			<?php  
				global $query_string;
				$query_string=array(
						'post_type' => APP_EVENTS_TYPE,
						'post_status' => 'publish',						
						'ignore_sticky_posts' => 1,
						'post__in' => $date_order,
						'orderby' => 'post__in',
						'order' => 'DESC '						
				);
				query_posts( array(
						'post_type' => APP_EVENTS_TYPE,
						'post_status' => 'publish',
						'paged' => $paged,
						'posts_per_page' => $posts_per_page,
						'ignore_sticky_posts' => 1,
						'post__in' => $date_order,
						'orderby' => 'post__in',
						'order' => 'DESC '						
				) );
					
				while ( have_posts() ) : the_post();									
					$thumb = catch_that_image(); 
					$events_date=get_post_meta($post->ID, 'events_date', true);
					$f_y = date('F Y',strtotime($events_date));
					
					if(strtotime("now")<=strtotime($events_date))
					{
						if(!($month_year==$f_y))
						{
							$month_year=$f_y;							
							
			?>	
                    <div class="itemHead"><?php echo str_replace("October", "Oktober ", $f_y); ?></div>		    
			<?php
						 } 
					}
					else
					{
						if($flag){
			?>
		    <div class="itemHead">Vergangene Events</div>			
			<?php			
							$flag=false;
						}
					}
			 ?>		
                    <div class="item">
                        <h2><?php the_title(); ?></h2>
                        <div class="thumb"><a href=""><img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo $thumb; ?>&amp;h=161&amp;w=215&amp;zc=1"  alt="" /></a></div>
                        <div class="date"><?php echo get_post_meta($post->ID, 'events_date', true); ?> | <?php echo get_post_meta($post->ID, 'events_address', true); ?></div>
                        <p><?php truncate_post(200); ?></p>
                        <p class="more"><a class="_otherLink btn" href="<?php the_permalink(); ?>"><span>Mehr</span> &gt;</a></p>
                        <div class="clearfix"></div>
                    </div>
 			<?php  
					endwhile;  
					wp_reset_query();				
			?>
		    <input type="hidden" value="2" id="morepgd" name="morepgd">
                    <a href="" class="moreList desktopNone mobileNone">[...]</a>
                </div>
                <div class="navPanel mobileNone tabletNone">
		<?php				
			wp_corenavi( array(
						'post_type' => APP_EVENTS_TYPE,
						'post_status' => 'publish',
						'paged' => $paged,
						'posts_per_page' => $posts_per_page,
						'ignore_sticky_posts' => 1,
						'post__in' => $date_order,
						'orderby' => 'post__in',
						'order' => 'DESC '						
				),true ); 							
		?>
                    <div class="clearfix"></div>
                </div>
            </div>
	<?php get_sidebar('left'); ?>		
<?php get_footer(); ?>