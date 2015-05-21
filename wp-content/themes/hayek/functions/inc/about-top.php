			<article class="about-top">
				<?php $topimg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');?>
				<?php if(is_array($topimg)) { ?>
				<img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo $topimg[0]; ?>&amp;h=390&amp;w=629&amp;zc=1" alt="<?php bloginfo('name'); ?>">
				<?php } ?>
				<aside>
				<div class="project-form">
					<?php echo do_shortcode(cf7_remove_formatting('[contact-form-7 id="312" 		title="Заказать обратный звонок"]')); ?>
				</div>
				<div class="project-form2">
					<?php echo do_shortcode(cf7_remove_formatting('[contact-form-7 id="313" title="Получить прайс"]')); ?>
				</div>
				</aside>
			</article>