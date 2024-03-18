<!--#87ccac : bg-->
<nav class="navbar navbar-expand-lg navbar-light bg-navbar static-top dropdown no-arrow" style="background-color: #006d3a;">

  <button type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler btn btn-default rounded-circle btn-sm mr-3" style="padding-top: 5px;padding-left: 8px;padding-right: 8px;padding-bottom: 5px;">
    <i class="fa fa-bars text-black fa-sm"></i>
  </button>
  <a class="navbar-brand text-white mr-auto">
     
       <b style="font-size: 26px;">
          <?php
            $role = $this->session->userdata("role");
            $person_id = $this->session->userdata("person_id");
            $db_act = $this->session->userdata('db_active');

             if($role == 1 ){
              echo"Staff";
             }elseif ($role == 2) {
               echo "Supplier";
             }
          ?>    
      </b>
  </a>
  <div class="dvd-left"></div>
  <div class="navbar-brand order-md-last">
        <a class="text-white text-decoration-none" href="<?php echo base_url('profile/download');?>" style="font-size: 14px;">
          <i class="fas fa-download fa-fw notif"></i>
        </a>
  </div>
   <div class="navbar-brand order-md-last">
        <a class="dropdown-toggle text-white text-decoration-none" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 14px;">
          <i class="fas fa-bell fa-fw notif"></i>
            <span class="badge badge-danger badge-counter cnt" id="count"></span>
        </a>
        <div class="dropdown-toggleist dropdown-menu d-menu dropdown-menu-right shadow animated--grow-in alert-notif" id="#toggle-notif" aria-labelledby="alertsDropdown">
        </div>

  </div>
   <div class="navbar-brand order-md-last ">
    <a class="dropdown-toggle text-white text-decoration-none" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 14px;">
      <img class="img-profile rounded-circle img-circle" src="<?php echo base_url();?>assets/img/boy.png" style="width: 28px;height: 28px;">
      <span class="ml-2 d-none d-lg-inline text-white small" style="font-size: 14px;"><?php echo $this->session->userdata("nama");?></span>
    </a> 

          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-item" href="#">
                  <?php
                   if(!empty($json_arr) ) {
                      foreach($json_arr['select'] as $key=>$value) {
                        echo $value['active_db'];
                      }
                    }
                  ?>
                </div>
                <div class="dropdown-divider"></div>
                
                <a class="dropdown-item" href="<?php echo base_url('profile');?>">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="<?php echo base_url('notifikasi');?>">
                  <i class="fas fa-bell fa-sm fa-fw mr-2 text-gray-400"></i>
                  Notifikasi
                </a>
                <?php
                  if($role == 1 ){
                ?>
                <a class="dropdown-item" href="<?php echo base_url('setting');?>">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Setting
                </a>
                <?php
                  }
                ?>
                <!--<a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>-->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
  </div>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03" style="margin-left: 10px;float: left;">
    <ul class="navbar-nav mr-auto">
            <li class="nav-item notif">
                <a class="nav-link text-white" href="<?php echo base_url('overview');?>" role="button" style="font-size: 14px;">
                  Dashboard
                </a>
              
            </li>
            <li class="nav-item notif">
              <a class="nav-link text-white" href="<?php echo base_url('transaction');?>" role="button" style="font-size: 14px;">
                Transaksi
              </a>
            </li>
            <!-- <li class="nav-item notif">
              <a class="nav-link text-white" href="<?php echo base_url('transaction/image');?>" role="button" style="font-size: 14px;">
                Images
              </a>
            </li> -->
        </ul>   
  </div> 
</nav>

