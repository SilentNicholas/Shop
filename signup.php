
<?php
require "dtabase/db.php";

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
    $mysqli->close();
    echo'<div style="color: green;">Вы успешно зарегистрированы!</div><hr>';
    }else{
    	echo'<div style="color: red;">'.array_shift($errors).'</div><hr>';
    }
    header('Location: ./registration.php');
}
?>
<p>
<div style="color: green;">Переход к <a href="./table_products.php">
списку</a> товаров.</div>
</p>

<form action="./signup.php" method="POST">

<p>
	<p><strong>Введите логин</strong></p>
	<p><input type="text" name="login"></p>
</p>

<p>
	<p><strong>Введите email</strong></p>
	<input type="email" name="email">
</p>

<p>
	<p><strong>Введите пароль</strong></p>
	<input type="password" name="password">
</p>

<p>
	<p><strong>Введите пароль повторно</strong></p>
	<input type="password" name="password_2">
</p>

<p>
	<button type="submit" name="signup">Зарегистрироваться</button>
</p>

</form>
