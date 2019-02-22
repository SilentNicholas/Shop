<?php
require "dtabase/db_products.php";

$data = $_POST;
if(isset($data['do_products'])){
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

	$mysqli = new mysqli("localhost", "root", "", "registration");
    $res = $mysqli->query("SELECT * FROM products WHERE product_name = '$data[name]' AND product_status = '$data[status]' AND product_price = '$data[price]' AND product_description = '$data[description]' AND product_weight = '$data[weight]' AND product_material = '$data[material]' AND product_creater = '$data[creater]';");
    $unique = $res->num_rows;
	if($unique > 0){
		$errors[] = 'Данный товар уже существует!';
	}
	$res->close();
    
	if(!empty($errors)){
		echo'<div style="color: red;">'.array_shift($errors).'</div><hr>';
	}else{
		$name = $data['name'];
		$status = $data['status'];
		$price = $data['price'];
		$weight = $data['weight'];
		$material = $data['material'];
		$creater = $data['creater'];
		$added_time = date('Y-m-d', time());
		$update_time = date('Y-m-d', time());
		$descr = $data['description'];
		$mysqli->query(
			"INSERT INTO products VALUES( NULL, '$name', '$status', '$price', '$descr', '$weight', '$material','$creater', '$added_time', '$update_time');");
		$mysqli->close();
		echo'<div style="color: green;">Товар успешно добавлен!</div><br>
		<div style="color: green;">Переход к <a href="./table_products.php">списку</a> товаров.</div><hr>';
	}
}
?>

<form action="./products.php" method="POST">
	<p>
		<p><strong>Название товара</strong>:</p>
		<input type="text" name="name">
	</p>

	<p>
		<p><strong>Статус товара</strong>:</p>
		<select type="text" name="status">
			<option>Are available</option>
			<option>Not available</option>
		</select>
	</p>

	<p>
		<p><strong>Цена товара</strong>:</p>
		<input type="text" name="price">
	</p>

	<p>
		<p><strong>Вес товара</strong>:</p>
		<input type="text" name="weight">
	</p>

	<p>
		<p><strong>Материал товара</strong>:</p>
		<input type="text" name="material">
	</p>

	<p>
		<p><strong>Производитель товара</strong>:</p>
		<input type="text" name="creater">
	</p>

	<p>
		<p><strong>Описание товара</strong>:</p>
		<textarea type="text" name="description" rows="5" cols="20"></textarea>
	</p>

	<p>
		<button type="submit" name="do_products">Добавить товар</button>
	</p>

</form>