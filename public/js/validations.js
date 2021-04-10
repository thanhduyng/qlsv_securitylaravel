$().ready(function () {
	$("#jsvalidations").validate({
		onfocusout: false,
		onkeyup: false,
		onclick: false,
		rules: {
			"id_worktask": {
				required: true
			},
			"id_phonghoc": {
				required: true
			},
			"giovao": {
				required: true
			},
			"giora": {
				required: true
			},
			"giobatdau": {
				required: true
			},
			"danhgiagiovao": {
				required: true
			},
			"danhgiagiora": {
				required: true
			},
			"lydogiovao": {
				required: true
			},
			"lydogiora": {
				required: true
			},
			"kieuthi": {
				required: true
			},
			"tenphonghoc": {
				required: true
			},
			"tenmonhoc": {
				required: true
			},
			"tenkhoahoc": {
				required: true
			},"cauhoi": {
				required: true
			},
			"tieude": {
				required: true
			},
			"buoithu": {
				required: true
			},
			"siso": {
				required: true
			},
			"thuchientot": {
				required: true
			},
			"khonglamduoc": {
				required: true
			},
			"danhgiacuagiangvien": {
				required: true
			},
			"id_khoahoc":{
				required: true
			},
			"id_monhoc":{
				required: true
			},
			"cautraloi[]":{
				required: true
			},
			"ngaynghi":{
				required: true
			},
			"noidung":{
				required: true
			},
			"lydo":{
				required: true
			}
		},

		messages: {
			"giovao": {
				required: "Vui lòng chọn giờ vào",
			},
			"id_worktask": {
				required: "Vui lòng chọn worktask",
			},
			"id_phonghoc": {
				required: "Vui lòng chọn phòng",
			},
			"giobatdau": {
				required: "Vui lòng chọn giờ bắt đầu",
			},
			"danhgiagiovao": {
				required: "Vui lòng chọn đánh giá",
			},
			"lydogiovao": {
				required: "Vui lòng chọn lý do",
			},
			"giora": {
				required: "Vui lòng chọn giờ ra",
			},
			"danhgiagiora": {
				required: "Vui lòng chọn đánh giá",
			},
			"lydogiora": {
				required: "Vui lòng chọn lý do",
			},
			"kieuthi": {
				required: "Vui lòng nhập kiểu thi",
			},
			"ngaynghi": {
				required: "Vui lòng chọn ngày nghỉ",
			},
			"canghi": {
				required: "Vui lòng chọn ca nghỉ",
			},
			"noidung": {
				required: "Vui lòng nhập nội dung",
			},
			"lydo": {
				required: "Vui lòng nhập lý do",
			},
			"cautraloi[]": {
				required: "Vui lòng nhập câu trả lời",
			},
			"tenphonghoc": {
				required: "Vui lòng nhập tên phòng học",
			},
			"tenmonhoc": {
				required: "Vui lòng nhập tên môn học",
			},
			"tenkhoahoc": {
				required: "Vui lòng nhập tên khoá học",
			},
			"tieude": {
				required: "Vui lòng nhập tiêu đề",
			},
			"cauhoi": {
				required: "Vui lòng nhập câu hỏi",
			},
			"buoithu": {
				required: "Vui lòng nhập buổi thứ",
			},
			"siso": {
				required: "Vui lòng nhập sĩ số",
			},
			"thuchientot": {
				required: "Vui lòng nhập đánh giá",
			},
			"khonglamduoc": {
				required: "Vui lòng nhập đánh giá",
			},
			"danhgiacuagiangvien": {
				required: "Vui lòng nhập đánh giá",
			}
		}
	});
});