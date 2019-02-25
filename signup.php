
<?php
require "dtabase/db.php";
?>

<?php
if(isset($_POST['signup'])){
	//registration here
	$errors = [];
	if(trim($_POST['login']) == ''){
	$errors[] = "Введите логин";
    }

    if(trim($_POST['email']) == ''){
	$errors[] = "Введите email";
    }
    
    if($_POST['password'] == ''){
	$errors[] = "Введите пароль";
    }

    if($_POST['password_2'] != $_POST['password']){
    	$errors[] = "Повторный пароль введен неверно!";
    }
    $mysqli = new mysqli("localhost", "root", "", "registration");
    $result = $mysqli->query(
    	"SELECT * FROM users WHERE users_login = '$_POST[login]';");
    $rows = $result->num_rows;
    if($rows > 0){
    	$errors[] = "Пользователь с таким логином уже существует!";
    }
    $result->close();

    $result = $mysqli->query(
    	"SELECT * FROM users WHERE users_email = '$_POST[email]';");
    $rows = $result->num_rows;
    if($rows > 0){
    	$errors[] = "Пользователь с таким email уже существует!";
    }
    $result->close();
    $mysqli -> close();
    
    if(empty($errors)){
    	//it is ok, regisration
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $mysqli = new mysqli("localhost", "root", "", "registration");
    $mysqli->query(
    	"INSERT INTO users VALUES(
    		NULL,
    		'$login',
    		'$email',
    		'$password');");
    $mysqli->close(); ?>

<div class="container">
 <div class="alert alert-success alert-dismissible fade show" align="center" role="alert">
  <strong>Операция выполнена!</strong> Вы успешно зарегистрированы!
   <a class="btn btn-primary" btn-lg" href="./login.php"" role="button">Авторизоваться</a>
  </button>
 </div>
</div>

<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Уведомление!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Вы успешно зарегистрированы!</p>
      </div>
      <div class="modal-footer">
        <a class="btn btn-danger" btn-lg" href="./logout.php"" role="button">Выход</a>
        <a class="btn btn-primary" btn-lg" href="./logint.php"" role="button">Авторизоваться</a>
      </div>
    </div>
  </div>
</div>

    <?php
    }else{ ?>
<div class="container">
 <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Данные некорректны!</strong> <?=array_shift($errors)?>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
   </button>
 </div>
</div>
   <?php }
}
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" href="bootstrap/css/bootstrap.min.css">
    <style>
        body {
            background-image: url("./picture/strawberry.jpg");
        }
    </style>
    </head>
<body>
 <div align="right">
  <div class="mt-3 col">
   <a class="btn btn-danger" btn-lg" href="./logout.php"" role="button">Выход</a>
  </div>
 </div>
<form action="./signup.php" method="POST">
    <div class="container mt-5" align="center">
         <div class="col-md-6">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Пользователь</span>
  </div>
  <input type="text" name="login" class="form-control" aria-label="login" aria-describedby="basic-addon1" placeholder="Ваш логин">
</div>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Почтовый ящик</span>
  </div>
  <input type="email" name="email" class="form-control" aria-label="email" aria-describedby="basic-addon1" placeholder="Ваш email">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Идентификатор</span>
  </div>
  <input type="password" name="password" class="form-control" aria-label="password" aria-describedby="basic-addon1" placeholder="Ваш пароль">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Повторный идентификатор</span>
  </div>
  <input type="password" name="password_2" class="form-control" aria-label="password" aria-describedby="basic-addon1" placeholder="Повторите ваш пароль">
</div>
</div>
</div>

<div class="container" align="center">
	<button type="submit" name="signup" class="btn btn-success btn-lg">Регистрация</button>
</div>

</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>