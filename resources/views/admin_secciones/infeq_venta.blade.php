<div class="col-md-12">
    <div class="card card-outline card-info">
        <div class="card-header">
        <h3 class="card-title">Ingresar Números Economicos</span></h3>
        </div>

        <form id="venta_economicos" method="post">
            <div class="card-body">
                    <div class="input-group">
                        <textarea class="form-control" id="economicos" name="economicos" style="width: 70%; flex:inherit;" rows="3" placeholder="Ingresar economicos separados por renglones..."></textarea>
                    </div>
            </div>
            <div class="card-footer">
                <button type="submit" id="cargar" class="btn btn-info">Procesar</button>
            </div>
        </form>
        <div id="over" class="overlay">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
          
    </div>

    <div id="economicos_cargados"></div>  
</div>


<script>
    $(function () {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000
        });
    
        $("#over").hide();
        $("#cargandoecos").hide();
        $("#venta_economicos").on("submit", function(e){
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                    url  : "/venta_economicos",
                    type : "POST",
                    data: formData,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    cache:false,
                    beforeSend:function(){
                        $("#over").show();
                        $("#economicos_cargados").html('');
                        $("#cargar").prop( "disabled", true );
                    },
                    success:function(result){
                        toastr.success('Economicos cargados.')
                        $("#over").hide();
                        $("#economicos_cargados").html(result);
                        $("#economicos_cargados").show();
                        $("#cargar").prop( "disabled", false );
                    },
                    error:function(){
                    $("#over").hide();
                        $("#cargar").prop( "disabled", false );
                        alert('error fatal');
                    }
                }); 
            }); 
    });
    </script>