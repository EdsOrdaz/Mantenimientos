<html>
	<head>
		<title>Mantenimiento Preventivo</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="{{URL::asset('assets\css\main.css')}}" />
		<link rel="stylesheet" href="{{URL::asset('assets\css\boot.css')}}" />
		<noscript><link rel="stylesheet" href="{{URL::asset('assets\css\noscript.css')}}" /></noscript>
		<script src="{{asset('js/app.js') }}" defer></script>
    <!-- Styles -->

	</head>
	<body class="is-preload">
	
		<!-- Wrapper -->
			<div id="wrapper">
				
				@csrf
				<!-- Header -->
					<header id="header">
						<div class="content">
							<div class="inner">

							
								<h1>NIP</h1>
								<font color="#ffffff"><p>Ingresa el NIP que se te envi&oacute; por correo electr&oacute;nico<br />para validar el mantenimiento preventivo.</p></font>
								<form id="formulario" class="digit-group" data-group-name="digits" data-autosubmit="false" autocomplete="off">
								@csrf

									<div id="errorpin" class="alert alert-danger" role="alert">
									<b style="color:#CD5C5C;">EL NIP INGRESADO NO ES VALIDO.</b>
									</div>

								<input type="text" value="{{$pin1}}" class="round" id="digit-1" name="p1" data-next="digit-2" />
								<input type="text" value="{{$pin2}}" class="round" id="digit-2" name="p2" data-next="digit-3" data-previous="digit-1" />
								<input type="text" value="{{$pin3}}" class="round" id="digit-3" name="p3" data-next="digit-4" data-previous="digit-2" />
								<input type="text" value="{{$pin4}}" class="round" id="digit-4" name="p4" data-previous="digit-3" />
								<br>
								<div id="cargando">
								  <div class="spinner-border text-light" role="status">
								  </div>
								<br><br>
								</div>
								<input type="submit" id="validar" value="Ingresar">
								<input type="hidden" name="mid" value="{{$mid}}">
								</form>

							</div>
							
						</div>
					</header>
				
					<div id="infeq" align="center"></div>
				<!-- Footer -->
					<footer id="footer">
					<p class="copyright"><a href="http://www.unne.com.mx/" target="blank" style="color:#FFFFFF;">&copy; Corporativo UNNE</a>.</p>
					</footer>

			</div>


			
			<div class="modal" id="myModal" tabindex="-1">
				<div class="modal-dialog modal-sm modal-dialog-centered">
				  <div class="modal-content">
					<div class="modal-header" style="padding:10px;">
					  <button type="button" class="btn-close" style="padding:7px;" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body" style="padding:10px;">
					  <p id="respuesta_modal"></p>
					</div>
				  </div>
				</div>
			  </div>

		<!-- BG -->
			<div id="bg"></div>
			<script>
			document.getElementById("errorpin").style.display = "none";
			</script>
		<!-- Scripts -->
			<script src="{{asset('assets/js/comment.js')}}"></script>


			<script src="{{URL::asset('assets/js/jquery.min.js')}}"></script>
			<script src="{{URL::asset('assets/js/browser.min.js')}}"></script>
			<script src="{{URL::asset('assets/js/breakpoints.min.js')}}"></script>
			<script src="{{URL::asset('assets/js/util.js')}}"></script>
			<script src="{{URL::asset('assets/js/main.js')}}"></script>

</body>
</html>		
