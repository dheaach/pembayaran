<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- <script src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"></script> -->
  <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url();?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/ruang-admin.min.js"></script>
  <!-- Page level plugins -->
  <script src="<?php echo base_url();?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url();?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script src="https://www.gstatic.com/firebasejs/7.7.0/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.7.0/firebase-storage.js"></script>
  
  <script type="text/javascript">
    $(document).ready(function () {
      const ele = document.getElementById("bt-dt-pjk");

      if(ele){
       ele.addEventListener("click", upload_datapajak);
      }

      function upload_datapajak() {
        const ifp = 1;
        const nfp = document.getElementById("inputnofp").value;
        const tfp = document.getElementById("inputglfp").value;
        const np = document.getElementById("inputpur_no").value;
        const fnm = document.getElementById("inputfnm").value

        if(nfp != '' && tfp != ''){
          $.ajax({
            url:'<?php echo base_url(); ?>transaction/sendPajak/',
            method: 'POST',
            data: {
                    is_fp : ifp,
                    no_fp : nfp,
                    tgl_fp : tfp,
                    no_pr : np
                  },
            success: function(msg){
              upload_pajak(fnm);
            },
            error: function(xhr, status, error){
              $('#d-alert').html('<div class="alert alert-danger border border-danger" role="alert" id="failed-alert"><button type="button" class="close" data-dismiss="alert">x</button><span class="nt-gl">Gagal menambahkan Data Faktur Pajak!</span></div>');
              $("#failed-alert").fadeTo(2000, 500).slideUp(500, function() {
                    $("#failed-alert").slideUp(500);
                  });
            }
          });
        }else{
          $('#d-alert').html('<div class="alert alert-danger border border-danger" role="alert" id="failed-alert"><button type="button" class="close" data-dismiss="alert">x</button><span class="nt-gl">Harap isi data dengan benar!</span></div>');
          $("#failed-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#failed-alert").slideUp(500);
          });
        }
         
      }
      function load_unseen_notification(view = ''){
       $.ajax({
          url:'<?php echo base_url(); ?>transaction/fetch/',
          method:"POST",
          data:{view:view},
          dataType:"json",
          success:function(data){
            $('.d-menu').html(data.notification);
            if(data.unseen_notification > 0){
              $('.cnt').html(data.unseen_notification);
            }
          }
        });
      }

      load_unseen_notification();

      // $(document).on('click', '#alertsDropdown', function(){
      //   $('.cnt').html('');
      //   load_unseen_notification('yes');
      // });
      
      setInterval(function(){
        load_unseen_notification();
      }, 5000);
    });
    

    var firebaseConfig = {
      apiKey: "AIzaSyBd7shh6SI67rlpyv68Kc-_XNmCBX6g7ss",
      authDomain: "sukses-jaya-uat.firebaseapp.com",
      databaseURL : "https://sukses-jaya-uat-default-rtdb.asia-southeast1.firebasedatabase.app",
      projectId: "sukses-jaya-uat",
      storageBucket: "sukses-jaya-uat.appspot.com",
      messagingSenderId: "935143600299",
      appId: "1:935143600299:web:8fd3faa8bb1659b2f247ee",
      measurementId: "G-43SCC53Q3W"
    };

    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    console.log(firebase);

    function upload_receive(filename) {
      var is_img = 1;
      var img = document.getElementById("img-none1");

      if(img){
          var is_img = 0;
      }

      if(is_img != 0){
        const ref = firebase.storage().ref();
        const file = document.querySelector("#img-rc").files[0];
        const fnm = file.name;
        const sz = file.size;
        const ft = fnm.split('.').pop();
        const name = filename+'.'+ft;
        const metadata = {
          contentType: file.type
        };

        if(sz <= 1097152){ 
          const task = ref.child('receive_faktur/' +name).put(file, metadata);
          task
            .then(snapshot => snapshot.ref.getDownloadURL())
            .then(url => {
              console.log(url);
              if(ft != 'pdf'){
                document.querySelector("#img-preview1").src = url;
              }else if (ft == 'pdf'){
                document.querySelector("#pdf-preview1").data = url;
              }
              
              sendImg(name, url, sz);
            })
            .catch(console.error);
        }else{
          $('#d-alert').html('<div class="alert alert-danger border border-danger" role="alert" id="failed-alert"><button type="button" class="close" data-dismiss="alert">x</button><span class="nt-gl">Gambar gagal diupload! Ukuran terlalu besar!</span></div>');
           $("#failed-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#failed-alert").slideUp(500);
          });
        }  
      }else{
        $('#d-alert').html('<div class="alert alert-danger border border-danger" role="alert" id="failed-alert"><button type="button" class="close" data-dismiss="alert">x</button><span class="nt-gl">Harap pilih gambar terlebih dahulu!</span></div>');
        $("#failed-alert").fadeTo(2000, 500).slideUp(500, function() {
          $("#failed-alert").slideUp(500);
        });
      }
      
        load_unseen_notification();
    }
    function upload_payment(filename) {
      var is_img = 1;
      var img = document.getElementById("img-none2");

      if(img){
          var is_img = 0;
      }

      if(is_img != 0){
        const ref = firebase.storage().ref();
        const file = document.querySelector("#img-py").files[0];
        const fnm = file.name;
        const sz = file.size;
        const ft = fnm.split('.').pop();
        const name = filename+'.'+ft;
        const metadata = {
          contentType: file.type
        };

        if(sz <= 1097152){ 
          const task = ref.child('payment/' +name).put(file, metadata);
          task
            .then(snapshot => snapshot.ref.getDownloadURL())
            .then(url => {
              console.log(url);
              if(ft != 'pdf'){
                document.querySelector("#img-preview2").src = url;
              }else if (ft == 'pdf'){
                document.querySelector("#pdf-preview2").data = url;
              }
              sendImg(name, url, sz);
            })
            .catch(console.error);
        }else{
          $('#d-alert').html('<div class="alert alert-danger border border-danger" role="alert" id="failed-alert"><button type="button" class="close" data-dismiss="alert">x</button><span class="nt-gl">Gambar gagal diupload! Ukuran terlalu besar!</span></div>');
           $("#failed-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#failed-alert").slideUp(500);
          });
        }    
      }else{
        $('#d-alert').html('<div class="alert alert-danger border border-danger" role="alert" id="failed-alert"><button type="button" class="close" data-dismiss="alert">x</button><span class="nt-gl">Harap pilih gambar terlebih dahulu!</span></div>');
        $("#failed-alert").fadeTo(2000, 500).slideUp(500, function() {
          $("#failed-alert").slideUp(500);
        });
      }
        load_unseen_notification();
    }
    function upload_nputih(filename) {
      var is_img = 1;
      var img = document.getElementById("img-none3");

      if(img){
          var is_img = 0;
      }

      if(is_img != 0){
        const ref = firebase.storage().ref();
        const file = document.querySelector("#img-np").files[0];
        const fnm = file.name;
        const sz = file.size;
        const ft = fnm.split('.').pop();
        const name = filename+'.'+ft;
        const metadata = {
          contentType: file.type
        };

        if(sz <= 1097152){
          const task = ref.child('nota_putih/' +name).put(file, metadata);
          task
            .then(snapshot => snapshot.ref.getDownloadURL())
            .then(url => {
              console.log(url);
              if(ft != 'pdf'){
                document.querySelector("#img-preview3").src = url;
              }else if (ft == 'pdf'){
                document.querySelector("#pdf-preview3").data = url;
              }
              sendImg(name, url, sz);
            })
            .catch(console.error);
        }else{
          $('#d-alert').html('<div class="alert alert-danger border border-danger" role="alert" id="failed-alert"><button type="button" class="close" data-dismiss="alert">x</button><span class="nt-gl">Gambar gagal diupload! Ukuran terlalu besar!</span></div>');
           $("#failed-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#failed-alert").slideUp(500);
          });
        }
      }else{
        $('#d-alert').html('<div class="alert alert-danger border border-danger" role="alert" id="failed-alert"><button type="button" class="close" data-dismiss="alert">x</button><span class="nt-gl">Harap pilih gambar terlebih dahulu!</span></div>');
        $("#failed-alert").fadeTo(2000, 500).slideUp(500, function() {
          $("#failed-alert").slideUp(500);
        });
      }
        load_unseen_notification();
    }
    function upload_pajak(filename) {
      var is_img = 1;
      var img = document.getElementById("img-none4");

      if(img){
          var is_img = 0;
      }

      if(is_img != 0){
        const ref = firebase.storage().ref();
        const file = document.querySelector("#img-pj").files[0];
        const fnm = file.name;
        const sz = file.size;
        const ft = fnm.split('.').pop();
        const name = filename+'.'+ft;
        const metadata = {
          contentType: file.type
        };

        if(sz <= 1097152){
          const task = ref.child('nota_pajak/' +name).put(file, metadata);
          task
            .then(snapshot => snapshot.ref.getDownloadURL())
            .then(url => {
              console.log(url);
              if(ft != 'pdf'){
                document.querySelector("#img-preview4").src = url;
              }else if (ft == 'pdf'){
                document.querySelector("#pdf-preview4").data = url;
              }
              sendImg(name, url, sz);
            })
            .catch(console.error);
        }else{
          $('#d-alert').html('<div class="alert alert-danger border border-danger" role="alert" id="failed-alert"><button type="button" class="close" data-dismiss="alert">x</button><span class="nt-gl">Gambar gagal diupload! Ukuran terlalu besar!</span></div>');
           $("#failed-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#failed-alert").slideUp(500);
          });
        }  
      }else{
        $('#d-alert').html('<div class="alert alert-danger border border-danger" role="alert" id="failed-alert"><button type="button" class="close" data-dismiss="alert">x</button><span class="nt-gl">Harap pilih gambar terlebih dahulu!</span></div>');
        $("#failed-alert").fadeTo(2000, 500).slideUp(500, function() {
          $("#failed-alert").slideUp(500);
        });
      }
        load_unseen_notification();
    }

    function delete_img(imgurl) {
        const np = document.getElementById("inputpur_no").value;
        const ref = firebase.storage();
        const fileRef = ref.refFromURL(imgurl);
        
        // Delete the file using the delete() method
        fileRef.delete().then(function () {

         $.ajax({
          url:'<?php echo base_url(); ?>transaction/deleteImage/',
          method: 'POST',
          data: {
                  url : imgurl,
                  pur_no : np,
                  tp : 'all'
                },
          success: function(msg){
            $('#d-alert').html('<div class="alert alert-success border border-success" role="alert" id="success-alert"><button type="button" class="close" data-dismiss="alert">x</button><span class="nt-sc">Gambar berhasil dihapus</span></div>');
            $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
              $("#success-alert").slideUp(500);
            });

            location.reload();
          },
          error: function(xhr, status, error){
            $('#d-alert').html('<div class="alert alert-danger border border-danger" role="alert" id="failed-alert"><button type="button" class="close" data-dismiss="alert">x</button><span class="nt-gl">Gambar gagal dihapus</span></div>');
            $("#failed-alert").fadeTo(2000, 500).slideUp(500, function() {
                  $("#failed-alert").slideUp(500);
                });
          }
        }); 
         
        }).catch(function (error) {
          document.write();
        });
      
    }
    function delete_img_pj(imgurl) {
        const np = document.getElementById("inputpur_no").value;
        const ref = firebase.storage();
        const fileRef = ref.refFromURL(imgurl);
        // Delete the file using the delete() method
        fileRef.delete().then(function () {

         $.ajax({
          url:'<?php echo base_url(); ?>transaction/deleteImage/',
          method: 'POST',
          data: {
                  url : imgurl,
                  pur_no : np,
                  tp : 'pj'
                },
          success: function(msg){
            $('#d-alert').html('<div class="alert alert-success border border-success" role="alert" id="success-alert"><button type="button" class="close" data-dismiss="alert">x</button><span class="nt-sc">Gambar berhasil dihapus</span></div>');
            $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
              $("#success-alert").slideUp(500);
            });

            location.reload();
          },
          error: function(xhr, status, error){
            $('#d-alert').html('<div class="alert alert-danger border border-danger" role="alert" id="failed-alert"><button type="button" class="close" data-dismiss="alert">x</button><span class="nt-gl">Gambar gagal dihapus</span></div>');
            $("#failed-alert").fadeTo(2000, 500).slideUp(500, function() {
                  $("#failed-alert").slideUp(500);
                });
          }
        }); 
         
        }).catch(function (error) {
          document.write();
        });
      
    }

    // Load init
    init();
    // const analytics = getAnalytics(app);
    // var button = document.getElementsByTagName('img-receive');
    
    function sendImg(flnm,udw,sz) {
      
      if(sz <= 1097152){
        $.ajax({
          url:'<?php echo base_url(); ?>transaction/uploadImage/',
          method: 'POST',
          data: {
                  filename: flnm,
                  url : udw,
                  size : sz
                },
          success: function(msg){
            $('#d-alert').html('<div class="alert alert-success border border-success" role="alert" id="success-alert"><button type="button" class="close" data-dismiss="alert">x</button><span class="nt-sc">Gambar berhasil di-upload</span></div>');
            $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
              $("#success-alert").slideUp(500);
            });

            location.reload();
          },
          error: function(xhr, status, error){
            $('#d-alert').html('<div class="alert alert-danger border border-danger" role="alert" id="failed-alert"><button type="button" class="close" data-dismiss="alert">x</button><span class="nt-gl">Gambar gagal diupload</span></div>');
            $("#failed-alert").fadeTo(2000, 500).slideUp(500, function() {
              $("#failed-alert").slideUp(500);
            });
          }
        }); 
      }else{
        $('#d-alert').html('<div class="alert alert-danger border border-danger" role="alert" id="failed-alert"><button type="button" class="close" data-dismiss="alert">x</button><span class="nt-gl">Gambar gagal diupload! Ukuran terlalu besar!</span></div>');
        $("#failed-alert").fadeTo(2000, 500).slideUp(500, function() {
              $("#failed-alert").slideUp(500);
            });
      }
      
    }
      
  </script>
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
var ctx = document.getElementById("myChart");
                    var myLineChart = new Chart(ctx, {
                      type: 'line',
                      data: {
                        labels: [
                          <?php
                            if (count($chart)>0) {
                              foreach ($chart as $data) {
                                if($range == '2'){
                                  echo "'" .DateTime::createFromFormat('!m', $data->tgl)->format('F')."',";
                                }else{
                                  echo "'" .$data->tgl ."',";
                                }
                              }
                            }
                          ?>
                        ],
                        datasets: [{
                          label: "Jumlah Pembelian",
                          lineTension: 0.3,
                          borderColor: "rgba(78, 115, 223, 1)",
                          pointRadius: 3,
                          pointBackgroundColor: "rgba(78, 115, 223, 1)",
                          pointBorderColor: "rgba(78, 115, 223, 1)",
                          pointHoverRadius: 3,
                          pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                          pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                          pointHitRadius: 10,
                          pointBorderWidth: 2,
                          data: [
                            <?php
                              if (count($chart)>0) {
                                foreach ($chart as $data) {
                                  echo $data->pur_no . ", ";
                                }
                              }
                            ?>
                          ],
                        }],
                      }
                    });

  </script>
  <script>
    jQuery(document).ready(function($) {
      var alterClass = function() {
        var ww = document.body.clientWidth;
        if (ww < 600) {
          $('#lt-jt').removeClass('col-sm-3');
        } else if (ww >= 601) {
          $('#lt-jt').addClass('col-sm-3');
        };
      };
      $(window).resize(function(){
        alterClass();
      });
      //Fire it when the page first loads:
      alterClass();
    });
  </script>
  
  <script type="text/javascript">

    
    function myFunction() {
      var x = document.getElementById("myTopnav");
      if (x.className === "topnav") {
        x.className += " responsive";
      } else {
        x.className = "topnav";
      }
    }

  function downloadCSVFile(csv, filename) {
      var csv_file, download_link;

      csv_file = new Blob([csv], {type: "text/csv"});

      download_link = document.createElement("a");

      download_link.download = filename;

      download_link.href = window.URL.createObjectURL(csv_file);

      download_link.style.display = "none";

      document.body.appendChild(download_link);

      download_link.click();
  }

    const element = document.getElementById("btnprintPembelian");

    if(element){
     element.addEventListener("click", printcsv);
    }

   function printcsv() {
     var html = document.querySelector("table").outerHTML;
      htmlToCSV(html, "pembelian.csv");
   }

    function htmlToCSV(html, filename) {
      var data = [];
      var rows = document.querySelectorAll("table tr");
          
      for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");
            
         for (var j = 0; j < cols.length; j++) {
                row.push(cols[j].innerText);
                     }
                
        data.push(row.join(","));   
      }

      //to remove table heading
      //data.shift()

      downloadCSVFile(data.join("\n"), filename);
    }
    
    function filterSearch() {
      var input, filter, table, tr, td, cell, i, j;
      input = document.getElementById("txtSearch");
      filter = input.value.toUpperCase();
      table = document.getElementById("table-id");
      tr = table.getElementsByTagName("tr");
      for (i = 1; i < tr.length; i++) {
        // Hide the row initially.
        tr[i].style.display = "none";
      
        td = tr[i].getElementsByTagName("td");
        for (var j = 0; j < td.length; j++) {
          cell = tr[i].getElementsByTagName("td")[j];
          if (cell) {
            if (cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
              break;
            } 
          }
        }
      }
    }

              getPagination('#table-id');
          //getPagination('.table-class');
          //getPagination('table');

      /*          PAGINATION 
      - on change max rows select options fade out all rows gt option value mx = 5
      - append pagination list as per numbers of rows / max rows option (20row/5= 4pages )
      - each pagination li on click -> fade out all tr gt max rows * li num and (5*pagenum 2 = 10 rows)
      - fade out all tr lt max rows * li num - max rows ((5*pagenum 2 = 10) - 5)
      - fade in all tr between (maxRows*PageNum) and (maxRows*pageNum)- MaxRows 
      */
     

function getPagination(table) {
  var lastPage = 1;

  $('#maxRows')
    .on('change', function(evt) {
      //$('.paginationprev').html('');            // reset pagination

        lastPage = 1;
        $('.pagination')
          .find('li')
          .slice(1, -1)
          .remove();
        var trnum = 0; // reset tr counter
        var maxRows = parseInt($(this).val()); // get Max Rows from select option

        if (maxRows == 5000) {
          $('.pagination').hide();
        } else {
          $('.pagination').show();
        }

        var totalRows = $(table + ' tbody tr').length; // numbers of rows
        $(table + ' tr:gt(0)').each(function() {
          // each TR in  table and not the header
          trnum++; // Start Counter
          if (trnum > maxRows) {
            // if tr number gt maxRows

            $(this).hide(); // fade it out
          }
          if (trnum <= maxRows) {
            $(this).show();
          } // else fade in Important in case if it ..
        }); //  was fade out to fade it in
        if (totalRows > maxRows) {
          // if tr total rows gt max rows option
          var pagenum = Math.ceil(totalRows / maxRows); // ceil total(rows/maxrows) to get ..
          //  numbers of pages
          for (var i = 1; i <= pagenum; ) {
            // for each page append pagination li
            $('.pagination #prev')
              .before(
                '<li  style="cursor: pointer; cursor: hand;" class="page-item" data-page="' +
                  i +
                  '">\
                    <span class="page-link">' +
                  i++ +
                  '<span class="sr-only">(current)</span></span>\
                  </li>'
              )
              .show();
          } // end for i
        } // end if row count > max rows
        $('.pagination [data-page="1"]').addClass('active'); // add active class to the first li
        $('.pagination li').on('click', function(evt) {
          // on click each page
          evt.stopImmediatePropagation();
          evt.preventDefault();
          var pageNum = $(this).attr('data-page'); // get it's number

          var maxRows = parseInt($('#maxRows').val()); // get Max Rows from select option

          if (pageNum == 'prev') {
            if (lastPage == 1) {
              return;
            }
            pageNum = --lastPage;
          }
          if (pageNum == 'next') {
            if (lastPage == $('.pagination li').length - 2) {
              return;
            }
            pageNum = ++lastPage;
          }

          lastPage = pageNum;
          var trIndex = 0; // reset tr counter
          $('.pagination li').removeClass('active'); // remove active class from all li
          $('.pagination [data-page="' + lastPage + '"]').addClass('active'); // add active class to the clicked
          // $(this).addClass('active');          // add active class to the clicked
        limitPagging();
          $(table + ' tr:gt(0)').each(function() {
            // each tr in table not the header
            trIndex++; // tr index counter
            // if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
            if (
              trIndex > maxRows * pageNum ||
              trIndex <= maxRows * pageNum - maxRows
            ) {
              $(this).hide();
            } else {
              $(this).show();
            } //else fade in
          }); // end of for each tr in table
        }); // end of on click pagination list
      limitPagging();
    })
    .val(5)
    .change();

  // end of on select change

  // END OF PAGINATION
}

function limitPagging(){
  // alert($('.pagination li').length)

  if($('.pagination li').length > 7 ){
      if( $('.pagination li.active').attr('data-page') <= 3 ){
      $('.pagination li:gt(5)').hide();
      $('.pagination li:lt(5)').show();
      $('.pagination [data-page="next"]').show();
    }if ($('.pagination li.active').attr('data-page') > 3){
      $('.pagination li:gt(0)').hide();
      $('.pagination [data-page="next"]').show();
      for( let i = ( parseInt($('.pagination li.active').attr('data-page'))  -2 )  ; i <= ( parseInt($('.pagination li.active').attr('data-page'))  + 2 ) ; i++ ){
        $('.pagination [data-page="'+i+'"]').show();

      }

    }
  }
}
  function mydate(){
  //alert("");
  document.getElementById("dt").hidden=false;
  document.getElementById("ndt").hidden=true;
  }
  function mydate1()
  {
   d=new Date(document.getElementById("dt").value);
  dt=d.getDate();
  mn=d.getMonth();
  mn++;
  yy=d.getFullYear();
  document.getElementById("ndt").value=dt+"/"+mn+"/"+yy
  document.getElementById("ndt").hidden=false;
  document.getElementById("dt").hidden=true;
}
 var table = document.getElementsByTagName('table')[0];
if(table){
   resizableGrid(table);
}

    function chkPwd()
        {
            // let Pswd is ID of password and cPswd is ID of confirm password text Box
            var newPwd = document.getElementById('inputPassword3').value;
            var cPwd = document.getElementById('inputKonfirmasi3').value;
            if(newPwd != cPwd)
            {
                document.getElementById('inputKonfirmasi3').focus();
                document.getElementById('inputKonfirmasi3').value="";
                document.getElementById('err').innerHTML="Passwords are Not Matching";
            }else{
              document.getElementById('err').innerHTML="";
            }
        }
        $("input").on("change", function() {
            this.setAttribute(
                "data-date",
                moment(this.value, "YYYY-MM-DD")
                .format( this.getAttribute("data-date-format") )
            )
        }).trigger("change");

        let noimage =
      "https://ami-sni.com/wp-content/themes/consultix/images/no-image-found-360x250.png";

    function readURL1(input) {
      var imn = document.getElementById("img-none1");
      if(imn){
        imn.style.display = "none";
      }
      console.log(input.files);
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        var fnm = input.files[0].type;
        if(fnm != 'application/pdf'){
          reader.onload = function (e) {
            $('#prv-1').html('<img id="img-preview1" src="<?php echo base_url('assets/img/no-img.png')?>" class="mx-auto d-block mb-3" />');
            $("#img-preview1").attr("src", e.target.result);
          };
        }else{
          reader.onload = function (e) {
            $('#prv-1').html('<object id="pdf-preview1" data="" type="application/pdf" class="mx-auto d-block mb-3 pdf-view" width="100%" height="100%"></object>');
            $("#pdf-preview1").attr("data", e.target.result);
          };
        }
        reader.readAsDataURL(input.files[0]);
      } else {
        $("#img-preview1").attr("src", noimage);
      }
    }
    function readURL2(input) {
      var imn = document.getElementById("img-none2");
      if(imn){
        imn.style.display = "none";
      }
      console.log(input.files);
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        var fnm = input.files[0].type;
        if(fnm != 'application/pdf'){
          reader.onload = function (e) {
            $('#prv-2').html('<img id="img-preview2" src="<?php echo base_url('assets/img/no-img.png')?>" class="mx-auto d-block mb-3" />');
            $("#img-preview2").attr("src", e.target.result);
          };
        }else{
          reader.onload = function (e) {
            $('#prv-2').html('<object id="pdf-preview2" data="" type="application/pdf" class="mx-auto d-block mb-3 pdf-view" width="100%" height="100%"></object>');
            $("#pdf-preview2").attr("data", e.target.result);
          };
        }
        reader.readAsDataURL(input.files[0]);
      } else {
        $("#img-preview2").attr("src", noimage);
      }
    }
    function readURL3(input) {
      var imn = document.getElementById("img-none3");
      if(imn){
        imn.style.display = "none";
      }
      console.log(input.files);
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        var fnm = input.files[0].type;
        if(fnm != 'application/pdf'){
          reader.onload = function (e) {
            $('#prv-3').html('<img id="img-preview3" src="<?php echo base_url('assets/img/no-img.png')?>" class="mx-auto d-block mb-3" />');
            $("#img-preview3").attr("src", e.target.result);
          };
        }else{
          reader.onload = function (e) {
            $('#prv-3').html('<object id="pdf-preview3" data="" type="application/pdf" class="mx-auto d-block mb-3 pdf-view" width="100%" height="100%"></object>');
            $("#pdf-preview3").attr("data", e.target.result);
          };
        }
        reader.readAsDataURL(input.files[0]);
      } else {
        $("#img-preview3").attr("src", noimage);
      }
    }
    function readURL4(input) {
      var imn = document.getElementById("img-none4");
      if(imn){
        imn.style.display = "none";
      }
      console.log(input.files);
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        var fnm = input.files[0].type;
        if(fnm != 'application/pdf'){
          reader.onload = function (e) {
            $('#prv-4').html('<img id="img-preview4" src="<?php echo base_url('assets/img/no-img.png')?>" class="mx-auto d-block mb-3" />');
            $("#img-preview4").attr("src", e.target.result);
          };
        }else{
          reader.onload = function (e) {
            $('#prv-4').html('<object id="pdf-preview4" data="" type="application/pdf" class="mx-auto d-block mb-3 pdf-view" width="100%" height="100%"></object>');
            $("#pdf-preview4").attr("data", e.target.result);
          };
        }
        reader.readAsDataURL(input.files[0]);
      } else {
        $("#img-preview4").attr("src", noimage);
      }
    }
  </script>

</body>
	<footer class="sticky-footer bg-white footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - developed by FHSoftware
            </span>
          </div>
        </div>
      </footer>
</html>