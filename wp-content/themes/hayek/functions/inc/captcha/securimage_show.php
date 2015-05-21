<?php

include 'securimage.php';
$img = new securimage();
$img->num_lines = 0;
$img->image_width = 77;
$img->image_height = 39;
$img->charset = '0123456789';
$img->code_length = 4;
$img->show(); // alternate use:  $img->show('/path/to/background.jpg');

?>
