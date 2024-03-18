var Inventory = function() {

    var dtable = "";
    var btnL = "";

    var initSaldoStok = function() {
        if( $('#tbl-list').length ) {
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
                // deferRender: true,
                ajax: {
                    url: site_url + 'inventory/datatable_saldo_stok',
                    type: 'POST',
                    data: function(d) {
                        d.enddate = $('#enddate').val();
                        d.filterproduk = $('#filterproduk').val();
                        d.filterstok = $('#filterstok').val();
                        d.filtergudang = $('#filtergudang').val();
                    }
                },
                columns: [
                    {data: 'prod_code0', sClass:'nowrap'},
                    {data: 'prod_name0'},
                    {data: 'qty', sClass: 'text-right'},
                    {data: 'prod_uom'}
                ],
                drawCallback: function(obj) {
                    var api = this.api();
    
                    qty = api
                        .column( 2, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
    
                    $( api.column( 2 ).footer() ).html(qty.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
                }
            });
        }
        else {
            dtable = $('#tbl-list-global').DataTable({
                dom:"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12 col-md-12 text-right'B>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons:["excelHtml5","csvHtml5","pdfHtml5"],
                responsive: true,
                bSort: false,
                searchDelay: 500,
                processing: true,
                serverSide: true,
                pageLength: 10,
                pagingType: 'full_numbers',
                // deferRender: true,
                ajax: {
                    url: site_url + 'inventory/datatable_saldo_stok_global',
                    type: 'POST',
                    data: function(d) {
                        d.enddate = $('#enddate').val();
                        d.filterproduk = $('#filterproduk').val();
                        d.filterstok = $('#filterstok').val();
                        d.filtergudang = $('#filtergudang').val();
                    }
                },
                columns: [
                    {data: 'prod_code0', sClass:'nowrap'},
                    {data: 'prod_name0'},
                    {data: 'qty', sClass: 'text-right'},
                    {data: 'prod_uom'},
                    {data: 'last_prod_rata_price', sClass: 'text-right'}
                ],
                drawCallback: function(obj) {
                    var api = this.api();
    
                    qty = api
                        .column( 2, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
    
                    $( api.column( 2 ).footer() ).html(qty.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
                }
            });
        }
        
        dtable.on( 'draw', function () {
            btnL.stop();
        } );

        $('.btn-generate-data').click(function (e) {
            btnL.start();
            e.preventDefault();
            dtable.ajax.reload();
        });
    }

    var initKartuStok = function() {
        if( $('#tbl-list').length ) {
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
                // deferRender: true,
                ajax: {
                    url: site_url + 'inventory/datatable_kartu_stok',
                    type: 'POST',
                    data: function(d) {
                        d.startdate = $('#startdate').val();
                        d.enddate = $('#enddate').val();
                        d.filterproduk = $('#filterproduk').val();
                        d.filtergudang = $('#filtergudang').val();
                    }
                },
                columns: [
                    {data: 'tgl', sClass:'nowrap'},
                    {data: 'transaksi'},
                    {data: 'qty_in', sClass: 'text-right'},
                    {data: 'qty_out', sClass: 'text-right'},
                    {data: 'saldo', sClass: 'text-right'}
                ],
                drawCallback: function(obj) {
                    var api = this.api();
    
                    qty_in = api
                        .column( 2, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    qty_out = api
                        .column( 3, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    
                    $( api.column( 2 ).footer() ).html(qty_in.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
                    $( api.column( 3 ).footer() ).html(qty_out.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});

                }
            });
        }
        else {
            dtable = $('#tbl-list-global').DataTable({
                dom:"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12 col-md-12 text-right'B>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons:["excelHtml5","csvHtml5","pdfHtml5"],
                responsive: true,
                bSort: false,
                searchDelay: 500,
                processing: true,
                serverSide: false,
                pageLength: 10,
                pagingType: 'full_numbers',
                // deferRender: true,
                ajax: {
                    url: site_url + 'inventory/datatable_kartu_stok_global',
                    type: 'POST',
                    data: function(d) {
                        d.startdate = $('#startdate').val();
                        d.enddate = $('#enddate').val();
                        d.filterproduk = $('#filterproduk').val();
                        d.filterstok = $('#filterstok').val();
                        d.filtergudang = $('#filtergudang').val();
                    }
                },
                columns: [
                    {data: 'tgl', sClass:'nowrap'},
                    {data: 'transaksi'},
                    {data: 'prod_netto_price', sClass: 'text-right'},
                    {data: 'qty_in', sClass: 'text-right'},
                    {data: 'qty_out', sClass: 'text-right'},
                    {data: 'total', sClass: 'text-right'},
                    {data: 'saldo', sClass: 'text-right'},
                    {data: 'hpp', sClass: 'text-right'},
                    {data: 'total_saldo', sClass: 'text-right'},
                    {data: 'harga_jual', sClass: 'text-right'},
                    {data: 'total_lr', sClass: 'text-right'}
                ],
                // drawCallback: function(obj) {
                //     var api = this.api();
                //
                //     qty = api
                //         .column( 2, { page: 'current'} )
                //         .data()
                //         .reduce( function (a, b) {
                //             return intVal(a) + intVal(b);
                //         }, 0 );
                //
                //     $( api.column( 2 ).footer() ).html(qty.toFixed(2)).priceFormat({clearPrefix: true, centsLimit: 2});
                // }
            });
        }
        
        dtable.on( 'draw', function () {
            btnL.stop();
        } );

        $('.btn-generate-data').click(function (e) {
            btnL.start();
            e.preventDefault();

            if( $('#filterproduk').val() == "" || $('#filterproduk').val() == null ) {
                btnL.stop();
                swal("Laporan Stok", "Silakan pilih produk dahulu.", "error");
                return false;
            }

            dtable.ajax.reload();
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

    var productSelect = function() {
        $("#filterproduk").select2({
            placeholder: "Semua Produk",
            allowClear: true,
            width: '100%',
            ajax: {
                url: site_url + "masterproduk/getdata",
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
                return repo.prod_code0 + " - "+ repo.prod_name0;
            },
            templateSelection: function (repo) {
                var detail = repo.prod_code0 ? repo.prod_code0 : "";
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

    var gudangSelect = function() {
        $("#filtergudang").select2({
            placeholder: "Semua Gudang",
            allowClear: true,
            width: '100%',
            ajax: {
                url: site_url + "mastergudang/getdata",
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
                return repo.gud_code + " - "+ repo.gud_name;
            },
            templateSelection: function (repo) {
                var detail = repo.gud_code ? repo.gud_code + " - " + repo.gud_name : "";
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

    var defaultselect = function(){
        $('.default-select2').select2();
    }

    var LaddaButton = function() {
        btnL = Ladda.create( document.querySelector( '.ladda-button' ) );
    }

    return {
        initSaldoStok: function() {
            tgl_datepicker();
            productSelect();
            gudangSelect();
            defaultselect();
            LaddaButton();
            initSaldoStok();
        },
        initKartuStok: function() {
            tgl_datepicker();
            productSelect();
            gudangSelect();
            defaultselect();
            LaddaButton();
            initKartuStok();
        }
    }
}();