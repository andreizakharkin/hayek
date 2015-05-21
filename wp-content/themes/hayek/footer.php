<?php
/**
 * @package WordPress
 * @subpackage mr-basil_9
 */
?>
    <footer>
        <div class="topic">
            <span class="address"><span>Hayek Institut,</span> <span> Grünangergasse 1/15-1, A - 1010 Wien,</span> <span class="email">E-mail: office@hayek-institut.at</span></span>
            <a href="/impressum/" class="impressum">Impressum</a>
            <div class="clearfix"></div>
        </div>
        <div class="footContent tabletNone mobileNone">
            <nav>
                <ul id="footNav">
                    <li>
		    
		    <?php 
			$menu_name = 'footer_menu1';  
			$locations = get_nav_menu_locations();  
			if(  isset($locations[ $menu_name ]) ){  
				$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
				$menu_items = wp_get_nav_menu_items($menu->term_id);    
				$menu_list = '';  
				foreach ( (array) $menu_items as $key => $menu_item ){  	
					$menu_list .= '<a href="' . $menu_item->url . '">' . $menu_item->title .'</a></br>';
				}
			}      
			else   
				$menu_list = 'Menu "' . $menu_name . '" is NULL.';  
			echo $menu_list;
		?>	
		
                    </li>
                    <li>
		    
		    <?php 
			$menu_name = 'footer_menu2';  
			$locations = get_nav_menu_locations();  
			if(  isset($locations[ $menu_name ]) ){  
				$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
				$menu_items = wp_get_nav_menu_items($menu->term_id);    
				$menu_list = '';  
				foreach ( (array) $menu_items as $key => $menu_item ){  	
					$menu_list .= '<a href="' . $menu_item->url . '">' . $menu_item->title .'</a></br>';
				}
			}      
			else   
				$menu_list = 'Menu "' . $menu_name . '" is NULL.';  
			echo $menu_list;
		?>
		
                    </li>
                </ul>
            </nav>
            <div class="newsLetter">
		<h3>Newsletter</h3>
                <?php echo do_shortcode('[contact-form-7 id="171" title="Newsletter"]'); ?>
            </div>
            <div class="footLinks">
                <h3>Community</h3>
                <div class="soc">
                    <a href="" class="icon_twitter"></a>
                    <a href="https://www.facebook.com/pages/Hayek-Institut/106302432747303?ref=hl" target="_blank" class="icon_fb"></a>
                </div>
                <h3>Downloads</h3>
                <div class="downloads"><a href=""><img src="<?php bloginfo('template_directory')?>/img/logos/economic_dictionary_small.png" width="50" height="50" alt="" /></a></div>
                <h3>Shop</h3>
                <a href="/library_order/" class="icon_shop"></a>
            </div>
            <div class="clearfix"></div>
        </div>
    </footer>

    <div class="popup" id="contacts">
        <h1>Kontakt</h1>
        <div class="mapArea">	
            <p>
               Friedrich A. v. Hayek Institut:<br/>
                Grünangergasse 1/15-1, 1010 Wien,<br/>
                Tel. +43 1 505 1349-31<br/>
                Fax +43 1 505 1349-99<br/>
            </p>
            <p>E-mail: office@hayek-institut.at</p>
            <div class="clearfix"></div>
            <div class="map">
                <iframe width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=de&amp;geocode=&amp;q=Gr%C3%BCnangergasse+1,+A+1010+Wien&amp;aq=t&amp;sll=48.207801,16.375854&amp;sspn=0.012813,0.033023&amp;gl=ua&amp;ie=UTF8&amp;hq=&amp;hnear=Gr%C3%BCnangergasse+1,+Innere+Stadt+1010+Wien,+%D0%90%D0%B2%D1%81%D1%82%D1%80%D0%B8%D1%8F&amp;t=m&amp;ll=48.207744,16.375809&amp;spn=0.054912,0.109863&amp;z=13&amp;iwloc=A&amp;output=embed"></iframe>
            </div>
            <a href="javascript:window.printContact()" class="printMap"><img src="<?php bloginfo('template_directory')?>/img/icon_print.png" alt="" /></a>
            <div class="clearfix"></div>
        </div>
        <div class="formArea">
		<?php echo do_shortcode('[contact-form-7 id="38" title="Contact form"]'); ?>
        </div>
        <div class="clearfix"></div>
    </div>

    <script src="<?php bloginfo('template_directory')?>/js/jquery-1.8.2.min.js"></script>
    <script src="<?php bloginfo('template_directory')?>/js/jquery.fancybox-1.3.4.pack.js"></script>
    <script src="<?php bloginfo('template_directory')?>/js/jquery.bxslider.min.js"></script>
    <script src="<?php bloginfo('template_directory')?>/js/jquery.formstyler.min.js"></script>
    <script src="<?php bloginfo('template_directory')?>/js/script.js"></script>
    
	<?php wp_footer(); ?>    
    
</body>
</html>