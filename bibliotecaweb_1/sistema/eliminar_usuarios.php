<?php 
session_start();
	if($_SESSION['rol'] != 1) {
		header("location: ./");
	}
		include "../conexion.php";
	if(!empty($_POST)){

		if($_POST['idusuario'] ==1){
			header("location: lista_usuarios.php");
			mysqli_close($conection);
			exit;
		}

		$idusuario = $_POST['idusuario'];
		$usuario_id = $_SESSION['idUser'];

		$query_delete = mysqli_query($conection,"UPDATE usuarios SET status = 0, id_userDeleted = $usuario_id WHERE idusuario = $idusuario");
		mysqli_close($conection);
		if($query_delete){
			header("location: lista_usuarios.php");
		}else{
			echo "error al eliminar el usuario";
		}
	}


	if(empty($_REQUEST['id']) || $_REQUEST['id'] ==1){
		header("location: lista_usuarios.php");
		mysqli_close($conection);
	}else{
	

		$idusuario = $_REQUEST['id'];

		$query = mysqli_query($conection,"SELECT u.nombre_u, u.usuario, r.rol 
												FROM usuarios u 
												INNER JOIN rol r
												ON u.rol = r.idrol
												WHERE u.idusuario = $idusuario");
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){

			while ($data = mysqli_fetch_array($query)) {
				
				$nombre = $data['nombre_u'];
				$usuario = $data['usuario'];
				$rol = $data['rol'];
			}
		}else{
				header("location: lista_usuarios.php");
			}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Eliminar usuario</title>
	<?php include "vista/includes/scripts.php";?>
	
</head>
<body>
	<?php include "vista/includes/header.php";?>
	<section id="container">
		
		<div class="data_delete">
			<i class="fas fa-user-times fa-7x" style="color: #e66262"></i>
			<br>
			<br>
			<h2>Desea eliminar este usuario?</h2>
			<p>Nombre: <span><?php echo $nombre;?></span></p>
			<p>Usuario: <span><?php echo $usuario;?></span></p>
			<p>Rol: <span><?php echo $rol;?></span></p>
			<form method="post" action="">
				<input type="hidden" name="idusuario" value="<?php echo $idusuario;?>">
				<a href="lista_usuarios.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>

	</section>
	<?php include "vista/includes/footer.php";?>
	
</body>
</html>