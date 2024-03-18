
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
        <?php
          $role = $this->session->userdata("role");
          if(!empty($transaction_detail) ) {
            foreach($transaction_detail as $td) { 
              $pur_no = $td->pur_no;
              $pur_noku = $td->pur_noku;
              $person_no = $td->person_no;
              $inv_no = $td->pur_inv;
              $npj  = $td->no_faktur_pajak;
              if(strtotime($td->tgl_faktur_pajak) <> strtotime('0000-00-00 00:00:00')){
                $tpj = date('Y-m-d', strtotime($td->tgl_faktur_pajak));
              }else{
                $tpj  = date("Y-m-d");
              }  
                
            }
                  
          }else{
              $pur_no = "";
              $pur_noku = "";
              $person_no = "";
              $inv_no = "";
              $npj  = "";
              $tpj  = date("Y-m-d");
          }
        ?>
        <!-- Container Fluid-->
       
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            
          </div>
          <input type="text" id="inputpur_no" name="pur_no" value="<?php echo $pur_no; ?>" hidden>
          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <!-- DataTable with Hover -->
            <div class="col-lg-12" id="d-alert" >
            </div> 
           
            <?php if($pur_no <> ''){ ?>
            <div class="col-lg-11">
              <div class="alert font-weight-bold mr-auto col-sm-10" role="alert" style="background-color: #006d3a;width: 300px;">
                 No. Invoice : <?php echo $pur_no; ?>
              </div>
            </div>
            <div class="col-lg-1">
              <?php
                $id_str = base64_encode($pur_no);
              ?>
              <a href="<?php echo base_url('transaction-detail/'.$id_str);?>" type="button" class="btn btn-outline-secondary rounded btn-sm">Kembali</a>
            </div>
            <?php
              if($role == 2){
            ?>
            <div class="col-sm-12">
              <div class="alert alert-danger border border-danger" role="alert" id="warning-alert">
                <h5>
                  <i class="fas fa-exclamation-triangle"></i>
                  <b>&nbsp;&nbsp;<u>WAJIB</u> mengirimkan <u>Nota Putih Fisik</u> & <u>Faktur Pajak Fisik</u> kepada Sukses Jaya <u>sebelum jatuh tempo</u>.</b>
                </h5>
              </div>
            </div>
            <?php }
            } 

                    $fnrv = 'RF_'.str_replace(".","&",str_replace("/","@",$pur_no)).'_'.str_replace(".","&",str_replace("/","@",$person_no));
                    $fnpy = 'PY_'.str_replace(".","&",str_replace("/","@",$pur_no)).'_'.str_replace(".","&",str_replace("/","@",$person_no));
                    $fnnp = 'NP_'.str_replace(".","&",str_replace("/","@",$pur_no)).'_'.str_replace(".","&",str_replace("/","@",$person_no));
                    $fnpj = 'PJ_'.str_replace(".","&",str_replace("/","@",$pur_no)).'_'.str_replace(".","&",str_replace("/","@",$person_no));

                    $rf_img ='';
                    $pt_img = '';
                    $py_img = '';
                    $pj_img = '';

                    $rf_tp ='';
                    $pt_tp = '';
                    $py_tp = '';
                    $pj_tp = '';

                    if(!empty($rec_img) ) {
                      foreach($rec_img as $a) { 
                        $rf_img = $a->url;
                        $rf_tp = explode('.',$a->filename);
                      }
                    }
                    if(!empty($pth_img) ) {
                      foreach($pth_img as $b) { 
                        $pt_img = $b->url;
                        $pt_tp = explode('.',$b->filename);
                      }
                    }
                    if(!empty($pay_img) ) {
                      foreach($pay_img as $c) { 
                        $py_img = $c->url;
                        $py_tp = explode('.',$c->filename);
                      }
                    }
                    if(!empty($pjk_img) ) {
                      foreach($pjk_img as $d) { 
                        $pj_img = $d->url;
                        $pj_tp = explode('.',$d->filename);
                      }
                    }

                  
              ?>
           <div class="col-lg-6">
              <div class="card cd-ug">
               <!--  <div class="card-header">

                </div> -->
                <div class="card-body">

                 <?php
                  if($role == 1){
                ?>
                  
                  
                  <div class="row">
                    <div class="col-sm-12">
                      <p class="font-weight-bold text-green">Bukti Supplier</p>
                      <hr>
                    </div>
                    <div class="col-sm-12 up-img row">
                      <?php
                        if ($pt_img <> '') {
                      ?>
                      <div class="col-sm-12">
                        <a href="<?php echo ($pt_img);?>" target="_blank">
                      <?php
                            if (strval($pt_tp[1]) == strval('pdf')) {
                        ?>
                            <object data="<?php echo ($pt_img); ?>" type="application/pdf" class="mx-auto d-block mb-3 img-dwd pdf-view" width="100%" height="100%"></object>
                        <?php
                          
                              }else{
                        ?>
                       
                            <img src="<?php echo ($pt_img);?>" class="mx-auto d-block mb-3 img-dwd"/>
                        <?php
                          }
                        ?>
                        </a>
                      </div>
                      <div class="col-sm-12">
                        <a href="<?php echo ($pt_img);?>" target="_blank" type="button" class="btn btn-success rounded mx-auto d-block mb-4" download>Download Nota Putih</a>
                      </div>
                        
                        
                      <?php
                        }else{
                      ?>
                      <div class="col-sm-12">
                        <a href="#">
                          <img src="<?php echo base_url('assets/img/no-img.png')?>" class="mx-auto d-block mb-5 img-dwd"/>
                        </a>
                      </div>
                      <div class="col-sm-12">
                        <a href="#" type="button" class="btn btn-success rounded mx-auto d-block mb-4 disabled">Download Nota Putih</a>
                      </div>   
                      <?php
                        }
                      ?>
                          
                    </div>
                    <div class="col-sm-12 up-img row">
                      <?php
                        if ($pj_img <> '') {
                      ?>
                      <div class="col-sm-12">
                        <a href="<?php echo ($pj_img);?>" target="_blank">
                      <?php
                            if (strval($pj_tp[1]) == strval('pdf')) {
                        ?>
                            <object data="<?php echo ($pj_img); ?>" type="application/pdf" class="mx-auto d-block mb-3 img-dwd pdf-view" width="100%" height="100%"></object>
                        <?php
                          
                              }else{
                        ?>
                       
                            <img src="<?php echo ($pj_img);?>" class="mx-auto d-block mb-3 img-dwd"/>
                        <?php
                          }
                        ?>
                        </a>
                      </div>
                      <div class="col-sm-12 row mb-3"id="dt-pj-form">
                            <div class="col-sm-6 row ml-1">                        
                              <label for="inputnofp" class="col-form-label font-weight-bold txt-mn">No. Faktur Pajak :</label>
                              <input type="text" class="form-control form-control-sm frm-brd" id="inputnofp" placeholder="No. Faktur Pajak" name="nofp" value="<?php echo $npj;?>" readonly>
                            </div>
                            <div class="col-sm-6 row ml-1">
                              <label for="inputglfp" class="col-form-label font-weight-bold txt-mn">Tgl. Faktur Pajak :</label>
                              <input type="date" class="form-control form-control-sm frm-brd" id="inputglfp" name="tglfp" value="<?php echo $tpj; ?>" readonly>
                            </div>
                          </div>
                      <div class="col-sm-12">
                        <a href="<?php echo ($pj_img);?>" target="_blank" type="button" class="btn btn-success rounded mx-auto d-block" download>Download & Print Nota Pajak</a>
                        <p class="fst-italic text-danger mb-4" style="font-size: 12px;">*Print dilakukan sendiri.</p>
                      </div>
                      <?php
                        }else{
                      ?>
                      <div class="col-sm-12">
                        <a href="#">
                          <img src="<?php echo base_url('assets/img/no-img.png')?>" class="mx-auto d-block mb-5 img-dwd"/>
                        </a>
                      </div>
                      <div class="col-sm-12">
                        <a href="#" type="button" class="btn btn-success rounded mx-auto d-block disabled">Download & Print Nota Pajak</a>
                        <p class="fst-italic text-danger mb-4" style="font-size: 12px;">*Print dilakukan sendiri.</p>
                      </div>   
                      <?php
                        }
                      ?>
                          
                    </div>
                  </div>
                  
                  
                  <?php
                  }else{
                  ?>
                  <div class="row">
                    
                    <div class="col-sm-12">
                      <form enctype="multipart/form-data" method="POST">
                        <p class="font-weight-bold text-green">Nota Putih</p>
                        <hr>
                        <?php
                          if ($pt_img <> '') {
                            if (strval($pt_tp[1]) == strval('pdf')) {
                        ?>
                              <object id="pdf-preview3" data="<?php echo ($pt_img); ?>" type="application/pdf" class="mx-auto d-block mb-3 pdf-view" width="100%" height="100%"></object>
                        <?php
                        
                            }else{
                        ?>
                              <img id="img-preview3" src="<?php echo ($pt_img);?>" class="mx-auto d-block mb-3"/>
                        <?php 
                            }
                          }else{
                        ?>
                            <div id="prv-3">
                              <img id="img-none3" src="<?php echo base_url('assets/img/no-img.png')?>" class="mx-auto d-block mb-3"/>
                            </div>
                        <?php
                          }
                        ?>
                        <div class="form-group mb-1">
                          <div class="custom-file">
                            <input type="file" name="img-putih" class="custom-file-input" id="img-np" accept="image/* ,application/pdf" onchange="readURL3(this)" <?php if($pt_img <> ''){ echo "disabled"; } ?>/>
                            <label class="custom-file-label" for="img-np">Pilih File</label>
                          </div>
                          <p class="fst-italic text-danger mb-0" style="font-size: 12px;">*Maksimal Upload 1MB</p>
                          <p class="fst-italic text-danger" style="font-size: 12px;">*Nota > 1 lembar gunakan PDF</p>
                        </div>
                              <input type="text" name="pur_noku" value="<?php echo $pur_no; ?>" hidden>
                              <input type="text" name="person_no" value="<?php echo $person_no; ?>" hidden>
                         <div class="form-group row">
                          <div class="col-sm-10">
                            <a href="#" type="button" name="putih" class="btn btn-warning mx-auto btn-block <?php if($pur_no == ''){echo 'disabled';}?>" onclick="upload_nputih('<?php echo $fnnp; ?>');">Upload Nota Putih</a>
                          </div>
                          <div class="col-sm-2">
                            <?php
                              if ($pt_img <> '') {
                            ?>
                                <a href="#" type="button" name="del-rec" id="drc" class="btn btn-danger mx-auto btn-block" onclick="delete_img('<?php echo $pt_img; ?>');"><i class="fas fa-trash fa-fw"></i></a>
                            <?php
                              }else{
                            ?>
                                <a href="#" type="button" class="btn btn-danger mx-auto btn-block disabled"><i class="fas fa-trash fa-fw"></i></a>
                            <?php
                              }
                            ?>
                            
                          </div>
                        </div>
                        
                      </form>
                    </div>
                    <div class="col-sm-12">
                      <form enctype="multipart/form-data" method="POST">
                       
                        <p class="font-weight-bold text-green">Nota Pajak</p>
                        <hr>

                        <?php
                          if ($pj_img <> '') {
                            if (strval($pj_tp[1]) == strval('pdf')) {
                        ?>
                              <object id="pdf-preview4" data="<?php echo ($pj_img); ?>" type="application/pdf" class="mx-auto d-block mb-3 pdf-view" width="100%" height="100%"></object>
                        <?php
                        
                            }else{
                        ?>
                              <img id="img-preview4" src="<?php echo ($pj_img);?>" class="mx-auto d-block mb-3"/>
                        <?php 
                            }
                          }else{
                        ?>
                            <div id="prv-4">
                              <img id="img-none4" src="<?php echo base_url('assets/img/no-img.png')?>" class="mx-auto d-block mb-3"/>
                            </div>
                        <?php
                          }
                        ?>
                       <!--  <div class="form-group row" id="bt-pj-form">
                         <a href="#" type="button" name="dt-pajak" class="btn btn-warning mx-auto btn-block" id="btn-submit-pajak">Submit</a>
                        </div> -->
                        <div class="form-group mb-1" id="up-pj">
                          <div class="custom-file">
                            <input type="file" name="img-pajak" class="custom-file-input" id="img-pj" accept="image/* ,application/pdf" onchange="readURL4(this)" <?php if($pj_img <> ''){ echo "disabled"; } ?>/>
                            <label class="custom-file-label" for="img-pj">Pilih File</label>
                          </div>
                          <p class="fst-italic text-danger mb-0" style="font-size: 12px;">*Maksimal Upload 1MB</p>
                          <p class="fst-italic text-danger mb-0 " style="font-size: 12px;">*Nota > 1 lembar gunakan PDF</p>
                        </div>
                              <input type="text" name="pur_noku" value="<?php echo $pur_no; ?>" hidden>
                              <input type="text" name="person_no" value="<?php echo $person_no; ?>" hidden>
                        <div class="form-group row"id="dt-pj-form">
                            <div class="col-sm-6 row ml-1">                        
                              <label for="inputnofp" class="col-form-label font-weight-bold txt-mn">No. Faktur Pajak :</label>
                              <input type="text" class="form-control form-control-sm frm-brd" id="inputnofp" placeholder="No. Faktur Pajak" name="nofp" value="<?php echo $npj;?>">
                            </div>
                            <div class="col-sm-6 row ml-1">
                              <label for="inputglfp" class="col-form-label font-weight-bold txt-mn">Tgl. Faktur Pajak :</label>
                              <input type="date" class="form-control form-control-sm" id="inputglfp" name="tglfp" value="<?php echo $tpj; ?>">
                            </div>
                          </div>
                          <input type="text" name="flnm" id="inputfnm" value="<?php echo $fnpj;?>" hidden>
                        <div class="form-group row" id="up-pj2">
                          <div class="col-sm-10">
                            <a href="#" type="button" id="bt-dt-pjk" name="pajak" class="btn btn-warning mx-auto btn-block <?php if($pur_no == ''){echo 'disabled';}?>" >Upload Nota Pajak</a>
                          </div>
                          <div class="col-sm-2">
                            <?php
                              if ($pj_img <> '') {
                            ?>
                              <a href="#" type="button" name="del-rec" id="drc" class="btn btn-danger mx-auto btn-block" onclick="delete_img_pj('<?php echo $pj_img; ?>');"><i class="fas fa-trash fa-fw"></i></a>
                            <?php
                              }else{
                            ?>
                               <a href="#" type="button" class="btn btn-danger mx-auto btn-block disabled"><i class="fas fa-trash fa-fw"></i></a>
                            <?php
                              }
                            ?>

                          </div>
                        </div>
                        
                      </form>
                    </div>
                  </div>
                  
                  <?php
                }
                  ?>
                </div>
              </div>

            </div>
            <div class="col-lg-6">
              <div class="card cd-ug">
                 <!--  <div class="card-header">

                  </div> -->
                  <div class="card-body">
                   <?php
                    if($role == 1){
                  ?>
                    
                    <div class="row">
                      <div class="col-sm-12 up-img">
                        <form enctype="multipart/form-data" method="POST">
                          <p class="font-weight-bold text-green">Tanda Terima</p>
                          <hr>    
                          <?php
                            if ($rf_img <> '') {
                              if (strval($rf_tp[1]) == strval('pdf')) {
                          ?>
                                <object id="pdf-preview1" data="<?php echo ($rf_img); ?>" type="application/pdf" class="mx-auto d-block mb-3 pdf-view" width="100%" height="100%"></object>
                          <?php
                          
                              }else{
                          ?>
                                <img id="img-preview1" src="<?php echo ($rf_img); ?>" class="mx-auto d-block mb-3"/>

                          <?php 
                              }
                            }else{
                          ?>
                            <div id="prv-1">
                              <img id="img-none1" src="<?php echo base_url('assets/img/no-img.png')?>" class="mx-auto d-block mb-3"/>
                            </div>
                          <?php
                            }
                          ?>
                          <div class="form-group mb-1">
                            <div class="custom-file">
                              <input type="file" name="img-receive" class="custom-file-input" id="img-rc" accept="image/* ,application/pdf" onchange="readURL1(this)" <?php if($rf_img <> ''){ echo "disabled"; } ?> />
                              <label class="custom-file-label" for="img-rc">Pilih File</label>
                            </div>
                            <p class="fst-italic text-danger mb-0" style="font-size: 12px;">*Maksimal Upload 1MB</p>
                          </div>
                                <input type="text" name="pur_noku" value="<?php echo $pur_no; ?>" hidden>
                                <input type="text" name="person_no" value="<?php echo $person_no; ?>" hidden>
                                <input type="text" name="inv_no" value="<?php echo $inv_no; ?>" hidden>
                          <div class="form-group row">
                            <div class="col-sm-10">
                              <a href="#" type="button" name="receive" id="rc" class="btn btn-warning mx-auto btn-block <?php if($pur_no == ''){echo 'disabled';}?>" onclick="upload_receive('<?php echo $fnrv; ?>');">Upload Tanda Terima</a>
                            </div>
                            <div class="col-sm-2">
                              <?php
                                if ($rf_img <> '') {
                              ?>
                                <a href="#" type="button" name="del-rec" id="drc" class="btn btn-danger mx-auto btn-block" onclick="delete_img('<?php echo $rf_img; ?>');"><i class="fas fa-trash fa-fw"></i></a>
                              <?php
                                }else{
                              ?>
                                  <a href="#" type="button" class="btn btn-danger mx-auto btn-block disabled" onclick="delete_img('<?php echo $rf_img; ?>');"><i class="fas fa-trash fa-fw"></i></a>
                              <?php
                                }
                              ?>

                            </div>
                          </div>
                        </form>
                      </div>
                      <div class="col-sm-12 up-img">
                        <form enctype="multipart/form-data" method="POST">
                          <p class="font-weight-bold text-green">Bukti Pembayaran</p>
                          <hr>
                          <?php
                            if ($py_img <> '') {
                              if (strval($py_tp[1]) == strval('pdf')) {
                          ?>
                                <object id="pdf-preview2" data="<?php echo ($py_img); ?>" type="application/pdf" class="mx-auto d-block mb-3 pdf-view" width="100%" height="100%"></object>
                          <?php
                          
                              }else{
                          ?>
                                <img id="img-preview2" src="<?php echo ($py_img);?>" class="mx-auto d-block mb-3"/>
                          <?php 
                              }
                            }else{
                          ?>
                            <div id="prv-2">
                              <img id="img-none2" src="<?php echo base_url('assets/img/no-img.png')?>" class="mx-auto d-block mb-3"/>
                            </div>
                          <?php
                            }
                          ?>
                          <div class="form-group mb-1">
                            <div class="custom-file">
                              <input type="file" name="img-pay" class="custom-file-input" id="img-py" accept="image/* ,application/pdf" onchange="readURL2(this)" <?php if($py_img <> ''){ echo "disabled"; } ?> />
                              <label class="custom-file-label" for="img-py">Pilih File</label>
                            </div>
                            <p class="fst-italic text-danger mb-0" style="font-size: 12px;">*Maksimal Upload 1MB</p>
                          </div>
                                <input type="text" name="pur_noku" value="<?php echo $pur_no; ?>" hidden>
                                <input type="text" name="person_no" value="<?php echo $person_no; ?>" hidden>
                                <input type="text" name="inv_no" value="<?php echo $inv_no; ?>" hidden>
                          <div class="form-group row">
                            <div class="col-sm-10">
                              <a href="#" type="button" name="payment" id="py" class="btn btn-warning mx-auto btn-block <?php if($pur_no == ''){echo 'disabled';}?>" onclick="upload_payment('<?php echo $fnpy; ?>');" >Upload Bukti Pembayaran</a>
                            </div>
                            <div class="col-sm-2">
                              <?php
                                if ($py_img <> '') {
                              ?>
                                <a href="#" type="button" name="del-rec" id="drc" class="btn btn-danger mx-auto btn-block" onclick="delete_img('<?php echo $py_img; ?>');"><i class="fas fa-trash fa-fw"></i></a>
                              <?php
                                }else{
                              ?>
                                  <a href="#" type="button" class="btn btn-danger mx-auto btn-block disabled" ><i class="fas fa-trash fa-fw"></i></a>
                              <?php
                                }
                              ?>

                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    
                    <?php
                    }else{
                    ?>
                   
                    <div class="row">
                      <div class="col-sm-12">
                        <p class="font-weight-bold text-green">Bukti Sukses Jaya</p>
                        <hr>
                      </div>
                      <div class="col-sm-12 up-img row">
                        <?php
                          if ($rf_img <> '') {
                        ?>
                         <div class="col-sm-12">
                          <a href="<?php echo ($rf_img);?>" target="_blank">
                        <?php
                            if (strval($rf_tp[1]) == strval('pdf')) {
                        ?>
                            <object data="<?php echo ($rf_img); ?>" type="application/pdf" class="mx-auto d-block mb-3 img-dwd pdf-view" width="100%" height="100%"></object>

                        <?php
                          
                              }else{
                        ?>
                       
                            <img src="<?php echo ($rf_img);?>" class="mx-auto d-block mb-3 img-dwd"/>
                        <?php
                          }
                        ?>
                          </a>
                        </div>
                        <div class="col-sm-12">
                          <a href="<?php echo ($rf_img);?>" target="_blank" type="button" class="btn btn-warning rounded mx-auto d-block" style="background-color: #006d3a;height: 40px;border-color: #006d3a;color : white;" download>Download Tanda Terima</a>
                        </div>
                          
                          
                        <?php
                          }else{
                        ?>

                        <div class="col-sm-12">
                          <a href="#">
                            <img src="<?php echo base_url('assets/img/no-img.png')?>" class="mx-auto d-block mb-5 img-dwd"/>
                          </a>
                        </div>
                        <div class="col-sm-12">
                          <a href="#" type="button" class="btn btn-warning rounded mx-auto d-block disabled" style="background-color: #006d3a;height: 40px;border-color: #006d3a;color : white;">Download Tanda Terima</a>
                        </div>
                            
                            
                        <?php
                          }
                        ?>
                      </div>
                      <div class="col-sm-12">
                        <hr>
                      </div>
                      <div class="col-sm-12 row up-img row">
                        <?php
                          if ($py_img <> '') {
                        ?>
                        <div class="col-sm-12">
                           <a href="<?php echo ($py_img);?>" target="_blank">
                        <?php
                            if (strval($py_tp[1]) == strval('pdf')) {
                        ?>
                            <object data="<?php echo ($py_img); ?>" type="application/pdf" class="mx-auto d-block mb-3 img-dwd pdf-view" width="100%" height="100%"></object>
                        <?php
                          
                              }else{
                        ?>
                       
                            <img src="<?php echo ($py_img);?>" class="mx-auto d-block mb-3 img-dwd"/>
                        <?php
                          }
                        ?>
                          </a>
                        </div>
                        <div class="col-sm-12">
                          <a href="<?php echo ($py_img);?>" target="_blank" type="button" class="btn btn-warning rounded mx-auto d-block" style="background-color: #006d3a;height: 40px;border-color: #006d3a;color : white;" download>Download Bukti Pembayaran</a>
                        </div>
                        <?php
                          }else{
                        ?>
                        <div class="col-sm-12">
                            <a href="#">
                              <img src="<?php echo base_url('assets/img/no-img.png')?>" class="mx-auto d-block mb-5 img-dwd"/>
                            </a>
                        </div>
                        <div class="col-sm-12">
                          <a href="#" type="button" class="btn btn-warning rounded mx-auto d-block disabled" style="background-color: #006d3a;height: 40px;border-color: #006d3a;color : white;">Download Bukti Pembayaran</a>
                        </div>    
                        <?php
                          }
                        ?>
                        
                      </div>
                    </div>
                    <?php
                  }
                    ?>
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