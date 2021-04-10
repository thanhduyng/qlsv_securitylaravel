<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class qlsv_worktask extends Model
{
    protected $table = "qlsv_worktasks";
    protected $fillable = ['id', 'tenworktask', 'thutu', 'id_monhoc', 'nguoitao', 'nguoisua'];
}
