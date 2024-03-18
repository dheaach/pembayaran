<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="<?php echo base_url('assets/img/logo/green.png')?>" rel="icon">
  <title>Sukses Jaya</title>
  <link href="<?php echo base_url('assets/css/main.css')?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css')?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/css/ruang-admin.min.css')?>" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script src='<?php echo base_url();?>assets/js/jquery-3.2.1.min.js' type='text/javascript'></script>
  <script src='<?php echo base_url();?>assets/select2/dist/js/select2.min.js' type='text/javascript'></script>
  <link href='<?php echo base_url();?>assets/select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="<?php echo base_url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css')?>">
  <link rel="stylesheet" href="<?php echo base_url();?>https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="<?php echo base_url();?>https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="<?php echo base_url();?>https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="<?php echo base_url();?>https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

  <script src="<?php echo base_url();?>https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="<?php echo base_url();?>https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
  <script src='<?php echo base_url();?>assets/js/sorttable.js' type='text/javascript'></script>
  <style type="text/css">
    .login {
      min-height: 100vh;
    }

    .bg-color {
      background-color: #07a288;
      background-size: cover;
      background-position: center;
    }

    .login-heading {
      font-weight: 300;
    }

    .btn-login {
      font-size: 0.9rem;
      letter-spacing: 0.05rem;
      padding: 0.75rem 1rem;
    }
    .p-set{
        padding-right: 12px;
        padding-left: 12px;
    }
    .btn-login{
      background-color: #0da8ee;
      border-color: #0da8ee;
    }
    .btn-login:hover{
      background-color: #0891cf;
      border-color:  #0891cf;
    }
    @media only screen and (max-width: 991px) {
      .img-set{
        width: 200px;
      }
      .wraptocenter{
      margin-top: 12px;
      margin-bottom: 12px;
    }
    }
    @media only screen and (min-width: 992px) {
      .img-set{
        width: 350px;
      }

    }
  </style>
</head>
<body id="page-top">
  <div class="container-fluid ps-md-0 p-set">
    <div class="row g-0">
      <div class="d-none d-flex col-md-4 col-lg-6 bg-color align-items-center">
        <div class="ml-auto mr-auto wraptocenter">
          <img class="img-set" src="<?php echo base_url('assets/img/logo/white.png')?>" alt="IMG" style="display: block;">
        </div>
      </div>
      <div class="col-md-8 col-lg-6">
        <div class="login d-flex align-items-center py-5">
          <div class="container">
            <div class="row">
              <div class="col-md-9 col-lg-8 mx-auto">
                <h3 class="login-heading mb-4 text-center">Database System</h3>

                <!-- Sign In Form -->
                <form action="<?php echo base_url('rewrite');?>" method="post">
                  <div class="form-group row">
                    <div class="col-sm-8">
                      <label class="form-label lbl-grp">Hostname</label>
                      <input class="form-control" type="text" placeholder="Hostname" name="hostname" required>
                    </div>
                    <div class="col-sm-4">
                      <label class="form-label lbl-grp">Port</label>
                      <input class="form-control" type="text" placeholder="Port" name="port" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="form-label lbl-grp">Username</label>
                    <input class="form-control" type="text" placeholder="Username" name="username" required>
                  </div>
                  <div class="form-group">
                    <label class="form-label lbl-grp">Password</label>
                    <input class="form-control" type="password" placeholder="Password" name="password" required>
                  </div>
                  <div class="form-group">
                    <label class="form-label lbl-grp">Database</label>
                    <input class="form-control" type="text" placeholder="Database" name="database" id="database" required>
                  </div>
                  <div class="d-grid text-center">
                    <button class="btn btn-lg btn-info btn-login text-uppercase fw-bold mb-2" id="myProcessBtn" type="submit">Process</button>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    var input = document.getElementById("database");
    
    input.addEventListener("keypress", function(event) {
      if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById("myProcessBtn").click();
      }
    });
  </script>
</body>
