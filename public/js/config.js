$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    "processData": false,
    "mimeType": "multipart/form-data",
    "contentType": false,
    "method": 'POST',
    // "beforeSend": () => showLoading(),
    "success": (resp, status, xhr) => {
        if (xhr.getResponseHeader('content-type').toLowerCase() == 'application/json') {
            const message = JSON.parse(xhr.responseText)
            if (message._typeMessage) {
                swal(_swalConfig[message._typeMessage])
            }
        }
    }

});
const _swalConfig = {
    warning: {
        icon: "warning",
        buttons: true,
        dangerMode: true,
    },
    ok: {
        icon: "success",
        buttons: true,
    },
    error: {
        icon: "danger",
        buttons: true,
    },
}

_swalConfig.deleteConfirm = {..._swalConfig.warning, title: 'Bạn có muốn xóa hay không?' }
_swalConfig.deleteSuccess = {..._swalConfig.ok, title: 'Xóa thành công' }
_swalConfig.deleteFailed = {..._swalConfig.error, title: 'Xóa thất bại' }