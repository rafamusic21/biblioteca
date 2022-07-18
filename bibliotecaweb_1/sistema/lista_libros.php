<?php
    session_start();
	include "../conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "vista/includes/scripts.php";?>
	<title> Lista de libros</title>
	<link rel="icon" href="vista/img/logo_1.ico">
	
</head>
<body>
<?php include "vista/includes/header.php"; ?>

<section id="container">
		<h1> <i class="fas fa-user-tie"></i> Lista de libros</h1>
		<a href="registro_libros.php" class="btn_new"><i class="fas fa-address-book"></i> Agregar  libros</a>

		<form action="buscar_libros.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="buscar">
			<button type="submit" class="btn_search"><i class="fas fa-search"></i></button>
		</form>
		<table>
			<tr>
				<th>Cota</th>
				<th>nombre</th>
				<th>autor</th>
				<th>año</th>
				<th>numero de ejemplar</th>
				<th>carrera</th>
				<th>Acciones</th>
			</tr>
			<?php 

				//paginador
				$sql_register =  mysqli_query($conection, "SELECT count(*)  as total_registro FROM libros WHERE status = 1");
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




				$query =  mysqli_query($conection,"SELECT l.cota, l.nombre_libro, l.autor, l.año_libro, l.n_ejemplar, (c.nom_carrera) as carrera, (c.idcarrera) as idcarrera
				FROM libros l 
				INNER JOIN carrera c 
				ON l.carrera = c.idcarrera
				 WHERE status = 1 ORDER BY cota ASC
					LIMIT $desde, $por_pagina");
				mysqli_close($conection);
				$result = mysqli_num_rows($query);

				if($result > 0){

					while ($data = mysqli_fetch_array($query)) {
						if ($data["autor"] == 0) {
							$autor = 'Anonimo';
						}else{
							$autor = $data["autor"];
						}
                   
 			?>
		
			<tr>
				<td><?php echo $data["cota"] ;?></td>
				<td><?php echo $data["nombre_libro"] ;?></td>
				<td><?php echo $data["autor"] ;?></td>
				<td><?php echo $data["año_libro"] ;?></td>
				<td><?php echo $data["n_ejemplar"] ;?></td>
				<td><?php echo $data["carrera"] ;?></td>

				<td>
					<a class="link_edit" href="agregar_prestamo.php?cota=<?php echo $data["cota"];?>"><i class="far fa-edit"></i> prestamo </a>
					|
					<a class="link_edit" href="editar_libros.php?id=<?php echo $data["cota"];?>"><i class="far fa-edit"></i> editar </a>
					<?php if($_SESSION['rol'] == 1){

					 ?>
					|
					<a class="link_delete" href="eliminar_libros.php?id=<?php echo $data["cota"];?>"><i class="far fa-trash-alt"></i> eliminar</a>
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