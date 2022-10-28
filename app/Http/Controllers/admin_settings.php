<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mprev_settings;

class admin_settings extends Controller
{
    public function panel()
    {
        $settings = mprev_settings::All();
        $cuerpocorreo = Array(
            'cuerpo'    => $settings[0]
        );

        echo view('admin/nav', ['text' => "Configuración"]);

        echo view('admin_secciones/settings', $cuerpocorreo);
    }

    public function guardar_cuerpo(Request $request)
    {
        $setts = mprev_settings::find(1);
        $setts->text = $request->summernote;
        $setts->save();
    }
}
