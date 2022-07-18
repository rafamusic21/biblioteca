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
  		if(empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['telf']) ||  empty($_POST['carrera']))
  		{
  			$alert ='<p class="msg_error">todos los campos son obligatorios</p>';
  		}else{
  			
  			
  			$idestudiante = $_POST['id'];
  			$nombre = $_POST['nombre'];
  			$apellido = $_POST['apellido'];
  			$telf = $_POST['telf'];
  			$carrera = $_POST['carrera'];
  			

  			$sql_update = mysqli_query($conection,"UPDATE inf_estudiante
                                                SET  nombre = '$nombre',apellido = '$apellido',numero = '$telf', carrera = '$carrera'
                                                WHERE id = '$idestudiante' ");
  			
  			
  	
              if($sql_update){
              	$alert ='<p class="msg_save">Estudiante actualizado correctamente</p>';
              }else{
              	$alert ='<p class="msg_error">error al actualizar el estudiante</p>';
              }     
  			
  		}
  		
  	}

// MOSTRAR DATOS

  	if (empty($_REQUEST['id'])) {
  		header('location: lista_estudiantes.php');
  		mysqli_close($conection);
  	}

  	$idestudiante = $_REQUEST['id'];
	
	$sql = mysqli_query($conection,"SELECT e.id,  e.nombre, e.apellido, e.numero, (c.nom_carrera) as carrera, (c.idcarrera) as idcarrera
    FROM inf_estudiante e 
    INNER JOIN carrera c 
    ON e.carrera = c.idcarrera
     WHERE id = $idestudiante AND status = 1  AND status = 1");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if ($result_sql == 0) {
		header('location: lista_estudiantes.php');
	}else{

		$option = '';

		while ($data = mysqli_fetch_array($sql)) {
			
			$idestudiante = $data['id'];
			$nombre = $data['nombre'];
			$apellido = $data['apellido'];
			
            $numero = $data['numero'];
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
	<title> actualizar estudiante</title>
	<link rel="icon" href="img/logo_1.ico">
	
</head>
<body>
	<?php include "vista/includes/header.php"; ?>
	<div class="container">
	<section id="container">

	<div class="form_register">
		<h1><i class="fas fa-user-plus"></i> Actualizarm Estudiantes</h1>
		<hr>
		<div class="alert"> <?php echo isset($alert) ? $alert : ''; ?> </div>

		<form action="" method="post">
			<input type="hidden" name="id" value="<?php echo $idestudiante; ?>">
			
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="<?php echo $nombre; ?>">
			<label for="apellido">Apellido</label>
			<input type="text" name="apellido" id="apellido" placeholder="Apellido completo" value="<?php echo $apellido; ?>">
			<label for="telf">Numero de telefono</label>
			<input type="number" name="telf" id="telf"  placeholder="Numero de telefono" value="<?php echo $numero; ?>">
			 
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
			<input type="submit" value="actualizar estudiante" class="btn_save">
     		
		</form>


	</div>

	</section>
	</div>

	<?php include "vista/includes/footer.php";?>

</body>
</html>