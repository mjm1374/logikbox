
let tardis = (function (theTime, pattern) {
    // Keep this variables private inside this closure scope
    const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const months = ["January", "Febuary", "March", "April", "May", "June", "July", "August", "September", "October", "November", "Decemeber"];
    const patterns = ["YYYY", "YY", "y", "MMMM", "MMM", "MM", "M", "m", "DDDD", "DDD", "DD", "D", "d", "H", "h", "I", "i", "S", "s", "TT", "tt"];

    function convertTime(theTime) {
        theTime = checkUnixTime(theTime);
        let date = new Date(theTime * 1000);
        let dateObj = {
            year: date.getYear(),
            day: date.getDate(),
            month: (date.getMonth() + 1),
            hour: date.getHours(),
            min: ("0" + date.getMinutes()).slice(-2),
            sec: ("0" + date.getSeconds()).slice(-2),
            fullYear: date.getFullYear(),
            shortYear: date.getYear().toString().substr(-2),
            dayofweek: days[date.getDay()],
            midDayofweek: days[date.getDay()].substr(0, 3),
            dayInt: date.getDay(),
            fullMonth: months[date.getMonth()],
            midMonth: months[date.getMonth()].substr(0, 3),
            shortMonth: ("0" + (date.getMonth() + 1)).slice(-2),
            monthInt: date.getMonth(),
            utc: date,
            timestamp: theTime
        };
        return dateObj;
    }

    function checkUnixTime(theTime) {
        if (theTime == '' || theTime == undefined) theTime = Math.floor(Date.now() / 1000);
        let checkedTime = theTime;

        if (!isNaN(Date.parse(checkedTime))) {
            checkedTime = checkedTime.split(" - ").map(function (date) {
                return Date.parse(date + "-0500") / 1000;
            }).join(" - ");
        }

        return checkedTime;
    }

    // Public methods
    let dateparts = theTime => {
        return convertTime(theTime);
    };

    // Freeform patterns
    let patterned = (theTime, pattern) => {
        let thisDate = convertTime(theTime);
        let replaceStr = '';
        let TT = (thisDate.hour < 11) ? "AM" : "PM";
        let tt = (thisDate.hour < 11) ? "am" : "pm";

        patterns.forEach(function (val, index) {
            //console.log(val);
            switch (val) {
                case 'YYYY':
                    replaceStr = thisDate.fullYear;
                    break;
                case 'YY':
                    replaceStr = thisDate.shortYear;
                    break;
                case 'Y':
                    replaceStr = thisDate.year;
                    break;
                case 'MMMM':
                    replaceStr = thisDate.fullMonth;
                    break;
                case 'MM':
                    replaceStr = thisDate.shortMonth;
                    break;
                case 'M':
                    replaceStr = thisDate.month;
                    break;
                case 'DDDD':
                    replaceStr = thisDate.dayofweek;
                    break;
                case 'DD':
                    replaceStr = thisDate.day;
                    break;
                case 'D':
                    replaceStr = thisDate.day;
                    break;
                case 'H':
                    replaceStr = thisDate.hour;
                    break;
                case 'h':
                    replaceStr = thisDate.hour;
                    break;
                case 'I':
                    replaceStr = thisDate.min;
                    break;
                case 'i':
                    replaceStr = thisDate.min;
                    break;
                case 'S':
                    replaceStr = thisDate.sec;
                    break;
                case 's':
                    replaceStr = thisDate.sec;
                    break;
                case 'TT':
                    replaceStr = TT;
                    break;
                case 'tt':
                    replaceStr = tt;
                    break;
            }
            pattern = pattern.replace(val, replaceStr);
        });

        return {
            pattern: pattern,
            time: theTime
        };
    };

    // Preset patterns
    let ISO = theTime => {
        let thisDate = convertTime(theTime);
        let formattedDate = thisDate.fullYear + "-" + thisDate.shortMonth + "-" + thisDate.day;

        return formattedDate;
    };

    let ShortDate = theTime => {
        let thisDate = convertTime(theTime);
        let formattedDate = thisDate.shortMonth + "/" + thisDate.day + "/" + thisDate.fullYear;

        return formattedDate;
    };

    let LongDate = theTime => {
        let thisDate = convertTime(theTime);
        let formattedDate = thisDate.midMonth + " " + thisDate.day + " " + thisDate.fullYear;

        return formattedDate;
    };

    let MonthDateTime = theTime => {
        let thisDate = convertTime(theTime);
        let formattedDate = thisDate.fullMonth + ' ' + thisDate.day + ', ' + thisDate.fullYear + ' ' + thisDate.hour + ':' + thisDate.min;

        return formattedDate;
    };

    let DayMonthDate = theTime => {
        let thisDate = convertTime(theTime);
        let formattedDate = thisDate.dayofweek + ",  " + thisDate.fullMonth + " " + thisDate.day + "." + thisDate.fullYear;

        return formattedDate;
    };

    // Nerd stuff
    let doctorwho = function () {
        console.log('Spoilers!');
        let quotes = ['Bowties are cool.', 'Rule 1, the Doctor lies.', 'I’m a mad man with a box.', 'Run!', 'and Don’t Blink!', 'Fezzes are cool.', 'Never cruel or cowardly. Never give up, never give in.', 'Do what I do. Hold tight and pretend it’s a plan!', 'Rest is for the weary, sleep is for the dead', 'We’re all stories, in the end. Just make it a good one, eh?', 'Good men don’t need rules', 'Never run when you’re scared.', 'What’s the point in two hearts if you can’t be a bit forgiving now and then?', 'There’s no point in being grown up if you can’t be childish sometimes.', 'You want weapons? We’re in a library! Books! The best weapons in the world!', 'A straight line may be the shortest distance between two points, but it is by no means the most interesting', 'Come on, Rory! It isn’t rocket science, it’s just quantum physics!', 'Big flashy things have my name written all over them. Well… not yet, give me time and a crayon.', 'In 900 years of time and space, I’ve never met anyone who wasn’t important', 'Almost every species in the universe has an irrational fear of the dark. But they’re wrong. ‘Cause it’s not irrational.', 'Biting’s excellent. It’s like kissing – only there is a winner.', 'Never be certain of anything. It’s a sign of weakness.', 'Spoilers!', 'Geronimo', 'Hello Sweetie'];

        return quotes[Math.floor(Math.random() * quotes.length)];
    };

    return {
        dateparts: dateparts,
        patterned: patterned,
        ISO: ISO,
        ShortDate: ShortDate,
        LongDate: LongDate,
        MonthDateTime: MonthDateTime,
        DayMonthDate: DayMonthDate,
        doctorwho: doctorwho
    };

}());