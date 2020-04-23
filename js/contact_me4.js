$(function() {

    $("#contactForm4 input,#contactForm4 textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {
            event.preventDefault(); // prevent default submit behaviour
            // get values from FORM
            var name = $("input#name4").val();
            // var address = $("input#address").val();
            var email = $("input#email4").val();
            var phone = $("input#phone4").val();
            var message = $("textarea#message4").val();
            var firstName = name; // For Success/Failure Message
            // Check for white space in name for Success/Fail message
            if (firstName.indexOf(' ') >= 0) {
                firstName = name.split(' ').slice(0, -1).join(' ');
            }
            $this = $("#sendMessageButton4");
            $this.prop("disabled", true); // Disable submit button until AJAX call is complete to prevent duplicate messages
            $.ajax({
                url: "././mail4/contact_me.php",
                type: "POST",
                data: {
                    //  address: address,
                    name: name,
                    phone: phone,
                    email: email,
                    message: message
                },
                cache: false,
                success: function() {
                    // Success message
                    $('#success4').html("<div class='alert alert-success'>");
                    $('#success4 > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success4 > .alert-success')
                        .append("<strong>Az üzenetet sikeresen elkülde.Hamarosan válaszolunk! </strong>");
                    $('#success4 > .alert-success')
                        .append('</div>');
                    //clear all fields
                    $('#contactForm4').trigger("reset");
                },
                error: function() {
                    // Fail message
                    $('#success4').html("<div class='alert alert-danger'>");
                    $('#success4 > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success4 > .alert-danger').append($("<strong>").text("Sajnálom " + firstName + ", úgy tűnik, hogy a levelezőszerver nem válaszol. Kérlek, próbáld újra később!"));
                    $('#success4 > .alert-danger').append('</div>');
                    //clear all fields
                    $('#contactForm4').trigger("reset");
                },
                complete: function() {
                    setTimeout(function() {
                        $this.prop("disabled", false); // Re-enable submit button when AJAX call is complete
                    }, 1000);
                }
            });
        },
        filter: function() {
            return $(this).is(":visible");
        },
    });

    $("a[data-toggle=\"tab\"]").click(function(e) {
        e.preventDefault();
        $(this).tab("show");
    });
});

/*When clicking on Full hide fail/success boxes */
$('#name4').focus(function() {
    $('#success4').html('');
});