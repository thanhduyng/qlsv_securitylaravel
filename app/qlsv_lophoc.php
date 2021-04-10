<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class qlsv_lophoc extends Model
{
    protected $table = 'qlsv_lophocs';
    protected $fillable = ['id', 'tenlophoc','id_giangvien','id_khoahoc','id_monhoc','thoiluong'];
    public $timestams = false;
}
