<a href="usuario.php"><div class='titulo alinear-horizontal letraBlanca'>Chat</div></a>
<form action="agregar_contactos.php" method="post" name="buscar" id="buscar" class="formBuscar alinear-horizontal">
	<input type="search" name="busqueda" id="busqueda" placeholder="Ingrese el nombre del usuario" class="busqueda borde-5">
    <input type="submit" name="buscar" id="buscar" value="Buscar" class="buscar borde-5 cursorPointer letraBlanca letraNegrita">
</form>
<div class="usuario alinear-horizontal">
	<?php
		if(isset($_SESSION['usuario']) && isset($_SESSION['id'])){
			echo"<div class='cerrarSesion alinear-horizontal'><a href='cerrarSesion.php'>Cerrar</a></div> <div class='nombreUsuario letraBlanca alinear-horizontal borde-5'>$_SESSION[usuario]</div><div class='actividad alinear-horizontal' id='actividad'></div>";
		}else{
			echo"<div class='linkRegistrarse centrarTexto borde-5'><a href='registrar.php' style='color:white;'>Registrar</a></div>";
		}
	?>
</div>