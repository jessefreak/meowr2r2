// JavaScript Document
agregarEvento(window,'load',crearConexion2,false);
function crearConexion2(){
	conexion2=crearXMLHttpRequest();
	conexion2.onreadystatechange=mostrarEstado;
	conexion2.open('POST','estadoUsuario.php',true);
	conexion2.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	conexion2.send(null);
}
function mostrarEstado(){
	if(conexion2.readyState==4){
		var actividad=document.getElementById('actividad');	
		if(conexion2.responseText=='1'){
			//actividad.className='actividad alinear-horizontal fondoVerde-1';
			actividad.style.backgroundImage='url(img/activo.jpg)';
		}else if(conexion2.responseText=='0'){
			//actividad.className='actvidad alinear-horizontal fondo-rojo';
			actividad.style.backgroundImage='url(img/inactivo.jpg)';
		}else{
		}
	}else{
		
	}
}