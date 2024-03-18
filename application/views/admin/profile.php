
 <?php 
    $this->load->view("_partials/header.php") 
?>

  <div id="wrapper">
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
       <?php 
            $this->load->view("_partials/navbar.php") 
        ?>
        <!-- Topbar -->
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
           
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <!-- DataTable with Hover -->
            <div class="col-lg-7">
              <!-- Form Basic -->
              <div class="card mb-4 cd-pr-lf">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #006d3a;">
                  <h6 class="m-0 font-weight-bold text-white">Profil</h6>
                </div>
                <div class="card-body">
                  <form action="<?php echo base_url('profile');?>" method="post">
                    <?php
                      if( !empty($profile) ) {
                        foreach($profile as $p) { 
                      ?>
                    <div class="form-group row justify-content-center mb-4 mt-1">
                      <img class="img-profile rounded-circle img-circle" src="<?php echo base_url();?>assets/img/boy.png" style="width: 200px;height: 200px;border-color: #006d3a;">
                    </div>
                    <div class="form-group row">
                      <label for="inputUsername3" class="col-sm-3 col-form-label font-weight-bold lbl-grp">Username</label>
                      <div class="col-sm-9">
                        <input type="text" name="username" value="<?php echo $p->user_name; ?>" class="form-control form-control-sm frm-brd <?= form_error('username') ? 'invalid' : '' ?>" id="inputUsername3" placeholder="Username">
                        <div class="invalid-feedback">
                          <?= form_error('username') ?>
                        </div>
                        <input type="hidden" name="person_id" value="<?php echo $p->person_id; ?>">
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label font-weight-bold lbl-grp">Password</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control form-control-sm frm-brd <?= form_error('password') ? 'invalid' : '' ?>" id="inputPassword3" placeholder="Password" name="password">
                        <div class="invalid-feedback">
                          <?= form_error('password') ?>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputKonfirmasi3" class="col-sm-3 col-form-label font-weight-bold lbl-grp">Konfirmasi</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control form-control-sm frm-brd <?= form_error('konfirmasi') ? 'invalid' : '' ?>" id="inputKonfirmasi3" placeholder="Konfirmasi" name="konfirmasi" onchange="chkPwd()">
                        <div class="invalid-feedback">
                          <?= form_error('konfirmasi') ?>
                        </div>
                      <label class="font-weight-bold" id="err" style="color: red;font-size: 12px;"></label>
                      </div>  
                    </div>
                    <div class="form-group row text-center mt-4">
                      <div class="col-sm-12">
                        <button type="submit" class="btn btn-success">Simpan</button>
                     
                        <a href="<?php echo base_url('profile');?>"><button type="button" class="btn btn-info">Reset</button></a>
                      
                        <a type="button" href="<?php echo base_url('overview')?>" class="btn btn-secondary">Batal</a>
                      </div>
                    </div>

                    <?php
                      }
                    }
                    ?>
                  </form>
                </div>
              </div>
            </div>
            <!-- <div class="col-lg-5">
              <div class="card mb-4 cd-pr-rg">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #006d3a;">
                  <h6 class="m-0 font-weight-bold text-white">Data Usaha</h6>
                </div>
                <div class="card-body"> 
                    <div class="form-group row">
                      <div class="col-sm-12 mb-1 d-flex justify-content-center">
                        <img class="img-usaha" src="<?php echo base_url();?>assets/img/user/ktp.jpg" style="width: 60%;">
                      </div>
                      <div class="col-sm-12">
                        <a type="button" class="btn btn-success text-white" download="nik.jpg" href="<?php echo base_url();?>assets/img/user/ktp.jpg" title="Download KTP" style="width: 100%">DOWNLOAD KTP</a>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <div class="col-sm-12 mb-1 d-flex justify-content-center">
                        <img class="img-usaha" src="<?php echo base_url();?>assets/img/user/npwp.png" style="width: 60%;">
                      </div>
                      <div class="col-sm-12">
                        <a type="button" class="btn btn-success text-white" download="npwp.jpg" href="<?php echo base_url();?>assets/img/user/npwp.png" title="Download NPWP" style="width: 100%">DOWNLOAD NPWP</a>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-12">
                        <form action="<?php echo base_url('profile/download');?>" method="post">
                        <button type="submit" name="dwnall" class="btn btn-success text-white" title="Download Semua" style="width: 100%">DOWNLOAD SEMUA</button>
                      </form>
                      </div>
                    </div>
                    
                </div>
              </div>
            </div> -->
            
          </div>
         
          <!-- Modal -->
          
          <?php 
            $this->load->view("_partials/modal.php") 
          ?>

        </div>
        <!---Container Fluid-->
      </div>

      
    </div>
  </div>

<!-- Footer -->
      <?php 
            $this->load->view("_partials/footer.php") 
        ?>
      <!-- Footer -->