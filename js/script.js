var pageedit = document.getElementById('edit-prod');
var inpr = document.getElementsByName('pr-stac');
var eprod = document.getElementsByName('editar-prod');
var gprod = document.getElementsByName('grabar-prod');

pageedit.addEventListener('click', habilitarOptEdition, false);

function habilitarOptEdition(){
	mostrarBotEdit();
	for (var i = eprod.length - 1; i >= 0; i--) {
		eprod[i].addEventListener('click', function(event){

			ocultarBotEdit();
			
			var clase = this.classList[0];
			console.log(clase);
			//deshabilitar botones input del stock
			for (var j = inpr.length - 1; j >= 0; j--) {
				if (!inpr[j].getAttribute('readOnly')) {
					inpr[j].setAttribute('readOnly', 'readOnly');
				}
			}
			//ocultar botones de grabar
			for (var k = gprod.length - 1; k >= 0; k--) {
				if (!gprod[k].getAttribute('hidden')) {
					gprod[k].setAttribute('hidden', 'true');
				}
			}

			var st = document.getElementById(clase);
			st.removeAttribute('readOnly');	

//			this.setAttribute('hidden', 'true');

			var grpr = document.getElementsByClassName('gr' + clase);
			grpr[0].removeAttribute('hidden');
			
		}, false);
	}
}

function mostrarBotEdit(){
	//mostrar botones de editar
	for (var i = eprod.length - 1; i >= 0; i--) {
		if (eprod[i].getAttribute('hidden')) {
			eprod[i].removeAttribute('hidden');
		}
	}
}

function ocultarBotEdit(){
	for (var i = eprod.length - 1; i >= 0; i--) {
		if (!eprod[i].getAttribute('hidden')) {
			eprod[i].setAttribute('hidden','true');
		}
	}
}