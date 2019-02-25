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
			background-image: url("./picture/basket.jpg");
		}
	</style>
</head>
<body>
 <div align="right">
  <div class="mt-3 col">
   <a class="btn btn-danger" btn-lg" href="./logout.php"" role="button">Выход</a>
  </div>
 </div>
	<div class="container table-responsive">
	<div class="row">
    <div class="mt-3 col">
	<table class="table table-dark table-hover table-bordered table-sm">
  <thead>
    <tr align="center">
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Count</th>
      <th scope="col">Your Actions</th>
    </tr>
  </thead>
<?php
$mysqli = new mysqli("localhost", "root", "", "registration");
if(count($_SESSION['basket'])>0){
foreach($_SESSION['basket'] as $val){
$basket = $mysqli->query("SELECT * FROM products WHERE product_id IN ('$val');");
$case = $basket->fetch_assoc();?>
<tbody>
    <tr align="center">
      <td><?= $case['product_id']?></td>
      <td><?= $case['product_name']?></td>
      <td><?= $case['product_price']?></td>
      <td></td>
      <td><a class="btn btn-danger btn-sm" href="./delete_case.php?id=<?=$case['product_id']?>" role="button" name="deleted">Удалить</a>
  
      </td>
    </tr>
<?php
}
}else{?>
	
	<?php
	header("Location: table_products.php?error");
	?>
	<?php
}
$basket->close();
$mysqli->close();
?>
</div>
  </tbody>
</table>
<div class="container">
<a class="btn btn-primary" href="./do_order.php" role="button" name="order">Подтвердить</a>
<a scope class="btn btn-info" href="./table_products.php" role="button">Выбрать товары</a>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>