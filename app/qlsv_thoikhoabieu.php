<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class qlsv_thoikhoabieu extends Model
{
    protected $table = 'qlsv_thoikhoabieus';
    protected $fillable = ['id', 'buoithu','ngayhoc','cahoc','diachihoc','giovao','giobatdau','danhgiagiovao','lydogiovao',
    'giora', 'danhgiagiora','lydogiora','siso','thuchientot','khonglamduoc','loinhanphongdaotao','danhgiacuagiangvien','chukicuagiangvien',
    'loinhancuagiangvien', 'ghichu','id_worktask','id_phonghoc'];
    public $timestams = false;
}
