

function initMap(newLat, newLng) {
    //console.log('map ' + newLat + "/" + newLng);
    map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: parseFloat(newLat),
            lng: parseFloat(newLng)
        },
        defaultView: 'streetmap',
        zoom: 5
    });

    goTravel();

    map.addListener('dragend', function () {
        //    
        newCenter = map.getCenter();
        at = newCenter.lat() + "," + newCenter.lng();;
       // getplaces();
        //    console.log("xxx: " + newCenter.lat());
        //
        //
    });

}


    function getLocation() {
        if (navigator.geolocation) {
         
            navigator.geolocation.getCurrentPosition(showPosition,showError);  
        } else { 
            //x.innerHTML = "Geolocation is not supported by this browser.";
            //console.log("in getloc");
            //defaultLocal = setLocation();
            //console.log(defaultLocal.setLat);
        }
    } 


        
    function showError(error) {
        initMap('40.079' ,'-75.160' );
        switch(error.code) {
          case error.PERMISSION_DENIED:
            console.log("User denied the request for Geolocation.");
            break;
          case error.POSITION_UNAVAILABLE:
          console.log("Location information is unavailable.");
            break;
          case error.TIMEOUT:
          console.log("The request to get user location timed out.");
            break;
          case error.UNKNOWN_ERROR:
          console.log("An unknown error occurred.");
            break;
        }
      } 
          
    function showPosition(position) {
        currentLat = position.coords.latitude;
        currentLng = position.coords.longitude;
        currentAlt = position.coords.altitude;
        if(currentAlt != null){currentAlt = currentAlt.toFixed(6);}
        console.log(currentLat, currentLng, currentAlt);
        //x.innerHTML =  "Your current coordinates: <br />Lat: " + currentLat.toFixed(6) + "<br/>Lng: " + currentLng.toFixed(6) + "<br/>Alt: " + currentAlt;
        
        //sLat.value = position.coords.latitude;
        //sLng.value = position.coords.longitude;
        initMap(currentLat ,currentLng ); // init gmap
        //sButton.disabled = false;
        loop = false;
        //findSatAbove();
        at = currentLat + "," + currentLng;
        
        return new setLocation(currentLat,currentLng,currentAlt);
        
    }

    class setLocation {
        constructor(lat = '40.079', lng = '-75.160', alt = '0') {
            this.setLat = lat;
            this.setLng = lng;
            this.setAlt = alt;
        }
    }
    
let myTravels = [
    new setLocation('40.079','-75.160','Philly!'),
    new setLocation('40.7834','-73.9662','NYC'),
    new setLocation('42.3188','-71.0846','Boston'),	
    new setLocation('26.1412','-80.1464','Fort Lauderdale'),	
    new setLocation('28.4788','-81.342','Orlando'),		
    new setLocation('30.2782','-81.4045','Jacksonville'), 		
    new setLocation('25.7617','-80.1918','Miami'),		
    new setLocation('28.9270','-82.0038','The Villages'),		
    new setLocation('39.3051','-76.6144','Baltimore'),		
    new setLocation('43.1121','-77.4869','Rochester'),  		
    new setLocation('41.8373','-87.6861','Chicago'), 		
    new setLocation('41.4993','-81.6944','Cleveland'),		
    new setLocation('42.3834','-83.1024','Detroit'),		
    new setLocation('43.7','-79.42','Toronto'),		
    new setLocation('45.5','-73.5833','Montreal'),		
    new setLocation('44.65','-63.6','Halifax'),			
    new setLocation('32.0282','-81.1786','Savannah'),		
    new setLocation('40.4396','-79.9763','Pittsburgh'), 		
    new setLocation('51.5','-0.1167','London'),		
    new setLocation('51.7704','-1.25','Oxford'),		
    new setLocation('50.2084','-5.4909','Saint Ives'),
    new setLocation('51.45','-2.5833','Bristol'),		
    new setLocation('50.5938','-4.83','Port Issiac'),
    new setLocation('51.3837','-2.35','Bath'),		
    new setLocation('55.6786','12.5635','København'),		
    new setLocation('27.9937','-82.4454','Tampa'),			
    new setLocation('24.5636','-81.7769','Key West'),		
    new setLocation('29.1386','-83.0351','Cedar Keys'),
    new setLocation('52.35','4.9166','Amsterdam'),		
    new setLocation('47.38','8.55','Zurich'),		
    new setLocation('41.1400','-104.8202','Cheyenne'),
    new setLocation('40.7774','-111.9301','Salt Lake City'),		
    new setLocation('39.5497','-119.8483','Reno'),		
    new setLocation('36.1699','-115.1398','Las Vegas'),	
    new setLocation('38.5667','-121.4683','Sacramento'),		
    new setLocation('37.7749','-122.4194','San Francisco'),
    new setLocation('34.1139','-118.4068','Los Angeles'),		
    new setLocation('32.8312','-117.1226','San Diego'),		
    new setLocation('35.1872','-111.6195','Flagstaff'),		
    new setLocation('33.5722','-112.0891','Phoenix'),
    new setLocation('39.1239','-94.5541','Kansas City'),		
    new setLocation('42.3127','-83.2129','Dearborn'),		
    new setLocation('44.4877','-73.2314','Burlington'),	
    new setLocation('42.8509','-72.5579','Brattleboro'),
    new setLocation('29.4722','-98.5247','San Antonio'),		
    new setLocation('39.5309','-75.8074','Chesapeake City'),
    new setLocation('55.9584','12.5269','Humlebæk'),
    new setLocation('30.0687','-89.9288','New Orleans'),		
    new setLocation('39.1534','-74.6929','Sea Isle City'),
    new setLocation('38.9072','-77.0369','Washington D.C.'),
    new setLocation('47.238','-93.5327','Grand Rapids'),		
    new setLocation('44.2312','-76.4860','Kingston'),
    new setLocation('44.4918','-63.9187','Peggys Point'),
    new setLocation('44.5421','-64.2389','Chester'),
    new setLocation('44.4592','-64.1619','Big Tancook Island'),
    new setLocation('43.0962','-79.0377','Niagara Falls'),
    new setLocation('41.3543','-71.9665','Mystic'),
    new setLocation('41.6688','-70.2962','Cape Cod'),
    new setLocation('41.0359','-71.9545','Montauk'),
    new setLocation('43.5670','-76.1277','Pulaski'),
    new setLocation('32.5149','-117.0382','Tujianna'),
    new setLocation('42.1014','-83.1087','Amherstburg'),
    new setLocation('42.6526','-73.7562','Albany'),
    new setLocation('40.8759','-75.7324','Jim Thorpe'),
    new setLocation('40.6259','-75.3705','Bethlehem'),
    new setLocation('53.3498','-6.2603','Dublin'),
    new setLocation('51.4852','-2.7679','Portishead'),
    new setLocation('28.3200','-80.6076','Cocoa Beach'),
    new setLocation('36.3803','-75.8308','Corolla Outer Banks'),
    new setLocation('34.8697','-111.7610','Sedona'),
    new setLocation('33.8303','-116.5453','Palm Springs'),
    new setLocation('41.2565','-95.9345','Omaha'),
    new setLocation('42.2917','-85.5872','Kalamazoo'),
    new setLocation('42.8864','-78.8784','Buffalo'),
    new setLocation('41.4901','-71.3128','Newport'),
    new setLocation('38.8032','-75.0946','Cape Henlopen'),
    new setLocation('40.3573','-74.6672','Princeton'),
    new setLocation('55.5940','12.6605','Dragør'),
     new setLocation('41.0807423','-75.420217','The Poconos'),
    // new setLocation('','',''),
    // new setLocation('','',''),
    // new setLocation('','',''),

]


    function goTravel(){
        var arrayLength = myTravels.length;
        for (var i = 0; i < arrayLength; i++) {
            console.log(myTravels[i].setAlt);
            setMarkers(myTravels[i].setLat, myTravels[i].setLng, myTravels[i].setAlt);
        }


    }

    function setMarkers(lat, lng, copy) {
        var marker = new google.maps.Marker({
            
            position: {
                lat: parseFloat(lat),
                lng: parseFloat(lng)
            },
            map: map, 
            title: copy
        });
   
        var infowindow = new google.maps.InfoWindow({
            content: copy
        });
    
        google.maps.event.addListener(marker, 'click', function () {
            if (infowindow) {
                infowindow.close();
            }
            infowindow.open(map, marker);
        });

        //markers.push(marker);
        //map.panTo(marker.getPosition());
    }

    function DeleteMarkers() {
        //Loop through all the markers and remove
        console.log(markers.length);
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }
        markers = [];
    };
