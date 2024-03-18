
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
        <div class="container-fluid" id="container-wrapper" style="height: 523px;">
          <div class="d-sm-flex align-items-center justify-content-between mb-4 row">
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
              <!-- <?php //echo (!empty($breadcrumb)?$breadcrumb:'');?> -->
            </div>
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <!-- DataTable with Hover -->
            <div class="col-lg-7">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #006d3a;">
                  <h6 class="m-0 font-weight-bold text-white">Database List</h6>
                  <a href="#" type="button" class="btn btn-outline-dark btn-dbplus rounded-circle btn-sm" data-toggle="modal" data-target="#modalDbConf" id="#modalScroll">
                    <i class="fas fa-regular fa-plus"></i>
                  </a>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                      <thead>
                        <tr>
                          <th class="text-center">No.</th>
                          <th class="text-left">Database</th>
                          <th class="text-center">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $actdb = '';
                        $default = '';
                        if( !empty($json_arr) ) {
                          foreach($json_arr['select'] as $key=>$value) { 
                            $actdb = $value['active_db'];
                          }

                          foreach ($json_arr['database'] as $abc=>$bc) {
                            $dbs = $bc['db'] ;
                              foreach ($bc['setting'] as $val) {
                                if($val['default'] == '1'){
                                  $default = $dbs;
                                }
                              }
                          }
                          $no=1;
                          foreach($json_arr['database'] as $key=>$value) { 
                        ?>
                        <tr>
                          <td class="text-center"><?php echo $no++;?>.</td>
                          <td class="text-left"><?php echo $value['db'];?></td>
                          <td class="text-center">
                            
                            <a href="#" type="button" class="edit-db btn btn-outline-warning rounded-circle btn-sm" data-toggle="modal" data-target="#modalDbEdit<?php echo $value['db'];?>" data-name="<?php echo $value['db'];?>" id="#modalScroll" <?php if($actdb == $value['db'] OR $default == $value['db']){echo "style=pointer-events:none;cursor:default;";} ?> >
                              <i class="fas fa-regular fa-pen"></i>
                            </a>
                            <a href="#" type="button" class="del-db btn btn-outline-danger rounded-circle btn-sm" data-toggle="modal" data-target="#modalDbDel<?php echo $value['db'];?>" id="#modalScroll" <?php if($actdb == $value['db'] OR $default == $value['db']){echo "style=pointer-events:none;cursor:default;";} ?> >
                              <i class="fas fa-regular fa-minus"></i>
                            </a>
                          </td>
                        </tr>
                       <?php
                          }
                        }else{
                          echo "
                            <tr>
                              <td colspan='3' class='text-center'>
                                Data Tidak Ditemukan
                              </td>
                            </tr>";
                        }
                       ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
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