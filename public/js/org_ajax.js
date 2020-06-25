/*var form = document.getElementById('form');
// Adds a listener for the "submit" event.
form.addEventListener('submit', function(e) {

  e.preventDefault();

});*/
// Gets a reference to the form element



$(document).ready(function() {

$("form").submit(function( e ){

	e.preventDefault();
	var test = confirm("Vous êtes sur de continuer?");

	if (test == true) {

		var $form = $(this);
		$form.find('.btn-danger').text('Chargement');
		var url = $form.attr('action');
		console.log($form.parents('tr'));
		var test = 0;
		$.post( url, $form.serializeArray()) 
			.done(function(data, text, jqxhr){
				console.log($form.serializeArray())
				$form.parents('tr').fadeOut();
				
			})
			.fail(function(jqxhr){
				alert(jqxhr.responseText);
			})
			.always(function(jqxhr){
				$form.find('.btn-danger').text('Supprimer');
			});
	}
});



});