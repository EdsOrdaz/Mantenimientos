<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EquiposReporte;
use App\Models\mprev_settings;
use App\Models\equipos;
use App\Models\MacAddress;
use App\Models\mprev;
use App\Models\sirac;
use App\Models\sirac_baja;
use App\Models\sirac_LNJ_Equipos;
use App\Models\usuarios_infeq;
use Exception;
use Illuminate\Support\Facades\DB;

class admin_infeq extends Controller
{
    public function infeq()
    {
        echo view('admin/nav', ['text' => "InfEq"]);
        try
        {
            $infeq = EquiposReporte::select('*', 'Direcciones Mac as macs')
            ->orderByDesc('XID')
            ->take(20)
            ->get();

            $years = Array();

            for($i=2018;$i<=date("Y");$i++)
            {
                $years[] = $i;
            }
            
            $meses = Array(
                "Enero" => "01",
                "Febrero" => "02",
                "Marzo" => "03",
                "Abril" => "04",
                "Mayo" => "05",
                "Junio" => "06",
                "Julio" => "07",
                "Agosto" => "08",
                "Septiembre" => "09",
                "Octubre" => "10",
                "Noviembre" => "11",
                "Diciembre" => "12"
            );

            $mantenimientos = Array(
                    '1' =>  'Correctivo',
                    '2' =>  'Preventivo',
                    '3' =>  'Equipo Nuevo',
                    '4' =>  'Cambio de Equipo'
            );

            $usuarios = usuarios_infeq::All();

            $data = Array(
                'usuario' => '',
                'usuarios' => $usuarios,
                'marca' => '',
                'modelo' => '',
                'infeq' => $infeq,
                'meses' => $meses,
                'mes' => '',
                'years'  => $years,
                'year'  => '',
                'economico'  => '',
                'serie'  => '',
                'departamento'  => '',
                'base'  => '',
                'empresa'  => '',
                'mantenimiento' =>  '',
                'mantenimientos'  => $mantenimientos,
                'mac'  => ''
            );
            echo view('admin_secciones/infeq', $data);
        }
        catch (Exception $e)
        {
            echo view('admin/error', ["error"=>$e->getMessage()]);
        }
    }

    public function sirac()
    {        
        $data = Array(
            "sirac" => '',
            "historico" => '',
            'buscar'    => ''
        );
        echo view('admin/nav', ['text' => "Sirac"]);
        echo view('admin_secciones/sirac', $data);
    }

    public function sirac_buscar_historico(Request $request)
    {
        $text = trim($request->buscar);
        $historico = DB::connection('sqlsrv_atenea')
            ->table('ms_resguardo as m')
            ->select('m.fecha_baja AS baja', 'm.fecha_alta AS alta', 'eq.fecha_baja AS fechadebaja', 'eq.status AS estatus',
                    'cat_eq.descripcion AS categoria', 'cat_eq.marca AS catmarca',
                    DB::raw("em.nombre+' '+em.ap_paterno+' '+em.ap_materno as [usuarioactual]"),
                    DB::raw("alta_emp.nombre+' '+alta_emp.ap_paterno+' '+alta_emp.ap_materno as [usuarioasigno]"),
                    DB::raw("emp_desa.nombre+' '+emp_desa.ap_paterno+' '+emp_desa.ap_materno as [usuariodesasigno]"),
                    DB::raw("emp_reg.nombre+' '+emp_reg.ap_paterno+' '+emp_reg.ap_materno as [usuarioregistro]"),
                    DB::raw("emp_baja.nombre+' '+emp_baja.ap_paterno+' '+emp_baja.ap_materno as [usuariobaja]"),
            'm.*', 'eq.*')
            ->join('dt_equipo as eq', 'm.id_dt_equipo', '=', 'eq.id_dt_equipo')
            ->join('bd_Empleado.dbo.cg_empleado as em', 'em.id_empleado', '=', 'm.id_empleado')

            ->leftJoin('cg_usuario as s_user', 's_user.id_usuario', '=', 'm.id_usr_alta')
            ->leftJoin('bd_Empleado.dbo.cg_empleado as alta_emp', 'alta_emp.id_empleado', '=', 's_user.id_empleado')

            ->leftJoin('cg_usuario as s_user_desa', 's_user_desa.id_usuario', '=', 'm.id_usr_baja')
            ->leftJoin('bd_Empleado.dbo.cg_empleado as emp_desa', 'emp_desa.id_empleado', '=', 's_user_desa.id_empleado')

            ->leftJoin('cg_usuario as s_reg_al', 's_reg_al.id_usuario', '=', 'eq.id_usr_reg')
            ->leftJoin('bd_Empleado.dbo.cg_empleado as emp_reg', 'emp_reg.id_empleado', '=', 's_reg_al.id_empleado')

            ->leftJoin('cg_usuario as s_reg_baja', 's_reg_baja.id_usuario', '=', 'eq.id_usr_baja')
            ->leftJoin('bd_Empleado.dbo.cg_empleado as emp_baja', 'emp_baja.id_empleado', '=', 's_reg_baja.id_empleado')

            ->leftJoin('cg_equipo as cat_eq', 'cat_eq.id_equipo', '=', 'eq.id_equipo')

            ->where('eq.codigo', 'LIKE', '%'.$text.'%')
            ->OrwhereRaw("em.nombre+' '+em.ap_paterno+' '+em.ap_materno LIKE '%".$text."%'")
            ->OrderBy('m.id_ms_resguardo', 'DESC')
            ->get();

        $data = Array(
            'resguardos' => $historico
        );
        return view('admin_secciones/sirac_historico_td', $data);
    }

    public function sirac_buscar(Request $request)
    {
        $text = trim($request->buscar);
        $sirac="";
        $historico="";
        if(!empty($text))
        {
            $sirac = sirac_LNJ_Equipos::select('LNJ_Equipos.*', 'dt_equipo.*', 'LNJ_cg_equipo.*')
            ->join('dt_equipo', DB::raw('[LNJ_Equipos].[No. Activo]'), '=', 'dt_equipo.codigo')
            ->join('LNJ_cg_equipo', 'dt_equipo.id_equipo', '=', 'LNJ_cg_equipo.id_equipo')
            ->where(DB::raw("[No. Activo]"), "LIKE", "%".$text."%")
            ->orWhere('Nombre de Resguardatario', 'LIKE', '%'.$text.'%')
            ->orWhere(DB::raw("[No. Serie]"), 'LIKE', "%".$text."%")
            ->orWhere(DB::raw("[marca]"), 'LIKE', "%".$text."%")
            ->orWhere(DB::raw("[descripcion]"), 'LIKE', "%".$text."%")
            ->orWhere(DB::raw("[modelo]"), 'LIKE', "%".$text."%")
            ->OrderBy(DB::raw('[No. Activo]'), 'ASC')
            ->get();


            $historico = DB::connection('sqlsrv_atenea')
            ->table('ms_resguardo as m')
            ->select('m.fecha_baja AS baja', 'm.fecha_alta AS alta', 'eq.fecha_baja AS fechadebaja', 'eq.status AS estatus',
                    'cat_eq.descripcion AS categoria', 'cat_eq.marca AS catmarca',
                    DB::raw("em.nombre+' '+em.ap_paterno+' '+em.ap_materno as [usuarioactual]"),
                    DB::raw("alta_emp.nombre+' '+alta_emp.ap_paterno+' '+alta_emp.ap_materno as [usuarioasigno]"),
                    DB::raw("emp_desa.nombre+' '+emp_desa.ap_paterno+' '+emp_desa.ap_materno as [usuariodesasigno]"),
                    DB::raw("emp_reg.nombre+' '+emp_reg.ap_paterno+' '+emp_reg.ap_materno as [usuarioregistro]"),
                    DB::raw("emp_baja.nombre+' '+emp_baja.ap_paterno+' '+emp_baja.ap_materno as [usuariobaja]"),
            'm.*', 'eq.*')
            ->join('dt_equipo as eq', 'm.id_dt_equipo', '=', 'eq.id_dt_equipo')
            ->join('bd_Empleado.dbo.cg_empleado as em', 'em.id_empleado', '=', 'm.id_empleado')

            ->leftJoin('cg_usuario as s_user', 's_user.id_usuario', '=', 'm.id_usr_alta')
            ->leftJoin('bd_Empleado.dbo.cg_empleado as alta_emp', 'alta_emp.id_empleado', '=', 's_user.id_empleado')

            ->leftJoin('cg_usuario as s_user_desa', 's_user_desa.id_usuario', '=', 'm.id_usr_baja')
            ->leftJoin('bd_Empleado.dbo.cg_empleado as emp_desa', 'emp_desa.id_empleado', '=', 's_user_desa.id_empleado')

            ->leftJoin('cg_usuario as s_reg_al', 's_reg_al.id_usuario', '=', 'eq.id_usr_reg')
            ->leftJoin('bd_Empleado.dbo.cg_empleado as emp_reg', 'emp_reg.id_empleado', '=', 's_reg_al.id_empleado')

            ->leftJoin('cg_usuario as s_reg_baja', 's_reg_baja.id_usuario', '=', 'eq.id_usr_baja')
            ->leftJoin('bd_Empleado.dbo.cg_empleado as emp_baja', 'emp_baja.id_empleado', '=', 's_reg_baja.id_empleado')

            ->leftJoin('cg_equipo as cat_eq', 'cat_eq.id_equipo', '=', 'eq.id_equipo')

            ->where('eq.codigo', 'LIKE', '%'.$text.'%')
            ->OrwhereRaw("em.nombre+' '+em.ap_paterno+' '+em.ap_materno LIKE '%".$text."%'")
            ->OrderBy('m.id_ms_resguardo', 'DESC')
            ->get();
        }
        $data = Array(
            "sirac" => $sirac,
            "historico" => $historico,
            'buscar' => $text
        );
        echo view('admin/nav', ['text' => "Sirac"]);
        echo view('admin_secciones/sirac', $data);
    }

    public function infeq_buscar(Request $request)
    {
        echo view('admin/nav', ['text' => "InfEq"]);
        try
        {
            $usuario = trim($request->usuario);
            $modelo = trim($request->modelo);
            $marca = trim($request->marca);
            $mes = trim($request->mes);
            $mantenimiento = intval($request->mantenimiento);
            $year = intval($request->year);
            $economico = trim($request->economico);
            $serie = trim($request->serie);
            $departamento = trim($request->departamento);
            $base = trim($request->base);
            $empresa = trim($request->empresa);
            $mac = trim($request->mac);

            $infeq = EquiposReporte::select('*', 'Direcciones Mac as macs')
            ->when(!empty($usuario), function ($query) use ($usuario) { return $query->where('nombre', 'LIKE', '%'.$usuario.'%'); })
            ->when(!empty($marca), function ($query) use ($marca) { return $query->where('marca', 'LIKE', '%'.$marca.'%'); })            
            ->when(!empty($modelo), function ($query) use ($modelo) { return $query->where('modelo', 'LIKE', '%'.$modelo.'%'); })
            ->when($mes!="00", function ($query) use ($mes) { return $query->where('mes', '=', $mes); })
            ->when($year!="0", function ($query) use ($year) { return $query->where('year', '=', $year); })
            ->when(!empty($economico), function ($query) use ($economico) { return $query->where('noactivo', 'LIKE', '%'.$economico.'%'); })
            ->when(!empty($serie), function ($query) use ($serie) { return $query->where('numeroserie', 'LIKE', '%'.$serie.'%'); })
            ->when(!empty($departamento), function ($query) use ($departamento) { return $query->where('departamento', 'LIKE', '%'.$departamento.'%'); })
            ->when(!empty($base), function ($query) use ($base) { return $query->where('base', 'LIKE', '%'.$base.'%'); })
            ->when(!empty($empresa), function ($query) use ($empresa) { return $query->where('empresa', 'LIKE', '%'.$empresa.'%'); })
            ->when(!empty($mac), function ($query) use ($mac) { return $query->where('Direcciones Mac', 'LIKE', '%'.$mac.'%'); })
            ->when($mantenimiento != "0", function ($query) use ($mantenimiento) { return $query->where('mantenimiento', '=', $mantenimiento); })
            ->orderByDesc('XID')
            ->when(empty($usuario) && empty($marca) && empty($modelo) && $mes=="00" && $mantenimiento=="0" && $year=="0" && empty($economico) && empty($serie) && empty($departamento) && empty($base) && empty($empresa) && empty($mac), function ($query){ return $query->take(20); })
            ->get();

            $years = Array();

            for($i=2018;$i<=date("Y");$i++)
            {
                $years[] = $i;
            }

            $meses = Array(
                "Enero" => "01",
                "Febrero" => "02",
                "Marzo" => "03",
                "Abril" => "04",
                "Mayo" => "05",
                "Junio" => "06",
                "Julio" => "07",
                "Agosto" => "08",
                "Septiembre" => "09",
                "Octubre" => "10",
                "Noviembre" => "11",
                "Diciembre" => "12"
            );

            $mantenimientos = Array(
                    '1' =>  'Correctivo',
                    '2' =>  'Preventivo',
                    '3' =>  'Equipo Nuevo',
                    '4' =>  'Cambio de Equipo'
            );


            $usuarios = usuarios_infeq::All();

            $data = Array(
                'usuario' => $usuario,
                'usuarios' => $usuarios,
                'marca' => $marca,
                'modelo' => $modelo,
                'infeq' => $infeq,
                'meses' => $meses,
                'mes' => $mes,
                'year'  => $year,
                'years'  => $years,
                'economico'  => $economico,
                'serie'  => $serie,
                'departamento'  => $departamento,
                'base'  => $base,
                'empresa'  => $empresa,
                'mantenimientos'  => $mantenimientos,
                'mantenimiento' =>  $mantenimiento,
                'mac'  => $mac
            );
            
            echo view('admin_secciones/infeq', $data);
        }
        catch (Exception $e)
        {
            echo view('admin/error', ["error"=>$e->getMessage()]);
        }
    }

    public function copiar_datos(Request $request)
    {
        $infeq = EquiposReporte::find($request->id);
        $settings = mprev_settings::find(1);
        $name = explode(" ", ucwords(strtolower($infeq->nombre)));
        
        $text = str_replace("{nombre}", ucwords($name[0]), $settings->text);
        $text = str_replace("{tipo}", $infeq->tipo, $text);
        $text = str_replace("{economico}", $infeq->noactivo, $text);
        $text = str_replace("{marca}", $infeq->marca, $text);
        $text = str_replace("{modelo}", $infeq->modelo, $text);
        $text = str_replace("{serie}", $infeq->numeroserie, $text);

        $data = Array(
            'nombre'    => ucwords($name[0]),
            'texto' => $text
        );
        return json_encode($data);
    }

    public function eliminar_xid(Request $request)
    {
        try
        {
            $infeq = equipos::find($request->id);
            if(empty($infeq->XID))
            {
                $data = Array(
                    "icon" => 'error',
                    "msj"   => "No existe el registro ".$request->id." o ya fue eliminado."
                );
                return response()->json($data);
            }

            mprev::where('xid', $infeq->XID)->delete();
            
            $macs = MacAddress::where('xid', $infeq->XID)->get();
            if(!empty($macs))
            {
                foreach($macs as $mac)
                {
                    MacAddress::find($mac->mid)->delete();
                }
            }

            $infeq->delete();

            $data = Array(
                "icon" => 'success',
                "msj"   => "Se elimino correctamente el registro ".$infeq->XID
            );
            return response()->json($data);
        }
        catch(Exception $e)
        {
            $data = Array(
                "icon" => 'error',
                "msj"   => $e->getMessage()
            );
            return response()->json($data);
        }
    }

    public function infeq_baja()
    {
        echo view('admin/nav', ['text' => "Generar Formato de Baja"]);
        echo view('admin_secciones/infeq_baja');
    }

    public function baja_economicos(Request $request)
    {
        $economicos = preg_replace('/^\h*\v+/m', '', $request->economicos);
        $ecos = explode("\n", trim($economicos));
        $equipos = Array();
        $error = Array();
        $errores=0;
        foreach($ecos as $eco)
        {
            try
            {
                $eco = str_replace("\r","",$eco);
                $sirac = sirac_baja::whereRaw("[No. Activo]='".$eco."'")->first();
                if(!empty($sirac))
                {
                    $equipos[] = $sirac;
                }
                else
                {
                    if(!empty($eco))
                    {
                        $error[$eco] = "No se encontro en la base de datos.";
                        $errores++;
                    }
                }
            }
            catch(Exception $e)
            {
                $error[$eco] = $e->getMessage();
                $errores++;
            }
        }
        $data = Array(
            'errores'   => $errores,
            'error' => $error,
            'equipos'   => $equipos
        );
        return view('admin_secciones/infeq_baja_cargados', $data);
    }

    public function imprimir_baja(Request $request)
    {
        $equipos = Array();
        foreach($request->ecos as $eco)
        {
            $sirac = sirac_baja::whereRaw("[No. Activo]='".$eco."'")->first();
            $sirac['motivo'] = strtoupper($request['m_'.$sirac['No. Activo']]);
            $sirac['detecto'] = strtoupper($request['d_'.$sirac['No. Activo']]);
            $sirac['obs'] = strtoupper($request['o_'.$sirac['No. Activo']]);
            $equipos[] = $sirac;
        }
        $data = Array(
            "equipos"   => $equipos
        );
        return view('admin/imprimir_baja', $data);
    }

    public function venta_equipo()
    {
        echo view('admin/nav', ['text' => "Generar Formato de Venta de Equipo"]);
        echo view('admin_secciones/infeq_venta');
    }

    public function venta_economicos(Request $request)
    {
        $economicos = preg_replace('/^\h*\v+/m', '', $request->economicos);
        $ecos = explode("\n", trim($economicos));
        $equipos = Array();
        $error = Array();
        $errores=0;
        foreach($ecos as $eco)
        {
            try
            {
                $eco = str_replace("\r","",$eco);
                $equipo = equipos::where("noactivo",$eco)->OrderBy('XID', 'DESC')->first();
                if(!empty($equipo))
                {
                    $equipos[] = $equipo;
                }
                else
                {
                    if(!empty($eco))
                    {
                        $error[$eco] = "No se encontro en la base de datos (InfEq).";
                        $errores++;
                    }
                }
            }
            catch(Exception $e)
            {
                $error[$eco] = $e->getMessage();
                $errores++;
            }
        }
        $data = Array(
            'errores'   => $errores,
            'error' => $error,
            'equipos'   => $equipos
        );

        return view('admin_secciones/infeq_venta_cargados', $data);
    }

    public function imprimir_venta(Request $request)
    {
        $equipos = Array();
        foreach($request->ecos as $eco)
        {
            $equipo = equipos::where("noactivo", $eco)->OrderBy('XID', 'DESC')->first();
            $equipo['precio'] = "$".strtoupper($request['p_'.$equipo->noactivo]);
            $equipo['obs'] = strtoupper($request['o_'.$equipo->noactivo]);
            $equipos[] = $equipo;
        }
        $data = Array(
            "equipos"   => $equipos
        );
        return view('admin/imprimir_venta', $data);
    }

    public function imprimir_excel_venta(Request $request)
    {
        $request->session()->forget("equipos");
        $campos = Array();
        $equipos = Array();
        foreach($request->ecos as $eco)
        {
            $equipo = equipos::where("noactivo", $eco)->OrderBy('XID', 'DESC')->first();
            //$equipo['precio'] = "$".strtoupper($request['p_'.$equipo->noactivo]);
            //$equipo['obs'] = strtoupper($request['o_'.$equipo->noactivo]);

            $campos['economico'] = $equipo['noactivo'];
            $campos['tipo'] = $equipo['tipo'];
            $campos['marca'] = $equipo['marca'];
            $campos['modelo'] = $equipo['modelo'];
            $campos['numserie'] = $equipo['numeroserie'];
            $campos['ram'] = $equipo['ram']." MB";
            $campos['dd'] = $equipo['ddtotal']." GB";
            $campos['procesador'] = $equipo['procesador'];
            $campos['so'] = $equipo['so'];
            $campos['precio'] = "$".strtoupper($request['p_'.$equipo->noactivo]);
            $campos['obs'] = strtoupper($request['o_'.$equipo->noactivo]);
            $equipos[] = $campos;
        }
        $request->session()->push("equipos",$equipos);
        $data = Array(
            "path"    => url('/imprimir_excel_venta_session')
        );
        return Response()->json($data);
    }

    public function imprimir_excel_baja(Request $request)
    {
        $request->session()->forget("equipos");
        $campos = Array();
        $equipos = Array();
        foreach($request->ecos as $eco)
        {
            $equipo = sirac_baja::whereRaw("[No. Activo]='".$eco."'")->first();

            $campos['economico'] = $equipo['No. Activo'];
            $campos['tipo'] = $equipo['Subcategoría'];
            $campos['marca'] = $equipo['marca'];
            $campos['modelo'] = $equipo['modelo'];
            $campos['numserie'] = $equipo['No. Serie'];
            $campos['usuario'] = $equipo['Nombre de Resguardatario'];
            $campos['empresa'] = $equipo['Empresa'];
            $campos['cc'] = $equipo['Centro de Costo'];
            $campos['motivo'] = strtoupper($request['m_'.$equipo['No. Activo']]);
            $campos['detecto'] = strtoupper($request['d_'.$equipo['No. Activo']]);
            $campos['obs'] = strtoupper($request['o_'.$equipo['No. Activo']]);
            $equipos[] = $campos;
        }
        $request->session()->push("equipos",$equipos);
        $data = Array(
            "path"    => url('/imprimir_excel_baja_session')
        );
        return Response()->json($data);
    }

    public function update_observacion(Request $request)
    {
        $equipo = equipos::find(intval($request->id));
        $equipo->observaciones = $request->obs;
        $equipo->save();
        $data = Array(
            "icon" => "success",
            "msj"   => "Observaciones actualizadas."
        );
        return response()->json($data);
    }

    public function update_ti_observacion(Request $request)
    {
        $insert['obs_ti'] = $request->obs;
        try
        {
            sirac::select('obs_ti')->where('codigo', $request->id)->update($insert);
            $data = Array(
                "icon" => "success",
                "msj"   => "Observaciones de TI actualizadas."
            );
        }
        catch(Exception $e)
        {
            $data = Array(
                "icon" => "error",
                "msj"   => "Error al actualizar Observacion."
            );
        }
        return response()->json($data);
    }

    public function infeq_sirac_observacion(Request $request)
    {
        try
        {
            $sirac = sirac::select('obs_ti')->where('codigo', $request->eco)->first();
            return $sirac->obs_ti;
        }
        catch(Exception $e)
        {
            return "ERROR: ".$e->getMessage();
        }
    }
}
