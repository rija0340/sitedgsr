


$(document).ready(function() {


	$(".btn_tarif").on('click', function( e ){


		//recuperaton de l'element cliqué (unique car chacun a son href)
		var $a = $(this);

		//recuperation valeur  data-target
		var url = $a.attr('data-target');

		//recuperation valeur text dans a
		var title = $a.html();

		$a.children().removeClass('hide');


		//recuperer classe sans .
		var id = url.slice(1, url.length);

		// var include = "{% include 'pages/tarifs/tarif_visite/"+ id +".html.twig' %}" ;

		// console.log(include);

		var url = '/'+ id ;
		// var url = '/tarif_consta';
		//ceci permet de recuperer un element html et le met dans le div main-wrapper de la page fille
		$('.main-wrapper').load(url, function() {
			$('.modal-title').html(title);
			$('#bouton').trigger('click');
			$a.children().addClass('hide');
			
		}); 




	});
});



