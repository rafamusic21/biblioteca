<?php
    session_start();
	include "../conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "vista/includes/scripts.php";?>
	<title> Lista de estudiante</title>
	<link rel="icon" href="vista/img/logo_1.ico">
	
</head>
<body>
<?php include "vista/includes/header.php"; ?>

<section id="container">
		<h1> <i class="fas fa-user-tie"></i> Lista de estudiante</h1>
		<a href="registro_estudiante.php" class="btn_new"><i class="fas fa-address-book"></i> Agregar  estudiante</a>

		<form action="buscar_estudiante.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="buscar">
			<button type="submit" class="btn_search"><i class="fas fa-search"></i></button>
		</form>
		<table>
			<tr>
				<th>ID</th>
				<th>C.I</th>
				<th>Nombre</th>
				<th>apellido</th>
				<th>numero telf</th>
				<th>carrera</th>
				<th>Acciones</th>
			</tr>
			<?php 

				//paginador
				$sql_register =  mysqli_query($conection, "SELECT count(*)  as total_registro FROM inf_estudiante WHERE status = 1");
				$result_register = mysqli_fetch_array($sql_register);
				$total_registro = $result_register['total_registro'];

				$por_pagina = 5;

				if(empty($_GET['pagina']))
				{
					$pagina = 1;
				}else{
					$pagina = $_GET['pagina'];
				}

				$desde = ($pagina-1) * $por_pagina;
				$total_paginas = ceil($total_registro / $por_pagina);




				$query =  mysqli_query($conection,"SELECT e.id, e.cedula, e.nombre, e.apellido, e.numero, (c.nom_carrera) as carrera, (c.idcarrera) as idcarrera
				FROM inf_estudiante e 
				INNER JOIN carrera c 
				ON e.carrera = c.idcarrera
				 WHERE status = 1 ORDER BY id ASC
					LIMIT $desde, $por_pagina");
				mysqli_close($conection);
				$result = mysqli_num_rows($query);

				if($result > 0){

					while ($data = mysqli_fetch_array($query)) {
						if ($data["cedula"] == 0) {
							$ci = 'C/F';
						}else{
							$ci = $data["cedula"];
						}
 			?>
		
			<tr>
				<td><?php echo $data["id"] ;?></td>
				<td><?php echo $data["cedula"] ;?></td>
				<td><?php echo $data["nombre"] ;?></td>
				<td><?php echo $data["apellido"] ;?></td>
				<td><?php echo $data["numero"] ;?></td>
				<td><?php echo $data["carrera"] ;?></td>

				<td>
					<a class="link_edit" href="editar_estudiante.php?id=<?php echo $data["id"];?>"><i class="far fa-edit"></i> editar </a>
					<?php if($_SESSION['rol'] == 1){

					 ?>
					|
					<a class="link_delete" href="eliminar_estudiante.php?id=<?php echo $data["id"];?>"><i class="far fa-trash-alt"></i> eliminar</a>
					<?php }  ?>
				</td>
			</tr>
			<?php 

				}
			}

			?>

		</table>

		<div class="paginador">
			<ul>

				
				<li><a href="?pagina=<i class="fas fa-caret-right "></i></a></li>	
				<li><a href="?pagina=<i class="fas fa-step-forward"></i></a></li>
				
			</ul>
		</div>

	</section>


<?php include "vista/includes/footer.php";?>
</body>
</html>