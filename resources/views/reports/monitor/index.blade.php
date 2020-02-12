@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ mix('css/pages/report.css') }}">
<div class="content f-BYekan hidden" id="app">
    <div class="container-fluid">
        <div class="row">

            <div class="card col-md-12">
                <div class="card-content">

                    <!--  Title  -->
                    <h3 class="card-title">
                        <div>
                             <i class="fa fa-desktop fa-2x"></i>
                             <span class="panel-heading"> ورود و خروج</span>

                            @can('command_search')
                                <span class="pull-left" v-show="isNormalMode">
                                    <a class="btn btn-rose" href="#" @click.prevent="newSearch">
                                        <span class="glyphicon glyphicon-search"></span>
                                        جستجوی رکورد
                                    </a>
                                </span>
                            @endcan

                            @can('command_savetraffic')
                                <span class="pull-left" v-show="isNormalMode">
                                    <a class="btn btn-rose" href="#"
                                        data-toggle="modal" data-target="#ManualRecordModal"
                                        title = "ثبت دستی تردد " >
                                        <span class="glyphicon glyphicon-plus"></span>
                                        ثبت دستی تردد
                                    </a>
                                </span>
                            @endcan
                        </div>
                    </h3>
                    {{-- /Title --}}

                    <div v-if = "isNormalMode">
                        <div class="card">
                            {{-- Card Content --}}
                           <div v-if="! hasRow">
                               <h4 class="text-center f-BYekan">
                                   رکوردی پیدا نشد
                               </h4>
                           </div>

                        <div class="row"></div>
                            <monitor-widget class="col-md-3"
                                     v-for="record in records"
                                     :gate-data="record"
                                     v-on:delete-data="readyToDelete(record)" >
                            </monitor-widget>

                            <div class="row"></div>
                            <div class="text-center">
                                <pagination :data="allData"
                                            v-on:pagination-change-page="loadRecords"
                                            :limit= "{{ \App\Http\Controllers\Controller::C_PAGINATION_LIMIT }}"
                                            :show-disable= "true">
                                </pagination>
                            </div>
                        </div>
                    </div>

                    <div v-if = "isSearchMode">
                        @include('reports.monitor.search')
                    </div>
                   @include('reports.monitor.manual.modal')
                </div>
            </div>

             <!-- small modal -->
            <div class="modal fade"
                id="removeRecordModal"
                tabindex="-1"
                role="dialog"
                aria-labelledby="myModalLabel"
                aria-hidden="true">

                <div class="modal-dialog modal-small ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button"
                                    class="close"
                                    data-dismiss="modal"
                                    aria-hidden="true">
                                <i class="material-icons">clear</i>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <h5>برای حذف اطمینان دارید؟ </h5>
                        </div>
                        <div class="modal-footer text-center">
                            <button type="button"
                                    class="btn btn-just-icon btn-round"
                                    data-dismiss="modal">خیر
                            </button>
                            <button type="button"
                                    class="btn btn-success btn-just-icon btn-round "
                                    data-dismiss="modal"
                                    @click.prevent="deleteRecord">بله
                            </button>
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
<script>
  document.pageData.report = {
    urls: {
      baseInformation: '{{ route('base.all_Information') }}'
    }
  };
</script>
<script type="text/javascript" src="{{ mix('js/pages/reports/monitor-index.js') }}"></script>
@endsection
