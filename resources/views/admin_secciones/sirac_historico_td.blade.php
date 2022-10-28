<script>
    $(function(){
        var table = $('#tablahistoricos').DataTable();
        table
            .clear()
            .draw();

        @foreach ($resguardos as $equipohistorico)
            @if(empty($equipohistorico->baja))
                table.row.add(["{{$equipohistorico->codigo}}","{{$equipohistorico->categoria}}","{{$equipohistorico->catmarca}}","{{$equipohistorico->modelo}}","{{$equipohistorico->no_serie}}","<?php echo date('Y/m/d', strtotime($equipohistorico->alta)); ?>","ASIGNADO","{{$equipohistorico->usuarioactual}}","{{$equipohistorico->obs}}","{{$equipohistorico->estatus}}","{{$equipohistorico->usuarioasigno}}","{{$equipohistorico->usuariodesasigno}}","<?php echo date('Y/m/d', strtotime($equipohistorico->fecha_reg)); ?>","{{$equipohistorico->usuarioregistro}}","<?php echo date('Y/m/d', strtotime($equipohistorico->fechadebaja)); ?>","{{$equipohistorico->usuariobaja}}","{{$equipohistorico->obsBaja}}</td>"]).draw(false);
            @else
                table.row.add(["{{$equipohistorico->codigo}}","{{$equipohistorico->categoria}}","{{$equipohistorico->catmarca}}","{{$equipohistorico->modelo}}","{{$equipohistorico->no_serie}}","<?php echo date('Y/m/d', strtotime($equipohistorico->alta)); ?>","<?php echo date('Y/m/d', strtotime($equipohistorico->baja)); ?>","{{$equipohistorico->usuarioactual}}","{{$equipohistorico->obs}}","{{$equipohistorico->estatus}}","{{$equipohistorico->usuarioasigno}}","{{$equipohistorico->usuariodesasigno}}","<?php echo date('Y/m/d', strtotime($equipohistorico->fecha_reg)); ?>","{{$equipohistorico->usuarioregistro}}","<?php echo date('Y/m/d', strtotime($equipohistorico->fechadebaja)); ?>","{{$equipohistorico->usuariobaja}}","{{$equipohistorico->obsBaja}}</td>"]).draw(false);
            @endif
        @endforeach
    });
</script>