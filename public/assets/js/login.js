$(document).ready(function () {
	$("form[name='login-form']").validate({
    rules: {

      email:{
        required: true
      },
      password: {
        required: true,
        minlength: 8
      }

    },
    messages: {
      email: {
        required: "Enter Your Email"

      },
      password: {
        required: "Enter Password",
        minlength: "Your password must be at least 8 characters long"

      }
    },

    submitHandler: function(form) {
      console.log("Submit handler executed");
     $("#btn-login").prop('disabled', true);
     $('#btn-login').html('Loading ...');

     $form = $('#login-form');

     $.ajax({
      url: $form.attr('action'),
      type: 'POST',
      dataType: 'json',
      data: $form.serialize(),
      success: function (json) {
        console.log("AJAX success:", json);
       $data = $.parseJSON(JSON.stringify(json));

       if ($data.response == "success") {
        console.log("Login Success");
        $('#showtoast').trigger('click');

        setTimeout(function () {
         document.location.href = '';
       }, 1500);

      } else {

        console.log("Login Failed");
        $('#btn-login').html('Login');
        $("#btn-login").prop('disabled', false);

       //  swal({
       //   title: "Mohon Maaf!",
       //   text: $data.message,
       //   icon: "warning",
       //   button: "OK",
       // });


     }
   },
   
   error: function (data) {
     console.log("AJAX error! login");
     $('#btn-login').html('Login');
     document.getElementById("btn-login").classList.remove('disabled');
     $("#btn-login").prop('disabled', false);
     // swal({
     //   title: "Terjadi Kesalahan!",
     //   text: "Silahkan Coba Lagi",
     //   icon: "error",
     //   button: "OK",
     // });


   }

   
 });


   }
 });
});



