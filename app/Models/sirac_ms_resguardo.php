<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sirac_ms_resguardo extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv_atenea';
    protected $table ="ms_resguardo";
    protected $primaryKey = 'id_ms_equipo';
}
