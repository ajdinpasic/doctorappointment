$(document).ready(function() {


$('input').on('blur', function() {
    if ($("#doctor-forgot-form").valid()) {
        $('#buttonForForgot').prop('disabled', false);
    } else {
        $('#buttonForForgot').prop('disabled', 'disabled');
    }
});


$("#doctor-forgot-form").validate({
    rules: {
        doctor_email: {
          required: true,
          email: true,
        }

    },
    messages : {
      doctor_email: {
        required: "You need to enter an email",
        email: "Please enter valid email"
      }
    }

});
});
