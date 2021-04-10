<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class qlsv_sinhvienlophoc extends Model
{
    protected $table = 'qlsv_sinhvienlophocs';
    protected $fillable = ['id', 'id_lophoc','id_sinhvien'];
    public $timestams = false;
}
