<?php
session_start();
	if(isset($_SESSION['usuario']) && isset($_SESSION['id'])){
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
        	<header>
            	<?php
                	require_once("header/header.php");
				?>
            </header>
            <div class="contenedorTablaResultados centrarDiv">
				<table class="tabla">
            		<tr><th>Usuarios</th></tr>
			<?php
				require_once('funciones/conexion.php');
				require_once('funciones/funciones.php');
				if(isset($_POST['buscar'])){
					$busqueda=limpiar($con,$_POST['busqueda']);
					$sql="select * from usuarios where usuario like '%$busqueda%'";
					$error="<div class='error'>Error al buscar usuarios</div>";
					$usuarios=consulta($con,$sql,$error);
					$numUsuarios=mysqli_num_rows($usuarios);
					if($numUsuarios==0){
						echo"<div class='mensajeAviso'>No se encontraron resultados con su busqueda <strong>$busqueda</strong></div>";
					}else{
						while($usuario=mysqli_fetch_assoc($usuarios)){
							$sql2="select * from contactos where (usuario='$_SESSION[id]' and contacto='$usuario[id]') or (usuario='$usuario[id]' and contacto='$_SESSION[id]')";
							$error2="<div class='error'>Error al comprobar los contactos</div>";
							$contacto=consulta($con,$sql2,$error2);
							$noResultados=mysqli_num_rows($contacto);
							if($noResultados>0){
								echo"<tr><td class='cursorPointer'>$usuario[usuario]</td></tr>";
							}else{
								$agregar=encriptar("agregar contacto");
								echo"<tr><td class='cursorPointer'><a href='agregar_contactos.php?agregar=$agregar&id=$usuario[id]'>$usuario[usuario]</a></td></tr>";						
							}
						}
					}//numUsuarios==0
				}else if(isset($_GET['agregar'])){
					$mensaje=encriptar("agregar contacto");
					$id=limpiar($con,$_GET['id']);
					if($_GET['agregar']==$mensaje){ 
						$sql="select * from solicitudes where id=$_SESSION[id] and solicitud=$id";
						$error="<div class='error'>Error al comprobar el envio de solicitud</div>";
						$solicitudes=consulta($con,$sql,$error);	
						$numSolicitudes=mysqli_num_rows($solicitudes);
						if($numSolicitudes>0){
							 echo"<div class='error'>Su soicitud ya ha sido envia</div>";
						}else{
							$sql="insert into solicitudes (usuario,solicitud) values ($_SESSION[id],$id)";
							$error="<div class='error'>Error al buscar usuarios</div>";
							$solicitud=consulta($con,$sql,$error);			
							if($solicitud){
								 echo"<div class='correcto'>Su soicitud ha sido envia</div>";
							}else{
								echo"<div class='error'>Error al enviar la soliciutud</div>";
							}//$solicitud
						}
					}//$_GET[agregar]
				}else{
					echo"<div class='error'>Sin ninguna peticion</div>";
				}//operaciones buscar y agregar contacto
		 ?>
         	</table><!---tabla-->
         </div><!--contenedorTablaReultados-->
 		</div><!--contenedorPrincipal-->
	</body>
</html>
<?php
	}else{
		echo"<h1>Zona disponible solo para usuarios registrados</h1><a href='login.php'>Login</a>";
	}//isset($_SESSION[usuario]) isset($_SESSION[id])
?>

