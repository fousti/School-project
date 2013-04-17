var lwr = 'abcdefghijklmnopqrstuvwxyzéèêçïî';
var upr = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

function isValid(param,val) {

	if (param == "") return false;

 	for (i = 0 ; i < param.length ; i++) {
		if (val.indexOf(param.charAt(i),0) == -1) return false;
  	}
  	
  	return true;

}

function isAlpha(param) {
	return isValid(param, lwr + upr);
}

function getError(element) {

	while (element = element.nextSibling) {
		if (element.className === 'form_error') {
			return element;
		}
	}

	return false;
}

function verifMail(param) {

	valide = false;
	
	for(var j = 1 ; j < (param.length) ; j++) {

		if(param.charAt(j) == '@') {

			if(j < (param.length - 4)) {

				for(var k = j ; k < (param.length - 2) ; k++) {

					if(param.charAt(k) == '.') valide = true;

				}

			}

		}
	}

	return valide;
}

function ConfirmDeleteMessage(URL) {

	if (confirm("Confirmez-vous la suppression ?"))
	    {
	         window.location = URL;
	    }
}