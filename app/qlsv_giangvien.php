<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class qlsv_giangvien extends Model
{
    protected $table = 'qlsv_giangviens';
    protected $fillable = ['id', 'id_user','hovaten','ngaysinh','diachi','gioitinh','sodienthoaicanhan','sodienthoaicongkhai','gioithieu','ghichu'];
    public $timestams = false;
}
