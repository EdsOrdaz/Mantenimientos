<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;


class admin extends Controller
{
    public function login_view()
    {
        if(isset(Auth::user()->id))
        {
            return view('admin_panel');
        }
        else
        {
            return view('admin_login');
        }
    }

    public function login_validar(Request $request)
    {
        try
        {
            $credenciales = $request->only('email', 'password');
            if(Auth::attempt($credenciales))
            {
                $request->session()->regenerate();

                $data["estatus"]="OK";

                return json_encode($data);
            }
            $data["estatus"]="N";
            $data["msj"]="Error en usuario o contraseña.";
            return json_encode($data);
        }
        catch(Exception $e)
        {
            $data["estatus"]="N";
            $data["msj"]=$e->getMessage();
            return json_encode($data);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/panel');
    }
}
