@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ mix('css/pages/report.css') }}">
<div class="content f-BYekan hidden" id="app">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">

                        {{-- Title --}}
                        <h3 class="card-title">
                            <div>
                                <div v-if = "isNormalMode">
                                     <i class="material-icons">search</i>
                                     <span class="panel-heading">گزارشات ورود و خروج</span>
                                </div>

                                @can('command_search')
                                    <span class="pull-left" v-show="isNormalMode">
                                        <a class="btn btn-rose" href="#" @click.prevent="newSearch">
                                            <span class="glyphicon glyphicon-search"></span>
                                            جستجوی رکورد جدید
                                        </a>
                                    </span>
                                @endcan

                                @can('command_savetraffic')
                                    <span class="pull-left" v-show="isNormalMode">
                                        <a class="btn btn-rose" href="#"
                                            data-toggle="modal" data-target="#ManualRecordModal"
                                            title = "ثبت دستی تردد" >
                                            <span class="glyphicon glyphicon-plus"></span>
                                            ثبت دستی تردد
                                        </a>
                                    </span>
                                @endcan
                            </div>
                        </h3>
                        {{-- /Title --}}

                       @include('reports.filter')

                        <div v-if = "isSearchMode">
                            @include('reports.search')
                        </div>

                       @include('reports.manual')

                    </div>
                </div>
            </div>

             <!-- small modal -->
            <div class="modal fade" id="removeRecordModal" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" aria-hidden="true">

                <div class="modal-dialog modal-small ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close"
                                data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                        </div>
                        <div class="modal-body text-center">
                            <h5>برای حذف اطمینان دارید؟ </h5>
                        </div>
                        <div class="modal-footer text-center">
                            <button type="button" class="btn btn-simple" data-dismiss="modal">خیر</button>
                            <button type="button" class="btn btn-success btn-simple"  data-dismiss="modal"
                                @click.prevent="deleteRecord">بله</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /small modal -->

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ mix('js/pages/reports/index.js') }}"></script>
@endsection
