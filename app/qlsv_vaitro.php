<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class qlsv_vaitro extends Model
{
    protected $table = 'qlsv_vaitros';
    protected $fillable = ['id', 'ma','ten'];
    public $timestams = false;

    public function qlsv_chucnangs(){
        return $this->belongsToMany(qlsv_chucnang::class);
    }
}
