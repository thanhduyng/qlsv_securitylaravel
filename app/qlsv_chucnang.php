<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class qlsv_chucnang extends Model
{
    protected $table ="qlsv_chucnangs";
    protected $fillable = ['id', 'ma','ten','url','id_cha'];
    public $timestams = false;
}
