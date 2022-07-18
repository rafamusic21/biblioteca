<?php require_once 'controlador/validar_login.php';?>
<!DOCTYPE 
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="vista/css/login.css">
	<link rel="icon" href="vista/img/logo_1.ico">
</head>
<body>
	
	<section id="container">
		<form action="" method="post">
			<h3>Iniciar Sesion</h3>
			<img src="vista/img/bibliteca.svg" alt="Login">

			<input type="text" name="usuario" placeholder="usuario">
			<input type="password" name="clave" placeholder="contraseña">
			<div class="alert"><?php echo isset($alert) ? $alert: '' ; ?></div>
			<input type="submit" value="INGRESAR">
		</form>
	</section>
</body>
</html>