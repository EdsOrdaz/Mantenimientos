<section class="content">
    <div class="container-fluid">
      
    <div class="row">
      <!-- /.col (left) -->
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Buscar Mantenimientos</h3>
          </div>
          <div class="card-body">

            
            <div class="form-group">

              <table style="width:100%;">
                <tr>
                  <td width="25%">
                   <b>Fechas</b>:<br>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="far fa-calendar-alt"></i>
                        </span>
                      </div>
                      <input type="text" value="{{$fecha_buscar}}" class="form-control" id="fechas">
                    </div>
                  </td>
                  <td width="25%">
                      <b>Usuario</b>:<br>
                      <input type="text" id="porusuario" value="{{$usuario}}" class="form-control">
                  </td>
                  <td width="25%">
                      <b>Economico:</b><br>
                      <input type="text" id="poreconomico" value="{{$economico}}" class="form-control">
                  </td>
                  <td width="25%">
                      <b>Base:</b><br>
                      <input type="text" id="porbase" value="{{$base}}" class="form-control">
                  </td>
                </tr>
                <tr>
                  <td colspan="4" valign="bottom" align="center">
                    <button id="botonbuscar" type="button" class="btn btn-block btn-info" style="width:250px;">Buscar</button>
                  </td>
                </tr>
              </table>
            </div>
            <!-- /.form group -->


            <!-- /.card-header -->
            <div id="manttosbuscar" class="card-body p-0">
              <center><br><br><br><img src="../images/buscardatos.gif\" width="30%"></center>
            </div>

            <div id="manttos" class="card-body p-0">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th align="center" style="width:5%;">Estatus</th>
                    <th align="center" style="width:10%;">Estrellas</th>
                    <th align="center" style="width:5%;">Economico</th>
                    <th align="center" style="width:8%;">Fecha</th>
                    <th>Usuario</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($mantenimiento as $mantto)
                  <tr data-toggle="modal" data-target="#modal-xl-{{$mantto->mid}}">
                    <td align="center" >
                      @if($mantto->estatus==0)
                        <span class="badge bg-danger" style="padding:6%;">Pendiente</span>
                      @else
                        <span class="badge bg-success" style="padding:6%;">Validado</span>
                      @endif
                    </td>
                    <td align="center">

                      @if ($mantto->estrellas == 0)
                        <span class="badge bg-warning" style="padding:3%;">Cierre Automatico</span>
                      @else
                        @for ($i = 1; $i <= 5; $i++)
                          @if ($i <= $mantto->estrellas)
                            <label style="color:orange;"><font size="5">★</font></label>
                          @else
                            <label style="color:gray;"><font size="5">★</font></label>
                          @endif
                        @endfor
                      @endif
                    </td>

                    <td align="center" >{{$mantto->noactivo}}</td>
                    <td align="center" >{{$mantto->fecha_alta}}</td>
                    <td>{{$mantto->nombre}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          
          @foreach ($mantenimiento as $mantto)
              <div class="modal fade" id="modal-xl-{{$mantto->mid}}">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Mantenimiento Preventivo Realizado</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      
                      <table style="width:100%;">
                        <tr>
                          <td width="50%">
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
                                      <li><b>Nombre del Equipo:</b> {{$mantto->nombreequipo}}</li> 
                                      <li><b>Marca:</b> {{$mantto->marca}}</li> 
                                      <li><b>Modelo:</b> {{$mantto->modelo}}</li> 
                                      <li><b>Tipo:</b> {{$mantto->tipo}}</li> 
                                      <li><b>Memoria RAM:</b> {{$mantto->ram}} MB</li> 
                                      <li><b>Espacio Total:</b> {{$mantto->ddtotal}} GB</li> 
                                      <li><b>Espacio Libre:</b> {{$mantto->ddlibre}} GB</li> 
                                      <li><b>Sistema Operativo:</b> {{$mantto->so}}</li> 
                                      <li><b>Licencia SO:</b> {{$mantto->licenciaso}}</li> 
                                      <li><b>Procesador:</b> {{$mantto->procesador}}</li> 
                                      <li><b>Arquitectura:</b> {{$mantto->arquitectura}}</li> 
                                      <li><b>Número de Serie:</b> {{$mantto->numeroserie}}</li> 
                                      <li><b>Número economico:</b> {{$mantto->noactivo}}</li> 
                                    </ul>
                                  </div>
                                  <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                              </div>
                          </td>
                          <td width="50%">
                              <div class="col-md-4" style="max-width:100%">
                                <div class="card">
                                  <div class="card-header">
                                    <h3 class="card-title">
                                      <i class="fas fa-user"></i>
                                      &nbsp;&nbsp;Datos del Usuario y del Mantenimiento
                                    </h3>
                                  </div>
                                  <!-- /.card-header -->
                                  <div class="card-body">
                                    <ul>
                                      <li><b>Usuario</b></li>
                                      <ul>
                                        <li><b>Usuario:</b> {{$mantto->nombre}}</li> 
                                        <li><b>Base:</b> {{$mantto->base}}</li> 
                                        <li><b>Departamento:</b> {{$mantto->departamento}}</li> 
                                        <li><b>Empresa:</b> {{$mantto->empresa}}</li> 
                                      </ul>
                                      <br>
                                      <li><b>Usuario que realizo el Mantenimiento</b></li>
                                      <ul>
                                          @foreach ($usuarios as $user)
                                            @if ($user->uid == $mantto->uid)
                                                <li>{{$user->NombreCompleto}}</li>
                                            @endif
                                          @endforeach
                                      </ul>
                                      <br>
                                      <li><b>Mantenimiento</b></li>
                                      <ul>
                                        <li><b>Fecha del mantenimiento:</b> {{$mantto->fechainicio}}</li> 
                                        <li><b>Hora de inicio del Mantenimiento:</b> {{$mantto->horainicio}}</li> 
                                        <li><b>Hora de termino del Mantenimiento:</b> {{$mantto->horatermino}}</li> 
                                      </ul>
                                    </ul>
                                  </div>
                                  <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                              </div>

                          </td>
                        </tr>
                        <tr>
                          <td width="100%" colspan="2">
                            <div class="col-md-4" style="max-width:100%">
                              <div class="card">
                                <div class="card-header">
                                  <h3 class="card-title">
                                    <i class="fas fa-comment"></i>
                                    &nbsp;&nbsp;Observaciones
                                  </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                  <ul>
                                    <li><b>Observaciones de sistemas:</b> {{$mantto->observaciones}}</li>
                                    <li><b>Observaciones del usuario:</b> {{$mantto->comentario}}</li>
                                  </ul>
                                </div>
                                <!-- /.card-body -->
                              </div>
                              <!-- /.card -->
                            </div>
                          </td>
                        </tr>
                      </table>

                      <br><br><br>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
          @endforeach


        </div>
      </div>
      <!-- /.col (right) -->
    </div>
  </div>
  </div>
  <!-- /.container-fluid -->
</section>

  <script>
    $(function () {
    $("#manttosbuscar").hide();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

      $('#fechas').daterangepicker();

      $("#botonbuscar").click(function(){
          var formData = {
            fechas: $("#fechas").val(),
            usuario: $("#porusuario").val(),
            economico: $("#poreconomico").val(),
            base: $("#porbase").val()
          };
          $.ajax({
                  url  : "/buscar",
                  type : "GET",
                  cache:	false,
                  data : formData,
                beforeSend:function(){
                    $("#manttos").hide();
                    $("#manttosbuscar").show();
                },
                success:function(result){
                    $("#manttos").show();
                    $("#manttosbuscar").hide();
                    $("#contenido").html(result);
                },
                error: function(result){
                    $("#manttos").show();
                    $("#manttosbuscar").hide();
                    $("#contenido").html(result);
                }
          });
      });
    })
  </script>