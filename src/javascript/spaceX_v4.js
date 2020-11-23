let loopCnt = 0;
let promises = [];

class LaunchInfo {
    constructor(id, name, date, rocket, place, desc, pic) {
        this.id = id;
        this.name = name;
        this.pic = pic;
        this.rocket = rocket;
        this.date = date;
        this.place = place;
        this.desc = desc;
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

    setPlace(place){
        this.place = place;
    }

    setDesc(desc){
        this.desc = desc;
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
    console.log(data);
    let description = "";
    for (let i = 0; i < loopCnt; i++){
        let launchInfo = new LaunchInfo(i);

        launchInfo.setName(data[i].name);
        launchInfo.setDate(makeDate(data[i]));
        launchInfo.setPic('falcon9.png');
        launchInfo.setDesc(data[i].details);
        
        promises.push(
            getLaunchPad(data[i].launchpad,launchInfo)
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
    console.log(id);
    var requestOptions = {
        method: 'GET', 
        redirect: 'follow',
        id: id
        };
    const res = await fetch('https://api.spacexdata.com/v4/launchpads',requestOptions );
    const data = await res.json();
    console.log('x',data);
    data.forEach(element => {
        if (element.id == id) obj.setPlace(element.name);
    });
}

async function getRocket(id,obj){
    console.log(id);
    var requestOptions = {
        method: 'GET', 
        redirect: 'follow',
        id: id
        };
    const res = await fetch('https://api.spacexdata.com/v4/rockets',requestOptions );
    const data = await res.json();
    console.log('y',data);
    data.forEach(element => {
        if (element.id == id) obj.setRocket(element.name);
    });
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
                <div class="launch__site launch__copy">${launch.place}</div>
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