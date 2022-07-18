<?php 
	
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$db = 'bd_biblioteca';
	
	$conection = @mysqli_connect($host, $user, $password, $db);

	

	if(!$conection){
		echo "error en la coneccion";
	}
 ?>