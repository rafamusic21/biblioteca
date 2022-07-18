<?php 
session_start();
	if($_SESSION['rol'] != 1) {
		header("location: ./");
	}
	include "../conexion.php";


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>lista de libros</title>
	<?php include "vista/includes/scripts.php";?>
	
</head>
<body>
	<?php include "vista/includes/header.php";?>
	<section id="container">

		<?php 

		$busqueda = strtolower($_REQUEST['busqueda']);
		if (empty($busqueda)) {
			header("location: lista_libros.php");
			mysqli_close($conection);
		}


		 ?>
		<h1><i class="fas fa-users"></i> Lista de libros</h1>
		<a href="registro_libros.php" class="btn_new">Crear Libro</a>

		<form action="buscar_libros.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="buscar" value="<?php echo $busqueda; ?>">
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
			$carrera = '';
			if($busqueda == 'PNF INFORMATICA'){

				$carrera = "OR carrera LIKE '%1%'";

			}else if($busqueda == 'PNF CONSTRUCCION CIVIL'){

				$carrera = "OR carrera LIKE '%2%'";

			}else if($busqueda == 'PNF MECANICA'){

				$carrera = "OR carrera LIKE '%3%'";

			}else if($busqueda == 'PNF PROSESAMIENTO DE ALIMENTOS'){

				$carrera = "OR carrera LIKE '%4%'";

			}else if($busqueda == 'PNF ELECTRONICA'){

				$carrera = "OR carrera LIKE '%5%'";

			}else if($busqueda == 'PNF PROSESAMIENTO DE ALIMENTOS'){

				$carrera = "OR carrera LIKE '%6%'";

			}else if($busqueda == 'PNF AGROALIMENTACION'){

				$carrera = "OR carrera LIKE '%7%'";

			}

			$sql_register =  mysqli_query($conection, "SELECT count(*) as total_registro FROM libros 
															WHERE ( cota LIKE '%$busqueda%' OR 
																	nombre_libro LIKE '%$busqueda%' OR 
																	autor LIKE '%$busqueda%' OR 
																	año_libro LIKE '%$busqueda%'
																	$carrera ) 
															AND status = 1;");
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




			$query =  mysqli_query($conection,"SELECT l.cota, l.nombre_libro, l.autor, l.año_libro, l.n_ejemplar, c.nom_carrera FROM libros l INNER JOIN carrera c ON l.carrera = c.idcarrera 
										WHERE ( l.cota LIKE '%$busqueda%' OR 
												l.nombre_libro LIKE '%$busqueda%' OR 
												l.autor LIKE '%$busqueda%' OR 
												l.año_libro LIKE '%$busqueda%' OR
												c.nom_carrera  LIKE '%$busqueda%')  

										AND status = 1 ORDER BY l.cota ASC LIMIT $desde, $por_pagina");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					
			 ?>
			<tr>
				<td><?php echo $data["cota"] ;?></td>
				<td><?php echo $data["nombre_libro"]; ?></td>
				<td><?php echo $data["autor"] ;?></td>
				<td><?php echo $data["año_libro"] ;?></td>
                <td><?php echo $data["n_ejemplar"] ;?></td>
				<td><?php echo $data["nom_carrera"] ;?></td>
				<td>
                    <a class="link_edit" href="agregar_prestamo.php?cota=<?php echo $data["cota"];?>"><i class="far fa-edit"></i> prestamo </a>
					|
					<a class="link_edit" href="editar_libros.php?id=<?php echo $data["cota"];?>"><i class="far fa-edit"></i> editar </a>

					|
					<a class="link_delete" href="eliminar_libros.php?id=<?php echo $data["cota"];?>"><i class="far fa-trash-alt"></i> eliminar</a>

					
				</td>
			</tr>
			<?php 

				}
			}

			?>

		</table>
		<?php 
			if($total_registro != 0){


			
		 ?>
		<div class="paginador">
			<ul>

				<?php 
					if ($pagina !=1) {
				
				 ?>
				<li><a href="?pagina=<?php echo 1; ?>&busqueda=<?php echo $busqueda; ?>"><i class="fas fa-step-backward"></i></a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>&busqueda=<?php echo $busqueda; ?>"><i class="fas fa-caret-left "></i></a></li>
					<?php 
					  }
						for ($i=1; $i <= $total_paginas; $i++) { 
							
							if ($i == $pagina ) {
								echo '<li class="pageSelected">'.$i.'</li>';
							}else{
								echo '<li><a href="?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
							}
							
						}

						if ($pagina != $total_paginas) {
				
					 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>&busqueda=<?php echo $busqueda; ?>"><i class="fas fa-caret-right "></i></a></li>	
				<li><a href="?pagina=<?php echo $total_paginas; ?>&busqueda=<?php echo $busqueda; ?>"><i class="fas fa-step-forward"></i></a></li>
				<?php 
				  } ?>
			</ul>
		</div>
	<?php  } ?>
	</section>
	<?php include "vista/includes/footer.php";?>
	
</body>
</html>