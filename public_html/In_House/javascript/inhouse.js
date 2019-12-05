var CURRENT_ROW_ID;
var CURRENT_ROW_DISCOUNT;
var CURRENT_ROW_NOTES;

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
$('input[type=radio][name=searchChoice]').change(function () {
    toggleQuoteFormItems(this);
});

// Date Range Picker
$(function () {

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
    if (context.value == 0) {
        $(".quoteFormItems").addClass("hiddenControl");
        $(".lineItemButtons").removeClass("hiddenControl");
    } else if (context.value == 1) {
        $(".quoteFormItems").removeClass("hiddenControl");
        $(".lineItemButtons").addClass("hiddenControl");
    }
}

// On click event for tables not dynamically generated
$("td").on("click", function (e) {
    highlightQuoteRow(this, e);
});

/**
 * Used for highlighting rows
 * @param {"this"} context 
 * @param {"event"} e 
 */
function highlightQuoteRow(context, e) {
    // Ensure the radio is checked so we aren't checking quotes
    e.preventDefault();

    // Remove previous highlighting
    $("tr").removeClass("cellselect");

    // Create row array variable
    var rowArray = [];

    // For each cell, we push to an array
    $(context).parents('tr').find('td').each(function () {
        // For each cell
        rowArray.push($(this));
    });

    // Assign each row cell to a variable
    var selectionId = rowArray[0].text();
    var selectionDiscount = rowArray[3].text();
    var selectionNotes = rowArray[4].text();
    $(context).parent().addClass("cellselect");

    CURRENT_ROW_ID = selectionId;
    CURRENT_ROW_DISCOUNT = selectionDiscount;
    CURRENT_ROW_NOTES = selectionNotes;
}

/**
 * Used for highlighting rows in modals and calling
 * ajax function
 * @param {"this"} context 
 */
function highlightModalRow(context) {
    // Remove previous highlighting
    $("tr").removeClass("cellselect");

    // Create row array variable
    var rowArray = [];

    // For each cell, we push to an array
    $(context).parents('tr').find('td').each(function () {
        // For each cell
        rowArray.push($(this));
    });

    // Assign each row cell to a variable
    var lineId = rowArray[0].text();
    var lineNumber = rowArray[1].text();
    var description = rowArray[2].text();
    var price = rowArray[3].text();
    $(context).parent().addClass("cellselect");

    // Send these values to ajaxEditRow.php using ajax
    getRowEdit(lineId, lineNumber, description, price);
}

// Used for Modal form submission
$("#confirmSubmission").on("click", function () {
    $("#LineItemForm").trigger("click");
});

// Add LineItem Click event
$("#viewLineItemButton").on("click", function () {
    // Set title
    $("#associateModalTitle").text("Line Item Editor");

    getPage(CURRENT_ROW_ID);
});

// Add Quote Click event
$("#editQuoteButton").on("click", function () {
    // Set title
    $("#associateModalTitle").text("Quote Editor");

    loadEditQuote(CURRENT_ROW_ID);
});

// Add Sanction Click event
$("#sanctionQuoteButton").on("click", function () {
    // Set title
    $("#associateModalTitle").text("Sanction Quote");
    
    loadModalRow();
});

function getPage(id) {
    $('#tableTarget').html('<img src="https://icon-library.net/images/loading-icon-transparent-background/loading-icon-transparent-background-3.jpg" style=\"width:50px;height:50px;text-align:center;\"  />');

    jQuery.ajax({
        url: "http://students.cs.niu.edu/~z1860518/Quote_System/public_html/In_House/views/ajaxModalTable.php",
        data: 'id=' + id,
        type: "POST",
        dataType: "html",
        success: function (data) {
            $('#tableTarget').html(data);
        }
    });
}

/**
 * 
 * @param {"int"} lineId
 * @param {"int"} lineNumber 
 * @param {"string"} description 
 * @param {"float"} price 
 */
function getRowEdit(lineId, lineNumber, description, price) {
    $('#tableTarget').html('<img src="https://icon-library.net/images/loading-icon-transparent-background/loading-icon-transparent-background-3.jpg" style=\"width:50px;height:50px;text-align:center;\"  />');

    jQuery.ajax({
        url: "http://students.cs.niu.edu/~z1860518/Quote_System/public_html/In_House/views/ajaxEditRow.php",
        data: 'lineId=' + lineId + '&lineNumber=' + lineNumber + '&description=' + description + '&price=' + price,
        type: "POST",
        dataType: "html",
        success: function (data) {
            $('#tableTarget').html(data);
        }
    });
}

/**
 * Utilizes ajax to call deleteLineItem.php
 * and remove line item with lineId arg. 
 * On success
 * @param {"int"} lineId 
 */
function deleteLineItem(lineId) {
    jQuery.ajax({
        url: "http://students.cs.niu.edu/~z1860518/Quote_System/public_html/In_House/views/deleteLineItem.php",
        data: 'lineItemId=' + lineId,
        type: "POST",
        dataType: "html",
        success: function () {
            getPage(CURRENT_ROW_ID);
        }
    });
}

function addLineItem() {
    var lineNumber = $("#lineItemNumber").val();
    var description = $("#lineItemDescription").val();
    var price = $("#lineItemPrice").val();
    var quoteId = $("#lineItemQuoteId").val();

    jQuery.ajax({
        url: "http://students.cs.niu.edu/~z1860518/Quote_System/public_html/In_House/views/insertLineItem.php",
        data: 'lineItemNumber=' + lineNumber + '&lineItemDescription=' + description + '&lineItemPrice=' + price + '&lineItemQuoteId=' + quoteId,
        type: "POST",
        dataType: "html",
        success: function () {
            getPage(CURRENT_ROW_ID);
        }
    });
}

function editLineItem(lineItemId) {
    var lineNumber = $("#lineItemNumber").val();
    var description = $("#lineItemDescription").val();
    var price = $("#lineItemPrice").val();

    jQuery.ajax({
        url: "http://students.cs.niu.edu/~z1860518/Quote_System/public_html/In_House/views/updateLineItem.php",
        data: 'lineItemId=' + lineItemId + '&lineItemNumber=' + lineNumber + '&lineItemDescription=' + description + '&lineItemPrice=' + price + '&lineItemQuoteId=' + CURRENT_ROW_ID,
        type: "POST",
        dataType: "html",
        success: function () {
            getPage(CURRENT_ROW_ID);
        }
    });
}

function loadInsertPage() {
    jQuery.ajax({
        url: "http://students.cs.niu.edu/~z1860518/Quote_System/public_html/In_House/views/ajaxInsertRow.php",
        data: 'quoteId=' + CURRENT_ROW_ID,
        type: "POST",
        dataType: "html",
        success: function (data) {
            $('#tableTarget').html(data);
        }
    });
}

function loadEditQuote(id) {
    $('#tableTarget').html('<img src="https://icon-library.net/images/loading-icon-transparent-background/loading-icon-transparent-background-3.jpg" style=\"width:50px;height:50px;text-align:center;\"  />');

    jQuery.ajax({
        url: "http://students.cs.niu.edu/~z1860518/Quote_System/public_html/In_House/views/ajaxEditQuote.php",
        data: 'quoteId=' + id + '&quoteDiscount=' + CURRENT_ROW_DISCOUNT + '&quoteNotes=' + CURRENT_ROW_NOTES,
        type: "POST",
        dataType: "html",
        success: function (data) {
            $('#tableTarget').html(data);
        }
    });
}

function editQuoteItem() {
    var quoteDiscount = $("#quoteDiscount").val();
    var quoteNotes = $("#quoteNotes").val();

    jQuery.ajax({
        url: "http://students.cs.niu.edu/~z1860518/Quote_System/public_html/In_House/views/updateQuote.php",
        data: 'quoteId=' + CURRENT_ROW_ID + '&quoteDiscount=' + quoteDiscount + '&quoteNotes=' + quoteNotes,
        type: "POST",
        dataType: "html",
        success: function () {
            $("#confirmationModal").modal("hide");
        }
    });
}

function loadModalRow() {
    $('#tableTarget').html('<img src="https://icon-library.net/images/loading-icon-transparent-background/loading-icon-transparent-background-3.jpg" style=\"width:50px;height:50px;text-align:center;\"  />');
    
    jQuery.ajax({
        url: "http://students.cs.niu.edu/~z1860518/Quote_System/public_html/In_House/views/ajaxModalRow.php",
        data: 'quoteId=' + CURRENT_ROW_ID,
        type: "POST",
        dataType: "html",
        success: function (data) {
            $('#tableTarget').html(data);
        }
    });
}

function sanctionQuote(id) {    
    jQuery.ajax({
        url: "http://students.cs.niu.edu/~z1860518/Quote_System/public_html/In_House/views/sanctionQuote.php",
        data: 'quoteId=' + id,
        type: "POST",
        dataType: "html",
        success: function (data) {
            location.reload();
        }
    });
}
