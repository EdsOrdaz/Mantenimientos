<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mprev;
use App\Models\equipos;
Use \Carbon\Carbon;

class mid extends Controller
{
    public function id_mid($mid)
    {
        $query_mid = mprev::find(intval($mid));
        if(empty($query_mid->xid))
        {
            return view('no_existe');
        }
        else
        {
            $vista_data = Array(
                "mid"=> $mid, 
                "pin1" => "", 
                "pin2" => "", 
                "pin3" => "", 
                "pin4" => ""
            );
            return view('welcome', $vista_data);
        }
    }

    public function id_mid_nip($mid, $nip)
    {
        $query_mid = mprev::find(intval($mid));
        if(empty($query_mid->xid))
        {
            return view('no_existe',['nip'=>$nip]);
        }
        else
        {
            if(isset($nip))
            {
                $pin = str_split($nip);
                if(isset($pin[0]) && isset($pin[1]) && isset($pin[2]) && isset($pin[3]))
                {
                    $pin1 = intval($pin[0]);
                    $pin2 = intval($pin[1]);
                    $pin3 = intval($pin[2]);
                    $pin4 = intval($pin[3]);
                }
            }
            $vista_data = Array(
                "mid"=> $mid, 
                "nip"=>$nip, 
                "pin1"=>$pin1, 
                "pin2"=>$pin2, 
                "pin3"=>$pin3, 
                "pin4"=>$pin4
            );
            return view('welcome', $vista_data);
        }
    }

    public function validacion(Request $request)
    {
        $query = mprev::find(intval($request->mid));
        $query_infeq = equipos::where('xid',$query->xid)->first();
                
        if(empty($query_infeq))
        {
            return view('no_existe');
        }
        $pin = $request->p1.$request->p2.$request->p3.$request->p4;

        if($pin != $query->nip)
        {
            return "ERROR";
        }
        
        $comentariousuario = (is_null($query->comentario)) ? "" : $query->comentario;
        $js = (is_null($query->comentario)) ? "assets/js/comment.js" : "assets/js/comment_exists.js";

        $orang = "color:orange;";
        $s1 = "color:gray;";
        $s2 = "color:gray;";
        $s3 = "color:gray;";
        $s4 = "color:gray;";
        $s5 = "color:gray;";

        
        if($query->estrellas==1) { $s1 = $orang;}
        if($query->estrellas==2) { $s1 = $orang; $s2 = $orang;}
        if($query->estrellas==3) { $s1 = $orang; $s2 = $orang; $s3 = $orang;}
        if($query->estrellas==4) { $s1 = $orang; $s2 = $orang; $s3 = $orang; $s4 = $orang;}
        if($query->estrellas==5) { $s1 = $orang; $s2 = $orang; $s3 = $orang; $s4 = $orang; $s5 = $orang;}
        

        $vista_data = Array(
            "comentariousuario"=>$comentariousuario,
            "js"=> $js,
            "infeq"=> $query_infeq,
            "mid" => $query,
            "s1" => $s1,
            "s2" => $s2,
            "s3" => $s3,
            "s4" => $s4,
            "s5" => $s5
        );

        return view('tabla_mid', $vista_data);
    }

    
    public function insertar_comentario(Request $request)
    {
        $comentario = (isset($request->comentario)) ? trim(strtoupper($request->comentario)) : "SIN COMENTARIOS";
        $estrellas = intval($request->estrellas);
        if($estrellas<1)
        {
            $data['status'] = false;
            $data['mensaje'] = '¡Debes seleccionar un numero de estrella para calificar el servicio del mantenimiento!';
            
            return json_encode($data);
        }
        $insertar_data = Array(
            'estatus' => 1,
            'fecha_estatus' => Carbon::Now()->toDateString(),
            'comentario' => $comentario,
            'estrellas' =>  $estrellas
        );
        mprev::where('mid',intval($request->mid))->update($insertar_data);
        
        $result="";
        if($estrellas == 1)
        {
            $result = "<input type=\"radio\"><label style=\"color:orange;\"><font size=\"7\">★</font></label><input type=\"radio\"><label style=\"color:gray;\"><font size=\"7\">★</font></label><input type=\"radio\"><label style=\"color:gray;\"><font size=\"7\">★</font></label><input type=\"radio\"><label style=\"color:gray;\"><font size=\"7\">★</font></label><input type=\"radio\"><label style=\"color:gray;\"><font size=\"7\">★</font></label>";
        }
        if($estrellas == 2)
        {
            $result = "<input type=\"radio\"><label style=\"color:orange;\"><font size=\"7\">★</font></label><input type=\"radio\"><label style=\"color:orange;\"><font size=\"7\">★</font></label><input type=\"radio\"><label style=\"color:gray;\"><font size=\"7\">★</font></label><input type=\"radio\"><label style=\"color:gray;\"><font size=\"7\">★</font></label><input type=\"radio\"><label style=\"color:gray;\"><font size=\"7\">★</font></label>";
        }
        if($estrellas == 3)
        {
            $result = "<input type=\"radio\"><label style=\"color:orange;\"><font size=\"7\">★</font></label><input type=\"radio\"><label style=\"color:orange;\"><font size=\"7\">★</font></label><input type=\"radio\"><label style=\"color:orange;\"><font size=\"7\">★</font></label><input type=\"radio\"><label style=\"color:gray;\"><font size=\"7\">★</font></label><input type=\"radio\"><label style=\"color:gray;\"><font size=\"7\">★</font></label>";
        }
        if($estrellas == 4)
        {
            $result = "<input type=\"radio\"><label style=\"color:orange;\"><font size=\"7\">★</font></label><input type=\"radio\"><label style=\"color:orange;\"><font size=\"7\">★</font></label><input type=\"radio\"><label style=\"color:orange;\"><font size=\"7\">★</font></label><input type=\"radio\"><label style=\"color:orange;\"><font size=\"7\">★</font></label><input type=\"radio\"><label style=\"color:gray;\"><font size=\"7\">★</font></label>";
        }
        if($estrellas == 5)
        {
            $result = "<input type=\"radio\"><label style=\"color:orange;\"><font size=\"7\">★</font></label><input type=\"radio\"><label style=\"color:orange;\"><font size=\"7\">★</font></label><input type=\"radio\"><label style=\"color:orange;\"><font size=\"7\">★</font></label><input type=\"radio\"><label style=\"color:orange;\"><font size=\"7\">★</font></label><input type=\"radio\"><label style=\"color:orange;\"><font size=\"7\">★</font></label>";
        }
        $data['status'] = true;
        $data['mensaje'] = '¡Comentario guardado!';
        $data['estrellas'] = $result;
        $data['usuario'] = htmlspecialchars_decode($comentario);
        
        return json_encode($data);
    }
}
