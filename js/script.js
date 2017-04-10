
var isClicked = false;
function toggleMenu() {
	isClicked = !isClicked;
	var obj = document.getElementById("popup");
	if (isClicked) {
	  obj.className += "open";
	} else {
	  obj.className = "";
	}
}