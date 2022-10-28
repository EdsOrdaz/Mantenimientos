
(function($) {
	$('#cargando').hide();
	$("#formulario").on("submit", function(e){
		e.preventDefault();
		var formData = $(this).serialize();
		$.ajax({
			url  : "/validar",
			type : "POST",
			cache:	false,
			data : formData,
			beforeSend: function() {
				$("#cargando").show();
			},
			success:function(result){
				$("#cargando").hide();
				if(result=='ERROR')
				{
					$("#errorpin").show();
				}
				else
				{
					$("#header").val('');
					$("#header").remove();
					$("#infeq").html(result);
					$('#digit-1').select();
				}
			},
			error : function(result) {
				$("#cargando").hide();
				alert(result);
			}
		}); 
	});

	$('#digit-1').select();
	$('.digit-group').find('input').each(function() {
		$(this).attr('maxlength', 1);
		$(this).on('keypress', function(tecla) {
			if(tecla.charCode < 48 || tecla.charCode > 57)
			{
				return false;
			}
		});
		$(this).on('keyup', function(e) {
			$("#errorpin").hide();
			var parent = $($(this).parent());
			
			if(e.keyCode === 8 || e.keyCode === 37) {
				var prev = parent.find('input#' + $(this).data('previous'));
				
				if(prev.length) {
					$(prev).select();
				}
			} else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
				var next = parent.find('input#' + $(this).data('next'));
				
				if(next.length) {
					$(next).select();
				} else {
					parent.submit();
				}
			}
		});
	});

	var	$window = $(window),
		$body = $('body'),
		$main = $('#main');

	// Breakpoints.
		breakpoints({
			xlarge:   [ '1281px',  '1680px' ],
			large:    [ '981px',   '1280px' ],
			medium:   [ '737px',   '980px'  ],
			small:    [ '481px',   '736px'  ],
			xsmall:   [ '361px',   '480px'  ],
			xxsmall:  [ null,      '360px'  ]
		});

	// Play initial animations on page load.
		$window.on('load', function() {
			window.setTimeout(function() {
				$body.removeClass('is-preload');
			}, 100);
		});



})(jQuery);

