class Instragram {
	constructor(
		caption = '',
		date,
		isVideo = false,
		mediaURL,
		location,
		likes
	) {
		this.caption = caption;
		this.date = date;
		this.isVideo = isVideo;
		this.mediaURL = mediaURL;
		this.location = location;
		this.likes = likes;
	}
}

let instagramGallery = [];
let instaGalPos = 0;

function GetInstagram(max_id) {
	$.when(
		$.get('https://graph.instagram.com/me/media', {
			access_token: instagramAPI,
			after: max_id,
			fields: 'id, username, caption, media_type, media_url, permalink, thumbnail_url, timestamp',
		})
	)
		.then(function (result) {
			let myPics = result.data;
			let nextMaxID = result.paging.next;

			if (nextMaxID != undefined) {
				nextMaxID = nextMaxID.slice(nextMaxID.indexOf('after=') + 6);
				$('#getMoreIstagram').data('nexturl', nextMaxID);
			} else {
				$('#getMoreIstagram').hide();
			}

			for (let i = 0; i < myPics.length; i++) {
				let myString = '';
				let isVideo = false;
				let date = new Date(myPics[i].timestamp);
				let fullDate = tardis.DayMonthDate(date.toUTCString());
				let location = new setLocation();
				let myCaption = '';
				let mediaURL = '';
				let likes = null;
				let imgTypeText = 'Photo';
				//let likes = myPics[i].likes.count;

				if (
					myPics[i].caption != undefined ||
					myPics[i].caption != null
				) {
					myCaption = myPics[i].caption;
				} else {
					myCaption = 'Untitled';
				}
				myCaption = myCaption.replace(/'/g, '&#8217;');
				if (myPics[i].location != undefined) {
					location = new setLocation(
						myPics[i].location.latitude,
						myPics[i].location.longitude,
						myPics[i].location.name
					);
				}
				if (myPics[i].media_type == 'VIDEO') {
					isVideo = true;
					imgTypeText = 'Video';
				}

				myString += "<div class='col-md-3 col-sm-6'>";
				myString += `<div class='instagram__holder' tabindex='0' aria-label='${imgTypeText} by Mike McAllister. ${myCaption}. Taken on ${fullDate}'>`;

				if (isVideo == false) {
					mediaURL = myPics[i].media_url;
					myString += `<div class='instagram__border gallery__modal' data-isVid='${isVideo}' data-pid='${instaGalPos}' data-pic='${mediaURL}' data-caption='${myCaption}' style='background-image:url(${mediaURL});'>`;
					//<div class='likebox'><span class='text-red'>&hearts;</span><span class='instagram__date likecnt'>${likes}</span></div>
				} else {
					mediaURL = myPics[i].media_url;
					myString += `<div class='instagram__border gallery__modal' data-isVid='${isVideo}' data-pid='${instaGalPos}' data-vid='${mediaURL}' data-caption='${myCaption}'>`;
					//<div class='likebox'></div> <span class='text-red'>&hearts;</span><span class='instagram__date likecnt'>${likes}</span>
					myString += `<div class='instagram__video'><video autoplay muted loop><source src='${mediaURL}' type='video/mp4'></video></div>`;
				}
				myString += `</div><div class='instagram__copy' aria-hidden='true'>${myCaption}<br /><span class='instagram__date'>${fullDate}`;
				if (location.name != '' && location.name != undefined) {
					myString += ` - ${location.name}`;
				}
				myString += `</span></div>
            </div></div>`;

				instagramGallery.push(
					new Instragram(
						myCaption,
						date,
						isVideo,
						mediaURL,
						location,
						likes
					)
				);
				instaGalPos++;

				$('.instagram').append(myString);
			}
		})
		.fail(function (err) {
			console.log('Error: ' + err.responseText);
		});
}

function getNextPosition(ind, dir) {
	let InstraArrayLen = instagramGallery.length;
	let nextPos = ind + dir;
	if (nextPos < 0) nextPos = InstraArrayLen - 1;
	if (nextPos > InstraArrayLen - 1) nextPos = 0;

	return nextPos;
}

$(document).on('click', '.modal-btn', function (e) {
	let currebtPos = $(this).data('gotoPos');
	let prevPos = getNextPosition(currebtPos, -1);
	let nextPos = getNextPosition(currebtPos, 1);
	let srcUrl = instagramGallery[currebtPos].mediaURL;
	let caption = instagramGallery[currebtPos].caption;
	let alt = instagramGallery[currebtPos].alt;
	if (alt == 'undefined' || alt == '') alt = caption;
	let isVideo = instagramGallery[currebtPos].isVideo;
	let video = document.getElementById('bigstagram--vid');

	$('#bigstagram--vid').addClass('hidden');
	$('#bigstagram').addClass('hidden');
	$('.modal-left').data('gotoPos', prevPos);
	$('.modal-right').data('gotoPos', nextPos);
	$('.modal-dynamic-title').html(caption);

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
});

$('#getMoreIstagram').on('click', function (e) {
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
	if (alt == 'undefined' || alt == '') alt = caption;

	$('#bigstagram').removeClass('hidden');
	$('#bigstagram').attr('src', srcUrl);
	$('#bigstagram').attr('alt', alt);
	$('#photoModal').modal('show');
	$('.modal-dynamic-title').html(caption);
});

$(document).on('click', '.gallery__modal', function (e) {
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
	if (alt == 'undefined' || alt == '') alt = caption;
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
