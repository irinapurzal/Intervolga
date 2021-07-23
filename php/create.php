<?php 
	require_once 'connection.php'; // подключаемся к серверу 
	$pattern_str = '#[^а-яА-Яa-zA-Z- ]#iu';
	// $pattern_num = '#[^0-9]#iu';
	
	//функция очистки полей от спец символов
	function check_field($field, $pattern){
		$field = $_POST[$field];
		
		if(preg_match($pattern, $field))  { 
			$field = preg_replace($pattern, "", $field); 
			// echo " Вы ввели в поле спец. символы ";	   
		} 
		$field = preg_replace($pattern, "", $field); 
		$field = htmlentities(htmlspecialchars(strip_tags(stripslashes($field))));
        $field = trim($field);
        return $field;
	}

	//массив текстовых полей
	$array_fields = [0=>"country", 1=>"capital", 2=>"president", 3=>"currency"];
	//	Проверка для текстовых полей
	for($i = 0; $i < count($array_fields); $i++){
		$array_fields[$i] = check_field($array_fields[$i], $pattern_str);
 	}
 	//Проверка для числовых полей не нужна, так как тип number решает эту проблему
 	$array_fields_2 = [0=>"population", 1=>"territory"];
 	//Вставка очищенных полей в таблицу
	$query = "INSERT INTO `countries` (`country`, `capital`, `president`,`currency`,`population`,`territory`) VALUES ('$array_fields[0]', '$array_fields[1]', '$array_fields[2]', '$array_fields[3]', $array_fields_2[0], $array_fields_2[1])";
	$result = mysqli_query($link, $query) or die("Ошибка запроса" . mysqli_error($link)); 
	

	//Освобождение полей и переменных
	for($i = 0; $i < count($array_fields); $i++){
		unset($_POST['$array_fields[$i]']);
		unset($array_fields[$i]);
 	}	
 	$url ='../index.php';
	header('Location:'.$url); 
	 
?>