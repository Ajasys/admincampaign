
<!DOCTYPE html>
<html>

<head>
  <title>login form</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="assets/css/login.css">
  <link rel="icon" href="<?= site_url('assets/images/r-logo.png') ?>" type="text/icon">
  <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= site_url('assets/css/iziToast.min.css') ?>" rel="stylesheet" type="text/css" />
  <link href="<?= site_url('assets/css/uicons-solid-rounded.css') ?>" rel="stylesheet" type="text/css" />
  <link href="<?= site_url('assets/css/uicons-regular-rounded.css') ?>" rel="stylesheet" type="text/css" />
  <link href="<?= site_url('assets/css/bootstrap.min.css') ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
  <!--    <link href="<?= site_url('assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css" /> -->

</head>

<body>
  <section class="login-form position-relative overflow-hidden">
    <div class="hero-bg"></div>
    <div class="banner-bg z-n1">
      <img src="<?= site_url('assets/images/Frame.svg') ?>" alt="frame">
    </div>
    <div class="container">
      <div
        class="row h-100 col-12 col-xxl-4 col-xl-4 col-lg-5 col-md-7 col-sm-9 flex-column justify-content-center shadow px-4 bg-white flex-nowrap m-0">
        <div class="col-12">
          <div class="logo">
            <a href="https://realtosmart.com/">
              <img src="<?= site_url('assets/images/RealtoSmart Logo.png') ?>" alt="" class="w-75">
            </a>
          </div>
        </div>
        <div class="col-12 mb-3">
          <h2 class="text-start mt-4 text-secondary fw-medium">Sign In</h2>
        </div>
        <form class="form-horizontal" name="user_login" id="user_login" method="POST">
          <div class="mb-3">
            <label for="username" class="form-label w-100 text-start mb-1">Username</label>
            <input type="text" class="form-control text-start" name="username">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label w-100 text-start mb-1">Password</label>
            <div class="position-relative">
              <input type="password" class="form-control text-start" name="password" id="login-pass">
              <i class="fi fi-rr-eye-crossed pass-icon" id="eye"></i>
            </div>
          </div>
          <p class="forgot-pass text-light-emphasis text-start">Forgot Password ?</p>
          <a href=""></a>
          <div class="submit-btn d-flex justify-content-center align-items-center col-lg-12 col-sm-12">
            <button class="submit log_in my-3 text-white" type="button" name="log_in">Sign In</button>
          </div>
        </form>
        <!-- <p class="mt-1 text-secondary-emphasis fw-medium text-center">
          New here?
          <a href="<?= site_url() ?>signup" class="signup-btn">Sign up</a>
        </p> -->
        <div class="col-12 d-flex justify-content-center align-items-center mt-3">
          <p class="col-6 text-light-emphasis text-end mb-0 px-2">Product by : </p>
          <div class="aja-logo text-start col-6 px-2">
            <a href="https://ajasys.com/">
              <img src="<?= site_url('assets/images/aja-logo.png') ?>" alt="" class="w-75">
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/iziToast.js') ?>"></script>
  <script src="<?= base_url('assets/libs/sweetalert2/sweetalert2.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/pages/sweet-alerts.init.js') ?>"></script>


  <script type="text/javascript">

    $(function () {

      $('#eye').click(function () {

        if ($(this).hasClass('fi-rr-eye-crossed')) {

          $(this).removeClass('fi-rr-eye-crossed');

          $(this).addClass('fi-rr-eye');

          $('#login-pass').attr('type', 'text');

        } else {

          $(this).removeClass('fi-rr-eye');

          $(this).addClass('fi-rr-eye-crossed');

          $('#login-pass').attr('type', 'password');
        }
      });
    });

    $("button[name='log_in']").click(function (e) {
      e.preventDefault();
      var form = $("form[name='user_login']")[0];
      var username = $('#username').val();
      var password = $('#password').val();
      if (username != "" && password != "") {
        var formdata = new FormData(form);
        formdata.append('action', 'insert');
        $.ajax({
          method: "post",
          url: "<?= site_url('user_login'); ?>",
          data: formdata,
          processData: false,
          contentType: false,
          success: function (res) {
            var msg = "Login Failed !";
            var response = JSON.parse(res);
            var msg = response.message;
            var url = "<?= site_url(); ?>";
            if (response.result != 0) {
              $("form[name='user_login']")[0].reset();
              iziToast.success({
                title: msg
              });
              setTimeout(() => {
                $(location).attr('href', url);
              }, 1500);
            } else {
              iziToast.error({
                title: msg
              }); 
            }
          },
        });
      } else {
        Swal.fire({
          title: 'Cancelled',
          text: 'Mobile Number and Password is incorrect!',
          icon: 'error',
        })
        $("form[name='master_project_type_form']").addClass("was-validated");
      }
    });
  </script>

</body>

</html>