<?php
	session_start();
	if($_SESSION['rol'] != 1) 
	{
		header("location: ./");
	}

	include "../conexion.php";
  	if(!empty($_POST))
  	{
  		
  		$alert ='';
  		if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['rol']))
  		{
  			$alert ='<p class="msg_error">todos los campos son obligatorios</p>';
  		}else{
  			

  			$nombre = $_POST['nombre'];
  			$email = $_POST['correo'];
  			$user = $_POST['usuario'];
  			$clave = md5($_POST['clave']);
  			$rol = $_POST['rol'];
  			$usuario_id = $_SESSION['idUser'];	

  			$query = mysqli_query($conection,"SELECT * FROM usuarios WHERE usuario = '$user' AND correo ='$email'");	
  			$result = mysqli_fetch_array($query);


  			if($result > 0){
  				$alert ='<p class="msg_error">el correo o el usuario ya existen</p>';
  			}else{
              $query_insert = mysqli_query($conection,"INSERT INTO usuarios(nombre,correo,usuario,clave,rol,id_userCreador)     VALUES('$nombre','$email','$user','$clave','$rol','$usuario_id')"); 


             
              //mysqli_close($conection);
              if($query_insert){
              	$alert ='<p class="msg_save">usuario creado correctamente</p>';
              }else{
              	$alert ='<p class="msg_error">error al crear el usuario</p>';
              }     
  			}
  		}
  	}
?>
<?php 
			include "../conexion.php";
				$query_rol = mysqli_query($conection,"SELECT * FROM rol");
				mysqli_close($conection);
				$result_rol = mysqli_num_rows($query_rol);
			 ?>
             