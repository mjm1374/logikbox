let loopCnt = 0;
let promises = [];

class LaunchInfo {
    constructor(id, name, date, rocket, launchPad, landingPad, desc, pic, capsule) {
        this.id = id;
        this.name = name;
        this.pic = pic;
        this.rocket = rocket;
        this.date = date;
        this.launchPad = launchPad;
        this.landingPad =  landingPad;
        this.desc = desc;
        this.capsule = capsule;
    }

    setName(name){
        this.name = name;
    }

    setPic(pic){
        this.pic = pic;
    }

    setRocket(rocket){
        this.rocket = rocket;
    }

    setDate(date){
        this.date = date;
    }

    setLandingPad(launchPad){
        this.launchPad = launchPad;
    }

    setLandinghPad(landingPad){
        this.landingPad = landingPad;
    }

    setDesc(desc){
        this.desc = desc;
    }

    setCapsule(capsule){
        this.capsule = capsule;
    }

    getCapsule(){
        return this.capsule;
    }
}

function GetSpaceXV4(cnt) {
    loopCnt =  cnt;
    fetch('https://api.spacexdata.com/v4/launches/upcoming',  {
        limit: cnt})
        .then(response => response.json())
        .then(data => processData(data))
        .catch(error => console.log('error', error));
}

function processData(data){
    data.sort((a,b) => (a.date_unix > b.date_unix) ? 1 : (a.date_unix === b.date_unix) ? ((a.flight_number > b.flight_number) ? 1 : -1) : -1 );

    for (let i = 0; i < loopCnt; i++){
        let launchInfo = new LaunchInfo(i);

        launchInfo.setName(data[i].name);
        launchInfo.setDate(makeDate(data[i]));

        (data[i].details ===  null ) ? launchInfo.setDesc('There are no details available for this mission.') : launchInfo.setDesc(data[i].details);
        
        promises.push(
            getLaunchPad(data[i].launchpad,launchInfo)
        );

        promises.push(
            getLandingPad(data[i].cores[0].landpad,launchInfo)
        );

        promises.push(
            getRocket(data[i].rocket,launchInfo)
        );
        
        Promise.all(promises).then(() => {
            buildTargetBlock(launchInfo);
        }
        
        );
    }
    
}

async function getLaunchPad(id,obj){
    const res = await fetch('https://api.spacexdata.com/v4/launchpads/' + id );
    const data = await res.json();
    obj.setLandingPad(data.name);
}

async function getLandingPad(id,obj){
    if(id !== null){
    const res = await fetch('https://api.spacexdata.com/v4/landpads/' + id );
    const data = await res.json();
        obj.setLandinghPad(data.name);
    }
    else{
        obj.setLandinghPad('TBD');
    }
    
}

async function getRocket(id,obj){
    let requestOptions = {
        method: 'GET', 
        redirect: 'follow',
        id: id
        };
    const res = await fetch('https://api.spacexdata.com/v4/rockets/' + id );
    const data = await res.json();
    obj.setPic('falcon9.png');

    if (data.id == id) {
        obj.setRocket(data.name)

        switch (data.name){
            case 'Falcon 9': 
            obj.setPic('falcon9.png');
            break;
            case 'Falcon Heavy': 
            obj.setPic('falconheavy.png');
            break;
            case 'Starship': 
            obj.setPic('Starship.png');
            break;

        }
    
    };
}


function makeDate(launch){
    let launchDate = tardis.MonthDateTime(launch.date_unix) + '<br /><span class="italic">';

        (launch.upcoming) ? launchDate += "tenative up to a " + launch.date_precision : launchDate += "&nbsp;";

        launchDate += "</span>";
                
    return launchDate
}

function buildTargetBlock(launch) {
    const targetDiv = document.getElementById('launchBlockHolder');
    let targetBlock = makeElement('div', 'col-md-4'); 
    targetBlock.appendChild(makeElement('div', 'launchContainer', `launchBlock${launch.id}`));
    targetDiv.appendChild(targetBlock);

	let targetCopy = `
                <img src="img/spacex/${launch.pic}" class="launch__img launch__copy" />
                <div class="launch__mission__name launch__copy">${launch.name}</div>
                <div class="launch__rocket launch__copy">${launch.rocket}</div>
                <div class="launch__date launch__copy">${launch.date}</div>
                <div class="launch__site launch__copy">Launch: ${launch.launchPad}</div>
                <div class="launch__site launch__copy">Landing: ${launch.landingPad}</div>
                <hr />
                <div class="launch__details launch__copy">${launch.desc}</div>
                `;
    
    const launchInfoBlock = document.getElementById(`launchBlock${launch.id}`);
    
    launchInfoBlock.innerHTML = targetCopy;
}

/* Make and element
    elem: string {required} -  type of DOM element you want to create
    cssClasses: string {optional} -  can be comma deliminated to attach multiple classes
    elemID: string {optional} - Element ID is needed
*/
function makeElement(elem, cssClasses, elemID){
    let theClasses = [];
    if(cssClasses != undefined) theClasses = cssClasses.split(', ');
    if(typeof elem !== "undefined" && elem.trim() !== ''){
        const newElem = document.createElement(elem);
        if (theClasses.length > 0 && theClasses[0] !== '') {
            theClasses.forEach(cssClass =>
            newElem.classList.add(cssClass));
        };
        if (elemID != undefined && elemID != '') newElem.setAttribute("id", elemID);
        
        return newElem;
    } 
}