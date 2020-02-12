@extends('layouts.app')

@section('content')
{{-- <link rel="stylesheet" type="text/css" href="{{ mix('css/pages/gate-device.css') }}"> --}}
<div class="content f-BYekan hidden" id="app">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card-content">

                    {{-- Title --}}
                    <h3 class="card-title">
                        <div>
                            <i class="material-icons"></i>
                            <span class="panel-heading my-dashboard">گیت ها</span>
                            @can('command_insert')
                                <!-- Pc size -->
                                <span class="pull-left pc" v-show="isNormalMode">
                                    <a class="btn btn-rose btn-round"
                                        href="#"
                                        @click.prevent="newRecord">
                                        <span class="glyphicon glyphicon-plus"></span>
                                        ثبت رکورد جدید
                                    </a>
                                </span>
                                <!--  mobile size -->
                                <span class="mobile" v-show="isNormalMode">
                                    <a class="btn btn-round btn-rose"
                                        href="#"
                                        @click.prevent="newRecord">
                                        <span class="glyphicon glyphicon-plus"></span>
                                        ثبت رکورد جدید
                                    </a>
                                </span>
                            @endcan

                        </div>
                    </h3>
                    {{-- /Title --}}

                    <div class="row">
                        {{-- Data list --}}
                        <div v-show="isNormalMode">
                            <div class="text-left"></div>
                            <div v-if="! hasRow">
                                <h4 class="text-center f-BYekan">
                                    رکوردی ثبت نشده است
                                </h4>
                            </div>
                            <div class="row"></div>

                            <gate-widget class="col-md-3"
                                         v-for="record in records"
                                         :gate-data="record"
                                         v-on:edit-data="editRecord"
                                         v-on:delete-data="readyToDelete(record)" >
                            </gate-widget>

                           <div class="text-center">
                                <pagination :data="allData"
                                            v-on:pagination-change-page="loadRecords"
                                            :limit= "{{ \App\Http\Controllers\Controller::C_PAGINATION_LIMIT }}"
                                            :show-disable= "true">
                                </pagination>
                            </div>
                        </div>
                        {{-- /Data List --}}

                        {{-- Register Form --}}
                        <div v-if="isRegisterMode">
                            @include('gatedevices.create')
                        </div>
                        {{-- /Register Form --}}

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
                                                class="btn btn-simple"
                                                data-dismiss="modal">خیر
                                        </button>

                                        <button type="button"
                                                class="btn btn-success btn-simple"
                                                data-dismiss="modal"
                                                @click.prevent="deleteRecord">بله
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--    end small modal -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ mix('js/pages/gatedevices/index.js') }}"></script>
@endsection
