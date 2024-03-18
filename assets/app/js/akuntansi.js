var Akuntansi = function() {

    var btnL = "";

    var neraca = function () {
        $('.btn-generate-data').click(function(e){
            e.preventDefault();

            var startdate = $('#startdate').val();

            btnL.start();
            $.ajax({
                url: site_url+"akuntansi/query_neraca",
                dataType: 'json',
                type: 'POST',
                data : {
                    startdate: startdate
                },
                success: function(data, textStatus, XMLHttpRequest) {
                    btnL.stop();
                    if( data.success ) {
                        var html = "";

                        var as = startdate.split('-');
                        $('.blnthn').html("Bulan : "+as[1]+"-"+as[0]);

                        html += '<table style="width: 100%;">';
                        html += '<tbody>';

                        for(var i in data.rows) {

                            if( data.rows[i].kode != "" ) {
                                var nama = data.rows[i].rek_nama;
                                var lpad = 20;
                                var fsize = 13;

                                if( parseInt(data.rows[i].rek_type) < 3 ) {
                                    nama = "<strong>"+nama+"</strong>";
                                    if( parseInt(data.rows[i].rek_type) == 1 ) fsize = 20;
                                }

                                lpad = (parseInt(data.rows[i].rek_type) - 1) * lpad;

                                html += '<tr>';
                                html += '<td style="padding-left: '+lpad+'px; font-size: '+ fsize +'px;">'+ nama +'</td>';
                                html += '<td class="text-right" style="width: 20%">'+ data.rows[i].saldo +'</td>';
                                html += '<td class="text-right" style="width: 20%">&nbsp;</td>';
                                html += '</tr>';
                            }
                            else {
                                html += '<tr>';
                                html += '<td class="text-right text-bold" colspan="2" style="font-size: 16px;">'+ data.rows[i].rek_nama +'</td>';
                                html += '<td class="text-right text-bold" style="width: 20%; font-size: 16px;">'+ data.rows[i].saldo +'</td>';
                                html += '</tr>';
                            }
                        }

                        html += '</tbody>';
                        html += '</table>';
                        $('.neraca-wrapper').html(html);
                    }
                    else {
                        $('.neraca-wrapper').html('');
                    }
                }
            });
        })
    }
    
    var bukubesar = function () {
        
    }

    var labarugi = function () {

    }
    
    var intVal = function ( i ) {
        return typeof i === 'string' ?
            i.replace(/[\$,]/g, '')*1 :
            typeof i === 'number' ?
                i : 0;
    };

    var tgl_datepicker = function () {
        $('.tgl_datepicker').datepicker({
            format: "yyyy-mm",
            viewMode: "months",
            minViewMode: "months",
            todayHighlight: !0,
            autoclose: true,
            orientation: "bottom left",
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });
    }

    var tgl_datepicker_full = function () {
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

    var defaultselect = function(){
        $('.default-select2').select2();
    }

    var perkiraanSelect = function() {
        $("#filterperkiraan").select2({
            placeholder: "Pilih Perkiraan",
            allowClear: true,
            width: '100%',
            ajax: {
                url: site_url + "masterperkiraan/getdata",
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
                return repo.rek_kode + " - "+ repo.rek_nama;
            },
            templateSelection: function (repo) {
                var detail = repo.rek_nama ? repo.rek_nama : "";
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
        initNeraca: function () {
            tgl_datepicker();
            LaddaButton();
            neraca();
        },
        initBukuBesar: function () {
            tgl_datepicker_full();
            perkiraanSelect();
            LaddaButton();
            bukubesar();
        },
        initLabaRugi: function () {
            labarugi();
        }
    }
}();