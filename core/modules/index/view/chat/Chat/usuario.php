<?php
	session_start();
	if(isset($_SESSION['usuario']) && isset($_SESSION['id'])){
		require_once('funciones/funciones.php');
		require_once('funciones/conexion.php');
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $_SESSION['usuario'];?></title>
		<link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/chat.css">
		<script src="js/funciones.js"></script>
    	<script src="js/estadoUsuario.js"></script>
    </head>
	<body>
		<div class="contenedorPrincipal">
        	<header class="borderBox>
            	<?php
                	require_once("header/header.php");
				?>
            </header>
            <div class="espacioUsuario centrarDiv borde-5 borderBox">
        		<?php
					require_once('funciones/funciones.php');
					if(isset($_POST['confirmarSolicitud'])){
						$id=limpiar($con,$_POST['id']);
						$fecha=date("Y/m/d H:i:s");
						$sql="select * from contactos where usuario=$_SESSION[id] and contacto=$id	";
						$error="<div class='error'>Error al verificar el contacto</div>";
						$contactos=consulta($con,$sql,$error);
						$numContactos=mysqli_num_rows($contactos);
						if($numContactos==0){
							$sql="insert into contactos (usuario,contacto,fecha) values ($_SESSION[id],$id,'$fecha')";
							$error="<div class='error'>Error al registrar el contacto</div>";
							$registrar=consulta($con,$sql,$error);
							if(!$registrar){
								echo"<div class='error'>Error al registrar el usuario</div>";
							}else{
								$sql="delete from solicitudes where usuario=$id and solicitud=$_SESSION[id]";
								$error="<div class='error'>Error al verificar el contacto</div>";
								$contactos=consulta($con,$sql,$error);
								echo"<div class='correcto'>Contacto agregado correctamente</div>";
							}
						}else{
							echo"<div class='error'>Contacto ya registrado</div>";
						}
					}//confimar solicitud
					$sql="select * from contactos where usuario=$_SESSION[id] or contacto=$_SESSION[id]";
					$error="<div class='error'>Error al seleccionar las solicitudes</div>";
					$contactos=consulta($con,$sql,$error);
					$numContactos=mysqli_num_rows($contactos);
				?>
                <div class="noContactos alinear-horizontal borde-5 borderBox">
                	<a href='contactos.php'>Contactos:<?php echo $numContactos;?></a>
            	</div>
				<div class="noSolicitudes alinear-horizontal borde-5 borderBox">
				<?php
					$sql="select usuarios.id as usuariosId, usuarios.usuario as usuario, solicitudes.id as solicitudesId, solicitudes.usuario as solicitudesUsuario from solicitudes inner join usuarios on solicitudes.usuario=usuarios.id where solicitud='$_SESSION[id]'";
					$error="<div class='error'>Error al seleccionar las solicitudes</div>";
					$solicitudes=consulta($con,$sql,$error);
					$numSolicitudes=mysqli_num_rows($solicitudes);
					if($numSolicitudes>0){
						$fondo='fondoVerde-1';
					}else{
						$fondo='';
					}
					echo '<div class="alinear-horizontal">Solicitudes:</div><div class="divSolicitudes centrarTexto alinear-horizontal '.$fondo.'">'.$numSolicitudes.'</div><br>';
					if($numSolicitudes>0){
						echo 'Estos usuarios te enviaron solicitud:<br>';
					}
					while($solicitud=mysqli_fetch_assoc($solicitudes)){
						echo  '<form action="'.$_SERVER['PHP_SELF'].'" method="post" name="formConfirmar" id="formConfirmar" class="formConfirmar borde-5"><input type="hidden" name="id" value="'.$solicitud['solicitudesUsuario'].'"><div class="labelFormConfirmar  alinear-horizontal"><label>'.$solicitud['usuario'],'</label></div><div class="botonFormConfirmar alinear-horizontal"><input type="submit" name="confirmarSolicitud" id="confirmarSolicitud" value="Confirmar"></div></form>';
					}
				?>
                </div><!--noSolicitudes-->
            </div><!--espacioUsuario-->
        </div><!--contenedorPrincipal-->
	</body>
</html>
<?php
	}else{
		echo"<h1>Zona disponible solo para usuarios registrados</h1><a href='login.php'>Login</a>";
	}
?>