<?php
	session_start();
	require_once('funciones/funciones.php');
	require_once('funciones/conexion.php');
	if(isset($_SESSION['id']) && isset($_SESSION['usuario'])){
		$sql="update usuarios set online=0 where id='$_SESSION[id]'";
		$error="<div class='error'>Error al modificar el estado del usuario</div>";
		$buscar=consulta($con,$sql,$error);
		if($buscar){
			session_destroy();
			header('location:login.php');
		}else{
			echo "<div class='error'>Error al cerrar la sesion</div>";
		}
	}else{
		echo"<div class='error'>No existe peticion</div>";	
	}
?>