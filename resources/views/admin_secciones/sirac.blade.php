<section class="content">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Ver Resguardos</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <table id="tablacampos" style="width:100%;">
                                <tr>
                                    <td>
                                        <b>Buscar</b>:<br>
                                        <input type="text"  id="buscar" value="{{$buscar}}" class="form-control" style="flex:none; ">
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td colspan="6" valign="bottom" align="center">
                                    <br>
                                    <button id="botonbuscar" type="button" class="btn btn-block btn-primary" style="width:25%;">Buscar</button>
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>

                    <div id="overbuscar" class="overlay">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div>                      
                </div>
            </div>

            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Activos</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">

                            <table id="activos" style="width:100%;" class="table table-bordered table-hover nowrap">
                                <thead>
                                    <tr>
                                        <th>Economico</th>
                                        <th>Categoria</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>Serie</th>
                                        <th>Registro</th>
                                        <th>Asignado</th>
                                        <th>Usuario</th>
                                        <th>Observaciones</th>
                                        <th>Observaciones TI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($sirac))
                                        @foreach ($sirac as $equipo)
                                        <tr ondblclick="copysirac('{{$equipo['descripcion']}}', '{{$equipo['No. Activo']}}', '{{$equipo['marca']}}', '{{$equipo['modelo']}}', '{{$equipo['No. Serie']}}')">
                                            <td><a onclick="historico('{{$equipo['No. Activo']}}')"><cursora>{{$equipo['No. Activo']}}</cursora></td>
                                            <td>{{$equipo['descripcion']}}</td>
                                            <td>{{$equipo['marca']}}</td>
                                            <td>{{$equipo['modelo']}}</td>
                                            <td>{{$equipo['No. Serie']}}</td>
                                            <td><?php echo date('Y/m/d', strtotime($equipo['Fecha Reg. Equipo'])); ?></td>
                                            
                                            <td><?php echo date('Y/m/d', strtotime($equipo['Fecha Asignación'])); ?></td>
                                            <td><a onclick="historico('{{$equipo['Nombre de Resguardatario']}}')"><cursora>{{$equipo['Nombre de Resguardatario']}}</cursora></td>
                                            <td>{{$equipo['Observaciones']}}</td>
                                            <td id="obs_{{$equipo['No. Activo']}}" data-toggle="modal" data-target="#modal-obs-{{$equipo['No. Activo']}}">{{$equipo['obs_ti']}}</td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="overactivos" class="overlay">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div>  
                </div>
            </div>

            <div class="col-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Historico</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <table id="tablahistoricos" style="width:100%;" class="table table-bordered table-hover nowrap">
                                <thead>
                                    <tr>
                                        <th>Economico</th>
                                        <th>Categoria</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>Núm. Serie</th>
                                        <th>Asignado</th>
                                        <th>Desasignado</th>
                                        <th>Usuario</th>
                                        <th>Observaciones</th>
                                        <th>Estatus</th>
                                        <th>Usuario que lo asigno</th>
                                        <th>Usuario que desasigno</th>
                                        <th>Fecha Registro</th>
                                        <th>Usuario que registro</th>
                                        <th>Fecha de Baja</th>
                                        <th>Usuario que dio de Baja</th>
                                        <th>Observaciones de Baja</th>
                                    </tr>
                                </thead>
                                <tbody id="tdhistorico">
                                    @if (!empty($historico))
                                        @foreach ($historico as $equipohistorico)
                                            <tr>
                                                <td>{{$equipohistorico->codigo}}</td>
                                                <td>{{$equipohistorico->categoria}}</td>
                                                <td>{{$equipohistorico->catmarca}}</td>
                                                <td>{{$equipohistorico->modelo}}</td>
                                                <td>{{$equipohistorico->no_serie}}</td>
                                                <td><?php echo date('Y/m/d', strtotime($equipohistorico->alta)); ?></td>
                                        
                                                @if (empty($equipohistorico->baja))
                                                    <td>ASIGNADO</td>          
                                                @else
                                                    <td><?php echo date('Y/m/d', strtotime($equipohistorico->baja)); ?></td>
                                                @endif
                                        
                                                <td>{{$equipohistorico->usuarioactual}}</td>
                                                <td>{{$equipohistorico->obs}}</td>
                                                <td>{{$equipohistorico->estatus}}</td>
                                                
                                                
                                                <td>{{$equipohistorico->usuarioasigno}}</td>
                                                <td>{{$equipohistorico->usuariodesasigno}}</td>

                                                <td><?php echo date('Y/m/d', strtotime($equipohistorico->fecha_reg)); ?></td>
                                                <td>{{$equipohistorico->usuarioregistro}}</td>
                                                
                                                <td><?php echo date('Y/m/d', strtotime($equipohistorico->fechadebaja)); ?></td>
                                                <td>{{$equipohistorico->usuariobaja}}</td>
                                                <td>{{$equipohistorico->obsBaja}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="overhistorico" class="overlay">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>

@if (!empty($sirac))
    @foreach ($sirac as $equipo)
    <div class="modal fade" id="modal-obs-{{$equipo['No. Activo']}}">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-body">
                <textarea class="form-control" id="obs_ti_update_{{$equipo['No. Activo']}}" rows="3">{{$equipo->obs_ti}}</textarea>
            </div>
            <div class="modal-footer" style="padding: 0px;">
              <button type="button" class="btn btn-default" style="padding: 1%;" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-success" style="padding: 1%;" data-dismiss="modal" onclick="obs_ti_update('{{$equipo['No. Activo']}}');">Actualizar</button>
            </div>
          </div>
        </div>
    </div>
    @endforeach
@endif
<script>
function copysirac(tipo, activo, marca, modelo, serie)
{
    var dummy = document.createElement("textarea");
    document.body.appendChild(dummy);
    text = "- EQUIPO: "+tipo+"\n- ECONÓMICO: "+activo+"\n- MARCA: "+marca+"\n- MODELO: "+modelo+"\n- NÚM DE SERIE: "+serie+"\n\n";

    dummy.value = text;
    dummy.select();
    document.execCommand("copy");
    document.body.removeChild(dummy);
    text2 = text.replaceAll("\n", "<br>");
    toastr.success('DATOS COPIADOS.<br><br>'+text2);
    console.log(text2);
}

function historico(text)
{
    var table = $('#tablahistoricos').DataTable();
    var formData = {
        buscar: text
    };
    $.ajax({
        url  : "/sirac_buscar_historico",
        type : "GET",
        cache:	false,
        data : formData,
        beforeSend:function(){
            $("#overhistorico").show();
            $("#overactivos").show();
        },
        success:function(result){
            $("#tdhistorico").html(result);
            $("#overhistorico").hide();
            $("#overactivos").hide();

            $('html, body').animate({
                scrollTop: $("#tablahistoricos").offset().top
            }, 2000);

        },
        error: function() {
            alert('ERROR');
        }
    });
}

var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 4000
});

function obs_ti_update(id)
{
    var formData = {
        id: id,
        obs: $("#obs_ti_update_"+id).val()
    };
    $.ajax({
        url  : "/update_ti_obs",
        type : "GET",
        cache:	false,
        data : formData,
        dataType: "json",
        beforeSend:function(){
            $("#overactivos").show();
            $("#overbuscar").show();
        },
        success:function(result){
            $("#obs_"+id).html($("#obs_ti_update_"+id).val());
            Toast.fire({
                icon: result.icon,
                title: result.msj
            });
            $("#overactivos").hide();
            $("#overbuscar").hide();
        },
        error: function(){
            Toast.fire({
                icon: result.icon,
                title: result.msj
            });
            $("#overactivos").hide();
            $("#overbuscar").hide();
        }
    });
} 
$(function () {
    $("#overbuscar").hide();
    $("#overactivos").hide();
    $("#overhistorico").hide();

    $("#buscar").on('keyup', function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
            $("#botonbuscar").click();
        }
    });

    $('#activos').DataTable({
        "searching": true,
        "ordering": true,
        "responsive": false,
        "scrollX": true,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, 'Todos'],
        ]
    });
    $('#tablahistoricos').DataTable({
        "searching": true,
        "ordering": true,
        "responsive": false,
        "scrollX": true,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, 'Todos'],
        ]
    });

    $("#botonbuscar").click(function(){
        var formData = {
            buscar: $("#buscar").val()
        };
        $.ajax({
            url  : "/sirac_buscar",
            type : "GET",
            cache:	false,
            data : formData,
            beforeSend:function(){
                $("#overbuscar").show();
                $("#overactivos").show();
                $("#overhistorico").show();
            },
            success:function(result){
                $("#contenido").html(result);
            },
            error: function(result){
            }
        });
    });
});