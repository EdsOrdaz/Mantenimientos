<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Laravel\Ui\Presets\React;

class admin_usuarios extends Controller
{
    public function lista_usuarios()
    {
        $users = User::all();
        echo view('admin/nav', ['text' => "Lista de Usuarios"]);
        echo view('admin_secciones/usuarios', ['users' => $users]);
    }

    public function agregar_usuario()
    {
        echo view('admin/nav', ['text' => "Agregar nuevo usuario"]);
        echo view('admin_secciones/agregar_usuario');
    }

    public function insertar_usuario(Request $request)
    {
        $email = trim($request->email);
        if(empty($email) || empty($request->pass)  || empty($request->nombre))
        {
            $data['estatus'] = "N";
            $data['msj'] = "Nombre, Email o Contraseña no pueden estar vacios.";
            return json_encode($data);
        }

        try
        {
            User::create(['name'=>trim($request->nombre),'email'=>trim($request->email),'password'=>bcrypt($request->pass)]);
            $data['estatus'] = "OK";
            $data['msj'] = "Registro insertado correctamente.";
        }
        catch(Exception $error)
        {
            $data['estatus'] = "N";
            $data['msj'] = "Error: ".$error->getMessage();
        }
        return json_encode($data);
    }

    public function update_usuarios(Request $request)
    {
        $user = User::find($request->id);
        if($user->id == 1)
        {
            $data["icon"] = "error";
            $data["msj"] = "No puedes editar al Administrador principal.";
            return response()->json($data);
        }
        if(Auth::user()->id == $user->id)
        {
            $data["icon"] = "error";
            $data["msj"] = "No puedes editar tu usuario.";
            return response()->json($data);
        }
        $permisos = Array(
            'mantenimiento' => '',
            'usuarios' => '',
            'infeq' => '',
            'config' => ''
        );
        if(isset($request->mantenimiento))
        {
            $permisos['mantenimiento'] = 'checked';
        }
        if(isset($request->usuarios))
        {
            $permisos['usuarios'] = 'checked';
        }
        if(isset($request->infeq))
        {
            $permisos['infeq'] = 'checked';
        }
        if(isset($request->config))
        {
            $permisos['config'] = 'checked';
        }
        $insert = implode("|", $permisos);
        
        $user->permisos = $insert;
        $user->save();
        
        $data["icon"] = "success";
        $data["msj"] = $request->nombre." se actualizo correctamente.";
        return response()->json($data);
    }

    public function delete_usuarios(Request $request)
    {
        $data = Array();
        if($request->id == 1)
        {
            $data["icon"] = "error";
            $data["msj"] = "No puedes eliminar al Administrador Principal.";
        }
        else
        {
            $user = User::find($request->id);
            if(Auth::user()->id == $user->id)
            {
                $data["icon"] = "error";
                $data["msj"] = "No puedes eliminar tu usuario.";
            }
            else
            {
                $user->delete();
                $data["icon"] = "success";
                $data["msj"] = $user->name." eliminado correctamente.";
            }
        }
        return json_encode($data);
    }
}
