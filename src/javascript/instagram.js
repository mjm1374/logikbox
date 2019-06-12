class Instragram {
	constructor(caption = '', date, isVideo = false, mediaURL, location, likes) {
		this.caption = caption;
        this.date = date;
        this.isVideo = isVideo;
        this.mediaURL = mediaURL;
        this.location = location;  
        this.likes = likes;
	}
} 

let instagramGallery = [];

function GetInstagram(max_id){
	$.when(  $.get( 'https://api.instagram.com/v1/users/self/media/recent/', 
	{ access_token: access_token, max_id: max_id } ) )
	.then(function( result ) {
		console.log( "my results", result );
		var myPics =  result.data;
		var NextMaxID = result.pagination.next_max_id;

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
            let location =  new setLocation();
            let myCaption = "";
            let mediaURL = "";
            let likes =  myPics[i].likes.count;
            
            

            if(myPics[i].caption != undefined || myPics[i].caption != null) {
                myCaption =  myPics[i].caption.text;
            } else {
                myCaption = "Untitled";
            }
            myCaption =  myCaption.replace(/'/g, "&#8217;");
            //myCaption =  myCaption ; 

            if(myPics[i].location != undefined){ location =  new setLocation(myPics[i].location.latitude, myPics[i].location.longitude, myPics[i].location.name ); }
            if(myPics[i].videos != undefined){ isVideo = true; }

            

            myString += "<div class='col-md-3 col-sm-6'>";
            myString += "<div class='instagram__holder'>";
            
            if(isVideo == false){
                mediaURL =  myPics[i].images.standard_resolution.url;
                myString += "<div class='instagram__border pic__modal' data-pic='" + mediaURL+ "' data-caption='" +  myCaption + "' style='background-image:url(" + mediaURL + ");'><div class='likebox'><span class='text-red'>&hearts;</span><span class='instagram__date likecnt'>"  + likes + "</span></div>";
            }else{
                mediaURL =  myPics[i].videos.standard_resolution.url;
                myString += "<div class='instagram__border vid__modal' data-vid='" + mediaURL + "' data-caption='" +  myCaption + "' ><div class='likebox'><span class='text-red'>&hearts;</span><span class='instagram__date likecnt'>"  + likes + "</span></div>";
                myString += "<div class='instagram__video' ><video autoplay muted loop><source src=" + mediaURL + " type='video/mp4'></video> </div>";
            }
            myString += "</div><div class='instagram__copy'>" + myCaption + "<br /><span class='instagram__date'>" + fullDate  ;
            if(location.name != "" && location.name != undefined){
                myString += " - " + location.name; 
            }
            myString += "</span></div>"  ;
            myString += "</div></div>";
            instagramGallery.push(new Instragram(myCaption, date, isVideo, mediaURL , location, likes));

            $('.instagram').append(myString);
            
        }    
	}).fail(function( err ) {
		console.log("Error: " +  err.responseText);
	});
}