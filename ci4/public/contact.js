var successTone = new Audio('Success.mp3');
var errorTone = new Audio('Error.mp3');
$("#contactForm").submit(function (event) {
    event.preventDefault();
    var name = $("input#name").val();
    var email = $("input#email").val();
    var subject = $("input#subject").val();
    var message = $("textarea#message").val();

    $.post("contact.php", {
        name: name,
        email: email,
        subject: subject,
        message: message
    }, function (data) {
        if (data.status === "success") {
            // play success tone
            successTone.play();
            $('#success').html("<div class='alert alert-success'>");
            $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                    .append("</button>");
            $('#success > .alert-success')
                    .append("<strong>Data has been added to the database. </strong>");
            $('#success > .alert-success')
                    .append('</div>');
        } else {
            // play error tone
            errorTone.play();
            $('#success').html("<div class='alert alert-danger'>");
            $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                    .append("</button>");
            $('#success > .alert-danger').append($("<strong>").text("Sorry " + name + ", it seems that there was an error adding the data to the database. Please try again later!"));
            $('#success > .alert-danger').append('</div>');
        }
        $('#contactForm').trigger("reset");
    }, "json").fail(function () {
        // play error tone
        errorTone.play();
        $('#success').html("<div class='alert alert-danger'>");
        $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                .append("</button>");
        $('#success > .alert-danger').append($("<strong>").text("Sorry, it seems that the server is not responding. Please try again later!"));
        $('#success > .alert-danger').append('</div>');
    });
});
