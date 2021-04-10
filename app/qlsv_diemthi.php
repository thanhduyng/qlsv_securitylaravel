<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class qlsv_diemthi extends Model
{
    protected $table ="qlsv_diemthis";
    protected $fillable = ['id', 'id_sinhvienlophoc','diemlythuyet','diemthuchanh','ngaychodiem','id_kieuthi','ghichu'];
}
