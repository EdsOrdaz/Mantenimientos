<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

     /*
     PERMISOS USUARIOS
     0 = MANTENIMIENTOS
     1 = USUARIOS
     2 = INFEQ
     3 = CONFIGURACION
     */

    public function handle(Request $request, Closure $next)
    {
        if(!isset(Auth::user()->id))
        {
            return redirect('/panel');
        }
        $permisos = explode("|", Auth::user()->permisos);

        $mantenimientos = Array(
            "reportes",
            "buscar",
            "buscarmantenimiento",
            "programa",
            "programavalidar_year",
            "estrellas",
            "cambioyear",
            "actualizarfechas",
            "actualizarfechas",
            "agregarxml",
            "cargaxml"
        );
        $usuarios = Array(
            "insertarusuario", 
            "agregarusuario", 
            "listausuarios", 
            "actualizarusuario", 
            "eliminarusuario"
        );
        $infeq = Array("infeq", "infeqbuscar", "copiar_infeq", "eliminarxid");
        $settings = Array("configuracion", "guardarcuerpo");

        
        //Revisar Mantenimientos
        if(in_array($request->route()->uri, $mantenimientos))
        {
            if(empty($permisos[0]))
            {
                return response(view('admin/denegado'));
            }
        }

        //Revisar Usuarios
        if(in_array($request->route()->uri, $usuarios))
        {
            if(empty($permisos[1]))
            {
                return response(view('admin/denegado'));
            }
        }

        //Revisar Infeq
        if(in_array($request->route()->uri, $infeq))
        {
            if(empty($permisos[2]))
            {
                return response(view('admin/denegado'));
            }
        }

        //Revisar Settings
        if(in_array($request->route()->uri, $settings))
        {
            if(empty($permisos[3]))
            {
                return response(view('admin/denegado'));
            }
        }
        
        return $next($request);
    }
}
