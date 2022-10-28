<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sirac_LNJ_Equipos extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv_atenea';
    protected $table ="LNJ_Equipos";
}
