
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
        <!-- <h1>
          <?php 
            if( !empty($cdb) ) {
              foreach($cdb as $cb) {  
                echo $cb->user_name;
              }
            }
          ?>   
        </h1> -->
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            
          </div>
          <div class="row mb-3">
            <!-- belum lunas -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100 bg-light">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-sm font-weight-bold text-uppercase mb-1">Nota Belum Lunas</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-primary">
                        <?php 
                          if( !empty($BlmLunas) ) {
                            foreach($BlmLunas as $bl) {  
                              echo number_format($bl->jml_pur_no);
                            }
                          }else{
                            echo"0";
                          }
                        ?>   
                      </div>
                    </div>
                    <div class="col-auto">
                      <img class="icon" src="<?php echo base_url('assets/img/icon/nbl.png');?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- sudah lunas -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100 bg-light">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-sm font-weight-bold text-uppercase mb-1">Nota Sudah Lunas</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-primary">
                        <?php 
                          if( !empty($SdhLunas) ) {
                            foreach($SdhLunas as $sd) {  
                              echo number_format($sd->jml_pur_no);
                            }
                          }else{
                            echo"0";
                          }
                        ?>   
                      </div>
                    </div>
                    <div class="col-auto">
                      <img class="icon" src="<?php echo base_url('assets/img/icon/nl.png');?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Tanpa faktur pajak -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100 bg-light">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-sm font-weight-bold text-uppercase mb-1">Nota Tanpa Faktur Pajak</div>
                      <div class="h5 mb-0 font-weight-bold text-primary">
                        <?php 
                          if( !empty($FakturPajak) ) {
                            foreach($FakturPajak as $fk) {  
                              echo number_format($fk->jml_pur_no);
                            }
                          }else{
                            echo"0";
                          }
                        ?>
                      </div>
                      <!--<div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                        <span>Since last month</span>
                      </div>-->
                    </div>
                    <div class="col-auto">
                      <img class="icon" src="<?php echo base_url('assets/img/icon/py.png');?>" style="width:55px; ">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Tanpa tanda terima faktur -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100 bg-light">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-sm font-weight-bold text-uppercase mb-1">Nota Tanpa Tanda Terima Faktur</div>
                      <div class="h5 mb-0 font-weight-bold text-primary">
                        <?php 
                          if( !empty($Faktur) ) {
                            foreach($Faktur as $f) {  
                              echo number_format($f->jml_pur_no);
                            }
                          }else{
                            echo"0";
                          }
                        ?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <img class="icon" src="<?php echo base_url('assets/img/icon/rcv.png');?>" style="width: 45px;">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Belum Lunas -->
            <div class="col-xl-12 col-lg-7 mb-4">
              <div class="card cd-chart">
                <div class="card-header py-3 d-flex flex-row align-items-center">
                  <h6 class="m-0 font-weight-bold text-primary mr-auto">Laporan Pembelian </h6>
                  <form action="<?php echo base_url('overview/chart');?>" method="post">
                    <div class="dropdown no-arrow mr-2">
                      <a class="dropdown-toggle btn btn-primary btn-sm btn-ovw" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Range <i class="fas fa-chevron-down"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Pilih Range</div>
                        <button type="submit" name="day" id="day" value="day" class="dropdown-item <?php if ($range == '1') { echo"active";}?>">Hari</button>
                        <button type="submit" name="month" id="month" value="month" class="dropdown-item <?php if ($range == '2') { echo"active";}?>">Bulan</button>
                        <button type="submit" name="year" id="year" value="year" class="dropdown-item <?php if ($range == '3') { echo"active";}?>">Tahun</button>
                      </div>
                    </div>
                  </form>
                  <form action="<?php echo base_url('overview/sub_chart');?>" method="post">
                  <?php if ($range <> '3') {?>
                    <div class="dropdown no-arrow">
                      <a class="dropdown-toggle btn btn-primary btn-sm btn-ovw" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sub Range <i class="fas fa-chevron-down"></i>
                      </a>
                        <?php if ($range == '1') {?>
                          <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Bulan</div>
                            <?php
                              $bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                              $jlh_bln=count($bulan);
                              for($c=1; $c<$jlh_bln; $c+=1){
                    ?>
                                  <button type="submit" name="smonth" value="<?php echo $c; ?>" class="dropdown-item <?php if ($sub_range == $c) { echo"active";}?>"><?php echo $bulan[$c]; ?></button>
                    <?php
                              }
                            ?>
                          </div>
                        <?php } else if ($range =='2') {?>
                          <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Tahun</div>
                            <?php
                              $now=date('Y');
                              for ($a=2010;$a<=$now;$a++)
                              {
                                  echo'<button type=submit name=syear value='.$a.' class=dropdown-item>'.$a.'</button>';
                              }
                            ?>
                          </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                  </form>
                </div>
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myChart"></canvas>
                  </div>
                </div>
                <div class="card-footer">
                  <a class="m-0 float-right btn btn-success btn-sm" href="<?php echo base_url('transaction');?>">Lihat Detail <i class="fas fa-chevron-right"></i></a>
                </div>
              </div>
            </div>
            <!-- Download KTP dan NPWP-->
            <!-- <div class="col-xl-3 col-lg-5">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Data Usaha</h6>
                </div>
                <div class="card-body">
                  <div class="mb-3">
                    <div class="">
                      <a type="button" class="btn btn-success text-white" download="nik.jpg" href="<?php echo base_url();?>assets/img/user/ktp.jpg" title="Download KTP" style="width: 100%">DOWNLOAD KTP</a>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="">
                      <a type="button" class="btn btn-success text-white" download="npwp.jpg" href="<?php echo base_url();?>assets/img/user/npwp.png" title="Download NPWP" style="width: 100%">DOWNLOAD NPWP</a>
                    </div>
                  </div>
                   <div class="">
                    <div class="">
                      <form action="<?php echo base_url('overview/download');?>" method="post">
                        <button type="submit" name="dwnall" class="btn btn-success text-white" title="Download Semua" style="width: 100%">DOWNLOAD SEMUA</button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-center">
                  <a class="m-0 small text-primary card-link" href="<?php echo base_url('profile');?>">Lihat Detail <i
                      class="fas fa-chevron-right"></i></a>
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