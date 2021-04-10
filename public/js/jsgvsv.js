$(function () {
    $("#jsgvsv").validate({
        rules: {
            gioitinh: {
                required: true
            },
            hovaten: {
                required: true
            },
            ten: {
                required: true
            },
            ngaysinh: {
                required: true
            },
            diachi: {
                required: true
            },
            sodienthoaicanhan: {
                required: true
            }, 
            sodienthoai: {
                required: true
            },
            sodienthoaisinhvien: {
                required: true
            },
            sodienthoaigiadinh: {
                required: true
            },
            id_khoahoc: {
                required: true
            },
            gioithieu: {
                required: true
            },
            email: {
                required: true
            },
            password: {
                required: true,
                minlength: 8
            }
        },
        messages: {
            "gioitinh": {
                required: "Vui lòng chọn giới tính",
            },
            "id_khoahoc": {
                required: "Vui lòng chọn khoá",
            },
            "sodienthoaisinhvien": {
                required: "Vui lòng nhập số điện thoại",
            },
            "sodienthoai": {
                required: "Vui lòng nhập số điện thoại",
            },
            "sodienthoaigiadinh": {
                required: "Vui lòng nhập số điện thoại bố(mẹ)",
            },
            "hovaten": {
                required: "Vui lòng nhập họ và tên",
            },
            "ten": {
                required: "Vui lòng nhập họ và tên",
            },
            "ngaysinh": {
                required: "Vui lòng chọn ngày sinh",
            },
            "diachi": {
                required: "Vui lòng nhập địa chỉ",
            },
            "sodienthoaicanhan": {
                required: "Vui lòng nhập số điện thoại",
            },
            "gioithieu": {
                required: "Vui lòng nhập giới thiệu bản thân",
            },
            "email": {
                required: "Vui lòng nhập email",
            },
            "password": {
                required: "Vui lòng nhập mật khẩu",
                minlength: "Hãy nhập ít nhất 8 ký tự"
            }
        }
    });
});