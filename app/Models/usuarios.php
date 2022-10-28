<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuarios extends Model
{
    use HasFactory;
    protected $table ="mprev_usuarios";
    protected $primaryKey = 'uid';
    public $timestamps = false;
}
