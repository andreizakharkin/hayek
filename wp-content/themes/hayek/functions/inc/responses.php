<?php 

include_once (get_template_directory() . '/inc/captcha/securimage.php');

$securimage = new Securimage();

if($_POST['submit_response']&&$securimage->check($_POST['captcha_code']) == true)	{
	$my_post = array(
	'post_title'  	=> $_POST['title'],
	'post_content'  => $_POST['response'],
	'post_status'   => 'pending',
	'post_type'   	=> 'responses'
);
$pid = wp_insert_post($my_post);
add_post_meta($pid, 'responses_client_name', $_POST['name']);
add_post_meta($pid, 'responses_client_email', $_POST['email']);
add_post_meta($pid, 'responses_client_tel', $_POST['tel']);
add_post_meta($pid, 'responses_contract_number', $_POST['order']);
add_post_meta($pid, 'responses_client_age', $_POST['age']);
add_post_meta($pid, 'responses_client_town', $_POST['town']);
add_post_meta($pid, 'responses_soc_link', $_POST['soc']);

$file1 = $_FILES['foto1']['tmp_name'];
$filename1 = $_FILES['foto1']['name'];
if(!empty($file1))
{ 
  $type1 = strtolower(substr($filename1, 1+strrpos($filename1,".")));
  $new_name1 = 'file-'.md5(rand(111111, 999999)).'.'.$type1;  
$upload_dir = wp_upload_dir();
if(wp_mkdir_p($upload_dir['path']))
    $file = $upload_dir['path'] . '/' . $new_name1;
else
    $file = $upload_dir['basedir'] . '/' . $new_name1;


  if (copy($file1, $file))
    { 
	$attachment = array(
	'post_mime_type' => 'image/jpeg',
	'guid' => $file,
	'post_parent' => $pid,
	'post_title' => preg_replace('/\.[^.]+$/', '', $_POST['title']),
	'post_content' => 'file: '.$file.' url:'.$file
	);

	$id = wp_insert_attachment($attachment,$file, $pid);
	require_once(ABSPATH . 'wp-admin/includes/image.php');
	wp_update_attachment_metadata($id, wp_generate_attachment_metadata($id, $file));
	set_post_thumbnail( $pid, $id );
    }	
}

}
?>
			<article  class="response">
				<section>
<?php	
	global $wpdb; 
	$mbsqlstr =" from $wpdb->posts p where p.post_type = 'responses' AND p.post_status = 'publish'";
	$post_kol =$wpdb->get_var("select count(ID) ".$mbsqlstr);
	$post_kol =ceil($post_kol/5); 
	if (!empty($_GET["pgd"])) {$pgd =$_GET["pgd"];  } else {$pgd =1; }
	$cur= $pgd;
?>

					<h1>Отзывы</h1>	
					<?php wp_reset_query(); query_posts('post_type=responses&posts_per_page=2&post_status=publish&orderby=date&offset=0'); ?>
					<?php while(have_posts()): the_post(); ?>	
						<article>
						<!--<img src="images/photo.png" alt="">-->
						<div>
							<!--<h3>Страшный заголовок</h3>-->
<?php $topimg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');?>
<?php if($topimg) { ?>
<img class="alignleft" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo $topimg[0]; ?>&amp;h=127&amp;w=127&amp;zc=1" alt="<?php bloginfo('name'); ?>">
<?php } ?>
							<?php the_content(); ?>
							<p><a href="http://<?php echo get_post_meta($post->ID, 'responses_soc_link', true); ?>"><?php echo get_post_meta($post->ID, 'responses_client_name', true); ?></a>, <?php echo get_post_meta($post->ID, 'responses_client_age', true); ?> лет, г. <?php echo get_post_meta($post->ID, 'responses_client_town', true); ?></p>
						</div>
						</article>
						<?php endwhile; wp_reset_query(); ?>
					<div id="expanderContentResp" style="display:none">	
				
					<?php query_posts('post_type=responses&post_status=publish&orderby=date&posts_per_page=3&offset=2'); ?>
					<?php while(have_posts()): the_post(); ?>	
						<article>
						<!--<img src="images/photo.png" alt="">-->
						<div>
							<!--<h3>Страшный заголовок</h3>-->
<?php $topimg = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');?>
<?php if($topimg) { ?>
<img class="alignleft" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo $topimg[0]; ?>&amp;h=127&amp;w=127&amp;zc=1" alt="<?php bloginfo('name'); ?>">
<?php } ?>
							<?php the_content(); ?>
							<p><a href="http://<?php echo get_post_meta($post->ID, 'responses_soc_link', true); ?>"><?php echo get_post_meta($post->ID, 'responses_client_name', true); ?></a>, <?php echo get_post_meta($post->ID, 'responses_client_age', true); ?> лет, г. <?php echo get_post_meta($post->ID, 'responses_client_town', true); ?></p>
						</div>
						</article>
						<?php endwhile; ?>
						<div style="clear: both;"></div>

<div class="pagenavi">
<?php
	if ($pgd>1) 
	{
?>
	<a class="prev page-numbers" href="<?php echo ($pgd-1); ?>">Предыдущая</a>
<?php
	}
	for($i=1;$i<=$post_kol; $i++)
	{
		if($i==$pgd)
		{
?>
	<span class="page-numbers current"><?php echo ($i); ?></span>
<?php
		}
		else
		{		
?>
	<a class="page-numbers" href="<?php echo ($i); ?>"><?php echo ($i); ?></a>
<?php
		}
	}
?>
	
<?php
	if ($pgd<$post_kol) 
	{
?>
	<a class="next page-numbers" href="<?php echo ($pgd+1); ?>">Следующая</a>
<?php
	}
?>
</div>
<a href="#" class="comment">оставить отзыв</a>

						</div>
						<p><a id="expanderResp" style="cursor:pointer;">Читать все отзывы</a></p>
						<?php include(get_template_directory().'/inc/response-form.php'); ?>
						<?php wp_reset_query(); ?>
				</section>
			</article>						