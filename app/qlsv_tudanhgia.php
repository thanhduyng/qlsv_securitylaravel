<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class qlsv_tudanhgia extends Model
{
    protected $table = "qlsv_tudanhgias";
    protected $fillable = ['id', 'id_monhoc', 'tieude', 'cauhoi', 'thutu', 'soluongcautraloi'];
}