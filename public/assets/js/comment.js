$(function () {
	$('#usuario').hide();
	$('#commentspin').hide();

    $("#agregarcomentario").on("submit", function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url  : "/insertarcomentario",
            type : "POST",
            cache:	false,
            data : formData,
            dataType: "json",
            beforeSend: function() {
                $("#commentspin").show();
                $("#comentario").hide();
                $("#usuario").hide();
            },
            success:function(result){
                if(result.status == true)
                {
                    $('#estrellascalif').html(result.estrellas);
                    $('#respuesta_modal').html(result.mensaje);
                    $('#comentariousuario').html(result.usuario);
                    $('#myModal').modal('show');
                    $("#comentario").remove();
                    $("#usuario").show();
                    $("#numerodeestrellas").remove();
                    $("#commentspin").remove();
                }
                else
                {
                    $('#respuesta_modal').html(result.mensaje);
                    $('#myModal').modal('show');
                    $("#commentspin").hide();
                    $("#comentario").show();
                    $("#usuario").hide();
                }
            },
            error : function(jqXHR, textStatus, errorThrown ) {
                alert(textStatus);
            }
        }); 
    })
})