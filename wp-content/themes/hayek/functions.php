<?php
/**
 * @package WordPress
 * @subpackage caribbeanmedicalschools
 */

define('APP_INST_PEOPLE_TYPE', 'ip');
define('APP_IP_CAT', 'ip_category');
define('APP_EVENTS_TYPE', 'events');
define('APP_EVENTS_CAT', 'dir_catalog');
define('APP_AWARDS_TYPE', 'awards');
define('APP_LIBRARY_TYPE', 'library');
define('APP_LIBRARY_CAT', 'library_category');
define('APP_FORM_TYPE', 'forms');
define('APP_FORM_CAT', 'forms_category');
require "mrbasil/admin-post-types.php";

update_option('image_default_link_type','none');
 
add_theme_support( 'post-thumbnails' );

function compareItems($a, $b)
{
   if ( $a->sort < $b->sort ) return -1;
   if ( $a->sort > $b->sort ) return 1;
   return 0; // equality
}
//**
//** Some filepath related tools.
//**

add_action("wp_ajax_more_post", "more_post");
add_action('wp_ajax_nopriv_more_post', 'more_post');
 
function more_post(){
	global $query_string;
	$pgd = $_POST['morepgd'];
	query_posts($query_string.'&paged='.$pgd);
	if (have_posts()) : 
		while (have_posts()) : the_post(); 
			$thumb = catch_that_image(); 
?>		
                    <div class="item">
                        <h2><?php the_title(); ?></h2>
                        <div class="thumb"><a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo $thumb; ?>&amp;h=161&amp;w=215&amp;zc=1"  alt="<?php the_title(); ?>" /></a></div>
                        <div class="date"><?php echo get_the_date('d.m.Y | g:i'); ?></div>
			
				<p><?php truncate_post(150); ?></p>
				
                        <p class="more"><a class="otherLink" href="<?php the_permalink(); ?>"><span>mehr lesen</span> &gt;</a></p>
                        <div class="clearfix"></div>
                    </div>
		    	<?php 
		endwhile; 
	endif;
}

function post_per_year() {	
	$order_year = (@$_COOKIE['order_year']) ? @$_COOKIE['order_year'] : 4;	
?>	
<script>
jQuery(document).ready(function(){
	$("#order_year select.customSelect [value='<?php echo $order_year; ?>']").attr("selected", "selected");
})
</script>
                        <div class="custom-select">                            
				<form method="post" id="order_year" action="?">
					<select class="customSelect">
						<option value="all">all</option>
						<?php 	
							global $wpdb; 
							$mbsqlstr ="select distinct DATE_FORMAT(STR_TO_DATE(pm.meta_value,'%d.%m.%Y'),'%Y') from $wpdb->posts p, $wpdb->postmeta pm
								where p.post_type = '".APP_EVENTS_TYPE."' AND p.post_status = 'publish'
								AND pm.post_id=p.id AND pm.meta_key='events_date' 
								ORDER BY DATE_FORMAT(STR_TO_DATE(pm.meta_value,'%d.%m.%Y'),'%Y') ASC";
							$dates=$wpdb->get_col($mbsqlstr);
							foreach($dates as $sdata) {
						 ?>
						<option value="<?php echo $sdata; ?>"><?php echo $sdata; ?></option>
						<?php 
							} 
						?>										
					</select>
				</form>
                        </div>

<?php	
}

function post_per_month() {	
	$order_month = (@$_COOKIE['order_month']) ? @$_COOKIE['order_month'] : 4;			
?>	
<script>
jQuery(document).ready(function(){
	$("#order_month select.customSelect [value='<?php echo $order_month; ?>']").attr("selected", "selected");
})
</script>
                        <div class="custom-select">
                            <label>Sortierung:</label>
							<form method="post" id="order_month" action="?">
								<select class="customSelect">
									<option value="all">all</option>
								<?php 	
									global $wpdb; 
									$mbsqlstr ="select distinct DATE_FORMAT(STR_TO_DATE(pm.meta_value,'%d.%m.%Y'),'%M') from $wpdb->posts p, $wpdb->postmeta pm
										where p.post_type = '".APP_EVENTS_TYPE."' AND p.post_status = 'publish'
										AND pm.post_id=p.id AND pm.meta_key='events_date' 
										ORDER BY DATE_FORMAT(STR_TO_DATE(pm.meta_value,'%d.%m.%Y'),'%m') ASC";
									$dates=$wpdb->get_col($mbsqlstr);
									foreach($dates as $sdata) {
									if($sdata=='')
								 ?>
									<option value="<?php echo $sdata; ?>"><?php if($sdata=='October') echo 'Oktober '; else echo $sdata; ?></option>
								<?php 
									} 
								?>										
								</select>
							</form>
                        </div>

<?php	
}

function post_per_page() {	
	$posts_per_page = (@$_COOKIE['posts_per_page']) ? @$_COOKIE['posts_per_page'] : 4;	
	$act =($_GET["s"]) ? "?s=".$_GET["s"]."&paged=1" : "?";
?>	
<script>
jQuery(document).ready(function(){
	$("#order_post select.customSelect [value='<?php echo $posts_per_page; ?>']").attr("selected", "selected");
})
</script>
                        <div class="custom-select">
                            <label>Ergebnisse:</label>
			    <form method="post" id="order_post" action="<?php echo $act; ?>">
				<select name="select_count" class="customSelect">
					<option value="4">4 per page</option>
					<option value="10">10 per page</option>
					<option value="-1">all</option>
				</select>
			    </form>
                        </div>	
<?php	
}

function post_cat() {	
	$order_cat = (@$_COOKIE['order_cat']) ? @$_COOKIE['order_cat'] : 'all';	
?>	
<script>
jQuery(document).ready(function(){
	$("#order_cat select.customSelect [value='<?php echo $order_cat; ?>']").attr("selected", "selected");
})
</script>
                        <div class="custom-select">
                            <label>Sortierung:</label>
			    <form method="post" id="order_cat" action="?">
				<select name="select_cat" class="customSelect">
	                                <option value="all">Alle anzeigen</option>
					<option value="Artikel">Artikel</option>
					<option value="Publikationen">Publikationen</option>
					<option value="Video">Video</option>
					<option value="Audio">Audio</option>
					<option value="Bilder">Bilder</option>
					<option value="Downloads">Downloads</option>				
				</select>
			    </form>
                        </div>	
<?php	
}

function url2path($strUrl) {
    $cur = getcwd();
	return $cur.parse_url($strUrl, PHP_URL_PATH);
}

function encryptIt( $q ) {
    $cryptKey  = 'mrbasil';
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
}

function decryptIt( $q ) {
    $cryptKey  = 'mrbasil';
    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    return( $qDecoded );
}

function get_nav_menu_item_children($menu, $parent_id) {
	$submenu = array();
	$rez_menu='';

	foreach($menu as $item){
      if($item->menu_item_parent == $parent_id)
         $submenu[] = $item;
    }

	if ($submenu) {
		$rez_menu.= '<div class="childMenuPointer"></div><ul class="child">';
		foreach($submenu as $el){
			$rez_menu.= '<li><a href="'.$el->url.'">'.$el->title.'</a>'; echo '</li>';
		}
		$rez_menu.=  '</ul>';
	}
	return $rez_menu;
}

function check_len($str, $plus_str="") {
	if(strlen($str)>0) {
		return $str." ".$plus_str;
	}
	else {
		return "";
	}
}

// CF7 Functions
add_action('wpcf7_before_send_mail', 'mycustom_cf_before_action',1);
function mycustom_cf_before_action(&$wpcf7_data) {
	switch($wpcf7_data->id)	{
		case '38': // Contact form		
			$my_post = array(
			'post_title'  	=> date("m.d.y H:m:s")."  Contact form",
			'post_content'  => "<td>".$wpcf7_data->posted_data['your-name']."</td>
				<td>".$wpcf7_data->posted_data['your-email']."</td>
				<td>".$wpcf7_data->posted_data['org']."</td>
				<td>".$wpcf7_data->posted_data['your-subject']."</td>
				<td>".$wpcf7_data->posted_data['your-message']."</td>",
			'post_status'   => 'private',			
			'post_type'   	=> APP_FORM_TYPE
			);
			$pid = wp_insert_post($my_post);
			wp_set_object_terms(  $pid, array(20), APP_FORM_CAT );
		break;
		case '93': // institut_donation		
			$my_post = array(
			    'post_title'  	=> date("m.d.y H:m:s")."  Unterstutzen",
			    'post_content'  => "<td>".$wpcf7_data->posted_data['antext']."</td>
			    <td>".$wpcf7_data->posted_data['title']."</td>
			    <td>".$wpcf7_data->posted_data['fname']."</td>
			    <td>".$wpcf7_data->posted_data['lname']."</td>
			    <td>".$wpcf7_data->posted_data['org']."</td>			               
			    <td>".$wpcf7_data->posted_data['adress']."</td>                                
			    <td>".$wpcf7_data->posted_data['moreadress']."</td>
			    <td>".$wpcf7_data->posted_data['plz']."</td>
			    <td>".$wpcf7_data->posted_data['ort']."</td>
			    <td>".$wpcf7_data->posted_data['land']."</td>             
			    <td>".$wpcf7_data->posted_data['optadr']."</td>
			    <td>".$wpcf7_data->posted_data['moreoptadr']."</td>
			    <td>".$wpcf7_data->posted_data['optplz']."</td>
			    <td>".$wpcf7_data->posted_data['optort']."</td>
			    <td>".$wpcf7_data->posted_data['optland']."</td> 
			    <td>".$wpcf7_data->posted_data['yemail']."</td>
			    <td>".$wpcf7_data->posted_data['phone']."</td>
			    <td>".$wpcf7_data->posted_data['url']."</td>
			    <td>".check_len($wpcf7_data->posted_data['checkbox-1'], $plus_str=" &euro; 1.500")."</td>".
			    "<td>".check_len($wpcf7_data->posted_data['checkbox-2'], $plus_str=" &euro; 15.000")."</td>".
			    "<td>".check_len($wpcf7_data->posted_data['checkbox-3'], $plus_str=" &euro; 6.000")."</td>".
			    "<td>".check_len($wpcf7_data->posted_data['checkbox-4'], $plus_str=" &euro; 20.000")."</td>".
			    "<td>".check_len($wpcf7_data->posted_data['checkbox-5'], $plus_str=" &euro; 1.000")."</td>".
			    "<td>".check_len($wpcf7_data->posted_data['checkbox-6'], $plus_str=" &euro; 1.000")."</td>".                
			    "<td>".check_len($wpcf7_data->posted_data['checkbox-account'])."</td>".                
			    "<td>".check_len($wpcf7_data->posted_data['checkbox-paypal'], $plus_str=" PayPall")."</td>".                
			    "<td>".check_len($wpcf7_data->posted_data['checkbox-bul'])."</td>".                
			    "<td> ".$wpcf7_data->posted_data['your-data1']."</td>".
			    "<td> ".$wpcf7_data->posted_data['your-data2']."</td>",
			    'post_status'   => 'private',			    
			    'post_type'   	=> APP_FORM_TYPE
			);
			$pid = wp_insert_post($my_post);
			wp_set_object_terms(  $pid, array(19), APP_FORM_CAT );
		break;		
		
		case '164': // institut_library_order		
			$my_post = array(
			    'post_title'  	=> date("m.d.y H:m:s")."  Unterstutzen",
			    'post_content'  => "<td>".$wpcf7_data->posted_data['antext']."</td>
				    <td>".$wpcf7_data->posted_data['title']."</td>
				    <td>".$wpcf7_data->posted_data['fname']."</td>
				    <td>".$wpcf7_data->posted_data['lname']."</td>
				    <td>".$wpcf7_data->posted_data['org']."</td>    
				    <td>".$wpcf7_data->posted_data['adress']."</td>                                
				    <td>".$wpcf7_data->posted_data['moreadress']."</td>
				    <td>".$wpcf7_data->posted_data['plz']."</td>
				    <td>".$wpcf7_data->posted_data['ort']."</td>
				    <td>".$wpcf7_data->posted_data['land']."</td>  		
				    <td>".$wpcf7_data->posted_data['optadr']."</td>
				    <td>".$wpcf7_data->posted_data['moreoptadr']."</td>
				    <td>".$wpcf7_data->posted_data['optplz']."</td>
				    <td>".$wpcf7_data->posted_data['optort']."</td>
				    <td>".$wpcf7_data->posted_data['optland']."</td>
				    <td>".$wpcf7_data->posted_data['yemail']."</td>
				    <td>".$wpcf7_data->posted_data['phone']."</td>
				    <td>".$wpcf7_data->posted_data['url']."</td>			    
				    <td>".check_len($wpcf7_data->posted_data['checkbox-1'])."</td>".                
				    "<td>".check_len($wpcf7_data->posted_data['checkbox-2'], $plus_str=" PayPall")."</td>".                
				    "<td>".check_len($wpcf7_data->posted_data['checkbox-bul'])."</td>                            
				    <td> ".$wpcf7_data->posted_data['your-data1']."</td>".
				    "<td> ".$wpcf7_data->posted_data['your-data2']."</td>",
			    'post_status'   => 'private',			    
			    'post_type'   	=> APP_FORM_TYPE
			);
			$pid = wp_insert_post($my_post);			
			wp_set_object_terms(  $pid, array(10), APP_FORM_CAT );
		break;
		
		case '98': // institut_membership	
			$my_post = array(
			    'post_title'  	=> date("m.d.y H:m:s")."  Mitgliedschaft",
			    'post_content'  => "<td>".$wpcf7_data->posted_data['antext']."</td>
				    <td>".$wpcf7_data->posted_data['title']."</td>
				    <td>".$wpcf7_data->posted_data['fname']."</td>
				    <td>".$wpcf7_data->posted_data['lname']."</td>
				    <td>".$wpcf7_data->posted_data['org']."</td>
				    <td>".$wpcf7_data->posted_data['adress']."</td>                                
				    <td>".$wpcf7_data->posted_data['moreadress']."</td>
				    <td>".$wpcf7_data->posted_data['plz']."</td>
				    <td>".$wpcf7_data->posted_data['ort']."</td>
				    <td>".$wpcf7_data->posted_data['land']."</td>  			    
				    <td>".$wpcf7_data->posted_data['yemail']."</td>
				    <td>".$wpcf7_data->posted_data['phone']."</td>
				    <td>".$wpcf7_data->posted_data['url']."</td>			    
				    <td>".check_len($wpcf7_data->posted_data['checkbox-1'], $plus_str=" &euro; 500")."</td>".
				    "<td>".check_len($wpcf7_data->posted_data['checkbox-2'], $plus_str=" &euro; 100")."</td>".				    
				    "<td>".check_len($wpcf7_data->posted_data['checkbox-3'], $plus_str=" &euro; 20")."</td>".                    
 				    "<td>".check_len($wpcf7_data->posted_data['checkbox-4'])."</td>",
			    'post_status'   => 'private',			    
			    'post_type'   	=> APP_FORM_TYPE
			);
			$pid = wp_insert_post($my_post);
			wp_set_object_terms(  $pid, array(18), APP_FORM_CAT );			
		break;		

		case '90': // institut_reg_event	
			$my_post = array(
			    'post_title'  	=> date("m.d.y H:m:s")."  Veranstaltung",
			    'post_content'  => "<td>".$wpcf7_data->posted_data['fname']."</td>
				    <td>".$wpcf7_data->posted_data['lname']."</td>
				    <td>".$wpcf7_data->posted_data['yemail']."</td>				    
				    <td>".$wpcf7_data->posted_data['org']."</td>                        
				    <td>".check_len($wpcf7_data->posted_data['bul-checkbox'])."</td>
				    <td>".check_len($wpcf7_data->posted_data['member-checkbox'])."</td>
				    <td>".$wpcf7_data->posted_data['dynamicname1']."</td> 				    
				    <td>".$wpcf7_data->posted_data['dynamicname']."</td>",
			    'post_status'   => 'private',			    
			    'post_type'   	=> APP_FORM_TYPE
			);
			$pid = wp_insert_post($my_post);
			wp_set_object_terms(  $pid, array(17), APP_FORM_CAT );				
		break;
		
	}
}

function wp_corenavi($my_query_string, $tax=false) {
  global $wp_query, $wp_rewrite;
   query_posts($my_query_string);
  $pages = '';
  $max = $wp_query->max_num_pages;
  if(!$tax) { 
	if (!$current = get_query_var('paged')) $current = 1;  
  }
  else { if (!$current = $_GET["pgd"]) $current = 1; }
 
  $seacrh =($_GET["s"]) ? "&s=".$_GET["s"] : "";
 
  $a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
  $a['total'] = $max;
  $a['current'] = $current;

  $total = 0; //1 - выводить текст "Страница N из N", 0 - не выводить
  $a['mid_size'] = 3; //сколько ссылок показывать слева и справа от текущей
  $a['end_size'] = 1; //сколько ссылок показывать в начале и в конце
  $a['prev_text'] = '&lt;'; //текст ссылки "Предыдущая страница"
  $a['next_text'] = '&gt;'; //текст ссылки "Следующая страница"
  $a['type'] = 'array'; //

  $mb_paginathion=paginate_links($a);  
  $i=0;
?>  
                    <div class="pager">
<?php	  
  foreach($mb_paginathion as $mb_page) {
	$i++;
	if($tax&&$i<count($mb_paginathion)&&$i>1) {
	
		$re1='.*?';	# Non-greedy match on filler
		$re2='\\d+';	# Uninteresting: int
		$re3='.*?';	# Non-greedy match on filler
		$re4='(\\d+)';	# Integer Number 1
		if ($c=preg_match_all ("/".'.*?'.'\\d+'.'.*?'.'>(\\d+)<'."/is", $mb_page, $matches))
		{
			$int1=$matches[1][0];			
			$mb_page='<a class="page-numbers" href="?pgd='.$int1.'">'.$int1.'</a>';			
		}	

	}
	
	if($i==1) {
		if($current==1) {
?>
                        <span class="firstPage" href="">&lt;&lt;</span>
                        <span class="prevPage" href="">&lt;</span>			
<?php			
			echo $mb_page;
		}
		else
		{	
			if($tax)
			{
?>	
                        <a class="firstPage" href="?pgd=1<?php echo $seacrh; ?>">&lt;&lt;</a>
<?php	
			}
			else
			{
?>	
                        <a class="firstPage" href="?paged=1<?php echo $seacrh; ?>">&lt;&lt;</a>
<?php				
			}
			echo $mb_page;
		}
	}
	else
	{
		echo $mb_page;
		if($current==$max&&$i==count($mb_paginathion)) {			
?>
                        <span class="nextPage">&gt;</span>
                        <span class="lastPage">&gt;&gt;</span>			
<?php
		}
		elseif($i==count($mb_paginathion))
		{			
			if($tax)
			{
?>	                        
                        <a class="lastPage" href="?pgd=<?php echo $max; ?><?php echo $seacrh; ?>">&gt;&gt;</a>
<?php		
			}
			else
			{
?>	                        
                        <a class="lastPage" href="?paged=<?php echo $max; ?><?php echo $seacrh; ?>">&gt;&gt;</a>
<?php				
			}
		}
	} 
  
  }  
?>  
                    </div>
<?php 
	wp_reset_query();
}

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

function sksort(&$array, $subkey="id", $sort_ascending=false) {

    if (count($array))
        $temp_array[key($array)] = array_shift($array);

    foreach($array as $key => $val){
        $offset = 0;
        $found = false;
        foreach($temp_array as $tmp_key => $tmp_val)
        {
            if(!$found and strtolower($val[$subkey]) > strtolower($tmp_val[$subkey]))
            {
                $temp_array = array_merge(    (array)array_slice($temp_array,0,$offset),
                                            array($key => $val),
                                            array_slice($temp_array,$offset)
                                          );
                $found = true;
            }
            $offset++;
        }
        if(!$found) $temp_array = array_merge($temp_array, array($key => $val));
    }

    if ($sort_ascending) $array = array_reverse($temp_array);

    else $array = $temp_array;
}	
	
function catch_that_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();

	if ( has_post_thumbnail() ) { 
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
		$first_img = $thumb[0];
	}
	else {
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = $matches [1] [0];
	}

	return $first_img;
} 

function truncate_post($amount) {
	$truncate = get_the_content(); 
	$truncate = apply_filters('the_content', $truncate);
	$truncate = preg_replace('@<script[^>]*?>.*?</script>@si', '', $truncate);
	$truncate = preg_replace('@<style[^>]*?>.*?</style>@si', '', $truncate);
	$truncate = strip_tags($truncate);
	$truncate = substr($truncate, 0, strrpos(substr($truncate, 0, $amount), ' ')); 
	echo $truncate;
	echo "...";
}


// Register ui styles for properties
function admin_hayek_styles(){
    global $post;
    if($post->post_type == 'events') {
     /*   wp_enqueue_style('jquery-ui', WP_CONTENT_URL . '/themes/hayek/js/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.css');  */
wp_enqueue_style('jquery-ui', '//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css');


    }
}
add_action('admin_print_styles', 'admin_hayek_styles');

?>
<?php 

        // This theme uses wp_nav_menu() in one location.
	
			register_nav_menus( array(
		'header_menu' => 'Header_menu',
		'footer_menu1' => 'Footer menu 1',
		'footer_menu2' => 'Footer menu 2',));
		
		require "theme-options.php";
		require "events-form.php";		
?>