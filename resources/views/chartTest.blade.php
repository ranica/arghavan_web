@extends('layouts.app')

@section('content')
{{-- <link rel="stylesheet" type="text/css" href="{{ mix('css/pages/chart.css') }}"> --}}


<div class="row" id="app">

    <h3>
        <div class="panel-heading">داشبورد من</div>
    </h3>
    <!-- {{-- <div id="piechart_3d" style="width: 900px; height: 500px;"></div> --}} -->

  {{-- Pie Chart White and black --}}
    <br />
    <div class="row">
        <div class="col-md-1"></div>
          <div class="col-md-10">
              <!--       Chart.js Canvas Tag -->
            <canvas id="barChart"></canvas>
          </div>
        <div class="col-md-1"></div>
    </div>

<!-- <div id="title_1">Some popular pies :</div>
<div id="chart5" class="ct-chart ct-major-tenth"></div>
<br />
<div id="title_2">Some popular donuts :</div>
<div id="chart6" class="ct-chart ct-major-tenth"></div> -->


@endsection

@section('scripts')

<script>
	// var data1 = {
	//   labels: ['Apple', 'Blueberry', 'KeyLime'],
	//   series: [60, 10, 30]
	// };

	// new Chartist.Pie('#chart5', data1);


	// var data12 = {
	//   labels: ['Sugar', 'Glazed', 'Maple', 'Chocolate'],
	//   series: [10, 10, 20, 60]
	// };

	// var options2 = {
	//   donut: true
	// }

	// new Chartist.Pie('#chart6', data12, options2);


</script>
<script src="{{ mix('js/jsapi.js') }}"></script>
<script src="{{ mix('js/Chart.js') }}"></script>
<script src="{{ mix('js/pages/dashboard/car/index.js') }}"></script>

<script type="text/javascript">
  // google.load("visualization", "1", {packages:["corechart"]});
  // google.setOnLoadCallback(drawChart);
  // function drawChart() {
  //   var data = google.visualization.arrayToDataTable([
  //     ['Task', 'Hours per Day'],
  //     ['Work',     11],
  //     ['Eat',      2],
  //     ['Commute',  2],
  //     ['Watch TV', 2],
  //     ['Sleep',    7]
  //   ]);

  //   var options = {
  //     title: 'My Daily Activities',
  //     is3D: true,
  //   };

  //   var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
  //   chart.draw(data, options);
  // }

    /**
     * js pie chart white and black
     */
      var canvas = document.getElementById("barChart");
      var ctx = canvas.getContext('2d');

    // Global Options:
     Chart.defaults.global.defaultFontColor = 'black';
     Chart.defaults.global.defaultFontSize = 14;

    var data = {
        labels: ["She returns it ", "She keeps it", "blue", "red"],
          datasets: [
            {
                fill: true,
                backgroundColor: [
                    'black',
                    'white',
                    'blue',
                    'red'],
                data: [5, 20, 5, 70],
    // Notice the borderColor
                borderColor:  ['black', 'black'],
                borderWidth: [2,2]
            }
        ]
    };

  // Notice the rotation from the documentation.

    var options = {
            title: {
                      display: true,
                      text: 'What happens when you lend your favorite t-shirt to a girl ?',
                      position: 'top'
                  },
            rotation: -0.7 * Math.PI
    };


    var myBarChart = new Chart(ctx, {
        type: 'pie',
        data: data,
        options: options
    });
    </script>






@endsection

