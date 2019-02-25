<?php
require "dtabase/db.php";
?>
<?php
foreach($_SESSION['basket'] as $val){
$date = date('Y-m-d', time());
$time = date('H-i-s', time());
$user_id = $_SESSION['remb_user'][0];
$mysqli = new mysqli("localhost", "root", "", "registration");
$res = $mysqli->query("INSERT INTO do_order VALUES (
NULL, '$user_id', NULL, '$date', '$time', NULL);");
$res = $mysqli->query("SELECT * FROM do_order WHERE user_id = '$user_id';");
$result = $res->fetch_assoc();
$val = $mysqli->query("INSERT INTO product_order VALUES (
'$val', $result[order_id]);");
}
$res->close();
$mysqli->close();
header("Location: ./shop_case.php");
?>