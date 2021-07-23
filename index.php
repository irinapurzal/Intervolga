<link rel="stylesheet" href="css/admin_panel.css">
 <?php 
	require_once 'php/connection.php'; // подключаемся к серверу 
?>
<br> 
<h2>Администрирование таблицы:</h2>
<div class="block_form">
	<form action="php/create.php" method="post">
		<h3>Введите новую страну:</h3>
		<span>Страна</span>
		<input type="text" name="country" maxlength=30>
		<span>Столица</span>
		<input type="text" name="capital" maxlength=30>
		<span>Президент</span>
		<input type="text" name="president" maxlength=50>
		<span>Валюта</span>
		<input type="text" name="currency" maxlength=25>
		<br>
		<span>Население</span>
		<input type="number" name="population" maxlength=20>
		<span>Территория</span>
		<input type="number" name="territory" maxlength=20>
		<button class="btn_create_product" type="submit">Добавить</button>
	</form>
</div>
<br>
<table>
	<tr>
		<th>Страна</th>
		<th>Столица</th>
		<th >Президент</th>
		<th>Валюта</th>
		<th>Население</th>
		<th>Территория</th>
		
	</tr>

	<? 
		$query = "SELECT * FROM `countries` ORDER BY country";
	    $result = mysqli_query($link,"$query") or die("Ошибка запроса " . mysqli_error($link)); 
	    $kolvorows = mysqli_num_rows($result); // количество полученных строк из запроса
	    if ($kolvorows !== 0){ 
			for ($i = 0; $i < $kolvorows; ++$i) {
		     	//выводим каждую строку из запроса, но с заданного поля
		    	$row = mysqli_fetch_assoc($result);
		    	?>
				<tr>
					<td><?php print_r($row['country']); ?></td>
					<td><?php print_r($row['capital']); ?></td>
					<td><?php print_r($row['president']); ?></td>
					<td><?php print_r($row['currency']); ?></td>
					<td><?php print_r($row['population']); ?></td>
					<td><?php print_r($row['territory']); ?></td>					
				</tr>
			<?php	
			}
		}
  	mysqli_close($link);
	?>
</table>
