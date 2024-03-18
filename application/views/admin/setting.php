
 <?php 
    $this->load->view("_partials/header.php") 
?>
  <div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <?php 
            $this->load->view("_partials/navbar.php") 
        ?>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between row">
            <div class="col-md-12">
              <?php
                if(isset($breadcrumb)&&  !is_null($breadcrumb)){
              ?>
                <ol class="breadcrumb" id="breadcrumb">
              <?php
                  foreach ($breadcrumb as $key=>$value) {
                    if($value!=''){
                      echo'<li class="breadcrumb-item"><a href="' . base_url($value) . '">' . $key . '</a></li>';
                    }else{
                      echo'<li class="breadcrumb-item active" aria-current="page">' . $key .'</li>';
                    }
                  }
              ?>
                </ol>
              <?php
                }
              ?> 
              <!--<?php //echo (!empty($breadcrumb)?$breadcrumb:'');?>-->
            </div>
          </div>
          <div class="row">
            <!-- Card -->
            <?php
             $role = $this->session->userdata("role");
              if($role == 1 ){
            ?>
            <div class="col-xl-2 col-md-6 mb-4">
              <a class="text-decoration-none" type="button" href="<?php echo base_url('setting/database');?>">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <img class="icon size-icon-setting" src="<?php echo base_url('assets/img/icon/db.png');?>">
                      </div>
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 size-font-setting text-secondary">Database</div>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <?php
              }
            ?>
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
<script type="text/javascript">var day = "<?= $day ?>";</script>
       <?php 
            $this->load->view("_partials/footer.php") 
        ?>
      <!-- Footer -->