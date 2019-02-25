<?php
require "dtabase/db.php";
?>

<?php
$id = $_GET['id'];
$mysqli = new mysqli("localhost", "root", "", "registration");
$res = $mysqli->query("DELETE FROM products WHERE product_id ='$id';");
header("Location: ./table_products.php");
?>
