<?php
	session_start();
	if(isset($_SESSION['usuario']) && isset($_SESSION['id'])){
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Contactos</title>        
		<link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/chat.css">
		<script src="js/funciones.js"></script>
    	<script src="js/estadoUsuario.js"></script>
        <script src="js/estadoContacto.js"></script>
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
                    	<tr><th colspan="2">Contactos</th></tr>
			<?php
				require_once('funciones/funciones.php');
				require_once('funciones/conexion.php');
            	$numContactos1=0;
				$numContactos2=0;
				$sql1="select contacto,contactos.usuario as contactosUsuario, usuarios.id as usuarioId, usuarios.usuario as usuario,online from contactos inner join usuarios on usuarios.id=contactos.contacto where contactos.usuario=$_SESSION[id]";
				$error1="<div class='error'>Error al seleccionar los contactos</div>";		
				$contactos1=consulta($con,$sql1,$error1);
				$numContactos1=mysqli_num_rows($contactos1);
				if($numContactos1!=0){
					while($contacto1=mysqli_fetch_assoc($contactos1)){
						if($contacto1['online']==1){
							$fondo='fondoVerde-1';
						}else{
							$fondo='fondo-rojo';
						}
						echo"<tr><td><a href='chat.php?id=$contacto1[usuarioId]'>$contacto1[usuario]</a></td><td><div class='actividadContacto alinear-horizontal $fondo $contacto1[usuarioId]' id='actividad'></div></td></tr>";
					}
				}
				$sql2="select contacto,contactos.usuario as contactosUsuario, usuarios.id as usuarioId, usuarios.usuario as usuario,online from contactos inner join usuarios on usuarios.id=contactos.usuario where contacto=$_SESSION[id]";
				$error2="<div class='error'>Error al seleccionar los contactos</div>";
				$contactos2=consulta($con,$sql2,$error2);
				$numContactos2=mysqli_num_rows($contactos2);
				if($numContactos2!=0){
					while($contacto2=mysqli_fetch_assoc($contactos2)){
						if($contacto2['online']==1){
							$fondo='fondoVerde-1';
						}else{
							$fondo='fondo-rojo';
						}
						echo"<tr><td><a href='chat.php?id=$contacto2[usuarioId]'>$contacto2[usuario]</a></td><td><div class='actividadContacto alinear-horizontal $fondo $contacto2[usuarioId]' id='actividad'></div></td></tr>";
					}
				}
				$_SESSION['numContactos2']=$numContactos2;
				$_SESSION['preguntar']=true;
				if($numContactos1==0 && $numContactos2==0){
					echo"<div class='mensajeAviso'>Aun no tiene contactos</div>";	
				}
			?>
            	</table>
        	</div><!--tablaResultados-->
        </div>
    </body>
</html>
<?php
	}else{
		echo"<h1>Zona disponible solo para usuarios registrados</h1><a href='login.php'>Login</a>";
	}
?>
