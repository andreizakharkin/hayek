<!DOCTYPE html>
<html>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <link href='http://fonts.googleapis.com/css?family=Gudea:400,700,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Glegoo' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Maven+Pro:400,500,700,900' rel='stylesheet' type='text/css'>
    <link href="<?php bloginfo('template_directory')?>/style.css" rel="stylesheet"/>
    <link href="<?php bloginfo('template_directory')?>/css/print.css" rel="stylesheet" media="print" />   
    
	<?php wp_head(); ?>
	
    <!--[if lt IE 9]>
        <script src="<?php bloginfo('template_directory')?>/js/html5.js"></script>
        <script src="<?php bloginfo('template_directory')?>/js/respond.js"></script>
    <![endif]-->
</head>
<body>

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/de_DE/all.js#xfbml=1&appId=214882511983975";
		fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>

    <div id="wrapper">
        <header>
            <div id="header">
                <a href="/" class="logo"></a>

                <a href="" class="icon_twitter"></a>
                <a href="https://www.facebook.com/pages/Hayek-Institut/106302432747303?ref=hl" target="_blank" class="icon_fb"></a>
                <a href="/library_order/" class="icon_shop">Shop</a>
                <div class="icon_search"></div>

                <div id="searchForm">
                    <div class="pointer"></div>
                    <form action="/">
                        <p><input  name="s" value="Suchbegriff" type="text" /></p>
                    </form>
                </div>

                <!--main menu-->
                <div id="mainMenuTrigger"></div>
                <div id="mainMenu">
                    <div class="mainMenuPointer"></div>
                    <nav>
						<?php							
							$menu_name = 'header_menu';  
							$locations = get_nav_menu_locations();  
							if(  isset($locations[ $menu_name ]) ){  
								$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );   
								$menu_items = wp_get_nav_menu_items($menu->term_id);    
								$menu_list = '<ul>';  								
								foreach ( (array) $menu_items as $key => $menu_item ){									
									// $sub_menu = get_nav_menu_item_children($menu_items, $menu_item->object_id);									
									$sub_menu = get_nav_menu_item_children($menu_items, $menu_item->db_id);									
									$sub_menu_class='';
									if(strlen($sub_menu)>2)  $sub_menu_class='hasChild';
									if ($menu_item->menu_item_parent == "0"): 
										if( get_the_ID() == $menu_item->object_id ) 
										{
											$menu_list .= '<li class="parent '.$sub_menu_class.'"><a class="parentLink current" href="' . $menu_item->url . '">' . $menu_item->title . '</a>';
										}
										else
										{
											$menu_list .= '<li class="parent '.$sub_menu_class.'"><a class="parentLink" href="' . $menu_item->url . '">' . $menu_item->title . '</a>';
										}
										$menu_list .= $sub_menu;
										$menu_list .= '</li>';
									endif;	
								}  
								$menu_list .= '</ul>';  
							} else   
								$menu_list = '<ul><li>Menu "' . $menu_name . '" is NULL.</li></ul>';  
							echo $menu_list;
						?>
                    </nav>
                </div>
            </div>
        </header>	
        <section id="content">
            <div id="breadcrumbs">
	    
                <?php if ( function_exists( 'bread_crumb' ) ) bread_crumb( 'type=string' ); ?>			
		
            </div>		