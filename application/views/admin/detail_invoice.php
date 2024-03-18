
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
        <nav class="navbar navbar-expand-lg navbar-light bg-navbar topbar static-top navbar-bottom" style="background-color: white;">
            <a class="navbar-brand mr-auto">
               <b>
                  Detail Pembayaran
              </b>
          </a>   
        </nav>
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
           
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between cd-none">
                  <div class="alert font-weight-bold mr-auto" role="alert" style="background-color: #006d3a">Nota Invoice: <?php echo $id_pembayaran;?></div>
                    <div class="alert font-weight-bold btn-ops">
                        <a href="#print" onclick="window.print();" type="button" class="btn btn-outline-info rounded">
                          Print
                        </a>
                    </div>
                </div>
                <div class="card-body">
                  <div class="row" id="printInvoice">
                  <?php
                    if( !empty($detail) ) {
                      foreach($detail as $td) { 
                  ?>
                    <div class="col-sm-4 mb-3 text-center">
                      <img src="<?php echo base_url();?>assets/img/logo/green.png" style="width: 200px;height: 150px;">
                    </div>
                    <div class="col-sm-4 mb-3" style="font-size: 14px;">
                      <dl class="row list">
                        <dt class="col-sm-4">NAMA</dt>
                        <dd class="col-sm-8">: <?php echo $td->person_name;?></dd>
                        
                        <dt class="col-sm-4">ALAMAT</dt>
                        <dd class="col-sm-8">: <?php echo $td->person_alamat;?></dd>

                      </dl>
                    </div>
                    <div class="col-sm-4 mb-3" style="font-size: 14px;">
                      <dl class="row list">
                        
                        <dt class="col-sm-4">NO. BAYAR</dt>
                        <dd class="col-sm-8">: <?php echo $td->pay_no;?></dd>

                        
                        <dt class="col-sm-4">TGL. BAYAR</dt>
                        <dd class="col-sm-8">: <?php echo date('d-m-Y', strtotime($td->pay_date));?></dd>

                        
                        <dt class="col-sm-4">NO. VOUCHER</dt>
                        <dd class="col-sm-8">: <?php echo $td->pay_voucher;?></dd>
                      </dl>
                    </div>
                    <?php
                          }
                        }
                    ?>
                    <div class="col-sm-12">
                      <h6 class="font-weight-bold">NOTA PEMBAYARAN HUTANG</h6>
                      <div class="table-responsive mb-4">
                        <table class="table align-items-center table-bordered"  style="font-size: 14px;">
                          <thead style="background-color: #006d3a;color: white;">
                            <tr>
                              <th style="width:10px;">No.</th>
                              <th>No. Faktur</th>
                              <th>Tgl. Faktur</th>
                              <th class="text-right">Saldo</th>
                              <th class="text-right">Retur</th>
                              <th class="text-right">Dibayar</th>
                              <th class="text-right">Sisa</th>
                            </tr>
                          </thead>
                          <?php
                            if( !empty($byr_ttl) ) {
                              foreach($byr_ttl as $ttl) { 
                          ?>
                          <tfoot style="background-color: #006d3a;color: white;">
                            <tr>
                              <th colspan="5" class="text-right">Sub Total</th>
                              <th class="text-right"><?php echo "Rp. ". number_format($ttl->bayar,2,'.',','); ?></th>
                              <th class="text-right"><?php echo "Rp. ". number_format($ttl->sisa,2,'.',','); ?></th>
                            </tr>
                          </tfoot>
                          <?php
                              }
                            }
                           ?>
                          <tbody>
                            <?php
                              if( !empty($pembayaran) ) {
                                $no=1;
                                foreach($pembayaran as $tp) { 
                            ?>
                            <tr>
                              <td><?php echo $no++.".";?></td>
                              <td><?php echo $tp->pay_no;?></td>
                              <td><?php echo date('d-m-Y', strtotime($tp->pur_date));?></td>
                              <td class="text-right"><?php echo "Rp. ". number_format($tp->pur_total,2,'.',','); ?></td>
                              <td class="text-right"><?php echo "Rp. ". number_format($tp->ret_total,2,'.',','); ?></td>
                              <td class="text-right"><?php echo "Rp. ". number_format($tp->pay_bayar,2,'.',','); ?></td>
                              <?php $sisa= $tp->pur_total-$tp->pay_bayar;?>
                              <td class="text-right"><?php echo "Rp. ". number_format($sisa,2,'.',','); ?></td>
                            </tr>
                            <?php
                                  }
                                }
                            ?>
                          </tbody>
                        </table>
                      </div>

                      <div class="table-responsive">
                        <table class="table align-items-center" style="font-size: 14px;">
                          <thead>
                            <tr>
                              <th>Jenis</th>
                              <th>Account</th>
                              <th>No. Bayar</th>
                              <th>Tgl. Terbit</th>
                              <th>Term</th>
                              <th>Bank</th>
                              <th class="text-right">Nominal</th>
                            </tr>
                          </thead>
                          <?php
                            if( !empty($akun_ttl) ) {
                              foreach($akun_ttl as $ttl) { 
                          ?>
                          <tfoot>
                            <tr>
                              <th colspan="6" class="text-right">Total</th>
                              <th class="text-right"><?php echo "Rp. ". number_format($ttl->tot_nom,2,'.',','); ?></th>
                            </tr>
                          </tfoot>
                          <?php
                              }
                            }
                           ?>
                          <tbody>
                            <?php
                              if( !empty($akun) ) {
                                foreach($akun as $ta) { 
                            ?>
                            <tr>
                              <td><?php 
                              if ($ta->cek_type == 0) {
                                echo "TUNAI";
                              }elseif ($ta->cek_type == 1) {
                                echo "TRANSFER";
                              }elseif ($ta->cek_type == 2) {
                                echo "BG";
                              }
                              ?>  
                              </td>
                              <td><?php echo $ta->rek_kode." - ".$ta->rek_nama;?></td>
                              <td><?php echo $ta->rek_no;?></td>
                              <td><?php echo date('d-m-Y', strtotime($ta->tgl_terbit));?></td>
                              <td><?php echo date('d-m-Y', strtotime($ta->due_date))?></td>
                              <td><?php echo $ta->bank;?></td>
                              <td class="text-right"><?php echo "Rp. ". number_format($ta->pay_bayar,2,'.',','); ?></td>
                            </tr>
                            <?php
                                  }
                                }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <dl class="row" style="font-size: 14px;">
                        <dt class="col-2">Note</dt>
                        <dd class="col-6">: -</dd>
                      </dl>
                    </div>
                  </div>
                    <div class="col-lg-12 text-right mt-2 cd-none">
                      <a href="<?php echo base_url('transaction-detail/'.base64_encode($id_faktur));?>" type="button" class="btn btn-outline-secondary rounded btn-sm">Kembali</a>
                    </div>
                  </div>
                </div>
                
            </div>
            
          </div>

          <!-- Modal Logout -->
         <?php 
            $this->load->view("_partials/modal.php") 
          ?>
          <!--mODAL-->
        </div>
        <!---Container Fluid-->
      </div>

     </div>
    </div>
  </div>

 <!-- Footer -->
      <?php 
            $this->load->view("_partials/footer.php") 
        ?>
      <!-- Footer -->
