<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link href="<?php echo base_url('assets/img/logo/logo1.png')?>" rel="icon">
  <title>Sukses Jaya</title>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/login_assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/login_assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/login_assets/vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/login_assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/login_assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/login_assets/css/util.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/login_assets/css/main.css">

<!--===============================================================================================-->  
<style type="text/css">
  .container-login100 {
    background: linear-gradient(-135deg, #57e1ca, #035245);
}
  .wrap-login100 {
    padding: 33px 130px 33px 95px;
  }
</style>
<script type="text/javascript">
  $("#modalDbConf").modal('show');
</script>
</head>
<body>
  
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <div class="login100-pic js-tilt" data-tilt> 
          <img src="<?php echo base_url('assets/img/logo/logo1.png')?>" alt="IMG" style="display: block;margin-top: 70px;width: 350px;">
        </div>

        <form class="login100-form validate-form" action="<?php echo base_url('action');?>" method="post">
          <!--base_url('action') in controller login/aksi_login-->
          <!--lihat pada routes untuk lebih jelas-->
          <span class="login100-form-title">
            Login
          </span>

          <div class="wrap-input100 validate-input" data-validate = "Username is required">
            <input class="input100 " type="text" name="username" placeholder="Username" required >
            <div class="invalid-feedback">
            </div>
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
          </div>
          <div class="wrap-input100 validate-input" data-validate = "Password is required">
            <input class="input100" type="password" name="pass" placeholder="Password" required >
            <div class="invalid-feedback">
            </div>
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
          </div>

          <div class="wrap-input100 validate-input" data-validate = "Role Akses is required">
            <select class="input100" name="role" style='border: none;' id="userRole">
              <option value=''>-- Role Akses --</option>  
              <option value='1'>Staff</option>  
              <option value='2'>Supplier</option> 
            </select>
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-user" aria-hidden="true"></i>
            </span>
          </div>
          <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit" value="login" id="myBtnLogin">
              Login
            </button>
          </div>

          <div class="text-center mb-5">
          
          </div>
        </form>
      </div>
    </div>
  </div>
  
  

  
<!--===============================================================================================-->  
  <script src="<?php echo base_url();?>assets/login_assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url();?>assets/login_assets/vendor/bootstrap/js/popper.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url();?>assets/login_assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url();?>assets/login_assets/vendor/tilt/tilt.jquery.min.js"></script>
  <script >
    $('.js-tilt').tilt({
      scale: 1.1
    })
  </script>
  <script type="text/javascript">
    $('#userRole').on('change', function(){
      const selectedPackage = $('#userRole').val();
      $('#selected').text(selectedPackage);
    });

    var input = document.getElementById("userRole");
    
    input.addEventListener("keypress", function(event) {
      if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById("myBtnLogin").click();
      }
    });
  </script>
<!--===============================================================================================-->
  <script src="<?php echo base_url();?>assets/login_assets/js/main.js"></script>

</body>
</html>