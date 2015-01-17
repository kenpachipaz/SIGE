function mostrarSeccion(seccion){
	switch(seccion){
		case 0:
			document.getElementById('consulta').style.display= 'block';
			document.getElementById('imprimir').style.display= 'none';
		break;
		case 1:
			document.getElementById('consulta').style.display= 'none';
			document.getElementById('imprimir').style.display= 'block';
		break;
		case 2:
			document.getElementById('consulta').style.display= 'block';
			document.getElementById('registro').style.display= 'none';
		break;
		case 3:
			document.getElementById('registro').style.display= 'block';
			document.getElementById('consulta').style.display= 'none';
		break;
	}
}