(function($) {
    const arr = [
        'navusuarios',
        'listausuarios',
        'agregarusuario',
        'eliminarusuario',
        'navmantenimientos',
        'navmantenimientos_buscar',
        'navmantenimientos_xml',
        'navreportes',
        'navprograma',
        'navinfeq',
        'infeqbuscar',
        'siracbuscar',
        'infeqbuscar_baja',
        'infeqbuscar_venta',
        'navsettings',
        'settings_panel'
    ];

    $("#listausuarios").click(function() {
          
        $.each(arr, function(index, value) {
          $("#"+value).removeClass("active");
        });

        $("#navusuarios").addClass("active");
        $("#listausuarios").addClass("active");
        $.ajax({
          url  : "/listausuarios",
          type : "GET",
          cache:	false,
          beforeSend:function(){
              $("#contenido").html('<center><br><br><br><img src="../images/loading.gif\" width="30%"></center>');
          },
          success:function(result){
              $("#contenido").html(result);
          }
      }); 
    });

    $("#agregarusuario").click(function() {
        $.each(arr, function(index, value) {
            $("#"+value).removeClass("active");
        });

        $("#navusuarios").addClass("active");
        $("#agregarusuario").addClass("active");
        $.ajax({
                url  : "/agregarusuario",
                type : "GET",
                cache:	false,
                beforeSend:function(){
                    $("#contenido").html('<center><br><br><br><img src="../images/loading.gif\" width="30%"></center>');
                },
                success:function(result){
                    $("#contenido").html(result);
                }
        });
    });

    $("#navmantenimientos_buscar").click(function() {
        $.each(arr, function(index, value) {
            $("#"+value).removeClass("active");
        });

        $("#navmantenimientos").addClass("active");
        $("#navmantenimientos_buscar").addClass("active");
        $.ajax({
                url  : "/buscarmantenimiento",
                type : "GET",
                cache:	false,
                beforeSend:function(){
                    $("#contenido").html('<center><br><br><br><img src="../images/loading.gif\" width="30%"></center>');
                },
                success:function(result){
                    $("#contenido").html(result);
                }
        });
    });

    $("#navmantenimientos_xml").click(function() {
        $.each(arr, function(index, value) {
            $("#"+value).removeClass("active");
        });

        $("#navmantenimientos").addClass("active");
        $("#navmantenimientos_xml").addClass("active");
        $.ajax({
                url  : "/agregarxml",
                type : "GET",
                cache:	false,
                beforeSend:function(){
                    $("#contenido").html('<center><br><br><br><img src="../images/loading.gif\" width="30%"></center>');
                },
                success:function(result){
                    $("#contenido").html(result);
                }
        });
    });

    $("#navreportes").click(function() {
        $.each(arr, function(index, value) {
            $("#"+value).removeClass("active");
        });

        $("#navmantenimientos").addClass("active");
        $("#navreportes").addClass("active");
        $.ajax({
                url  : "/reportes",
                type : "GET",
                cache:	false,
                beforeSend:function(){
                    $("#contenido").html('<center><br><br><br><img src="../images/loading.gif\" width="30%"></center>');
                },
                success:function(result){
                    $("#contenido").html(result);
                }
        });
    });


    $("#navprograma").click(function() {
        $.each(arr, function(index, value) {
            $("#"+value).removeClass("active");
        });

        $("#navmantenimientos").addClass("active");
        $("#navprograma").addClass("active");
        $.ajax({
                url  : "/programa",
                type : "GET",
                cache:	false,
                beforeSend:function(){
                    $("#contenido").html('<center><br><br><br><img src="../images/loading.gif\" width="30%"></center>');
                },
                success:function(result){
                    $("#contenido").html(result);
                }
        });
    });

    $("#infeqbuscar").click(function() {
        $.each(arr, function(index, value) {
            $("#"+value).removeClass("active");
        });

        $("#navinfeq").addClass("active");
        $("#infeqbuscar").addClass("active");
        $.ajax({
                url  : "/infeq",
                type : "GET",
                cache:	false,
                beforeSend:function(){
                    $("#contenido").html('<center><br><br><br><img src="../images/loading.gif\" width="30%"></center>');
                },
                success:function(result){
                    $("#contenido").html(result);
                }
        });
    });

    $("#siracbuscar").click(function() {
        $.each(arr, function(index, value) {
            $("#"+value).removeClass("active");
        });

        $("#navinfeq").addClass("active");
        $("#siracbuscar").addClass("active");
        $.ajax({
                url  : "/sirac",
                type : "GET",
                cache:	false,
                beforeSend:function(){
                    $("#contenido").html('<center><br><br><br><img src="../images/loading.gif\" width="30%"></center>');
                },
                success:function(result){
                    $("#contenido").html(result);
                }
        });
    });

    $("#infeqbuscar_baja").click(function() {
        $.each(arr, function(index, value) {
            $("#"+value).removeClass("active");
        });

        $("#navinfeq").addClass("active");
        $("#infeqbuscar_baja").addClass("active");
        $.ajax({
                url  : "/infeq_baja",
                type : "GET",
                cache:	false,
                beforeSend:function(){
                    $("#contenido").html('<center><br><br><br><img src="../images/loading.gif\" width="30%"></center>');
                },
                success:function(result){
                    $("#contenido").html(result);
                }
        });
    });

    $("#infeqbuscar_venta").click(function() {
        $.each(arr, function(index, value) {
            $("#"+value).removeClass("active");
        });

        $("#navinfeq").addClass("active");
        $("#infeqbuscar_venta").addClass("active");
        $.ajax({
                url  : "/infeq_venta",
                type : "GET",
                cache:	false,
                beforeSend:function(){
                    $("#contenido").html('<center><br><br><br><img src="../images/loading.gif\" width="30%"></center>');
                },
                success:function(result){
                    $("#contenido").html(result);
                }
        });
    });

    $("#settings_panel").click(function() {
        $.each(arr, function(index, value) {
            $("#"+value).removeClass("active");
        });

        $("#navsettings").addClass("active");
        $("#settings_panel").addClass("active");
        $.ajax({
                url  : "/configuracion",
                type : "GET",
                cache:	false,
                beforeSend:function(){
                    $("#contenido").html('<center><br><br><br><img src="../images/loading.gif\" width="30%"></center>');
                },
                success:function(result){
                    $("#contenido").html(result);
                }
        });
    });

})(jQuery);