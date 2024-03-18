
 <?php 
    $this->load->view("_partials/header.php") 
?>


  <div id="wrapper">
    <!-- Sidebar -->
    <div id="loading"></div>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
       <?php 
            $this->load->view("_partials/navbar.php") 
        ?>
        <!-- Topbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-navbar topbar static-top navbar-bottom" style="background-color: white;">
            <a class="navbar-brand mr-auto">
               <b class=" text-green">
                  Transaksi List
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
            <!-- <a href="<?php echo base_url('transaction/test');?>">test</a> -->
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="pl-3 pt-3 align-items-center justify-content-between cd-none">
                </div>
                <div class="card-header pt-3 pl-3 pr-3 pb-1 d-flex flex-row align-items-center justify-content-between cd-none">
                  <form action="<?php echo base_url('transaction/search');?>" method="POST" style="font-size: 13px;">
                    <div class="form-inline justify-content-around mb-3">
                      <div class="form-group col-md-4 row">
                        <span class="control-label font-weight-bold">Periode :</span>
                        <div class="input-group input-group-sm filter-src dt-gr">

                          <input type="date" name="start_date" class="form-control frm-brd dt-wd" value="<?php echo $start_date; ?>" data-date="" data-date-format="DD-MM-YYYY">
                          <div class="input-group-prepend">
                            <span class="input-group-text" style="background-color: #006d3a;border-color: #006d3a;">s/d</span>
                          </div>
                          <input type="date" name="end_date" class="form-control frm-brd dt-wd" value="<?php echo $end_date; ?>" data-date="" data-date-format="DD-MM-YYYY">
                        </div>
                      </div>
                      <div class="form-group col-xs-2 col-md-2">
                        <span class="control-label font-weight-bold">Saldo Akhir :</span>
                        <div class="input-group input-group-sm filter-src">
                          <select id=''name="slc_status" class="form-control frm-brd sl-wd">
                            <option value='0' <?php if($status <> 1 AND $status <> 2){ echo 'selected="selected"'; } ?>>Semua</option>          
                            <option value='1' <?php if($status == 1){ echo 'selected="selected"'; } ?>>Lunas</option>  
                            <option value='2' <?php if($status == 2){ echo 'selected="selected"'; } ?>>Belum Lunas</option>  
                          </select>
                        </div>
                      </div>
                      
                      <div class="form-group col-xs-2 col-md-2">
                        <span class="control-label font-weight-bold">Faktur Pajak :</span>
                        <div class="input-group input-group-sm filter-src"> 
                          <select id='' name="slc_pajak" class="form-control frm-brd sl-wd">
                            <option value='0' <?php if($pajak <> 1 AND $pajak <> 2){ echo 'selected="selected"'; } ?>>Semua</option>          
                            <option value='1' <?php if($pajak == 1){ echo 'selected="selected"'; } ?>>Faktur Pajak</option>  
                            <option value='2' <?php if($pajak == 2){ echo 'selected="selected"'; } ?>>Tanpa Faktur Pajak</option> 
                          </select>
                        </div>
                      </div>
                      <div class="form-group col-xs-3 col-md-3 btn-gr">
                        <div class="btn-group input-group input-group-sm filter-src">
                          <button type="submit" class="btn btn-success btn-sm btn-trx" style="height: 40px;">Refresh
                          </button>
                        </div> 
                        <div class="btn-group input-group input-group-sm filter-src">
                          <a href="<?php echo base_url('transaction/clear');?>" type="button" class="btn btn-warning btn-sm btn-trx pt-2" style="height: 40px;">Clear</a>
                        </div>
                        <div class="btn-group input-group input-group-sm filter-src" style=" height: 40px;">
                            <button type="button" class="btn btn-sm btn-info dropdown-toggle btn-trx" data-toggle="dropdown"
                              aria-haspopup="true" aria-expanded="false">
                              Download
                            </button>
                            <div class="dropdown-menu ">
                              <a class="dropdown-item" href="#" id="btnExport" onclick="printExcel();">Excel</a>
                              <a class="dropdown-item" href="#" id="btnprintPembelian">CSV</a>
                              <a class="dropdown-item" href="#" onclick="window.print();">PDF</a>
                            </div>
                        </div>  
                      </div>
                    </div>
                    <?php
                          if($role = $this->session->userdata("role") == 1){
                      ?>
                    <div class="form-inline justify-content-around mb-3">
                      <div class="form-group col-xs-3 col-md-3">
                        <span class="control-label font-weight-bold">Supplier :</span>
                        <div class="input-group input-group-sm filter-src"> 
                          <select id='supSr' name="slc_supplier" class="select2-single form-control frm-brd sl-sp">
                            <option value=''<?php if($supplier == ''){ echo 'selected="selected"'; } ?>>Semua</option> 
                            <?php
                            if( !empty($supp) ) {
                              foreach($supp as $s) { 
                            ?>       
                            <option value="<?php echo $s->person_no; ?>" <?php if($supplier == $s->person_no){ echo 'selected="selected"'; } ?>><?php echo $s->person_name; ?> </option>
                            <?php
                                }
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group col-xs-9 col-md-9">
                      </div>
                    </div>
                      <?php
                          }
                        ?>
                     <div class="form-inline justify-content-start">
                      <div class="form-group col-xs-2 col-md-2">
                        <span class="control-label font-weight-bold">Show :</span>
                        <div class="input-group input-group-sm filter-src">
                          <input type="number" name="nm_row" class="form-control frm-brd rw-wd" id="maxRows">
                        </div>
                        <span class="control-label font-weight-bold">entries</span>
                      </div>
                      <div class="form-group col-xs-7 col-md-7">
                      </div>
                      <div class="form-group col-xs-3 col-md-3 src-tx">
                        <span class="control-label font-weight-bold">Search :</span>
                        <div class="input-group input-group-sm filter-src">
                          <input type="text" name="txt_search" id="txtSearch" class="form-control frm-brd src-wd" placeholder="Masukkan No.Invoice / No. Faktur Pajak" onkeyup="filterSearch()" value="<?php echo $search; ?>">
                        </div> 
                      </div>
                    </div>
                  </form>
                  <script type="text/javascript">
                   $(document).ready(function() {
                       $('#supSr').select2();
                   });
                  </script>
                </div>
                <div class="table-responsive pb-3 pl-3 pr-3 pt-1" id="printPembelian" style="font-size: 13px;">
                  <table class="table align-items-center table-bordered table-hover sortable" id="table-id" width="auto">
                    <thead style="background-color: #006d3a;color: white;">
                      <tr>
                        <th class="text-center">No. Invoice</th>
                        <th class="sorttable_nosort text-center">Tanggal</th>
                        <?php
                          if($role = $this->session->userdata("role") == 1){
                            echo"<th class='sorttable_nosort text-center'>Supplier</th>";
                          }
                        ?>
                        <th class="sorttable_nosort text-center">Faktur</th>
                        <th class="sorttable_nosort text-center">No. Faktur Pajak</th>
                        <th class="text-right sorttable_nosort">Total</th>
                        <th class="text-right sorttable_nosort">Retur</th>
                        <th class="text-right sorttable_nosort">Bayar</th>
                        <th class="text-right sorttable_nosort">Saldo Akhir</th>
                        <th class="cd-none sorttable_nosort text-center">Keterangan</th>
                        <th class="cd-none text-center sorttable_nosort">Aksi</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                      <?php
                      if( !empty($transaction) ) {
                        foreach($transaction as $t) { 
                      ?>
                      <tr>
                        <td class="text-left"><?php echo $t->pur_no; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($t->pur_date )); ?></td>
                        <?php
                          if($role = $this->session->userdata("role") == 1){
                            echo"<td>".$t->person_name."</td>";
                          }
                        ?>
                        <td class="text-center"><input type="checkbox" <?php if($t->is_faktur == '1'){ echo"checked";}?> onclick="return false" ></td>

                        <td><?php echo $t->no_faktur_pajak; ?></td>
                       
                        <td class="text-right"><?php echo "Rp. ". number_format($t->pur_total,2,'.',','); ?></td>
                        <td class="text-right"><?php echo "Rp. ". number_format($t->ret_total,2,'.',','); ?></td> 
                        
                        
                        <td class="text-right"><?php echo "Rp. ". number_format($t->Bayar,2,'.',','); ?></td>
                        <?php $pur_saldo_hasil = ($t->Sisa);?>
                        <td class="text-right"><?php echo "Rp. ". number_format($pur_saldo_hasil,2,'.',','); ?></td>
                        <?php 
                          if($pur_saldo_hasil > 0){
                        ?>
                        <td class="text-center cd-none"><span class="badge badge-status badge-pill badge-danger"  style="font-size: 12px;">Belum Lunas</span> - <span><?php echo $t->pur_ket; ?></span></td>
                        <?php
                          }else{
                        ?>
                        <td class="text-center cd-none"><span class="badge badge-status badge-pill badge-success"  style="font-size: 12px;">Lunas</span> - <span><?php echo $t->pur_ket; ?></span></td>
                        <?php
                          }
                          $id_str = base64_encode($t->pur_no_ril);
                          $id_prs = base64_encode($t->person_no); 
                        ?>
                        <td class="cd-none text-center">
                          <a href="<?php echo base_url('transaction-detail/'.$id_str);?>" type="button" class="btn btn-outline-info rounded-circle btn-sm" title="detail transaksi">
                            <i class="fas fa-regular fa-paste"></i>
                          </a>
                          
                          <a href="<?php echo base_url('transaction/upload/'.$id_str.'/'.$id_prs);?>" type="button" class="btn btn-outline-warning rounded-circle btn-sm" title="upload gambar">
                            <i class="fas fa-regular fa-upload"></i>
                          </a>
                          <!--base_url('transaction-detail') in controller admin/transaction/detail-->
                          <!--lihat pada routes untuk lebih jelas-->
                          <?php
                            if($this->session->userdata("role") == 1){
                          ?>
                          <!-- <a href="#" type="button" class="btn btn-outline-warning rounded-circle btn-sm" data-toggle="modal" data-target="#modalTransaksi" id="#modalScroll">
                            <i class="fas fa-solid fa-upload"></i>
                          </a> -->
                          <?php 
                            }
                          ?>
                        </td>
                      </tr>

                     <?php
                        }
                      }else{
                          if($role = $this->session->userdata("role") == 1){
                            echo "
                              <tr>
                                <td colspan='11' class='text-center'>
                                  Data Tidak Ditemukan
                                </td>
                              </tr>";
                          }else{
                            echo "
                              <tr>
                                <td colspan='10' class='text-center'>
                                  Data Tidak Ditemukan
                                </td>
                              </tr>";
                          }
                        
                      }
                     ?>
                    </tbody>
                    <tfoot style="background-color: #006d3a;color: white;">
                      <?php
                        $pt = 0;
                        $rt = 0;
                        $ptt = 0;
                        $sa = 0;
                      if( !empty($total) ) {
                        foreach($total as $ttl) { 
                          $pt += $ttl->sum_pur_total;
                          $rt += $ttl->sum_ret_total;
                          $ptt += $ttl->sum_pur_total_tunai;
                          $sa += $ttl->sum_saldo_akhir;
                      ?>
                      <?php
                        }
                      }else{
                        $pt = 0;
                        $rt = 0;
                        $ptt = 0;
                        $sa = 0;
                      }
                     ?>
                     <tr class="tfooter" >
                        <?php
                          if($role = $this->session->userdata("role") == 1){
                            echo"<th style='width:44%' colspan='5' class='text-right'>Total</th>";
                          }else{
                            echo"<th style='width:33%' colspan='4' class='text-right'>Total</th>";
                          }
                        ?>
                            <!-- <th style="width:12%" class="text-right"><?php echo "Rp. ". number_format($ttl->sum_pur_total,2,'.',','); ?></th>
                            <th style="width:12%" class="text-right"><?php echo "Rp. ". number_format($ttl->sum_ret_total,2,'.',','); ?></th>
                            <th style="width:12%" class="text-right"><?php echo "Rp. ". number_format($ttl->sum_pur_total_tunai,2,'.',','); ?></th>
                            <th style="width:12%" class="text-right"><?php echo "Rp. ". number_format($ttl->sum_saldo_akhir,2,'.',','); ?></th>
                            <th style="width:19%" colspan="2" class="cd-none"></th> -->
                            <th class="text-right"><?php echo "Rp. ". number_format($pt,2,'.',','); ?></th>
                            <th class="text-right"><?php echo "Rp. ". number_format($rt,2,'.',','); ?></th>
                            <th class="text-right"><?php echo "Rp. ". number_format($ptt,2,'.',','); ?></th>
                            <th class="text-right"><?php echo "Rp. ". number_format($sa,2,'.',','); ?></th>
                            <th colspan="2" class="cd-none"></th>
                      </tr>
                    </tfoot>
                  </table>
                  <span>Data result <?php echo $result;?>  rows</span>
                </div>
                <div class="pagination-container ml-auto mr-3 mt-1">
                  <nav>
                    <ul class="pagination">
                      
                      <li class="page-item" data-page="prev"  style="cursor: pointer; cursor: hand;">
                        <span class="page-link"> Prev <span class="sr-only">(current)</span></span>
                      </li>
                     <!-- Here the JS Function Will Add the Rows -->
                      <li class="page-item" data-page="next" id="prev"  style="cursor: pointer; cursor: hand;">
                        <span class="page-link"> Next <span class="sr-only">(current)</span></span>
                      </li>

                    </ul>
                  </nav>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal -->
          <?php 
            $this->load->view("_partials/modal.php") 
          ?>
          <!--mODAL-->
         
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