@extends('adminlte::page')
@section('title', 'Teachers Reports')
@section('content_header')
@stop
@section('content')


<div class="mian-tab-section">
   <div class="container">
      <div class="row">

        <!--filter  -->
        <div class="col-md-3">
           <label>Filter By Date</label> 
           <input type="text" class="form-control" placeholder="Filter By Year" name="datepicker" id="datepicker" style="margin: 10px 0px;width: 195px;" autocomplete="off"/>
       </div>
        <!--filter  -->

         <div class="col-12">  


            <div class="card">
               <div class="student_chart">
                   <figure class="highcharts-figure">
                        <div id="container"></div>
                        <p class="highcharts-description" style="text-align:center">Teachers Statistics <span class="active_year">{{date('Y')}}</span></p>
                    </figure>
               </div>
           </div>

            <div class="card">
               <div class="student_chart">
                   <figure class="highcharts-figure">
                        <div id="school_chart"></div>
                        <p class="highcharts-description" style="text-align:center">Schools Statistics <span class="active_year">{{date('Y')}}</span></p>
                    </figure>
               </div>
            </div>
            
           <div class="card">
               <div class="student_chart">
                   <figure class="highcharts-figure">
                        <div id="container_bar"></div>
                        <p class="highcharts-description" style="text-align:center">Teachers Enrollment Statistics <span class="active_year">{{date('Y')}}</span></p>
                    </figure>
               </div>
           </div>
            
            
            <!-- end container -->
         </div>
      </div>
   </div>
</div>
</div>

<style type="text/css">


#question_slide .carousel-inner .inner_wrap_question {
    padding-bottom: 0;
}

.inner_wrap_question {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
}
.inner_wrap_question .slide_wraper .custom_check {
    margin: 0;
}
#v-pills-prepared .inner_wrap_question .question_btn_wrap {
    padding: 0;
}
.inner_wrap_question .title_inner_wrap .timer {
    margin: 0;
}

/*added for highchart*/
#container {
  height: 400px; 
}

.highcharts-figure, .highcharts-data-table table {
  min-width: 310px; 
  max-width: 800px;
  margin: 1em auto;
}

.highcharts-data-table table {
  font-family: Verdana, sans-serif;
  border-collapse: collapse;
  border: 1px solid #EBEBEB;
  margin: 10px auto;
  text-align: center;
  width: 100%;
  max-width: 500px;
}
.highcharts-data-table caption {
  padding: 1em 0;
  font-size: 1.2em;
  color: #555;
}
.highcharts-data-table th {
  font-weight: 600;
  padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
  padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
  background: #f8f8f8;
}
.highcharts-data-table tr:hover {
  background: #f1f7ff;
}

/*added for highchart*/

/*added for high chart bar*/
.highcharts-figure, .highcharts-data-table table {
    min-width: 310px; 
    max-width: 800px;
    margin: 1em auto;
}

#container {
    height: 400px;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #EBEBEB;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

/*added for high chart bar*/

</style>
<!-- for date picker -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
<!-- for date picker -->

@endsection
@section('js')
<!-- for date picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<!-- for date picker -->

<!-- pie chart and common -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<!-- pie chart and common -->

<!-- bar chart -->
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<!-- bar chart -->

<!-- school type pie chart -->
<script type="text/javascript">
    
    Highcharts.setOptions({
        colors: ['#058DC7', '#50B432', '#ED561B', '#24CBE5', '#64E572', '#FF9655', '#6AF9C4']
    });
    var schoolChart = Highcharts.chart('school_chart', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Schools Statistics'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Teachers',
            data: [
                
            ]
        }]
    });

    $(document).ready(function(){
    
        var arr = JSON.parse("{{$schools}}".replace(/&quot;/g,'"'));
        $.each(arr,function(i,v){
            
            schoolChart.series[0].addPoint({
                name: v.name+' ('+v.count+')',
                y: v.count
            });
        })
    
    })
</script>
<!-- school type pie chart -->


<script type="text/javascript">
    Highcharts.setOptions({
        colors: ['#FFF263', '#6AF9C4']
    });

    Highcharts.chart('container', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Teachers Statistics'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Teachers',
            data: [
                ['Male ('+{{$male_teacher_count}}+')', {{$male_teacher_count}}],
                ['Female ('+{{$female_teacher_count}}+')', {{$female_teacher_count}}],
            ]
        }]
    });
</script>

<!-- bar graph -->
<script type="text/javascript">
    // Create the chart
Highcharts.setOptions({
    colors: ['#058DC7', '#50B432', '#ED561B', '#24CBE5', '#64E572', '#FF9655', '#6AF9C4']
});
Highcharts.chart('container_bar', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Teachers Enrollment Statistics'
    },
    subtitle: {
        text: ''
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Number of Teachers'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                // format: '{point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
    },

    series: [
        {
            name: "Teachers",
            colorByPoint: true,
            data: [
                {
                    name: "Jan",
                    y: {{$userArr[1]}},
                },
                {
                    name: "Feb",
                    y: {{$userArr[2]}},
                },
                {
                    name: "Mar",
                    y: {{$userArr[3]}},
                },
                {
                    name: "Apr",
                    y: {{$userArr[4]}},
                },
                {
                    name: "May",
                    y: {{$userArr[5]}},
                },
                {
                    name: "Jun",
                    y: {{$userArr[6]}},
                },
                {
                    name: "Jul",
                    y: {{$userArr[7]}},
                },
                {
                    name: "Aug",
                    y: {{$userArr[8]}},
                },
                {
                    name: "Sep",
                    y: {{$userArr[9]}},
                },
                {
                    name: "Oct",
                    y: {{$userArr[10]}},
                },
                {
                    name: "Nov",
                    y: {{$userArr[11]}},
                },
                {
                    name: "Dec",
                    y: {{$userArr[12]}},
                }

            ]
        }
    ],
    
});
</script>
<!-- bar graph -->



<script type="text/javascript">
    var dp= $("#datepicker").datepicker({
         format: "yyyy",
         viewMode: "years", 
         minViewMode: "years",
         autoclose:true,
         placeHolder:'sdfs'
      });   
    
    dp.on('changeYear', function (e) { 

        var year = '';
        setTimeout(function(){ 
            year = $('#datepicker').val();
            $('.active_year').text(year);
            $.ajax({
                url: "{{ route('reports.filter_teachers_report') }}",
                method: "POST",
                data: {
                  year: year
                },
                dataType: "JSON",
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {     
                  console.log('response arrived--');
                  console.log(response);

                  // pie chart
                   Highcharts.setOptions({
                        colors: ['#FFF263', '#6AF9C4']
                    });

                    Highcharts.chart('container', {
                        chart: {
                            type: 'pie',
                            options3d: {
                                enabled: true,
                                alpha: 45,
                                beta: 0
                            }
                        },
                        title: {
                            text: 'Teachers Statistics'
                        },
                        accessibility: {
                            point: {
                                valueSuffix: '%'
                            }
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                depth: 35,
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.name}'
                                }
                            }
                        },
                        series: [{
                            type: 'pie',
                            name: 'Teachers',
                            data: [
                                ['Male ('+response.male_teacher_count+')', response.male_teacher_count],
                                ['Female ('+response.female_teacher_count+')', response.female_teacher_count],
                            ]
                        }]
                    });
                  // pie chart

                  // monthly Teachers data
                  Highcharts.setOptions({
                        colors: ['#058DC7', '#50B432', '#ED561B', '#24CBE5', '#64E572', '#FF9655', '#6AF9C4']
                    });
                    Highcharts.chart('container_bar', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Teachers Enrollment Statistics'
                        },
                        subtitle: {
                            text: ''
                        },
                        accessibility: {
                            announceNewData: {
                                enabled: true
                            }
                        },
                        xAxis: {
                            type: 'category'
                        },
                        yAxis: {
                            title: {
                                text: 'Number of Teachers'
                            }

                        },
                        legend: {
                            enabled: false
                        },
                        plotOptions: {
                            series: {
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                    // format: '{point.y:.1f}%'
                                }
                            }
                        },

                        tooltip: {
                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
                        },

                        series: [
                            {
                                name: "Teachers",
                                colorByPoint: true,
                                data: [
                                    {
                                        name: "Jan",
                                        y: response.userArr[1],
                                    },
                                    {
                                        name: "Feb",
                                        y: response.userArr[2],
                                    },
                                    {
                                        name: "Mar",
                                        y: response.userArr[3],
                                    },
                                    {
                                        name: "Apr",
                                        y: response.userArr[4],
                                    },
                                    {
                                        name: "May",
                                        y: response.userArr[5],
                                    },
                                    {
                                        name: "Jun",
                                        y: response.userArr[6],
                                    },
                                    {
                                        name: "Jul",
                                        y: response.userArr[7],
                                    },
                                    {
                                        name: "Aug",
                                        y: response.userArr[8],
                                    },
                                    {
                                        name: "Sep",
                                        y: response.userArr[9],
                                    },
                                    {
                                        name: "Oct",
                                        y: response.userArr[10],
                                    },
                                    {
                                        name: "Nov",
                                        y: response.userArr[11],
                                    },
                                    {
                                        name: "Dec",
                                        y: response.userArr[12],
                                    }

                                ]
                            }
                        ],
                        
                    });
                  // monthly Teachers data


                    // school types filter
                    Highcharts.setOptions({
                        colors: ['#058DC7', '#50B432', '#ED561B', '#24CBE5', '#64E572', '#FF9655', '#6AF9C4']
                    });
                    var schoolChart = Highcharts.chart('school_chart', {
                        chart: {
                            type: 'pie',
                            options3d: {
                                enabled: true,
                                alpha: 45,
                                beta: 0
                            }
                        },
                        title: {
                            text: 'Schools Statistics'
                        },
                        accessibility: {
                            point: {
                                valueSuffix: '%'
                            }
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                depth: 35,
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.name}'
                                }
                            }
                        },
                        series: [{
                            type: 'pie',
                            name: 'Teachers',
                            data: [
                                
                            ]
                        }]
                    });

                    var arr = response.schools;
                    $.each(arr,function(i,v){
                        
                        schoolChart.series[0].addPoint({
                            name: v.name+' ('+v.count+')',
                            y: v.count
                        });
                    })
                    
                  // school types filter

                }
            });
        },  100);
    });
</script>

@stop