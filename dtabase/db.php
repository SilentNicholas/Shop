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

$mysqli->query("CREATE TABLE do_order (
order_id INT PRIMARY KEY AUTO_INCREMENT,
user_id INT NOT NULL,
FOREIGN KEY (user_id) REFERENCES users (users_id),
order_status VARCHAR(30),
date_order DATE,
time_order TIME,
address_order VARCHAR(30));");

$mysqli->query("CREATE TABLE products(
product_id INT AUTO_INCREMENT PRIMARY KEY,
product_name VARCHAR(30),
product_status VARCHAR(30),
product_price VARCHAR(11),
product_description TEXT,
product_weight VARCHAR(11),
product_material VARCHAR(30),
product_creater VARCHAR(30),
product_added_date DATE,
product_update_date DATE);");

$res = $mysqli->query("CREATE TABLE product_order (
product_id INT NOT NULL,
order_id INT NOT NULL,
PRIMARY KEY (product_id,order_id),
FOREIGN KEY (product_id) REFERENCES products (product_id),
FOREIGN KEY (order_id) REFERENCES do_order (order_id));");

$mysqli->close();
session_start();
?>