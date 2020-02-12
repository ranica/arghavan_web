@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ mix('css/pages/base.css') }}">

<div class="content f-BYekan hidden" id ="app">
    <div class="container-fluid">

         <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-content">
                       {{-- Title --}}
                        <h4 class="card-title">
                            <div>
                                <i class="fa fa-users fa-2x"></i>
                                <span class="panel-heading">گزارشات تردد</span>
                            </div>
                        </h4>
                        {{-- /Title --}}
                       @include('reports.traffic.index')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
  document.pageData.report = {
    urls: {
        baseInformation: '{{ route('base.all_Information') }}',
        traffic_export_excel_data: '{{ route('export.report.traffic.excel') }}',
        traffic_export_pdf_data: '{{ route('export.report.traffic.pdf') }}'
    }
  };
</script>
<script type="text/javascript" src="{{ mix('js/pages/reports/index.js') }}"></script>
@endsection
