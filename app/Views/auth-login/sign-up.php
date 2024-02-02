<!DOCTYPE html>
<html>
   <head>
    <title>register form</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= site_url('assets/css/bootstrap.min.css') ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="<?= site_url('assets/css/icons.min.css')?>" rel="stylesheet" type="text/css" />
      
   </head>
   <body>
      <div class="main-box d-flex">
        <div class="cont col-lg-12 d-flex">
           <div class="form sign-up col-lg-9 col-sm-12" >
            <form name="signupform" >
              <h2>Sign Up</h2>
              <label class="col-sm-12 col-lg-12">
              <span>Name</span>
                <input type="text" name="name" id="name" required="">
              </label>
              <label class="col-sm-12 col-lg-12">
                <span>Username</span>
                <input type="text"  name="username" id="username" required="">
              </label>
              <label class="col-sm-12 col-lg-12">
                <span>Mobile</span>
                <input type="text" minlength="9" maxlength="10" id="mobile" name="mobile" required="">
              </label>
              <label class="col-sm-12 col-lg-12">
                <span>Email</span>
                <input type="email" name="email" id="email" required="">
              </label>
              <label class="col-sm-12 col-lg-12">
                <span>Password</span>
                <input type="password" name="password" id="password" required="">
                <div id="strengthMessage"></div> 
              </label>
              <label class="col-sm-12 col-lg-12">
                <span>Confirm Password</span>
                <input type="password" id="confirmpassword" id="confirmpassword" name="password" required="">
                <span class="divDoPasswordsMatch"></span>
              </label>
              <div class=" d-flex justify-content-center align-items-center col-lg-12 col-sm-12">
                 <button class="submit signup" type="button">Sign Up</button>
              </div>
              <div class="submit-btn2 d-flex d-lg-none justify-content-center align-items-center col-lg-12 col-sm-12">
                 <button class="submit2-r submit2" type="button"><a href="index.html"> Sign in</a></button>
              </div>
            </form>
           </div>
           <div class="sub-cont-1 col-lg-3 d-none d-lg-block ">
              <div class="img">
                 <div class="img-text m-in">
                    <h2>One of us?</h2>
                    <p>If you already has an account, just sign in. We've missed you!</p>
                 </div>
                 <div class="img-btn">
                    <a href="index.html">
                    <span class="m-in">Sign In</span>
                    </a>
                 </div>
              </div>
           </div>
        </div>
      </div>
     
      
   </body>
</html>
<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/libs/sweetalert2/sweetalert2.min.js') ?>"></script>
<script src="<?= base_url('assets/js/pages/sweet-alerts.init.js') ?>"></script>

<script type="text/javascript">

   $(document).ready(function() {
      $(function() {
        $('#username').keydown(function(e) {
          if (e.shiftKey || e.ctrlKey || e.altKey) {
            e.preventDefault();
          } else {
            var key = e.keyCode;
            if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
              e.preventDefault();
            }
          }
        });
      });
        $("#confirmpassword").blur(function(){
            comparePassword($("#password").val(), $("#confirmpassword").val());
        });
        $("#password").blur(function(){
            var password = $(this).val();
            var strength = checkStrength(password);
        });
     

        function comparePassword(password1, password2) {
          if (password1 != password2) {
            $(".divDoPasswordsMatch").html("Passwords do not match!");
            $(".divDoPasswordsMatch").css("color","red");
             $("#confirmpassword").prop('disabled', true);
          }
          
        }

        function checkStrength(password) {  
            var strength = 0  
            if (password.length < 6) {  
                $('#strengthMessage').removeClass()  
                $('#strengthMessage').addClass('Short') 
                $('#strengthMessage').text('Too Short')  
                $("#confirmpassword").prop('disabled', true)
                $("#repassword").prop('disabled', true)
                return false;  
            }  
            if (password.length > 7) strength += 1  
            // If password contains both lower and uppercase characters, increase strength value.  
            if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1  
            // If it has numbers and characters, increase strength value.  
            if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1  
            // If it has one special character, increase strength value.  
            if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1  
            // If it has two special characters, increase strength value.  
            if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1  
            // Calculated strength value, we can return messages  
            // If value is less than 2  
            if (strength < 2) {  
                $('#strengthMessage').removeClass()  
                $('#strengthMessage').addClass('Weak')  
                $('#strengthMessage').text('Please Enter Strong Password')  
                $("#confirmpassword").prop('disabled', true)
                
                return false;
            } else if (strength == 2) {  
                $('#strengthMessage').removeClass()  
                $('#strengthMessage').addClass('Good')  
                $('#strengthMessage').text('Good!!!')  
                $("#confirmpassword").removeAttr("disabled")
                
            } else {  
                $('#strengthMessage').removeClass()  
                $('#strengthMessage').addClass('Strong')  
                $('#strengthMessage').text('Strong!!')  
                $("#confirmpassword").removeAttr("disabled")
                
            }  
        }  

        $(".signup").click(function(e) {
              var name = $('#name').val();
              var username = $('#username').val();
              var mobile = $('#mobile').val();
              var email = $('#email').val();
              var password = $('#password').val();
              var form = $("form[name='signupform']")[0];
              var formdata = new FormData(form);
              
              formdata.append('action', 'insert');
              formdata.append('table', 'master_user');
                if(name != '' && username !='' && mobile !='' && email !='' && password !=''){ 
                    $.ajax({
                        method: "post",
                        url: "<?=site_url('login_insert_data');?>",
                        data:formdata,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            var response = JSON.parse(res);
                           if(response.response == 1){
                                $("form[name='signupform']")[0].reset();
                                sweet_edit_sucess(response.msg);
                                //window.location.href("<?php echo site_url(); ?>/login");
                                window.location.href = '<?php echo site_url(); ?>/login';
                             }else{
                                Swal.fire({
                                    title: 'Cancelled',
                                    text: response.msg,
                                    icon: 'error',
                                })
                            }
                           
                        }
                    });
                    return false;
                }else{
                    $("form[name='signupform']").addClass("was-validated");
                    return false;
                }
            });

});
      </script>
          