<!DOCTYPE html>
<html>
<head>
 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
 <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

 <link href="<?php echo base_url('assets/css/main.css')?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css')?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/css/ruang-admin.min.css')?>" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- <script src='<?php echo base_url();?>assets/js/jquery-3.2.1.min.js' type='text/javascript'></script> -->
  <!-- <script src='<?php echo base_url();?>assets/select2/dist/js/select2.min.js' type='text/javascript'></script> -->
  <!-- <link href='<?php echo base_url();?>assets/select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
  <script src='<?php echo base_url();?>assets/js/sorttable.js' type='text/javascript'></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>


  <style type="text/css">
    input.dtwd {
        position: relative;
        width: 150px; height: 20px;
        color: white;
    }

    input.dtwd:before {
        position: absolute;
        top: 3px; left: 3px;
        content: attr(data-date);
        display: inline-block;
        color: black;
    }

    input.dtwd::-webkit-datetime-edit, input::-webkit-inner-spin-button, input::-webkit-clear-button {
        display: none;
    }

    input.dtwd::-webkit-calendar-picker-indicator {
        position: absolute;
        top: 3px;
        right: 0;
        color: black;
        opacity: 1;
    }
   table{
    table-layout: fixed;
  }
    td, th{
      overflow: hidden;
      white-space: nowrap;
      -moz-text-overflow: ellipsis;        
         -ms-text-overflow: ellipsis;
          -o-text-overflow: ellipsis;
             text-overflow: ellipsis;
    }
  .tbl-rz {
                border-collapse: collapse;
            }
            .tbl-rz,
            .tbl-rz th,
            .tbl-rz td {
                border: 1px solid #ccc;
            }
            .tbl-rz th,
            .tbl-rz td {
                padding: 0.5rem;
            }
            .tbl-rz th {
                position: relative;
            }
            .resizer {
                position: absolute;
                top: 0;
                right: 0;
                width: 5px;
                cursor: col-resize;
                user-select: none;
            }
            .resizer:hover,
            .resizing {
                border-right: 2px solid blue;
            }

            .resizable {
                border: 1px solid gray;
                height: 100px;
                width: 100px;
                position: relative;
            }
  </style>
</head>
<body>
<form method="POST">
 <select id="supSr" name="provinsi">
  <option ></option>
  <option value="ACEH">ACEH</option>
  <option value="RIAU">RIAU</option>
  <option value="JAMBI">JAMBI</option>
  <option value="SUMATERA UTARA">SUMATERA UTARA</option>
  <option value="BENGKULU">BENGKULU</option>
  <option value="LAMPUNG">LAMPUNG</option>
  <option value="DKI JAKARTA">DKI JAKARTA</option>
  <option value="JAWA BARAT">JAWA BARAT</option>
  <option value="JAWA TENGAH">JAWA TENGAH</option>
  <option value="JAWA TIMUR">JAWA TIMUR</option>
 </select>
 <input type="date" data-date="" data-date-format="DD/MM/YYYY" class="dtwd" value="2020-08-29">
</form>
<div class="container">
  <h2>Resizable Columns</h2>
  <!-- <table class="table table-bordered" data-resizable-columns-id="demo-table-v2">
    <thead>
      <tr>
        <th data-resizable-column-id="nr">#</th>
        <th data-resizable-column-id="first_name">First Name</th>
        <th data-resizable-column-id="nickname">Nickname</th>
        <th data-resizable-column-id="last_name">Last Name</th>
        <th data-resizable-column-id="username" id="username-column">Username</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>Mark</td>
        <td>Dude Meister</td>
        <td>Otto</td>
        <td>@mdo</td>
      </tr>
      <tr>
        <td>2</td>
        <td>Jacob</td>
        <td>Barney von Matterhorn</td>
        <td>Thornton</td>
        <td>@fat</td>
      </tr>
      <tr>
        <td>3</td>
        <td colspan="2">Larry the Bird</td>
        <td>What</td>
        <td>@twitter</td>
      </tr>
    </tbody>
  </table> -->
  <table id="table-id" class="tbl-rz">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>First name</th>
                    <th>Last name</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Andrea</td>
                    <td>Ross</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Penelope</td>
                    <td>Mills</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Sarah</td>
                    <td>Grant</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Vanessa</td>
                    <td>Roberts</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Oliver</td>
                    <td>Alsop</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Jennifer</td>
                    <td>Forsyth</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Michelle</td>
                    <td>King</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Steven</td>
                    <td>Kelly</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Julian</td>
                    <td>Ferguson</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Chloe</td>
                    <td>Ince</td>
                </tr>
            </tbody>
        </table>
  </div>

  <script src="//dobtco.github.io/jquery-resizable-columns/dist/jquery.resizableColumns.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/store.js/1.3.14/store.min.js"></script>

  <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url();?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/ruang-admin.min.js"></script>
  <!-- Page level plugins -->
  <script src="<?php echo base_url();?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url();?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script type="text/javascript">

 $(document).ready(function() {
     $('#supSr').select2();
 });
 $("input").on("change", function() {
        this.setAttribute(
            "data-date",
            moment(this.value, "YYYY-MM-DD")
            .format( this.getAttribute("data-date-format") )
        )
    }).trigger("change")
 $(function() {
  
  $("table").resizableColumns({
    store: window.store
  });
});
            document.addEventListener('DOMContentLoaded', function () {
                const createResizableTable = function (table) {
                    const cols = table.querySelectorAll('th');
                    [].forEach.call(cols, function (col) {
                        // Add a resizer element to the column
                        const resizer = document.createElement('div');
                        resizer.classList.add('resizer');

                        // Set the height
                        resizer.style.height = `${table.offsetHeight}px`;

                        col.appendChild(resizer);

                        createResizableColumn(col, resizer);
                    });
                };

                const createResizableColumn = function (col, resizer) {
                    let x = 0;
                    let w = 0;

                    const mouseDownHandler = function (e) {
                        x = e.clientX;

                        const styles = window.getComputedStyle(col);
                        w = parseInt(styles.width, 10);

                        document.addEventListener('mousemove', mouseMoveHandler);
                        document.addEventListener('mouseup', mouseUpHandler);

                        resizer.classList.add('resizing');
                    };

                    const mouseMoveHandler = function (e) {
                        const dx = e.clientX - x;
                        col.style.width = `${w + dx}px`;
                    };

                    const mouseUpHandler = function () {
                        resizer.classList.remove('resizing');
                        document.removeEventListener('mousemove', mouseMoveHandler);
                        document.removeEventListener('mouseup', mouseUpHandler);
                    };

                    resizer.addEventListener('mousedown', mouseDownHandler);
                };

                createResizableTable(document.getElementById('table-id'));
            });
        </script>
<!-- <script src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"></script> -->
  

</body>
</html>