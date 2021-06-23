$(document).ready(function() {

  $('input').on('blur', function() {
      if ($("#register-doctor-form").valid()) {
          $('#buttonForRegister').prop('disabled', false);
      } else {
          $('#buttonForRegister').prop('disabled', 'disabled');
      }
  });


$("#register-doctor-form").validate({
    rules: {
        doctor_name: {
            required: true,
            minlength: 3,
            maxlength: 10
        },
        doctor_surname: {
            required: true,
            minlength: 3,
            maxlength: 10
        },
        doctor_email : {
            required: true,
            email: true,


        },
        password: {
            required: true,
            minlength: 4,
            maxlength: 8

        }
    },
    messages : {
      doctor_name : {
        required : "You need to enter a name"
      },
      doctor_surname: {
        required: "You need to enter a surname"
      },
      doctor_email: {
        required: "You need to enter an email",
        email: "Please enter valid email"
      },
      password: {
        required: "You need to enter a password between 4 and 8 chars"
      }
    }
});
});
