<?php
	session_start();
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Registro de usuarios</title>
		<link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/chat.css">
    </head>
	<body>
		<div class="contenedorPrincipal">
        	<header>
            	<?php
					require_once("header/headerLogin.php");
                ?>
            </header>
        	<?php
				require_once('funciones/funciones.php');
            	if(isset($_POST['registrar'])){
					require_once('funciones/conexion.php');
					if(empty($_POST['usuario'])){
						echo"<div class='error'>Su usuario esta vacio</div>";
					}elseif(empty($_POST['password'])){
						echo"<div class='error'>Su contraseña esta vacia</div>";					
					}else{
						$usuario=limpiar($con,$_POST['usuario']);
						$password=limpiar($con,$_POST['password']);
						$password=encriptar($password);
						$sql="select usuario from usuarios where usuario='$usuario'";
						$error="<div class='error'>Error al comprobar el usuario</div>";
						$comprobar=consulta($con,$sql,$error);
						$numUsuarios=mysqli_num_rows($comprobar);
						if($numUsuarios!=0){
							echo"<div class='error'>El usuario que selecciono ya esta en uso</div>";
						}else{
							$sql="insert into usuarios (usuario,password,online) values ('$usuario','$password','0')";
							$error="<div class='error'>Error al registrar el usuario</div>";
							$registrar=consulta($con,$sql,$error);
							if($registrar==true){
								$mensaje="registro exitoso";
								$mensaje=encriptar($mensaje);
								header("location:login.php?mensaje=$mensaje");
							}else{
								echo"<div class='error'>Error al registrar el usuario</div>";
							}
						}
					}
				}
			?>
    		<form action="<?php $_SERVER['PHP_SELF']?>" method="post" id="formRegistrar" class="formRegistrar centrarDiv borde-5 borderBox letraNegrita">
				<label class="labelUsuario">Usuario:</label><input type="text" name="usuario"  id="usuario" placeholder="Ingrese su usuario"><br>
            	<label>Password:</label><input type="password" name="password"  id="password" placeholder="Ingrese su password">
            	<input type="submit" name="registrar"  id="registrar" value="Registrar" class="boton botonRegistrar letraBlanca letraNegrita borde-5 cursorPointer">
        	</form>
    	</div>
</body>
</html>