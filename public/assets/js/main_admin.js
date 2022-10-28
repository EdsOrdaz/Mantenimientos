(function($) {
    
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

	$("#login").on("submit", function(e){
		e.preventDefault();
		var formData = $(this).serialize();
		$.ajax({
			url  : "/panel",
			type : "POST",
			cache:	false,
			data : formData,
            dataType: "json",
            beforeSend:function(){
                $('#usuario').attr('disabled',true);
                $('#pass').attr('disabled',true);
                $("#enviar").attr("disabled", true);
            },
			success:function(result){
                if(result.estatus=="OK")
                {
                    window.location.reload();
                }
                else
                {
                    $('#usuario').attr('disabled',false);
                    $('#pass').attr('disabled',false);
                    $("#enviar").attr("disabled", false);
                    toastr.error(result.msj);
                }
			},
			error : function(result) {
                $('#usuario').attr('disabled',false);
                $('#pass').attr('disabled',false);
                $("#enviar").attr("disabled", false);
                toastr.error(result.msj);
			}
		}); 
	});
})(jQuery);