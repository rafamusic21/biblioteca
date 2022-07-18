<?php
    session_start();
	include "../conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "vista/includes/scripts.php";?>
	<title> Lista de libros prestados</title>
	<link rel="icon" href="vista/img/logo_1.ico">
	
</head>
<body>
<?php include "vista/includes/header.php"; ?>

<section id="container">
		<h1> <i class="fas fa-user-tie"></i> Lista de libros prestados</h1>
		<a href="lista_libros.php" class="btn_new"><i class="fas fa-address-book"></i> Agregar  prestamo</a>

		<form action="buscar_libro.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="buscar">
			<button type="submit" class="btn_search"><i class="fas fa-search"></i></button>
		</form>
		<table>
			<tr>
				<th>Cota</th>
				<th>fecha</th>
				<th>hora</th>
				<th>estudainte</th>
                <th>cedula</th>
				<th>fecha de entrega</th>
				
			</tr>
			<?php 

				//paginador
				$sql_register =  mysqli_query($conection, "SELECT count(*)  as total_registro FROM retiro_libros WHERE status = 1");
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




				$query =  mysqli_query($conection,"SELECT * FROM retiro_libros  WHERE status = 1 
				ORDER BY id ASC
				LIMIT $desde, $por_pagina");
				mysqli_close($conection);
				$result = mysqli_num_rows($query);

				if($result > 0){

					while ($data = mysqli_fetch_array($query)) {
						
                   
 			?>
		
			<tr>
				<td><?php echo $data["cota"] ;?></td>
				<td><?php echo $data["fecha_retiro"] ;?></td>
				<td><?php echo $data["hora_retiro"] ;?></td>
				<td><?php echo $data["nombre"] ;?></td>
				<td><?php echo $data["cedula"] ;?></td>
				<td><?php echo $data["fecha_entrega"] ;?></td>
			
			</tr>
			<?php 

				}
			}

			?>

		</table>

		<div class="paginador">
			<ul>

			<?php
				if ($pagina !=1) {
			?>
				<li><a href="?pagina=<?php echo 1; ?>"> |< </a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>"> << </a></li>
			<?php
				}
				for($i = 1; $i <= $total_paginas; $i++){

					if($i == $pagina){
						
						echo '<li class"pageSelected"> '. $i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'"> '. $i.'</a></li>';
					}
					


				}
				if ($pagina != $total_paginas) {
				
  			?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>"> >> </a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?>"> >| </a></li>
				<?php 
				  } ?>
			</ul>
		</div>

	</section>


<?php include "vista/includes/footer.php";?>
</body>
</html>