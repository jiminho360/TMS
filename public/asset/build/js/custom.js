function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    return !(charCode > 31 && (charCode < 48 || charCode > 57));
}

function isFloat(evt){
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    return !(charCode !== 46 && (charCode < 48 || charCode > 57));
}

/*
$(".allow_decimal").on("input", function(evt) {
    var self = $(this);
    self.val(self.val().replace(/[^0-9\.]/g, ''));
    if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57))
    {
        evt.preventDefault();
    }
});*/



function addCommas(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

$('.dd_select').select2();

function deleteConfirm(Description, Url) {
    Swal({
        title: 'Are you sure?',
        text: Description + ' Will be Deleted!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, keep it',
        confirmButtonColor: "#DD6B55",
        cancelButtonColor: "#5bc0de"
    }).then((result) => {
        if (result.value) {
            $(location).attr('href', Url);
        } else if (result.dismiss === Swal.DismissReason.cancel) {
        }
    })
}


//Normal Date Picker
function datePickerLoad() {
    const DateToday = new Date();
    $('.datePicker').datepicker({
        orientation: "auto",
        todayBtn: "linked",
        keyboardNavigation: true,
        forceParse: false,
        calendarWeeks: true,
        autoClose: true,
        format: "yyyy-mm-dd"
    });
}

//Date Picker Date from today and after
function datePickerLoadAfter() {
    const DateToday = new Date();
    $('.datePickerAfter').datepicker({
        orientation: "auto",
        todayBtn: "linked",
        keyboardNavigation: true,
        forceParse: false,
        calendarWeeks: true,
        autoClose: true,
        startDate: DateToday,
        format: "yyyy-mm-dd"
    });
}

//Date picker with date before today
function datePickerLoadBefore() {
    const DateToday = new Date();
    $('.datePickerBefore').datepicker({
        orientation: "auto",
        todayBtn: "linked",
        keyboardNavigation: true,
        forceParse: false,
        calendarWeeks: true,
        autoClose: true,
        endDate: DateToday,
        format: "yyyy-mm-dd"
    });
}