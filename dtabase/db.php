<?php
$mysqli = new mysqli("localhost", "root", "");
$mysqli->query("CREATE DATABASE registration;");
$mysqli->query("USE registration;");
$mysqli->query("CREATE TABLE users(
users_id INT AUTO_INCREMENT PRIMARY KEY,
users_login VARCHAR(30),
users_email VARCHAR(30),
users_password VARCHAR(30));");
$mysqli->query(
	"ALTER TABLE users MODIFY users_password VARCHAR(255);");
$mysqli->close();

session_start();
?>