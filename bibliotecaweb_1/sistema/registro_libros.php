<?php require_once 'controlador/validar_registroLibros.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "vista/includes/scripts.php";?>
	<title>Registro de libros</title>
	<link rel="icon" href="img/logo_1.ico">
	
</head>
<body>
	<?php include "vista/includes/header.php"; ?>
	<div class="container">
	<section id="container">

	<div class="form_register">
		<h1><i class="fas fa-user-plus"></i> Registro de libros</h1>
		<hr>
		<div class="alert"> <?php echo isset($alert) ? $alert : ''; ?> </div>

		<form action="" method="post">
			<label for="cota">Cota</label>
			<input type="text" name="cota" id="cota" placeholder="Cota del libro">
			<label for="nombre">nombre del libro</label>
			<input type="text" name="nombre" id="nombre" placeholder="Nombre del libro">
			<label for="autor">Autor</label>
			<input type="text" name="autor" id="autor" placeholder="Autor del libro">
			<label for="año">Año del libro</label>
			<input type="date" name="año" id="año" placeholder="Año del libro">
            <label for="numero">Número de ejemplar</label>
			<input type="number" name="numero" id="numero" placeholder="Número de ejemplar">
			<label for="carrera">carrera</label>

			<?php 
			include "../conexion.php";
				$query_carrera = mysqli_query($conection,"SELECT * FROM carrera");
				mysqli_close($conection);
				$result_carrera = mysqli_num_rows($query_carrera);
			 ?>

			<select name="carrera" id="carrera">

			<?php 
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
			<input type="submit" value="crear usuario" class="btn_save">
     		
		</form>


	</div>

	</section>
	</div>

	<?php include "vista/includes/footer.php";?>

</body>
</html>