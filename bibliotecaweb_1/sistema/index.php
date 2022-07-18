<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>biblioteca birtual</title>
<?php 
	include "vista/includes/scripts.php";
	include "../conexion.php";

?>
	
</head>
<body>
	<?php include "vista/includes/header.php";?>
	<section id="container">
		<div class="divContainer">
			<div>
				<h1 class="titelPanelControl">Panel De Control</h1>
			</div>

		</div>

		<div class="divInfoSistema">
			<div>
				<h1 class="titelPanelControl">Configuracion</h1>
			</div>
			<div class="containerPerfin">
				<div class="containerDataUser">
					<div class="logoUser">
						<img src="../vista/img/bibliteca.svg">
					</div>
<div class="divDataUser">
						<h4>Informacion Personal</h4>
<?php 
		include "../conexion.php";

		if(!empty($_POST))
  	{
  		
  		$alert ='';
  		if(empty($_POST['txtPassUser']) || empty($_POST['txtNewPassUser']) || empty($_POST['txtPassConfirm']))
  		{
  			$alert ='<p class="msg_error">todos los campos son obligatorios</p>';
  		}else{
  			
  			
  			$idusuario = $_SESSION['idUser'];
  			$passuser = $_POST['txtPassUser'];
  			$newpass = md5($_POST['txtNewPassUser']);
  			$confirpass = md5($_POST['txtPassConfirm']);

  			$query = mysqli_query($conection,"SELECT * FROM usuarios WHERE clave = '$passuser' AND idusuario = $idusuario");
  			$result = mysqli_fetch_array($query);
  
  			
  			if($result == 0){
  				$alert ='<p class="msg_error">la clave es incorrecta</p>';
  			}else{

  					if($newpass != $confirpass){
  						$alert ='<p class="msg_error">La confirmacion de la clave es incorecta</p>';
  					}else{

  						$sql_update = mysqli_query($conection,"UPDATE usuarios
  															SET clave = '$newpass'
  															WHERE idusuario = $idusuario ");
  					if($sql_update){
  						$alert ='<p class="msg_save">clave actualizada correctamente</p>';
  					}else{
              			$alert ='<p class="msg_error">error al actualizar la clave</p>';
             			 } 
  				

  				}
   
  			}
  		}
  		mysqli_close($conection);
  	}

	 ?>

						<div>
							<label>Nombre:</label> <span><?= $_SESSION['nombre']; ?></span>
						</div>
						<div>
							<label>Correo:</label> <span><?= $_SESSION['email']; ?></span>
						</div>
						<h4>Datos del usuario</h4>
						<div>
							<label>Rol:</label> <span><?= $_SESSION['rol_name']; ?></span>
						</div>
						<div>
							<label>Usuario:</label> <span><?= $_SESSION['user']; ?></span>
						</div>

						<h4>Cambiar contraseña</h4>
						<div class="alert"> <?php echo isset($alert) ? $alert : ''; ?> </div>

	
	 		<form action="" method="post">
			<label for="txtPassUser">Contraseña actual</label>
			<input type="password" name="txtPassUser" id="txtPassUser" placeholder="Contraseña actual">

			<label for="txtNewPassUser">Nueva contraseña</label>
			<input type="password" name="txtNewPassUser" id="txtNewPassUser" placeholder="Nueva contraseña">
			<label for="txtPassConfirm">Confirme contraseña</label>

			<input type="password" name="txtPassConfirm" id="txtPassConfirm" placeholder="Confirme contraseña">
			<input type="submit" value="actualizar usuario" class="btn_save">
     		
			</form>

						
					</div>
				</div>
				
			</div>
		</div>
	</section>
	<?php include "vista/includes/footer.php";?>
	
</body>
</html>