<?php
	session_start();
	include "../conexion.php";

  	if(!empty($_POST))
  	{
  		
  		$alert ='';
  		if(empty($_POST['ci']) || empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['telf']) ||  empty($_POST['carrera']))
  		{
  			$alert ='<p class="msg_error">todos los campos son obligatorios</p>';
  		}else{

  			
				$ci = $_POST['ci'];
				$nombre = $_POST['nombre'];
  				$apellido = $_POST['apellido'];
  				$telf = $_POST['telf'];
  				$carrera = $_POST['carrera'];
				$usuario_id = $_SESSION['idUser'];
			
				

			
					$query_ci = mysqli_query($conection,"SELECT * FROM inf_estudiante WHERE cedula = '$ci'");
					if(mysqli_num_rows($query_ci) > 0){
						$alert ='<p class="msg_error">el numero de cedula ya existe</p>';
					}	
					else{
						$query_insert = mysqli_query($conection,"INSERT INTO inf_estudiante(cedula,nombre,apellido,numero,carrera,id_userCreador)     VALUES('$ci','$nombre','$apellido','$telf','$carrera','$usuario_id')");

  			 			 if($query_insert){
              				$alert ='<p class="msg_save">Estudiante guardado correctamente</p>';
             			 }else{
             	 			$alert ='<p class="msg_error">error al guardar el Estudiante</p>';
              		 
  						}
				}

  			
  			 	

  			}	
			mysqli_close($conection);	
  	}
?>