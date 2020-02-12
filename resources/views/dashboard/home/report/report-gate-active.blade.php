                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">گزارش گیت  های  فعال
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

                                            <div v-if="! hasGateActiveReportRow">
                                                <h4 class="text-center f-BYekan">
                                                    رکوردی ثبت نشده است
                                                </h4>
                                            </div>

                                            <!-- List Data Table -->
                                            <div class="table-responsive col-md-12">
                                                <table id="myTable"
                                                        class="table table-striped table-hover"
                                                        v-show="hasGateActiveReportRow">
                                                    <thead v-show="!isLoading">
                                                        <td>نام دستگاه</td>
                                                        <td>آدرس آی پی</td>
                                                        <td>مسیر عبور</td>
                                                        <td>جنسیت ترددکننده</td>
                                                        <td>نحوه عبور</td>
                                                        <td>منطقه عبور</td>
                                                    </thead>

                                                    <tbody>
                                                        <tr v-if="isLoading">
                                                            <td colspan="2" class="text-center">در حال بارگذاری اطلاعات</td>
                                                        </tr>

                                                        <tr v-for="record in gateActiveRecords">
                                                            <td>@{{ record.name }}</td>
                                                            <td>@{{ record.ip }}</td>
                                                            <td>@{{ record.gatedirect }}</td>
                                                            <td>@{{ record.gategender }}</td>
                                                            <td>@{{ record.gatepass }}</td>
                                                            <td>@{{ record.gatezone }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /List Data Table -->
                                        </div>
                                        <!-- /Data List -->

                                        <!-- small modal -->
                                        <div class="modal fade"
                                            id="GateActiveReportModal"
                                            tabindex="-2"
                                            role="dialog"
                                            aria-labelledby="myModalLabel"
                                            aria-hidden="true">

                                        </div>
                                        <!--    end small modal -->
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


