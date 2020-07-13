


$(document).ready(function() {


	$(".btn_tarif").on('click', function( e ){

		//recuperaton de l'element cliqué (unique car chacun a son href)
		var $a = $(this);

		//recuperation valeur attribut href
		var url = $a.attr('href');

		//recuperer dans id la valeur sans #
		var id = url.slice(1, url.length);

		//recuperer valeur attribut aria-expended pour tester si l'accordion est développé ou pas
		var test = $a.attr('aria-expanded');
		// console.log(test);
		// console.log("id est :"  + id+"_icone");


		// console.log($("#"+id+"_icone"));
		

		if (test == "true" ) {


			$("#"+id+"_icone").removeClass("fa-toggle-up");
			$("#"+id+"_icone").addClass("fa-toggle-down");

		}else{


			$("#"+id+"_icone").removeClass("fa-toggle-down");
			$("#"+id+"_icone").addClass("fa-toggle-up");

		}


	});


	//pour gerer modal pour abreviation 

	


});