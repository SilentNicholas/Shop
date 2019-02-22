<?php
require "dtabase/db_products.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" href="bootstrap/css/bootstrap.min.css">
	<style>
		body {
			background-image: url("./apples.jpg");
		}
	</style>
</head>
<body>
	<div class="container table-responsive">
	<div class="row">
    <div class="mt-3 col">
	<table class="table table-dark table-hover table-bordered table-sm">
  <thead>
    <tr align="center">
      <th scope="col">Name</th>
      <th scope="col">Status</th>
      <th scope="col">Price</th>
      <th scope="col">Description</th>
      <th scope="col">Weight</th>
      <th scope="col">Material</th>
      <th scope="col">Creater</th>
      <th scope="col">Added Date</th>
      <th scope="col">Update Date</th>
      <th scope="col">Delete Record</th>
    </tr>
  </thead>
  <?php
  $mysqli = new mysqli("localhost", "root", "", "registration");
  $result = $mysqli->query("SELECT * FROM products;");
  $new = $result->fetch_assoc();
  $data = $_POST;
  foreach ($result as  $table) {
  	if(isset($data['deleted'])){
     $res = $mysqli->query("DELETE FROM products WHERE product_id = '$new[product_id]';");
 }
 ?>
  <tbody>
    <tr align="center">
      <td><?= $table['product_name']?></td>
      <td><?= $table['product_status']?></td>
      <td><?= $table['product_price']?></td>
      <td><?= $table['product_description']?></td>
      <td><?= $table['product_weight']?></td>
      <td><?= $table['product_material']?></td>
      <td><?= $table['product_creater']?></td>
      <td><?= $table['product_added_date']?></td>
      <td><?= $table['product_update_date']?></td>
      <form action="./table_products.php" method="POST">
      <td><button type="submit" name="deleted" class="btn btn-danger" values="<?= $res ?>">Delete</button></td>
      </form>
    </tr>
   <?php }
  
   $result->close();
   $mysqli->close();
    ?>
     </div>
  </tbody>
</table>
<a scope class="btn btn-info" href="./products.php" role="button">Добавить новый товар</a>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>