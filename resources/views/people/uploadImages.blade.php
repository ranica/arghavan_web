@extends('layouts.app')

@section('content')

<div class="content f-BYekan hidden" id="app">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                   {{-- Title --}}
                    <div class="card-content">
                        {{-- Title --}}
                        <h3 class="card-title">
                            <div>
                                <i class="material-icons md-48">cloud_upload</i>
                                <span class="panel-heading">بارگذاری تصاویر </span>

                                @can('command_insert')
                                    <span class="pull-left" v-show="isNormalMode">
                                        <a class="btn btn-rose" href="#" @click.prevent="uploadImageRecord">
                                            <span class="glyphicon glyphicon-upload"></span>
                                            بارگذاری تصاویر
                                        </a>
                                    </span>
                                @endcan

                            </div>
                        </h3>
                       
                       
                    </div>
                   {{-- Title --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection @section('scripts')
<script type="text/javascript" src="{{ mix('js/pages/people/index.js') }}"></script>
@endsection
