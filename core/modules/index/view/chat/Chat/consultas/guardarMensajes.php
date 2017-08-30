<?php
	session_start();
	require_once('../funciones/funciones.php');
	require_once('../funciones/conexion.php');
	if(isset($_POST['enviar'])){
		$mensaje=limpiar($con,$_POST['mensaje']);
		$idUsuario=$_SESSION['id'];
		$idContacto=limpiar($con,$_POST['idContacto']);
		$fecha=date("Y/m/d");
		$hora=date("H:i:s");
		if($mensaje!=''){
			$sql="insert into mensajesChat (mensaje, usuario, contacto, fecha, hora) values ('$mensaje','$idUsuario','$idContacto','$fecha','$hora')";
			$error="<div class='error borde-5 letraNegrita'>Error al registrar el mensaje</div>";
			$registrar=consulta($con,$sql,$error);
			if($registrar==true){
				echo"<div class='correcto borde-5 letraNegrita'>Mensaje enviado</div>";
			}else{
				echo"<div class='error borde-5 letraNegrita'>Error al registrar el mensaje</div>";
			}
		}else{
			echo"<div class='mensajeAviso borde-5 letraNegrita'>Sin mensaje</div>";
		}
	}//isset($_POST[envar])
?>