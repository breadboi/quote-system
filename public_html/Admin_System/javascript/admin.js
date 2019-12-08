/**
 * Once the document has loaded,
 * setup datatables on tables with
 * table class.
 */
$(document).ready(function () {
    var params = {
        searching: false,
        paging: false,
        info: true
    }
    $('table').DataTable(params);
});

/**
 * On change event for radio buttons with the name of searchChoice
 */
$('input[type=radio][name=searchChoice]').change(function() {
    toggleQuoteFormItems(this);
});

/**
 * Daterange picker function
 */
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

/**
 * Toggles form controls (0=SalesAssociate, 1=Quote)
 * @param {"Pass 'this' to provide context"} context 
 */
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

/**
 * On click event for td that grabs the row values
 * and passes them to the next form while also highlighting
 * the selected row.
 */
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

/**
 * Passes confirmSubmission click to associateForm
 */
$("#confirmSubmission").on("click", function() {
    $("#associateForm").trigger("click");
});

/**
 * On click setup form for add associate action
 */
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

/**
 * On click setup form for edit associate action
 */
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

/**
 * On click setup form for delete associate action
 */
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