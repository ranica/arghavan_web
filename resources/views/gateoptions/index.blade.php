@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ mix('css/pages/people.css') }}">

<div class="content f-BYekan hidden" id="app">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                         <!--  Title  -->
                        <h5 class="card-title">
                            <div>
                                <i class="fa fa-cogs fa-2x"></i>
                                <span class="panel-heading">تنظیمات تردد</span>

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
                        </h5>
                        <!--  /Title  -->

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

                                <!--  List Data Table  -->
                                <div class="table-responsive col-md-12 pc">
                                    <table id="myTable" class="table table-striped table-hover" v-show="hasRow">
                                        <thead v-show="!isLoading">
                                            {{-- <td>وضعیت شبکه</td> --}}
    										<td>وضعیت اضطراری</td>
    										<td>شماره پورت</td>
    										<td>نحوه تردد خواهران </td>
    										<td>نحوه تردد برادران</td>
    										<td>تاریخ ورود</td>
                                            <td>تاریخ خروج</td>
    										<td></td>
                                        </thead>

                                        <tbody>
                                            <tr v-if="isLoading">
                                                <td colspan="2" class="text-center">در حال بارگذاری اطلاعات</td>
                                            </tr>

                                            <tr v-for="record in records">
                                                {{-- <td> @{{ record.netStateSt. ?  'فعال' : 'غیرفعال'}}</td> --}}
    											<td>@{{ record.emergencyStr }}</td>
    											<td>@{{ record.port }}</td>
    											<td>@{{ record.gatezone_w.name }}</td>
    											<td>@{{ record.gatezone_m.name }}</td>
                                                <td>@{{ toPersian(record.startDate) }}</td>
    											<td>@{{ toPersian(record.endDate) }}</td>

                                                <!-- class="td-actions text-left" -->
                                                <td class="text-left" width="160">
                                                    @can('command_delete')
                                                        <a href="#"
                                                            class="btn btn-round btn-just-icon pull-left"
                                                            title="حذف رکورد"
                                                            data-toggle="modal"
                                                            data-target="#removeRecordModal"
                                                            @click.prevent="readyToDelete(record)">
                                                            <i class="material-icons">delete</i>
                                                            <div class="ripple-container"></div>
                                                        </a>
                                                    @endcan
                                                    @can('command_edit')
                                                        <a href="#"
                                                            class="btn btn-round btn-info btn-just-icon pull-left"
                                                            title= "ویرایش رکورد"
                                                            @click.prevent="editRecord(record)">
                                                            <i class="material-icons">edit</i>
                                                            <div class="ripple-container"></div>
                                                        </a>
                                                    @endcan

                                                    @can('command_permission')
                                                        <a href="#"
                                                            class="btn btn-round btn-info btn-just-icon pull-left"
                                                            title="تخصیص گیت"
                                                            @click.prevent="setGateDevice(record)">
                                                            <i class="material-icons">vpn_key</i>
                                                            <div class="ripple-container"></div>
                                                        </a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--  /List Data Table  -->
                                <div class="text-center">
                                    <pagination :data="allData"
                                                v-on:pagination-change-page="loadRecords"
                                                :limit= "{{ \App\Http\Controllers\Controller::C_PAGINATION_LIMIT }} "
                                                :show-disable= "true">
                                    </pagination>
                                </div>
                            </div>
                            <!--  /Data List  -->

                            <!--  Register Form  -->
                            <div v-if="isRegisterMode">
                                @include('gateoptions.create')
                            </div>
                            <!--  /Register Form  -->

                            <!-- Assign gate device  -->
                            <div v-show="isAssignGateDevice">
                                @include('gateoptions.assign-gate-device')
                            </div>
                            <!-- /Assign gate device -->

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
</div>
@endsection @section('scripts')
<script type="text/javascript" src="{{ mix('js/pages/gateoptions/index.js') }}"></script>
@endsection
