$(document).ready(function() {


$('input').on('blur', function() {
    if ($("#doctor-reset-form").valid()) {
        $('#buttonForReset').prop('disabled', false);
    } else {
        $('#buttonForReset').prop('disabled', 'disabled');
    }
});


$("#doctor-reset-form").validate({
    rules: {
        token: {
          required: true,
        },
        password: {
            required: true,
            minlength: 4,
            maxlength: 8

        }

    },
    messages : {
      token: {
        required: "You need to enter an valid token",
      },
      password: {
        required: "You need to enter a password between 4 and 8 chars"
      }
    }

});
});
