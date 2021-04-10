<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class qlsv_phonghoc extends Model
{
    protected $table = 'qlsv_phonghocs';
    protected $fillable = ['id', 'tenphonghoc','ghichu'];
    public $timestams = false;
}
