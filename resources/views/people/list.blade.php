<div class="card-body">
    <div class="tab-content">
        <div class="tab-pane active" id="profile">

            <!-- Data list -->
            <div v-show="isNormalMode">

                <div v-if="! hasRow">
                    <h4 class="text-center f-BYekan">
                        رکوردی ثبت نشده است
                    </h4>
                </div>
                <!-- List Data Table -->
                <div class="table-responsive col-md-12">
                    <table id="myTable" class="table table-striped table-hover" v-show="hasRow">
                        <thead v-show="!isLoading">
                            <td></td>
                            <td>کد شناسایی</td>
                            <td>گروه</td>
                            <td>کد ملی</td>
                            <td>نام</td>
                            <td>نام خانوادگی</td>
                            <td>تاریخ تولد</td>
                            <td>جنسیت</td>
                            <td>وضعیت</td>
                            <td></td>
                        </thead>

                        <tbody>
                            <tr v-if="isLoading">
                                <td colspan="2" class="text-center">در حال بارگذاری اطلاعات</td>
                            </tr>

                            <tr v-for="record in records">
                                <td>
                                    <div class="picture-container">
                                        <div class="picture">
                                            <img  :src="record.people.pictureThumbUrl"
                                                    class="picture-src larger"
                                                    title="" />
                                        </div>
                                    </div>
                                </td>
                                <td>@{{ record.code }}</td>
                                <td>@{{ record.group.name }}</td>
                                <td>@{{ record.people.nationalId }}</td>
                                <td>@{{ record.people.name }}</td>
                                <td>@{{ record.people.lastname }}</td>
                                <td>@{{ toPersian(record.people.birthdate)}}</td>
                                <td>@{{ record.people.gender.gender }}</td>
                                <td>@{{ record.stateStr }}</td>

                                <td class="text-left" width="250">
                                      @can('command_delete')
                                        <a href="#"
                                            class="btn btn-round btn-just-icon pull-left"
                                            data-toggle="modal"
                                            data-target="#removeRecordModal"
                                            title = "حذف"
                                            @click.prevent="readyToDelete(record)">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            <div class="ripple-container"></div>
                                        </a>
                                    @endcan

                                    @can('command_edit')
                                        <a href="#"
                                            class="btn btn-round btn-info btn-just-icon like pull-left"
                                            title="ویرایش"
                                            @click.prevent="editRecord(record)">
                                            <i class="fas fa-pen"></i>
                                            <div class="ripple-container"></div>
                                        </a>
                                    @endcan

                                    @can('command_permission')
                                        <a href="#"
                                            class="btn btn-round btn-info btn-just-icon pull-left"
                                            title="اختصاص مجوز"
                                            @click.prevent="setGroupPermit(record)">
                                            <i class="fas fa-key"></i>
                                            <div class="ripple-container"></div>
                                        </a>
                                    @endcan

                                     <!-- @can('command_delete') -->
                                    <div v-if="isShowParent">
                                        <a href="#" class="btn btn-round btn-info btn-just-icon pull-left"
                                            data-toggle="modal" data-target="#ParentRecordModal" title = "ثبت والدین"
                                            @click.prevent="assignParent(record)">
                                            <i class="fa fa-users"></i>
                                            <div class="ripple-container"></div>
                                        </a>
                                    </div>

                                    <!-- @endcan -->

                                    <div v-if="isShowGateGroup">
                                         <a href="#" class="btn btn-round btn-info btn-just-icon pull-left" title="اختصاص گروه تردد"
                                            @click.prevent="setGateGroup(record)">
                                            <i class="fas fa-shield-alt"></i>
                                            <div class="ripple-container"></div>
                                        </a>
                                    </div>

                                    <div v-if="isShowTerm">
                                        <a href="#" class="btn btn-round btn-info btn-just-icon pull-left"
                                                     title="اختصاص نیمسال تحصیلی"
                                                    @click.prevent="setTerm(record)">
                                                    {{-- <i class="fas fa-user-graduate"></i> --}}
                                                    <i class="fas fa-graduation-cap"></i>
                                        </a>
                                    </div>

                                    <div v-if="isShowFingerPrint">
                                        <a href="#" class="btn btn-round btn-info btn-just-icon pull-left"
                                                     title="اختصاص اثر انگشت"
                                                    @click.prevent="setFingerPrint(record)">
                                                    <i class="fas fa-hand-point-up"></i>
                                        </a>
                                    </div>

                                    <div v-if="isShowGatePlan">
                                         <a href="#" class="btn btn-round btn-info btn-just-icon pull-left" title="اختصاص برنامه تردد"
                                            @click.prevent="setGatePlan(record)">
                                            <i class="fa fa-calendar"></i>
                                            <div class="ripple-container"></div>
                                        </a>
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /List Data Table -->
                <div class="text-center">
                    <pagination :data="allData"
                                v-on:pagination-change-page="loadRecords"
                                :limit= "{{ \App\Http\Controllers\Controller::C_PAGINATION_LIMIT }}"
                                :show-disable= "true">
                    </pagination>
                </div>
            </div>
            <!-- /Data List -->

            <!-- Register Form -->
            <div v-show="isRegisterMode">
                @include('people.create')
            </div>
            <!-- /Register Form -->

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

             <!-- Assign permission dialog -->
            <div v-show="isAssignGrouppermit">
                @include('people.assign-group-permit.assign-group-permit')
            </div>
            <!-- /Assign permission dialog -->

             <!-- Assign Term dialog -->
            <div v-show="isAssignTerm">
                @include('people.assign-term.assign-term-index')
            </div>
            <!-- /Assign permission dialog -->

             <!-- Assign Gate Group dialog -->
            <div v-show="isAssignGateGroup">
                @include('people.assign-gate-group.assign-gate-group')
            </div>
            <!-- /Assign Gate Group dialog -->

             <!-- Assign Finger Print dialog -->
            <div v-show="isAssignFingerPrint">
                @include('people.assign-finger-print.assign-finger-print')
            </div>
            <!-- /Assign Finger Print dialog -->

            <!-- Assign Gate Plan dialog -->
            <div v-show="isAssignGatePlan">
                @include('people.assign-gate-plan.assign-gate-plan')
            </div>
            <!-- /Assign Gate Plan dialog -->

            <!-- Parent modal -->
            <div class="modal fade"
                id="ParentRecordModal"
                tabindex="-1"
                role="dialog"
                 aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-notice">
                    <div class="modal-content">
                        @include('people.assign-parent.index')
                    </div>
                </div>
            </div>
            <!-- /Parent modal -->

            <!-- relaod data modal -->
            <div class="modal fade" id="reloadRecordModal" tabindex="-1" role="dialog"
                aria-labelledby="reloadModalLabel" aria-hidden="true">

                <div class="modal-dialog modal-small ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close"
                                data-dismiss="modal" aria-hidden="true">
                                <i class="material-icons">clear</i>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <h5>مشخصات این کد ملی قبلا ثبت شده است. آیا فراخوانی گردد؟</h5>
                        </div>
                        <div class="modal-footer text-center">
                            <button type="button"
                                    class="btn btn-simple"
                                    data-dismiss="modal">خیر
                                </button>
                            <button type="button"
                            class="btn btn-success btn-simple"
                            data-dismiss="modal"
                                @click.prevent="loadRecordByNationalCode">بله
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /small modal -->

        </div>
    </div>
</div>
