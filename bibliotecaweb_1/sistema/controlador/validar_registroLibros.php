<?php
    session_start();
	include "../conexion.php";

    if(!empty($_POST))
  	{
  		
  		$alert ='';
  		if(empty($_POST['cota']) || empty($_POST['nombre']) || empty($_POST['autor']) || empty($_POST['año']) ||  empty($_POST['numero']) ||  empty($_POST['carrera']))
        {
  		
  			$alert ='<p class="msg_error">todos los campos son obligatorios</p>';
  		    }else{

  			
				$cota = $_POST['cota'];
				$nombre = $_POST['nombre'];
  				$autor = $_POST['autor'];
  				$año = $_POST['año'];
  				$numero = $_POST['numero'];
                $carrera = $_POST['carrera'];
				$usuario_id = $_SESSION['idUser'];
				

			
					$query_ci = mysqli_query($conection,"SELECT * FROM libros WHERE cota = '$cota'");
					if(mysqli_num_rows($query_ci) > 0){
						$alert ='<p class="msg_error">El libro ya esta registrado</p>';
					}	
					else{
						$query_insert = mysqli_query($conection,"INSERT INTO libros(cota,nombre_libro,autor,año_libro,n_ejemplar,carrera,id_userCreador)     VALUES('$cota','$nombre','$autor','$año','$numero','$carrera','$usuario_id')");

  			 			 if($query_insert){
              				$alert ='<p class="msg_save">Libro guardado correctamente</p>';
             			 }else{
             	 			$alert ='<p class="msg_error">error al guardar el libro</p>';
              		 
  						}
				}

  			
  			 	

  			}	
			mysqli_close($conection);	
  	}
?>