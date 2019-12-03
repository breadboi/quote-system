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