$(function() {

  $("#contactForm2 input,#contactForm2 textarea").jqBootstrapValidation({
    preventSubmit: true,
    submitError: function($form, event, errors) {
      // additional error messages or events
    },
    submitSuccess: function($form, event) {
      event.preventDefault(); // prevent default submit behaviour
      // get values from FORM
      var name = $("input#name2").val();
     // var address = $("input#address").val();
      var email = $("input#email2").val();
      var phone = $("input#phone2").val();
      var message = $("textarea#message2").val();
      var firstName = name; // For Success/Failure Message
      // Check for white space in name for Success/Fail message
      if (firstName.indexOf(' ') >= 0) {
        firstName = name.split(' ').slice(0, -1).join(' ');
      }
      $this = $("#sendMessageButton2");
      $this.prop("disabled", true); // Disable submit button until AJAX call is complete to prevent duplicate messages
      $.ajax({
        url: "././mail2/contact_me.php",
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
          $('#success2').html("<div class='alert alert-success'>");
          $('#success2 > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            .append("</button>");
          $('#success2 > .alert-success')
            .append("<strong>Az üzenetet sikeresen elkülde.Hamarosan válaszolunk! </strong>");
          $('#success2 > .alert-success')
            .append('</div>');
          //clear all fields
          $('#contactForm2').trigger("reset");
        },
        error: function() {
          // Fail message
          $('#success2').html("<div class='alert alert-danger'>");
          $('#success2 > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            .append("</button>");
          $('#success2 > .alert-danger').append($("<strong>").text("Sajnálom " + firstName + ", úgy tűnik, hogy a levelezőszerver nem válaszol. Kérlek, próbáld újra később!"));
          $('#success2 > .alert-danger').append('</div>');
          //clear all fields
          $('#contactForm2').trigger("reset");
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
$('#name2').focus(function() {
  $('#success2').html('');
});
