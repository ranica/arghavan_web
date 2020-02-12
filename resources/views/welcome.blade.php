<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	 <link href="{{ asset("theme/css/jquery-ui.css") }}" rel="stylesheet">
    <link href="{{ asset("theme/css/jquery-ui.min.css") }}" rel="stylesheet">
    <link href="{{ asset("theme/css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("theme/css/bootstrap-rtl.css") }}" rel="stylesheet">
    <link href="{{ asset("theme/css/material-dashboard.css") }}" rel="stylesheet">
    {{-- <link href="{{ asset("theme/css/material-dashboard-lock.min.css") }}" rel="stylesheet"> --}}
    <link href="{{ asset("theme/css/demo.css") }}" rel="stylesheet">
    <link href="{{ asset("theme/css/datatables.css") }}" rel="stylesheet">
    <link href="{{ asset("theme/css/datatables.min.css") }}" rel="stylesheet">


    {{-- <link rel="stylesheet" href="{{ mix("css/slide_range.css") }}"> --}}

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/chart.css') }}">
    <link rel="stylesheet" href="{{ mix("css/fonts.css") }}">

    <link rel="stylesheet" href="{{ mix('css/misc.css') }}">
    <link rel="stylesheet" href="{{ mix('css/wizard.css') }}">



	<title>Document</title>
</head>
<body>
     <div class="row">
                        <div class="form-group label-floating"
                            :class="{'has-error' : errors.has('name')}">
                            <label class="control-label">نام برنامه </label>
                            <input class="form-control"
                                 type="text"
                                 name="name"
                                 minlength="2"
                                 maxlength="50"
                            {{--      autofocus
                                 required --}}
                                 v-validate="{ required: true, is_not:'null' }"
                                 data-vv-delay="250"
                                 data-vv-as ="نام برنامه"
                                />
                            <span class="material-input"></span>
                        </div>
                    </div>
	<div>

		<div id="time-range">
	    	<p>Time Range: <span class="slider-time">10:00 AM</span> - <span class="slider-time2">12:00 PM</span>
	    	</p>
		    <div class="sliders_step1">
		        <div id="slider-range"></div>
		    </div>
		</div>
	</div>
	<script src="{{ asset ("theme/js/jquery-3.2.1.min.js") }}"></script>
            <script src="{{ asset ("theme/js/jquery-ui.js") }}"></script>
            <script src="{{ asset ("theme/js/jquery-ui.min.js") }}"></script>
            <script src="{{ asset ("theme/js/bootstrap.min.js") }}" type="text/javascript"></script>
            <script src="{{ asset ("theme/js/material.min.js") }}" type="text/javascript"></script>
            <script src="{{ asset ("theme/js/perfect-scrollbar.jquery.min.js") }}" type="text/javascript"></script>
            <!-- Library for adding dinamically elements -->
            <script src="{{ asset ("theme/js/arrive.min.js") }}" type="text/javascript"></script>
            <!-- Forms Validations Plugin -->
            <script src="{{ asset ("theme/js/jquery.validate.min.js") }}"></script>
            <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
            <script src="{{ asset ("theme/js/moment.min.js") }}"></script>
            <!--  Charts Plugin, full documentation here: https://gionkunz.github.io/chartist-js/ -->
            <script src="{{ asset ("theme/js/chartist.min.js") }}"></script>
            <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
            <script src="{{ asset ("theme/js/jquery.bootstrap-wizard.js") }}"></script>
            <!--  Notifications Plugin, full documentation here: http://bootstrap-notify.remabledesigns.com/    -->
            <script src="{{ asset ("theme/js/bootstrap-notify.js") }}"></script>
            <!--   Sharrre Library    -->
            <script src="{{ asset ("theme/js/jquery.sharrre.js") }}"></script>
            <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
            <script src="{{ asset ("theme/js/bootstrap-datetimepicker.js") }}"></script>
            <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
            <script src="{{ asset ("theme/js/jquery-jvectormap.js") }}"></script>
            <!-- Sliders Plugin, full documentation here: https://refreshless.com/nouislider/ -->
            <script src="{{ asset ("theme/js/nouislider.min.js") }}"></script>
            <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
            <script src="{{ asset ("theme/js/jquery.select-bootstrap.js") }}"></script>
            <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
            <script src="{{ asset ("theme/js/jquery.datatables.js") }}"></script>
            <script src="{{ asset ("theme/js/datatables.js") }}"></script>
            <script src="{{ asset ("theme/js/datatables.min.js") }}"></script>
            <!-- Sweet Alert 2 plugin, full documentation here: https://limonte.github.io/sweetalert2/ -->
            <script src="{{ asset ("theme/js/sweetalert2.js") }}"></script>
            <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
            <script src="{{ asset ("theme/js/jasny-bootstrap.min.js") }}"></script>
            <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
            <script src="{{ asset ("theme/js/fullcalendar.min.js") }}"></script>
            <!-- Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
            <script src="{{ asset ("theme/js/jquery.tagsinput.js") }}"></script>
            <!-- Material Dashboard javascript methods -->
            <script src="{{ asset ("theme/js/material-dashboard.js") }}"></script>
            <!-- Material Dashboard DEMO methods, don't include it in your project! -->
            <script src="{{ asset ("theme/js/demo.js") }}"></script>
            <script src="{{ asset ("theme/js/jquery.steps.js") }}"></script>
	{{-- <script type="text/javascript" src="{{ mix('js/pages/gatePlans/index.js') }}"></script> --}}

	<script>
		$("#slider-range").slider({
    range: true,
    min: 0,
    max: 1440,
    step: 15,
    values: [600, 720],
     slide: function (e, ui) {
        var hours1 = Math.floor(ui.values[0] / 60);
        var minutes1 = ui.values[0] - (hours1 * 60);

        if (hours1.length == 1) hours1 = '0' + hours1;
        if (minutes1.length == 1) minutes1 = '0' + minutes1;
        if (minutes1 == 0) minutes1 = '00';
        if (hours1 >= 12) {
            if (hours1 == 12) {
                hours1 = hours1;
                minutes1 = minutes1 + " PM";
            } else {
                hours1 = hours1 - 12;
                minutes1 = minutes1 + " PM";
            }
        } else {
            hours1 = hours1;
            minutes1 = minutes1 + " AM";
        }
        if (hours1 == 0) {
            hours1 = 12;
            minutes1 = minutes1;
        }



        $('.slider-time').html(hours1 + ':' + minutes1);

        var hours2 = Math.floor(ui.values[1] / 60);
        var minutes2 = ui.values[1] - (hours2 * 60);

        if (hours2.length == 1) hours2 = '0' + hours2;
        if (minutes2.length == 1) minutes2 = '0' + minutes2;
        if (minutes2 == 0) minutes2 = '00';
        if (hours2 >= 12) {
            if (hours2 == 12) {
                hours2 = hours2;
                minutes2 = minutes2 + " PM";
            } else if (hours2 == 24) {
                hours2 = 11;
                minutes2 = "59 PM";
            } else {
                hours2 = hours2 - 12;
                minutes2 = minutes2 + " PM";
            }
        } else {
            hours2 = hours2;
            minutes2 = minutes2 + " AM";
        }

        $('.slider-time2').html(hours2 + ':' + minutes2);
    }
});


	/*	var socket = new WebSocket("ws://localhost");

		socket.onopen = function() {
			alert("The connection is established.");
		};

		socket.onclose = function(event) {
			if (event.wasClean) {
				alert('Connection closed cleanly');
			} else {
				alert('Broken connections');
			}
			alert('Key: ' + event.code + ' cause: ' + event.reason);
		};

		socket.onmessage = function(event) {
			alert("The data " + event.data);
		};

		socket.onerror = function(error) {
			alert("Error " + error.message);
		};

		//To send data using the method socket.send(data).
		//For example, the line:
		socket.send("Hello");*/
</script>

</body>
</html>
