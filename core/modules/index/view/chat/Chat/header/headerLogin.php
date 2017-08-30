<a href="usuario.php"><div class='titulo alinear-horizontal letraBlanca'>Chat</div></a>
<div class="usuario alinear-horizontal">
	<?php
		if(isset($_SESSION['usuario']) && isset($_SESSION['id'])){
			echo"<div class='cerrarSesion alinear-horizontal'><a href='cerrarSesion.php'>Cerrar</a></div> <div class='nombreUsuario letraBlanca alinear-horizontal borde-5'>$_SESSION[usuario]</div><div class='actividad alinear-horizontal' id='actividad'></div>";
		}else{
			echo"<a href='registrar.php' style='color:white;'><div class='linkRegistrarse centrarTexto borde-5 cursorPointer'>Registrar</div></a>";
			echo"<a href='login.php' style='color:white;'><div class='linkLogin centrarTexto borde-5 cursorPointer'>Login</div></a>";
		}
	?>
</div>