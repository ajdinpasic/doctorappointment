/*$(function () {

  $("#doctor-login-form").validate({
    rules : {
      doctor_email : {
        required: true,
        doctor_email: true
      },
      password : {
        required : true
      }
    },
    messages : {
      doctor_email : {
        required : "You need to enter an email",
        doctor_email : "Please enter a valid e-mail adress"
      },
      password: {
        required: "You need to enter a password"
      }
    }



  });



}); */
$(document).ready(function() {

    $('input').on('blur', function() {
        if ($("#doctor-login-form").valid()) {
            $('#buttonForLogin').prop('disabled', false);
        } else {
            $('#buttonForLogin').prop('disabled', 'disabled');
        }
    });

    $("#doctor-login-form").validate({
        rules: {
            doctor_email: {
                required: true,
                email: true
            },
            password: {
                required: true

            }
        },
        messages : {
          doctor_email : {
            required : "You need to enter an email",
            email : "Please enter a valid e-mail adress"
          },
          password: {
            required: "You need to enter a password"
          }
        }
    });

});
