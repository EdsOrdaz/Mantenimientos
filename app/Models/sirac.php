<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sirac extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv_atenea';
    protected $table ="dt_equipo";
    protected $primaryKey = 'id_dt_equipo';
    public $timestamps = false;
}
