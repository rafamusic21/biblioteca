<?php require_once 'controlador/validar_retorno.php';








?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "vista/includes/scripts.php";?>
	<title>Retorno de libros</title>
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
            <label for="ci">Cedula</label>
			<input type="number" name="ci" id="ci" placeholder="Número de cedula">
			<input type="submit" value="crear usuario" class="btn_save">
     		
		</form>


	</div>

	</section>
	</div>

	<?php include "vista/includes/footer.php";?>

</body>
</html>