<div class="col-12">
    <div class="card card-outline card-info">
        <div class="card-header">
          <h3 class="card-title"> Mantenimientos programados para el <span id="current">{{$year}}</span></h3>
        </div>
        <form id="actualizaryear">
            @csrf
        <div class="card-body">
            
            <div class="row">
                <div class="col-1">Año: <input id="year" name="year" value="{{$year}}" type="number" class="form-control"></div>
            </div>

            <div class="row">
                <div class="col-2">Enero: <input id="ene" name="ene" value="{{$ene}}" type="number" class="form-control"></div>
                <div class="col-2">Febrero: <input id="feb" name="feb" value="{{$feb}}" type="number" class="form-control"></div>
                <div class="col-2">Marzo: <input id="mar" name="mar" value="{{$mar}}" type="number" class="form-control"></div>
                <div class="col-2">Abril: <input id="abr" name="abr" value="{{$abr}}" type="number" class="form-control"></div>
                <div class="col-2">Mayo: <input id="may" name="may" value="{{$may}}" type="number" class="form-control"></div>
                <div class="col-2">Junio: <input id="jun" name="jun" value="{{$jun}}" type="number" class="form-control"></div>
            </div>

            <div class="row">
                <div class="col-2">Julio: <input id="jul" name="jul" value="{{$jul}}" type="number" class="form-control"></div>
                <div class="col-2">Agosto: <input id="ago" name="ago" value="{{$ago}}" type="number" class="form-control"></div>
                <div class="col-2">Septiembre: <input id="sep" name="sep" value="{{$sep}}" type="number" class="form-control"></div>
                <div class="col-2">Octubre: <input id="oct" name="oct" value="{{$oct}}" type="number" class="form-control"></div>
                <div class="col-2">Noviembre: <input id="nov" name="nov" value="{{$nov}}" type="number" class="form-control"></div>
                <div class="col-2">Diciembre: <input id="dic" name="dic" value="{{$dic}}" type="number" class="form-control"></div>
            </div>
            <div class="row" style="padding-top: 1%; padding-left:1%;">
                <input type="submit" id="enviar" value="Actualizar" style="width: 10%;" class="btn btn-info">
            </div>
        </div>
        </form>
        <!-- /.card-body -->
      </div>

</div>

<script>
$(function () {
    $("#actualizaryear").on("submit", function(e){
		e.preventDefault();
		var formData = $(this).serialize();
        $.ajax({
			url  : "/actualizarfechas",
			type : "POST",
			cache:	false,
			data : formData,
            dataType: "json",
            beforeSend:function(){
                $("#enviar").attr("disabled", true);
            },
            success:function(result){
                if(result.estatus=='N'){
                        toastr.error(result.msj);
                }
                else{
                    toastr.success(result.msj);
                }
                $("#enviar").attr("disabled", false);
            },
            error:function(result){
                $("#enviar").attr("disabled", false);
                toastr.error(result.msj);
            }
        }); 
    }); 


    $("#year").change(function(){
        var formDataYear = {
          year: $("#year").val()
        };
        $.ajax({
                url  : "/programavalidar_year",
                type : "GET",
                cache:	false,
                data : formDataYear,
                dataType: "json",
                success:function(result){
                    if(result.estatus=="N")
                    {
                        toastr.error(result.msj);
                    }
                    $("#current").html(result.year);
                    $("#year").val(result.year);
                    $("#ene").val(result.ene);
                    $("#feb").val(result.feb);
                    $("#mar").val(result.mar);
                    $("#abr").val(result.abr);
                    $("#may").val(result.may);
                    $("#jun").val(result.jun);
                    $("#jul").val(result.jul);
                    $("#ago").val(result.ago);
                    $("#sep").val(result.sep);
                    $("#oct").val(result.oct);
                    $("#nov").val(result.nov);
                    $("#dic").val(result.dic);
                    //$("#current").html(result);
                },
                error:function(){
                    alert('naa');
                }
        });
    });
})
</script>