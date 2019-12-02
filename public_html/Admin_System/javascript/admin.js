// DataTable Functionality
$(document).ready(function () {
    var params = {
        searching: false,
        paging: false,
        info: true
    }
    $('table').DataTable(params);
});

// Change in radio button selection for quote and Line Item search
$('input[type=radio][name=searchChoice]').change(function() {
    toggleQuoteFormItems(this);
});

// Date Range Picker
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#daterange span').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
    }

    $('#daterange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

});

// Toggles form controls (0=lineitem, 1=Quote)
function toggleQuoteFormItems(context) {
    if (context.value == 0) 
    {
        $(".quoteFormItems").addClass("hiddenControl");
        $(".lineItemButtons").removeClass("hiddenControl");
    }
    else if (context.value == 1)
    {
        $(".quoteFormItems").removeClass("hiddenControl");
        $(".lineItemButtons").addClass("hiddenControl");
    }
}

// On click event for tables
$("td").on("click", function(e) {
    // Ensure the radio is checked so we aren't checking quotes
    if ($("#lineitem").prop("checked"))
    {
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
        var selectionNumber = rowArray[1].text();
        var selectionDescription = rowArray[2].text();
        var selectionPrice = rowArray[3].text();
        var selectionAddress = rowArray[4].text();

        $(this).parent().addClass("cellselect");

        // Set the field to the cell value
        $("#lineItemFieldId").attr("value", selectionId);
        $("#lineItemFieldNumber").attr("value", selectionNumber);
        $("#lineItemFieldDescription").attr("value", selectionDescription);
        $("#lineItemFieldPrice").attr("value", selectionPrice);
        $("#lineItemFieldQuoteId").attr("value", selectionAddress);
    }    
});

// Used for Modal form submission
$("#confirmSubmission").on("click", function() {
    $("#LineItemForm").trigger("click");
});

// Add LineItem Click event
$("#addLineItemButton").on("click", function() {
    // Enable editing (if previously disabled)
    $("#lineItemFieldNumber").attr("disabled", false);
    $("#lineItemFieldDescription").attr("disabled", false);
    $("#lineItemFieldPrice").attr("disabled", false);
    $("#lineItemFieldQuoteId").attr("disabled", false);

    // Remove existing values
    $("#lineItemFieldId").attr("value", "");
    $("#lineItemFieldNumber").attr("value", "");
    $("#lineItemFieldPrice").attr("value", "");
    $("#lineItemFieldQuoteId").attr("value", "");

    // Define what the form is for
    $("#addLineItem").attr("checked", true);

    // Set title
    $("#LineItemModalTitle").text("Add a new Line Item");
});

// Edit LineItem Click event
$("#editLineItemButton").on("click", function() {
    // Enable editing (if previously disabled)
    $("#lineItemFieldNumber").attr("disabled", false);
    $("#lineItemFieldDescription").attr("disabled", false);
    $("#lineItemFieldPrice").attr("disabled", false);
    $("#lineItemFieldQuoteId").attr("disabled", false);

    // Define what the form is for
    $("#editLineItem").attr("checked", true);

    // Set title
    $("#LineItemModalTitle").text("Edit Selected Line Item");
});

// Delete LineItem Click event
$("#deleteLineItemButton").on("click", function() {
    // Define what the form is for
    $("#deleteLineItem").attr("checked", true);

    // Set title
    $("#LineItemModalTitle").text("Delete Selected Line Item with the Following Information?");

    // Prevent editing
    $("#lineItemFieldNumber").attr("disabled", true);
    $("#lineItemFieldDescription").attr("disabled", true);
    $("#lineItemFieldPrice").attr("disabled", true);
    $("#lineItemFieldQuoteId").attr("disabled", true);
});