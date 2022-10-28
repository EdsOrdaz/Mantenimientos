<h5>DATOS DEL EQUIPO</h5>			
<table id="customers">
  <tr>
    <th>NOMBRE DEL EQUIPO</th>
    <th>MARCA</th>
    <th>MODELO</th>
    <th>TIPO</th>
  </tr>
  <tr>
    <td>{{$infeq->nombreequipo}}</td>
    <td>{{$infeq->marca}}</td>
    <td>{{$infeq->modelo}}</td>
    <td>{{$infeq->tipo}}</td>
  </tr>
  <tr>
	<th width="50%" colspan="2">NUMERO ECONOMICO</th>
	<th colspan="2">NUMERO DE SERIE</th>
  </tr>
  </tr>
  <tr>
	<td colspan="2">{{$infeq->noactivo}}</td>
	<td colspan="2">{{$infeq->numeroserie}}</td>
  </tr>
  <tr>
    <th>MEMORIA RAM</th>
    <th>DISCO DURO</th>
    <th>SISTEMA OPERATIVO</th>
    <th>PROCESADOR</th>
  </tr>
  <tr>
    <td>{{$infeq->ram}} MB</td>
    <td>{{$infeq->ddtotal}} GB</td>
    <td>{{$infeq->so}}</td>
    <td>{{$infeq->procesador}}</td>
  </tr>
</table>

<br>
<br>
<h5>DATOS DEL MANTENIMIENTO PREVENTIVO</h5>			
<table id="customers">
  <tr>
    <th>FECHA Y HORA DE INICIO</th>
    <th>FECHA Y HORA DE TERMINO</th>
  </tr>
  <tr>
    <td>{{$infeq->fechainicio}} {{$infeq->horainicio}}</td>
    <td>{{$infeq->fechatermino}} {{$infeq->horatermino}}</td>
  </tr>
</table>
</table>

<br>
<br>
<h5>DATOS DEL USUARIO</h5>			
<table id="customers">
  <tr>
    <th>NOMBRE</th>
    <th>BASE</th>
    <th>DEPARTAMENTO</th>
    <th>EMPRESA</th>
  </tr>
  <tr>
    <td>{{$infeq->nombre}}</td>
    <td>{{$infeq->base}}</td>
    <td>{{$infeq->departamento}}</td>
    <td>{{$infeq->empresa}}</td>
  </tr>
</table>

<br>
<br>
<h5>OBSERVACIONES DE SISTEMAS</h5>	
<table id="customers">
  <tr>
    <td style="background-color: #dbdbdb;">{{$infeq->observaciones}}</td>
  </tr>
</table>


<div id="comentario">
  <br>
  <br>
  <h5>AGREGAR COMENTARIO</h5>	
  <form id="agregarcomentario">
      @csrf
      <textarea name="comentario" id="" cols="100" rows="2" style="color:#ffffff;"></textarea>
      <br>
      <input type="hidden" name="mid" value="{{$mid->mid}}">
      
      
      <h6>CALIFICAR SERVICIO:</h6>	
      <div class="clasificacion">
        <input id="radio5" type="radio" name="estrellas" value="5"><label class="star" for="radio5"><font size="7">★</font></label>
        <input id="radio4" type="radio" name="estrellas" value="4"><label class="star" for="radio4"><font size="7">★</font></label>
        <input id="radio3" type="radio" name="estrellas" value="3"><label class="star" for="radio3"><font size="7">★</font></label>
        <input id="radio2" type="radio" name="estrellas" value="2"><label class="star" for="radio2"><font size="7">★</font></label>
        <input id="radio1" type="radio" name="estrellas" value="1"><label class="star" for="radio1"><font size="7">★</font></label>
      </div>
      <input type="submit" value="Validar mantenimiento">
  </form>
  </div>

<div id="usuario">
<br>
<br>
<h5>COMENTARIOS DEL USUARIO</h5>			
<table id="customers">
  <tr>
    <th width="60%">COMENTARIOS</th>
    <th width="40%">CALIFICACION DEL SERVICIO</th>
  </tr>
  <tr>
    <td width="60%" valign="middle"><div id="comentariousuario">{{$comentariousuario}}</div></td>
    <td width="40%">
      <div id="estrellascalif">
        <input type="radio"><label style="{{$s1}}"><font size="7">★</font></label>
        <input type="radio"><label style="{{$s2}}"><font size="7">★</font></label>
        <input type="radio"><label style="{{$s3}}"><font size="7">★</font></label>
        <input type="radio"><label style="{{$s4}}"><font size="7">★</font></label>
        <input type="radio"><label style="{{$s5}}"><font size="7">★</font></label>
    </div>
  </td>
  </tr>
</table>
  </div>


  
  <div id="commentspin">
    <br>
    <div class="spinner-grow text-secondary" role="status">
    </div>
    <div class="spinner-grow text-warning" role="status">
    </div>
    <div class="spinner-grow text-primary" role="status">
    </div>
    <div class="spinner-grow text-success" role="status">
    </div>
    <div class="spinner-grow text-danger" role="status">
    </div>
  </div>

  <script src="{{asset($js)}}"></script>
  <script>
    /*
    $(function () {
	$('#usuario').hide();
	$('#commentspin').hide();
    alert('prueba');

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
*/
</script>
