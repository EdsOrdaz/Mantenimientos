<div class="col-12">
    <div class="card card-outline card-info">
     
      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Creado</th>
                    <th>Permisos</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($users as $user)
                  <tr data-toggle="modal" data-target="#modal-lg-{{$user->id}}">
                      <td>{{$user->name}}</td>
                      <td>{{$user->email}}</td>
                      <td>{{$user->created_at}}</td>
                      
                      <?php 
                          $permisos = explode("|",$user->permisos);
                          $p = Array();
                          if(!empty($permisos[0])){ $p[] = "Mantenimientos";}
                          if(!empty($permisos[1])){ $p[] = "Usuarios";}
                          if(!empty($permisos[2])){ $p[] = "InfEq";}
                          if(!empty($permisos[3])){ $p[] = "Configuración";}

                          if(!empty($p))
                          {
                            $perm = implode(", ", $p);
                          }else{
                            $perm = "Ninguno";
                          }
                      ?>
                      <td>{{$perm}}</td>
                    </tr>
                  @endforeach

                </tbody>
              </table>
            </div>



            @foreach ($users as $u)
            <div class="modal fade" id="modal-lg-{{$u->id}}">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Editar Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <table width="100%">
                      <tr>
                        <td width="10%">
                          <label>Nombre: </label>
                        </td>
                        <td>
                          <input type="text" value="{{$u->name}}" class="form-control" id="nombre-{{$u->id}}" placeholder="Enter email">
                        </td>
                      </tr>
                      <tr>
                        <td width="10%">
                          <label>Email: </label>
                        </td>
                        <td>
                          <input type="text"  value="{{$u->email}}" class="form-control" id="email-{{$u->id}}" placeholder="Enter email">
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2" align="center">
                          <?php 
                              $permisos = explode("|",$u->permisos);
                              $mantto = (!empty($permisos[0])) ? $permisos[0] : "";
                              $usuarios = (!empty($permisos[1])) ? $permisos[1] : "";
                              $infeq = (!empty($permisos[2])) ? $permisos[2] : "";
                              $configuracion = (!empty($permisos[3])) ? $permisos[3] : "";
                          ?>
                          <br>
                          <input class="custom-control-input" type="checkbox" id="mantenimiento-{{$u->id}}" {{$mantto}}>
                          <label for="mantenimiento-{{$u->id}}" class="custom-control-label">Mantenimientos
                            &emsp;&emsp;
                          <input class="custom-control-input" type="checkbox" id="usuarios-{{$u->id}}" {{$usuarios}}>
                          <label for="usuarios-{{$u->id}}" class="custom-control-label">Usuarios
                            &emsp;&emsp;
                          <input class="custom-control-input" type="checkbox" id="infeq-{{$u->id}}" {{$infeq}}>
                          <label for="infeq-{{$u->id}}" class="custom-control-label">InfEq
                            &emsp;&emsp;
                          <input class="custom-control-input" type="checkbox" id="config-{{$u->id}}" {{$configuracion}}>
                          <label for="config-{{$u->id}}" class="custom-control-label">Configuración
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2" align="center">
                          <br>
                          <button type="button" id="update-{{$u->id}}" class="btn btn-info" onclick="actualizar({{$u->id}});" style="width:15%;">Actualizar</button>
                          &emsp;&emsp;
                          <button type="button" id="delete-{{$u->id}}" class="btn btn-danger" data-toggle="modal" data-target="#modal-sm-{{$u->id}}" style="width:15%;">Eliminar</button>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="modal-sm-{{$u->id}}">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-body">
                    <p>¿Eliminar a {{$u->name}}?</p>
                  </div>
                  <div class="modal-footer" style="padding: 0px;">
                    <button type="button" class="btn btn-default" style="padding: 1%;" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" style="padding: 1%;" data-dismiss="modal" onclick="eliminar({{$u->id}});">Eliminar</button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            @endforeach



          </div>
        </div>
      </div>
    </div>
</div>

<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
      });
      function eliminar(id)
      {
          var formData = {
                id: id
          };
          $.ajax({
                  url  : "/eliminarusuario",
                  type : "GET",
                  cache:	false,
                  data : formData,
                  dataType: "json",
                success:function(result){
                    Toast.fire({
                    icon: result.icon,
                    title: result.msj
                  });
                }
          });
      }
      function actualizar(id)
      {
          var formData = {
              id: id,
              nombre: $("#nombre-"+id).val(),
              email: $("#email-"+id).val(),
              mantenimiento: $("#mantenimiento-"+id+":checked").val(),
              usuarios: $("#usuarios-"+id+":checked").val(),
              infeq: $("#infeq-"+id+":checked").val(),
              config: $("#config-"+id+":checked").val()
            };
            $.ajax({
                    url  : "/actualizarusuario",
                    type : "GET",
                    cache:	false,
                    data : formData,
                    dataType: "json",
                  success:function(result){
                      Toast.fire({
                      icon: result.icon,
                      title: result.msj
                    });
                  }
            });
      }
</script>