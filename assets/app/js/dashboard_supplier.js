var Dashboard_supplier = (function() {

  var dashboardInit = function() {

    if(typeof localStorage != "undefined" ) {
      var sd = localStorage.getItem('suksesjayastartdate');
      
      if(sd !== null && sd !== "" ) {
        $('#startdate').datepicker('setDate', sd);
        // localStorage.setItem('suksesjayastartdate', "");
      }
    }

    var dtlength = localStorage.getItem("suksesjayalength");

    var saldo_akhir = 0;
    dtable = $('#tbl-list').DataTable({
      dom:"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12 col-md-12 text-right'B>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
      buttons:["excelHtml5","csvHtml5","pdfHtml5"],
      responsive: true,
      bSort: false,
      searchDelay: 500,
      processing: true,
      serverSide: true,
      pageLength: (dtlength !== null && dtlength !== "" ) ? dtlength : 10,
      pagingType: 'full_numbers',
      ajax: {
        url: site_url + 'supplier/datatable_list_hutang',
        type: 'POST',
        data: function(d) {
          d.startdate = $('#startdate').val();
          d.enddate = $('#enddate').val();
          d.filtersaldo = $('#filtersaldo').val();
          d.filterfp = $('#filterfp').val();
        }
      },
      columns: [
        {data: 'pur_inv', sClass:'nowrap'},
        {data: 'pur_date'},
        {data: 'no_faktur_pajak'},
        {data: 'pur_total', sClass: 'text-right'},
        {data: 'total_retur', sClass: 'text-right'},
        {data: 'saldo_bayar', sClass: 'text-right'},
        {data: 'sisa', sClass: 'text-right'},
        // {data: 'terima_fp'},
        {data: 'pur_ket'},
        {data: 'aksi'}
      ],
      drawCallback: function(obj) {
        var api = this.api();

        var intVal = function ( i ) {
          return typeof i === 'string' ?
              i.replace(/[\$,]/g, '')*1 :
              typeof i === 'number' ?
                  i : 0;
        };

        total = api
          .column( 3, { page: 'current'} )
          .data()
          .reduce( function (a, b) {            
            return intVal(a) + intVal(b);
          }, 0 );

        retur = api
          .column( 4, { page: 'current'} )
          .data()
          .reduce( function (a, b) {
            return intVal(a) + intVal(b);
          }, 0 );

        bayar = api
          .column( 5, { page: 'current'} )
          .data()
          .reduce( function (a, b) {
            return intVal(a) + intVal(b);
          }, 0 );
        
        sisa = api
          .column( 6, { page: 'current'} )
          .data()
          .reduce( function (a, b) {
            return intVal(a) + intVal(b);
          }, 0 );

        $( api.column( 3 ).footer() ).html(total.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
        $( api.column( 4 ).footer() ).html(retur.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
        $( api.column( 5 ).footer() ).html(bayar.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
        $( api.column( 6 ).footer() ).html(sisa.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
      }
    });

    $('.btn-generate-data').click(function (e) {
        e.preventDefault();
        dtable.ajax.reload();
    });

    $('.btn-download-data').click(function(e){
      e.preventDefault();
      var url = site_url + "supplier/downloadfile";
      window.location.href = url;
    })

    $('#tbl-list tbody').on('click', '.btn-small-view', function(e){
      e.preventDefault();
      location.href = site_url + "supplier/invoice/" + $(this).data('purno');
    });

    $('#startdate').on('changeDate', function(){
      var val = $(this).val();
      localStorage.setItem("suksesjayastartdate", val);
    });

    $('select[name=tbl-list_length]', '#tbl-list_wrapper').on('change', function(){
      // console.log("CHANGE", $(this).val());
      var val = $(this).val();
      localStorage.setItem("suksesjayalength", val);
    });
    //localStorage.setItem('eanotif-notification', data.success+';'+data.action+';'+data.trans_no+';'+data.trans_code);
  }

  var tgl_datepicker = function () {
    $('.tgl_datepicker').datepicker({
      todayHighlight: !0,
      autoclose: true,
      orientation: "bottom left",
      templates: {
        leftArrow: '<i class="la la-angle-left"></i>',
        rightArrow: '<i class="la la-angle-right"></i>'
      }
    });
  }

  return {
    init: function() {
      tgl_datepicker();
      dashboardInit();

      $('#filtersaldo').select2();
      $('#filterfp').select2();

    },
    initInvoice: function() {
      $('#tbl-list').on('click', '.btn-small-nota', function(e){
        e.preventDefault();
        location.href = site_url + "supplier/notainvoice/" + $(this).data('payno');
      });
      $('.btn-kembali').click(function(e){
        e.preventDefault();
        location.href = site_url + "dashboard";
      });
    },
    initNotaInvoice: function() {
      document.addEventListener('contextmenu', function(e) {
         e.preventDefault();
      });

      $('.btn-print').click(function(e){
        e.preventDefault();
        $('.print-area').printArea();
      });

      $('.btn-kembali').click(function(e){
        e.preventDefault();
        window.history.back();
      });
    }
  };
})();

//== Class initialization on page load
// jQuery(document).ready(function() {
//   Dashboard.init();
// });
