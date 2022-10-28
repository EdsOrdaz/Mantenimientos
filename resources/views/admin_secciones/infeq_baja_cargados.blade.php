@if ($errores > 0)
<div class="card card-outline card-danger">
    <div class="card-header">
      <h3 class="card-title">Errores</span></h3>
    </div>

    <div id="infeq_errores" class="card-body p-0">
        <table class="table table-bordered table-hover">
          <tbody>
            @foreach ($error as $eco => $msj)
                  <tr>
                      <td><b>{{$eco}}:</b> {{$msj}}</td>
                 </tr>
            @endforeach
          </tbody>
        </table>
      </div>
  </div>
@endif

<div class="card card-outline card-warning">
    <div class="card-header">
      <h3 class="card-title">Economicos Cargados</span></h3>
    </div>

    <form id="generarformatos">
        <div id="infeq_equipo" class="card-body p-0">
            <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                <th align="center" width="10%">Economico</th>
                <th align="center" width="10%">Equipo</th>
                <th align="center" width="10%">Marca</th>
                <th align="center" width="10%">Modelo</th>
                <th align="center" width="20%">Motivo de Baja</th>
                <th align="center" width="20%">Como se detecto el equipo</th>
                <th align="center" width="20%">Observaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($equipos as $equipo)
                    <tr id="{{$equipo['No. Activo']}}">
                        <td>{{$equipo['No. Activo']}}</td>
                        <td>{{$equipo['Subcategoría']}}</td>
                        <td>{{$equipo['marca']}}</td>
                        <td>{{$equipo['modelo']}}</td>
                        <td><input name="m_{{$equipo['No. Activo']}}" id="m_{{$equipo['No. Activo']}}" class="form-control form-control-sm" type="text" value="EQUIPO DAÑADO"></td>
                        <td><input name="d_{{$equipo['No. Activo']}}" id="d_{{$equipo['No. Activo']}}" class="form-control form-control-sm" type="text" value="EQUIPO DAÑADO"></td>
                        <td><input name="o_{{$equipo['No. Activo']}}" id="o_{{$equipo['No. Activo']}}" class="form-control form-control-sm" type="text" value="DAÑADO"></td>
                    </tr>
                    <input type="hidden" name="ecos[]" value="{{$equipo['No. Activo']}}">
                @endforeach
            </tbody>
            </table>
        </div>
        <div id="printing" class="card-body p-0">
            <center><br><br><br><img src="../images/loading3.gif\" width="20%"></center>
        </div>
        <div class="card-footer">
            <button type="submit" id="imprimir" class="btn btn-warning">Generar Formato</button>
            <button type="button" id="excel" class="btn btn-info">Exportar a Excel</button>
        </div>
    </form>
    
    <div id="over2" class="overlay">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
    </div>
  </div>

<script>
$(function () {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });
    $("#over2").hide();
    $("#printing").hide();
    $("#generarformatos").on("submit", function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url  : "/imprimir_baja",
            type : "GET",
            data: formData,
            dataType: 'html',
            cache:false,
            beforeSend:function(){
                $("#imprimir").prop( "disabled", true );
                $("#over2").show();
            },
            success:function(result){
                w = window.open(window.location.href,"_blank");
                w.document.open();
                w.document.write(result);
                w.window.print();
                w.close();
                $("#imprimir").prop( "disabled", false );
                $("#over2").hide();
            },
            error:function(){
                toastr.error('Error al generar formatos.')
                $("#imprimir").prop( "disabled", false );
                $("#over2").hide();
            }
        }); 
    }); 

    $("#excel").click(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        var ecos = document.getElementsByName("ecos[]");

        var formData = new FormData();
        $.each( ecos, function( key ) {
            formData.append("ecos[]", ecos[key]['value']);
            formData.append("m_"+ecos[key]['value'], $("#m_"+ecos[key]['value']).val());
            formData.append("d_"+ecos[key]['value'], $("#d_"+ecos[key]['value']).val());
            formData.append("o_"+ecos[key]['value'], $("#o_"+ecos[key]['value']).val());
        });
        
        var matches = [];
        var i = '';

          for(i in document.getElementsByTagName('input')) {
              if(i.value === '07') {
                matches.push(i);
              }
            console.log(matches);
          }

        $.ajax({
            url  : "/imprimir_excel_baja",
            type : "POST",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType: "json", 
            beforeSend:function(){
                $("#imprimir").prop( "disabled", true );
                $("#over2").show();
            },
            success:function(result){
                console.log(result.path);
                location.href=result.path;
                $("#imprimir").prop( "disabled", false );
                $("#over2").hide();
            },
            error:function(){
                toastr.error('Error al generar formatos.')
                $("#imprimir").prop( "disabled", false );
                $("#over2").hide();
            }
        }); 
    });
}); 
</script>