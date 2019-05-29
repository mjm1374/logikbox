jQuery(document).ready(function($) {
	var timelineBlocks = $('.cd-timeline-block'),
		offset = 0.8;

		// var scrWidth = screen.width;
		// if(scrWidth < 415){
		// 	$('.navbar').css('max-width', scrWidth + "px");
		// }
		

	//hide timeline blocks which are outside the viewport
	hideBlocks(timelineBlocks, offset);

	//on scolling, show/animate timeline blocks when enter the viewport
	$(window).on('scroll', function() {
		(!window.requestAnimationFrame) ?
		setTimeout(function() {
			showBlocks(timelineBlocks, offset);
		}, 100): window.requestAnimationFrame(function() {
			showBlocks(timelineBlocks, offset);
		});
	});

	function hideBlocks(blocks, offset) {
		blocks.each(function() {
			($(this).offset().top > $(window).scrollTop() + $(window).height() * offset) && $(this).find('.cd-timeline-img, .cd-timeline-content').addClass('is-hidden');
		});
	}

	function showBlocks(blocks, offset) {
		blocks.each(function() {
			($(this).offset().top <= $(window).scrollTop() + $(window).height() * offset && $(this).find('.cd-timeline-img').hasClass('is-hidden')) && $(this).find('.cd-timeline-img, .cd-timeline-content').removeClass('is-hidden').addClass('bounce-in');
		});
	}

	//QRCode toggle
	$('#qrCode').click(function(){
		var toggleWidth = $("#qrCode").width() < 38 ? "210px" : "37px";
		$('#qrCode').animate({ width: toggleWidth });
	});

 


});

const access_token = "179767298.1677ed0.53df19c85ce44f2ebabd7040526cab70";
const days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
	
function GetInstagram(){

	$.when(  $.get( 'https://api.instagram.com/v1/users/self/media/recent/', 
	{ access_token: access_token, } ) )
	.then(function( result ) {
		console.log( "my results", result );
		var myPics =  result.data;
		var myString = "";

			for(i = 0; i < 9; i++) {
				var date = new Date(parseInt(myPics[i].created_time) * 1000);

				var month = (date.getMonth()+1);
				var day = date.getDate();
				var fullYear = date.getFullYear();

				var fullDate = days[date.getDay()]  + " " + month + "." + day + "." + fullYear;

				myString += "<div class='col-sm-4'>";
				myString += "<div class='instagram__holder'>";
				//myString += "<img class='instagram__pic' src='" + myPics[i].images.low_resolution.url + "' alt='" + myPics[i].caption.text + "' />";
				myString += "<dic class='instagram__pic' style='background:url(" + myPics[i].images.low_resolution.url + ");background-size: cover;background-repeat: no-repeat;' />";
				myString += "<div class='instagram__copy'>" + myPics[i].caption.text + "<br /><span class='instagram__date'>" + fullDate + "</span></div>";
				myString += "</div></div>";
			}    
			$('.instagram').html(myString);

	}).fail(function( err ) {
		console.log("Error: " +  err.responseText);
	});


}