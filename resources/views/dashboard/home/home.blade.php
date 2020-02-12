@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ mix('css/pages/home.css') }}">

<div class="row" id="app">
    <h3>
        <div class="panel-heading my-dashboard">داشبورد من</div>
    </h3>

    @include('dashboard.home.index')
    @include('dashboard.home.modal.present')
    @include('dashboard.home.modal.gate_active')
    @include('dashboard.home.modal.sms')
@endsection

@section('scripts')
<script>
    document.pageData.webSocketServer = '{{ config('core.web_socket_server') }}';
    document.pageData.webSocketServerPort = '{{ config('core.web_socket_server_port') }}';

    document.pageData.home = {
        count_daily_traffic_url: '{{ route('report.count.traffic.daily') }}',
        report_daily_traffic_url: '{{ route('report.traffic.present') }}',

        count_active_gatedevice_url: '{{ route('report.count.gatedevice.active') }}',
        report_active_gatedevice_url: '{{ route('report.gatedevice.active') }}',

        count_posted_sms_url: '{{ route('report.count.posted.sms') }}',
        report_posted_sms_url: '{{ route('report.posted.sms') }}',
        count_referral_data_url: '{{ route('report.count.referral.data') }}',

        daily_traffic_url: '{{ route('report.traffic.daily') }}',
        weekly_traffic_url: '{{ route('report.traffic.weekly') }}',
        monthly_traffic_url: '{{ route('report.traffic.monthly') }}',


        tcp_client_unlock: '{{ route('tcp.client.unlock.input') }}',
    };
</script>

<script src="{{ mix('js/pages/dashboard/home/index.js') }}"></script>
@endsection
