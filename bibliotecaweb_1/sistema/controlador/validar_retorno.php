<?php
session_start();
if($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2) {
    header("location: ./");
}
    include "../conexion.php";
if(!empty($_POST)){

    
    if(empty($_POST['cota']) || empty($_POST['ci'])){
        header("location: lista_libros.php");
    
        mysqli_close($conection);
    }
    $cota = $_POST['cota'];
    $ci = $_POST['ci'];
    $usuario_id = $_SESSION['idUser'];

    $query_retorno = mysqli_query($conection,"SELECT * FROM retiro_libros WHERE cedula = '$ci' AND cota = '$cota' AND status = 1");
    if(mysqli_num_rows($query_retorno) == 0){
        $alert ='<p class="msg_error">el libro ya fue debuelto</p>';
        mysqli_close($conection);
        }else{
        $data = mysqli_fetch_array($query_retorno);	
        $id = $data['id'];
        $id_estudiante = $data['id_estudiante_rl'];
        $nombre = $data['nombre'];


			

        $query_retiro = mysqli_query($conection,"INSERT INTO entrega_libro(cota, fecha_entrega, hora_entrega,id_estudiante_el,nombre,cedula, id_userCreador) values('$cota', CURDATE(), NOW(),'$id_estudiante','$nombre', '$ci','$usuario_id')");
       
        if($query_retiro){
            
            $query_libro = mysqli_query($conection,"SELECT n_ejemplar FROM libros WHERE cota = '$cota'");
			$data_libro = mysqli_fetch_array($query_libro);
			$n_libros = $data_libro['n_ejemplar'] + 1;
			
				$update = mysqli_query($conection,"UPDATE libros SET n_ejemplar = $n_libros WHERE cota = '$cota'");

             $query_delete = mysqli_query($conection,"UPDATE retiro_libros SET status = 0, id_userDeleted = $usuario_id WHERE cota = '$cota' AND cedula = '$ci'");
                 mysqli_close($conection);
                 if($query_delete){
			    header("location: lista_libros.php");
		        }else{
			    echo "error al retornar el libro";
		        }
        }else{
            echo "error al registrar el prestamo";
        }

       


    }
        
        
}


?>