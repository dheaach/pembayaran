
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
                  Transaksi Detail
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
            <?php
           
              if( !empty($transaction_detail) ) {
                foreach($transaction_detail as $td) { 
            ?>
           <div class="col-lg-12 cd-none">
              <div class="card mb-4 cd-top-left">
                <div class="card-header py-3 d-flex flex-row align-items-center d-flex justify-content-between">
                  <div class="alert font-weight-bold mr-auto" role="alert" style="background-color: #006d3a">Detail Invoice : <?php echo $td->pur_no;?></div>
                  <div class="alert font-weight-bold btn-ops">
                    <?php 
                      $id_str = base64_encode($td->pur_no);
                      $id_prs = base64_encode($td->person_no); 
                    ?>
                    <a href="<?php echo base_url('transaction/upload/'.$id_str.'/'.$id_prs);?>" type="button" class="btn btn-outline-warning rounded bt-upload">Upload Transaksi</a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-4">
                      <dl class="row" style="font-size: 14px;width: 350px;margin-left:40px;">
                        <dt class="col-sm-6">Nama Supplier</dt>
                        <dd class="col-sm-6">: <?php echo $td->person_name;?></dd>
                        

                        <dt class="col-sm-6">No. Invoice</dt>
                        <dd class="col-sm-6">: <?php if($td->pur_inv <> ''){ echo $td->pur_inv;}else{echo '-';}?></dd>
                        

                        <dt class="col-sm-6">Tgl. Invoice</dt>
                        <dd class="col-sm-6">: <?php if($td->pur_no <> ''){ echo date('d-m-Y', strtotime($td->pur_inv_date));}else{echo '-';}?></dd>
                        

                        <dt class="col-sm-6">No. Faktur Pajak</dt>
                        <dd class="col-sm-6">: <?php if ($td->no_faktur_pajak<> '') {echo $td->no_faktur_pajak;}else{echo '-';}?></dd>
                        
                      </dl>
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                      <dl class="row" style="font-size: 14px;margin-left:40px;">
                        
                        <dt class="col-sm-6">No. Transaksi</dt>
                        <dd class="col-sm-6">: <?php if($td->pur_no <> ''){ echo $td->pur_no;}else{echo '-';}?></dd>

                        
                        <dt class="col-sm-6">Tgl Transaksi</dt>
                        <dd class="col-sm-6">: <?php if($td->pur_date <> ''){ echo date('d-m-Y', strtotime($td->pur_date));}else{ echo '-';}?></dd>

                        
                        <dt class="col-sm-6">Jatuh Tempo</dt>
                        <dd class="col-sm-6">: <?php if($td->pur_date <> ''){ echo date('d-m-Y', strtotime($td->ndays.' days', strtotime($td->pur_date)));}else{echo '-';}?></dd>

                        
                        <dt class="col-sm-6">Keterangan</dt>
                        <dd class="col-sm-6">: -</dd>
                      </dl>
                    </div>
                    <div class="col-sm-3"></div>
                  </div>
                  <h5 class="font-weight-bold py-3" style="color: #006d3a">Detail Transaksi</h5>
                  <div class="row">
                    <div class="col-sm-4">
                      <dl class="row" style="font-size: 14px;width: 350px;margin-left:40px;">
                        <dt class="col-sm-6">Subtotal</dt>
                        <dd class="col-sm-6">: <?php echo "Rp. ". number_format($td->pur_ord_subtotal,2,'.',','); ?></dd>
                        
                     
                        <dt class="col-sm-6">Discount</dt>
                        <dd class="col-sm-6">: <?php echo "Rp. ". number_format($td->pur_pot_rp_kurs,2,'.',','); ?></dd>
                        
                        <dt class="col-sm-6">PPN <?php if($td->is_ppn == 2){ echo"[ Inc ] ".$td->tax_amount."%";}elseif($td->is_ppn == 1){ echo"[ Exc ] ".$td->tax_amount."%";} ?></dt>
                        <dd class="col-sm-6">: <?php echo "Rp. ". number_format($td->pur_ppn_rp_kurs,2,'.',','); ?></dd>
                        
                      </dl>
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                      <dl class="row" style="font-size: 14px;margin-left:40px;">
                        
                        <dt class="col-sm-6">Grand Total</dt>
                        <dd class="col-sm-6">: <?php echo "Rp. ". number_format($td->pur_total_kurs,2,'.',','); ?></dd>
                     
                        
                        <dt class="col-sm-6">Total Bayar</dt>
                        <dd class="col-sm-6">: <?php echo "Rp. ". number_format($td->pur_total_tunai,2,'.',','); ?></dd>
                     
                        
                        <dt class="col-sm-6">Sisa Hutang</dt>
                        <?php $sisa = ($td->pur_total_kurs) - ($td->pur_total_tunai);?>
                        <dd class="col-sm-6">: <?php echo "Rp. ". number_format($sisa,2,'.',','); ?></dd>  
                      </dl>
                    </div>
                    <div class="col-sm-3"></div>
                  </div>
                  <?php
                        }
                      }
                  ?>
                  <h5 class="font-weight-bold py-3" style="color: #006d3a;">List Pembayaran : </h5>
                  <div class="col-sm-12">
                      <div class="table-responsive mb-4">
                        <table class="table align-items-center table-bordered"  style="font-size: 13px;" width="100%">
                          <thead style="background-color: #006d3a;color: white;">
                            <tr>
                              <th style="width: 25%;">No. Pembayaran</th>
                              <th style="width: 10%;">Tanggal</th>
                              <th style="width: 20%;" class="text-right">Total Retur</th>
                              <th style="width: 20%;" class="text-right">Total Bayar</th>
                              <th style="width: 15%;">Keterangan</th>
                              <th style="width: 5%;" class="text-center">Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              if( !empty($transaction_payment) ) {
                                foreach($transaction_payment as $tp) { 
                            ?>
                            <tr>
                              <td><?php echo $tp->pay_no;?></td>
                              <td><?php echo date('d-m-Y', strtotime($tp->pay_date)); ?></td>
                              <td class="text-right"><?php echo "Rp. ". number_format($tp->ret_total,2,'.',','); ?></td>
                              <td class="text-right"><?php echo "Rp. ". number_format($tp->pay_total_kurs,2,'.',','); ?></td>
                              <td><?php echo $tp->pay_ket;?></td>
                              <td class="text-center">
                                <a href="<?php echo base_url('detail-invoice/'.base64_encode($id_inv).'/'.base64_encode($tp->pay_no));?>" type="button" class="btn btn-outline-info rounded-circle btn-sm">
                                    <!--base_url('detail-invoice') in controller admin/transaction/detail_invoice-->
                                    <!--lihat pada routes untuk lebih jelas-->
                                  <i class="fas fa-solid fa-eye"></i>
                                </a>
                              </td>
                            </tr>
                             <?php
                                }
                              }
                             ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="col-lg-12 text-right mt-2 cd-none">
                      <a href="<?php echo base_url('transaction');?>" type="button" class="btn btn-outline-secondary rounded btn-sm">Kembali</a>
                       <!--base_url('transaction') in controller admin/transaction-->
                      <!--lihat pada routes untuk lebih jelas-->
                    </div>
                </div>
              </div>
            </div>

           
            
            
          </div>
          <!--Row-->

          <!-- Documentation Link -->
          <div class="row">
            <div class="col-lg-12">
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
  </div>

 <!-- Footer -->
      <?php 
            $this->load->view("_partials/footer.php") 
        ?>
      <!-- Footer -->