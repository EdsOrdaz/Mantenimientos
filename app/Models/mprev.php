<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mprev extends Model
{
    use HasFactory;
    protected $table ="mprev";
    protected $primaryKey = 'mid';
    public $timestamps = false;
}
