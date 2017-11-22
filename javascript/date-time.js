/**
 * Returns the first date of a given month
 *
 * Note:
 * - This functions expects the human month number
 * - Javascript months start at 0
 */
function getFirstDateOfMonth(year, month) {

    // var today = new Date();
    // var todayDate = today.getDate();
    // var todayMonth = today.getMonth() + 1;
    // var todayYear = today.getFullYear();

    // // If today's month (and year) return today as date
    // if ( year == todayYear && month == todayMonth) {
    //     return new Date(year, (month - 1), todayDate);
    // }

    // Get Date object of first date of the given month
    return new Date(year, (month - 1), 1);
}

/**
 * Returns the last date of a given month
 *
 * Note:
 * - This functions expects the human month number
 * - Javascript months start at 0
 */
function getLastDateOfMonth(year, month) {
    
    // return Date object of last date of the given month
    return new Date(year, month, 0);
}

/**
 * Helper function to convert date object to a date format
 */
function stringifyDate(date, format) {

    if (format === undefined) {
        format = 'yyyy-mm-dd';
    }

    var year = date.getFullYear();
    var month = ("0" + (date.getMonth() + 1)).slice(-2);
    var day = ("0" + date.getDate()).slice(-2);

    var dateString = '';

    if (format == 'yyyy-mm-dd') {
        dateString = year + '-' + month + '-' + day;
    }
    else if (format == 'dd-mm-yyyy') {
        dateString = day + '-' + month + '-' + year;
    }
    else {
        dateString = 'No accepted format';
    }

    return dateString;
}

// Returns the minutes. Accepts 09:00:00 and 09:00
function parseTimeToMinutes(s) {
    var c = s.split(':');
    return parseInt(c[0]) * 60 + parseInt(c[1]);
}

// Parses minutes to 09:00:00 or 09:00 format
function parseMinutesToTime(minutes, showSeconds) {

    var resultHours = Math.floor(minutes / 60);
    var resultMinutes = ("0" + minutes % 60).slice(-2);
    var resultSeconds = (showSeconds) ? ':00' : '';

    return ("0" + resultHours).slice(-2) + ':' + ("0" + resultMinutes).slice(-2) + resultSeconds;
}

// Subtract time (without seconds). Accepts 09:00:00 and 09:00. 
// Returns format hh:mm:00
// Function does not processes start and beginning of day!!
function subtractTime(time, subtractTime) {

    var timeMinutes = parseTimeToMinutes(time);
    var subtractTimeMinutes = parseTimeToMinutes(subtractTime);
    
    return parseMinutesToTime(timeMinutes - subtractTimeMinutes, true); 
}

// Increase time (without seconds). Accepts 09:00:00 and 09:00. 
// Returns format hh:mm:00
// Function does not processes start and beginning of day!!
function increaseTime(time, increaseTime) {

    var timeMinutes = parseTimeToMinutes(time);
    var increaseTimeMinutes = parseTimeToMinutes(increaseTime);

    return parseMinutesToTime(timeMinutes + increaseTimeMinutes, true); 
}
