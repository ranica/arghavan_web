@extends('layouts.app')

@section('content')

<div class="content f-BYekan hidden" id="app">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-content">
                        <!-- Title -->
                        <h3 class="card-title">
                            <div>
                                <i class="fa fa-list-ul md-48"></i>
                                <span class="panel-heading">بررسی درخواست ها</span>
                            </div>
                        </h3>
                        <!-- /Title -->

                        <div class="row">
                            <!-- Data list -->
                            <div v-show="isNormalMode">
                                <div v-if="! hasRow">
                                    <h4 class="text-center f-BYekan">
                                        رکوردی ثبت نشده است
                                    </h4>
                                </div>

                                <table id="myTable" class="table table-striped table-hover" v-show="hasRow">
                                    <thead v-show="!isLoading">
                                        {{-- <td>وضعیت</td> --}}
                                        <td>کد درخواست کننده</td>
                                        <td>نام و نام خانوادگی</td>
                                        <td>موضوع</td>
                                        <td>نوع مرخصی</td>
                                        <td>تاریخ درخواست</td>
                                        <td></td>
                                    </thead>

                                    <tbody>
                                        <tr v-if="isLoading">
                                            <td colspan="2" class="text-center">در حال بارگذاری اطلاعات</td>
                                        </tr>
                                        <tr v-for="record in records">
                                            {{-- <td>
                                                <i v-show="record.seen_at == null" class="fa fa-eye  fa-2x text-success" title="خوانده نشده"> </i>
                                                <i v-show="record.seen_at != null" class="fa fa-eye-slash  fa-2x text-warning" title="خوانده نشده"> </i>
                                            </td> --}}
                                            <td>@{{ record.user.code }}</td>
                                            <td>@{{ record.user.people.name }}      @{{ record.user.people.lastname }}</td>
                                            <td>@{{ record.subject }}</td>
                                            <td>@{{ record.vacation_type.name }}</td>
                                            <td>@{{ record.created_at }}</td>
                                            <td>
                                                @can('command_edit')
                                                   <a href="#"
                                                        class="btn btn-simple btn-info btn-just-icon pull-left"
                                                        data-toggle="modal"
                                                        data-target="#RequestRecordModal"
                                                        title = "بررسی درخواست رسیده"
                                                        @click.prevent="checkRequest(record)">
                                                        <i v-show="record.seen_at == null" class="fa fa-eye" title="خوانده نشده"> </i>
                                                        <i v-show="record.seen_at != null" class="fa fa-eye-slash" title="خوانده نشده"> </i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                @endcan
                                                <i v-show="record.vacation_status.id == 2"
                                                    class="fa fa-check-circle fa-2x text-success"
                                                    title="موافقت شد">
                                                </i>
                                                <i v-show="record.vacation_status.id == 3"
                                                    class="fa fa-minus-circle  fa-2x text-danger"
                                                    title="مخالفت شد">
                                                </i>
                                                @{{ record.vacation_status.name }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <pagination :data="allData"
                                                v-on:pagination-change-page="loadRecords"
                                                :limit= {{ \App\Http\Controllers\Controller::C_PAGINATION_LIMIT }}
                                                :show-disable= true>
                                    </pagination>
                                </div>
                            </div>
                            <!-- /Data List -->

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

                            <!-- Show Request modal -->
                            <div class="modal fade"
                                id="RequestRecordModal"
                                tabindex="-1"
                                role="dialog"
                                aria-labelledby="myModalLabel"
                                aria-hidden="true">

                                <div class="modal-dialog modal-notice">
                                    <div class="modal-content">
                                        @include('vacationManagment.create')
                                    </div>
                                </div>
                            </div>
                            <!-- /Show Request modal -->

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
