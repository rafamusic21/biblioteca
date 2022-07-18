<?php 
session_start();
	if($_SESSION['rol'] != 1) {
		header("location: ./");
	}
		include "../conexion.php";
	if(!empty($_POST)){

		if(empty($_POST['cota'])){
			header("location: lista_libros.php");
			mysqli_close($conection);
		}

		$cota = $_POST['cota'];
		$usuario_id = $_SESSION['idUser'];

		$query_delete = mysqli_query($conection,"UPDATE libros SET status = 0, id_userDeleted = $usuario_id WHERE cota = '$cota'");
		mysqli_close($conection);
		if($query_delete){
			header("location: lista_libros.php");
		}else{
			echo "error al eliminar el libro";
		}
	}


	if(empty($_REQUEST['id'])){
		header("location: lista_libros.php");
		mysqli_close($conection);
	}else{
	

		$cota = $_REQUEST['id'];

		$query = mysqli_query($conection,"SELECT l.nombre_libro, l.autor, c.nom_carrera FROM libros l INNER JOIN carrera c ON l.carrera = c.idcarrera WHERE l.cota = '$cota'");
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){

			while ($data = mysqli_fetch_array($query)) {
				
				$nombre = $data['nombre_libro'];
				$autor = $data['autor'];
				$carrera = $data['nom_carrera'];
			}
		}else{
				header("location: lista_libros.php");
			}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Eliminar libro</title>
	<?php include "vista/includes/scripts.php";?>
	
</head>
<body>
	<?php include "vista/includes/header.php";?>
	<section id="container">
		
		<div class="data_delete">
			<i class="fas fa-user-times fa-7x" style="color: #e66262"></i>
			<br>
			<br>
			<h2>Desea eliminar este libro?</h2>
			<p>Nombre: <span><?php echo $nombre;?></span></p>
			<p>Autor: <span><?php echo $autor;?></span></p>
			<p>Carrera: <span><?php echo $carrera;?></span></p>
			<form method="post" action="">
				<input type="hidden" name="cota" value="<?php echo $cota;?>">
				<a href="lista_libros.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>

	</section>
	<?php include "vista/includes/footer.php";?>
	
</body>
</html>