<?php session_start(); ?>
﻿
<form id="add-comment" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" enctype='multipart/form-data'>
<a class="close_form"></a>
							<label>Добавить отзыв</label><br>
							<div>
					<input type="text" name="name" placeholder="Ваше имя">
					<input type="text" name="email" placeholder="Электронная почта">
								<!-- br -->
								<input name="tel" class="response-top1" type="text" placeholder="Телефон">
								<input name="order" type="text" placeholder="№ договора">
								<input name="age" class="response-top1" type="text" placeholder="Возраст">
								<input name="town" type="text" placeholder="Город">
								<!-- br -->
								<input name="soc" type="text" placeholder="Ссылка в социальной сети">
							</div>
							<input type="text" name="title" placeholder="Название">
							<textarea name="response" placeholder="Ваш отзыв о нас"></textarea>
							<aside>
<div class="file_upload">
        <button type="button">Выбрать фото</button>
        <div>Файл не выбран</div>
        <input name="foto1" type="file">
    </div>
  
	<!-- img src="<?php echo get_template_directory_uri(); ?>/images/checking.png" alt="" -->
<img src="<?php echo get_template_directory_uri().'/inc/captcha/securimage_show.php'; ?>" alt="">

								<img src="<?php echo get_template_directory_uri(); ?>/images/update.png" onclick="this.blur()" alt="">
								<input name ="captcha_code" type="text" placeholder="Введите код">
								<input type="submit" value="Отправить отзыв">
								<input type="hidden" name="submit_response" value="send">
							</aside>
							
					</form>
				