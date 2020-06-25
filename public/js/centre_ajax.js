


$(document).ready(function() {

	$(".detail_centre").hide();

	$(".js-centre_show").on('click', function( e ){

		e.preventDefault();

		var $a = $(this);
		var url = $a.attr('href');
		var $id = parseInt(url.slice(8, url.length), 10);
		var $img_centre = $('.detail_centre').find('img');


		$.ajax({ url : url, type : 'GET', dataType : "json", data : { "id_centre" : $id } }) 
		.done(function(data, status, jqxhr){

			var ville = data.ville.toLowerCase();
			var faritany = data.faritany.toLowerCase();
			var adresse = data.adresse.split(",");


			if (ville == faritany) {

				
				$(".detail_centre").show();
				$(".madagascar").hide();
				$( '.adresse' ).text(data.adresse);
				$( '.grade_cc' ).text(data.grade_cc);
				$( '.nom_cc' ).text(data.nom_cc);
				$( '.num_cc' ).text(data.num_cc);
				$( '.ville' ).text(adresse[0]);
				$( '.faritany' ).text(data.faritany);
				$img_centre.attr('src', "/images/dg/"+ data.filename +"");

			}else{

				
				$(".detail_centre").show();
				$(".madagascar").hide();
				$( '.adresse' ).text(data.adresse);
				$( '.grade_cc' ).text(data.grade_cc);
				$( '.nom_cc' ).text(data.nom_cc);
				$( '.num_cc' ).text(data.num_cc);
				$( '.ville' ).text(data.ville);
				$( '.faritany' ).text(data.faritany);
				$img_centre.attr('src', "/images/dg/"+ data.filename +"");
			}



		})
		.fail(function(jqxhr){
			alert(jqxhr.responseText);
		})
		.always(function(jqxhr){

		});

	});

});