<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class qlsv_khoahoc extends Model
{
    protected $table = 'qlsv_khoahocs';
    protected $fillable = ['id', 'tenkhoahoc','ghichu'];
    public $timestams = false;
}
