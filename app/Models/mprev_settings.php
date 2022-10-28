<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mprev_settings extends Model
{
    use HasFactory;
    protected $table ="mprev_settings";
    protected $primaryKey = 'sid';
    public $timestamps = false;
}
