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

// Toggles form controls
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

// On click event for tables
$("td").on("click", function(e) { 
    e.preventDefault();

    // Remove previous highlighting
    $("tr").removeClass("cellselect");

    // Create row array variable
    var rowArray = [];

    // For each cell, we push to an array
    $(this).parents('tr').find('td').each(function() {
        // For each cell
        rowArray.push($(this));
    });

    // Assign each row cell to a variable
    var selectionId = rowArray[0].text();
    var selectionName = rowArray[1].text();
    var selectionCommission = rowArray[2].text();
    var selectionAddress = rowArray[3].text();

    $(this).parent().addClass("cellselect");

    // Set the field to the cell value
    $("#associateFieldId").attr("value", selectionId);
    $("#associateFieldName").attr("value", selectionName);
    $("#associateFieldCommission").attr("value", selectionCommission);
    $("#associateFieldAddress").attr("value", selectionAddress);
});