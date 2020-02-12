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
                                <div v-if= "isNormalMode">
                                     <i class="fa fa-chart-pie fa-2x"></i>
                                     <i class="fa fa-users"></i>
                                     <span class="panel-heading">گزارش کاربران</span>
                                 </div>

                                @can('command_insert')
                                    <span class="pull-left" v-show="isNormalMode">
                                        <a class="btn btn-rose" href="#" @click.prevent="newSearch">
                                            <span class="glyphicon glyphicon-search"></span>
                                            جستجوی رکورد جدید
                                        </a>
                                    </span>
                                @endcan

                            </div>
                        </h3>
                        {{-- /Title --}}

                        <div class="row">
                            {{-- Data list --}}
                            <div v-show="isNormalMode">
                                <div class="text-left">
                                </div>

                                <div v-if="! hasRow">
                                    <h4 class="text-center f-BYekan">
                                        رکوردی پیدا نشد
                                    </h4>
                                </div>
                                {{-- List Data Table --}}

                                <table id="myTable" class="table table-striped table-hover" v-show="hasRow">
                                    <thead v-show="!isLoading">
                                        <td>نام گروه</td>
                                        <td>شماره شناسایی</td>
                                        <td>نام</td>
                                        <td>نام خانوادگی</td>
                                        <td>کد ملی</td>
                                        <td>سریال کارت</td>
                                        <td></td>
                                    </thead>

                                    <tbody>
                                        <tr v-if="isLoading">
                                            <td colspan="2" class="text-center">در حال بارگذاری اطلاعات</td>
                                        </tr>

                                        <tr v-for="record in records">
                                            <td>@{{ record.group.name}}</td>
                                            <td>@{{ record.user.code }}</td>
                                            <td>@{{ record.people.name }}</td>
                                            <td>@{{ record.people.lastname }}</td>
                                            <td>@{{ record.people.nationalId }}</td>
                                            <td>@{{ record.card.cdn }}</td>

                                            <td>
                                                @can('command_edit')
                                                 <a href="#" class="btn btn-simple btn-info btn-just-icon pull-left" @click.prevent="editRecord(record)">
                                                        <i class="material-icons">create</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                @endcan

                                                 <div v-if="isShowParent">
                                                    <a href="#" class="btn btn-simple btn-danger btn-just-icon pull-left"
                                                        data-toggle="modal" data-target="#ParentRecordModal" title = "ثبت والدین"
                                                        @click.prevent="assignParent(record)">
                                                        <i class="fa fa-group"></i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </div>

                                                <div v-if="isShowGateGroup">
                                                     <a href="#" class="btn btn-simple btn-info btn-just-icon pull-left" title="اختصاص گروه تردد"
                                                        @click.prevent="assignGateGroup(record)">
                                                        <i class="material-icons">verified_user </i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </div>

                                                @can('command_permission')
                                                    <a href="#" class="btn btn-simple btn-info btn-just-icon pull-left" title="اختصاص مجوز"
                                                        @click.prevent="assignGroupPermit(record)">
                                                        <i class="material-icons">person</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                {{-- /List Data Table --}}
                            </div>
                            {{-- /Data List --}}

                            <!-- Register Form -->
                            <div v-if="isRegisterMode">
                                @include('searches.edit')
                            </div>
                            <!-- /Register Form -->

                            {{-- Assign permission dialog --}}
                            <div v-if="isAssignGrouppermit">
                                @include('searches.assign-group-permit.index')
                            </div>
                            {{-- /Assign permission dialog --}}

                             {{-- Assign Gate Group dialog --}}
                            <div v-if="isAssignGateGroup">
                                @include('searches.assign-gate-group.index')
                            </div>
                            {{-- /Assign Gate Group dialog --}}


                        </div>
                        <div class="row">
                            <!-- Search Form -->
                            <div v-if="isSearchMode">
                                @include('searches.search')
                            </div>
                            <!-- /Search Form -->
                        </div>

                         <!-- Parent modal -->
                        <div class="modal fade" id="ParentRecordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-notice">
                                <div class="modal-content">
                                    @include('searches.assign-parent.index')
                                </div>
                            </div>
                        </div>
                        <!-- /Parent modal -->
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
        group_students: {{ \App\People::$GROUP_STUDENTS }},
        group_staffs: {{ \App\People::$GROUP_STAFFS }},
        group_teachers: {{ \App\People::$GROUP_TEACHERS }}
    };
</script>
<script type="text/javascript" src="{{ mix('js/pages/searches/index.js') }}"></script>
@endsection
