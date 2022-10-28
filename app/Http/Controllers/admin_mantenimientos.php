<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\mprev_programa;
use App\Models\mprev;
use App\Models\equipos;
use App\Models\sirac;
use App\Models\usuarios_infeq;
use App\Models\MacAddress;
use Illuminate\Support\Facades\File; 

use Illuminate\Support\Facades\Mail;

use Storage;
use Exception;

class admin_mantenimientos extends Controller
{
    public function buscar_mantenimientos()
    {
        try
        {
            $mantenimiento=equipos::select('equipos.*', 'mprev.*')
            ->join('mprev', 'equipos.xid', '=', 'mprev.xid')
            ->orderByDesc('mid')
            ->take(50)
            ->get();

            echo view('admin/nav', ['text' => "Mantenimientos Realizados"]);

            $usuarios = usuarios_infeq::All();
            $data = Array(
                'fecha_buscar' => "",
                'usuario'  => "",
                'economico'  => "",
                'base'  => "",
                'mantenimiento' => $mantenimiento,
                "usuarios"  => $usuarios
            );
            echo view('admin_secciones/buscar_mantenimientos', $data);
        }
        catch (Exception $e)
        {
            echo view('admin/error', ["error"=>$e->getMessage()]);
        }
    }

    public function buscar(Request $request)
    {
        try
        {
            $fecha = explode("-",$request->fechas);
            $buscarfechas = (trim($fecha[0]) == trim($fecha[1])) ? false : true;
            $usuario = trim($request->usuario);
            $buscarusuario = (empty($usuario)) ? false : true;
            $economico = trim($request->economico);
            $buscareconomico = (empty($economico)) ? false : true;
            $base = trim($request->base);
            $buscarbase = (empty($base)) ? false : true;

            echo view('admin/nav', ['text' => "Mantenimientos Realizados"]);

            $mantenimiento=equipos::select('equipos.*', 'mprev.*')
            ->join('mprev', 'equipos.xid', '=', 'mprev.xid')
            ->when($buscarfechas==true, function ($query) use ($fecha) {
                return $query->whereBetween('fecha_alta', [$fecha[0], $fecha[1]]);
            })
            ->when($buscarusuario==true, function ($query) use ($usuario) {
                return $query->where('equipos.nombre', 'LIKE', '%'.$usuario.'%');
            })
            ->when($buscareconomico==true, function ($query) use ($economico) {
                return $query->where('equipos.noactivo', 'LIKE', '%'.$economico.'%');
            })
            ->when($buscarbase==true, function ($query) use ($base) {
                return $query->where('equipos.base', 'LIKE', '%'.$base.'%');
            })
            ->orderByDesc('mid')
            ->when($buscarfechas==false && $buscarbase==false && $buscarusuario==false && $buscareconomico==false, function ($query){
                return $query->take(30);
            })
            ->get();

            $usuarios = usuarios_infeq::All();

            $data = Array(
                'fecha_buscar' => $request->fechas,
                'usuario'  => $usuario,
                'economico'     => $economico,
                'base'      => $base,
                'mantenimiento' => $mantenimiento,
                "usuarios"  => $usuarios
            );
            echo view('admin_secciones/buscar_mantenimientos', $data);
        }
        catch (Exception $e)
        {
            echo view('admin/error', ["error"=>$e->getMessage()]);
        }
    }

    public function mes_text($mes)
    {
        switch($mes)
        {
            case '01':
                return "Enero";
                break;
            case '02':
                return "Febrero";
                break;
            case '03':
                return "Marzo";
                break;
            case '04':
                return "Abril";
                break;
            case '05':
                return "Mayo";
                break;
            case '06':
                return "Junio";
                break;
            case '07':
                return "Julio";
                break;
            case '08':
                return "Agosto";
                break;
            case '09':
                return "Septiembre";
                break;
            case '10':
                return "Octubre";
                break;
            case '11':
                return "Noviembre";
                break;
            case '12':
                return "Diciembre";
                break;
        }
    }

    public function reportes()
    {
        try
        {
            echo view('admin/nav', ['text' => "Reportes"]);
            $year = date("Y");
            $y = mprev_programa::where('year', $year)->first();
            
            $meses = explode("|",$y->meses);

            $data['year'] = $year;
            $data['ene'] = $meses[0];
            $data['feb'] = $meses[1];
            $data['mar'] = $meses[2];
            $data['abr'] = $meses[3];
            $data['may'] = $meses[4];
            $data['jun'] = $meses[5];
            $data['jul'] = $meses[6];
            $data['ago'] = $meses[7];
            $data['sep'] = $meses[8];
            $data['oct'] = $meses[9];
            $data['nov'] = $meses[10];
            $data['dic'] = $meses[11];

            
            $data['r_ene']= mprev::whereBetween('fecha_alta',[$year.'-01-01',$year.'-01-31'])->count();
            $data['r_feb']= mprev::whereBetween('fecha_alta',[$year.'-02-01',$year.'-02-28'])->count();
            $data['r_mar']= mprev::whereBetween('fecha_alta',[$year.'-03-01',$year.'-03-31'])->count();
            $data['r_abr']= mprev::whereBetween('fecha_alta',[$year.'-04-01',$year.'-04-30'])->count();
            $data['r_may']= mprev::whereBetween('fecha_alta',[$year.'-05-01',$year.'-05-31'])->count();
            $data['r_jun']= mprev::whereBetween('fecha_alta',[$year.'-06-01',$year.'-06-30'])->count();
            $data['r_jul']= mprev::whereBetween('fecha_alta',[$year.'-07-01',$year.'-07-31'])->count();
            $data['r_ago']= mprev::whereBetween('fecha_alta',[$year.'-08-01',$year.'-08-31'])->count();
            $data['r_sep']= mprev::whereBetween('fecha_alta',[$year.'-09-01',$year.'-09-30'])->count();
            $data['r_oct']= mprev::whereBetween('fecha_alta',[$year.'-10-01',$year.'-10-31'])->count();
            $data['r_nov']= mprev::whereBetween('fecha_alta',[$year.'-11-01',$year.'-11-30'])->count();
            $data['r_dic']= mprev::whereBetween('fecha_alta',[$year.'-12-01',$year.'-12-31'])->count();

            $data['p_ene'] = ($data['ene'] > 0) ? round((($data['r_ene'] * 100) / $data['ene']),1) : 0; 
            $data['p_feb'] = ($data['feb'] > 0) ? round((($data['r_feb'] * 100) / $data['feb']),1) : 0; 
            $data['p_mar'] = ($data['mar'] > 0) ? round((($data['r_mar'] * 100) / $data['mar']),1) : 0; 
            $data['p_abr'] = ($data['abr'] > 0) ? round((($data['r_abr'] * 100) / $data['abr']),1) : 0; 
            $data['p_may'] = ($data['may'] > 0) ? round((($data['r_may'] * 100) / $data['may']),1) : 0; 
            $data['p_jun'] = ($data['jun'] > 0) ? round((($data['r_jun'] * 100) / $data['jun']),1) : 0; 
            $data['p_jul'] = ($data['jul'] > 0) ? round((($data['r_jul'] * 100) / $data['jul']),1) : 0; 
            $data['p_ago'] = ($data['ago'] > 0) ? round((($data['r_ago'] * 100) / $data['ago']),1) : 0; 
            $data['p_sep'] = ($data['sep'] > 0) ? round((($data['r_sep'] * 100) / $data['sep']),1) : 0; 
            $data['p_oct'] = ($data['oct'] > 0) ? round((($data['r_oct'] * 100) / $data['oct']),1) : 0; 
            $data['p_nov'] = ($data['nov'] > 0) ? round((($data['r_nov'] * 100) / $data['nov']),1) : 0; 
            $data['p_dic'] = ($data['dic'] > 0) ? round((($data['r_dic'] * 100) / $data['dic']),1) : 0; 

            $data['ene_color'] = admin_mantenimientos::color_progressbar($data['p_ene']);
            $data['feb_color'] = admin_mantenimientos::color_progressbar($data['p_feb']);
            $data['mar_color'] = admin_mantenimientos::color_progressbar($data['p_mar']);
            $data['abr_color'] = admin_mantenimientos::color_progressbar($data['p_abr']);
            $data['may_color'] = admin_mantenimientos::color_progressbar($data['p_may']);
            $data['jun_color'] = admin_mantenimientos::color_progressbar($data['p_jun']);
            $data['jul_color'] = admin_mantenimientos::color_progressbar($data['p_jul']);
            $data['ago_color'] = admin_mantenimientos::color_progressbar($data['p_ago']);
            $data['sep_color'] = admin_mantenimientos::color_progressbar($data['p_sep']);
            $data['oct_color'] = admin_mantenimientos::color_progressbar($data['p_oct']);
            $data['nov_color'] = admin_mantenimientos::color_progressbar($data['p_nov']);
            $data['dic_color'] = admin_mantenimientos::color_progressbar($data['p_dic']);

            $data['cero'] = mprev::where('estrellas',0)->whereBetween('fecha_alta',[$year.'-01-01' ,$year.'-01-31'])->count();
            $data['una'] = mprev::where('estrellas',1)->whereBetween('fecha_alta',[$year.'-01-01' ,$year.'-01-31'])->count();
            $data['dos'] = mprev::where('estrellas',2)->whereBetween('fecha_alta',[$year.'-01-01' ,$year.'-01-31'])->count();
            $data['tres'] = mprev::where('estrellas',3)->whereBetween('fecha_alta',[$year.'-01-01' ,$year.'-01-31'])->count();
            $data['cuatro'] = mprev::where('estrellas',4)->whereBetween('fecha_alta',[$year.'-01-01' ,$year.'-01-31'])->count();
            $data['cinco'] = mprev::where('estrellas',5)->whereBetween('fecha_alta',[$year.'-01-01' ,$year.'-01-31'])->count();
            $data['mes'] = "01";

            $data['mestext'] = admin_mantenimientos::mes_text("01");
            $data['years'] = mprev_programa::all();

            echo view('admin_secciones/reportes',$data);
        }
        catch (Exception $e)
        {
            echo view('admin/error', ["error"=>$e->getMessage()]);
        }
    }

    public function color_progressbar($porcentaje)
    {
        if($porcentaje < 26)
        {
            return "#FF5140";
        }
        if($porcentaje > 25 && $porcentaje < 50)
        {
            return "#E67E22";
        }
        else if($porcentaje > 51 && $porcentaje < 75)
        {
            return "#F1C40F";
        }
        else{
            return "#27AE60";
        }
    }

    public function programa()
    {
        try
        {
            echo view('admin/nav', ['text' => "Programa de Mantenimientos"]);
            $year = date("Y");
            $data = Array(
                'year'  =>  $year,
                'ene'   => 0,
                'feb'   => 0,
                'mar'   => 0,
                'abr'   => 0,
                'may'   => 0,
                'jun'   => 0,
                'jul'   => 0,
                'ago'   => 0,
                'sep'   => 0,
                'oct'   => 0,
                'nov'   => 0,
                'dic'   => 0
            );
            $y = mprev_programa::where('year', $year)->first();
            if(!empty($y))
            {
                $meses = explode("|",$y->meses);
                $data = Array(
                    'year'  =>  $year,
                    'ene'   => $meses[0],
                    'feb'   => $meses[1],
                    'mar'   => $meses[2],
                    'abr'   => $meses[3],
                    'may'   => $meses[4],
                    'jun'   => $meses[5],
                    'jul'   => $meses[6],
                    'ago'   => $meses[7],
                    'sep'   => $meses[8],
                    'oct'   => $meses[9],
                    'nov'   => $meses[10],
                    'dic'   => $meses[11]
                );
            }
            echo view('admin_secciones/programa', $data);
        }
        catch (Exception $e)
        {
            echo view('admin/error', ["error"=>$e->getMessage()]);
        }
    }

    public function programa_validar_year(Request $request)
    {
        $year = intval($request->year);
        
        $data['year'] = $year;
        $data['msj'] = "";

        if($year < 2022)
        {
            $data['estatus'] = "N";
            $year = date("Y");
            $data['year'] = date("Y");
            $data['msj'] = "No puedes seleccionar un año menor al 2022";
        }
        
        $data['ene'] = 0;
        $data['feb'] = 0;
        $data['mar'] = 0;
        $data['abr'] = 0;
        $data['may'] = 0;
        $data['jun'] = 0;
        $data['jul'] = 0;
        $data['ago'] = 0;
        $data['sep'] = 0;
        $data['oct'] = 0;
        $data['nov'] = 0;
        $data['dic'] = 0;

        $y = mprev_programa::where('year', $year)->first();
        if(!empty($y))
        {
            $meses = explode("|",$y->meses);
            $data['ene'] = $meses[0];
            $data['feb'] = $meses[1];
            $data['mar'] = $meses[2];
            $data['abr'] = $meses[3];
            $data['may'] = $meses[4];
            $data['jun'] = $meses[5];
            $data['jul'] = $meses[6];
            $data['ago'] = $meses[7];
            $data['sep'] = $meses[8];
            $data['oct'] = $meses[9];
            $data['nov'] = $meses[10];
            $data['dic'] = $meses[11];
        }
        return json_encode($data);
    }

    public function programa_actualizar_fecha(Request $request)
    {
        try
        {
            $year = intval($request->year);
            if($year < 2022)
            {
                $data['estatus'] = "N";
                $data['msj'] = "No se puede insertar datos en un año menor al 2022.";
                return json_encode($data);
            }

            $y = mprev_programa::where('year', $year)->first();

            $meses = Array(
                intval($request->ene),
                intval($request->feb),
                intval($request->mar),
                intval($request->abr),
                intval($request->may),
                intval($request->jun),
                intval($request->jul),
                intval($request->ago),
                intval($request->sep),
                intval($request->oct),
                intval($request->nov),
                intval($request->dic)
            );
            $meses_string = implode("|",$meses);
            $insert['meses'] = $meses_string;

            if(isset($y->pid))
            {
                mprev_programa::where('pid', $y->pid)->update($insert);
                $data['msj'] = "Mantenimientos ".$year." actualizados correctamente.";
            }
            else
            {
                $mprev_insertar = new mprev_programa;
                $mprev_insertar->year = $year;
                $mprev_insertar->meses = $meses_string;
                $mprev_insertar->usuario = Auth::user()->id;
                $mprev_insertar->save();
                $data['msj'] = "Mantenimientos ".$year." cargados correctamente.";
            }
            $data['estatus'] = "OK";
            return json_encode($data);
        }
        catch (Exception $e)
        {
            $data['estatus'] = "N";
            $data['msj'] = $e->getMessage();
            return json_encode($data);
        }
    }

    public function obtener_estrellas(Request $request)
    {
        switch($request->mes)
        {
            case '01': 
                $dia="31";
                break;
            case '02': 
                $dia="28";
                break;
            case '03': 
                $dia="31";
                break;
            case '04': 
                $dia="30";
                break;
            case '05': 
                $dia="31";
                break;
            case '06': 
                $dia="30";
                break;
            case '07': 
                $dia="31";
                break;
            case '08': 
                $dia="31";
                break;
            case '09': 
                $dia="30";
                break;
            case '10': 
                $dia="31";
                break;
            case '11': 
                $dia="30";
                break;
            case '12': 
                $dia="31";
                break;
        }
        $year = (intval($request->year)>2021) ? intval($request->year) : 2022;

        $data['cero'] = mprev::where('estrellas',0)->whereBetween('fecha_alta',[$year.'-'.$request->mes.'-01' ,$year.'-'.$request->mes.'-'.$dia])->count();
        $data['una'] = mprev::where('estrellas',1)->whereBetween('fecha_alta',[$year.'-'.$request->mes.'-01' ,$year.'-'.$request->mes.'-'.$dia])->count();
        $data['dos'] = mprev::where('estrellas',2)->whereBetween('fecha_alta',[$year.'-'.$request->mes.'-01' ,$year.'-'.$request->mes.'-'.$dia])->count();
        $data['tres'] = mprev::where('estrellas',3)->whereBetween('fecha_alta',[$year.'-'.$request->mes.'-01' ,$year.'-'.$request->mes.'-'.$dia])->count();
        $data['cuatro'] = mprev::where('estrellas',4)->whereBetween('fecha_alta',[$year.'-'.$request->mes.'-01' ,$year.'-'.$request->mes.'-'.$dia])->count();
        $data['cinco'] = mprev::where('estrellas',5)->whereBetween('fecha_alta',[$year.'-'.$request->mes.'-01' ,$year.'-'.$request->mes.'-'.$dia])->count();
        $data['mes'] = $request->mes;
        $data['msj'] = "Mostrando estrellas de ".$request->mes." ".$request->year;
        $data['mestext'] = admin_mantenimientos::mes_text($request->mes);
        return json_encode(($data));
    }

    public function cambio_year(Request $request)
    {
        $year = (intval($request->year)>2021) ? intval($request->year) : 2022;
        $y = mprev_programa::where('year', $year)->first();
        
        $meses = explode("|",$y->meses);

        $data['year'] = $year;
        $data['ene'] = $meses[0];
        $data['feb'] = $meses[1];
        $data['mar'] = $meses[2];
        $data['abr'] = $meses[3];
        $data['may'] = $meses[4];
        $data['jun'] = $meses[5];
        $data['jul'] = $meses[6];
        $data['ago'] = $meses[7];
        $data['sep'] = $meses[8];
        $data['oct'] = $meses[9];
        $data['nov'] = $meses[10];
        $data['dic'] = $meses[11];

        $data['r_ene']= mprev::whereBetween('fecha_alta',[$year.'-01-01',$year.'-01-31'])->count();
        $data['r_feb']= mprev::whereBetween('fecha_alta',[$year.'-02-01',$year.'-02-28'])->count();
        $data['r_mar']= mprev::whereBetween('fecha_alta',[$year.'-03-01',$year.'-03-31'])->count();
        $data['r_abr']= mprev::whereBetween('fecha_alta',[$year.'-04-01',$year.'-04-30'])->count();
        $data['r_may']= mprev::whereBetween('fecha_alta',[$year.'-05-01',$year.'-05-31'])->count();
        $data['r_jun']= mprev::whereBetween('fecha_alta',[$year.'-06-01',$year.'-06-30'])->count();
        $data['r_jul']= mprev::whereBetween('fecha_alta',[$year.'-07-01',$year.'-07-31'])->count();
        $data['r_ago']= mprev::whereBetween('fecha_alta',[$year.'-08-01',$year.'-08-31'])->count();
        $data['r_sep']= mprev::whereBetween('fecha_alta',[$year.'-09-01',$year.'-09-30'])->count();
        $data['r_oct']= mprev::whereBetween('fecha_alta',[$year.'-10-01',$year.'-10-31'])->count();
        $data['r_nov']= mprev::whereBetween('fecha_alta',[$year.'-11-01',$year.'-11-30'])->count();
        $data['r_dic']= mprev::whereBetween('fecha_alta',[$year.'-12-01',$year.'-12-31'])->count();

        
        $data['p_ene'] = ($data['ene'] > 0) ? round((($data['r_ene'] * 100) / $data['ene']),1) : 0; 
        $data['p_feb'] = ($data['feb'] > 0) ? round((($data['r_feb'] * 100) / $data['feb']),1) : 0; 
        $data['p_mar'] = ($data['mar'] > 0) ? round((($data['r_mar'] * 100) / $data['mar']),1) : 0; 
        $data['p_abr'] = ($data['abr'] > 0) ? round((($data['r_abr'] * 100) / $data['abr']),1) : 0; 
        $data['p_may'] = ($data['may'] > 0) ? round((($data['r_may'] * 100) / $data['may']),1) : 0; 
        $data['p_jun'] = ($data['jun'] > 0) ? round((($data['r_jun'] * 100) / $data['jun']),1) : 0; 
        $data['p_jul'] = ($data['jul'] > 0) ? round((($data['r_jul'] * 100) / $data['jul']),1) : 0; 
        $data['p_ago'] = ($data['ago'] > 0) ? round((($data['r_ago'] * 100) / $data['ago']),1) : 0; 
        $data['p_sep'] = ($data['sep'] > 0) ? round((($data['r_sep'] * 100) / $data['sep']),1) : 0; 
        $data['p_oct'] = ($data['oct'] > 0) ? round((($data['r_oct'] * 100) / $data['oct']),1) : 0; 
        $data['p_nov'] = ($data['nov'] > 0) ? round((($data['r_nov'] * 100) / $data['nov']),1) : 0; 
        $data['p_dic'] = ($data['dic'] > 0) ? round((($data['r_dic'] * 100) / $data['dic']),1) : 0; 

        $data['ene_color'] = admin_mantenimientos::color_progressbar($data['p_ene']);
        $data['feb_color'] = admin_mantenimientos::color_progressbar($data['p_feb']);
        $data['mar_color'] = admin_mantenimientos::color_progressbar($data['p_mar']);
        $data['abr_color'] = admin_mantenimientos::color_progressbar($data['p_abr']);
        $data['may_color'] = admin_mantenimientos::color_progressbar($data['p_may']);
        $data['jun_color'] = admin_mantenimientos::color_progressbar($data['p_jun']);
        $data['jul_color'] = admin_mantenimientos::color_progressbar($data['p_jul']);
        $data['ago_color'] = admin_mantenimientos::color_progressbar($data['p_ago']);
        $data['sep_color'] = admin_mantenimientos::color_progressbar($data['p_sep']);
        $data['oct_color'] = admin_mantenimientos::color_progressbar($data['p_oct']);
        $data['nov_color'] = admin_mantenimientos::color_progressbar($data['p_nov']);
        $data['dic_color'] = admin_mantenimientos::color_progressbar($data['p_dic']);

        $data['una'] = mprev::where('estrellas',1)->whereBetween('fecha_alta',[$year.'-01-01' ,$year.'-01-31'])->count();
        $data['dos'] = mprev::where('estrellas',2)->whereBetween('fecha_alta',[$year.'-01-01' ,$year.'-01-31'])->count();
        $data['tres'] = mprev::where('estrellas',3)->whereBetween('fecha_alta',[$year.'-01-01' ,$year.'-01-31'])->count();
        $data['cuatro'] = mprev::where('estrellas',4)->whereBetween('fecha_alta',[$year.'-01-01' ,$year.'-01-31'])->count();
        $data['cinco'] = mprev::where('estrellas',5)->whereBetween('fecha_alta',[$year.'-01-01' ,$year.'-01-31'])->count();
        $data['mes'] = "01";
        
        $data['msj'] = "Actualizando reporte al año ".$year;

        return json_encode($data);
    }

    public function agregar_xmls()
    {
        echo view('admin/nav', ['text' => "Agregar XML"]);

        $usuarios = usuarios_infeq::where("Estatus", "A")->get();
        echo view('admin_secciones/agregar_xml', ['usuarios' => $usuarios]);
    }

    public function carga_xmls(Request $request)
    {     
        $num = count($_FILES['files']['name']);

        $equipos= array();
        $errores = 0;
        $error = Array();
        if($request->hasfile('files'))
        {   
            for($i=0; $i < $num; $i++)
            {
                try
                {
                    $path = public_path()."/xml/".time()."_".$_FILES['files']['name'][$i];
                    $tmp = $_FILES['files']['tmp_name'][$i];
                    if(move_uploaded_file($tmp, $path))
                    {              
                        $xml = simplexml_load_file($path);

                        $pc = $xml->DatosPC;
                        $usuario = $xml->DatosPC->DatosUser;
                        $macs = $xml->DatosPC->MacAddress;

                        $sirac = sirac::where('no_serie', $pc->NumerodeSerie)->first();
                        $fecha = explode("/", $pc->Fecha);

                        
                        $macaddress_implode = Array();
                        foreach($macs->Interfase as $mac)
                        {
                            $macaddress_implode[] = $mac->Nombre.": ".$mac->Mac;
                        }

                        $infeq = new equipos;
                        
                        $infeq->uid = intval($request->usuario);
                        $infeq->nombreequipo =  $pc->NombreEquipo;
                        $infeq->marca =  $pc->Marca;
                        $infeq->modelo =  $pc->Modelo;
                        $infeq->usuario =  $pc->Usuario;
                        $infeq->tipo =  $pc->Tipo;
                        $infeq->ram =  $pc->RAM;

                        $infeq->ddtotal =  $pc->DiscoDuro->DDTotal;
                        $infeq->ddlibre =  $pc->DiscoDuro->DDLibre;

                        $infeq->so =  $pc->SistemaOperativo;
                        $infeq->licenciaso =  $pc->LicenciaSO;
                        $infeq->procesador =  $pc->Procesador;
                        $infeq->arquitectura =  $pc->Arquitectura;
                        $infeq->numeroserie =  $pc->NumerodeSerie;
                        
                        $infeq->empresa =  $usuario->Empresa;
                        $infeq->departamento =  $usuario->Departamento;
                        $infeq->base =  $usuario->Base;
                        $infeq->nombre =  $usuario->Usuario;

                        $infeq->fechainicio =  $pc->FechaInicio;
                        $infeq->fechatermino =  $pc->FechaTermino;
                        $infeq->horainicio =  $pc->HoraInicio;
                        $infeq->horatermino =  $pc->HoraTermino;
                        $infeq->fecha =  $pc->Fecha;
                        $infeq->hora =  $pc->Hora;

                        $infeq->mes = $fecha[1];
                        $infeq->year = $fecha[2];
                        $infeq->observaciones = $pc->Observaciones;
                        $infeq->mantenimiento = $pc->Mantenimiento;
                        $infeq->noactivo = (isset($sirac->codigo)) ? $sirac->codigo : "S/N";

                        $infeq->save();
                        //$infeq->XID = 20968;
                        
                        $equipos[$i] = $infeq;
                        $equipos[$i]['xid'] = $infeq->XID;
                        $equipos[$i]['macs'] = implode("|", $macaddress_implode);
                        
                        if(!is_null($infeq->XID))
                        {
                            foreach($macs->Interfase as $mac)
                            {
                                $macaddress = new MacAddress;
                                $macaddress->xid = $infeq->XID;
                                $macaddress->Nombre = $mac->Nombre;
                                $macaddress->Address = $mac->Mac;
                                $macaddress->save();
                            }
                        }

                        $mprev = new mprev;
                        $mprev->xid = $infeq->XID;
                        $mprev->nip = random_int(1000,9999);
                        $mprev->fecha_alta = date('Y-m-d');
                        $mprev->estatus = 0;
                        $mprev->tecnico = $request->usuario;
                        $mprev->correo = $pc->correo;
                        $mprev->save();
                    }
                }
                catch(Exception $e)
                {
                    $errores++;
                    $error[] = $_FILES['files']['name'][$i].": ".$e->getMessage();
                }
                File::delete($path);
            }
        }
        
        $data = Array(
            "error" => $errores,
            "errormsj" => $error,
            "xml" => $equipos
        );
        return view("admin_secciones/xml_cargados", $data);
    }

    function crearpdf(Request $request)
    {
        try
        {
            $infeq = equipos::where('XID', $request->xid)->first();
            $pdf = app('dompdf.wrapper');
            
            $mprev = mprev::where('xid', $infeq->XID)->first();

            $pdf = $pdf->loadView('admin/crearpdf', ["infeq" => $infeq]);

            $data["email"] = $mprev->correo;
            $data["title"] = "Mantenimiento Realizado";
            $data["nip"] = $mprev->nip;
            $data["mid"] = $mprev->mid;

            Mail::send('admin/mail', $data, function($message)use($data, $pdf, $infeq) {
                $message->to($data["email"], $data["email"])
                        ->subject($data["title"])
                        ->attachData($pdf->output(), $infeq->tipo."_".$infeq->nombreequipo."_".$infeq->numeroserie.".pdf");
            });

            if(Mail::failures()) 
            {
                $status = "ERROR";
                $msj = "Error al enviar correo.";
            }
            else
            {
                $status = "OK";
                $msj = "Correo enviado a ".$mprev->correo;
            }

            $data = Array(
                "status"   =>  $status,
                "msj"   =>  $msj
            );
        }
        catch(Exception $e)
        {
            $data = Array(
                "status"   =>  "ERROR",
                "msj"   =>  $e->getMessage()
            );
        }
        return response()->json($data);
    }
}
