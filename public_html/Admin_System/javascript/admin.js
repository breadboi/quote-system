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

// Toggles form controls (0=SalesAssociate, 1=Quote)
function toggleQuoteFormItems(context) {
    if (context.value == 0) 
    {
        $(".quoteFormItems").addClass("hiddenControl");
        $(".associateButtons").removeClass("hiddenControl");
    }
    else if (context.value == 1)
    {
        $(".quoteFormItems").removeClass("hiddenControl");
        $(".associateButtons").addClass("hiddenControl");
    }
}

// On click event for tables
$("td").on("click", function(e) {
    // Ensure the radio is checked so we aren't checking quotes
    if ($("#salesassociate").prop("checked"))
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
        var selectionName = rowArray[1].text();
        var selectionCommission = rowArray[2].text();
        var selectionAddress = rowArray[3].text();

        $(this).parent().addClass("cellselect");

        // Set the field to the cell value
        $("#associateFieldId").attr("value", selectionId);
        $("#associateFieldName").attr("value", selectionName);
        $("#associateFieldCommission").attr("value", selectionCommission);
        $("#associateFieldAddress").attr("value", selectionAddress);
    }    
});

// Used for Modal form submission
$("#confirmSubmission").on("click", function() {
    $("#associateForm").trigger("click");
});

// Add Associate Click event
$("#addAssociateButton").on("click", function() {
    // Enable editing (if previously disabled)
    $("#associateFieldName").attr("disabled", false);
    $("#associateFieldPassword").attr("disabled", false);
    $("#associateFieldCommission").attr("disabled", false);
    $("#associateFieldAddress").attr("disabled", false);

    // Remove existing values
    $("#associateFieldId").attr("value", "");
    $("#associateFieldName").attr("value", "");
    $("#associateFieldCommission").attr("value", "");
    $("#associateFieldAddress").attr("value", "");

    // Define what the form is for
    $("#addAssociate").attr("checked", true);

    // Set title
    $("#associateModalTitle").text("Add a new Sales Associate");
});

// Edit Associate Click event
$("#editAssociateButton").on("click", function() {
    // Enable editing (if previously disabled)
    $("#associateFieldName").attr("disabled", false);
    $("#associateFieldPassword").attr("disabled", false);
    $("#associateFieldCommission").attr("disabled", false);
    $("#associateFieldAddress").attr("disabled", false);

    // Define what the form is for
    $("#editAssociate").attr("checked", true);

    // Set title
    $("#associateModalTitle").text("Edit Selected Sales Associate");
});

// Delete Associate Click event
$("#deleteAssociateButton").on("click", function() {
    // Define what the form is for
    $("#deleteAssociate").attr("checked", true);

    // Set title
    $("#associateModalTitle").text("Delete Selected Sales Associate with the Following Information?");

    // Prevent editing
    $("#associateFieldName").attr("disabled", true);
    $("#associateFieldPassword").attr("disabled", true);
    $("#associateFieldCommission").attr("disabled", true);
    $("#associateFieldAddress").attr("disabled", true);
});