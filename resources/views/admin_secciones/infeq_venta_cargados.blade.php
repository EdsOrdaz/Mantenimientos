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

<div class="card card-outline card-success">
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
                <th align="center" width="8%">Marca</th>
                <th align="center" width="10%">Modelo</th>
                <th align="center" width="25%">Especificaciones</th>
                <th align="center" width="10%">Precio</th>
                <th align="center">Observaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($equipos as $equipo)
                    <tr id="{{$equipo->noactivo}}">
                        <td>{{$equipo->noactivo}}</td>
                        <td>{{$equipo->tipo}}</td>
                        <td>{{$equipo->marca}}</td>
                        <td>{{$equipo->modelo}}</td>
                        <td><h6>{{$equipo->procesador}} <br> {{$equipo->ram}} MB <br> {{$equipo->ddtotal}} GB</h6></td>
                        <td><input id="p_{{$equipo->noactivo}}" name="p_{{$equipo->noactivo}}" class="form-control form-control-sm" type="text" value="0.00"></td>
                        <td><input id="o_{{$equipo->noactivo}}" name="o_{{$equipo->noactivo}}" class="form-control form-control-sm" type="text" value="{{$equipo->observaciones}}"></td>
                    </tr>
                    <input type="hidden" name="ecos[]" value="{{$equipo->noactivo}}">
                @endforeach
            </tbody>
            </table>
        </div>
        <div class="card-footer">
            <button type="submit" value="imprimir" id="imprimir" class="btn btn-success">Generar Formato</button>
            <button type="button" value="excel" id="excel" class="btn btn-info">Exportar a Excel</button>
        </div>
    </form>

    <div id="overprint" class="overlay">
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
    $("#overprint").hide();
    
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
            formData.append("p_"+ecos[key]['value'], $("#p_"+ecos[key]['value']).val());
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
            url  : "/imprimir_excel_venta",
			      type : "POST",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType: "json", 
            beforeSend:function(){
                $("#imprimir").prop( "disabled", true );
                $("#overprint").show();
            },
            success:function(result){
                console.log(result.path);
                location.href=result.path;
                $("#imprimir").prop( "disabled", false );
                $("#overprint").hide();
            },
            error:function(){
                toastr.error('Error al generar formatos.')
                $("#imprimir").prop( "disabled", false );
                $("#overprint").hide();
            }
        }); 
    });

    $("#generarformatos").on("submit", function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url  : "/imprimir_venta",
            type : "GET",
            data: formData,
            dataType: 'html',
            cache:false,
            beforeSend:function(){
                $("#imprimir").prop( "disabled", true );
                $("#overprint").show();
            },
            success:function(result){
                w = window.open(window.location.href,"_blank");
                w.document.open();
                w.document.write(result);
                w.window.print();
                w.close();
                $("#imprimir").prop( "disabled", false );
                $("#overprint").hide();
            },
            error:function(){
                toastr.error('Error al generar formatos.')
                $("#imprimir").prop( "disabled", false );
                $("#overprint").hide();
            }
        }); 
    }); 
}); 
</script>