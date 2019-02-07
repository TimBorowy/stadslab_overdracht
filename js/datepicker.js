function addDays(date, days) {
    let result = new Date(date);
    result.setDate(result.getDate() + days);

    return result;
}

// Format date in correct format
function formatDate(date) {
    let d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}

// Make timestamp function so I can compare dates
function getTimeStampFromDate(date){
    let newDate = new Date(date);
    return newDate.getTime() / 1000;
}

// Fetch the date field elements.
startDatePicker = document.getElementById('date-start');
endDatePicker = document.getElementById('date-end');

formattedDayToday = formatDate(new Date());
startDatePicker.setAttribute('min', formattedDayToday);

// Set min and max dates on calender
startDatePicker.addEventListener("change", function() {
    let formattedEndDate = formatDate(addDays(startDatePicker.value, 14));
    endDatePicker.value = formattedEndDate;

    startDatePicker.setAttribute('min', formattedDayToday);
    endDatePicker.setAttribute('max', formattedEndDate);
});

// Compare 2 dates and make display conditional
endDatePicker.addEventListener("change", function() {
    let formattedEndDate = formatDate(endDatePicker.value);
    let x = document.getElementById('date-verified');

    let timeDifference = getTimeStampFromDate(formattedEndDate) - getTimeStampFromDate(formattedDayToday);
    let secondsIn14Days = 60*60*24*14;

    if (timeDifference > secondsIn14Days) {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }

});
