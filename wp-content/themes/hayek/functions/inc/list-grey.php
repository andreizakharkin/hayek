<?php /* if(has_sub_field('komplekt1')) { */ ?>
<article class="list-grey">
	<section>
		<article>
<?php wp_reset_query(); $i=0; while(has_sub_field('brigada',$post->ID)): ?>
<div style="display: none;" id="html_block<?php echo $i; ?>">
<?php 
	$html_block=get_sub_field('html_block');
	echo html_entity_decode($html_block);  
?>	
</div>
<?php $i++; endwhile; wp_reset_query(); ?> 

			<!-- h1><?php echo get_post_meta($post->ID, 'title_komplekt', true); ?></h1>
			<ol>
				<?php while(has_sub_field('komplekt1',$post->ID)):  ?>
				<li><?php the_sub_field('title'); ?></li>
				<?php endwhile; ?>
			</ol>
			<ol>
				<?php while(has_sub_field('komplekt2',$post->ID)):  ?>
				<li><?php the_sub_field('title'); ?></li>
				<?php endwhile; ?>
			</ol -->
		</article>
		<span> </span>
	</section>
</article>
<?php /* } */ ?>	