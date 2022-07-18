<?php 


if(empty($_SESSION['active']))
{

	header('location: ../');
}

 ?>
<header>
		<div class="header">
        <div class="logo">
			<img src="../vista/img/logoiut.png" alt="logo del iut">
			<h2 > Biblioteca Digital UPTAI </h2>
		</div>
       
			<div class="optionsBar">
				<p>Venezuela, <?php echo fechaC(); ?></p>
				<span>|</span>
				<span class="user"><?php echo $_SESSION['user'].' -'.$_SESSION['rol']; ?></span>
				<img class="photouser" src="vista/img/user.png" alt="Usuario" >
				<a href="salir.php"><i class="fa-light fa-power-off"></i></a>
			</div>
		</div>

		<?php include"nav.php" ;	?>

</header>