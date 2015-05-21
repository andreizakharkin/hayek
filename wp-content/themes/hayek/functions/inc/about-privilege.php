<?php /* if(has_sub_field('problems')) { */ ?>
<article class="about-privilege">
				
				<aside>
					<div>
						<?php echo get_post_meta($post->ID, 'title_problems', true); ?> 
					</div>
					<?php while(has_sub_field('problems')): $image = get_sub_field('image'); ?>
					<div>
						<img src="<?php echo $image['url']; ?>" alt="">
						<p><?php the_sub_field('desc'); ?></p>
					</div>					
					<?php endwhile; ?>
				</aside>
				<aside>
					<div>
						<?php echo get_post_meta($post->ID, 'title_solutions', true); ?> 
					</div>
					<?php while(has_sub_field('solutions')): $image = get_sub_field('image'); ?>
					<div>
						<img src="<?php echo $image['url']; ?>" alt="">
						<p><?php the_sub_field('desc'); ?></p>
					</div>					
					<?php endwhile; ?>
				</aside>
</article>
<?php /* } */ ?>