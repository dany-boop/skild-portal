$(document).ready(function () {
    $("form[name='register-form']").validate({
      rules: {
        first_name: {
            required: true,
            minlength: 2, 
            maxlength: 50, 
          },
          last_name: {
            required: true,
            minlength: 2, 
            maxlength: 50, 
          },
        email: {
          required: true,
          email: true,
        },
        password: {
          required: true,
          minlength: 8,
        },
        // confirm_password: {
        //   required: true,
        //   equalTo: '[name="password"]',
        // },
        location: {
          required: true,
        },
        phone: {
          required: true,
         
        },
      },
      messages: {
        first_name: {
            required: "Please enter your first name",
            minlength: "Your first name must be at least 2 characters long",
            maxlength: "Your first name cannot exceed 50 characters",
          },
          last_name: {
            required: "Please enter your last name",
            minlength: "Your last name must be at least 2 characters long",
            maxlength: "Your last name cannot exceed 50 characters",
          },
        email: {
          required: "Enter Your Email",
        },
        password: {
          required: "Enter Password",
          minlength: "Your password must be at least 8 characters long",
        },
        confirm_password: {
          required: "Confirm your password",
          // equalTo: "Passwords must match",
        },
        location: {
          required: "Enter Your Location",
        },
        phone: {
          required: "Enter Your Phone Number",
        },
      },


      
      submitHandler: function (form) {
        console.log("Submit handler executed");
        $("#btn-register").prop("disabled", true);
        $("#btn-register").html("Loading ...");
  
        $form = $("#register-form");

        
        $.ajax({
          url: $form.attr("action"), // Set the registration API endpoint
          type: "POST",
          dataType: "json",
          data: $form.serialize(),
          success: function (json) {
            console.log("AJAX success:", json);
            $data = $.parseJSON(JSON.stringify(json));
  
            if ($data.response == "success") {
              console.log("Registration Success");
              $('#showtoast').trigger('click');

              setTimeout(function () {
               document.location.href = 'signin';
             }, 1500);
            } else {
              console.log("Registration Failed");
              $("#btn-register").html("Register");
              $("#btn-register").prop("disabled", false);
            }
          },
          error: function (data) {
            console.log("AJAX error! registration");
            $("#btn-register").html("Register");
            $("#btn-register").prop("disabled", false);
          },
        });
      },
    });
  
  });
  