$(document).ready(function() {
    var max_fields = 10;
    var wrapper = $("#QuoteContent");
    var add_button = $("#addField");
    var add_line = '<div class="input-group">';
    add_line += '<div class="col-7 px-1">';
    add_line += '<input class="form-control" placeholder="Line Item" type="text" required name="lineitem[]"/>';
    add_line += '</div>';
    add_line += '<div class="col-3 px-1 input-group">';
    add_line += '<div class="input-group-prepend"><span class="input-group-text">$</span></div>';
    add_line += '<input class="form-control" pattern="^\\d+\\.?\\d*$" placeholder="Price" required type="text" name="price[]"/>';
    add_line += '</div>';
    var first = add_line + '</div>';
    add_line += '<div class="col-2 pl-1">';
    add_line += '<a href="#" class="delete , btn btn-danger" role="button" >Delete</a>';
    add_line += '</div>';
    add_line += '</div>';

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


    $(wrapper).on("load",add_button, myFunction());

    function myFunction() 
    {
        $(wrapper).append(first);
    };

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent().parent('div').remove();
        x--;
    })

});


/*
function empty()
{
    var x = document.getElementById("name").value;
    if (x == "") 
    { 
        var wrapper = $("#CustomerSelection");
        var add_line ='<div class="alert alert-danger alert-dismissible fade show">'
        add_line += '<button type="button" class="close" data-dismiss="alert">&times;</button>'
        add_line += '<strong>Please Select a Customer from List</strong>'
        add_line += '</div>'
        $(wrapper).prepend(add_line);
        return false;
    };
}
*/

    //onClick="return empty()"
    // Disable form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) 
                {
                    if (form.checkValidity() === false) 
                    {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

