<?php
 get_header(); 

?>
<?php 	if(isset($_POST['formid'])) { 
		$formid=$_POST['formid'];
		if(trim($_POST['y-name'.$formid]) === '') { 
			$nameError = 'Please enter your name'; 
			$hasError = true; 
		} else { 
		$name = trim($_POST['y-name'.$formid]); 
		}		
		
		if(trim($_POST['y-email'.$formid]) === '') { 
			$emailError = 'Please enter your email'; 
			$hasError = true; 
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['y-email'.$formid]))) { 
			$emailError = 'You have entered the wrong email'; 
			$hasError = true; 
		} else { 
			$email = trim($_POST['y-email'.$formid]); 
		}
		if(!isset($hasError)) { 
			$admin_email = get_option('nt_email'); 
			if (!isset($admin_email) || ($admin_email == '') ){ 
				$admin_email = get_option('admin_email'); 
			} 
			$subject = 'File from hayek institute '; 
			$body = "Your file as an attachment"; 
			$headers = 'From: hayek institute <'.$email.'>' . "\r\n" . 'Reply-To: ' . $admin_email; 
			$mail_attachment = array(decryptIt($_POST['dfile']));
			wp_mail($email, $subject, $body, $headers, $mail_attachment); 			
			$emailSent = true; 
		} 

	} 
	
	if(isset($emailSent) && $emailSent == true) { ?> 
	<script type="text/javascript">
		alert("File was sent to the specified Emai");
	</script>
<?php 	
	}
	if(isset($hasError)) {   ?>
	<script type="text/javascript">
		alert("Error <?php echo $emailError; echo $nameError; ?>");
	</script>
<?php 	}    ?>
            <div id="columnRight">
                <div class="navPanel">
                    <div id="filters">
                        <?php post_per_page(); ?>
                        <div class="custom-select">
                            <label>Sortierung:</label>
                            <select class="customSelect">
                                <option>Alle anzeigen</option>
                                <option>Artikel</option>
                                <option>Publikationen</option>
                                <option>Video</option>
                                <option>Audio</option>
                                <option>Bilder</option>
                                <option>Downloads</option>
                            </select>
                        </div>
                    </div>
                    <?php wp_corenavi(); ?>
                    <div class="clearfix"></div>
                </div>
                <div id="postList" class="blogList">
			<?php 					
			/*	query_posts( array(
					'post_type' => APP_LIBRARY_TYPE,
					'post_status' => 'publish',					
					'ignore_sticky_posts' => 1,
					'posts_per_page' => -1
				) );
			*/

			query_posts($my_query_string."&post_type=".APP_LIBRARY_TYPE);
			
				$form_id=0;
				while (have_posts()) : the_post();
					$thumb = catch_that_image();
					$cur_terms=get_the_terms($post->ID, APP_LIBRARY_CAT); 
					$form_id++;
					$i=0;
					foreach($cur_terms as $cur_term){ 
						$i++;
						if($i==1) $mbcur_term=$cur_term->name;	
					}
			?>	                    
		    
		    
		    

			<?php 
				switch ($mbcur_term) {
					case "Artikel":	
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
					break;
					case "Publikationen":
			?>
		<div class="item pubsingle">
                        <h2><?php the_title(); ?></h2>			
			<div class="thumb"><img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo $thumb; ?>&amp;h=180&amp;w=130&amp;zc=1"  alt="<?php the_title(); ?>" /></div>
			<div class="date"><b><?php echo get_post_meta($post->ID, 'library_authors', true); ?></b></div>
			<div class="date"><b>&euro; <?php echo get_post_meta($post->ID, 'library_price', true); ?>,-</b></div>
			<p><?php truncate_post(150); ?></p>
			<a class="btn" href="/library_order/">Zur Buchbestellung &gt;</a>
                        <div class="clearfix"></div>
                </div>			
			<?php			
					break;
					case "Video":		
			?>
		<div class="item">
                        <h2><?php the_title(); ?></h2>			
			<div class="thumb"><?php echo get_post_meta($post->ID, 'library_video', true); ?></div>
			<div class="date"><?php echo get_the_date('d.m.Y | g:i'); ?></div>
			<p><?php truncate_post(150); ?></p>
                        <div class="clearfix"></div>
                </div>				
			<?php	
					break;
					case "Audio":
			?>	
		<div class="item noThumb">
                        <h2><?php the_title(); ?></h2>						
			<div class="date"><?php echo get_the_date('d.m.Y | g:i'); ?></div>
                        <a href="<?php echo get_post_meta($post->ID, 'library_audio', true); ?>" class="btn">Anhoren &gt;</a>	
                        <div class="clearfix"></div>
                </div>				
			<?php	
					break;	
					case "Bilder":
			?>
		<div class="item">
                        <h2><?php the_title(); ?></h2>			
			<div class="thumb"><img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo $thumb; ?>&amp;h=161&amp;w=215&amp;zc=1"  alt="<?php the_title(); ?>" /></div>
			<div class="date"><?php echo get_post_meta($post->ID, 'library_ammount_photo', true); ?> Fotos / <?php echo get_the_date('d.m.Y | g:i'); ?></div>
			<a href="<?php echo get_post_meta($post->ID, 'library_photo_link', true); ?>" class="btn"><span>zur Galerie</span> &gt;</a>			
                        <div class="clearfix"></div>
                </div>			
			<?php
					break;
					case "Downloads":
						$fileName=get_post_meta($post->ID, 'library_download', true);;
			?>
		<div class="item">
                        <h2><?php the_title(); ?></h2>			
			<div class="thumb"><img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo $thumb; ?>&amp;h=161&amp;w=215&amp;zc=1"  alt="<?php the_title(); ?>" /></div>
			<div class="date">Filetyp: <?php echo substr(strrchr($fileName, '.'), 1); ?> (<?php echo round(((filesize(url2path($fileName))/1024)/1024),2); ?> MB) / <?php echo get_the_date('d.m.Y | g:i'); ?></div>
			<a href="#downloadFiles<?php echo $post->ID; ?>" class="btn downloadFiles">Herunterladen &gt;</a>

			<div class="popup" id="downloadFiles<?php echo $post->ID; ?>">
				<h1>Publikation anfordern</h1>
				<p>Anfordern der Publikation:"<?php the_title(); ?>".<br/>
				Diese wird Ihnen in Kurze per E-Mail zugesandt.<br/>
				Geben Sie dazu bitte Ihre E-Mail Adresse an.</p>
				<div class="formArea">
					<form action="" method="post">
						<div class="row">
							<div class="item">
								<label><span>Name*</span><input name="y-name<?php echo $form_id; ?>" type="text" /></label>
							</div>
							<div class="item">
								<label><span>E-Mail Adresse*</span><input name="y-email<?php echo $form_id; ?>" type="text" /></label>
							</div>
							<div class="clearfix"></div>	
						</div>
						<div class="row">
							<input type="hidden" name="formid" value="<?php echo $form_id; ?>" />
							<input type="hidden" name="dfile" value="<?php echo encryptIt(url2path($fileName)); ?>" />
							
							<input type="submit" class="btn" value="Absenden &gt;" />
							<div class="clearfix"></div>
						</div>
					</form>
				</div>
				<div class="clearfix"></div>
			</div>
                        <div class="clearfix"></div>
                </div>				
			<?php
					break;
				}							
				endwhile; 
				wp_reset_query();			
			?>	    
		    <input type="hidden" value="2" id="morepgd" name="morepgd">
                    <a href="" class="moreList desktopNone mobileNone">[...]</a>
                </div>
                <div class="navPanel mobileNone tabletNone">
                    <?php wp_corenavi(); ?>
                    <div class="clearfix"></div>
                </div>
            </div>

	<?php get_sidebar('left'); ?>		
<?php get_footer(); ?>