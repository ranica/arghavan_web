@extends('layouts.app')

@section('content')

    <div class="content f-BYekan hidden" id="app">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-content">
                            {{-- Title --}}
                            <h3 class="card-title">
                                <div>
                                    <i class="fa fa-coffee md-48"></i>
                                    <span class="panel-heading">درخواست مرخصی</span>

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
                                    <div v-if="! hasRow">
                                        <h4 class="text-center f-BYekan">
                                            رکوردی ثبت نشده است
                                        </h4>
                                    </div>

                                    <div class="table-reponsive col-md-12 pc">

                                        <table id="myTable" class="table table-striped table-hover" v-show="hasRow">
                                            <thead v-show="!isLoading">
                                                <td>وضعیت</td>
                                                <td>موضوع</td>
                                                <td>نوع مرخصی</td>
                                                <td>از ساعت</td>
                                                <td>تا ساعت</td>
                                                <td>از روز</td>
                                                <td>تا روز</td>
                                                <td>تاریخ درخواست</td>
                                                <td></td>
                                            </thead>

                                            <tbody>
                                                <tr v-if="isLoading">
                                                    <td colspan="2" class="text-center">در حال بارگذاری اطلاعات</td>
                                                </tr>

                                                <tr v-for="record in records">
                                                    <td>
                                                        <i v-show="record.vacation_status.id == 1"
                                                            class="fa fa-hourglass-start  fa-2x text-warning"
                                                            title="در حال بررسی"></i>
                                                        <i v-show="record.vacation_status.id == 2"
                                                            class="fa fa-check-circle fa-2x text-success"
                                                            title="موافقت شد"></i>
                                                        <i v-show="record.vacation_status.id == 3"
                                                            class="fa fa-minus-circle  fa-2x text-danger"
                                                            title="مخالفت شد"></i>
                                                        @{{ record.vacation_status.name }}
                                                    </td>
                                                    <td>@{{ record.subject }}</td>
                                                    <td>@{{ record.vacation_type.name }}</td>
                                                    <td>@{{ toTime(record.begin_hour) }}</td>
                                                    <td>@{{ toTime(record.finish_hour) }}</td>
                                                    <td>@{{ toPersian(record.begin_date) }}</td>
                                                    <td>@{{ toPersian(record.finish_date) }}</td>
                                                    <td>@{{ record.created_at }}</td>

                                                    <td>
                                                         {{-- @can('command_delete') --}}
                                                            <a href="#"
                                                                class="btn btn-round btn-just-icon pull-left"
                                                                data-toggle="modal"
                                                                data-target="#removeRecordModal"
                                                                @click.prevent="readyToDelete(record)">

                                                                <i class="material-icons">delete</i>
                                                                <div class="ripple-container"></div>
                                                            </a>
                                                        {{-- @endcan --}}

                                                        @can('command_edit')
                                                            <a v-show="record.seen_at == null"
                                                                href="#"
                                                                class="btn btn-round btn-info btn-just-icon like pull-left"
                                                                @click.prevent="editRecord(record)">
                                                                <i class="material-icons">create</i>
                                                                <div class="ripple-container"></div>
                                                            </a>
                                                        @endcan
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="text-center">
                                        <pagination :data="allData"
                                                    v-on:pagination-change-page="loadRecords"
                                                    :limit= {{ \App\Http\Controllers\Controller::C_PAGINATION_LIMIT }}
                                                    :show-disable= true>
                                        </pagination>
                                    </div>
                                </div>
                                {{-- /Data List --}}

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
                                <!-- end small modal -->

                                   {{-- Register Form --}}
                                <div v-if="isRegisterMode">
                                    @include('vacationRequests.create')
                                </div>
                                {{-- /Register Form --}}

                            </div>
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
            user_id: {{ \Auth::user()->id }}
        };
    </script>
    <script type="text/javascript" src="{{ mix('js/pages/vacationRequests/index.js') }}"></script>
@endsection
