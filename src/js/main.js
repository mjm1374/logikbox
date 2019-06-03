class setLocation {
	constructor(lat = '40.079', lng = '-75.160', name) {
		this.setLat = lat;
		this.setLng = lng;
		this.name = name;
	}
}

const access_token = "179767298.1677ed0.53df19c85ce44f2ebabd7040526cab70";
const days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
const months = ["January","Febuary","March","April","May","June","July","August","September","October","November","Decemeber"];

jQuery(document).ready(function($) {
	var timelineBlocks = $('.cd-timeline-block'),
		offset = 0.8;
		
$('#getMoreIstagram').on("click",function(e){
	e.preventDefault();
	var max_id = $('#getMoreIstagram').data('nexturl');
	GetInstagram(max_id);
	
});

$(document).on('click','.pic__modal', function(e){
	let srcUrl = $(this).data('pic'); 
	let caption = $(this).data('caption');
	let alt = $(this).data('alt'); 
	if(alt == 'undefined' || alt == "") alt = caption;

	$('#bigstagram').attr('src', srcUrl);
	$('#bigstagram').attr('alt', alt);
	$('.modal-dynamic-title').html(caption);
	$('#photoModal').modal('show');
});

$(document).on('click','.vid__modal', function(e){
	let srcUrl = $(this).data('vid'); 
	let caption = $(this).data('caption'); //caption
	var video = document.getElementById('bigstagram--vid');
	var source = document.createElement('source');

	source.setAttribute('src',srcUrl);
	video.appendChild(source);
	video.load();
	
	$('.modal-dynamic-title').html(caption);
	$('#videoModal').modal('show'); 

	
});
		

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

function GetInstagram(max_id){
	$.when(  $.get( 'https://api.instagram.com/v1/users/self/media/recent/', 
	{ access_token: access_token, max_id: max_id } ) )
	.then(function( result ) {
		//console.log( "my results", result );
		var myPics =  result.data;
		var NextMaxID = result.pagination.next_max_id;
		//console.log(NextMaxID);

		if(NextMaxID != undefined){
			$('#getMoreIstagram').data('nexturl', NextMaxID);
		}else{
			$('#getMoreIstagram').hide();
		}
		
		

			for(i = 0; i < myPics.length; i++) {
				let myString = "";
				let isVideo = false;
				let date = new Date(parseInt(myPics[i].created_time) * 1000);
				let month = (date.getMonth()+1);
				let day = date.getDate();
				let fullYear = date.getFullYear();
				let fullDate = days[date.getDay()]  + ",  " + months[date.getMonth()] + " " + day + "." + fullYear;
				let myCaption = "";
				if(myPics[i].caption != undefined || myPics[i].caption != null) {
					myCaption =  myPics[i].caption.text;
				} else {
					myCaption = "Untitled";
				}
				let location =  new setLocation();
				if(myPics[i].location != undefined){
					location =  new setLocation(myPics[i].location.latitude, myPics[i].location.longitude, myPics[i].location.name );

				}
				if(myPics[i].videos != undefined){
					isVideo = true;

				}

				myCaption =  myCaption.replace(/'/g, "&#8217;");

				myString += "<div class='col-md-3 col-sm-6'>";
				myString += "<div class='instagram__holder'>";
				//myString += "<img class='instagram__pic' src='" + myPics[i].images.low_resolution.url + "' alt='" + myPics[i].caption.text + "' />";
				
				if(isVideo == false){
					myString += "<div class='instagram__border pic__modal' data-pic='" + myPics[i].images.standard_resolution.url + "' data-caption='" +  myCaption + "' style='background-image:url(" + myPics[i].images.standard_resolution.url + ");'>";
				}else{
					myString += "<div class='instagram__border vid__modal' data-vid='" + myPics[i].videos.standard_resolution.url + "' data-caption='" +  myCaption + "' >";
					myString += "<div class='instagram__video' ><video autoplay muted loop><source src=" + myPics[i].videos.low_resolution.url + " type='video/mp4'></video> </div>";
				}
				myString += "</div><div class='instagram__copy'>" + myCaption + "<br /><span class='instagram__date'>" + fullDate ;
				if(location.name != "" && location.name != undefined){
					myString += " - " + location.name; 
				}
				myString += "</span></div>";
				myString += "</div></div>";
				$('.instagram').append(myString);
			}    
	}).fail(function( err ) {
		console.log("Error: " +  err.responseText);
	});
}
