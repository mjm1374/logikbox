//module for dates and time formating and converting.

let tardis = (function (theTime) {
    if (theTime == '' || theTime == undefined) theTime = (Date.now() / 1000);

    const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const months = ["January", "Febuary", "March", "April", "May", "June", "July", "August", "September", "October", "November", "Decemeber"];

    function convertTime(theTime){
        //theTime = checkUnixTime(theTime);
        var date = new Date(theTime * 1000);
        var converteddate = {
            day : date.getDate(),
            month : (date.getMonth() + 1),
            year : date.getYear(),
            fullYear : date.getFullYear(),
            hour : date.getHours(),
            min : ("0" + date.getMinutes()).slice(-2),
            sec : ("0" + date.getSeconds()).slice(-2),
            dayofweek : days[date.getDay()],
            fullMonth : months[date.getMonth()]
        };
        return converteddate;
    }

    function checkUnixTime(theTime){
        let checkedTime = theTime;

        if (!isNaN(Date.parse(checkedTime))) checkedTime = Date.parse(theTime);

        return checkedTime;
    }

    var dateparts = theTime => {
        return convertTime(theTime);
    }
    

    // Keep this variables private inside this closure scope
    var privateFunction = function () {
        console.log('privateFunction ran');
        var privateMsg = 'ldx-date imported';
        return privateMsg;
    };

    var unixToMonthDateTime = theTime => {
        //console.log('unixToString: ' + theTime);
        var thisDate = convertTime(theTime);
        var time = thisDate.fullMonth + ' ' + thisDate.day + ', ' + thisDate.fullYear + ' ' + thisDate.hour + ':' + thisDate.min;

        return time;
    };

    var unixToDayMonthDate = theTime => {
        //console.log('unixToDayMonthDate: ' + theTime);
        var thisDate = convertTime(theTime);
        let fullDate = thisDate.dayofweek + ",  " + thisDate.fullMonth + " " + thisDate.day + "." + thisDate.fullYear;

        return fullDate;
    };

    return {
        privateFunction: privateFunction,
        unixToMonthDateTime: unixToMonthDateTime,
        unixToDayMonthDate: unixToDayMonthDate,
        dateparts: dateparts
    };

}());