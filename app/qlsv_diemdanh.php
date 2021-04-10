<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class qlsv_diemdanh extends Model
{
    protected $table = 'qlsv_diemdanhs';
    protected $fillable = ['id', 'id_sinhvienlophoc','id_thoikhoabieu','denlop','thuchanh','kienthuc','ghichu'];
    public $timestams = false;
}
