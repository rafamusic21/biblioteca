<?php  require_once 'controlador/validar_registroUsuario.php';?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "vista/includes/scripts.php";?>
	<title> reguistro usuario</title>
	<link rel="icon" href="img/logo_1.ico">
	
</head>
<body>
	<?php include "vista/includes/header.php"; ?>
	<div class="container">
	<section id="container">

	<div class="form_register">
		<h1><i class="fas fa-user-plus"></i> Registro Usuario</h1>
		<hr>
		<div class="alert"> <?php echo isset($alert) ? $alert : ''; ?> </div>

		<form action="" method="post">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" id="nombre" placeholder="Nombre completo">
			<label for="correo">Correo electronico</label>
			<input type="email" name="correo" id="correo" placeholder="correo electronico">
			<label for="usuario">Usuario</label>
			<input type="text" name="usuario" id="usuario" placeholder="usuario">
			<label for="clave">Clave</label>
			<input type="password" name="clave" id="clave" placeholder="clave">
			<label for="rol">Tipo Usuario</label>

			<?php 
			include "../conexion.php";
				$query_rol = mysqli_query($conection,"SELECT * FROM rol");
				mysqli_close($conection);
				$result_rol = mysqli_num_rows($query_rol);
			 ?>

			<select name="rol" id="rol">

			<?php 
				if($result_rol > 0)
				{
					while ($rol = mysqli_fetch_array($query_rol)) {
			?>
			  <option value="<?php echo $rol["idrol"] ;?>"><?php echo $rol["rol"] ;?></option>
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