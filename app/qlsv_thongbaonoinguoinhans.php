<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class qlsv_thongbaonoinguoinhans extends Model
{
    protected $table = "qlsv_thongbaonoinguoinhans";
    protected $fillable = ['id', 'id_thongbao', 'id_nguoinhan', 'ngaydoc', 'nguoitao', 'nguoisua'];
}
