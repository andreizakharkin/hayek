<?php /* if(has_sub_field('brigada')) { */ ?>
		<article class="our-houses">
				<h1><?php echo get_post_meta($post->ID, 'title_brigada', true); ?></h1>
					<div id="all">

			<div id="wrapper2" class="shownocolumns">
				<div id="main">
					<div class="item-page">
						<div class="moduletable">
							<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
							<div style="clear: both;"></div>
							<div id="mod_btslideshow_144" class="box_skitter mod_btslideshow" style="width:970px; height:549px;">
								<ul>
									<?php $post=$mbpost; while(has_sub_field('brigada',$post->ID)): $image = get_sub_field('image'); ?>
									<li>
										<!-- img class="cubeRandom" src="<?php echo $image['url']; ?>" rel="<?php echo $image['sizes']['medium']; ?>" / -->
<img class="cubeRandom" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo $image['url']; ?>&amp;h=549&amp;w=970&amp;zc=1" rel="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo $image['url']; ?>&amp;h=549&amp;w=970&amp;zc=1" />
		
										
										<div class="label_text">
											
											<div class="inner"><h4><?php the_sub_field('title'); ?></h4>
												<p><?php the_sub_field('desc'); ?></p>
								</div>
								</div>
									</li>
									<?php endwhile; ?>
									</ul>
								</div>
							<div style="clear: both;"></div>
							<script type="text/javascript">
							// <![CDATA[
									BTJ('#mod_btslideshow_144').skitter({
									width:970,
							height:549,
							animation: 'fade', 
							thumbs: true,
									structure:			
										'<a href="#" class="prev_button">prev</a>' +
										'<a href="#" class="next_button">next</a>' +
										'<span class="info_slide"></span>' +
										'<div class="container_skitter">' +
											'<div class="image">' +
												'<a target="_blank" href="/"><img class="image_main" /></a>' +
													'<div class="label_skitter"></div>' +
												'</div>' +
											'</div>',
									velocity: 1.3,
									interval: 600000,
									thumb_width: '166px',
									thumb_height: '116px',
									caption: 'bottom',
									caption_width: '250',
									navigation: 0,
									auto_play: false,
									fullscreen: false
							});
							// ]]>
							</script>		
						</div>
					</div>
				</div><!-- end main -->
			</div><!-- end wrapper -->

</div><!-- all -->
		</article>
<?php /* } */ ?>		