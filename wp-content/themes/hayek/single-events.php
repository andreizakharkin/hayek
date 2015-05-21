<?php
/**
 * @package WordPress
 * @subpackage mr-basil_9
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
                    <p><b>Datum:</b> <?php echo get_post_meta($post->ID, 'events_date', true); ?><br/>
                       <b>Ort:</b> <?php echo get_post_meta($post->ID, 'events_address', true); ?><br/>
                       <b>Ablauf:</b> <?php echo get_post_meta($post->ID, 'events_time', true); ?>
                    </p>
			<?php 
						the_content(); 						
			?>
                    <p>
                        <b>Kontakt:</b><br/>
                        <?php echo get_post_meta($post->ID, 'events_kontakt', true); ?><br/>
                    </p>
                    <p>
                        <b>Kategorie:</b> <?php $cur_terms=get_the_terms($post->ID, APP_EVENTS_CAT); foreach($cur_terms as $cur_term){ echo $cur_term->name." "; } ?>
                    </p>
                    <p class="backLink"><a class="otherLink" href="javascript:history.back()">&lt; <span>Zurück zur Übersicht</span></a></p>
		    <?php 
			if(strtotime("now")<=strtotime(get_post_meta($post->ID, 'events_date', true)))
			{
		    ?>
                    <div class="formArea">
			<?php echo do_shortcode('[contact-form-7 id="90" title="institut_reg_event"]'); ?>
                    </div>
			<?php 
			}
					endwhile; 
				endif; 
			?>		    
                </div>
            </div>
	<?php get_sidebar('left'); ?>		
<?php get_footer(); ?>