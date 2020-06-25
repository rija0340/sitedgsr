


$(document).ready(function() {


	$('#bouton').hide();
	$(".js-actu_show").on('click', function( e ){

		e.preventDefault();
		

		var $a = $(this);
		var url = $a.attr('href');
		var $id = parseInt(url.slice(11, url.length), 10);
		var $img1 = $('.bg-one').find('img');
		var $img2 = $('.bg-two').find('img');
		var $img3 = $('.bg-three').find('img');
		var $img4 = $('.bg-four').find('img');


		$.ajax({ url : url, type : 'GET', dataType : "json", data : { "id" : $id } }) 
		.done(function(data, status, jqxhr){

			$( '.actu_title' ).text(data.titre);
			$( '.actu_content' ).html(data.contenu);
			$( '.actu_datepub' ).text($date(data.datepub.date)); //getday() return 0->sunday, 1->monday..., 

			$img2.attr('src', "/uploads/images/actualite/"+ data.attachement[0] +"");
			$img3.attr('src', "/uploads/images/actualite/"+ data.attachement[1] +"");
			$img4.attr('src', "/uploads/images/actualite/"+ data.attachement[2] +"");
			$img1.attr('src', "/uploads/images/actualite/"+ data.attachement[3] +"");
		/*	setTimeout(function(){
				console.log("THIS IS");
			}, 4000);*/
			$('#bouton').trigger('click');


		})
		.fail(function(jqxhr){
			alert(jqxhr.responseText);
		})
		.always(function(jqxhr){

		});

		/*formatage de date*/

		$date = function(dateObject) {
			var d = new Date(dateObject);
			var day = d.getDay();
			var month = d.getMonth() + 1;
			var year = d.getFullYear();
			if (day < 10) {
				day = "0" + day;
			}
			if (month < 10) {
				month = "0" + month;
			}
			var date = day + "/" + month + "/" + year;

			return date;
		};

	});

});