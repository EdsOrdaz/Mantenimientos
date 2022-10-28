<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mprev_programa extends Model
{
    use HasFactory;
    protected $table ="mprev_programa";
    protected $primaryKey = 'pid';
    public $timestamps = false;
}
