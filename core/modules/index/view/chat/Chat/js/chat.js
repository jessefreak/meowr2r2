// JavaScript Document
agregarEvento(window,'load',iniciarChat,false);
function iniciarChat(){
	var enviar=document.getElementById('enviar');
	mensajesAjax=document.getElementById('mensajesAjax');
	mensajesAjax2=document.getElementById('mensajesAjax2');
	conversacion=document.getElementById('conversacion');
	agregarEvento(enviar,'click',recogerValores,false);
	t=setInterval('crearConexion3()',1000);
	recogerValores();
}
function recogerValores(e,peticion){
	if(e){
		e.preventDefault();
		id=e.target.id;
	}else if(window.event){
		window.event.returnValue=false;
		id=window.event.srcElement.id;
	}
	if(id=='enviar'){
		var mensaje=document.getElementById('mensaje').value;
		var idContacto=document.getElementById('idContacto').value;
		var datos='enviar='+encodeURIComponent(true)+'&mensaje='+encodeURIComponent(mensaje)+'&idContacto='+encodeURIComponent(idContacto);
		var accion='guardar';
		var url='consultas/guardarMensajes.php';
	}else{
		var idContacto=document.getElementById('idContacto').value;
		var datos='chat='+encodeURIComponent(true)+'&idContacto='+encodeURIComponent(idContacto);
		var accion='mostrar';
		var url='consultas/mostrarConversacion.php';
	}
	crearConexionPost(datos,accion,url);
}
function crearConexionPost(datos,accion,url){
	conexion=crearXMLHttpRequest();
	if(accion=='guardar'){
		conexion.onreadystatechange=guardarMensaje;
	}else if(accion=='mostrar'){
		conexion.onreadystatechange=mostrarMensajes;
	}else{
		alert('Sin accion');
	}
	conexion.open('POST',url,true);
	conexion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	conexion.send(datos);
}
function guardarMensaje(){
	if(conexion.readyState==4){
			mensajesAjax2.innerHTML=conexion.responseText;
			var mensaje=document.getElementById('mensaje').value='';
			recogerValores();
	}else{
		mensajesAjax2.innerHTML='<div class="mensajeAviso letraNegrita">Enviando...</div>';
	}
}
function mostrarMensajes(){
	if(conexion.readyState==4){
		mensajesAjax.innerHTML='';
		if(conexion.responseText=='error'){
			mensajesAjax.innerHTML='<div class="error">El contacto no existe</div>';	
		}else{
			conversacion.innerHTML=conexion.responseText+'<span id="src"></span>';
			var src=document.getElementById('src').scrollIntoView(true);//mandar el scroll hacia abajo
		}	
	}else{
		mensajesAjax.innerHTML='<div class="mensajeAviso letraNegrita borde-5">Cargando conversacion...</div>';
	}
}
