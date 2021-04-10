<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class qlsv_thongbao extends Model
{
    protected $table = "qlsv_thongbaos";
    protected $fillable = ['id', 'id_nguoitao', 'tieude', 'noidung', 'nguoitao', 'nguoisua'];
}
