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
  		if(empty($_POST['nombre']) || empty($_POST['autor']) || empty($_POST['año']) || empty($_POST['carrera']))
  		{
  			$alert ='<p class="msg_error">todos los campos son obligatorios</p>';
  		}else{
  			
  			
  			$cota = $_POST['cota'];
  			$nombre = $_POST['nombre'];
  			$autor = $_POST['autor'];
  			$año = $_POST['año'];
  			
  			$carrera = $_POST['carrera'];


  			$sql_update = mysqli_query($conection,"UPDATE libros
  												   SET nombre_libro = '$nombre', autor = '$autor',año_libro = '$año', carrera = '$carrera'
  												   WHERE cota = '$cota' ");
  				
  					

  				
             
              
              if($sql_update){
              	$alert ='<p class="msg_save">libro actualizado correctamente</p>';
              }else{
              	$alert ='<p class="msg_error">error al actualizar el libro</p>';
              }     
  			
  		}
  		
  	}

// MOSTRAR DATOS

  	if (empty($_REQUEST['id'])) {
  		header('location: lista_libros.php');
  		mysqli_close($conection);
  	}

  	$cota = $_REQUEST['id'];
	
	$sql = mysqli_query($conection,"SELECT l.cota, l.nombre_libro, l.autor, l.año_libro, (c.nom_carrera) as carrera, (c.idcarrera) as idcarrera 
                                                                                                                    FROM libros l 
                                                                                                                    INNER JOIN carrera c
                                                                                                                    ON l.carrera = c.idcarrera 
                                                                                                                    WHERE cota = '$cota' and status = 1");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if ($result_sql == 0) {
		header('location: lista_libros.php');
	}else{

		$option = '';

		while ($data = mysqli_fetch_array($sql)) {
			
			$cota = $data['cota'];
			$nombre = $data['nombre_libro'];
			$autor = $data['autor'];
			$año = $data['año_libro'];
			$carrera = $data['carrera'];
			$idcarrera = $data['idcarrera'];

		if ($idcarrera == 1) {
				$option = '<option value="'.$idcarrera.'"select>'.$carrera.'</option>';
			}else if ($idcarrera == 2) {
				$option = '<option value="'.$idcarrera.'"select>'.$carrera.'</option>';
			}else if ($idcarrera == 3) {
				$option = '<option value="'.$idcarrera.'"select>'.$carrera.'</option>';
			}else if ($idcarrera == 4) {
				$option = '<option value="'.$idcarrera.'"select>'.$carrera.'</option>';
			}else if ($idcarrera == 5) {
				$option = '<option value="'.$idcarrera.'"select>'.$carrera.'</option>';
			}else if ($idcarrera == 6) {
				$option = '<option value="'.$idcarrera.'"select>'.$carrera.'</option>';
			}else if ($idcarrera == 7) {
				$option = '<option value="'.$idcarrera.'"select>'.$carrera.'</option>';
			}	

		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "vista/includes/scripts.php";?>
	<title> actualizar libros</title>
	<link rel="icon" href="img/logo_1.ico">
	
</head>
<body>
	<?php include "vista/includes/header.php"; ?>
	<div class="container">
	<section id="container">

	<div class="form_register">
		<h1><i class="fas fa-user-plus"></i> Actualizarm Libros</h1>
		<hr>
		<div class="alert"> <?php echo isset($alert) ? $alert : ''; ?> </div>

		<form action="" method="post">
			<input type="hidden" name="cota" value="<?php echo $cota; ?>">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" id="nombre" placeholder="nombre del libro" value="<?php echo $nombre; ?>">
			<label for="autor">Autor</label>
			<input type="text" name="autor" id="autor" placeholder="autor del libro" value="<?php echo $autor; ?>">
			<label for="año">Año</label>
			<input type="date" name="año" id="año" placeholder="año" value="<?php echo $año; ?>">
			
			
			<label for="carrera">Carrera</label>

			<?php 
				include "../conexion.php";
				$query_carrera = mysqli_query($conection,"SELECT * FROM carrera");
				mysqli_close($conection);
				$result_carrera = mysqli_num_rows($query_carrera);
			 ?>

			<select name="carrera" id="carrera" class="notItemOne">

			<?php 

			echo $option;

				if($result_carrera > 0)
				{
					while ($carrera = mysqli_fetch_array($query_carrera)) {
			?>
			  <option value="<?php echo $carrera["idcarrera"] ;?>"><?php echo $carrera["nom_carrera"] ;?></option>
			<?php
				   	}
				}
			?>

					  
			</select>
			<input type="submit" value="actualizar usuario" class="btn_save">
     		
		</form>


	</div>

	</section>
	</div>

	<?php include "vista/includes/footer.php";?>

</body>
</html>