<?php
/**
 * Custom post types and taxonomies
 *
 *
 * @version 1.0
 *
 */

// Define the custom post types
add_action( 'init', 'basil_post_type', 0 );

function update_post_meta_array($post, $array)
{
    foreach($array as $item)
        update_post_meta($post->ID, $item, $_POST[$item]);
}

function basil_text_meta($post, $metabox)
{
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post->ID;
    }
    $custom = get_post_custom($post->ID);
    $value = $custom[$metabox['id']][0];
    ?>
<input type="text" name="<? echo $metabox['id']; ?>" value="<? echo $value; ?>" />
<?php
}

function basil_textarea_meta($post, $metabox)
{
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post->ID;
    }
    $custom = get_post_custom($post->ID);
    $value = $custom[$metabox['id']][0];
    ?>
<textarea type="text" name="<? echo $metabox['id']; ?>" cols="60" rows="4" style="width:97%"><? echo $value; ?></textarea>
<?php
}

function basil_checkbox_meta($post, $metabox)
{
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post->ID;
    }
    $custom = get_post_custom($post->ID);
    $value = $custom[$metabox['id']][0];
    ?>
<input type="checkbox" name="<? echo $metabox['id']; ?>"  <?  $value ? ' checked="checked"' : ''; ?> />
<?php
}

function basil_select_meta($post, $metabox)
{
    global $post;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post->ID;
    }
    $custom = get_post_custom($post->ID);
    $value = $custom[$metabox['id']][0];
    ?>
    <select name="<? echo $metabox['id']; ?>">
        <? foreach($metabox['args']['array'] as $key => $option): ?>
            <option value="<? echo $key; ?>" <? echo ($key == $value ? 'selected' : ''); ?>><? echo $option; ?></option>
        <? endforeach; ?>
    </select>
    <?
}

// register all the custom taxonomies and custom post type
function basil_post_type() {
    global $wpdb; 
    
    register_post_type( APP_FORM_TYPE,
            array('labels' => array(
					'name' => __( 'Forms messages'),
					'singular_name' => __( 'Forms messages'),
					'add_new' => __( 'Add new'),
					'add_new_item' => __( 'Add new messages'),
					'edit' => __( 'Chandge'),
					'edit_item' => __( 'Chandge messages'),
					'new_item' => __( 'New messages'),
					'view' => __( 'Show messages'),
					'view_item' => __( 'Show messages'),
					'search_items' => __( 'Find messages'),
					'not_found' => __( 'Messages did not found'),
					'not_found_in_trash' => __( 'Messages found in trash'),
					'parent' => __( 'Parent messages'),
                    ),
                    'description' => __( 'You can add messages'),
                    'public' => true,
                    'show_ui' => true,
                    'capability_type' => 'post',
                    'publicly_queryable' => true,
                    'exclude_from_search' => false,
                    'menu_position' => 8,
                    'menu_icon' => get_template_directory_uri() . '/img/people.png',
                    'hierarchical' => false,
                    'rewrite' => array( 'slug' => "forms", 'with_front' => false ), /* Slug set so that permalinks work when just showing post name */
                    'query_var' => true,
		    'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' )
            )
    );
    register_taxonomy( APP_FORM_CAT,
            array( APP_FORM_TYPE ),
            array('hierarchical' => true,
                    'labels' => array(
					'name' => __( 'Categories'),
					'singular_name' => __( 'Categories'),
					'search_items' =>  __( 'Find categories'),
					'all_items' => __( 'All categories'),
					'parent_item' => __( 'Parent categories'),
					'parent_item_colon' => __( 'Parent categories:'),
					'edit_item' => __( 'Change categories'),
					'update_item' => __( 'Reload categories'),
					'add_new_item' => __( 'Add categories'),
					'new_item_name' => __( 'New name categories')
                    ),
                    'show_ui' => true,
                    'query_var' => true,					
                    'rewrite' => array( 'slug' => "forms_cat", 'with_front' => false, 'hierarchical' => true ), 
            )
    );	    
    
    
    
    
    register_post_type( APP_INST_PEOPLE_TYPE,
            array('labels' => array(
					'name' => __( 'People pages'),
					'singular_name' => __( 'Peoples'),
					'add_new' => __( 'Add new'),
					'add_new_item' => __( 'Add new people'),
					'edit' => __( 'Chandge'),
					'edit_item' => __( 'Chandge people'),
					'new_item' => __( 'New people'),
					'view' => __( 'Show people'),
					'view_item' => __( 'Show people'),
					'search_items' => __( 'Find people'),
					'not_found' => __( 'People did not found'),
					'not_found_in_trash' => __( 'People found in trash'),
					'parent' => __( 'Parent people'),
                    ),
                    'description' => __( 'You can add people'),
                    'public' => true,
                    'show_ui' => true,
                    'capability_type' => 'post',
                    'publicly_queryable' => true,
                    'exclude_from_search' => false,
                    'menu_position' => 8,
                    'menu_icon' => get_template_directory_uri() . '/img/people.png',
                    'hierarchical' => false,
                    'rewrite' => array( 'slug' => "ip", 'with_front' => false ), /* Slug set so that permalinks work when just showing post name */
                    'query_var' => true,
		    'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' )
            )
    );
    register_taxonomy( APP_IP_CAT,
            array( APP_INST_PEOPLE_TYPE ),
            array('hierarchical' => true,
                    'labels' => array(
					'name' => __( 'Categories'),
					'singular_name' => __( 'Categories'),
					'search_items' =>  __( 'Find categories'),
					'all_items' => __( 'All categories'),
					'parent_item' => __( 'Parent categories'),
					'parent_item_colon' => __( 'Parent categories:'),
					'edit_item' => __( 'Change categories'),
					'update_item' => __( 'Reload categories'),
					'add_new_item' => __( 'Add categories'),
					'new_item_name' => __( 'New name categories')
                    ),
                    'show_ui' => true,
                    'query_var' => true,					
                    'rewrite' => array( 'slug' => "ip_cat", 'with_front' => false, 'hierarchical' => true ), 
            )
    );	

    register_post_type( APP_EVENTS_TYPE,
            array('labels' => array(
					'name' => __( 'Events pages'),
					'singular_name' => __( 'Events'),
					'add_new' => __( 'Add new'),
					'add_new_item' => __( 'Add new events'),
					'edit' => __( 'Chandge'),
					'edit_item' => __( 'Chandge events'),
					'new_item' => __( 'New events'),
					'view' => __( 'Show events'),
					'view_item' => __( 'Show events'),
					'search_items' => __( 'Find events'),
					'not_found' => __( 'Events did not found'),
					'not_found_in_trash' => __( 'Events found in trash'),
					'parent' => __( 'Parent events'),
                    ),
                    'description' => __( 'You can add events'),
                    'public' => true,
                    'show_ui' => true,
                    'capability_type' => 'post',
                    'publicly_queryable' => true,
                    'exclude_from_search' => false,
                    'menu_position' => 8,
                    'menu_icon' => get_template_directory_uri() . '/img/events.png',
                    'hierarchical' => false,
                    'rewrite' => array( 'slug' => "events", 'with_front' => false ), /* Slug set so that permalinks work when just showing post name */
                    'query_var' => true,
		    'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' )
            )
    );
    register_taxonomy( APP_EVENTS_CAT,
            array( APP_EVENTS_TYPE ),
            array('hierarchical' => true,
                    'labels' => array(
					'name' => __( 'Categories'),
					'singular_name' => __( 'Categories'),
					'search_items' =>  __( 'Find categories'),
					'all_items' => __( 'All categories'),
					'parent_item' => __( 'Parent categories'),
					'parent_item_colon' => __( 'Parent categories:'),
					'edit_item' => __( 'Change categories'),
					'update_item' => __( 'Reload categories'),
					'add_new_item' => __( 'Add categories'),
					'new_item_name' => __( 'New name categories')
                    ),
                    'show_ui' => true,
                    'query_var' => true,					
                    'rewrite' => array( 'slug' => "events_cat", 'with_front' => false, 'hierarchical' => true ), 
            )
    );	
    register_post_type( APP_AWARDS_TYPE,
            array('labels' => array(
					'name' => __( 'Awards pages'),
					'singular_name' => __( 'Awards'),
					'add_new' => __( 'Add new'),
					'add_new_item' => __( 'Add new awards'),
					'edit' => __( 'Chandge'),
					'edit_item' => __( 'Chandge awards'),
					'new_item' => __( 'New awards'),
					'view' => __( 'Show awards'),
					'view_item' => __( 'Show awards'),
					'search_items' => __( 'Find awards'),
					'not_found' => __( 'Awards did not found'),
					'not_found_in_trash' => __( 'Awards found in trash'),
					'parent' => __( 'Parent Awards'),
                    ),
                    'description' => __( 'You can add awards'),
                    'public' => true,
                    'show_ui' => true,
                    'capability_type' => 'post',
                    'publicly_queryable' => true,
                    'exclude_from_search' => false,
                    'menu_position' => 8,
                    'menu_icon' => get_template_directory_uri() . '/img/awards.png',
                    'hierarchical' => false,
                    'rewrite' => array( 'slug' => "awards", 'with_front' => false ), /* Slug set so that permalinks work when just showing post name */
                    'query_var' => true,
		    'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' )
            )
    );  

    register_post_type( APP_LIBRARY_TYPE,
            array('labels' => array(
					'name' => __( 'Library'),
					'singular_name' => __( 'Library'),
					'add_new' => __( 'Add new'),
					'add_new_item' => __( 'Add new library'),
					'edit' => __( 'Chandge'),
					'edit_item' => __( 'Chandge library'),
					'new_item' => __( 'New library'),
					'view' => __( 'Show library'),
					'view_item' => __( 'Show library'),
					'search_items' => __( 'Find library'),
					'not_found' => __( 'Library did not found'),
					'not_found_in_trash' => __( 'Library found in trash'),
					'parent' => __( 'Parent library'),
                    ),
                    'description' => __( 'You can add events'),
                    'public' => true,
                    'show_ui' => true,
                    'capability_type' => 'post',
                    'publicly_queryable' => true,
                    'exclude_from_search' => false,
                    'menu_position' => 8,
                    'menu_icon' => get_template_directory_uri() . '/img/library.png',
                    'hierarchical' => false,
                    'rewrite' => array( 'slug' => "library", 'with_front' => false ), /* Slug set so that permalinks work when just showing post name */
                    'query_var' => true,
		    'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' )
            )
    );
    register_taxonomy( APP_LIBRARY_CAT,
            array( APP_LIBRARY_TYPE ),
            array('hierarchical' => true,
                    'labels' => array(
					'name' => __( 'Categories'),
					'singular_name' => __( 'Categories'),
					'search_items' =>  __( 'Find categories'),
					'all_items' => __( 'All categories'),
					'parent_item' => __( 'Parent categories'),
					'parent_item_colon' => __( 'Parent categories:'),
					'edit_item' => __( 'Change categories'),
					'update_item' => __( 'Reload categories'),
					'add_new_item' => __( 'Add categories'),
					'new_item_name' => __( 'New name categories')
                    ),
                    'show_ui' => true,
                    'query_var' => true,					
                    'rewrite' => array( 'slug' => "library_category", 'with_front' => false, 'hierarchical' => true ), 
            )
    );	


    
	
}

add_action('admin_init', 'library_add_metabox');
add_action('save_post', 'library_save_extras');
function library_save_extras(){
    global $post;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
        return $post->ID;
    }    
    $cur_terms=get_the_terms($post->ID, APP_LIBRARY_CAT); 
    $i=0;
    foreach($cur_terms as $cur_term){ 
	$i++;
	if($i==1) $mbcur_term=$cur_term->name;	
    }    
    $cur_terms=get_the_terms($post->ID, APP_LIBRARY_CAT); 
    $i=0;
    foreach($cur_terms as $cur_term){ 
	$i++;
	if($i==1) $mbcur_term=$cur_term->name;	
    }
    switch ($mbcur_term) {
	case "Artikel":				
	
	break;
	case "Publikationen":
		update_post_meta_array($post, array( 'library_authors', 'library_price'));		
	break;
	case "Video":		
		update_post_meta_array($post, array( 'library_video'));		
	break;
	case "Audio":
		update_post_meta_array($post, array( 'library_audio'));		
	break;	
	case "Bilder":
		update_post_meta_array($post, array( 'library_ammount_photo','library_photo_link'));		
	break;
	case "Downloads":		
		update_post_meta_array($post, array( 'library_download'));		
	break;
    }
}

function library_add_metabox() {
    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    $cur_terms=get_the_terms($post_id, APP_LIBRARY_CAT); 
    $i=0;
    foreach($cur_terms as $cur_term){ 
	$i++;
	if($i==1) $mbcur_term=$cur_term->name;	
    }
    switch ($mbcur_term) {
	case "Artikel":				
	
	break;
	case "Publikationen":
		add_meta_box('library_authors', 'Authors', 'basil_text_meta', APP_LIBRARY_TYPE, 'normal', 'default');		
		add_meta_box('library_price', 'Price', 'basil_text_meta', APP_LIBRARY_TYPE, 'normal', 'default');		
	break;
	case "Video":		
		add_meta_box('library_video', 'Youtube code', 'basil_textarea_meta', APP_LIBRARY_TYPE, 'normal', 'default');		
	break;
	case "Audio":
		add_meta_box('library_audio', 'Audio llink', 'basil_text_meta', APP_LIBRARY_TYPE, 'normal', 'default');		
	break;	
	case "Bilder":
		add_meta_box('library_ammount_photo', 'Amount of photos', 'basil_text_meta', APP_LIBRARY_TYPE, 'normal', 'default');		
		add_meta_box('library_photo_link', 'Link to the flickr account', 'basil_text_meta', APP_LIBRARY_TYPE, 'normal', 'default');		
	break;
	case "Downloads":		
		add_meta_box('library_download', 'Link to the file', 'basil_text_meta', APP_LIBRARY_TYPE, 'normal', 'default');	
	break;
    } 	
}



add_action('admin_init', 'school_add_metabox');
add_action('save_post', 'school_save_extras');
function school_save_extras(){
    global $post;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
        return $post->ID;
    }
    $template_file = get_post_meta($post->ID,'_wp_page_template',TRUE);
	// check for a template type
    if ($template_file == 'austrian-school-page.php') {
	update_post_meta_array($post, array( 'school_name', 'school_year', 'school_about'));
    }    
}

function school_add_metabox() {
	$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
	$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);
	// check for a template type
	if ($template_file == 'austrian-school-page.php') {
		add_meta_box('school_name', 'Name', 'basil_text_meta', 'page', 'normal', 'default');		
		add_meta_box('school_year', 'Years', 'basil_text_meta', 'page', 'normal', 'default');		
		add_meta_box('school_about', 'About(html)', 'basil_text_meta', 'page', 'normal', 'default');
	}    	
}





add_action('admin_init', 'ip_add_metabox');
add_action('save_post', 'ip_save_extras');
function ip_save_extras(){
    global $post;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
        return $post->ID;
    }
    update_post_meta_array($post, array( 'ip_position', 'ip_town', 'ip_email'));
}

function ip_add_metabox() {		
    add_meta_box('ip_position', 'Position', 'basil_text_meta', APP_INST_PEOPLE_TYPE, 'normal', 'default');
    add_meta_box('ip_town', 'Town', 'basil_text_meta', APP_INST_PEOPLE_TYPE, 'normal', 'default');		
	add_meta_box('ip_email', 'E-mail', 'basil_text_meta', APP_INST_PEOPLE_TYPE, 'normal', 'default');
}

add_action('admin_init', 'events_add_metabox');
add_action('save_post', 'events_save_extras');
function events_save_extras(){
    global $post;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
        return $post->ID;
    }
    update_post_meta_array($post, array( 'events_date', 'events_time',  'events_address', 'events_kontakt'));
}

function events_add_metabox() {		
    add_meta_box('events_date', 'Events date', 'basil_text_meta', APP_EVENTS_TYPE, 'normal', 'default');
    add_meta_box('events_time', 'Events time', 'basil_text_meta', APP_EVENTS_TYPE, 'normal', 'default');
    add_meta_box('events_address', 'Events address', 'basil_text_meta', APP_EVENTS_TYPE, 'normal', 'default');			
    add_meta_box('events_kontakt', 'Events kontakt', 'basil_textarea_meta', APP_EVENTS_TYPE, 'normal', 'default');			
}
/*
add_action('admin_init', 'dir_add_metabox');
add_action('save_post', 'dir_save_extras');

add_action('admin_init', 'np_add_metabox');
add_action('save_post', 'np_save_extras');

function ads_save_extras(){
    global $post;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
        return $post->ID;
    }
    update_post_meta_array($post, array( 'ads_fio', 'ads_tel', 'ads_email', 'ads_cena','ads_img'));
}

function ads_add_metabox() {		
    add_meta_box('ads_fio', 'Ф.И.О.', 'basil_text_meta', APP_POST_TYPE, 'normal', 'default');
    add_meta_box('ads_tel', 'Телефоны', 'basil_text_meta', APP_POST_TYPE, 'normal', 'default');		
	add_meta_box('ads_email', 'Электронная почта', 'basil_text_meta', APP_POST_TYPE, 'normal', 'default');
	add_meta_box('ads_cena', 'Цена', 'basil_text_meta', APP_POST_TYPE, 'normal', 'default');
	add_meta_box('ads_img', 'Фото', 'basil_text_meta', APP_POST_TYPE, 'normal', 'default');
}

function dir_save_extras(){
    global $post;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
        return $post->ID;
    }
    update_post_meta_array($post, array( 'dir_adr', 'dir_tel', 'dir_img', 'dir_email'));
}

function dir_add_metabox() {		
    add_meta_box('dir_adr', 'Адресс', 'basil_text_meta', DIR_POST_TYPE, 'normal', 'default');
    add_meta_box('dir_tel', 'Телефоны', 'basil_text_meta', DIR_POST_TYPE, 'normal', 'default');		
	add_meta_box('dir_img', 'Логотип', 'basil_text_meta', DIR_POST_TYPE, 'normal', 'default');	
	add_meta_box('dir_email', 'Email', 'basil_text_meta', DIR_POST_TYPE, 'normal', 'default');	
}

function np_save_extras(){
    global $post;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
        return $post->ID;
    }
    update_post_meta_array($post, array( 'np_url'));
}

function np_add_metabox() {		
    add_meta_box('np_url', 'Путь к электронной версии', 'basil_text_meta', NP_POST_TYPE, 'normal', 'default');    
}
*/
?>