 <div class="card-body">
    <div class="tab-content">
        <div class="tab-pane active" id="profile">
            <!--  Data list  -->
            <div v-show="isNormalMode">
                <div class="text-left">

                </div>

                <div v-if="! hasRow">
                    <h4 class="text-center f-BYekan">
                        رکوردی پیدا نشد
                    </h4>
                </div>
                <!--  List Data Table  -->
                <div class="table-responsive col-md-12">
                    <table id="myTable" class="table table-striped table-hover"  v-show="hasRow">
                        <thead v-show="!isLoading">
                            <td class="text-center">گروه</td>
                            <td class="text-center">شماره کاربری</td>
                            <td class="text-center">نام</td>
                            <td class="text-center">نام خانوادگی</td>
                            <td class="text-center">کد ملی</td>
                            <td class="text-center">شماره کارت</td>
                            <td class="text-center">تاریخ شروع اعتبار</td>
                            <td class="text-center">تاریخ پایان اعتبار</td>
                            <td class="text-center">وضعیت کارت</td>
                            <td class="text-center">نوع کارت</td>
                            <td class="text-center"></td>
                        </thead>
                        <tbody>
                            <tr v-if="isLoading">
                                <td colspan="2" class="text-center">در حال بارگذاری اطلاعات</td>
                            </tr>
                            <tr v-for="record in records">
                                <td class="text-center">@{{ record.users[0].group.name }}</td>
                                <td class="text-center">@{{ record.users[0].code }}</td>
                                <td class="text-center">@{{ record.users[0].people.name }}</td>
                                <td class="text-center">@{{ record.users[0].people.lastname }}</td>
                                <td class="text-center">@{{ record.users[0].people.nationalId }}</td>
                                <td class="text-center">@{{ record.cdn }}</td>
                                <td class="text-center">@{{ toPersian(record.startDate) }}</td>
                                <td class="text-center">@{{ toPersian(record.endDate) }}</td>
                                <td class="text-center">@{{ record.stateStr }}</td>
                                <td class="text-center">@{{ record.cardtype.name }}</td>

                                <td class="text-left" width="160">
                                    @can('command_delete')
                                        <a href="#"
                                            class="btn btn-round btn-just-icon pull-left"
                                            data-toggle="modal"
                                            data-target="#removeRecordModal"
                                            title= "حذف رکورد"
                                            @click.prevent="readyToDelete(record)">
                                            <i class="material-icons">delete</i>
                                            <div class="ripple-container"></div>
                                        </a>
                                    @endcan

                                    @can('command_edit')
                                        <a href="#"
                                            class="btn btn-round btn-info btn-just-icon pull-left"
                                            title= "ویرایش رکورد"
                                            @click.prevent="prepareEdit(record)">
                                            <i class="material-icons">create</i>
                                            <div class="ripple-container"></div>
                                        </a>
                                    @endcan

                                    @can('command_permission')
                                        <a href="#"
                                            class="btn btn-round btn-info btn-just-icon pull-left"
                                            @click.prevent="setGatedeviceRecord(record)"
                                            title="مجوز گیت تردد">
                                            <i class="material-icons">person</i>
                                            <div class="ripple-container"></div>
                                        </a>
                                    @endcan

                                </td>
                            </tr>
                        </tbody>
                    </table>
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
            </div>

            <!--  Register Form  -->
            <div v-show="isRegisterMode">
                @include('cards.create')
            </div>
            <!--  /Register Form  -->

             <!--  Assign GateDevice Form  -->
            <div v-if="isAssignGatedevice">
                @include('cards.assign-gate-device')
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
            <!--  end small modal -->

    </div>
</div>
