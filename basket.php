<?php
require "dtabase/db.php";
?>

<?php
session_start();
$id = $_GET['id'];
if(!isset($_SESSION['basket'])){
	$_SESSION['basket'] = array();
}
if(!empty($id)){
	$_SESSION['basket'][] = $id;
	header("Location: ./table_products.php?status=success");
}else{
	header("Location: ./table_products.php?status=failed");
}
?>