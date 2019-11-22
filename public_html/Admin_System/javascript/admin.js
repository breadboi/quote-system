// DataTable Functionality
$(document).ready(function () {
    var params = {
        searching: false,
        paging: false,
        info: true
    }
    $('table').DataTable(params);
});

// Change in radio button selection for quote and sales associate search
$('input[type=radio][name=searchChoice]').change(function() {
    toggleQuoteFormItems(this);
});

// Date Range Picker
$(function() {
    $('input[name="daterange"]').daterangepicker({ startDate: moment(), endDate: moment().add(2, 'day')});
})

function toggleQuoteFormItems(context) {
    if (context.value == 0) 
    {
        $(".quoteFormItems").addClass("hiddenControl");
        $(".quoteFormItems").prop('required',false);
    }
    else if (context.value == 1)
    {
        $(".quoteFormItems").removeClass("hiddenControl");
        $(".quoteFormItems").prop('required',true);
    }
}
