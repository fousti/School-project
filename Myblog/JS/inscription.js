
function hideErrors() {

	var spans = document.getElementsByTagName('span'),
		spansLength = spans.length;

	for (var i = 0 ; i < spansLength ; i++) {
		if (spans[i].className == 'form_error') {
			spans[i].style.display = 'none';
		}
	}
}

var check = {};

check['nickname'] = function(id) {
	var name = document.getElementById(id),
		errorStyle = getError(name).style;

	if (name.value.length <= 1 || name.value.length >= 11) {
		errorStyle.display = 'inline-block';
		name.className = 'incorrect';
		return false;
	} else {
		errorStyle.display = 'none';
		name.className = 'correct';
		return true;
	}
}

check['prenom'] = check['nom'] = function(id) {
	var name = document.getElementById(id),
		errorStyle = getError(name).style;

	if (!isAlpha(name.value)) {
		errorStyle.display = 'inline-block';
		name.className = 'incorrect';
		return false;
	} else {
		errorStyle.display = 'none';
		name.className = 'correct';
		return true;
	}
}

check['email'] = function(id) {
	var name = document.getElementById(id),
		errorStyle = getError(name).style;

	if (!verifMail(name.value)) {
		errorStyle.display = 'inline-block';
		name.className = 'incorrect';
		return false;
	} else {
		errorStyle.display = 'none';
		name.className = 'correct';
		return true;
	}
}

check['pass'] = function(id) {
	var name = document.getElementById(id),
		errorStyle = getError(name).style;

	if (name.value.length < 8) {
		errorStyle.display = 'inline-block';
		name.className = 'incorrect';
		return false;
	} else {
		errorStyle.display = 'none';
		name.className = 'correct';
		return true;
	}
}

check['verif_pass'] = function() {
	var pw = document.getElementById('pass'),
		vpw = document.getElementById('verif_pass'),
		errorStyle = getError(vpw).style;

	if (pw.value == vpw.value) {
		errorStyle.display = 'none';
		vpw.className = 'correct';
		return true;
	} else {
		errorStyle.display = 'inline-block';
		vpw.className = 'incorrect';
		return false;
	}
}

var myForm = document.getElementById('inscr_form'),
	inputs = document.getElementsByTagName('input'),
	inputsLength = inputs.length;

for (var i = 0 ; i < inputsLength ; i++) {
	if (inputs[i].type == 'text' || inputs[i].type == 'password') {
		inputs[i].onkeyup = function() {
			check[this.id](this.id);
		}
	}
}

myForm.onreset = function() {
	for (var i = 0 ; i < inputsLength ; i++) {
		if (inputs[i].type == 'text' || inputs[i].type == 'password') {
			inputs[i].className = 'form_text';
			hideErrors();
		}
	}
}

hideErrors();