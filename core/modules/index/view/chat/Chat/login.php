<?php
	session_start();
?>
<!doctype html>
	<html>
		<head>
			<meta charset="utf-8">
			<title>Login</title>
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
            	if(isset($_POST['login'])){
					require_once('funciones/conexion.php');
					if(empty($_POST['usuario'])){
						echo"<div class='error centrarTexto centrarDiv'>Su usuario esta vacio</div>";
					}elseif(empty($_POST['password'])){
						echo"<div class='error centrarTexto centrarDiv'>Su contraseña esta vacia</div>";					
					}else{
						$usuario=limpiar($con,$_POST['usuario']);
						$password=limpiar($con,$_POST['password']);
						$password=encriptar($password);
						$sql="select * from usuarios where usuario='$usuario' and password='$password'";
						$error="<div class='error centrarTexto'>Error al seleccionar el usuario</div>";
						$buscar=consulta($con,$sql,$error);
						$numUsuarios=mysqli_num_rows($buscar);
						if($numUsuarios==0){
							echo"<div class='error centrarTexto centrarDiv'>Su usuario <strong>$usuario</strong> no existe o ha sido eliminado</div><br>";	
						}else if($numUsuarios>1){
								echo"<div class='error centrarTexto centrarDiv'>Error existen mas usuarios iguales</div>";
						}else{
							$usuario=mysqli_fetch_assoc($buscar);
							$_SESSION['usuario']=$usuario['usuario'];
							$_SESSION['id']=$usuario['id'];
							$sql="update usuarios set online='1' where id='$usuario[id]'";
							$error="<div class='error centrarTexto centrarDiv'>Error al modificar el estado del usuario</div>";
							$buscar=consulta($con,$sql,$error);
							header('location:usuario.php');
						}
					}
				}else if(isset($_GET['mensaje'])){
					$mensaje='registro exitoso';
					$mensaje=encriptar($mensaje);
					if($_GET['mensaje']==$mensaje){
						echo"<div class='mensajeAviso centrarTexto centrarDiv borde-5'>Su usuario ha sido registrado satisfactoriamente</div>";
					}else{
						header("location:login.php?registro=mensaje=$mensaje");
					}
				}
			?>
    		<form action="<?php $_SERVER['PHP_SELF']?>" method="post" id="formLogin" class="formLogin centrarDiv borderBox borde-5 letraBlanca letraNegrita">
				<label class="labelUsuario">Usuario:</label><input type="text" name="usuario"  id="usuario" placeholder="Ingrese su usuario"><br>
            	<label>Password:</label><input type="password" name="password"  id="password" placeholder="Ingrese su password">
            	<input type="submit" name="login"  id="login" value="Login" class="boton borde-5 cursorPointer botonLogin letraNegrita letraBlanca">
        	</form>
    	</div>
	</body>
</html>