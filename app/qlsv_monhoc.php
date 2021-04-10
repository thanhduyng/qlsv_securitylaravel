<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class qlsv_monhoc extends Model
{
    protected $table = 'qlsv_monhocs';
    protected $fillable = ['id', 'tenmonhoc','ghichu'];
    public $timestams = false;
}
