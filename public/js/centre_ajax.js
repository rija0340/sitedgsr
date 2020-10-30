


$(document).ready(function() {

	$(".detail_centre").hide();

	$(".js-centre_show").on('click', function( e ){

		e.preventDefault();
		
		var $a = $(this);
		// affichage spinner
		var $spinner_container = $a.parent().parent().parent().parent().children().children();

		console.log($spinner_container);

		$spinner_container.removeClass('hide');

		var url = $a.attr('href');
		var $id = parseInt(url.slice(8, url.length), 10);
		var $img_centre = $('.detail_centre').find('img');

		$.ajax({ url : url, type : 'GET', dataType : "json", data : { "id_centre" : $id } }) 
		.done(function(data, status, jqxhr){


			var ville = data.ville.toLowerCase();
			var faritany = data.faritany.toLowerCase();
			var adresse = data.adresse.split(",");

			if (ville == faritany) {
				$('#bouton').trigger('click');

				$spinner_container.addClass('hide'); //cacher de nouveau spinner
				$('.liste_centres').removeClass('hide'); //il y un hide automatique si on ne mets pas cette ligne

				$(".detail_centre").show();
				$(".madagascar").hide();
				$( '.adresse' ).text(data.adresse);
				$( '.grade_cc' ).text(data.grade_cc);
				$( '.nom_cc' ).text(data.nom_cc);
				$( '.num_cc' ).text(data.num_cc);
				$( '.ville' ).text(adresse[0]);
				$( '.faritany' ).text(data.faritany);
				$img_centre.attr('src', "/uploads/images/centres/"+ data.filename +"");


				if ($a.text().trim()==adresse[0]) {

					$("li").removeClass("centre_actif");
					$a.parent().addClass("centre_actif");
					// $a.removeClass("pressed_link");
					// $a.addClass("pressed_link");

				} else{
					// $a.parent().removeClass("centre_actif");
				}

			}else{
				
				$('#bouton').trigger('click');

				$spinner_container.addClass('hide'); //cacher de nouveau spinner
				$('.liste_centres').removeClass('hide'); //il y un hide automatique si on ne mets pas cette ligne

				$(".detail_centre").show();
				$(".madagascar").hide();
				$( '.adresse' ).text(data.adresse);
				$( '.grade_cc' ).text(data.grade_cc);
				$( '.nom_cc' ).text(data.nom_cc);
				$( '.num_cc' ).text(data.num_cc);
				$( '.ville' ).text(data.ville);
				$( '.faritany' ).text(data.faritany);
				$img_centre.attr('src', "/uploads/images/centres/"+ data.filename +"");

				//trim() sert à supprimer les espaces avant et apèrs les chaines de caractères
				
				if ($a.text().trim()==data.ville) {
					$("li").removeClass("centre_actif");
					$a.parent().addClass("centre_actif");
					// $a.removeClass("pressed_link");
					// $a.addClass("pressed_link");
				} else{

					// $a.parent().removeClass("centre_actif");
				}
			}
		})
		.fail(function(jqxhr){
			alert(jqxhr.responseText);
		})
		.always(function(jqxhr){

		});

	});

});