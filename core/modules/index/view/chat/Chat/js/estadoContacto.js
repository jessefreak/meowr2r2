// JavaScript Document
actividadContacto=document.getElementsByClassName('actividadContacto');
setInterval('crearConexion4()',1000);
function crearConexion4(){
	var datos='verificarContacto='+encodeURIComponent(true);	
	conexion4=crearXMLHttpRequest();
	conexion4.onreadystatechange=mostrarEstadoContacto;
	conexion4.open('POST','consultas/estadoContacto.php',true);
	conexion4.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	conexion4.send(datos);
}
function mostrarEstadoContacto(){
	if(conexion4.readyState==4){
		var idsOnOff=conexion4.responseText.split("|||");
		var idsOn=idsOnOff[0].split('||');
		var idsOff=idsOnOff[1].split('||');
		for(var i=0;i<actividadContacto.length;i++){
			var idContacto=actividadContacto[i].className.split(' ');	
			for(var f=0;f<idsOn.length;f++){
				id=idsOn[f].split(' ').join('');//quitar espacios en blanco
				if(idContacto[3]==id){
					//actividadContacto[i].className='actividadContacto alinear-horizontal fondoVerde-1 '+idContacto[3];
					actividadContacto[i].style.backgroundImage='url(img/activo.jpg)';
				}
			}
			for(var c=0;c<idsOff.length;c++){
				if(idContacto[3]==idsOff[c]){
					//actividadContacto[i].className='actividadContacto alinear-horizontal fondo-rojo '+idContacto[3];
					actividadContacto[i].style.backgroundImage='url(img/inactivo.jpg)';
				}
			}
		}
	}
}// JavaScript Document