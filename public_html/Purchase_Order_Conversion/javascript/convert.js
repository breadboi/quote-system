/* $(document).ready(function() {
    $("#convertForm").submit(function(event) {
        submitForm();
        return false;
    });
}); */

/* function submitForm() {
    $.ajax({
        type: "POST",
        url: "Quote_Order.php",
        cache: false,
        data: $('form#convertForm').serialize(),
        success: function(response) {
            $("#modal").html(response)
            $("#confirmationModal").modal('hide');
        },
        error: function() {
            alert("Error");
        }
    });
} */

// Used for Modal form submission
$("#confirmSubmission").on("click", function() {
    $("#submitModal").trigger("click");
});

var previousrow;
function addRowHandlers() {
    var table = document.getElementsByClassName("datatbl");
    var rows = table[0].getElementsByTagName("tr");
    for (i = 0; i < rows.length; i++) {
        var currentRow = table[0].rows[i];
        var createClickHandler =
            function(row) {
                return function() {
                    if (previousrow != undefined) {
                        previousrow.setAttribute("style", "");
                    }
                    var cell = row.getElementsByTagName("td")[0];
                    var selection = cell.innerHTML;
                    var selection = row.getElementsByTagName("td")[0].innerHTML
                    document.getElementById("quoteId").setAttribute("value", selection);
                    var selection = row.getElementsByTagName("td")[1].innerHTML
                    document.getElementById("quoteCustomername").setAttribute("value", selection);
                    var selection = row.getElementsByTagName("td")[2].innerHTML
                    document.getElementById("quoteContact").setAttribute("value", selection);
                    var selection = row.getElementsByTagName("td")[3].innerHTML
                    document.getElementById("quoteStreet").setAttribute("value", selection);
                    var selection = row.getElementsByTagName("td")[4].innerHTML
                    document.getElementById("quoteCity").setAttribute("value", selection);
                    var selection = row.getElementsByTagName("td")[5].innerHTML
                    document.getElementById("quoteEmail").setAttribute("value", selection);
                    var selection = row.getElementsByTagName("td")[6].innerHTML
                    document.getElementById("quoteSecretnotes").setAttribute("value", selection);
                    var selection = row.getElementsByTagName("td")[7].innerHTML
                    // document.getElementById("quoteStatus").setAttribute("value", selection);
                    var selection = row.getElementsByTagName("td")[8].innerHTML
                    document.getElementById("quoteDiscount").setAttribute("value", selection);
                    this.setAttribute("style", "background-color: #e8e8e8; color: #000000 ");
                    previousrow = row;
                };
            };
        currentRow.onclick = createClickHandler(currentRow);
    }
}
window.onload = addRowHandlers();