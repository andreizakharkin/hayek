<?php /* if(has_sub_field('our_house')) { */  ?>		
			<article class="our-houses">
				<h1>Наши дома</h1>
				 <div id="content">

<!-- Slider -->

  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/style.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/slider/style/social_24.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/slider/style/animate.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/slider/style/mod_jl_sweet_preview_gallery.css" type="text/css" />
  <!-- link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/slider/style/light.css" type="text/css" / -->
  <link rel="stylesheet" href="http://j25.codextension.com/modules/mod_jl_sweet_preview_gallery/assets/default/css/default.css" type="text/css" />

  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/slider/style/template.css" type="text/css" />
  <style type="text/css">
    .jlattachFlash {
      width: auto !important;
      background: #d7eff5 !important;
      border: 2px dashed #39adcf !important;
    }
    .jlattachFlash .jlcode {
      color: #000000 !important;
    }
  </style>
  <script src="<?php echo get_template_directory_uri(); ?>/js/slider/js/mootools-core.js" type="text/javascript"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/slider/js/core.js" type="text/javascript"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/slider/js/modal.js" type="text/javascript"></script>
<?php /* ?>
  <script src="http://j25.codextension.com/modules/mod_jl_sweet_preview_gallery/assets/jquery.min.js" type="text/javascript"></script>
<?php */ ?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/slider/js/conflict.js" type="text/javascript"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/slider/js/preload.js" type="text/javascript"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/slider/js/jquery.jlslideimage.v2.0.min.js" type="text/javascript"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/slider/js/jquery.easing.1.3.min.js" type="text/javascript"></script>
  <style type="text/css">
    body.bd .main {width: 980px;}
    body.bd #ja-wrapper {min-width: 980px;}
  </style>

<!-- /Slider -->
<section>					
					<div id="ja-wrapper">
<div class="main-inner1 clearfix">
                <!-- SPOTLIGHT -->
<div class="ja-box column ja-box-full" style="width: 100%;">
    	<div class="ja-moduletable moduletable  clearfix" id="Mod130">
						<div class="ja-box-ct clearfix">
		<!------------------------------------- THE CONTENT ------------------------------------------------->
    <div id="jl_container-130" class="jl_container jl-light">
    <div class="loader"></div>
    <div class="jl_image_wrapper"></div>
    <div class="jl-caption">  
<?php $i=0; while(has_sub_field('our_house')): ?>
                 <div class="jl-caption-<?php echo $i; ?> padding-20">
                                        <div class="jl-title animate1"><h3><a href="" title="<?php the_sub_field('title'); ?>"><?php the_sub_field('title'); ?></a></h3></div>
                                                                                <div class="jl-desc animate3"><?php the_sub_field('description'); ?></a></div>
                                    </div>
                                <?php $i++; endwhile; wp_reset_query(); ?>    
    </div>        <div id="jl-controll-130" class="jl-controll ">
            <!-- Dot list with thumbnail preview -->
            <ul class="jl_nav ">
            	<?php while(has_sub_field('our_house')): $image = get_sub_field('image'); ?>
                                <li><a href="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo $image['url']; ?>&amp;h=&amp;w=985&amp;zc=1" rel="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo $image['url']; ?>&amp;h=&amp;w=985&amp;zc=1">Image 10</a></li>
                                <?php endwhile; wp_reset_query(); ?>
                                <li class="jl_preview">
                    <div class="jl_preview_wrapper">
                        <!-- Thumbnail comes here -->
                    </div>
                    <!-- Little triangle -->
                    <span></span>
                </li>
            </ul>
            <div class="mini_divider"></div>
                <!-- Navigation items -->
                <div class="jl_prev"></div>
                <div class="jl_next"></div>
                        
             </div>
    
</div>
<style>
    #jl_container-130 .jl-caption-left,#jl_container-130 .jl-caption-right{
        width:300px    }
    #jl_container-130{
        /* width:920px; */
width:975px;
    }
    #jl_container-130 .jl_image_wrapper{
       /* height:350px; */
        height:470px; 
    }
    #jl_container-130 .loader{
        display:block;
    }
    #jl_container-130 .jl-title{
    	background:#000000;
    }
    #jl_container-130 .jl-price{
    	background:#e65700;
    }
    #jl_container-130 .jl-desc{
    	background:#6EA0D5;
    }
.jl_container ul.jl_nav {
left: 50%;
}
.jl_prev, .jl_next {
display: none!important;
}
</style>
<script>
/*<![CDATA[ */

JLSWEETPREVIEWGAL(document).ready(function(){
    JLSWEETPREVIEWGAL('#jl_container-'+'130').jlSlideImage({
        $duration:8000,
        $shownav:1,
        $posnav:'center',
        $slideKenburns:1,
        dir:'random',
        randomdir:1,
        $easing:'linear',
        imagethumbwidth:'0',
        imagethumbheight:'0',
        auto:1,
        showcaption:1,
        poscaption:'random',
        randomcaption:1,
        start_item:0,
        theme:'light', 
        resize_main_img:1,
        main_width:'950',
        main_height:'500',
        time:15000,
        fade_time:3000    });
});




/* ]]> */
</script>		</div>
    </div>
    												
    <!-- block hidden -->
          		<div class="ja-moduletable moduletable  clearfix" id="Mod141" style="display: none;>
          						<h3><span>Virtuemart Quickcart</span></h3>
          				<div class="ja-box-ct clearfix">
          		<style>
          			#vmQuickCartModule #jlcart div.cart_content{
          				width:450px!important;
          			}
          			#vmQuickCartModule #jlcart div.cart_content ul.innerItems{
          				
          			}
          	</style>
          <div class="vmCartModule " id="vmQuickCartModule" ">
          	<div id="jlcart">
          		<a href="javascript:void(0);" class="cart_dropdown">
          			<img alt="" src="http://j25.codextension.com/modules/mod_virtuemart_quickcart/assets/images/cart_icon.png"/> 
          			Cart empty		</a>
          		
          					<div class="cart_content" id="jl-cart-content">
          							</div>
          				
          	</div>

          </div>

    </div>
	
</div>

				  </div>
	</section>	
				  </div>
				
			</article>
<?php /* } */  ?>