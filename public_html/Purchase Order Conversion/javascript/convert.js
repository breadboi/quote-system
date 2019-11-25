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
    var selectionContact = rowArray[2].text();
    var selectionStreet = rowArray[3].text();
    var selectionCity = rowArray[4].text();
    var selectionNotes = rowArray[5].text();
    var selectionStatus = rowArray[6].text();
    var selectionDiscount = rowArray[7].text();

    $(this).parent().addClass("cellselect");

    // Set the field to the cell value
    $("#quoteId").attr("value", selectionId);
    $("#quoteCustomername").attr("value", selectionName);
    $("#quoteContact").attr("value", selectionContact);
    $("#quoteStreet").attr("value", selectionStreet);
    $("#quoteCity").attr("value", selectionCity);
    $("#quoteSecretnotes").attr("value", selectionNotes);
    $("#quoteStatus").attr("value", selectionStatus);
    $("#quoteDiscount").attr("value", selectionDiscount);
});