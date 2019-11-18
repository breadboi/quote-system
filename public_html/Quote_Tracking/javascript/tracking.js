$(document).ready(function() {
    var max_fields = 10;
    var wrapper = ".freeform";
    //var add_button = $(".add_form_field");
    var add_button = $("#addField");
    var add_line = '<div class="row">'
    add_line += '<div class="col-8">'
    add_line += '<input class="form-control" placeholder="Line Item" type="text" name="lineitem[]">'
    add_line += '</div>'
    add_line += '<div class="col-2">'
    add_line += '<input class="form-control" placeholder="Price" type="text" name="price[]" />'
    add_line += '</div>'
    add_line += '<div class="col-2">'
    add_line += '<a href="#" class="delete , btn btn-danger" role="button" >Delete</a>'
    add_line += '</div>'
    add_line += '</div>'
    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append(add_line);
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent().parent('div').remove();
        x--;
    })
});