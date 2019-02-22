<?php
require "dtabase/db.php";
?>

<?php if(isset($_SESSION['remb_user'])){ ?>
	Авторизован!<br>
	<hr>
	<a href="./logout.php">Выйти</a>
<?php }else{ ?>
<div style="color: red;">Вы не авторизованы!</div><hr>
<a href="./login.php">Авторизация</a><br>
<a href="./signup.php">Регистрация</a>
<?php }; ?>