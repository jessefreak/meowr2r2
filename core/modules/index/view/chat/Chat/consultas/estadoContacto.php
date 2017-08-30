 <?php
	if(isset($_POST['verificarContacto'])){
		session_start();
		require_once('../funciones/funciones.php');
		require_once('../funciones/conexion.php');
		$numOnline=0;
		$numOnline2=0;
		$idsOnline=[];
		$idsOffline=[];
		$idsOn=[];
		$idsOff=[];
		if($_SESSION['preguntar']==true){
			$sql1="select contacto,online from contactos inner join usuarios on usuarios.id=contactos.contacto  where contactos.usuario=$_SESSION[id] and online=1";
			$error1="<div class='error'>Error al seleccionar los contactos on</div>";		
			$contactos=consulta($con,$sql1,$error1);
			$numOnline=mysqli_num_rows($contactos);
			if($numOnline>0){
				while($contacto=mysqli_fetch_assoc($contactos)){
					$idsOnline[]=$contacto['contacto'];
				}
			}
			if($_SESSION['numContactos2']!=0){
				$sql2="select usuarios.id as usuarioId from contactos inner join usuarios on usuarios.id=contactos.usuario where contacto=$_SESSION[id] and online=1";
				$error2="<div class='error'>Error al seleccionar los contactos on segunda consulta</div>";
				$contactos2=consulta($con,$sql2,$error2);
				$numOnline2=mysqli_num_rows($contactos2);
				if($numOnline2!=0){
					while($contacto2=mysqli_fetch_assoc($contactos2)){
						$idsOnline[]=$contacto2['usuarioId'];		
					}
				}
			}
			$noContactosOn=$numOnline+$numOnline2;
			$sql1="select contacto from contactos inner join usuarios on usuarios.id=contactos.contacto where contactos.usuario=$_SESSION[id] and online=0";
			$error1="<div class='error'>Error al seleccionar los contactos</div>";		
			$contactos=consulta($con,$sql1,$error1);
			$numOffline=mysqli_num_rows($contactos);
			if($numOffline>0){
				while($contacto=mysqli_fetch_assoc($contactos)){
								$idsOffline[]=$contacto['contacto'];
				}
			}
			if($_SESSION['numContactos2']!=0){
				$sql2="select usuarios.id as usuarioId from contactos inner join usuarios on usuarios.id=contactos.usuario where contacto=$_SESSION[id] and online=0";
				$error2="<div class='error'>Error al seleccionar los contactos en segunda consulta</div>";
				$contactos2=consulta($con,$sql2,$error2);
				$numOffline2=mysqli_num_rows($contactos2);
				if($numOffline2>0){
					while($contacto2=mysqli_fetch_assoc($contactos2)){
									$idsOffline[]=$contacto2['usuarioId'];
					}
				}
			}
			$noContactosOff=$numOffline+$numOffline2;
			$_SESSION['preguntar']==true;
		}//session preguntar
		for($i=0;$i<count($idsOnline);$i++){
			if($i<count($idsOnline)-1){
				$caracter='||';
			}else{
				$caracter='';
			}
			echo $idsOnline[$i].$caracter;
		}
		echo "|||";
		for($i=0;$i<count($idsOffline);$i++){
			if($i<count($idsOffline)-1){
				$caracter='||';
			}else{
				$caracter='';
			}
			echo $idsOffline[$i].$caracter;
		}
	}else{
		echo"error ";
	}
?>