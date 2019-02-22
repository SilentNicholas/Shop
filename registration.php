<?php
require "dtabase/db.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" href="bootstrap/css/bootstrap.min.css">
	<style>
		body {
			background-image: url("./vegetables.jpg");
		}
	</style>
	</head>
<body>
<div class="jumbotron container" align="center">
	<?php if(isset($_SESSION['remb_user'])){ ?>
	<h1 class="display-4">Вы авторизованы!</h1>
	<a class="btn btn-primary btn-lg" href="./logout.php"" role="button">Выход</a>
	<?php }else{ ?>
  <h1 class="display-4">Вы не авторизованы!</h1>
  <p class="lead">Мы рады приветствовать вас на нашем сайте!</p>
  <hr class="my-4">
  <p>Для дальнейшей работы на сайте просьба выбрать действие:</p>
  <a class="btn btn-primary btn-lg" href="./login.php"" role="button">Авторизация</a>
  <a class="btn btn-primary btn-lg" href="./signup.php"" role="button">Регистрация</a>
  <?php }; ?>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>