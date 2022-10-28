<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MacAddress extends Model
{
    use HasFactory;
    protected $table ="MacAddress";
    protected $primaryKey = 'mid';
    public $timestamps = false;
}
