@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ mix('css/pages/home.css') }}">

<div class="row" id="app">
    <h3>
        <div class="panel-heading my-dashboard"> داشبورد خودرو</div>
    </h3>

    @include('dashboard.car.index')
@endsection

@section('scripts')

<script>
    document.pageData.car = {
        count_daily_car_traffic_url: '{{ route('report.count.car.traffic.daily') }}',
        count_active_antenna_url: '{{ route('report.count.antenna.active') }}',
        daily_traffic_url: '{{ route('report.car.traffic.daily') }}',
        weekly_traffic_url: '{{ route('report.car.traffic.weekly') }}',
        monthly_traffic_url: '{{ route('report.car.traffic.monthly') }}',
    };

</script>
<script src="{{ mix('js/jsapi.js') }}"></script>
<script src="{{ mix('js/Chart.js') }}"></script>
<script src="{{ mix('js/pages/dashboard/car/index.js') }}"></script>
@endsection
