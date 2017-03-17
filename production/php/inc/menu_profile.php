<?php
ini_set('display_errors', 0);
?>
<div class="profile clearfix">
	<div class="profile_pic">
		<img src="images/img.png" alt="..." class="img-circle profile_img">
	</div>
	<div class="profile_info">
		<span>Bem vindo,</span>
		<h2><?php echo utf8_encode($_SESSION["nome"]);?></h2>
	</div>
</div>