
window.requestAnimFrame = (function(){
  return window.requestAnimationFrame       ||
         window.webkitRequestAnimationFrame ||
         window.mozRequestAnimationFrame    ||
         window.oRequestAnimationFrame      ||
         window.msRequestAnimationFrame     ||
	function(callback){
		window.setTimeout(callback, 1000 / 60);
	};
})();

function dropOnclick (idbutton) {
	
	var control = document.getElementById(idbutton).nextSibling;
	console.log(control.getAttribute('class'));
	if (control.offsetHeight != 0) {

		var height = 0 ;
	}
	else {
		control.style.display = 'block' ;
		control.style.height = '' ;
		var height = control.offsetHeight;
		console.log(height);
		console.log(control.style.height);
		control.style.height = '0px' ;
	}
	
	toogle(control,height,5);
}

function toogle (control,maxheight,step) {
	console.log(control.getAttribute('class'));
	var height = parseInt(control.style.height.replace(/px/,''));
	var sens = (height < maxheight ? 1 : -1);
	if (height != maxheight) {

		height = height + (sens*step);
		control.style.height = height + 'px';
		console.log(control.style.height);
		window.requestAnimFrame(function(){toogle(control,maxheight,1)});
	}
	else {
		clearTimeout();
	}	

}

function toggle_nav(node) {

	var li = node.parentNode;
	var tree = document.getElementsByClassName('treeElem');
	var lvl = parseInt(li.getAttribute('data-lvl')); 
	var pos = parseInt(li.getAttribute('data-position'));
	var state = li.className.indexOf('expand');
	if(state == -1 ) {

		li.className += " expand";
		sessionStorage[pos.toString()] = 1;
	}
	else {
		sessionStorage[pos.toString()] = 0;
	}
	



	for (var i = pos+1; i <= tree.length; i++) {


		if (state != -1) {

			if (typeof(tree[i])=='undefined'||(lvl >= tree[i].getAttribute('data-lvl'))) {
				li.className = li.className.replace("expand","");
				sessionStorage[tree[i].getAttribute('data-position')] = 0;
			}
			
			if (lvl < (tree[i].getAttribute('data-lvl'))) {

				tree[i].style.display = 'none';
				li.className = li.className.replace("expand","");
				tree[i].className = tree[i].className.replace("expand","");
				sessionStorage[tree[i].getAttribute('data-position')] = 0;
				
			}
			else {
				break;
			}
		}
		else {
				if ((lvl+1) == (tree[i].getAttribute('data-lvl'))) {
				tree[i].style.display = 'block';
			}
			else {
				break;

			}
		}
		

	};
}



(function() {

	var control = document.getElementsByClassName('show_control');
	for (var i = 0; i < control.length; i++) {
		control[i].addEventListener('click',function() {
			dropOnclick(this.id);
		},false);
	};

	var nav = document.getElementsByClassName('nav-coll');
	for (var i = 0; i < nav.length; i++) {
		nav[i].addEventListener('click',function(){
				toggle_nav(this);
		}, false);
	};



	var del = document.getElementsByClassName('delete_link');
	for (var i = 0; i < del.length; i++) {
		del[i].addEventListener('click',function() {
			if (confirm('Are you sure you want to delete ?')) {
				document.location.href = this.href;
			}
		}, false);
	};

})();






var treeElem = document.getElementsByClassName('treeElem');
for(var i=0; i<treeElem.length; i++){
	var lvl = treeElem[i].getAttribute('data-lvl');
	var pos = parseInt(treeElem[i].getAttribute('data-position'));

	var tabulation = 50+(lvl*20);
	treeElem[i].style.paddingLeft=tabulation+"px";

	
	if (lvl > 2) {
			treeElem[i].style.display = 'none';
		}

	
};
console.log(sessionStorage);

for(var i=0; i<treeElem.length; i++){
	var lvl = parseInt(treeElem[i].getAttribute('data-lvl'));
	var pos = parseInt(treeElem[i].getAttribute('data-position'));
	var state = parseInt(sessionStorage[pos.toString()]);

	if (state == 1) {
		treeElem[i].className += ' expand';
		for (var j = pos+1; j < treeElem.length; j++) {
			console.log('j ='+j);
			console.log(treeElem[j]);

			if (lvl+1 == parseInt(treeElem[j].getAttribute('data-lvl'))) {
				
				treeElem[j].style.display = 'block' ;
			}
			else {
				break;
			}
	
		};
	}

};
// -- (end) tabulation pour tree dir --//


