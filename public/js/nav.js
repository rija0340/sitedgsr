window.onscroll = function() {myFunction()};

//get the navbar
var navbar = document.getElementById("navbar");

//get the offset position of the navbar
var sticky = navbar.offsetTop;

//add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll postion

function myFunction(){

	if (window.pageYOffset >= sticky) {

		navbar.classList.add("sticky");
	}else{
		navbar.classList.remove("sticky");
	}
}