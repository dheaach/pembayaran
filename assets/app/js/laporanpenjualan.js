var LaporanPenjualan = function() {

    var dtable = "";
    var btnL = "";

    var initPenjualanRangkuman = function () {
        $('#filterjenis').select2();

        dtable = $('#tbl-list').DataTable({
            dom:"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12 col-md-12 text-right'B>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons:["excelHtml5","csvHtml5","pdfHtml5"],
            responsive: true,
            bSort: false,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            pageLength: 10,
            pagingType: 'full_numbers',
            ajax: {
                url: site_url + 'penjualan/datatable_rangkuman',
                type: 'POST',
                data: function(d) {
                    d.startdate = $('#startdate').val();
                    d.enddate = $('#enddate').val();
                    d.filtercustomer = $('#filtercustomer').val();
                    d.filterjenis = $('#filterjenis').val();
                }
            },
            columns: [
                {data: 'jual_date'},
                {data: 'jual_no'},
                {data: 'jual_reff'},
                {data: 'person_name'},
                {data: 'jual_sub_total_kurs', sClass: 'text-right'},
                {data: 'jual_disc0_rp_kurs', sClass: 'text-right'},
                {data: 'ongkir', sClass: 'text-right'},
                {data: 'jual_tax_rp', sClass: 'text-right'},
                {data: 'jual_total_kurs', sClass: 'text-right'}
            ],
            drawCallback: function(obj) {
                var api = this.api();

                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                subtotal = api
                    .column( 4, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                discount = api
                    .column( 5, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                ongkir = api
                    .column( 6, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                pajak = api
                    .column( 7, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                gtotal = api
                    .column( 8, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // $( api.column( 5 ).footer() ).html(tambah).priceFormat({clearPrefix: true, centsLimit: 0});
                $( api.column( 4 ).footer() ).html(subtotal.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
                $( api.column( 5 ).footer() ).html(discount.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
                $( api.column( 6 ).footer() ).html(ongkir.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
                $( api.column( 7 ).footer() ).html(pajak.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
                $( api.column( 8 ).footer() ).html(gtotal.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});

            }
        });

        $('.btn-generate-data').click(function (e) {
           e.preventDefault();
           dtable.draw();
        });
    }

    var initPenjualanRincian = function () {
        $('#filterjenis').select2();

        dtable = $('#tbl-list').DataTable({
            dom:"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12 col-md-12 text-right'B>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons:["excelHtml5","csvHtml5","pdfHtml5"],
            responsive: true,
            bSort: false,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            pageLength: 10,
            pagingType: 'full_numbers',
            ajax: {
                url: site_url + 'penjualan/datatable_rincian',
                type: 'POST',
                data: function(d) {
                    d.startdate = $('#startdate').val();
                    d.enddate = $('#enddate').val();
                    d.filtercustomer = $('#filtercustomer').val();
                    d.filterjenis = $('#filterjenis').val();
                }
            },
            // rowGroup: {
            //     dataSrc: 'row_title',
            // },
            columns: [
                {data: 'kodebrg'},
                {data: 'nmbrg'},
                {data: 'qty', sClass: 'text-right'},
                {data: 'nm_satuan'},
                {data: 'hgjual', sClass: 'text-right'},
                {data: 'disc1_persen', sClass: 'text-right'},
                {data: 'disc1_rp', sClass: 'text-right'},
                {data: 'disc2_persen', sClass: 'text-right'},
                {data: 'disc2_rp', sClass: 'text-right'},
                {data: 'disc3_persen', sClass: 'text-right'},
                {data: 'disc3_rp', sClass: 'text-right'},
                {data: 'det_total', sClass: 'text-right'},
                {data: 'ppn_type'},
                {data: 'total_ppn', sClass: 'text-right'},
                {data: 'gt', sClass: 'text-right'},
                {data: 'row_title', visible:false}
            ],
            drawCallback: function(obj) {
                var api = this.api();
                var rows = api.rows( {page:'current'} ).nodes();
                var last=null;
                var aData = {};

                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                disc1_rp = api
                    .column( 6, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                disc2_rp = api
                    .column( 8, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                disc3_rp = api
                    .column( 10, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                subtotal = api
                    .column( 11, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                tppn = api
                    .column( 13, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                total = api
                    .column( 14, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                $( api.column( 6 ).footer() ).html(disc1_rp.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
                $( api.column( 8 ).footer() ).html(disc2_rp.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
                $( api.column( 10 ).footer() ).html(disc3_rp.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
                $( api.column( 11 ).footer() ).html(subtotal.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
                $( api.column( 13 ).footer() ).html(tppn.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
                $( api.column( 14 ).footer() ).html(total.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});

                api.column(15, {page:'current'} ).data().each( function ( group, i ) {

                    // console.log(["DATA", api.row(api.row($(rows).eq(i)).index()).data()]);
                    var dt = api.row(api.row($(rows).eq(i)).index()).data();
                    if (typeof aData[group] == 'undefined') {
                        aData[group] = {};
                        aData[group].rows = [];
                        aData[group].data = [];
                    }

                    aData[group].rows.push(i);
                    aData[group].data.push(dt);

                    if ( last !== group ) {
                        $(rows).eq( i ).before(
                            '<tr class="group"><td colspan="15">'+group+'</td></tr>'
                        );
                        last = group;
                    }
                } );

                var idx= 0;

                for(var r in aData){

                    idx =  Math.max.apply(Math,aData[r].rows);

                    var disc1_rp = 0;
                    var disc2_rp = 0;
                    var disc3_rp = 0;
                    var det_total = 0;
                    var total_ppn = 0;
                    var gt = 0;
                    $.each(aData[r].data,function(k,v){
                        // console.log(["DATA1", k, v]);
                        disc1_rp += parseFloat(intVal(v['disc1_rp']));
                        disc2_rp += parseFloat(intVal(v['disc2_rp']));
                        disc3_rp += parseFloat(intVal(v['disc3_rp']));
                        det_total += parseFloat(intVal(v['det_total']));
                        total_ppn += parseFloat(intVal(v['total_ppn']));
                        gt += parseFloat(intVal(v['gt']));
                    });

                    $(rows).eq( idx ).after(
                        '<tr class="group">'
                        + '<td colspan="5" class="text-right">TOTAL '+ r +'</td>'
                        + '<td colspan="2" class="text-right currency">'+disc1_rp.toFixed(2)+'</td>'
                        + '<td colspan="2" class="text-right currency">'+disc2_rp.toFixed(2)+'</td>'
                        + '<td colspan="2" class="text-right currency">'+disc3_rp.toFixed(2)+'</td>'
                        + '<td class="text-right currency">'+det_total.toFixed(2)+'</td>'
                        + '<td colspan="2" class="text-right currency">'+total_ppn.toFixed(2)+'</td>'
                        + '<td class="text-right currency">'+gt.toFixed(2)+'</td>'
                        + '</tr>'
                    );

                    $('.currency').priceFormat({clearPrefix: true, centsLimit: 2});

                };

                // console.log(["DATA1", aData]);
            }
        });

        $('.btn-generate-data').click(function (e) {
            e.preventDefault();
            dtable.draw();
        });
    }

    var initPenjualanCustomer = function () {
        $('#filterjenis').select2();

        dtable = $('#tbl-list').DataTable({
            dom:"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12 col-md-12 text-right'B>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons:["excelHtml5","csvHtml5","pdfHtml5"],
            responsive: true,
            bSort: false,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            pageLength: 10,
            pagingType: 'full_numbers',
            ajax: {
                url: site_url + 'penjualan/datatable_customer',
                type: 'POST',
                data: function(d) {
                    d.startdate = $('#startdate').val();
                    d.enddate = $('#enddate').val();
                    d.filtercustomer = $('#filtercustomer').val();
                    d.filterjenis = $('#filterjenis').val();
                }
            },
            columns: [
                {data: 'jual_date'},
                {data: 'jual_no'},
                {data: 'jual_reff'},
                {data: 'jual_sub_total_kurs', sClass: 'text-right'},
                {data: 'jual_disc0_rp_kurs', sClass: 'text-right'},
                {data: 'jual_ongkir', sClass: 'text-right'},
                {data: 'jual_tax_rp', sClass: 'text-right'},
                {data: 'total_piutang', sClass: 'text-right'},
                {data: 'byr', sClass: 'text-right'},
                {data: 'saldo', sClass: 'text-right'}
            ],
            drawCallback: function(obj) {
                var api = this.api();

                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
            }
        });

        $('.btn-generate-data').click(function (e) {
            e.preventDefault();
            dtable.draw();
        });
    }

    var initSaldoPiutang = function() {
        // $('#filterjenis').select2();

        dtable = $('#tbl-list').DataTable({
            dom:"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12 col-md-12 text-right'B>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons:["excelHtml5","csvHtml5","pdfHtml5"],
            responsive: true,
            bSort: false,
            searchDelay: 500,
            processing: true,
            serverSide: false,
            pageLength: 10,
            pagingType: 'full_numbers',
            ajax: {
                url: site_url + 'penjualan/datatable_saldo_piutang',
                type: 'POST',
                data: function(d) {
                    d.startdate = $('#startdate').val();
                    d.enddate = $('#enddate').val();
                    d.filtercustomer = $('#filtercustomer').val();
                }
            },
            columns: [
                {data: 'person_code'},
                {data: 'person_name'},
                {data: 'saldo_awal', sClass: 'text-right'},
                {data: 'tambah', sClass: 'text-right'},
                {data: 'kurang', sClass: 'text-right'},
                {data: 'saldo_akhir', sClass: 'text-right'}
            ],
            drawCallback: function(obj) {
                var api = this.api();

                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                saldo_awal = api
                    .column( 2, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                tambah = api
                    .column( 3, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                kurang = api
                    .column( 4, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                saldo_akhir = api
                    .column( 5, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                $( api.column( 2 ).footer() ).html(saldo_awal.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
                $( api.column( 3 ).footer() ).html(tambah.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
                $( api.column( 4 ).footer() ).html(kurang.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
                $( api.column( 5 ).footer() ).html(saldo_akhir.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
            }
        });

        $('.btn-generate-data').click(function (e) {
            e.preventDefault();
            console.log('DRAW');
            dtable.ajax.reload();
        });
    }

    var initKartuPiutang = function() {

        var saldo_akhir = 0;

        dtable = $('#tbl-list').DataTable({
            dom:"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12 col-md-12 text-right'B>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons:["excelHtml5","csvHtml5","pdfHtml5"],
            responsive: true,
            bSort: false,
            searchDelay: 500,
            processing: true,
            serverSide: false,
            pageLength: 10,
            pagingType: 'full_numbers',
            ajax: {
                url: site_url + 'penjualan/datatable_kartu_piutang',
                type: 'POST',
                data: function(d) {
                    d.startdate = $('#startdate').val();
                    d.enddate = $('#enddate').val();
                    d.filtercustomer = $('#filtercustomer').val();
                }
            },
            columns: [
                {data: 'jual_no', sClass:'nowrap'},
                {data: 'jual_date'},
                {data: 'tipe_trans'},
                {data: 'tambah', sClass: 'text-right'},
                {data: 'kurang', sClass: 'text-right'},
                {data: 'saldo_akhir', sClass: 'text-right'},
                {data: 'sal_no'}
            ],
            rowCallback: function ( row, data, displayNum, displayIndex, dataIndex ) {

                if( displayIndex == 0 ) {
                    saldo_akhir = parseFloat(intVal(data.tambah)) - parseFloat(intVal(data.kurang));
                }
                else {
                    saldo_akhir = parseFloat(saldo_akhir) + (parseFloat(intVal(data.tambah)) - parseFloat(intVal(data.kurang)));
                }
                $('td:eq(5)', row).html( saldo_akhir.toFixed(2) ).priceFormat({clearPrefix: true, centsLimit: 2});

            },
            drawCallback: function(obj) {
                var api = this.api();

                tambah = api
                    .column( 3, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                kurang = api
                    .column( 4, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                saldo_akhir = tambah - kurang;

                $( api.column( 3 ).footer() ).html(tambah.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
                $( api.column( 4 ).footer() ).html(kurang.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
                $( api.column( 5 ).footer() ).html(saldo_akhir.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
            }
        });

        $('.btn-generate-data').click(function (e) {
            e.preventDefault();
            dtable.ajax.reload();
        });
    }
    
    var initJatuhTempo = function () {
        $('#filterjenis').select2();

        dtable = $('#tbl-list').DataTable({
            dom:"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12 col-md-12 text-right'B>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons:["excelHtml5","csvHtml5","pdfHtml5"],
            responsive: true,
            bSort: false,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            pageLength: 10,
            pagingType: 'full_numbers',
            ajax: {
                url: site_url + 'penjualan/datatable_jatuhtempo',
                type: 'POST',
                data: function(d) {
                    d.enddate = $('#enddate').val();
                    d.filtercustomer = $('#filtercustomer').val();
                    d.filterjenis = $('#filterjenis').val();
                    d.filtertop = $('#filtertop').val();
                }
            },
            columns: [
                {data: 'tgl'},
                {data: 'jual_no'},
                {data: 'topname'},
                {data: 'jual_total_kurs_format', sClass: 'text-right'},
                {data: 'tgl_duedate'},
                {data: 'sisa_format', sClass: 'text-right'},
                {data: 'sal_name'},
                {data: 'person_name'},
                {data: 'person_alamat'}
            ],
            // drawCallback: function(obj) {
            //     var api = this.api();
            //
            //     var intVal = function ( i ) {
            //         return typeof i === 'string' ?
            //             i.replace(/[\$,]/g, '')*1 :
            //             typeof i === 'number' ?
            //                 i : 0;
            //     };
            // }
        });

        dtable.on( 'draw', function () {
            btnL.stop();
        } );

        $('.btn-generate-data').click(function (e) {
            e.preventDefault();
            btnL.start();
            dtable.draw();
        });
    }
    
    var penjualanSubItem = function () {
        $('#filtertipe').select2();
        $('#filteritem').select2().on('select2:selecting', function(){
            $('#filtersubitem').val(null).trigger('change');
            $('#filtersubitem').select2('destroy');
            subItemSelect();
        });

        dtable = $('#tbl-list').DataTable({
            dom:"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12 col-md-12 text-right'B>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons:["excelHtml5","csvHtml5","pdfHtml5"],
            responsive: true,
            bSort: false,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            pageLength: 10,
            pagingType: 'full_numbers',
            ajax: {
                url: site_url + 'penjualan/datatable_subitem',
                type: 'POST',
                data: function(d) {
                    d.startdate = $('#startdate').val();
                    d.enddate = $('#enddate').val();
                    d.filtertipe = $('#filtertipe').val();
                    d.filteritem = $('#filteritem').val();
                    d.filtersubitem = $('#filtersubitem').val();
                }
            },
            rowGroup: {
                dataSrc: 'group_data',
            },
            columns: [
                {data: 'prod_code0'},
                {data: 'prod_name0'},
                {data: 'qty_satuan', sClass: 'text-right'},
                {data: 'prod_uom'},
                {data: 'total_jual', sClass: 'text-right'},
                {data: 'price_netto', sClass: 'text-right'},
                {data: 'laba', sClass: 'text-right'}
            ],
            /*drawCallback: function(obj) {
                var api = this.api();

                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                subtotal = api
                    .column( 4, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                discount = api
                    .column( 5, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                ongkir = api
                    .column( 6, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                pajak = api
                    .column( 7, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                gtotal = api
                    .column( 8, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // $( api.column( 5 ).footer() ).html(tambah).priceFormat({clearPrefix: true, centsLimit: 0});
                $( api.column( 4 ).footer() ).html(subtotal.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
                $( api.column( 5 ).footer() ).html(discount.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
                $( api.column( 6 ).footer() ).html(ongkir.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
                $( api.column( 7 ).footer() ).html(pajak.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
                $( api.column( 8 ).footer() ).html(gtotal.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});

            }*/
        });

        $('.btn-generate-data').click(function (e) {
            e.preventDefault();
            dtable.draw();
        });

    }
    
    var intVal = function ( i ) {
        return typeof i === 'string' ?
            i.replace(/[\$,]/g, '')*1 :
            typeof i === 'number' ?
                i : 0;
    };

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

    var customerSelect = function() {
        $("#filtercustomer").select2({
            placeholder: "Semua Customer",
            allowClear: true,
            width: '100%',
            ajax: {
                url: site_url + "mastercustomer/getdata",
                dataType: 'json',
                method: 'POST',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        page: params.page
                    };
                },
                processResults: function (data, page) {
                    return {
                        results: data.items
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            },
            templateResult: function (repo) {
                if (repo.loading)
                    return repo.text;
                return repo.person_code + " - "+ repo.person_name;
            },
            templateSelection: function (repo) {
                var detail = repo.person_code ? repo.person_code + " - " + repo.person_name : "";
                return detail || repo.text;
            }
        }).on('select2:unselect', function (e) {
            $(this).data('state', 'unselected');
        }).on("select2:open", function(e) {
            if ($(this).data('state') === 'unselected') {
                $(this).removeData('state');
                var self = $(this);
                setTimeout(function() {
                    self.select2('close');
                }, 1);
            }
        });
    }

    var topSelect = function() {
        $("#filtertop").select2({
            placeholder: "Semua Jatuh Tempo",
            allowClear: true,
            width: '100%',
            ajax: {
                url: site_url + "masterjatuhtempo/getdata",
                dataType: 'json',
                method: 'POST',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        page: params.page
                    };
                },
                processResults: function (data, page) {
                    return {
                        results: data.items
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            },
            templateResult: function (repo) {
                if (repo.loading)
                    return repo.text;
                return repo.kode;
            },
            templateSelection: function (repo) {
                var detail = repo.kode ? repo.kode : "";
                return detail || repo.text;
            }
        }).on('select2:unselect', function (e) {
            $(this).data('state', 'unselected');
        }).on("select2:open", function(e) {
            if ($(this).data('state') === 'unselected') {
                $(this).removeData('state');
                var self = $(this);
                setTimeout(function() {
                    self.select2('close');
                }, 1);
            }
        });
    }

    var subItemSelect = function() {
        $("#filtersubitem").select2({
            placeholder: "Semua Sub Item",
            allowClear: true,
            width: '100%',
            ajax: {
                url: site_url + "masterproduk/getdatasubitem",
                dataType: 'json',
                method: 'POST',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        page: params.page,
                        item: $('#filteritem').val()
                    };
                },
                processResults: function (data, page) {
                    return {
                        results: data.items
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            },
            templateResult: function (repo) {
                if (repo.loading)
                    return repo.text;
                return repo.nama;
            },
            templateSelection: function (repo) {
                var detail = repo.nama ? repo.nama : "";
                return detail || repo.text;
            }
        }).on('select2:unselect', function (e) {
            $(this).data('state', 'unselected');
        }).on("select2:open", function(e) {
            if ($(this).data('state') === 'unselected') {
                $(this).removeData('state');
                var self = $(this);
                setTimeout(function() {
                    self.select2('close');
                }, 1);
            }
        });
    }

    var LaddaButton = function() {
        btnL = Ladda.create( document.querySelector( '.ladda-button' ) );
    }

    return {
        penjualanRangkuman: function() {
            tgl_datepicker();
            customerSelect();
            initPenjualanRangkuman();
        },
        penjualanRincian: function() {
            tgl_datepicker();
            customerSelect();
            initPenjualanRincian();
        },
        penjualanCustomer: function() {
            tgl_datepicker();
            customerSelect();
            initPenjualanCustomer();
        },
        saldoPiutang: function() {
            tgl_datepicker();
            customerSelect();
            initSaldoPiutang();
        },
        saldoKartuPiutang: function() {
            tgl_datepicker();
            customerSelect();
            initKartuPiutang();
        },
        jatuhTempo: function() {
            tgl_datepicker();
            customerSelect();
            topSelect();
            LaddaButton();
            initJatuhTempo();
        },
        penjualanSubItem: function () {
            tgl_datepicker();
            subItemSelect();
            // LaddaButton();
            penjualanSubItem();
        }
    }
}();