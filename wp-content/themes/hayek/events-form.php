<?php 
$themename_forms = "Form Events";

function mytheme_add_admin_forms(){
        
        global $themename_forms, $shortname, $options;
/*		
        if($_GET['page'] == basename(__FILE__) ){
            
            if( 'save' == $_REQUEST['action']){
                foreach ($options as $value){
                    update_option($value['id'], $_REQUEST[$value['id']]);
                }

                foreach ($options as $value){
                    if( isset ($_REQUEST[$value['id']]) ){
                        update_option($value['id'], $_REQUEST[$value['id']] );
                    }else{
                        delete_option($value['id']);
                    }
                }
                header("Location: admin.php?page=events-form.php&saved=true");
                die;
            }
        }
*/

         add_menu_page($themename_forms, $themename_forms, 'administrator', basename(__FILE__), 'mytheme_admin_forms');
    }

function mytheme_add_init_forms() {

$file_dir=get_bloginfo('template_directory');
// wp_enqueue_style("functions", $file_dir."/functions/functions.css", false, "1.0", "all");
// wp_enqueue_script("rm_script", $file_dir."/functions/rm_script.js", false, "1.0");

}
function mytheme_admin_forms() {
 
global $themename_forms, $shortname, $options;
$i=0;
 
// if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>Design-Einstellungen gespeichert</strong></p></div>';
// if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>Theme Einstellungen zurücksetzen</strong></p></div>';
 $order_forms = ($_POST['select_forms']) ? $_POST['select_forms'] : 'wählen';

?>
<script>
jQuery(document).ready(function(){
	jQuery("#order_forms select.customSelect [value='<?php echo $order_forms; ?>']").attr("selected", "selected");
})
</script>
<div class="wrap rm_wrap">
	<h2>Form events</h2> 
	<div class="rm_opts">

                        <div class="custom-select" style="margin-bottom: 20px;">
                            <label>Sortierung:</label>
			    <form method="post" id="order_forms" action="">
				<label style="margin-top: 7px; width: 120px;">Generate xlsx? <input name="xls" type="checkbox" value="yes" /></label>
				<select name="select_forms" class="customSelect" style="margin-top: -4px;">
					<option value="wählen">wählen</option>
					<option value="Contact form">Contact form</option>
					<option value="Downloads">Downloads</option>
					<option value="Mitgliedschaft">Mitgliedschaft</option>
					<option value="Publikationen">Publikationen</option>
					<option value="Unterstutzen">Unterstutzen</option>
					<option value="Veranstaltung">Veranstaltung</option>				
				</select>				
				<input name="go" type="submit" value="ok" />
			    </form>
                        </div>
			<?php 
			
			$query_array=array(
				'post_type' => APP_FORM_TYPE,
				'post_status' => 'private',															
				'posts_per_page' => -1,
				APP_FORM_CAT => $order_forms
			);
			if(!isset($_POST['xls']))
			{
				switch ($order_forms) {
					case "wählen":	
			
					break;
					case "Downloads": //Downloads
			 ?>
			 <table  width="100%" cellspacing="0" border="1">
				<tr>
				    <th>Datum</th>				    
				    <th>Name</th>
				    <th>E-Mail Adresse </th>
				    <th>File</th>
				</tr>		
			<?php			 
						query_posts($query_array);				
						while (have_posts()) : the_post();
			?>			
				<tr>
				    <td><?php echo get_the_date('d.m.Y | g:i'); ?></td>				    
				    <?php the_content(); ?>
				</tr>								
			<?php		
						endwhile; 						
						wp_reset_query();
			 ?>
			 </table>	
			<?php			 
					break;	
					case "Contact form": // Contact form
			 ?>
			 <table  width="100%" cellspacing="0" border="1">
				<tr>
				    <th>Datum</th>				    
				    <th>Name</th>
				    <th>E-Mail Adresse </th>
				    <th>Organisation</th>
				    <th>Betreff</th>
				    <th>Nachricht</th>
				</tr>		
			<?php			 
						query_posts($query_array);				
						while (have_posts()) : the_post();
			?>			
				<tr>
				    <td><?php echo get_the_date('d.m.Y | g:i'); ?></td>				    
				    <?php the_content(); ?>
				</tr>								
			<?php		
						endwhile; 						
						wp_reset_query();
			 ?>
			 </table>	
			<?php			 
					break;	
					case "Unterstutzen": // institut_donation
			 ?>
			 <table  width="100%" cellspacing="0" border="1">
				<tr>
				    <th rowspan="2">Datum</th>				    
				    <th colspan="5">Personliche Daten</th>
				    <th colspan="5">Adresse</th>
				    <th colspan="5">Rechnungsadresse</th>
				    <th colspan="3">Kontakt</th>
				    <th colspan="11">Fordermoglichkeiten</th>
				</tr>		
				<tr>
				    <th>Anrede</th>
				    <th>Title</th>
				    <th>Vorname</th>
				    <th>Nachname</th>
				    <th>Organisation</th>				    
				    
				    <th>Straße / Hausnr</th>
				    <th>Adresszusatz</th>
				    <th>PLZ</th>
				    <th>Ort</th>
				    <th>Land</th>
				    
				    <th>Straße / Hausnr</th>
				    <th>Adresszusatz</th>
				    <th>PLZ</th>
				    <th>Ort</th>
				    <th>Land</th>
				    
				    <th>E-Mail Adresse</th>
				    <th>Telefonnummer</th>
				    <th>URL</th>				    
				    
				    <th>Buch-Förderung klein</th>
				    <th>Buch-Förderung komplett</th>
				    <th>Buch-Förderung</th>
				    <th>Pensions-Paket grob</th>
				    <th>Teil-Paket-Förderung</th>
				    <th>Workshop-Förderung</th>
				    <th>Auf Rechnung</th>
				    <th>PayPall</th>
				    <th>Newsletter</th>
				    <th>Artikel</th>
				    <th>Summe</th>				    
				</tr>
			<?php			 
						query_posts($query_array);				
						while (have_posts()) : the_post();
			?>			
				<tr>
				    <td><?php echo get_the_date('d.m.Y | g:i'); ?></td>				    
				    <?php the_content(); ?>
				</tr>								
			<?php		
						endwhile; 						
						wp_reset_query();
			 ?>
			 </table>	
			<?php			 
					break;	
					case "Publikationen": // institut_library_order
			 ?>
			 <table  width="100%" cellspacing="0" border="1">
				<tr>
				    <th rowspan="2">Datum</th>				    
				    <th colspan="5">Personliche Daten</th>
				    <th colspan="5">Lieferadresse</th>
				    <th colspan="5">Rechnungsadresse</th>
				    <th colspan="3">Kontakt</th>
				    <th colspan="5">Zahlungsoptionen</th>
				</tr>		
				<tr>
				    <th>Anrede</th>
				    <th>Title</th>
				    <th>Vorname</th>
				    <th>Nachname</th>
				    <th>Organisation</th>				    
				    
				    <th>Straße / Hausnr</th>
				    <th>Adresszusatz</th>
				    <th>PLZ</th>
				    <th>Ort</th>
				    <th>Land</th>
				    
				    <th>Straße / Hausnr</th>
				    <th>Adresszusatz</th>
				    <th>PLZ</th>
				    <th>Ort</th>
				    <th>Land</th>
				    
				    <th>E-Mail Adresse</th>
				    <th>Telefonnummer</th>
				    <th>URL</th>				    
				    
				    <th>Auf Rechnung</th>				    
				    <th>PayPall</th>
				    <th>Newsletter</th>
				    <th>Artikel</th>
				    <th>Summe</th>				    
				</tr>
			<?php			 
						query_posts($query_array);				
						while (have_posts()) : the_post();
			?>			
				<tr>
				    <td><?php echo get_the_date('d.m.Y | g:i'); ?></td>				    
				    <?php the_content(); ?>
				</tr>								
			<?php		
						endwhile; 						
						wp_reset_query();
			 ?>
			 </table>	
			<?php			 
					break;		
					case "Mitgliedschaft": // institut_membership
			 ?>
			 <table  width="100%" cellspacing="0" border="1">
				<tr>
				    <th rowspan="2">Datum</th>				    
				    <th colspan="5">Personliche Daten</th>
				    <th colspan="5">Adresse</th>				    
				    <th colspan="3">Kontakt</th>
				    <th colspan="4">Art der Mitgliedschaft</th>
				</tr>		
				<tr>
				    <th>Anrede</th>
				    <th>Title</th>
				    <th>Vorname</th>
				    <th>Nachname</th>
				    <th>Organisation</th>				    
				    
				    <th>Straße / Hausnr</th>
				    <th>Adresszusatz</th>
				    <th>PLZ</th>
				    <th>Ort</th>
				    <th>Land</th>
				    
				    <th>E-Mail Adresse</th>
				    <th>Telefonnummer</th>
				    <th>URL</th>				    
				    
				    <th>Förder-Mitgliedschaft</th>				    
				    <th>Reguläre Mitgliedschaft</th>
				    <th>Ermäßigte Mitgliedschaft für StudentInnen</th>
				    <th>Newsletter</th>				    
				</tr>
			<?php			 
						query_posts($query_array);				
						while (have_posts()) : the_post();
			?>			
				<tr>
				    <td><?php echo get_the_date('d.m.Y | g:i'); ?></td>				    
				    <?php the_content(); ?>
				</tr>								
			<?php		
						endwhile; 						
						wp_reset_query();
			 ?>
			 </table>	
			<?php			 
					break;		
					case "Veranstaltung": // institut_reg_event
			 ?>
			 <table  width="100%" cellspacing="0" border="1">	
				<tr>
				    <th>Datum</th>	
				    <th>Vorname</th>
				    <th>Nachname</th>
				    <th>E-Mail Adresse</th>
				    <th>Organisation</th>
				    <th>Newsletter</th>
				    <th>Mitglied</th>				    
				    <th>Events date</th>
				    <th>Events title</th>				    
				</tr>
			<?php			 
						query_posts($query_array);				
						while (have_posts()) : the_post();
			?>			
				<tr>
				    <td><?php echo get_the_date('d.m.Y | g:i'); ?></td>				    
				    <?php the_content(); ?>
				</tr>								
			<?php		
						endwhile; 						
						wp_reset_query();
			 ?>
			 </table>	
			<?php			 
					break;						
				}
			}				
			else
			{
				require_once get_template_directory().'/functions/inc/excel/PHPExcel.php';
				$objPHPExcel = new PHPExcel();
				PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);
 
				// Set document properties
				 
				$objPHPExcel->getProperties()->setCreator("hayek")
				    ->setLastModifiedBy("hayek")
				    ->setTitle("hayek")
				    ->setSubject("hayek")
				    ->setDescription("hayek")
				    ->setKeywords("hayek")
				    ->setCategory("hayek");
				switch ($order_forms) {		
					case "Downloads": //Downloads
						$objPHPExcel->getActiveSheet()->fromArray(array('Datum', 'Name','E-Mail Adresse','File'), NULL, 'A1'); // A1 - ячейка с которой начинаем вставку
						$row = $objPHPExcel->getActiveSheet()->getHighestRow()+1;												
						query_posts($query_array);				
						while (have_posts()) : the_post();
						    $col = 0;						    
						    $str_cont=get_the_content();
						    $str_cont=str_replace ( "</td><td>" , "<td>" , $str_cont );
						    $str_cont=str_replace ( "</td>" , "" , $str_cont );
						    $val_array = explode("<td>", $str_cont);
						    
						    foreach($val_array as $value) {
							 $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, trim($value));							
							$col++;
						    }
						    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, get_the_date('d.m.Y | g:i'));
						    $row++;

						endwhile; 						
						wp_reset_query();

						$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
						$objWriter->save('Downloads.xlsx');
						echo "<a href='/wp-admin/Downloads.xlsx'>Downloads.xlsx</a>";		 
					break;	
					case "Contact form": // Contact form
					
						$objPHPExcel->getActiveSheet()->fromArray(array('Datum', 'Name','E-Mail Adresse','Organisation','Betreff','Nachricht'), NULL, 'A1'); // A1 - ячейка с которой начинаем вставку
						$row = $objPHPExcel->getActiveSheet()->getHighestRow()+1;												
						query_posts($query_array);				
						while (have_posts()) : the_post();
						    $col = 0;						    
						    $str_cont=get_the_content();
						    $str_cont=str_replace ( "</td><td>" , "<td>" , $str_cont );
						    $str_cont=str_replace ( "</td>" , "" , $str_cont );
						    $val_array = explode("<td>", $str_cont);
						    
						    foreach($val_array as $value) {
							 $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, trim($value));							
							$col++;
						    }
						    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, get_the_date('d.m.Y | g:i'));
						    $row++;

						endwhile; 						
						wp_reset_query();

						$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
						$objWriter->save('Contact_form.xlsx');
						echo "<a href='/wp-admin/Contact_form.xlsx'>Contact_form.xlsx</a>";					
	 
					break;	
					case "Unterstutzen": // institut_donation					
						$objPHPExcel->getActiveSheet()->mergeCells('A1:A2');
						$objPHPExcel->getActiveSheet()->mergeCells('B1:F1');
						$objPHPExcel->getActiveSheet()->mergeCells('G1:K1');
						$objPHPExcel->getActiveSheet()->mergeCells('L1:P1');
						$objPHPExcel->getActiveSheet()->mergeCells('Q1:S1');
						$objPHPExcel->getActiveSheet()->mergeCells('T1:AD1');
						$objPHPExcel->getActiveSheet()->fromArray(array('Datum', 'Personliche Daten'), NULL, 'A1');
						$objPHPExcel->getActiveSheet()->fromArray(array('Adresse'), NULL, 'G1');
						$objPHPExcel->getActiveSheet()->fromArray(array('Rechnungsadresse'), NULL, 'L1');
						$objPHPExcel->getActiveSheet()->fromArray(array('Kontakt'), NULL, 'Q1');
						$objPHPExcel->getActiveSheet()->fromArray(array('Fordermoglichkeiten'), NULL, 'T1');
						$objPHPExcel->getActiveSheet()->fromArray(array('Anrede', 'Title','Adresse','Vorname','Nachname','Organisation','Straße / Hausnr',
						'Adresszusatz','PLZ','Ort','Land','Straße / Hausnr','Adresszusatz','PLZ','Ort','Land','E-Mail Adresse','Telefonnummer',
						'URL','Buch-Förderung klein','Buch-Förderung komplett','Buch-Förderung','Pensions-Paket grob','Teil-Paket-Förderung',
						'Workshop-Förderung','Auf Rechnung','PayPall','Newsletter','Artikel','Summe'), NULL, 'B2');
						$row = $objPHPExcel->getActiveSheet()->getHighestRow()+1;												
						query_posts($query_array);				
						while (have_posts()) : the_post();
						    $col = 0;						    
						    $str_cont=get_the_content();
						    $str_cont=str_replace ( "</td><td>" , "<td>" , $str_cont );
						    $str_cont=str_replace ( "</td>" , "" , $str_cont );
						    $val_array = explode("<td>", $str_cont);
						    
						    foreach($val_array as $value) {
							 $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, trim($value));							
							$col++;
						    }
						    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, get_the_date('d.m.Y | g:i'));
						    $row++;

						endwhile; 						
						wp_reset_query();

						$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
						$objWriter->save('Unterstutzen.xlsx');
						echo "<a href='/wp-admin/Unterstutzen.xlsx'>Unterstutzen.xlsx</a>";		 
					break;	
					case "Publikationen": // institut_library_order
						$objPHPExcel->getActiveSheet()->mergeCells('A1:A2');
						$objPHPExcel->getActiveSheet()->mergeCells('B1:F1');
						$objPHPExcel->getActiveSheet()->mergeCells('G1:K1');
						$objPHPExcel->getActiveSheet()->mergeCells('L1:P1');
						$objPHPExcel->getActiveSheet()->mergeCells('Q1:S1');
						$objPHPExcel->getActiveSheet()->mergeCells('T1:X1');
						$objPHPExcel->getActiveSheet()->fromArray(array('Datum', 'Personliche Daten'), NULL, 'A1');
						$objPHPExcel->getActiveSheet()->fromArray(array('Lieferadresse'), NULL, 'G1');
						$objPHPExcel->getActiveSheet()->fromArray(array('Rechnungsadresse'), NULL, 'L1');
						$objPHPExcel->getActiveSheet()->fromArray(array('Kontakt'), NULL, 'Q1');
						$objPHPExcel->getActiveSheet()->fromArray(array('Zahlungsoptionen'), NULL, 'T1');
						$objPHPExcel->getActiveSheet()->fromArray(array('Anrede', 'Title','Vorname','Nachname','Organisation','Straße / Hausnr',
						'Adresszusatz','PLZ','Ort','Land','Straße / Hausnr','Adresszusatz','PLZ','Ort','Land','E-Mail Adresse','Telefonnummer',
						'URL','Auf Rechnung','PayPall','Newsletter','Artikel','Summe'), NULL, 'B2');
						$row = $objPHPExcel->getActiveSheet()->getHighestRow()+1;												
						query_posts($query_array);				
						while (have_posts()) : the_post();
						    $col = 0;						    
						    $str_cont=get_the_content();
						    $str_cont=str_replace ( "</td><td>" , "<td>" , $str_cont );
						    $str_cont=str_replace ( "</td>" , "" , $str_cont );
						    $val_array = explode("<td>", $str_cont);
						    
						    foreach($val_array as $value) {
							 $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, trim($value));							
							$col++;
						    }
						    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, get_the_date('d.m.Y | g:i'));
						    $row++;

						endwhile; 						
						wp_reset_query();

						$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
						$objWriter->save('Publikationen.xlsx');
						echo "<a href='/wp-admin/Publikationen.xlsx'>Publikationen.xlsx</a>";					
		 
					break;		
					case "Mitgliedschaft": // institut_membership
						$objPHPExcel->getActiveSheet()->mergeCells('A1:A2');
						$objPHPExcel->getActiveSheet()->mergeCells('B1:F1');
						$objPHPExcel->getActiveSheet()->mergeCells('G1:K1');						
						$objPHPExcel->getActiveSheet()->mergeCells('L1:N1');
						$objPHPExcel->getActiveSheet()->mergeCells('O1:R1');

						$objPHPExcel->getActiveSheet()->fromArray(array('Datum', 'Personliche Daten'), NULL, 'A1');
						$objPHPExcel->getActiveSheet()->fromArray(array('Adresse'), NULL, 'G1');
						$objPHPExcel->getActiveSheet()->fromArray(array('Kontakt'), NULL, 'L1');
						$objPHPExcel->getActiveSheet()->fromArray(array('Art der Mitgliedschaft'), NULL, 'O1');						

						$objPHPExcel->getActiveSheet()->fromArray(array('Anrede', 'Title','Vorname','Nachname','Organisation','Straße / Hausnr',
						'Adresszusatz','PLZ','Ort','Land','E-Mail Adresse','Telefonnummer','URL','Förder-Mitgliedschaft','Reguläre Mitgliedschaft','Ermäßigte Mitgliedschaft für StudentInnen','Newsletter'), NULL, 'B2');
						$row = $objPHPExcel->getActiveSheet()->getHighestRow()+1;												
						query_posts($query_array);				
						while (have_posts()) : the_post();
						    $col = 0;						    
						    $str_cont=get_the_content();
						    $str_cont=str_replace ( "</td><td>" , "<td>" , $str_cont );
						    $str_cont=str_replace ( "</td>" , "" , $str_cont );
						    $val_array = explode("<td>", $str_cont);
						    
						    foreach($val_array as $value) {
							 $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, trim($value));							
							$col++;
						    }
						    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, get_the_date('d.m.Y | g:i'));
						    $row++;

						endwhile; 						
						wp_reset_query();

						$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
						$objWriter->save('Mitgliedschaft.xlsx');
						echo "<a href='/wp-admin/Mitgliedschaft.xlsx'>Mitgliedschaft.xlsx</a>";							 
					break;		
					case "Veranstaltung": // institut_reg_event
						$objPHPExcel->getActiveSheet()->fromArray(array('Datum', 'Vorname','Nachname','E-Mail Adresse','Organisation',
						'Newsletter','Mitglied','Events date','Events title'), NULL, 'A1'); // A1 - ячейка с которой начинаем вставку
						$row = $objPHPExcel->getActiveSheet()->getHighestRow()+1;												
						query_posts($query_array);				
						while (have_posts()) : the_post();
						    $col = 0;						    
						    $str_cont=get_the_content();
						    $str_cont=str_replace ( "</td><td>" , "<td>" , $str_cont );
						    $str_cont=str_replace ( "</td>" , "" , $str_cont );
						    $val_array = explode("<td>", $str_cont);
						    
						    foreach($val_array as $value) {
							 $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, trim($value));							
							$col++;
						    }
						    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, get_the_date('d.m.Y | g:i'));
						    $row++;

						endwhile; 						
						wp_reset_query();

						$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
						$objWriter->save('Veranstaltung.xlsx');
						echo "<a href='/wp-admin/Veranstaltung.xlsx'>Veranstaltung.xlsx</a>";							 
					break;						
				}
			}
			?>			
			</table>


	</div>
 </div> 
 

<?php
}
?>
<?php
add_action('admin_init', 'mytheme_add_init_forms');
add_action('admin_menu', 'mytheme_add_admin_forms');
?>