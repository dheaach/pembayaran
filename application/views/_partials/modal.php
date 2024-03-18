        <!--Modal logout-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Peringatan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Anda yakin akan keluar website?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                  <a href="<?php echo base_url('logout');?>" class="btn btn-danger" >Logout</a>
                </div>
              </div>
            </div>
          </div>
          <!--Modal-->
          <!--Modal upload transaksi-->
          <div class="modal fade" id="modalTransaksi" tabindex="-1" role="dialog"
            aria-labelledby="modalTransaksiTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <div class="modal-title font-weight-bold align-self-center" id="modalTransaksiTitle">
                    Upload Transaksi
                  </div>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <?php
                if(!empty($transaction_detail) ) {
                      foreach($transaction_detail as $td) { 
                ?>
                <div class="modal-body">
                <?php 
                    if (file_exists('assets/img/nota_putih/PT_'.$td->pur_noku.'_'.$td->person_no.'.png')) {
                      $pt_img = 'assets/img/nota_putih/PT_'.$td->pur_noku.'_'.$td->person_no.'.png';
                    }elseif (file_exists('assets/img/nota_putih/PT_'.$td->pur_noku.'_'.$td->person_no.'.jpg')) {
                      $pt_img = 'assets/img/nota_putih/PT_'.$td->pur_noku.'_'.$td->person_no.'.jpg';
                    }elseif (file_exists('assets/img/nota_putih/PT_'.$td->pur_noku.'_'.$td->person_no.'.jpeg')) {
                      $pt_img = 'assets/img/nota_putih/PT_'.$td->pur_noku.'_'.$td->person_no.'.jpeg';
                    }else{
                      $pt_img = '';
                    }

                    if (file_exists('assets/img/nota_pajak/PJ_'.$td->pur_noku.'_'.$td->person_no.'.png')) {
                      $pj_img = 'assets/img/nota_pajak/PJ_'.$td->pur_noku.'_'.$td->person_no.'.png';
                    }elseif (file_exists('assets/img/nota_pajak/PJ_'.$td->pur_noku.'_'.$td->person_no.'.jpg')) {
                      $pj_img = 'assets/img/nota_pajak/PJ_'.$td->pur_noku.'_'.$td->person_no.'.jpg';
                    }elseif (file_exists('assets/img/nota_pajak/PJ_'.$td->pur_noku.'_'.$td->person_no.'.jpeg')) {
                      $pj_img = 'assets/img/nota_pajak/PJ_'.$td->pur_noku.'_'.$td->person_no.'.jpeg';
                    }else{
                      $pj_img = '';
                    }

                    if (file_exists('assets/img/receive_faktur/RF_'.$td->pur_noku.'_'.$td->person_no.'.png')) {
                      $rf_img = 'assets/img/receive_faktur/RF_'.$td->pur_noku.'_'.$td->person_no.'.png';
                    }elseif (file_exists('assets/img/receive_faktur/RF_'.$td->pur_noku.'_'.$td->person_no.'.jpg')) {
                      $rf_img = 'assets/img/receive_faktur/RF_'.$td->pur_noku.'_'.$td->person_no.'.jpg';
                    }elseif (file_exists('assets/img/receive_faktur/RF_'.$td->pur_noku.'_'.$td->person_no.'.jpeg')) {
                      $rf_img = 'assets/img/receive_faktur/RF_'.$td->pur_noku.'_'.$td->person_no.'.jpeg';
                    }else{
                      $rf_img = '';
                    }

                    if (file_exists('assets/img/payment/PY_'.$td->pur_noku.'_'.$td->person_no.'.png')) {
                      $py_img = 'assets/img/payment/PY_'.$td->pur_noku.'_'.$td->person_no.'.png';
                    }elseif (file_exists('assets/img/payment/PY_'.$td->pur_noku.'_'.$td->person_no.'.jpg')) {
                      $py_img = 'assets/img/payment/PY_'.$td->pur_noku.'_'.$td->person_no.'.jpg';
                    }elseif (file_exists('assets/img/payment/PY_'.$td->pur_noku.'_'.$td->person_no.'.jpeg')) {
                      $py_img = 'assets/img/payment/PY_'.$td->pur_noku.'_'.$td->person_no.'.jpeg';
                    }else{
                      $py_img = '';
                    }
                  $role = $this->session->userdata("role");
                  if($role == 1){
                ?>
                  <div class="row">
                    <div class="col-sm-12">
                      <p class="font-weight-bold">Bukti Supplier</p>
                    </div>
                    <div class="col-sm-6">
                      <?php
                        if ($pt_img <> '') {
                      ?>
                          <a href="<?php echo base_url($pt_img);?>" target="_blank">
                            <img src="<?php echo base_url($pt_img);?>" class="mx-auto d-block mb-1 img-dwd"/>
                          </a>
                          <a href="<?php echo base_url($pt_img);?>" type="button" class="btn btn-warning rounded mx-auto d-block mb-4" style="background-color: #006d3a;height: 40px;border-color: #006d3a;" download>Download Nota Putih</a>
                      <?php
                        }else{
                      ?>
                          <a href="#">
                            <img src="<?php echo base_url('assets/img/no-img.png')?>" class="mx-auto d-block mb-1 img-dwd"/>
                          </a>
                          <a href="#" type="button" class="btn btn-warning rounded mx-auto d-block mb-4" style="background-color: #006d3a;height: 40px;border-color: #006d3a;">Download Nota Putih</a>
                      <?php
                        }
                      ?>
                      
                    </div>
                    <div class="col-sm-6">
                      <?php
                        if ($pj_img <> '') {
                      ?>
                        <a href="<?php echo base_url($pj_img);?>" target="_blank">
                          <img src="<?php echo base_url($pj_img);?>" class="mx-auto d-block mb-1 img-dwd"/>
                        </a>
                        <a href="<?php echo base_url($pj_img);?>" type="button" class="btn btn-warning rounded mx-auto d-block mb-4" style="background-color: #006d3a;height: 40px;border-color: #006d3a;" download>Download Nota Pajak</a>
                      <?php
                        }else{
                      ?>
                          <a href="#">
                            <img src="<?php echo base_url('assets/img/no-img.png')?>" class="mx-auto d-block mb-1 img-dwd"/>
                          </a>
                          <a href="#" type="button" class="btn btn-warning rounded mx-auto d-block mb-4" style="background-color: #006d3a;height: 40px;border-color: #006d3a;">Download Nota Pajak</a>
                      <?php
                        }
                      ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <form action="<?php echo base_url('transaction/uploadCus');?>" enctype="multipart/form-data" method="POST">
                        <p class="font-weight-bold">Tanda Terima</p>
                        <?php
                          if ($rf_img <> '') {
                        ?>
                          <img id="img-preview1" src="<?php echo base_url($rf_img);?>" class="mx-auto d-block mb-1"/>
                        <?php
                          }else{
                        ?>
                            <img id="img-preview1" src="<?php echo base_url('assets/img/no-img.png')?>" class="mx-auto d-block mb-1"/>
                        <?php
                          }
                        ?>
                        <div class="form-group mb-1">
                          <div class="custom-file">
                            <input type="file" name="img-receive" class="custom-file-input" id="customFile" accept="image/*" onchange="readURL1(this)" />
                            <label class="custom-file-label" for="customFile">Pilih File</label>
                          </div>
                          <p class="fst-italic text-danger mb-0" style="font-size: 12px;">*Maksimal Upload 5MB</p>
                        </div>
                        
                              <input type="text" name="pur_noku" value="<?php echo $td->pur_noku; ?>" hidden>
                              <input type="text" name="person_no" value="<?php echo $td->person_no; ?>" hidden>
                              <input type="text" name="inv_no" value="<?php echo $td->person_no; ?>" hidden>
                        <div class="form-group">
                          <button type="submit" name="receive" class="btn btn-warning mx-auto btn-block">Upload Tanda Terima</button>
                        </div>
                      </form>
                    </div>
                    <div class="col-sm-6">
                      <form action="<?php echo base_url('transaction/uploadCus');?>" enctype="multipart/form-data" method="POST">
                        <p class="font-weight-bold">Bukti Pembayaran</p>
                        <?php
                          if ($py_img <> '') {
                        ?>
                          <img id="img-preview2" src="<?php echo base_url($py_img);?>" class="mx-auto d-block mb-1"/>
                        <?php
                          }else{
                        ?>
                            <img id="img-preview2" src="<?php echo base_url('assets/img/no-img.png')?>" class="mx-auto d-block mb-1"/>
                        <?php
                          }
                        ?>
                        <div class="form-group mb-1">
                          <div class="custom-file">
                            <input type="file" name="img-pay" class="custom-file-input" id="customFile" accept="image/*" onchange="readURL2(this)" />
                            <label class="custom-file-label" for="customFile">Pilih File</label>
                          </div>
                          <p class="fst-italic text-danger mb-0" style="font-size: 12px;">*Maksimal Upload 5MB</p>
                        </div>
                              <input type="text" name="pur_noku" value="<?php echo $td->pur_noku; ?>" hidden>
                              <input type="text" name="person_no" value="<?php echo $td->person_no; ?>" hidden>
                              <input type="text" name="inv_no" value="<?php echo $td->pur_inv; ?>" hidden>
                        <div class="form-group">
                          <button type="submit" name="payment" class="btn btn-warning mx-auto btn-block">Upload Bukti Pembayaran</button>
                        </div>
                      </form>
                    </div>
                  </div>
                  
                  <?php
                  }else{
                  ?>
                  <div class="row">
                    <div class="col-sm-6">
                      <form action="<?php echo base_url('transaction/uploadSup');?>" enctype="multipart/form-data" method="POST">
                        <p class="font-weight-bold">Nota Putih</p>
                        <?php
                          if ($pt_img <> '') {
                        ?>
                          <img id="img-preview1" src="<?php echo base_url($pt_img);?>" class="mx-auto d-block mb-1"/>
                        <?php
                          }else{
                        ?>
                            <img id="img-preview1" src="<?php echo base_url('assets/img/no-img.png')?>" class="mx-auto d-block mb-1"/>
                        <?php
                          }
                        ?>
                        <div class="form-group mb-1">
                          <div class="custom-file">
                            <input type="file" name="img-putih" class="custom-file-input" id="customFile" accept="image/*" onchange="readURL1(this)" />
                            <label class="custom-file-label" for="customFile">Pilih File</label>
                          </div>
                          <p class="fst-italic text-danger mb-0" style="font-size: 12px;">*Maksimal Upload 5MB</p>
                        </div>
                              <input type="text" name="pur_noku" value="<?php echo $td->pur_noku; ?>" hidden>
                              <input type="text" name="person_no" value="<?php echo $td->person_no; ?>" hidden>
                         <div class="form-group">
                          <button type="submit" name="putih" class="btn btn-warning mx-auto btn-block">Upload Nota Putih</button>
                        </div>
                      </form>
                    </div>
                    <div class="col-sm-6">
                      <form action="<?php echo base_url('transaction/uploadSup');?>" enctype="multipart/form-data" method="POST">
                        <p class="font-weight-bold">Nota Pajak</p>
                        <?php
                          if ($pj_img <> '') {
                        ?>
                          <img id="img-preview2" src="<?php echo base_url($pj_img);?>" class="mx-auto d-block mb-1"/>
                        <?php
                          }else{
                        ?>
                            <img id="img-preview2" src="<?php echo base_url('assets/img/no-img.png')?>" class="mx-auto d-block mb-1"/>
                        <?php
                          }
                        ?>
                        <div class="form-group mb-1">
                          <div class="custom-file">
                            <input type="file" name="img-pajak" class="custom-file-input" id="customFile" accept="image/*" onchange="readURL2(this)" />
                            <label class="custom-file-label" for="customFile">Pilih File</label>
                          </div>
                          <p class="fst-italic text-danger mb-0" style="font-size: 12px;">*Maksimal Upload 5MB</p>
                        </div>
                              <input type="text" name="pur_noku" value="<?php echo $td->pur_noku; ?>" hidden>
                              <input type="text" name="person_no" value="<?php echo $td->person_no; ?>" hidden>
                         <div class="form-group">
                          <button type="submit" name="pajak" class="btn btn-warning mx-auto btn-block">Upload Nota Pajak</button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <p class="font-weight-bold">Bukti Customer</p>
                    </div>
                    <div class="col-sm-6">
                      <?php
                        if ($rf_img <> '') {
                      ?>
                        <a href="<?php echo base_url($rf_img);?>" target="_blank">
                          <img src="<?php echo base_url($rf_img);?>" class="mx-auto d-block mb-1 img-dwd"/>
                        </a>
                        <a href="<?php echo base_url($rf_img);?>" type="button" class="btn btn-warning rounded mx-auto d-block" style="background-color: #006d3a;height: 40px;border-color: #006d3a;" download>Download Tanda Terima</a>
                      <?php
                        }else{
                      ?>
                          <a href="#">
                            <img src="<?php echo base_url('assets/img/no-img.png')?>" class="mx-auto d-block mb-1 img-dwd"/>
                          </a>
                          <a href="#" type="button" class="btn btn-warning rounded mx-auto d-block" style="background-color: #006d3a;height: 40px;border-color: #006d3a;">Download Tanda Terima</a>
                      <?php
                        }
                      ?>
                      
                    </div>
                    <div class="col-sm-6">
                      <?php
                        if ($py_img <> '') {
                      ?>
                        <a href="<?php echo base_url($py_img);?>" target="_blank">
                          <img src="<?php echo base_url($py_img);?>" class="mx-auto d-block mb-1 img-dwd"/>
                        </a>
                        <a href="<?php echo base_url($py_img);?>" type="button" class="btn btn-warning rounded mx-auto d-block" style="background-color: #006d3a;height: 40px;border-color: #006d3a;" download>Download Bukti Pembayaran</a>
                      <?php
                        }else{
                      ?>
                          <a href="#">
                            <img src="<?php echo base_url('assets/img/no-img.png')?>" class="mx-auto d-block mb-1 img-dwd"/>
                          </a>
                          <a href="#" type="button" class="btn btn-warning rounded mx-auto d-block" style="background-color: #006d3a;height: 40px;border-color: #006d3a;">Download Bukti Pembayaran</a>
                      <?php
                        }
                      ?>
                      
                    </div>
                  </div>
                  <?php
                  }
                  ?>
                </div>
                <?php
                            }
                          }
                        ?>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tutup</button>
                </div>
              </div>
            </div>
          </div>
          <!--Modal-->
          <!--Modal upload bukti-->
          <div class="modal fade" id="modalUploadBukti" tabindex="-1" role="dialog"
            aria-labelledby="modalUploadBuktiTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <div class="modal-title font-weight-bold align-self-center" id="modalUploadBuktiTitle">
                    Upload Bukti
                  </div>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                   <form action="#" enctype="multipart/form-data" method="POST">
                    <img id="img-preview1" src="<?php echo base_url('assets/img/no-img.png')?>" width="250px" class="mx-auto d-block mb-3"/>
                    <div class="form-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" accept="image/*" onchange="readURL1(this)" />
                        <label class="custom-file-label" for="customFile">Pilih File</label>
                      </div>
                      <p class="fst-italic text-danger" style="font-size: 12px;">*Maksimal Upload 5MB</p>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-outline-success">Kirim</button>
                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                </div>
              </div>
            </div>
          </div>
          <!--Modal-->
           <!--mODAL pembayaran-->
          <div class="modal fade" id="modalPembayaran" tabindex="-1" role="dialog"
            aria-labelledby="modalPembayaranJudul" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <div class="modal-title font-weight-bold align-self-center" id="modalPembayaranJudul">
                    Upload Pembayaran
                  </div>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                   <form action="#" enctype="multipart/form-data" method="POST" id="form2">
                      <img id="img-preview2" src="<?php echo base_url('assets/img/no-img.png')?>" width="250px" class="mx-auto d-block mb-3"/>
                    <div class="form-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" accept="image/*" onchange="readURL2(this)" />
                        <label class="custom-file-label" for="customFile">Pilih File</label>
                      </div>
                      <p class="fst-italic text-danger" style="font-size: 12px;">*Maksimal Upload 5MB</p>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-outline-success">Kirim</button>
                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                </div>
              </div>
            </div>
          </div>
          <!--mODAL-->
           <!--mODAL nota putih-->
          <div class="modal fade" id="modalNotaPutih" tabindex="-1" role="dialog"
            aria-labelledby="modalNotaPutihJudul" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <div class="modal-title font-weight-bold align-self-center" id="Judul">
                    Upload Nota Putih
                  </div>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                   <form action="#" enctype="multipart/form-data" method="POST">
                    <img id="img-preview3" src="<?php echo base_url('assets/img/no-img.png')?>" width="250px" class="mx-auto d-block mb-3"/>
                    <div class="form-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" accept="image/*" onchange="readURL3(this)" />
                        <label class="custom-file-label" for="customFile">Pilih File</label>
                      </div>
                      <p class="fst-italic text-danger" style="font-size: 12px;">*Maksimal Upload 5MB</p>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-outline-success">Kirim</button>
                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                </div>
              </div>
            </div>
          </div>
          <!--mODAL-->
          <!--Modal Database Configuration-->
          <div class="modal fade" id="modalDbConf" tabindex="-1" role="dialog"
            aria-labelledby="modalDbConfTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <div class="modal-title font-weight-bold align-self-center" id="modalDbConfTitle">
                    Database Configuration
                  </div>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="<?php echo base_url('overview/write_config');?>" method="POST">
                <div class="modal-body">
                    <div class="form-group row">
                      <div class="col-sm-8">
                        <label class="form-label lbl-grp">Hostname</label>
                        <input class="form-control" type="text" placeholder="Hostname" name="hostname" required>
                      </div>
                      <div class="col-sm-4">
                        <label class="form-label lbl-grp">Port</label>
                        <input class="form-control" type="text" placeholder="Port" name="port" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="form-label lbl-grp">Username</label>
                      <input class="form-control" type="text" placeholder="Username" name="username" required>
                    </div>
                    <div class="form-group">
                      <label class="form-label lbl-grp">Password</label>
                      <input class="form-control" type="password" placeholder="Password" name="password" required>
                    </div>
                    <div class="form-group">
                      <label class="form-label lbl-grp">Database</label>
                      <input class="form-control" type="text" placeholder="Database" name="database" required>
                    </div>
                </div>
                <div class="modal-footer">
                  <!-- <p class="font-italic mr-auto text-danger" style="font-size: 12px;"> *Harap lakukan test dahulu sebelum menambahkan!</p> -->
                  <!-- <button type="submit" name="btn-md" value="test" class="btn btn-outline-warning">Test</button> -->
                  <button type="submit" name="btn-md" value="send" class="btn btn-outline-success">Tambah</button>
                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                </div>
                </form>
              </div>
            </div>
          </div>
          <!--Modal-->
<?php
  if( !empty($json_arr) ) {
    foreach($json_arr['database'] as $key=>$value) { 
?>
          <!--Modal Database Edit-->
          <div class="modal fade" id="modalDbEdit<?php echo $value['db'];?>" tabindex="-1" role="dialog"
            aria-labelledby="modalDbEditTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <div class="modal-title font-weight-bold align-self-center" id="modalDbEditTitle">
                    Database Edit
                  </div>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="<?php echo base_url('setting/db_update/');?>" method="POST">
                <div class="modal-body">
                    <div class="form-group row">
                      <?php
                        foreach ($value['setting'] as $val) {
                      ?>
                      <div class="col-sm-8">
                        <label class="form-label lbl-grp">Hostname</label>
                        <input class="form-control" type="text" placeholder="Hostname" name="hostname" value="<?php echo $val['host'];?>" required>
                      </div>
                      <div class="col-sm-4">
                        <label class="form-label lbl-grp">Port</label>
                        <input class="form-control" type="text" placeholder="Port" name="port" value="<?php echo $val['port'];?>" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="form-label lbl-grp">Username</label>
                      <input class="form-control" type="text" placeholder="Username" name="username" value="<?php echo $val['username'];?>" required>
                    </div>
                    <div class="form-group">
                      <label class="form-label lbl-grp">Password</label>
                      <input class="form-control" type="password" placeholder="Password" name="password" value="<?php echo $val['password'];?>" required>
                    </div>
                    <?php
                      }
                    ?>
                    <div class="form-group">
                      <label class="form-label lbl-grp">Database</label>
                      <input class="db_name form-control" type="text" id="db_name" placeholder="Database" name="database" value="<?php echo $value['db'];?>" required readonly="true">
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" name="btn-md" class="btn btn-outline-warning">Perbarui</button>
                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                </div>
                </form>
              </div>
            </div>
          </div>
          <!--Modal-->
           <!--Modal Db Delete-->
        <div class="modal fade" id="modalDbDel<?php echo $value['db'];?>" tabindex="-1" role="dialog" aria-labelledby="modalDbDelTitle"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalDbDelTitle">Peringatan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="<?php echo base_url('setting/db_delete');?>" method="POST">
                <div class="modal-body">
                    <p>Anda yakin akan menghapus Database <b><?php echo $value['db'];?></b>?</p>
                    <input type="hidden" name="database" value="<?php echo $value['db'];?>">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-danger">Ya</button>
                </div>
                </form>
              </div>
            </div>
          </div>
          <!--Modal-->
<?php
  }
}
?>