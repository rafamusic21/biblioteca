<?php 

	$alert = '';
	session_start();
if(!empty($_SESSION['active']))
{

	header('location: sistema/');
}
else
{
	if(!empty($_POST))
	{

		if (empty($_POST['usuario']) || empty($_POST['clave'])) 
		{
			$alert = 'Ingrese usuario y contraseña';
		}else{
			require_once "conexion.php";

			$user = mysqli_real_escape_string($conection,$_POST['usuario']);
			$pass = md5(mysqli_real_escape_string($conection,$_POST['clave']));

			$query = mysqli_query($conection, "SELECT u.idusuario,u.nombre_u,u.correo, u.usuario, r.idrol, r.rol 
				FROM usuarios u
				INNER JOIN rol r
				ON u.rol = r.idrol
				WHERE u.usuario = '$user' AND u.clave = '$pass'");	
			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			if($result > 0){
				$data = mysqli_fetch_array($query);
				
				$_SESSION['active'] = true;
				$_SESSION['idUser'] = $data['idusuario'];
				$_SESSION['nombre'] = $data['nombre_u'];
				$_SESSION['email']  = $data['correo'];
				$_SESSION['user']   = $data['usuario'];
				$_SESSION['rol'] 	= $data['idrol'];
				$_SESSION['rol_name'] 	= $data['rol'];

				header('location: sistema/');
			}else{
				$alert = 'usuario o clave incorrectos';
				session_destroy();
			}
		}
	}
}
 ?>