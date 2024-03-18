var GlobalJS = function() {

    return {
        init: function() {
            $('.m-select-gudang').change(function () {

                var cabang = $(this).val();

                $.ajax({
                    url: site_url + "dashboard/changecabang",
                    dataType: 'json',
                    type: 'POST',
                    data: {
                        params: cabang
                    },
                    success: function (data, textStatus, XMLHttpRequest) {
                        if (data.success) {
                            location.reload();
                        } else {
                            swal('Ubah Cabang', 'Ubah Cabang gagal!', 'error');
                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        swal('Ubah Cabang', 'Server Error', 'error');
                    }
                });
            })
        }
    }
}();