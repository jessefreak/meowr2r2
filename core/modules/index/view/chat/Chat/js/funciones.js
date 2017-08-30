// JavaScript Document
function agregarEvento(elemento,evento,funcion,captura){
	if(elemento.addEventListener){
		elemento.addEventListener(evento,funcion,captura);
	}else if(elemento.attachEvent){
		elemento.attachEvent('on'+evento,funcion);
	}else{
		alert('Error al agregar el evento');
	}
}
function crearXMLHttpRequest(){
	if(window.XMLHttpRequest){
		xmlHttp=new XMLHttpRequest();
	}else if(window.activeXObject){
		xmlHttp=new activeXObject('Microsoft.XMLHTTP');
	}else{
		alert('Error ajax');
	}
	return xmlHttp;
}