<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento Realizado</title>

    <style>
        td {
            border-collapse: collapse;
            text-align: center;
            font-size: 11pt;
            font-family: "Calibri, sans-serif";
            padding: 10px;
            border: 0.5px solid black;
        }
        .tablelogo{
            border-collapse: collapse;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
        }
        .table1{
            margin-left: auto;
            margin-right: auto;
            width: 80%;
            border-collapse: collapse;
        }
        .tablefirma{
            margin-left: auto;
            margin-right: auto;
            width: 80%;
            border-collapse: collapse;
        }
        .tdorden{
            color: rgb(176, 176, 176);
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt;
            border: 0px;
            vertical-align:top;
        }
        .tdclave{
            color: rgb(176, 176, 176);
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 7pt;
            border: 0px;
            text-align: left;
        }
        .tdfirma{
            border: 0px;
        }
        .td1{
            width: 30%;
        }
    </style>
</head>
<body>
    
    <table class="tablelogo">
        <tr>
            <td class="tdfirma"><img src="{{public_path()}}/logo.png" width="45f" height="45f"></td>
            <td class="tdorden" width="60%">Orden de Servicio Preventivo</td>
            <td class="tdclave">Clave: Fr 13.1.1-F1<br>Versión: 3<br>Fecha: 16-03-2018</td>
        </tr>
    </table>
    <br>

    <table class="table1">
        <tr>
            <td class="td1">Responsable del<br>Mtto.</td>
            <td>EDSON EDUARDO ORDAZ SANCHEZ</td>
        </tr>
        <tr>
            <td class="td1">Nombre de Usuario</td>
            <td>{{$infeq->nombre}}</td>
        </tr>
        <tr>
            <td class="td1">Empresa</td>
            <td>{{$infeq->empresa}}</td>
        </tr>
        <tr>
            <td class="td1">Base</td>
            <td>{{$infeq->base}}</td>
        </tr>
        <tr>
            <td class="td1">Departamento</td>
            <td>{{$infeq->departamento}}</td>
        </tr>
        <tr>
            <td class="td1">Equipo</td>
            <td>{{$infeq->tipo}}</td>
        </tr>
        <tr>
            <td class="td1">Marca</td>
            <td>{{$infeq->marca}}</td>
        </tr>
        <tr>
            <td class="td1">Modelo</td>
            <td>{{$infeq->modelo}}</td>
        </tr>
        <tr>
            <td class="td1">Número de serie</td>
            <td>{{$infeq->numeroserie}}</td>
        </tr>
        <tr>
            <td class="td1">Número de activo</td>
            <td>{{$infeq->noactivo}}</td>
        </tr>
    </table>

    <br>

    <table class="table1">
        <tr>
            <td colspan="2">Software</td>
            <td colspan="2">Hardware</td>
        </tr>
        <tr>
            <td>Fecha y hora de <br>inicio de<br>Mantenimiento</td>
            <td>{{$infeq->fechainicio}}<br>{{$infeq->horainicio}}</td>
            <td>Fecha y hora de<br>inicio de<br>Mantenimiento</td>
            <td>{{$infeq->fechainicio}}<br>{{$infeq->horainicio}}</td>
        </tr>
        <tr>
            <td>Fecha y hora de <br>inicio de<br>Mantenimiento</td>
            <td>{{$infeq->fechatermino}}<br>{{$infeq->horatermino}}</td>
            <td>Fecha y hora de<br>inicio de<br>Mantenimiento</td>
            <td>{{$infeq->fechatermino}}<br>{{$infeq->horatermino}}</td>
        </tr>
        <tr>
            <td>Observaciones</td>
            <td colspan="3">{{$infeq->observaciones}}</td>
        </tr>
    </table>

    <br>

    <table class="tablefirma">
        <tr>
            <td width="50%" class="tdfirma"><img src="firma.png" width="50%"></td>
        </tr>
        <tr>
            <td class="tdfirma" style="vertical-align: bottom;padding: 0%;"><u>EDSON EDUARDO ORDAZ SANCHEZ</u></td>
        </tr>
        <tr>
            <td class="tdfirma" style="vertical-align: top;padding: 0%;">NOMBRE Y FIRMA DEL TECNICO</td>
        </tr>
    </table>

</body>
</html>