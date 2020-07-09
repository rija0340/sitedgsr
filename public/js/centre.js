


$(document).ready(function() {


	$(".faritany-mada").on('click', function( e ){

		var $a = $(this);
		var url = $a.attr('href');
		
		var test = $(url).hasClass("show");

		if (test==true) {

			$(url+"_icone").removeClass("fa-toggle-up");
			$(url+"_icone").addClass("fa-toggle-down");

		}else{


			$(url+"_icone").removeClass("fa-toggle-down");
			$(url+"_icone").addClass("fa-toggle-up");

		}


	});

	$(".js-centre_show").on('click', function( e ){

	 	// if () {}

		// var ville = $('.detail_centre').html('label_adresse');
		// console.log(ville);



		// }


	});

});