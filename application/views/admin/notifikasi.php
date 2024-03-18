
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
        <nav class="navbar navbar-expand-lg navbar-light bg-navbar topbar static-top navbar-bottom" style="background-color: white;">
            <a class="navbar-brand mr-auto">
               <b class=" text-green">
                  Notifikasi
              </b>
          </a>   
        </nav>
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
           
          </div>

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4 cd-pr-lf">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-end" style="background-color: #006d3a;">
                  <?php $role = $this->session->userdata("role"); ?>
                  <form action="<?php echo base_url('notifikasi/search');?>" method="POST">
                    <div class="form-inline justify-content-around">
                      <div class="form-group row mr-1">
                        <span class="control-label font-weight-bold text-white col-sm-12 pr-1">Periode : </span>
                        <div class="input-group input-group-sm col-sm-12 pr-1">
                          <input type="date" name="start_date" id="start_date" class="form-control dt-nt" value="<?php echo $start_date; ?>" data-date="" data-date-format="DD-MM-YYYY">
                          <div class="input-group-prepend">
                            <span class="input-group-text" style="background-color: #006d3a;border-color: #006d3a;">s/d</span>
                          </div>
                          <input type="date" name="end_date" id="end_date" class="form-control dt-nt" value="<?php echo $end_date; ?>" data-date="" data-date-format="DD-MM-YYYY">
                        </div>
                      </div>
                      <div class="form-group row mr-1 ml-1">
                        <span class="control-label font-weight-bold text-white col-sm-12 pr-1 pl-1">Jenis : </span>
                        <div class="input-group input-group-sm col-sm-12 pr-1 pl-1"> 
                          <select id='filterNota' name="txt_search" class="form-control frm-brd frm-fn"> 
                            <option value='0' <?php if($scr <> 1 AND $scr <> 2 AND $scr <> 3 AND $scr <> 4){ echo 'selected="selected"'; } ?>>Semua</option>
                            <?php if($role == '1'){
                            ?>
                            <option value='3' <?php if($scr == 3){ echo 'selected="selected"'; } ?>>Nota Faktur Putih</option>  
                            <option value='4' <?php if($scr == 4){ echo 'selected="selected"'; } ?>>Nota Faktur Pajak</option> 
                            <?php }else if($role == '2'){
                            ?>
                            <option value='1' <?php if($scr == 1){ echo 'selected="selected"'; } ?>>Nota Receive Faktur</option>  
                            <option value='2' <?php if($scr == 2){ echo 'selected="selected"'; } ?>>Nota Pembayaran</option> 
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row mr-1 ml-1">
                        <span class="control-label font-weight-bold text-white col-sm-12 pr-1 pl-1">Status : </span>
                        <div class="input-group input-group-sm col-sm-12 pr-1 pl-1"> 
                          <select id='sts_notif' name="txt_status" class="form-control frm-brd frm-fn"> 
                            <option value='0' <?php if($sts <> 1 AND $sts <> 2){ echo 'selected="selected"'; } ?>>Semua</option>
                            <option value='1' <?php if($sts == 1){ echo 'selected="selected"'; } ?>>Sudah Dibaca</option>  
                            <option value='2' <?php if($sts == 2){ echo 'selected="selected"'; } ?>>Belum Dibaca</option> 
                          </select>
                        </div>
                      </div>
                      <div class="form-group row ml-1">
                        <span class="control-label font-weight-bold text-white col-sm-12 pl-1">Search : </span>
                        <div class="input-group input-group-sm col-sm-12 pl-1"> 
                          <input id="src_notif" type="text" name="txt_cari" class="form-control frm-brd frm-fn" value="<?php echo ($cr <> '') ? htmlspecialchars($cr) : ''; ?>">
                        </div>
                      </div>
                      <div class="form-group row mr-1 ml-1">
                        <span class="control-label text-green col-sm-12">S</span>
                        <div class="input-group input-group-sm col-sm-12">
                          <button type="submit" class="btn btn-success btn-sm">
                            <img src="<?php echo base_url();?>assets/img/icon/load.png" style="width: 20px;">
                          </button>
                        </div>
                        
                      </div>
                    </div>
                  </form>
                </div>
                <div class="card-body pt-1">
                  <!-- <a href="#" type="button" onclick="load_unseen_notification();">klik</a> -->
                  <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                      <tbody>
                        <?php
                        if( is_array($notif) ) {
                          
                          foreach($notif as $a) { 
                            $dt = new DateTime($a->notif_date);
                            $date = $dt->format('d/m/Y');
                            if($a->notif_type == 1){
                                $jns = 'Receive Faktur';
                            }elseif ($a->notif_type == 2) {
                                $jns = 'Pembayaran';
                            }elseif ($a->notif_type == 3) {
                                $jns = 'Nota Putih';
                            }elseif($a->notif_type == 4){
                                $jns = 'Nota Pajak';
                            }
                            if($a->is_read == 0){
                                $clr = 'bg-danger';
                            }else{
                                $clr = 'bg-primary';
                            }
                            $id_str = base64_encode(str_replace("&",".",str_replace("@","/",$a->pur_no)));
                            $url =  base_url('notifikasi/detail/'.$id_str.'/'.$a->id);
                        ?>
                        <tr>
                          <td class="text-left">
                            <a class="d-flex align-items-center text-decoration-none text-success" href="<?php echo $url; ?>">
                              <div class="row">
                                <div class=" col-sm-2 mt-3">
                                  <div class="mr-3">
                                    <div class="icon-circle <?php echo $clr; ?>">
                                      <i class="fas fa-image text-white"></i>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-10">
                                  <div>
                                    <div class="small text-gray-500"><?php echo $date; ?></div>
                                    <span class="font-weight-bold"><?php echo $jns; ?></span><br/>
                                    <span class="font-weight-light">Bukti No. Inv <?php echo str_replace("&",".",str_replace("@","/",$a->pur_no)); ?> sudah diupload! </span>
                                  </div>
                                </div>
                              </div>
                            </a>
                          </td>
                          <td>
                            <div class="row">
                              <div class="mr-3 mt-4">
                                <span class="font-weight-bold"> <?php echo $a->person_name; ?></span>
                              </div>
                            </div>
                          </td>
                        </tr>
                       <?php
                          }
                        }else{
                          echo "
                            <tr>
                              <td class='text-center font-weight-bold'>
                                Tidak ada notifikasi
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
            <!-- <div class="col-lg-2">
              
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
            $this->load->view("_partials/footer.php");
        ?>
      <!-- Footer -->