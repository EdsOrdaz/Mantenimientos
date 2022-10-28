
<div class="col-md-12">
    <div class="card card-outline card-info">
        <div class="card-header">
          <h3 class="card-title"> Cargar XML</span></h3>
        </div>

        <form id="enviarxml" enctype="multipart/form-data" method="post">
            <div class="card-body">
                <div class="row" style="display: inline;">
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="files[]" id="files" class="custom-file-input" accept="text/xml" lang="es" multiple>
                            <label class="custom-file-label" style="width:30%">Seleccionar Archivos</label>
                        </div>
                            @csrf
                    </div>

                    <br>

                    <div id="tecnico" class="callout callout-info" style="width:30%;">
                        <h6>Usuario que realizo los mantenimientos.</h6>
                        <h3><p id="tecnombre"></p></h3>
                    </div>

                </div>
            </div>
        </form>
      </div>

      <div id="cargandoxml" class="card-body p-0">
        <center><br><br><br><img src="../images/xml.gif\" width="20%"></center>
      </div>

    <div id="xmlcargados"></div>


    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-body">
              <p>Selecciona el usuario que realizo los mantenimientos.</p>
              <select class="form-control" id="usuario">
                <option value="0"></option>
                @foreach ($usuarios as $usuario)
                    <option value="{{$usuario->uid}}">{{$usuario->NombreCompleto}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>

</div>

<script src="{{asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script>
$(function () {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });

    $("#cargandoxml").hide();
    $("#tecnico").hide();
    bsCustomFileInput.init();
    $('#modal-sm').modal('show');

    $("#usuario").on("change", function(e){
            $('#modal-sm').modal('toggle');
    });

    $('#modal-sm').on('hidden.bs.modal', function () {
        var usuario = $("#usuario").find(':selected').val();
        if(usuario==0)
        {
            Toast.fire({
                icon: 'error',
                title: 'Debes seleccionar un usuario.'
            });
            $('#modal-sm').modal('show');
        }
        else
        {
            $("#tecnombre").html($("#usuario").find('option:selected').text());
            $("#tecnico").show();
        }
    });

    $("#files").on("change", function(e){
        var usuario = $("#usuario").find(':selected').val();
        if(usuario==0)
        {
            return;
        }

		e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var fd = new FormData();
        var totalfiles = document.getElementById('files').files.length;
        for (var index = 0; index < totalfiles; index++) {
            fd.append("files[]", document.getElementById('files').files[index]);
        }
        fd.append("usuario", usuario);

        $.ajax({
			url  : "/cargaxml",
			type : "POST",
			data: fd,
            cache:false,
            contentType: false,
            processData: false,
            beforeSend:function(){
                $("#xmlcargados").hide();
                $("#cargandoxml").show();
                $("#files").prop( "disabled", true );
            },
            success:function(result){
                $("#cargandoxml").hide();
                $("#files").prop( "disabled", false );
                $("#xmlcargados").html(result);
                $("#xmlcargados").show();
            },
            error:function(){
                toastr.error('Error al cargar XML.')
                $("#xmlcargados").show();
                $("#cargandoxml").hide();
                $("#files").prop( "disabled", false );
            }
        }); 
    }); 
});
</script>


