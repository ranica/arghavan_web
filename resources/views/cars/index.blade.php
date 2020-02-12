@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ mix('css/pages/car.css') }}">

<div class="content f-BYekan hidden" id="app">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <h4>
                    <span class="panel-heading my-dashboard">مدیریت خودرو</span>
                </h4>
                <div class="card-content">
                    <div class="card-header card-header-tabs card-header-rose" v-show="isNormalMode">

                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <!--  Tab Car  -->
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#">
                                            <i class="fas fa-car fa-2x"></i>
                                            <strong>مشخصات خودرو</strong>
                                            <div class="ripple-container"></div>
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <!--  /Tab Car  -->

                                    <!--  Button insert  -->
                                    <li class="nav-item pull-left">
                                        @can('command_insert')
                                            <span class="pull-left">
                                                    <a class="btn btn-white" href="#" @click.prevent="newRecord">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                        ثبت رکورد جدید
                                                    </a>
                                            </span>
                                        @endcan
                                    </li>
                                    <!--  Button insert  -->
                                    <div class="input-group no-border">
                                        <input type="search"
                                            v-model="searchWord"
                                            class="form-control form-control-sm text-color"
                                            placeholder="جستجو...">
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <!--  Data list  -->
                        <div v-show="isNormalMode">
                            <div class="text-left">
                            </div>
                            <div v-if="! hasRow">
                                <h4 class="text-center f-BYekan">
                                    رکوردی ثبت نشده است
                                </h4>
                            </div>

                            <car-widget class="col-md-3"
                                v-for="record in records"
                                :key = "record.id"
                                :car-data="record"
                                @edit-data="prepareEditRecord"
                                @delete-data="readyToDelete(record)"
                                v-show="hasRow">
                            </car-widget>

                            <div class="text-center">
                                <pagination :data="allData"
                                            v-on:pagination-change-page="loadRecords"
                                            :limit= "{{ \App\Http\Controllers\Controller::C_PAGINATION_LIMIT }}"
                                            :show-disable= "true">
                                </pagination>
                            </div>
                        </div>
                        <!--  /Data List  -->

                        <!--  Register Form  -->
                        <div v-show="isRegisterMode">
                            @include('cars.create')
                        </div>
                        <!--  /Register Form  -->

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
                        <!--    end small modal -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    document.pageData = {
        load_url: '{{ route('cars.filter', '') }}',
    };
</script>
<script type="text/javascript" src="{{ mix('js/pages/cars/car/index.js') }}"></script>
@endsection
