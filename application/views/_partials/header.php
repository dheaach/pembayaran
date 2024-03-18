 <!DOCTYPE html>
<html lang="en">
<?php
$role = $this->session->userdata("role");
        if($role == 1 ){
            $rl = " | Staff";
        }elseif ($role == 2) {
            $rl = " | Supplier";
        }else{
            $rl = "";
        }
?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <link href="<?php echo base_url('assets/img/logo/green.png')?>" rel="icon">
  <title>Sukses Jaya <?php echo $rl; ?></title>
  <link href="<?php echo base_url('assets/css/main.css')?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css')?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/css/ruang-admin.min.css')?>" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- <script src='<?php echo base_url();?>assets/js/jquery-3.2.1.min.js' type='text/javascript'></script> -->
  <!-- <script src='<?php echo base_url();?>assets/select2/dist/js/select2.min.js' type='text/javascript'></script> -->
  <!-- <link href='<?php echo base_url();?>assets/select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'> -->
  <!-- <link rel="stylesheet" href="<?php echo base_url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css')?>"> -->
  <!-- <link rel="stylesheet" href="<?php echo base_url();?>https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"> -->
  <!-- <script src="<?php echo base_url();?>https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script> -->
  <!-- <script src="<?php echo base_url();?>https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> -->
  <!-- <script src="<?php echo base_url();?>https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> -->

<!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> -->
  <!-- <script src="<?php echo base_url();?>https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script> -->
  <script src='<?php echo base_url();?>assets/js/sorttable.js' type='text/javascript'></script>
  <script src='<?php echo base_url();?>assets/js/resizeTable.js' type='text/javascript'></script>

 <!-- <script src="<?php echo base_url();?>https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script> -->

 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script> -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet"/>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
  <!-- <script src="https://www.gstatic.com/firebasejs/4.3.0/firebase-app.js"></script> -->
  <script type="text/javascript">
    function printExcel()
    {
        var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
        var textRange; var j=0;
        tab = document.getElementById('table-id'); // id of table

        for(j = 0 ; j < tab.rows.length ; j++) 
        {     
            tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
            //tab_text=tab_text+"</tr>";
        }

        tab_text=tab_text+"</table>";
        tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
        tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
        tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE "); 

        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
        {
            txtArea1.document.open("txt/html","replace");
            txtArea1.document.write(tab_text);
            txtArea1.document.close();
            txtArea1.focus(); 
            sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
        }  
        else                 //other browser not tested on IE 11
            sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

        return (sa);
    }
    
    // import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.9.2/firebase-analytics.js";
    
          
  </script>
  <style type="text/css">
    @media print {
    body * {
      visibility: hidden;
    }
    nav{
      display: none;
    }
    footer{
      display: none;
    }
    .dataTables_length{
      display: none;
    }
    .dataTables_filter{
      display: none;
    }
    .dataTables_info{
      display: none;
    }
    .dataTables_paginate{
      display: none;
    }
    .cd-none{
      display: none;
    }
    #printInvoice, #printInvoice * {
      visibility: visible;
    }
    #printInvoice {
      position: absolute;
      left: 0;
      top: 0;
    }
    #printPembelian, #printPembelian * {
      visibility: visible;
    }
    #printPembelian {
      position: absolute;
      left: 0;
      top: 0;
    }
  }

    @media only screen and (max-width: 991px) {
      .navbar-bottom{
        height: auto;
      }
      .nav-bottom{
        height:50px;
      }
      div.dataTables_wrapper div.dataTables_length select {
          width: 308px;
          display: inline-block;
          margin-left: 12px;
      }
      div.table-responsive>div.dataTables_wrapper>div.row>div[class^="col-"]:first-child {
          padding-left: 0;
          padding-right: 0;
      }
      div.dataTables_wrapper div.dataTables_filter input {
          margin-left: 0.5em;
          display: inline-block;
          width: 350px;
      }
      div.table-responsive>div.dataTables_wrapper>div.row>div[class^="col-"]:last-child {
          padding-right: 0;
          padding-left: 0;
      }
      .btn-grp{
        padding-left: 30px;
      }
      #img-preview3,#img-preview2, #img-preview1, #img-preview4{
        max-width: 400px!important;
      }
      .cd-chart{
        min-height: 160px;
      }
    }
    @media only screen and (min-width: 992px) {
      .cd-top-left{
        min-height: 396px;
      }
      .cd-top-right{
        min-height: 816px;
      }
      .cd-pr-lf{
        min-height: 599px;
      }
      .cd-pr-rg{
        min-height: 252px;
      }
      .lbl-grp{
        text-align: right;
      }
      div.dataTables_wrapper div.dataTables_filter input {
        width: 372px;
       }
      .lbl-grp{
        text-align: left;
      }
      .input-group-sm>.src-wd:not(textarea) {
        width: 227px;
      }
      .input-group-sm>.rw-wd:not(textarea) {
        width: 55px;
      }
      .input-group-sm>.dt-wd:not(textarea) {
        width: 160px;
      }
      .input-group-sm>.dt-nt:not(textarea) {
        width: 160px;
      }
      .input-group-sm>.sl-wd:not(textarea) {
        width: 210px;
      }
      .input-group-sm>.sl-sp:not(textarea) {
        width: 355px;
        height: 40px;
      }
      div.btn-gr{
        margin-top: 20px;
      }
      .input-group-sm>.btn-cp:not(textarea) {
        width: 76px;
      }
      .btn-grp{
        padding-left: 62px;
        padding-right: 0px;
      }
      .btn-gr{
        padding-right: 0px;
      }
      .src-tx{
        padding-right: 0px;
      }
      #img-preview3,#img-preview2, #img-preview1, #img-preview4{
        max-width: 600px!important;
      }
      .cd-ug {
       min-height: 1160px;
       max-height: 1250px;
      }
    }
    @media only screen and (min-width: 1343px) {
      .cd-chart{
        min-height: 800px;
      }
    }
    @media only screen and (min-width: 1440px)  {
      .cd-chart{
        min-height: 850px;
      }
    }
    @media only screen and (min-width: 1520px)  {
      .cd-chart{
        min-height: 900px;
      }
    }
    @media only screen and (min-width: 1620px)  {
      .cd-chart{
        min-height: 950px;
      }
    }
    @media only screen and (min-width: 1720px)  {
      .cd-chart{
        min-height: 1000px;
      }
    }
    @media only screen and (min-width: 1820px)  {
      .cd-chart{
        min-height: 1050px;
      }
    }
    @media only screen and (min-width: 1920px)  {
      .cd-chart{
        min-height: 1100px;
      }
    }
    @media only screen and (min-width: 2020px)  {
      .cd-chart{
        min-height: 1150px;
      }
    }
    .form-control::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: white;
            opacity: 1; /* Firefox */
    }

    .form-control:-ms-input-placeholder { /* Internet Explorer 10-11 */
                color: white;
    }

    .form-control::-ms-input-placeholder { /* Microsoft Edge */
                color: white;
     }
     #search-bar-border {
        opacity: .5;  
    }
    .hover-underline-animation {
      display: inline-block;
      position: relative;
      color: #006d3a;
    }

    .hover-underline-animation:after {
      content: '';
      position: absolute;
      width: 100%;
      transform: scaleX(0);
      height: 2px;
      bottom: 0;
      left: 0;
      background-color: #006d3a;
      transform-origin: bottom right;
      transition: transform 0.25s ease-out;
    }

    .hover-underline-animation:hover:after {
      transform: scaleX(1);
      transform-origin: bottom left;
    }
    .badge-status{
      width:  100px;
      height: 30px;
      text-align: center;
      vertical-align: middle;
      display: table-cell;
    }
    html, body {
       margin:0;
       padding:0;
       height:100%;
    }
    #wrapper {
      position:relative;
      min-height: 100%;
    }
    .page-item.active .page-link {
      z-index: 1;
      color: #fff;
      background-color: #006d3a;
      border-color: #006d3a;
    }
    .custom-file-input:lang(en)~.custom-file-label::after {
        content: "Browse";
        color: #fff;
        background-color: #006d3a;
        border-color: #006d3a;
    }
    .page-link {
      position: relative;
      display: block;
      padding: 0.5rem 0.75rem;
      margin-left: -1px;
      line-height: 1.25;
      color: #006d3a;
      background-color: #fff;
      border: 1px solid #dddfeb;
      -webkit-box-shadow: 0 .125rem .25rem 0 rgba(58,59,69,.2)!important;
      box-shadow: 0 .125rem .25rem 0 rgba(58,59,69,.2)!important;
    }
    .filter-src{
      margin: 4.5px;
    }
    .btn-ops{
      margin-bottom: 15px;
      margin-left: 5px;
      padding: 0px;
    }
    .alert-notif {
      width: 450px;
    }
    .db-notif {
      width: 180px;
    }
    .img-profile {
        border: 1px solid #fafafa;
    }
    .img-circle {
        border-radius: 50%!important;
    }
    a:hover {
        color: #006d3a;
        text-decoration: underline;
    }
    .dropdown-item:active {
        color: #fff;
        text-decoration: none;
        background-color: #006d3a;
    }
    div.dataTables_wrapper div.dataTables_filter input {
        border-color: #006d3a;
    }
    div.dataTables_wrapper div.dataTables_length select {
        border-color: #006d3a;
    }
    .frm-brd::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
      color: #c1c1c1;
      opacity: 1; /* Firefox */
    }

    .frm-brd:-ms-input-placeholder { /* Internet Explorer 10-11 */
      color: #c1c1c1;
    }

    .frm-brd::-ms-input-placeholder { /* Microsoft Edge */
      color: #c1c1c1;
    }
    .frm-brd{
      border-color: #c8d1cf;
    }
    .frm-brd:focus {
      border: 1px solid #006d3a;
    }
    h5{
        padding: 0px;
        margin: 0px;
    }
    .text-primary {
        color: #006d3a!important;
    }
    .btn-primary {
      color: #fff;
      background-color: #006d3a;
      border-color: #006d3a;
    }
    .bg-primary {
        background-color: #006d3a!important;
    }
    .btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle {
        color: #fff;
        background-color: #006d3a;
        border-color: #006d3a;
    }
    .btn-primary:hover {
        color: #fff;
        background-color: #006d3a;
        border-color: #006d3a;
    }
    .dropdown-item.active, .dropdown-item:active {
        color: #fff;
        text-decoration: none;
        background-color: #006d3a;
    }
    a.text-primary:hover {
        color: #006d3a!important;
    }
    dd{
      margin-bottom: 10px;
      margin-top: 10px;
    }
    dt{
      margin-bottom: 10px;
      margin-top: 10px;
    }
    .input-group-sm>.src-wd:not(textarea) {
        height: 40px;
    }
    .input-group-sm>.rw-wd:not(textarea) {
        height: 40px;
    }
    .input-group-sm>.dt-wd:not(textarea) {
        height: 40px;
    }
    .input-group-sm>.sl-wd:not(textarea) {
        height: 40px;
    }
    .input-group-sm>.btn-cp:not(textarea) {
        height: 40px;
        background-color: white;
    }  
    .card .table td, .card .table th {
        padding-right: 10px;
        padding-left: 10px;
        padding-top: 10px;
        padding-bottom: 10px;
    }
    .tfooter{
      display: contents!important;
    }
    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 40px;
        user-select: none;
        -webkit-user-select: none;
        padding-top: 6px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 26px;
        position: absolute;
        top: 1px;
        right: 1px;
        width: 20px;
        padding-top: 6px;
        margin-top: 6px;
    }
    .invalid {
      border: 2px solid rgb(153, 16, 16);
    }

    .invalid::placeholder {
      color: rgb(153, 16, 16);
    }

    .invalid-feedback:empty {
      display: none;
    }
    .invalid-feedback {
      font-size: 12px;
      color: rgb(153, 16, 16);
    }
    .invalid-feedback {
        display: unset;
    }
    .icon{
      width: 50px;
    }
    .text-sm{
      font-size:.8rem
    }
    .img-usaha {
      webkit-filter: blur(4px);
      filter: blur(4px);
      transition: 0.3s;
    }
    .img-usaha:hover {
      webkit-filter: blur(0px);
      filter: blur(0px);
    }
    
    .size-icon-setting{
      height: 34px;
      width: 30px;
    }
    .size-font-setting{
      font-size: 13px;
    }
    #wrapper #content-wrapper {
      background-color: #ffffff
    }
    .card {
      box-shadow: 0 0.10rem 0.60rem 0 rgba(58,59,69,.15)!important;
    }
    .topbar {
      box-shadow: 0 0.10rem 0.60rem 0 rgba(58,59,69,.15)!important;
    }

    input.dt-wd:before {
        position: absolute;
        top: 10px; 
        left: 15px;
        content: attr(data-date);
        display: inline-block;
        color: black;
    }

    input.dt-nt:before {
        position: absolute;
        top: 6px; 
        left: 15px;
        content: attr(data-date);
        display: inline-block;
        color: black;
    }

    input.dt-wd::-webkit-datetime-edit, input::-webkit-inner-spin-button, input::-webkit-clear-button {
        display: none;
    }

    input.dt-nt::-webkit-datetime-edit, input::-webkit-inner-spin-button, input::-webkit-clear-button {
        display: none;
    }

    input.dt-wd::-webkit-calendar-picker-indicator {
        position: absolute;
        top: 10px;
        right: 10px;
        color: black;
        opacity: 1;
    }

    input.dt-nt::-webkit-calendar-picker-indicator {
        position: absolute;
        top: 6px;
        right: 10px;
        color: black;
        opacity: 1;
    }

    #img-preview1, #img-preview2, #img-preview3, #img-preview4{
      max-height: 300px;
      max-width: 500px;
    }
    .img-dwd {
      max-height: 300px;
      max-width: 500px;
    }
    .select2-search__field:focus{
      outline: none!important;
    }
    .bt-upload:hover {
      color: #fff;
      background-color: #006d3a;
      border-color: #006d3a;
    }
    .bt-upload {
      color: #006d3a;
      border-color: #006d3a;
    }
    .bt-upload:not(:disabled):not(.disabled):active{
      color: #fff;
      background-color: #006d3a;
      border-color: #006d3a;
    }
    .table-hover tbody tr:hover {
      background-color: #D3F6E6;
    }
    .btn-dbplus:hover {
      color: #006d3a;
      background-color: #ffffff;
      border-color: #ffffff;
    }
    .btn-dbplus{
      color: #ffffff;
      border-color: #ffffff;
    }
    .btn-info{
      background-color: #004c6d;
      border-color: #004c6d;
    }
    .btn-info:hover{
      background-color: #004462;
      border-color: #004462;
    }
    .btn-warning{
      background-color: #b3731b;
      border-color: #b3731b;
    }
    .btn-warning:hover{
      background-color: #996217;
      border-color: #996217;
    }
    .btn-danger{
      background-color: #ca433c ;
      border-color: #ca433c ;
    }
    .btn-danger:hover{
      background-color: #b03b35;
      border-color: #b03b35;
    }
    .btn-success{
      background-color: #006d3a ;
      border-color: #006d3a ;
    }
    .btn-success:hover{
      background-color: #006234;
      border-color: #006234;
    }
    .btn-secondary{
      background-color: #4e4e4e ;
      border-color: #4e4e4e ;
    }
    .btn-secondary:hover{
      background-color: #444444;
      border-color: #444444;
    }
    .btn-info:not(:disabled):not(.disabled).active, .btn-info:not(:disabled):not(.disabled):active, .show>.btn-info.dropdown-toggle {
      color: #fff;
      background-color: #004c6d;
      border-color: #004c6d;
    }
    .alert-success{
      color: #00371d!important;
      background-color: #b3d3c4!important;
    }
    .border-success{
      border-color: #006d3a!important;
    }
    .alert-danger{
      color: #7e2a26!important;
      background-color: #feccc9!important;
    }
    .border-danger{
      border-color: #ca433c!important;
    }
    .badge-counter {
        position: relative;
        transform: scale(.8);
        transform-origin: top left;
        right: 0.5rem;
        margin-top: -0.25rem;
        bottom: 0.5rem;
    }
    .dropdown .dropdown-menu {
        max-width: 800px;
    }
    .text-success{
      color: black!important;
    }
    .notif:hover{
      filter: drop-shadow(0px 2px 9px black);
    }
    .text-green{
      color:#006d3a;
    }
    .btn-ovw{
      min-width: 103px;
    }
    .dvd-left {
      margin-left: 10px;
      border-left: 1.5px solid #004c29;
      height: 45px;
    }
    .txt-mn{
      font-size: 15px;
    }
    
    .cd-ug {
     margin-bottom: 10px;
    }
    .up-img{
      min-height: 402px;
    }
    a.disabled {
      pointer-events: none;
      cursor: default;
    }
    .pdf-view{
      height: 250px;
    }
    .frm-fn{
      width: 20px;
    }
  </style>
</head>
<body id="page-top">

