<?php
require "dtabase/db.php";
$id = $_GET['id'];
?>

<?php
$data = $_POST;
$mysqli = new mysqli("localhost", "root", "", "registration");
$select= $mysqli->query("SELECT * FROM products WHERE product_id ={$id};");
$query = $select->fetch_assoc();
if(isset($data['do_edit'])){
$errors =[];
	if(trim($data['name']) == ''){
		$errors[] = 'Заполните название товара!';
	}

	if(trim($data['price']) == ''){
		$errors[] = 'Заполните цену товара!';
	}

	if(trim($data['weight']) == ''){
		$errors[] = 'Заполните вес товара!';
	}

	if(trim($data['material']) == ''){
		$errors[] = 'Заполните материал товара!';
	}

	if(trim($data['creater']) == ''){
		$errors[] = 'Заполните производителя товара!';
	}

	if(trim($data['description']) == ''){
		$errors[] = 'Заполните описание товара!';
	}

    $res = $mysqli->query("SELECT * FROM products WHERE product_name ='$data[name]' AND product_status ='$data[status]' AND product_price ='$data[price]' AND product_description ='$data[description]' AND product_weight ='$data[weight]' AND product_material ='$data[material]' AND product_creater ='$data[creater]';");
    $unique = $res->num_rows;

	if($unique > 0){
		$errors[] = 'Вы не внесли изменений!';
	}
	$res->close();
    
	if(!empty($errors)){
		echo'<div style="color: red;">'.array_shift($errors).'</div><hr>';
	}else{
	$name = $data['name'];
    $price = $data['price'];
    $weight = $data['weight'];
    $status = $data['status'];
    $material = $data['material'];
    $creater = $data['creater'];
    $update_date = date('Y-m-d', time());
    $descr = $data['description'];
    $prod_id = $query['product_id'];
	$mysqli->query("UPDATE products SET product_name ='$name', product_status ='$status', product_price ='$price', product_weight ='$weight', product_material ='$material', product_creater ='$creater', product_description ='$descr', product_update_date ='$update_date' WHERE product_id ='$prod_id';");
    }
}
$mysqli->close();
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" href="bootstrap/css/bootstrap.min.css">
    <style>
        body {
            background-image: url("./picture/blueberry.jpeg");
        }
    </style>
    </head>
<body>
	<form action="./edit.php" method="POST">
 	<div class="container mt-5" align="center">
 	<div class="col-md-6">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="basic-addon1">Name</span>
   </div>
  <input type="text" name="name" class="form-control" placeholder="Название товара" aria-label="name" aria-describedby="basic-addon1" value="<?=$query['product_name']?>">
</div>

<div class="input-group mb-3">
  <select class="custom-select" name="status" id="inputGroupSelect02">
    <option value="Are available">Are available</option>
    <option value="Not available">Not available</option>
  </select>
  <div class="input-group-append">
    <label class="input-group-text" for="inputGroupSelect02" value="<?=$query['product_status']?>">Status</label>
  </div>
</div>

 <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="basic-addon1">Price</span>
   </div>
  <input type="text" name="price" class="form-control" placeholder="Цена товара" aria-label="price" aria-describedby="basic-addon1" value="<?=$query['product_price']?>">
</div>

<div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="basic-addon1">Weight</span>
   </div>
  <input type="text" name="weight" class="form-control" placeholder="Вес товара" aria-label="weight" aria-describedby="basic-addon1" value="<?=$query['product_weight']?>">
</div>
	
	<div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="basic-addon1">Material</span>
   </div>
  <input type="text" name="material" class="form-control" placeholder="Материал товара" aria-label="material" aria-describedby="basic-addon1" value="<?=$query['product_material']?>">
</div>

<div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="basic-addon1">Creater</span>
   </div>
  <input type="text" name="creater" class="form-control" placeholder="Производитель товара" aria-label="creater" aria-describedby="basic-addon1" value="<?=$query['product_creater']?>">
</div>

<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">Description</span>
  </div>
  <textarea class="form-control" name="description" aria-label="description" placeholder="Описание товара..."><?=$query['product_description']?></textarea>
</div>
</div>
</div>

<div class="container" align="center">
	<div class="row">
    <div class="mt-3 col">
<button type="submit" name="do_edit" class="btn btn-primary btn-lg">Редактировать</button>
<a class="btn btn-warning btn-lg" href="./table_products.php" role="button" name="edit">Список товаров</a>
	
</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
