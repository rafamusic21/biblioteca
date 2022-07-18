<?php 
session_start();
	if($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2) {
		header("location: ./");
	}
		include "../conexion.php";
	if(!empty($_POST)){

		
		if(empty($_POST['cota']) || empty($_POST['cedula'])){
			header("location: lista_libros.php");
			mysqli_close($conection);
		}
		$cota = $_POST['cota'];
		$ci = $_POST['cedula'];
		$usuario_id = $_SESSION['idUser'];

		$query_ci = mysqli_query($conection,"SELECT * FROM inf_estudiante WHERE cedula = '$ci'");
		if(mysqli_num_rows($query_ci) == 0){

			$alert ='<p class="msg_error">La cedula no corresponde a ningun estudiante registrado</p>';
		
			

			mysqli_close($conection);


			}else{

				$data = mysqli_fetch_array($query_ci);	
				$id = $data['id'];
				$nombre = $data['nombre'];

				$query_libro = mysqli_query($conection,"SELECT n_ejemplar FROM libros WHERE cota = '$cota'");
				$data_libro = mysqli_fetch_array($query_libro);
				$n_libros = $data_libro['n_ejemplar'] - 1;
			
				$update = mysqli_query($conection,"UPDATE libros SET n_ejemplar = $n_libros WHERE cota = '$cota'");
				



				$query_retiro = mysqli_query($conection,"INSERT INTO retiro_libros(cota, fecha_retiro, hora_retiro,id_estudiante_rl,nombre,cedula, id_userCreador,fecha_entrega) values('$cota', CURDATE(), NOW(),'$id','$nombre', '$ci','$usuario_id', date_add(CURRENT_DATE, interval 3 day))");
				mysqli_close($conection);
			if($query_retiro){
				header("location: lista_libros.php");
			}else{
				
				$alert ='<p class="msg_error">error al registrar el prestamo</p>';
				
			}

		}
			
			
	}

	if(empty($_REQUEST['cota']) ){
		header("location: lista_libros.php");
		mysqli_close($conection);
		
	}else{
	

		$cota = $_REQUEST['cota'];

		$query = mysqli_query($conection,"SELECT * FROM libros WHERE cota = '$cota'");
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){

			while ($data = mysqli_fetch_array($query)) {
				$cota= $data['cota'];
				$nombre = $data['nombre_libro'];
				$autor = $data['autor'];
				
				
				
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
	<title>Prestamo de libros</title>
	<?php include "vista/includes/scripts.php";?>
	
</head>
<body>
	<?php include "vista/includes/header.php";?>
	<section id="container">
		
		<div class="data_delete">

		<div class="alert"> <?php echo isset($alert) ? $alert : ''; ?> </div>
			<i class="fas fa-user-times fa-7x" style="color: #e66262"></i>
			<br>
			<br>
			<h2>Desea prestamo este libro?</h2>
			<p>Nombre: <span><?php echo $nombre;?></span></p>
			<p>Autor: <span><?php echo $autor;?></span></p>
			<form method="post" action="" class="prestamo">
			
				<label for="cedula">cedula</label>
				<input class="prestamo" type="number" name="cedula" value="CI del estudainte">
				<input type="hidden" name="cota" value="<?php echo $cota?>">
				<a href="lista_libros.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="prestamo" class="btn_ok">
			</form>
		</div>

	</section>
	<?php include "vista/includes/footer.php";?>
	
</body>
</html>