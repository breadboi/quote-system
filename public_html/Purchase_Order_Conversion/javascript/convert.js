// Used for Modal form submission
$("#confirmSubmission").on("click", function() {
    $("#submitModal").trigger("click");
});

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
    var selectionCity = rowArray[4].text();
    var selectionEmail = rowArray[5].text();
    var selectionNotes = rowArray[6].text();
    var selectionDiscount = rowArray[7].text();
    $(this).parent().addClass("cellselect");

    // Set the field to the cell value
    $("#quoteId").attr("value", selectionId);
    $("#quoteCustomername").attr("value", selectionName);
    $("#quoteContact").attr("value", selectionCommission);
    $("#quoteStreet").attr("value", selectionAddress);
    $("#quoteCity").attr("value", selectionCity);
    $("#quoteEmail").attr("value", selectionEmail);
    $("#quoteSecretnotes").attr("value", selectionNotes);
    $("#quoteDiscount").attr("value", selectionDiscount); 
});