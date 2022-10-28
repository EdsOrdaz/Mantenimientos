<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BAJA DE ARCHIVO</title>
    <style>
        @media print
        {
            table {
                page-break-inside:avoid
            }
        }
        td {
            border-collapse: collapse;
            text-align: center;
            font-size: 11pt;
            font-family: "Calibri, sans-serif";
            border: 0.5px solid black;
        }
        .table1{
            position: relative;
            margin-left: auto;
            margin-right: auto;
            width: 80%;
            border-collapse: collapse;
        }
        .td1{
            width: 30%;
        }
        .det{
            padding: 15px;
        }
        .obs{
            padding: 25px;
        }
    </style>
</head>
<body>
    
    @foreach ($equipos as $equipo)
        
    <table class="table1">
        <tr>
            <td colspan="2">VENTA DE EQUIPO DE COMPUTO</td>
        </tr>
        <tr>
            <td class="td1">EQUIPO</td>
            <td>{{$equipo->tipo}}</td>
        </tr>
        <tr>
            <td class="td1">MARCA</td>
            <td>{{$equipo->marca}}</td>
        </tr>
        <tr>
            <td class="td1">MODELO</td>
            <td>{{$equipo->modelo}}</td>
        </tr>
        <tr>
            <td class="td1">NÚMERO SERIE</td>
            <td>{{$equipo->numeroserie}}</td>
        </tr>
        <tr>
            <td class="td1">NÚMERO ECONOMICO</td>
            <td>{{$equipo->noactivo}}</td>
        </tr>
        <tr>
            <td class="td1">MEMORIA RAM</td>
            <td class="det">{{$equipo->ram}} MB</td>
        </tr>
        <tr>
            <td class="td1">DISCO DURO</td>
            <td class="det">{{$equipo->ddtotal}} GB</td>
        </tr>
        <tr>
            <td class="td1">PROCESADOR</td>
            <td class="det">{{$equipo->procesador}}</td>
        </tr>
        <tr>
            <td class="td1">SISTEMA OPERATIVO</td>
            <td class="det">{{$equipo->so}}</td>
        </tr>
        <tr>
            <td class="td1 det">PRECIO</td>
            <td class="det">{{$equipo->precio}}</td>
        </tr>
        <tr>
            <td class="td1 obs">OBSERVACIONES</td>
            <td class="det">{{$equipo->obs}}</td>
        </tr>
        <tr>
            <td COLSPAN="2">
                <div>
                    <img src="firma.png" style="position: absolute;margin-top: -40px;margin-left: -120px;" width="250px">    
                </div>
                <br><br><br><br><br>EDSON EDUARDO ORDAZ SANCHEZ</td>
        </tr>
        <tr>
            <td colspan="2">NOMBRE Y FIRMA DE QUIEN REALIZA EL REPORTE</td>
        </tr>
        </table>
    <br><br>
    @endforeach

</body>
</html>