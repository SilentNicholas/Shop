<?php
require "dtabase/db_products.php";
?>

<?php

$data = $_POST;
$mysqli = new mysqli("localhost", "root", "", "registration");
$res = $mysqli->query("SELECT * FROM products WHERE product_name ='Table'; ");
$query = $res->fetch_assoc();
$res->close();
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
    $id = $query['product_id'];
	$mysqli->query("UPDATE products SET product_name ='$name', product_status ='$status', product_price ='$price', product_weight ='$weight', product_material ='$material', product_creater ='$creater', product_description ='$descr', product_update_date ='$update_date' WHERE product_id ='$id';");
    }
}
$mysqli->close();

?>
<form action="./edit.php" method="POST">
	<p>
		<p><strong>Название товара</strong>:</p>
		<input type="text" name="name" value="<?=$query['product_name']?>">
	</p>

	<p>
		<p><strong>Статус товара</strong>:</p>
		<select type="text" name="status" value="<?=$query['product_status']?>">
			<option>Are available</option>
			<option>Not available</option>
		</select>
	</p>

	<p>
		<p><strong>Цена товара</strong>:</p>
		<input type="text" name="price" value="<?=$query['product_price']?>">
	</p>

	<p>
		<p><strong>Вес товара</strong>:</p>
		<input type="text" name="weight" value="<?=$query['product_weight']?>">
	</p>

	<p>
		<p><strong>Материал товара</strong>:</p>
		<input type="text" name="material" value="<?=$query['product_material']?>">
	</p>

	<p>
		<p><strong>Производитель товара</strong>:</p>
		<input type="text" name="creater" value="<?=$query['product_creater']?>">
	</p>

	<p>
		<p><strong>Описание товара</strong>:</p>
		<textarea type="text" name="description" rows="5" cols="20"><?=$query['product_description']?></textarea>
	</p>

	<p>
		<button type="submit" name="do_edit">Редактировать</button>
	</p>

	<p>
		<a scope class="btn btn-info" href="./table_products.php" role="button">Список товаров</a>
	</p>

</form>