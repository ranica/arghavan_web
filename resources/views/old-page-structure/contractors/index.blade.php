@extends('layouts.app')

@section('content')

<div class="content f-BYekan hidden" id="app">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-content">

                        {{-- Title --}}
                        <h4 class="card-title">
                            <div>
                                <i class="fas fa-user-tie"></i>
                                <span class="panel-heading">پیمانکاران</span>

                                @can('command_insert')
                                <span class="pull-left" v-show="isNormalMode">
                                    <a class="btn btn-rose" href="#" @click.prevent="newRecord">
                                        <span class="glyphicon glyphicon-plus"></span>
                                        ثبت رکورد جدید
                                    </a>
                                </span>
                                @endcan

                            </div>
                        </h4>
                        {{-- /Title --}}

                        <div class="row">
                            {{-- Data list --}}
                            <div v-show="isNormalMode">
                                <div class="text-left">

                                </div>

                                <div v-if="! hasRow">
                                    <h4 class="text-center f-BYekan">
                                        رکوردی ثبت نشده است
                                    </h4>
                                </div>
                                <!--  List Data Table  -->
                                <div class="table-responsive col-md-12">
                                    <table id="myTable" class="table table-striped table-hover" v-show="hasRow">
                                        <thead v-show="!isLoading">
                                            <td>نام پیمانکار</td>
                                            <td>تاریخ شروع قرارداد</td>
                                            <td>تاریخ پایان قرارداد</td>
                                            <td> وضعیت</td>
                                            <td></td>
                                        </thead>

                                        <tbody>
                                            <tr v-if="isLoading">
                                                <td colspan="2" class="text-center">در حال بارگذاری اطلاعات</td>
                                            </tr>

                                            <tr v-for="record in records">
                                                <td>@{{ record.name }}</td>
                                                <td>@{{ toPersian(record.beginDate) }}</td>
                                                <td>@{{ toPersian(record.endDate) }}</td>
                                                <td>@{{ record.stateStr }}</td>
                                                <td>
                                                    @can('command_delete')
                                                        <a href="#" class="btn btn-round btn-just-icon pull-left"
                                                            data-toggle="modal" data-target="#removeRecordModal" @click.prevent="readyToDelete(record)">

                                                            <i class="material-icons">delete</i>
                                                            <div class="ripple-container"></div>
                                                        </a>
                                                    @endcan
                                                    @can('command_edit')
                                                        <a href="#" class="btn btn-round btn-info btn-just-icon pull-left" @click.prevent="editRecord(record)">
                                                            <i class="material-icons">create</i>
                                                            <div class="ripple-container"></div>
                                                        </a>
                                                    @endcan

                                                    {{-- <button class="btn btn-rose btn-fill" onclick=demo.showSwal('warning-message-and-cancel')>Try me!</button> --}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--  /List Data Table  -->
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
                                @include('contractors.create')
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
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ mix('js/pages/contractors/index.js') }}"></script>
@endsection
