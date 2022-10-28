<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sirac_baja extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv_atenea';
    protected $table ="LNJ_Equipos_Gilberto";
    //protected $primaryKey = 'No. Activo';
}
