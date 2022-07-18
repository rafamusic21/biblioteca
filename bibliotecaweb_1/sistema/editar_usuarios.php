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
  		if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['rol']))
  		{
  			$alert ='<p class="msg_error">todos los campos son obligatorios</p>';
  		}else{
  			
  			
  			$idusuario = $_POST['id'];
  			$nombre = $_POST['nombre'];
  			$email = $_POST['correo'];
  			$user = $_POST['usuario'];
  			$clave = md5($_POST['clave']);
  			$rol = $_POST['rol'];
  			

  			$query = mysqli_query($conection,"SELECT * FROM usuarios 
  														WHERE (usuario = '$user' AND idusuario != '$idusuario')
  														 OR (correo ='$email' AND idusuario != '$idusuario')");
  			$result = mysqli_fetch_array($query);
  			
  		

  			if($result > 0){
  				$alert ='<p class="msg_error">el correo o el usuario ya existen</p>';
  			}else{

  				if (empty($_POST['clave'])) {
  					$sql_update = mysqli_query($conection,"UPDATE usuarios
  															SET nombre_u = '$nombre', correo = '$email',usuario = '$user', rol = '$rol'
  															WHERE idusuario = '$idusuario' ");
  				}else {
  					$sql_update = mysqli_query($conection,"UPDATE usuarios
  															SET nombre_u = '$nombre', correo = '$email',usuario = '$user', clave = '$clave', rol = '$rol'
  															WHERE idusuario = '$idusuario' ");

  				}
             
              
              if($sql_update){
              	$alert ='<p class="msg_save">usuario actualizado correctamente</p>';
              }else{
              	$alert ='<p class="msg_error">error al actualizar el usuario</p>';
              }     
  			}
  		}
  		
  	}

// MOSTRAR DATOS

  	if (empty($_REQUEST['id'])) {
  		header('location: lista_usuarios.php');
  		mysqli_close($conection);
  	}

  	$iduser = $_REQUEST['id'];
	
	$sql = mysqli_query($conection,"SELECT u.idusuario, u.nombre_u, u.correo, u.usuario, (r.rol) as rol, (r.idrol) as idrol 
										FROM usuarios u 
										INNER JOIN rol r 
										ON u.rol = r.idrol 
		 								WHERE idusuario = $iduser and status = 1  AND status = 1");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if ($result_sql == 0) {
		header('location: lista_usuarios.php');
	}else{

		$option = '';

		while ($data = mysqli_fetch_array($sql)) {
			
			$iduser = $data['idusuario'];
			$nombre = $data['nombre_u'];
			$correo = $data['correo'];
			$usuario = $data['usuario'];
			$rol = $data['rol'];
			$idrol = $data['idrol'];

		if ($idrol == 1) {
				$option = '<option value="'.$idrol.'"select>'.$rol.'</option>';
			}else if ($idrol == 2) {
				$option = '<option value="'.$idrol.'"select>'.$rol.'</option>';
			}else if ($idrol == 3) {
				$option = '<option value="'.$idrol.'"select>'.$rol.'</option>';
			}	

		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "vista/includes/scripts.php";?>
	<title> actualizar usuario</title>
	<link rel="icon" href="img/logo_1.ico">
	
</head>
<body>
	<?php include "vista/includes/header.php"; ?>
	<div class="container">
	<section id="container">

	<div class="form_register">
		<h1><i class="fas fa-user-plus"></i> Actualizarm Usuario</h1>
		<hr>
		<div class="alert"> <?php echo isset($alert) ? $alert : ''; ?> </div>

		<form action="" method="post">
			<input type="hidden" name="id" value="<?php echo $iduser; ?>">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="<?php echo $nombre; ?>">
			<label for="correo">Correo electronico</label>
			<input type="email" name="correo" id="correo" placeholder="correo electronico" value="<?php echo $correo; ?>">
			<label for="usuario">Usuario</label>
			<input type="text" name="usuario" id="usuario" placeholder="usuario" value="<?php echo $usuario; ?>">
			 
			<label for="clave">Clave</label>
			<input type="password" name="clave" id="clave" placeholder="clave">
			
			<label for="rol">Tipo Usuario</label>

			<?php 
				include "../conexion.php";
				$query_rol = mysqli_query($conection,"SELECT * FROM rol");
				mysqli_close($conection);
				$result_rol = mysqli_num_rows($query_rol);
			 ?>

			<select name="rol" id="rol" class="notItemOne">

			<?php 

			echo $option;

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
			<input type="submit" value="actualizar usuario" class="btn_save">
     		
		</form>


	</div>

	</section>
	</div>

	<?php include "vista/includes/footer.php";?>

</body>
</html>