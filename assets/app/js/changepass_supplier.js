$('document').ready(function(){
    $('.btn-change-password').click(function(e){
        e.preventDefault();
        $('#modal-password').modal('show');
    })

    $('.btn-simpan-password').click(function(e){
        e.preventDefault();
        $.ajax({
            url: site_url+"supplier/update_password",
            dataType: 'json',
            type: 'POST',
            data : {
                "params" : $('#frm-ganti-password').serialize()
            },
            success: function(data, textStatus, XMLHttpRequest) {
                if( data.success ) {
                    swal('Ubah Password', 'Password berhasil di rubah', 'success');
                }
                else {
                    swal('Ubah Password', 'Password gagal di rubah', 'error');
                }
            }
        });
    });
})