<?php if(get_post_meta($post->ID, 'Data_end_act', true)) { ?>			
			<article class="project-present project-present1">
				<section>
					<aside>
						<?php echo get_post_meta($post->ID, 'comment_act', true); ?>
					<p><span>До конца акции осталось</span></p>
						<div class="clock"></div>
  
  <?php  print_countdown(get_post_meta($post->ID, 'Data_end_act', true)); ?>	
						
					</aside>
<?php echo do_shortcode(cf7_remove_formatting('[contact-form-7 id="318" title="Звоните прямо сейчас"]')); ?>
				</section>
			</article>
<?php } ?>