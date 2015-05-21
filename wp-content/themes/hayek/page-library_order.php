<?php
/**
Template Name: Page library order
 */
 get_header(); 
?>
            <div id="columnRight">
                <div class="contentText">
				<?php 
					if (have_posts()) : 
						while (have_posts()) : 
							the_post();
				?>				
                    <h1><?php the_title(); ?></h1>
                    <?php 
						the_content(); 						
					?>
				<?php 
						endwhile; 
					endif; 
				?>						
                    <p class="backLink"><a class="otherLink" href="/bibliothek">&lt; <span>zurück zur Bibliothek</span></a></p>
                    <div class="bookList">
                        <p><b>Ich möchte folgende Publikation/en bestellen:</b></p>
                        <table width="100%" cellpadding="0" cellspacing="0">
						<?php 					
							query_posts( array(
								'post_type' => APP_LIBRARY_TYPE,
								'post_status' => 'publish',					
								'ignore_sticky_posts' => 1,
								APP_LIBRARY_CAT => 'Publikationen',
								'posts_per_page' => -1
							) );
							$amm_id=0;
							while (have_posts()) : the_post();
								$amm_id++;
						?>						
                            <tr>
                                <td><input name="amm<?php echo $amm_id; ?>" type="text" value="Stk." /></td>
                                <td>
                                    <b><?php the_title(); ?></b><br/>
                                    <?php echo get_post_meta($post->ID, 'library_authors', true); ?>
                                </td>
                                <td class="cena">&euro; <?php echo get_post_meta($post->ID, 'library_price', true); ?>,-</td>
                            </tr>
						<?php									
							endwhile; 
							wp_reset_query();			
						?>
                        </table>
                    </div>
                </div>
                <div class="formArea">
			<?php echo do_shortcode('[contact-form-7 id="164" title="institut_library_order"]'); ?>					
                </div>
            </div>
	<?php get_sidebar('left'); ?>		
<?php get_footer(); ?>