@if ($error > 0)
<div class="card card-outline card-danger">
    <div class="card-header">
      <h3 class="card-title">Errores al cargar XML</span></h3>
    </div>

    <div id="infeq_errores" class="card-body p-0">
        <table class="table table-bordered table-hover">
          <tbody>
            @foreach ($errormsj as $msj)
                  <tr>
                      <td>{{$msj}}</td>
                 </tr>
            @endforeach
          </tbody>
        </table>
      </div>
  </div>
@endif

<div class="card card-outline card-warning">
    <div class="card-header">
      <h3 class="card-title"> XML Cargados</span></h3>
    </div>

    <div id="infeq_equipo" class="card-body p-0">
        <table id="example2" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th align="center">Nombre</th>
              <th align="center" style="width:8%;">Nombre PC</th>
              <th align="center" style="width:8%;">Economico</th>
              <th align="center" style="width:8%;">Núm Serie</th>
              <th align="center" style="width:8%;">Marca</th>
              <th align="center" style="width:12%;">Modelo</th>
              <th align="center" style="width:8%;">Base</th>
              <th align="center" style="width:8%;">Fecha</th>
              <th align="center" style="width:8%;">Correo</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($xml as $equipo)
                  <tr>
                      <td data-toggle="modal" data-target="#mprev-{{$equipo['xid']}}">{{$equipo['nombre']}}</td>
                      <td align="center" data-toggle="modal" data-target="#mprev-{{$equipo['xid']}}">{{$equipo['nombreequipo']}}</td>
                      <td align="center" data-toggle="modal" data-target="#mprev-{{$equipo['xid']}}">{{$equipo['noactivo']}}</td>
                      <td align="center" data-toggle="modal" data-target="#mprev-{{$equipo['xid']}}">{{$equipo['numeroserie']}}</td>
                      <td align="center" data-toggle="modal" data-target="#mprev-{{$equipo['xid']}}">{{$equipo['marca']}}</td>
                      <td align="center" data-toggle="modal" data-target="#mprev-{{$equipo['xid']}}">{{$equipo['modelo']}}</td>
                      <td align="center" data-toggle="modal" data-target="#mprev-{{$equipo['xid']}}">{{$equipo['base']}}</td>
                      <td align="center" data-toggle="modal" data-target="#mprev-{{$equipo['xid']}}">{{$equipo['fecha']}}</td>
                      <td align="center"><button type="button" id="send_{{$equipo['xid']}}" onclick="enviarcorreo({{$equipo['xid']}})" class="btn btn-block btn-info"><i class="fas fa-envelope"></i></button></td>
                  </tr>
            @endforeach
          </tbody>
        </table>
      </div>
  </div>






  @foreach ($xml as $equipo)
  <div class="modal fade" id="mprev-{{$equipo['xid']}}">
      <div class="modal-dialog" style="max-width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Información del Equipo - ID: {{$equipo['xid']}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            
            <table style="width:100%;">
                <tr>
                    <td width="33%" valign="top">
                        <div class="col-md-4" style="max-width:100%">
                            <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="far fa-desktop"></i>
                                &nbsp;&nbsp;Datos del equipo
                                </h3>
                            </div>
                            <div class="card-body">
                                <ul>
                                <li><b>Nombre del Equipo:</b> {{$equipo['nombreequipo']}}</li> 
                                <li><b>Marca:</b> {{$equipo['marca']}}</li> 
                                <li><b>Modelo:</b> {{$equipo['modelo']}}</li> 
                                <li><b>Tipo:</b> {{$equipo['tipo']}}</li> 
                                <li><b>Memoria RAM:</b> {{$equipo['ram']}} MB</li> 
                                <li><b>Espacio Total:</b> {{$equipo['ddtotal']}} GB</li> 
                                <li><b>Espacio Libre:</b> {{$equipo['ddlibre']}} GB</li> 
                                <li><b>Sistema Operativo:</b> {{$equipo['so']}}</li> 
                                <li><b>Licencia SO:</b> {{$equipo['licenciaso']}}</li> 
                                <li><b>Procesador:</b> {{$equipo['procesador']}}</li> 
                                <li><b>Arquitectura:</b> {{$equipo['arquitectura']}}</li> 
                                <li><b>Numero de Serie:</b> {{$equipo['numeroserie']}}</li> 
                                </ul>
                            </div>
                            </div>
                        </div>
                    </td>
                    <td width="33%" valign="top">
                        <div class="col-md-4" style="max-width:100%">
                            <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-user"></i>
                                &nbsp;&nbsp;Datos del Usuario
                                </h3>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li><b>Usuario</b></li>
                                    <ul>
                                        <li><b>Nombre:</b> {{$equipo['nombre']}}</li> 
                                        <li><b>Base:</b> {{$equipo['base']}}</li> 
                                        <li><b>Departamento:</b> {{$equipo['departamento']}}</li> 
                                        <li><b>Empresa:</b> {{$equipo['empresa']}}</li> 
                                    </ul>
                                    
                                    <br>
                                    
                                    @if ($equipo['mantenimiento'] == 1)
                                        <li><b>Mantenimiento Correctivo</b></li>
                                    @endif   
                                    @if ($equipo['mantenimiento'] == 2)
                                        <li><b>Mantenimiento Preventivo</b></li>
                                    @endif   
                                    @if ($equipo['mantenimiento'] == 3)
                                        <li><b>Equipo Nuevo</b></li>
                                    @endif   
                                    @if ($equipo['mantenimiento'] == 4)
                                        <li><b>Cambio de Equipo</b></li>
                                    @endif   
                                    <ul>
                                        <li><b>Fecha:</b> {{$equipo['fechainicio']}}</li> 
                                    </ul>
    
                                    <br>
                                    <li><b>Observaciones:</b></li> 
                                    <ul>
                                        <li>{{$equipo['observaciones']}}</li>
                                    </ul>
                                </ul>
                            </div>
                            </div>
                        </div>
    
                    </td>
    
                    <td width="33%" valign="top">
                        <div class="col-md-4" style="max-width:100%">
                            <div class="card">
                                <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-network-wired"></i>
                                    &nbsp;&nbsp;Mac Address
                                </h3>
                                </div>
                                <div class="card-body">
                                    <ul>
                                        <?php
                                            $macs = explode("|",$equipo['macs']);
                                        ?>
                                        @foreach ($macs as $macaddress)
                                            @if (!empty($macaddress))
                                            <li>{{$macaddress}}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
    
            <br><br><br>
            </div>
        </div>
      </div>
  </div>
  @endforeach



<script>
function enviarcorreo(id)
{
    var formData = {
        xid: id
    };
    $.ajax({
        url  : "/crearpdf",
        type : "GET",
        cache:	false,
        data : formData,
        dataType: "json",
		beforeSend:function(){
			$('#send_'+id).prop('disabled', true);
		},
        success:function(result){
            if(result.status == "OK")
            {
                toastr.success(result.msj);
            }else{
                toastr.error(result.msj);
            }
			$('#send_'+id).prop('disabled', false);
        },
        error:function(){
            toastr.error("Error al enviar correo.");
        }
    });
}
</script>