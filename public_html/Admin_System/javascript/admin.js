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

$("td").on("click", function(e) { 
    e.preventDefault();
    //alert(this);

    // Remove previous highlighting
    $("tr").removeClass("cellselect");    

    alert($(this).parents('tr')[0].text());

    // Create row array variable
    var rowArray = [];

    // For each cell, we push to an array
    $(this).parents('tr').find('td').each(function() {
        // For each cell
        rowArray.push($(this));
    });

    // Assign each row cell to a variable
    var selectionId = rowArray[0];
    var selectionName = rowArray[1];
    var selectionCommission = rowArray[2];
    var selectionAddress = rowArray[3];

    $(this).parent().addClass("cellselect");

    // set the field to the row value
    $("#associateIdField").attr("value", selectionId);
    $("#associateNameField").attr("value", selectionName);
    $("#associateCommissionField").attr("value", selectionCommission);
    $("#associateAddressField").attr("value", selectionAddress);
});