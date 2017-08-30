<?php
	if(isset($_POST['verificarConversacion'])){
		session_start();
		require_once('../funciones/funciones.php');
		require_once('../funciones/conexion.php');
		$idUsuario=limpiar($con,$_POST['idUsuario']);
		$idContacto=limpiar($con,$_POST['idContacto']);
		$sql="select usuario from mensajesChat  where (usuario='".$idContacto."' and contacto='".$idUsuario."') or (usuario='".$idUsuario."' and contacto='".$idContacto."') order by mensajesChat.id";
		$error="<div class='error borde-5'>Error al consultar la conversacion</div>";
		$conversacion=consulta($con,$sql,$error);
		$conversacionActual=mysqli_num_rows($conversacion);
		if($_SESSION['conversacionAnterior']<$conversacionActual){
			echo "true";
		}else{
			echo "false";
		}
	}else{
		echo"error ";
	}
?>