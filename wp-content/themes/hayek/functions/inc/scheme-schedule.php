<?php /* if(has_sub_field('work_sheme')) { */ ?>
<article class="schedule" id="scheme-schedule">
        <section>
          <h1><?php echo get_post_meta($post->ID, 'title_sheme', true); ?></h1>
          <ul>

          	<?php if(get_field('work_sheme')): ?>

 <?php $str_scheme=""; $i=0;  while(has_sub_field('work_sheme')): $i++;  ?>
	<?php $str_scheme=$str_scheme."<p id='description".$i."'>".get_sub_field('desc')."</p>";    ?>    
<?php endwhile;  wp_reset_query(); $kol_elem=ceil($i/2); ?>

          	<?php $i=1; while(has_sub_field('work_sheme')): $image = get_sub_field('image'); ?>
                        <li class="sheme_img"><span><?php echo $i; ?></span><img style="cursor:pointer;" src="<?php echo $image['url']; ?>" alt="">
            <p><?php the_sub_field('title'); ?></p></li>
            <?php if($i!=10 && $i!=$kol_elem): ?>
                        <li><img src="<?php echo get_template_directory_uri(); ?>/images/arrow.png" alt=""></li>
            <?php endif; ?> 
            <?php if($i==$kol_elem): ?>
          </ul>
          </section>
          	<div class="scheme">
<?php echo $str_scheme; ?>
      </div>
          <section>
          <ul class="second-list">
        <?php endif; ?>                                                           
		<?php $i++; endwhile; endif;?>
            </ul>
<?php if($i<11) : ?>
  <style type="text/css">
    .second-list li:last-child {
      display:none;
    }
  </style>
        <?php endif; ?>

         	<!-- div class="scheme" style="display:none;">
 <?php $i=0;  while(has_sub_field('work_sheme')): $i++;  ?>
                            <p id="description<?php echo $i; ?>"><?php the_sub_field('desc'); ?></p>                     
<?php endwhile; ?>
      </div -->
        </section>
</article>
<?php /* } */ ?>	  