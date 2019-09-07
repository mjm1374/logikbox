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
let IsCreated = 0;

function dynamicSort(property) {
	var sortOrder = 1;
	if (property[0] === "-") {
		sortOrder = -1;
		property = property.substr(1);
	}
	return function (a, b) {
		/* next line works with strings and numbers, 
		 * and you may want to customize it to your needs
		 */
		var result = (a[property] < b[property]) ? -1 : (a[property] > b[property]) ? 1 : 0;
		return result * sortOrder;
	};
}

jQuery(document).ready(function($) {
	var timelineBlocks = $('.cd-timeline-block'),
		offset = 0.8,
		initial_position = null;


	window.addEventListener('deviceorientation', function (e) {
		if (initial_position === null) {
			initial_position = Math.floor(e.alpha);
		}

		let current_position = initial_position - Math.floor(e.alpha);
		let right = panorama.width();
		let midPoint = right / 2; 

		if (current_position < 0){
			offset = offset + 10;
		}else{
			offset = offset - 10;
		}

		if (offset <= left) offset = 0;
		if (offset >= right) offset = right;
		//console.log(current_position + " - " + left + " - " + initial_position);
		var percentage = offset / width * 100;
		panorama.css('background-position', percentage + '% 0');
	});
		
$('#getMoreIstagram').on("click",function(e){
	e.preventDefault();
	var max_id = $('#getMoreIstagram').data('nexturl');
	GetInstagram(max_id);
	
});

$(document).on('click', '.pic__modal', function (e) {
	$('#bigstagram').addClass('hidden');
	$('#bigstagram--vid').addClass('hidden');
	$('.modal-btn').addClass('hidden');

	let srcUrl = $(this).data('pic');
	let caption = $(this).data('caption');
	let alt = $(this).data('alt');
	if (alt == 'undefined' || alt == "") alt = caption;

	$('#bigstagram').removeClass('hidden');
	$('#bigstagram').attr('src', srcUrl);
	$('#bigstagram').attr('alt', alt);
	$('#photoModal').modal('show');
	$('.modal-dynamic-title').html(caption);
});

$(document).on('click','.gallery__modal', function(e){
	$('#bigstagram').addClass('hidden');
	$('#bigstagram--vid').addClass('hidden');
	$('.modal-btn').addClass('hidden');
	let currentPos = $(this).data('pid');

	//if in gallery mode
	if (currentPos != undefined) {
		$('.modal-btn').removeClass('hidden');
		let prevPos = getNextPosition(currentPos, -1);
		let nextPos = getNextPosition(currentPos, 1);

		$('.modal-left').data('gotoPos', prevPos);
		$('.modal-right').data('gotoPos', nextPos);
	}

	let srcUrl = instagramGallery[currentPos].mediaURL;
	let caption = instagramGallery[currentPos].caption;
	let alt = instagramGallery[currentPos].alt;
	if (alt == 'undefined' || alt == "") alt = caption;
	let isVideo = instagramGallery[currentPos].isVideo;
	let video = document.getElementById('bigstagram--vid');
	

	if (isVideo) {
		$('#bigstagram--vid').removeClass('hidden');
		video.pause();
		if (IsCreated <= 0) {
			let source = document.createElement('source');
			IsCreated = 1;
			source.setAttribute('src', srcUrl);
			source.setAttribute('id', 'instaPlayer');
			video.appendChild(source);
		} else {
			$('#instaPlayer').attr('src', srcUrl);
		}
		video.load();
	} else {
		video.pause();
		$('#bigstagram').removeClass('hidden');
		$('#bigstagram').attr('src', srcUrl);
		$('#bigstagram').attr('alt', alt);

	}

	

	$('#photoModal').modal('show'); 
	$('.modal-dynamic-title').html(caption);
	
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

	//console.log("xxx",instagramGallery);

	//panorama
	var panorama = $('.jumbotron--homepage');
	var left = panorama.offset().left;
	var width = panorama.width();

	$('.jumbotron--homepage').mousemove(function (e) {
	var offset = e.pageX - left;
		//console.log(e.pageX  + " - " + offset);
	var percentage = offset / width * 100;
	panorama.css('background-position', percentage + '% 0');
	});

});

