<?php
$mysqli = new mysqli("localhost", "root", "");
$mysqli->query("USE registration;");
$mysqli->query(
"CREATE TABLE products(
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
$mysqli->close();
?>