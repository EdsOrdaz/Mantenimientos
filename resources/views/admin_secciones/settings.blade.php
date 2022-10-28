<section class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <form id="guardarcuerpo" method="post">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            Cuerpo de correo
                        </h3>
                    </div>
                    <div class="card-body">
                        <textarea name="summernote" cols="300" rows="60" id="summernote">
                        {{$cuerpo->text}}
                        </textarea>
                    </div>
                    <div class="card-footer">
                        @csrf
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- /.row -->
</section>

<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $('#summernote').summernote();

        $("#guardarcuerpo").on("submit", function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url  : "/guardarcuerpo",
                type : "POST",
                cache:	false,
                data : formData,
                success:function(result){
                    Toast.fire({
                        icon: 'success',
                        title: '¡Cuerpo de correo guardado!'
                    })
                },
                error:function(){
                    alert('ERROR');
                }
            });
        });
    })
</script>