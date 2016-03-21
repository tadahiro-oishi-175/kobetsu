$(document).ready(function () {
    $('#date').datepicker({
        dateFormat: 'yy/mm/dd',
        beforeShowDay: function (date) {
            if (date.getDay() === 0) {
                return [true, 'class-sunday'];
            } else if (date.getDay() === 6) {
                return [true, 'class-saturday'];
            } else {
                return [true, 'class-weekday'];
            }
        }
    });
    $('#regDate').datepicker({
        dateFormat: 'yy/mm/dd',
        beforeShowDay: function (date) {
            if (date.getDay() === 0) {
                return [true, 'class-sunday'];
            } else if (date.getDay() === 6) {
                return [true, 'class-saturday'];
            } else {
                return [true, 'class-weekday'];
            }
        }
    });
    $('#finDate').datepicker({
        dateFormat: 'yy/mm/dd',
        beforeShowDay: function (date) {
            if (date.getDay() === 0) {
                return [true, 'class-sunday'];
            } else if (date.getDay() === 6) {
                return [true, 'class-saturday'];
            } else {
                return [true, 'class-weekday'];
            }
        }
    });
});
