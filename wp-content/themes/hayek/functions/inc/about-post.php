<article class="about-text">
				<section>
					<?php /*  query_posts('posts_per_page=1'); */ ?>
					<?php while(have_posts()) : the_post(); ?>
					<h1><a name="text"></a><?php the_title(); ?></h1>
					<aside>
						<div id="desc"><?php echo get_the_excerpt(); ?></div>
						<div id="expanderContentAboutPost" style="display:none"><?php echo morethan(get_the_content(), 102); ?></div>
					</aside>
					<?php endwhile; ?>
					<p><a id="expanderHeadAboutPost" style="cursor:pointer;">Читать далее</a></p>
					<?php /* wp_reset_query(); */ ?>
				</section>
			
			</article>