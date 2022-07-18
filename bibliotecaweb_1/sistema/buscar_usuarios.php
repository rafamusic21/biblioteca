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
	<title>lista de usuarios</title>
	<?php include "vista/includes/scripts.php";?>
	
</head>
<body>
	<?php include "vista/includes/header.php";?>
	<section id="container">

		<?php 

		$busqueda = strtolower($_REQUEST['busqueda']);
		if (empty($busqueda)) {
			header("location: lista_usuarios.php");
			mysqli_close($conection);
		}


		 ?>
		<h1><i class="fas fa-users"></i> Lista de usuarios</h1>
		<a href="registro_usuario.php" class="btn_new">Crear Usuario</a>

		<form action="buscar_usuarios.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="buscar" value="<?php echo $busqueda; ?>">
			<button type="submit" class="btn_search"><i class="fas fa-search"></i></button>
		</form>
		<table>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Correo</th>
				<th>Usuario</th>
				<th>Rol</th>
				<th>Acciones</th>
			</tr>
			<?php 

			//paginador
			$rol = '';
			if($busqueda == 'administrador'){

				$rol = "OR rol LIKE '%1%'";

			}else if($busqueda == 'colavorador'){

				$rol = "OR rol LIKE '%2%'";

			}else if($busqueda == 'lector'){

				$rol = "OR rol LIKE '%3%'";
			}

			$sql_register =  mysqli_query($conection, "SELECT count(*) as total_registro FROM usuarios 
															WHERE ( idusuario LIKE '%$busqueda%' OR 
																	nombre_u LIKE '%$busqueda%' OR 
																	correo LIKE '%$busqueda%' OR 
																	usuario LIKE '%$busqueda%'
																	$rol ) 
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




			$query =  mysqli_query($conection,"SELECT u.idusuario, u.nombre_u, u.correo, u.usuario, r.rol FROM usuarios u INNER JOIN rol r ON u.rol = r.idrol 
										WHERE ( u.idusuario LIKE '%$busqueda%' OR 
												u.nombre_u LIKE '%$busqueda%' OR 
												u.correo LIKE '%$busqueda%' OR 
												u.usuario LIKE '%$busqueda%' OR
												r.rol   LIKE '%$busqueda%')  

										AND status = 1 ORDER BY u.idusuario ASC LIMIT $desde, $por_pagina");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					
			 ?>
			<tr>
				<td><?php echo $data["idusuario"] ;?></td>
				<td><?php echo $data["nombre_u"]; ?></td>
				<td><?php echo $data["correo"] ;?></td>
				<td><?php echo $data["usuario"] ;?></td>
				<td><?php echo $data["rol"] ;?></td>
				<td>
					<a class="link_edit" href="editar_usuarios.php?id=<?php echo $data["idusuario"];?>"><i class="far fa-edit"></i> editar </a>

					<?php 
						if ($data["idusuario"] != 1) { ?>

					|
					<a class="link_delete" href="eliminar_usuarios.php?id=<?php echo $data["idusuario"];?>"><i class="far fa-trash-alt"></i> eliminar</a>

					<?php } ?>
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