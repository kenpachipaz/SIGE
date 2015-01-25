function mostrarSeccion(seccion){
	switch(seccion){
		case 0:
			document.getElementById('consulta').style.display= 'block';
			document.getElementById('imprimir').style.display= 'none';

			document.getElementById('textoI').style.background='#0B0364';
			document.getElementById('textoB').style.background='#B7EFF2';

			document.getElementById('textoI').style.color='white';
			document.getElementById('textoB').style.color='red';
		break;
		case 1:
			document.getElementById('consulta').style.display= 'none';
			document.getElementById('imprimir').style.display= 'block';

			document.getElementById('textoB').style.background='#0B0364';
			document.getElementById('textoI').style.background='#B7EFF2';

			document.getElementById('textoB').style.color='white';
			document.getElementById('textoI').style.color='red';
		break;
		case 2:
			document.getElementById('consulta').style.display= 'block';
			document.getElementById('registro').style.display= 'none';
			document.getElementById('movilidad').style.display= 'none';
			document.getElementById('redes').style.display= 'none';

			document.getElementById('textoElec').style.background='#0B0364';
			document.getElementById('textoMov').style.background='#0B0364';
			document.getElementById('textoRed').style.background='#0B0364';
			document.getElementById('textoBus').style.background='#B7EFF2';

			document.getElementById('textoElec').style.color='white';
			document.getElementById('textoMov').style.color='white';
			document.getElementById('textoRed').style.color='white';
			document.getElementById('textoBus').style.color='red';
		break;
		case 3:
			document.getElementById('registro').style.display= 'block';
			document.getElementById('consulta').style.display= 'none';
			document.getElementById('movilidad').style.display= 'none';
			document.getElementById('redes').style.display= 'none';

			document.getElementById('textoElec').style.background='#B7EFF2';
			document.getElementById('textoMov').style.background='#0B0364';
			document.getElementById('textoRed').style.background='#0B0364';
			document.getElementById('textoBus').style.background='#0B0364';

			document.getElementById('textoElec').style.color='red';
			document.getElementById('textoMov').style.color='white';
			document.getElementById('textoRed').style.color='white';
			document.getElementById('textoBus').style.color='white';
		break;
		case 4:
			document.getElementById('consulta').style.display= 'none';
			document.getElementById('registro').style.display= 'none';
			document.getElementById('movilidad').style.display= 'block';
			document.getElementById('redes').style.display= 'none';

			document.getElementById('textoElec').style.background='#0B0364';
			document.getElementById('textoMov').style.background='#B7EFF2';
			document.getElementById('textoRed').style.background='#0B0364';
			document.getElementById('textoBus').style.background='#0B0364';

			document.getElementById('textoElec').style.color='white';
			document.getElementById('textoMov').style.color='red';
			document.getElementById('textoRed').style.color='white';
			document.getElementById('textoBus').style.color='white';
		break;
		case 5:
			document.getElementById('registro').style.display= 'none';
			document.getElementById('consulta').style.display= 'none';
			document.getElementById('movilidad').style.display= 'none';
			document.getElementById('redes').style.display= 'block';

			document.getElementById('textoElec').style.background='#0B0364';
			document.getElementById('textoMov').style.background='#0B0364';
			document.getElementById('textoRed').style.background='#B7EFF2';
			document.getElementById('textoBus').style.background='#0B0364';

			document.getElementById('textoElec').style.color='white';
			document.getElementById('textoMov').style.color='white';
			document.getElementById('textoRed').style.color='red';
			document.getElementById('textoBus').style.color='white';
		break;
	}
}
 function mapa(address,idMapa) {              
       var geoCoder = new google.maps.Geocoder(address)
       var request = {address: address};

       geoCoder.geocode(request, function (result, status) {
		   var latlng = new google.maps.LatLng(result[0].geometry.location.lat(), result[0].geometry.location.lng());
		   var myOptions = {
	            zoom: 15,
	            center: latlng,
	            mapTypeId: google.maps.MapTypeId.ROADMAP
	       };
	       var map = new google.maps.Map(document.getElementById(idMapa), myOptions);
		   	var marker = new google.maps.Marker({position: latlng, map: map, title: 'title'});
		   })
       
 }

function verCoordinadores(formulario,v){
	if(v){
		if(formulario.cargoRedes.selectedIndex==2){
			formulario.coordinadorRed.disabled=false;
			document.getElementById('coordiSelect').style.background='#E4E3F0';
			document.getElementById('coordiSelect').style.color='#888';
		}			
		else{
			formulario.coordinadorRed.disabled=true;
			document.getElementById('coordiSelect').style.background='red';
			document.getElementById('coordiSelect').style.color='white';
		}
	}else{
		if(formulario.cargoMovilidad.selectedIndex==2){
			formulario.coordinadorMov.disabled=false;
			document.getElementById('coordiSelect').style.background='#E4E3F0';
			document.getElementById('coordiSelect').style.color='#888';
		}
		else{
			formulario.coordinadorMov.disabled=true;
			document.getElementById('coordiSelect').style.background='red';
			document.getElementById('coordiSelect').style.color='white';
		}
	}
}
function validaSelect(formulario,v){
	switch(v){
		case 0:
			if(formulario.cargoElectoral.value == "nada"){
				alert("Seleccione cargo");
				return false;
			}
			return true;
		break;
		case 1:			
			if(formulario.cargoMovilidad.value == "nada"){
				alert("Seleccione cargo");
				return false;
			}
			if(!formulario.coordinadorMov.disabled && formulario.coordinadorMov.value=="nada"){
				alert("Seleccione coordinador");
				return false;
			}
			if(formulario.personaElectoral.value == "nada"){
				alert("Seleccione persona electoral");
				return false;
			}

			return true;
		break;
		case 2:
			if(formulario.cargoRedes.value == "nada"){
					alert("Seleccione cargo");
					return false;
				}
				if(!formulario.coordinadorRed.disabled && formulario.coordinadorRed.value=="nada"){
					alert("Seleccione coordinador");
					return false;
				}
				if(formulario.personaElectoral.value == "nada"){
					alert("Seleccione persona electoral");
					return false;
				}

				return true;
		break;
	}
}