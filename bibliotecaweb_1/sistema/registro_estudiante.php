<?php  require_once 'controlador/validar_estudiantes.php';?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "vista/includes/scripts.php";?>
	<title> reguistro estudiante</title>
	<link rel="icon" href="vista/img/logo_1.ico">
	
</head>
<body>
	<?php include "vista/includes/header.php"; ?>
	<div class="container">
	<section id="container">

	<div class="form_register">
		<h1><i class="fas fa-truck-moving"></i> Registro de estudiante</h1>
		<hr>
		<div class="alert"> <?php echo isset($alert) ? $alert : ''; ?> </div>

		<form action="" method="post" >
			<label for="ci">C.I</label>
			<input type="number" name="ci" id="ci" placeholder="Numero de cedula">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" id="nombre" placeholder="Nombre completo">
			<label for="apellido">Apellido</label>
			<input type="text" name="apellido" id="apellido" placeholder="Apellido completo">
			<label for="telf">Numero de telefono</label>
			<input type="number" name="telf" id="telf"  placeholder="Numero de telefono">


			

			<label for="carrera">Carrera</label>
			<?php 			
			include "../conexion.php";

				$query_carrera = mysqli_query($conection,"SELECT * FROM  carrera");
				mysqli_close($conection);
				$result_carrera = mysqli_num_rows($query_carrera);	
			?>

			<select name="carrera" id="carrera">

				<?php
					if($result_carrera > 0)
				{
					while ($carrera = mysqli_fetch_array($query_carrera)) 
					{
				?>
					
		 <option value="<?php echo $carrera["idcarrera"] ?>"><?php echo $carrera["nom_carrera"]?></option>
				  <?php

					}
				}
				?>
			</select>
			<input type="submit" value="Guardar estudiante" class="btn_save">
     		
		</form>


	</div>

	</section>
	</div>

	<?php include "vista/includes/footer.php";?>

</body>
</html>