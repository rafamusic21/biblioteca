<?php 
session_start();
	if($_SESSION['rol'] != 1) {
		header("location: ./");
	}
		include "../conexion.php";
	if(!empty($_POST)){

		if(empty($_POST['id'])){
			header("location: lista_estudiantes.php");
			mysqli_close($conection);
		}

		$idestudiante = $_POST['id'];
		$usuario_id = $_SESSION['idUser'];

		$query_delete = mysqli_query($conection,"UPDATE inf_estudiante SET status = 0, id_userDeleted = $usuario_id WHERE id = '$idestudiante'");
		mysqli_close($conection);
		if($query_delete){
			header("location: lista_estudiantes.php");
		}else{
			echo "error al eliminar el estudiante";
		}
	}


	if(empty($_REQUEST['id'])){
		header("location: lista_estudiantes.php");
		mysqli_close($conection);
	}else{
	

		$idestudiante = $_REQUEST['id'];

		$query = mysqli_query($conection,"SELECT  e.cedula, e.nombre, e.apellido, (c.nom_carrera) as carrera
        FROM inf_estudiante e 
        INNER JOIN carrera c 
        ON e.carrera = c.idcarrera
         WHERE e.id = $idestudiante");
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){

			while ($data = mysqli_fetch_array($query)) {
				
                $ci = $data['cedula'];
				$nombre = $data['nombre'];
				$apellido = $data['apellido'];
				$carrera = $data['carrera'];
			}
		}else{
				header("location: lista_estudiantes.php");
			}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Eliminar estudiante</title>
	<?php include "vista/includes/scripts.php";?>
	
</head>
<body>
	<?php include "vista/includes/header.php";?>
	<section id="container">
		
		<div class="data_delete">
			<i class="fas fa-user-times fa-7x" style="color: #e66262"></i>
			<br>
			<br>
			<h2>Desea eliminar este estudiante?</h2>
			<p>Nombre: <span><?php echo $nombre;?></span></p>
			<p>Apellido: <span><?php echo $apellido;?></span></p>
            <p>C.I: <span><?php echo $ci;?></span></p>
			<p>Carrera: <span><?php echo $carrera;?></span></p>
			<form method="post" action="">
				<input type="hidden" name="id" value="<?php echo $idestudiante;?>">
				<a href="lista_libros.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>

	</section>
	<?php include "vista/includes/footer.php";?>
	
</body>
</html>
