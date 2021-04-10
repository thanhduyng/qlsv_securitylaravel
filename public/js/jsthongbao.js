$(function() {
    $("#jsthongbao").validate({
        rules: {
            tieude: {
                required: true
            },
            noidung: {
                required: true
            }
        },
        messages:{
        "tieude": {
            required: "Vui lòng nhập tiêu đề",
        },
        "noidung": {
            required: "Vui lòng nhập nội dung",
        }
    }
    });
});