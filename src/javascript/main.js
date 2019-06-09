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

