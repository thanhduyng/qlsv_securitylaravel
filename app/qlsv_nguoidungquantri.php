<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class qlsv_nguoidungquantri extends Model
{
    protected $table = 'qlsv_nguoidungquantris';
    protected $fillable = ['id', 'ten','diachi','gioitinh','sodienthoai'];
    public $timestams = false;
}
