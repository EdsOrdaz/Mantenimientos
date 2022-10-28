<section class="content">
    <div class="container-fluid">
      
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Ver Equipos</h3>
          </div>
          <div class="card-body">

            
            <div class="form-group" style="overflow-x: auto;">

              <table id="tablacampos" style="width:100%;">
                <tr>
                  <td>
                      <b>Usuario</b>:<br>
                      <input type="text" id="porusuario" value="{{$usuario}}" class="form-control">
                  </td>
                  <td>
                      <b>Marca:</b><br>
                      <input type="text" id="pormarca" value="{{$marca}}" class="form-control">
                  </td>
                  <td>
                      <b>Modelo:</b><br>
                      <input type="text" id="pormodelo" value="{{$modelo}}" class="form-control">
                  </td>
                  <td>
                      <b>Mes:</b><br>
                      <select id="mes" class="form-control">
                            <option value="00">Ninguno</option>
                            @foreach ($meses as $mes_nombre => $num)
                                    @if($mes == $num)
                                        <option value="{{$num}}" selected>{{$mes_nombre}}</option>
                                    @else
                                        <option value="{{$num}}">{{$mes_nombre}}</option>
                                    @endif
                            @endforeach
                      </select>
                  </td>
                  <td>
                      <b>Año:</b><br>
                        <select id="year" class="form-control">
                            <option value="0">Ninguno</option>
                        @foreach ($years as $y)
                            @if($year == $y)
                                <option value="{{$y}}" selected>{{$y}}</option>
                            @else
                                <option value="{{$y}}" >{{$y}}</option>
                            @endif
                        @endforeach
                        </select>
                  </td>
                  <td>
                      <b>Mantenimiento: </b><br>
                      <select id="mantenimiento" class="form-control">
                        <option value="0">Ninguno</option>
                        @foreach ($mantenimientos as $n => $text)
                            @if ($mantenimiento == $n)
                                <option value="{{$n}}" selected>{{$text}}</option>
                            @else
                                <option value="{{$n}}">{{$text}}</option>
                            @endif
                        @endforeach
                    </select>
                  </td>
                </tr>
                <tr>
                    <td>
                      <b>Economico</b>:<br>
                      <input type="text" id="poreconomico" value="{{$economico}}" class="form-control">
                  </td>
                  <td>
                      <b>Número de Serie:</b><br>
                      <input type="text" id="porserie" value="{{$serie}}" class="form-control">
                  </td>
                  <td>
                      <b>Departamento:</b><br>
                      <input type="text" id="pordepartamento" value="{{$departamento}}" class="form-control">
                  </td>
                  <td>
                      <b>Base:</b><br>
                      <input type="text" id="porbase" value="{{$base}}" class="form-control">
                  </td>
                  <td>
                      <b>Empresa:</b><br>
                      <input type="text" id="porempresa" value="{{$empresa}}" class="form-control">
                  </td>
                  <td>
                      <b>Mac Address:</b><br>
                      <input type="text" id="pormac" value="{{$mac}}" class="form-control">
                  </td>
                </tr>
                <tr>
                  <td colspan="6" valign="bottom" align="center">
                    <br>
                    <button id="botonbuscar" type="button" class="btn btn-block btn-info" style="width:300px;">Buscar</button>
                  </td>
                </tr>
              </table>
            </div>

            <div id="infeqbuscarcargando" class="card-body p-0">
              <center><br><br><br><img src="../images/buscardatos.gif\" width="30%"></center>
            </div>

            <div id="infeq_equipo" class="card-body p-0">
              <table id="example2" style="width:100%;" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="card-info" align="center">Nombre</th>
                    <th align="center">Economico</th>
                    <th align="center">Núm Serie</th>
                    <th align="center">Marca</th>
                    <th align="center">Modelo</th>
                    <th align="center">Fecha</th>
                    <th align="center">Observaciones TI</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($infeq as $equipo)
                        <tr id="td-{{$equipo->XID}}">
                            <td>{{$equipo->nombre}}</td>
                            <td>{{$equipo->noactivo}}</td>
                            <td data-toggle="modal" data-target="#infeq-{{$equipo->XID}}">{{$equipo->numeroserie}}</td>
                            <td data-toggle="modal" data-target="#infeq-{{$equipo->XID}}">{{$equipo->marca}}</td>
                            <td data-toggle="modal" data-target="#infeq-{{$equipo->XID}}">{{$equipo->modelo}}</td>
                            <td data-toggle="modal" data-target="#infeq-{{$equipo->XID}}">{{$equipo->fechainicio}}</td>
                            <td data-toggle="modal" data-target="#infeq-{{$equipo->XID}}">{{$equipo->observaciones}}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          




            @foreach ($infeq as $equipo)
                <div class="modal fade" id="infeq-{{$equipo->XID}}">
                    <div class="modal-dialog" style="max-width: 80%;">
                    <div class="modal-content">

                    <div id="loadmodal-{{$equipo->XID}}" style="display:none;" class="overlay">
                        <i class="fas fa-2x fa-sync fa-spin"></i>
                    </div>

                        <div class="modal-header">
                        <h4 class="modal-title">Información del Equipo - ID: {{$equipo->XID}}</h4>
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
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <ul>
                                            <li><b>Nombre del Equipo:</b> {{$equipo->nombreequipo}}</li> 
                                            <li><b>Marca:</b> {{$equipo->marca}}</li> 
                                            <li><b>Modelo:</b> {{$equipo->modelo}}</li> 
                                            <li><b>Tipo:</b> {{$equipo->tipo}}</li> 
                                            <li><b>Memoria RAM:</b> {{$equipo->ram}} MB</li> 
                                            <li><b>Espacio Total:</b> {{$equipo->ddtotal}} GB</li> 
                                            <li><b>Espacio Libre:</b> {{$equipo->ddlibre}} GB</li> 
                                            <li><b>Sistema Operativo:</b> {{$equipo->so}}</li> 
                                            <li><b>Licencia SO:</b> {{$equipo->licenciaso}}</li> 
                                            <li><b>Procesador:</b> {{$equipo->procesador}}</li> 
                                            <li><b>Arquitectura:</b> {{$equipo->arquitectura}}</li> 
                                            <li><b>Número de Serie:</b> {{$equipo->numeroserie}}</li> 
                                            <li><b>Número economico:</b> {{$equipo->noactivo}}</li> 
                                            </ul>
                                        </div>
                                        <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
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
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <ul>
                                                <li><b>Usuario</b></li>
                                                <ul>
                                                    <li><b>Nombre:</b> {{$equipo->nombre}}</li> 
                                                    <li><b>Base:</b> {{$equipo->base}}</li> 
                                                    <li><b>Departamento:</b> {{$equipo->departamento}}</li> 
                                                    <li><b>Empresa:</b> {{$equipo->empresa}}</li> 
                                                </ul>
                                                
                                                <br>
                                                
                                                @if ($equipo->mantenimiento == 1)
                                                    <li><b>Mantenimiento Correctivo</b></li>
                                                @endif   
                                                @if ($equipo->mantenimiento == 2)
                                                    <li><b>Mantenimiento Preventivo</b></li>
                                                @endif   
                                                @if ($equipo->mantenimiento == 3)
                                                    <li><b>Equipo Nuevo</b></li>
                                                @endif   
                                                @if ($equipo->mantenimiento == 4)
                                                    <li><b>Cambio de Equipo</b></li>
                                                @endif   
                                                <ul>
                                                    <li><b>Fecha:</b> {{$equipo->fechainicio}}</li> 
                                                </ul>

                                                <br>
                                                <li><b>Usuario que atendio este equipo</b></li>
                                                <ul>
                                                    @foreach ($usuarios as $user)
                                                        @if ($user->uid == $equipo->uid)
                                                            <li>{{$user->NombreCompleto}}</li>
                                                        @endif
                                                    @endforeach
                                                </ul>

                                                <br>
                                                <li><b>Observaciones:</b></li> 
                                                <ul>
                                                    <li id="obs_{{$equipo->XID}}">{{$equipo->observaciones}}</li>
                                                </ul>
                                            </ul>
                                        </div>
                                        <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
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
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                            <ul>
                                                <?php
                                                    $macs = explode("\n",$equipo->macs);
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
                        <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-sm-{{$equipo->XID}}">Eliminar</button>
                        <button type="button" class="btn btn-success" onclick="copiar({{$equipo->XID}})">Copiar Datos</button>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-obs-{{$equipo->XID}}">Obs InfEq</button>
                        <button type="button" class="btn btn-info obs_sirac" data-id="{{$equipo->noactivo}}" data-toggle="modal" data-target="#modal-obs-ti-{{$equipo->noactivo}}">Obs Sirac</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="modal fade" id="modal-sm-{{$equipo->XID}}">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-body">
                          <p>¿Eliminar registro de equipo con ID {{$equipo->XID}}?<br><br>¡Si cuenta con algun mantenimiento preventivo este tambien se eliminara!</p>
                        </div>
                        <div class="modal-footer" style="padding: 0px;">
                          <button type="button" class="btn btn-default" style="padding: 1%;" data-dismiss="modal">Cancelar</button>
                          <button type="button" class="btn btn-danger" style="padding: 1%;" data-dismiss="modal" onclick="eliminar({{$equipo->XID}});">Eliminar</button>
                        </div>
                      </div>
                    </div>
                </div>
                
                <div class="modal fade" id="modal-obs-{{$equipo->XID}}">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header" style="padding: 8px;">
                            <h4 class="modal-title">Observaciones InfEq</h4>
                          </div>
                        <div class="modal-body">
                            <textarea class="form-control" id="obs_update_{{$equipo->XID}}" rows="3">{{$equipo->observaciones}}</textarea>
                        </div>
                        <div class="modal-footer" style="padding: 0px;">
                          <button type="button" class="btn btn-default" style="padding: 1%;" data-dismiss="modal">Cancelar</button>
                          <button type="button" class="btn btn-success" style="padding: 1%;" data-dismiss="modal" onclick="obs_update({{$equipo->XID}});">Actualizar</button>
                        </div>
                      </div>
                    </div>
                </div>
                
                <div class="modal fade" id="modal-obs-ti-{{$equipo->noactivo}}">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-body">
                            <div class="modal-header" style="padding: 8px;">
                                <h4 class="modal-title">Observaciones Sirac</h4>
                              </div>
                            <textarea class="form-control" id="obs_update_ti_{{$equipo->noactivo}}" rows="3"></textarea>
                        </div>
                        <div class="modal-footer" style="padding: 0px;">
                          <button type="button" class="btn btn-default" style="padding: 1%;" data-dismiss="modal">Cancelar</button>
                          <button type="button" class="btn btn-success" style="padding: 1%;" data-dismiss="modal" onclick="obs_update_ti('{{$equipo->noactivo}}');">Actualizar</button>
                        </div>
                      </div>
                    </div>
                </div>
            @endforeach
        
        </div>

        <div id="copydatos" class="card-body">
        </div>

        <div id="overbuscar" class="overlay">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>  

        </div>
      </div>
      <!-- /.col (right) -->
    </div>
  </div>
  </div>
  <!-- /.container-fluid -->
</section>

<script>
function copyToClipboard(xid) 
{        
    var range = document.createRange();
    range.selectNode(document.getElementById("copydatos"));
    window.getSelection().removeAllRanges(); // clear current selection
    window.getSelection().addRange(range); // to select text
    document.execCommand("copy");
    window.getSelection().removeAllRanges();// to deselect
}

$(function(){

    $('.obs_sirac').click(function(){
        var id = $(this).attr('data-id');
        var formData = {
            eco: $(this).attr('data-id')
        };
        $.ajax({
            url  : "/infeq_sirac_obs",
            type : "GET",
            cache:	false,
            data : formData,
            success:function(result){
                $("#obs_update_ti_"+id).html(result);
            },
            error: function(){
            }
        });
    });

    $("#overbuscar").hide();
    $('#porfechas').daterangepicker();
    $("#copydatos").hide();
    $("#infeqbuscarcargando").hide();
    $('#example2').DataTable({
    "searching": true,
    "ordering": false,
    "responsive": false,
    "scrollX": true,
    "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, 'Todos'],
    ]
    });

    $("#tablacampos input[type='text']").on('keyup', function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
            $("#botonbuscar").click();
        }
    });

    $("#botonbuscar").click(function(){
        var formData = {
        usuario: $("#porusuario").val(),
        marca: $("#pormarca").val(),
        modelo: $("#pormodelo").val(),
        mes: $("#mes").val(),
        year: $("#year").val(),
        mantenimiento: $("#mantenimiento").val(),
        economico: $("#poreconomico").val(),
        serie: $("#porserie").val(),
        departamento: $("#pordepartamento").val(),
        base: $("#porbase").val(),
        empresa: $("#porempresa").val(),
        mac: $("#pormac").val()
        };
        $.ajax({
                url  : "/infeqbuscar",
                type : "GET",
                cache:	false,
                data : formData,
            beforeSend:function(){
                $("#botonbuscar").prop( "disabled", true );
                $("#infeq_equipo").hide();
                $("#infeqbuscarcargando").show();
                $("#overbuscar").show();
            },
            success:function(result){
                $("#botonbuscar").prop( "disabled", false );
                $("#infeq_equipo").show();
                $("#infeqbuscarcargando").hide();
                $("#contenido").html(result);
                $("#overbuscar").hide();
            },
            error: function(){
                $("#botonbuscar").prop( "disabled", false );
                $("#infeq_equipo").show();
                $("#infeqbuscarcargando").hide();
                $("#contenido").html(result);
                $("#overbuscar").hide();
            }
        });
    });
});

    var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000
        });
    
        function obs_update(id)
    {
        var formData = {
            id: id,
            obs: $("#obs_update_"+id).val()
        };
        $.ajax({
            url  : "/update_obs",
            type : "GET",
            cache:	false,
            data : formData,
            dataType: "json",
            beforeSend:function(){
                $("#loadmodal-"+id).show();
            },
            success:function(result){
                $("#loadmodal-"+id).hide();
                $("#obs_"+id).html($("#obs_update_"+id).val());
                Toast.fire({
                    icon: result.icon,
                    title: result.msj
                });
            },
            error: function(){
                Toast.fire({
                    icon: result.icon,
                    title: result.msj
                });
            }
        });
    } 
    function obs_update_ti(id)
    {
        var formData = {
            id: id,
            obs: $("#obs_update_ti_"+id).val()
        };
        $.ajax({
            url  : "/update_ti_obs",
            type : "GET",
            cache:	false,
            data : formData,
            dataType: "json",
            beforeSend:function(){
                $("#loadmodal-"+id).show();
            },
            success:function(result){
                $("#loadmodal-"+id).hide();
                Toast.fire({
                    icon: result.icon,
                    title: result.msj
                });
            },
            error: function(){
                Toast.fire({
                    icon: result.icon,
                    title: result.msj
                });
            }
        });
    } 
    
    function eliminar(id)
    {
        var formData = {
                id: id
        };
        $.ajax({
            url  : "/eliminarxid",
            type : "GET",
            cache:	false,
            data : formData,
            dataType: "json",
            beforeSend:function(){
                $("#loadmodal-"+id).show();
            },
            success:function(result){
                if(result.icon=='success')
                {
                    $("#infeq-"+id).modal('toggle');
                    $("#td-"+id).remove();
                }
                Toast.fire({
                    icon: result.icon,
                    title: result.msj
                });
            },
            error: function(){
                Toast.fire({
                    icon: result.icon,
                    title: result.msj
                });
            }
        });
    }

    function copiar(xid)
    {
        var formData = {
            id: xid
        }
        $.ajax({
            url  : "/copiar_infeq",
            type : "GET",
            cache:	false,
            data : formData,
            dataType: "json",
            success:function(result){
                $("#copydatos").show();
                $("#copydatos").html(result.texto);
                copyToClipboard(xid);
                $("#copydatos").hide();
                toastr.success('Datos copiados para enviar correo a '+result.nombre);
            },
            error: function(){
                alet('Error');
            }
        });
    }
</script>