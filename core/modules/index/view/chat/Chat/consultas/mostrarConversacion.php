<?php
	session_start();
		require_once('../funciones/funciones.php');
		require_once('../funciones/conexion.php');
		$idUsuario=$_SESSION['id'];
		$idContacto=limpiar($con,$_POST['idContacto']);
		$sql="select id from contactos where usuario='$idContacto' or contacto='$idContacto'";
		$error="<div class='error borde-5'>Error al verificar el contacto</div>";
		$verificar=consulta($con,$sql,$error);
		$numero=mysqli_num_rows($verificar);
		if($numero==0){
			echo"error";
		}else{
			$sql="select *, usuarios.usuario as usuario from mensajesChat inner join usuarios on usuarios.id=mensajesChat.usuario where (mensajesChat.usuario='".$idContacto."' and  mensajesChat.contacto='".$idUsuario."') or (mensajesChat.usuario='".$idUsuario."' and mensajesChat.contacto='".$idContacto."') order by mensajesChat.id";
			$error="<div class='error borde-5'>Error al seleccionar los mensajes</div>";
			$mensajesUsuario=consulta($con,$sql,$error);
			$noMensajesUsuario=mysqli_num_rows($mensajesUsuario);
			$_SESSION['conversacionAnterior']=$noMensajesUsuario;
			if($noMensajesUsuario>0){
				while($mensajeUsuario=mysqli_fetch_assoc($mensajesUsuario)){
					  echo"<div class='mensajeConversacion borde-5'><div class='divUsuario borde-5 alinear-horizontal'>$mensajeUsuario[usuario]:</div><div class='divMensaje borde-5 alinear-horizontal'>$mensajeUsuario[mensaje]</div></div>";
				}
			}else{
				echo"<div class='mensajeAviso borde-5 letraNegrita borderBox'>Aun no hay una conversacion</div>";
			}
		}
?>