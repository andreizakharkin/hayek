<?php /* if(strlen(get_the_content())>1) { */ ?>
<article class="about-text">
				<section>					
					<h1><a name="text"></a><?php  wp_reset_query(); echo get_post_meta($post->ID, 'why_name', true); ?></h1>
					<aside>
						<div id="desc"><?php  echo get_the_excerpt(); ?></div>
						<div id="expanderContentAboutPost" style="display:none"><?php echo get_the_content(); ?></div>
					</aside>
					<p><a id="expanderHeadAboutPost" style="cursor:pointer;">Читать далее</a></p>					
				</section>			
</article>
<?php /* } */ ?>