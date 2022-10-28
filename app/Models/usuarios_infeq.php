<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuarios_infeq extends Model
{
    use HasFactory;
    protected $table ="Usuarios";
    protected $primaryKey = 'uid';
}
