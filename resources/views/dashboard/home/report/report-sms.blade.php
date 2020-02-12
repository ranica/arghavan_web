                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">گزارش پیامک های ارسالی
                                <button type="button"
                                        class="close"
                                        data-dismiss="modal"
                                        aria-hidden="true">
                                    <i class="material-icons">close</i>
                                </button>
                            </h5>
                        </div>
                        <!-- /Modal Header -->

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <!-- Data list -->
                                        <div v-show="isNormalMode">
                                            <div v-if="! hasSMSReportRow">
                                                <h4 class="text-center f-BYekan">
                                                    رکوردی ثبت نشده است
                                                </h4>
                                            </div>

                                            <!-- List Data Table -->
                                            <div class="table-responsive col-md-12">
                                                <table id="myTable"
                                                        class="table table-striped table-hover"
                                                        v-show="hasSMSReportRow">
                                                    <thead v-show="!isLoading">
                                                        <td>کد کاربری</td>

                                                    </thead>

                                                    <tbody>
                                                        <tr v-if="isLoading">
                                                            <td colspan="2" class="text-center">در حال بارگذاری اطلاعات</td>
                                                        </tr>

                                                        <tr v-for="record in smsRecords">
                                                            <td>@{{ record.code }}</td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                         <!--    <div class="text-center">
                                                <pagination :data="allData"
                                                            v-on:pagination-change-page="loadReportPresents"
                                                            :limit= "{{ \App\Http\Controllers\Controller::C_PAGINATION_LIMIT }}"
                                                            :show-disable= "true">
                                                </pagination>
                                            </div> -->
                                            <!-- /List Data Table -->
                                        </div>
                                        <!-- /Data List -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Modal Body -->

                        <!-- Modal Footer -->
                        <div class="modal-footer justify-content-center">
                          <!--   @can('command_insert')
                                <span class="pull-left" v-show="isNormalMode">
                                    <button type="button"
                                            class="btn btn-info btn-round"
                                            @click.prevent="newParentRecord">ثبت رکورد جدید
                                    </button>
                                    <button type="button"
                                            class="btn btn-info btn-round"
                                            @click.prevent="registerParentCancel"
                                            data-dismiss="modal">انصراف
                                    </button>
                                </span>
                            @endcan -->
                        </div>
                        <!-- /Modal Footer -->


