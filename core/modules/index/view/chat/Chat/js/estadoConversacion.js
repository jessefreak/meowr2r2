// JavaScript Document
function crearConexion3(){
	var idContacto=document.getElementById('idContacto').value;
	var datos='verificarConversacion='+encodeURIComponent(true)+'&idContacto='+encodeURIComponent(idContacto);
	conexion3=crearXMLHttpRequest();
	conexion3.onreadystatechange=mostrarEstadoConversacion;
	conexion3.open('POST','consultas/estadoConversacion.php',true);
	conexion3.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	conexion3.send(datos);
}
function mostrarEstadoConversacion(){
	if(conexion3.readyState==4){
		if(conexion3.responseText=='true'){
			recogerValores();
		}
	}
}
