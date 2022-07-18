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
			header("location: lista_estudiantes.php");
			mysqli_close($conection);
		}


		 ?>
		<h1><i class="fas fa-users"></i> Lista de estudiantes</h1>
		<a href="registro_estudiante.php" class="btn_new">Crear estudiantes</a>

		<form action="buscar_estudiante.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="buscar" value="<?php echo $busqueda; ?>">
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

			$sql_register =  mysqli_query($conection, "SELECT count(*) as total_registro FROM inf_estudiante
															WHERE ( id LIKE '%$busqueda%' OR 
																	cedula LIKE '%$busqueda%' OR 
																	nombre LIKE '%$busqueda%' OR 
																	apellido LIKE '%$busqueda%' OR
                                                                    numero LIKE '%$busqueda%'
																	$carrera ) 
															AND status = 1");
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




			$query =  mysqli_query($conection,"SELECT e.id, e.cedula, e.nombre, e.apellido, e.numero, c.nom_carrera FROM inf_estudiante e INNER JOIN carrera c ON e.carrera = c.idcarrera 
										WHERE ( e.id LIKE '%$busqueda%' OR 
												e.cedula LIKE '%$busqueda%' OR 
												e.nombre LIKE '%$busqueda%' OR 
												e.apellido LIKE '%$busqueda%' OR
                                                e.numero LIKE '%$busqueda%' OR
												c.nom_carrera  LIKE '%$busqueda%')  

										AND status = 1 ORDER BY e.id ASC LIMIT $desde, $por_pagina");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					
			 ?>
			<tr>
				<td><?php echo $data["id"] ;?></td>
				<td><?php echo $data["cedula"]; ?></td>
				<td><?php echo $data["nombre"] ;?></td>
				<td><?php echo $data["apellido"] ;?></td>
                <td><?php echo $data["numero"] ;?></td>
				<td><?php echo $data["nom_carrera"] ;?></td>
				<td>
                    
					<a class="link_edit" href="editar_libros.php?id=<?php echo $data["id"];?>"><i class="far fa-edit"></i> editar </a>

					|
					<a class="link_delete" href="eliminar_libros.php?id=<?php echo $data["id"];?>"><i class="far fa-trash-alt"></i> eliminar</a>

					
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