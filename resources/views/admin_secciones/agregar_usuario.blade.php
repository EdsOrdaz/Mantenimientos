<script>
$("#cargando").hide();
$("#agregarusuarioform").on("submit", function(e){
  e.preventDefault();
  var formData = $(this).serialize();
		$.ajax({
			url  : "/insertarusuario",
			type : "POST",
			cache:	false,
			data : formData,
      dataType: "json",
      beforeSend:function(){
        $("#cargando").show();
        $('#enviar').attr('disabled',true);
        $('#inputEmail3').attr('disabled',true);
        $('#inputPassword3').attr('disabled',true);
        $('#inputNombre3').attr('disabled',true);
      },
			success:function(result){
        if(result.estatus=='OK')
        {
          toastr.success(result.msj);
          $("#cargando").hide();
          $('#enviar').attr('disabled',false);
          $('#inputEmail3').attr('disabled',false);
          $('#inputNombre3').attr('disabled',false);
          $('#inputPassword3').attr('disabled',false);
          $('#listausuarios').trigger('click');
        }
        if(result.estatus=="N")
        {
          toastr.error(result.msj);
          $("#cargando").hide();
          $('#enviar').attr('disabled',false);
          $('#inputEmail3').attr('disabled',false);
          $('#inputNombre3').attr('disabled',false);
          $('#inputPassword3').attr('disabled',false);
        }
			},
			error : function(result) {
         alert('errors');
			}
		}); 
});
</script>
<section class="content">
    <div class="container-fluid">
     
      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                
                <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title">Agregar usuario</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="agregarusuarioform">
                      @csrf
                      <div class="card-body">
                        <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-2 col-form-label">Nombre</label>
                          <div class="col-sm-10">
                            <input type="text" name="nombre" class="form-control" id="inputNombre3" placeholder="Nombre">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputPassword3" class="col-sm-2 col-form-label">Contraseña</label>
                          <div class="col-sm-10">
                            <input type="password" name="pass" class="form-control" id="inputPassword3" placeholder="Password">
                          </div>
                        </div>
                      </div>

                      <!-- /.card-body -->
                      <div class="card-footer">
                        <button id="enviar" type="submit" class="btn btn-info">
                          <span id="cargando" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                          Crear Usuario</button>
                      </div>
                      <!-- /.card-footer -->
                    </form>
              </div>
                  
            
            
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>