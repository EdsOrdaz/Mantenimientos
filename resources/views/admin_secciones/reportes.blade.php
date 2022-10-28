<div id="pagina_reportes" class="container-fluid">
  <div class="row">
            
    <div class="col-12">

          <div class="card card-primary">
              <div class="card-header">
                  <h3 class="card-title">Mantenimientos Programados / Realizados <span id="yhead1">{{$year}}</span></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <center>
                    <select id="years" class="form-control" style="width: 15%;display:inline;">
                      @foreach ($years as $y)
                        <option>{{$y->year}}</option>
                      @endforeach
                    </select>
                    <div id="spinners" class="spinner-border text-secondary" role="status">
                    </div>

                </center>
                  <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          <!-- /.card -->
        </div>


        <div class="col-sm-6">
          <div class="card card-outline card-warning">
          <table class="table table-striped">
            <thead>
              <tr>
                <th colspan="3">Mantenimientos <span id="yhead2">{{$year}}</span></th>
              </tr>
            </thead> 
            <thead>
              <tr>
                <th>Mes</th>
                <th width="70%">Progreso</th>
                <th width="10%">Estatus</th>
                <th width="8%">Realizados</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Enero</td>
                <td valign="middle">
                  <div class="progress progress-xs">
                    <div class="progress-bar" id="progress_ene" style="background-color:{{$ene_color}};width: {{$p_ene}}%"></div>
                  </div>
                </td>
                <td valign="middle"><span id="por_ene" class="badge" style="background-color: {{$ene_color}};">{{$p_ene}}%</span></td>
                <td valign="middle" align="center" id="mostrar_ene">{{$r_ene}}/{{$ene}}</td>
              </tr>
              <tr>
                <td>Febrero</td>
                <td valign="middle">
                  <div class="progress progress-xs">
                    <div class="progress-bar" id="progress_feb" style="background-color:{{$feb_color}};width: {{$p_feb}}%"></div>
                  </div>
                </td>
                <td valign="middle"><span id="por_feb" class="badge" style="background-color: {{$feb_color}};">{{$p_feb}}%</span></td>
                <td valign="middle" align="center" id="mostrar_feb">{{$r_feb}}/{{$feb}}</td>
              </tr>
              <tr>
                <td>Marzo</td>
                <td valign="middle">
                  <div class="progress progress-xs">
                    <div class="progress-bar" id="progress_mar" style="background-color:{{$mar_color}};width: {{$p_mar}}%"></div>
                  </div>
                </td>
                <td valign="middle"><span id="por_mar" class="badge" style="background-color: {{$mar_color}};">{{$p_mar}}%</span></td>
                <td valign="middle" align="center" id="mostrar_mar">{{$r_mar}}/{{$mar}}</td>
              </tr>
              <tr>
                <td>Abril</td>
                <td valign="middle">
                  <div class="progress progress-xs">
                    <div class="progress-bar" id="progress_abr" style="background-color:{{$abr_color}};width: {{$p_abr}}%"></div>
                  </div>
                </td>
                <td valign="middle"><span id="por_abr" class="badge" style="background-color: {{$abr_color}};">{{$p_abr}}%</span></td>
                <td valign="middle" align="center" id="mostrar_abr">{{$r_abr}}/{{$abr}}</td>
              </tr>
              <tr>
                <td>Mayo</td>
                <td valign="middle">
                  <div class="progress progress-xs">
                    <div class="progress-bar" id="progress_may" style="background-color:{{$may_color}};width: {{$p_may}}%"></div>
                  </div>
                </td>
                <td valign="middle"><span id="por_may" class="badge" style="background-color: {{$may_color}};">{{$p_may}}%</span></td>
                <td valign="middle" align="center" id="mostrar_may">{{$r_may}}/{{$may}}</td>
              </tr>
              <tr>
                <td>Junio</td>
                <td valign="middle">
                  <div class="progress progress-xs">
                    <div class="progress-bar" id="progress_jun" style="background-color:{{$jun_color}};width: {{$p_jun}}%"></div>
                  </div>
                </td>
                <td valign="middle"><span id="por_jun" class="badge" style="background-color: {{$jun_color}};">{{$p_jun}}%</span></td>
                <td valign="middle" align="center" id="mostrar_jun">{{$r_jun}}/{{$jun}}</td>
              </tr>
              <tr>
                <td>Julio</td>
                <td valign="middle">
                  <div class="progress progress-xs">
                    <div class="progress-bar" id="progress_jul" style="background-color:{{$jul_color}};width: {{$p_jul}}%"></div>
                  </div>
                </td>
                <td valign="middle"><span id="por_jul" class="badge" style="background-color: {{$jul_color}};">{{$p_jul}}%</span></td>
                <td valign="middle" align="center" id="mostrar_jul">{{$r_jul}}/{{$jul}}</td>
              </tr>
              <tr>
                <td>Agosto</td>
                <td valign="middle">
                  <div class="progress progress-xs">
                    <div class="progress-bar" id="progress_ago" style="background-color:{{$ago_color}};width: {{$p_ago}}%"></div>
                  </div>
                </td>
                <td valign="middle"><span id="por_ago" class="badge" style="background-color: {{$ago_color}};">{{$p_ago}}%</span></td>
                <td valign="middle" align="center" id="mostrar_ago">{{$r_ago}}/{{$ago}}</td>
              </tr>
              <tr>
                <td>Septiembre</td>
                <td valign="middle">
                  <div class="progress progress-xs">
                    <div class="progress-bar" id="progress_sep" style="background-color:{{$sep_color}};width: {{$p_sep}}%"></div>
                  </div>
                </td>
                <td valign="middle"><span id="por_sep" class="badge" style="background-color: {{$sep_color}};">{{$p_sep}}%</span></td>
                <td valign="middle" align="center" id="mostrar_sep">{{$r_sep}}/{{$sep}}</td>
              </tr>
              <tr>
                <td>Octubre</td>
                <td valign="middle">
                  <div class="progress progress-xs">
                    <div class="progress-bar" id="progress_oct" style="background-color:{{$oct_color}};width: {{$p_oct}}%"></div>
                  </div>
                </td>
                <td valign="middle"><span id="por_oct" class="badge" style="background-color: {{$oct_color}};">{{$p_oct}}%</span></td>
                <td valign="middle" align="center" id="mostrar_oct">{{$r_oct}}/{{$oct}}</td>
              </tr>
              <tr>
                <td>Noviembre</td>
                <td valign="middle">
                  <div class="progress progress-xs">
                    <div class="progress-bar" id="progress_nov" style="background-color:{{$nov_color}};width: {{$p_nov}}%"></div>
                  </div>
                </td>
                <td valign="middle"><span id="por_nov" class="badge" style="background-color: {{$nov_color}};">{{$p_nov}}%</span></td>
                <td valign="middle" align="center" id="mostrar_nov">{{$r_nov}}/{{$nov}}</td>
              </tr>
              <tr>
                <td>Diciembre</td>
                <td valign="middle">
                  <div class="progress progress-xs">
                    <div class="progress-bar" id="progress_dic" style="background-color:{{$dic_color}};width: {{$p_dic}}%"></div>
                  </div>
                </td>
                <td valign="middle"><span id="por_dic" class="badge" style="background-color: {{$dic_color}};">{{$p_dic}}%</span></td>
                <td valign="middle" align="center" id="mostrar_dic">{{$r_dic}}/{{$dic}}</td>
              </tr>
            </tbody>
          </table>
          </div>
        </div>


        <div class="col-sm-6">
          <div class="card card-outline card-warning">
            <div class="card-header">
              <h3 class="card-title">Estrellas <span id="mestext">{{$mestext}}</span> <span id="yhead3">{{$year}} </span></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <center>
                <select id="mes" class="form-control" style="width: 25%;display:inline;">
                <option value="01">Enero</option>
                <option value="02">Febrero</option>
                <option value="03">Marzo	</option>
                <option value="04">	Abril	</option>
                <option value="05">	Mayo</option>
                <option value="06">	Junio</option>
                <option value="07">	Julio	</option>
                <option value="08">	Agosto</option>
                <option value="09">	Septiembre</option>
                <option value="10">	Octubre	</option>
                <option value="11">	Noviembre	</option>
                <option value="12">	Diciembre	</option>
              </select>
              <div id="spinner_mes" class="spinner-border text-secondary" role="status">
            </center>
              <div id="dona">
                <canvas id="donutChart" style="min-height: 550px; height: 550px; max-height: 550px; max-width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>

  
      </div>
</div>


<script>
  $(function () {
    $("#spinners").hide();
    $("#spinner_mes").hide();
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      datasets: [
        {
          label               : 'Realizados',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : true,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [{{$r_ene}}, {{$r_feb}}, {{$r_mar}}, {{$r_abr}}, {{$r_may}}, {{$r_jun}}, {{$r_jul}}, {{$r_ago}}, {{$r_sep}}, {{$r_oct}}, {{$r_nov}}, {{$r_dic}} ]
        },
        {
          label               : 'Programados',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : true,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [{{$ene}}, {{$feb}}, {{$mar}}, {{$abr}}, {{$may}}, {{$jun}}, {{$jul}}, {{$ago}}, {{$sep}}, {{$oct}}, {{$nov}}, {{$dic}}]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: true
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : true,
          }
        }],
        yAxes: [{
          gridLines : {
            display : true,
          }
        }]
      },
      plugins: {
        datalabels: false
      }
    }
    // This will get the first returned node in the jQuery collection.
    const grafica = new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })


    //-------------
  //- DONUT CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
  var donutData = {
    labels: [
        'Cierre Auto.',
        '1 Estrella',
        '2 Estrellas',
        '3 Estrellas',
        '4 Estrellas',
        '5 Estrellas',
    ],
    datasets: [
      {
        data: [{{$cero}}, {{$una}},{{$dos}},{{$tres}},{{$cuatro}},{{$cinco}}],
        backgroundColor : ['#A7A7A7', '#E74C3C', '#E67E22', '#F1C40F', '#3498DB', '#27AE60'],
      }
    ]
  }
  var donutOptions = {
    maintainAspectRatio : false,
    responsive : true,
    animation: {
          animateScale: true,
          animateRotate: true
      },
      plugins: {
        datalabels: {
          color: '#fff',
          font: {
            weight: 'bold',
            size: 30,
          }
        }
      }
  }
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  
  const dona = new Chart(donutChartCanvas, {
    type: 'pie',
    data: donutData,
    options: donutOptions
  })



  
  $("#mes").change(function(){
    var formMes = {
      mes: $("#mes").val(),
      year: $("#years").val()
    };
    $.ajax({
            url  : "/estrellas",
            type : "GET",
            cache:	false,
            data : formMes,
            dataType: "json",
            beforeSend:function(){
                $("#spinner_mes").show();
            },
            success:function(result){
                $("#spinner_mes").hide();
                $("#mestext").html(result.mestext);
                dona.data.datasets[0].data[0] = result.cero; 
                dona.data.datasets[0].data[1] = result.una; 
                dona.data.datasets[0].data[2] = result.dos; 
                dona.data.datasets[0].data[3] = result.tres; 
                dona.data.datasets[0].data[4] = result.cuatro; 
                dona.data.datasets[0].data[5] = result.cinco; 
                dona.update(); 
                toastr.info(result.msj);
            },
            error:function(result){
                $("#spinner_mes").hide();
                toastr.error(result.responseText);
            }
    });
  });


  $("#years").change(function(){
      var formYear = {
        mes: $("#mes").val(),
        year: $("#years").val()
      };
      $.ajax({
            url  : "/cambioyear",
            type : "GET",
            cache:	false,
            data : formYear,
            dataType: "json",
            beforeSend:function(){
                $("#spinners").show();
            },
            success:function(result){
                $("#spinners").hide();
                $("#yhead1").html(result.year);
                $("#yhead2").html(result.year);
                $("#yhead3").html(result.year);

                grafica.data.datasets[1].data[0]=result.ene;
                grafica.data.datasets[1].data[1]=result.feb;
                grafica.data.datasets[1].data[2]=result.mar;
                grafica.data.datasets[1].data[3]=result.abr;
                grafica.data.datasets[1].data[4]=result.may;
                grafica.data.datasets[1].data[5]=result.jun;
                grafica.data.datasets[1].data[6]=result.jul;
                grafica.data.datasets[1].data[7]=result.ago;
                grafica.data.datasets[1].data[8]=result.sep;
                grafica.data.datasets[1].data[9]=result.oct;
                grafica.data.datasets[1].data[10]=result.nov;
                grafica.data.datasets[1].data[11]=result.dic;

                grafica.data.datasets[0].data[0]=result.r_ene;
                grafica.data.datasets[0].data[1]=result.r_feb;
                grafica.data.datasets[0].data[2]=result.r_mar;
                grafica.data.datasets[0].data[3]=result.r_abr;
                grafica.data.datasets[0].data[4]=result.r_may;
                grafica.data.datasets[0].data[5]=result.r_jun;
                grafica.data.datasets[0].data[6]=result.r_jul;
                grafica.data.datasets[0].data[7]=result.r_ago;
                grafica.data.datasets[0].data[8]=result.r_sep;
                grafica.data.datasets[0].data[9]=result.r_oct;
                grafica.data.datasets[0].data[10]=result.r_nov;
                grafica.data.datasets[0].data[11]=result.r_dic;

                dona.data.datasets[0].data[0] = result.cero; 
                dona.data.datasets[0].data[1] = result.una; 
                dona.data.datasets[0].data[2] = result.dos; 
                dona.data.datasets[0].data[3] = result.tres; 
                dona.data.datasets[0].data[4] = result.cuatro; 
                dona.data.datasets[0].data[5] = result.cinco; 

                dona.update(); 
                grafica.update();

                $("#mes").val("01").change();

                $("#por_ene").html(result.p_ene+"%");
                $("#por_feb").html(result.p_feb+"%");
                $("#por_mar").html(result.p_mar+"%");
                $("#por_abr").html(result.p_abr+"%");
                $("#por_may").html(result.p_may+"%");
                $("#por_jun").html(result.p_jun+"%");
                $("#por_jul").html(result.p_jul+"%");
                $("#por_ago").html(result.p_ago+"%");
                $("#por_sep").html(result.p_sep+"%");
                $("#por_oct").html(result.p_oct+"%");
                $("#por_nov").html(result.p_nov+"%");
                $("#por_dic").html(result.p_dic+"%");

                $("#por_ene").css('background-color', result.ene_color);
                $("#por_feb").css('background-color', result.feb_color);
                $("#por_mar").css('background-color', result.mar_color);
                $("#por_abr").css('background-color', result.abr_color);
                $("#por_may").css('background-color', result.may_color);
                $("#por_jun").css('background-color', result.jun_color);
                $("#por_jul").css('background-color', result.jul_color);
                $("#por_ago").css('background-color', result.ago_color);
                $("#por_sep").css('background-color', result.sep_color);
                $("#por_oct").css('background-color', result.oct_color);
                $("#por_nov").css('background-color', result.nov_color);
                $("#por_dic").css('background-color', result.dic_color);

                $("#progress_ene").css({'background-color':result.ene_color,'width':result.p_ene+'%'});
                $("#progress_feb").css({'background-color':result.feb_color,'width':result.p_feb+'%'});
                $("#progress_mar").css({'background-color':result.mar_color,'width':result.p_mar+'%'});
                $("#progress_abr").css({'background-color':result.abr_color,'width':result.p_abr+'%'});
                $("#progress_may").css({'background-color':result.may_color,'width':result.p_may+'%'});
                $("#progress_jun").css({'background-color':result.jun_color,'width':result.p_jun+'%'});
                $("#progress_jul").css({'background-color':result.jul_color,'width':result.p_jul+'%'});
                $("#progress_ago").css({'background-color':result.ago_color,'width':result.p_ago+'%'});
                $("#progress_sep").css({'background-color':result.sep_color,'width':result.p_sep+'%'});
                $("#progress_oct").css({'background-color':result.oct_color,'width':result.p_oct+'%'});
                $("#progress_nov").css({'background-color':result.nov_color,'width':result.p_nov+'%'});
                $("#progress_dic").css({'background-color':result.dic_color,'width':result.p_dic+'%'});

                $("#mostrar_ene").html(result.r_ene+'/'+result.ene);
                $("#mostrar_feb").html(result.r_feb+'/'+result.feb);
                $("#mostrar_mar").html(result.r_mar+'/'+result.mar);
                $("#mostrar_abr").html(result.r_abr+'/'+result.abr);
                $("#mostrar_may").html(result.r_may+'/'+result.may);
                $("#mostrar_jun").html(result.r_jun+'/'+result.jun);
                $("#mostrar_jul").html(result.r_jul+'/'+result.jul);
                $("#mostrar_ago").html(result.r_ago+'/'+result.ago);
                $("#mostrar_sep").html(result.r_sep+'/'+result.sep);
                $("#mostrar_oct").html(result.r_oct+'/'+result.oct);
                $("#mostrar_nov").html(result.r_nov+'/'+result.nov);
                $("#mostrar_dic").html(result.r_dic+'/'+result.dic);


                toastr.info(result.msj);
            },
            error:function(result){
                $("#spinner_mes").hide();
                $("#spinners").hide();
                toastr.error(result.responseText);
            }
      });
  });


});
</script>