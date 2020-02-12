                        {{-- Modal Header --}}
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">اطلاعات والدین</h5>
                            <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">
                                <i class="material-icons">close</i>
                            </button>
                        </div>
                        {{-- /Modal Header --}}

                        {{-- Modal Body --}}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        {{-- Data list --}}
                                        <div v-show="isNormalModalMode">
                                           <!--  <div v-if="! hasParent">
                                                <h4 class="text-center f-BYekan">
                                                    رکوردی ثبت نشده است
                                                </h4>
                                            </div> -->
                                            {{-- List Data Table --}}
                                            <table id="myTable" class="table table-striped table-hover">
                                                <thead v-show="!isLoading">
                                                    <td>نسبت</td>
                                                    <td>نام</td>
                                                    <td>نام خانوادگی</td>
                                                    <td>تلفن ثابت</td>
                                                    <td>موبایل</td>
                                                    <td></td>
                                                </thead>

                                                <tbody>
                                                    <tr v-if="isLoading">
                                                        <td colspan="2" class="text-center">در حال بارگذاری اطلاعات</td>
                                                    </tr>

                                                    <tr v-for="parent in parents.parents">
                                                        <td>@{{ parent.kintype.name }}</td>
                                                        <td>@{{ parent.name }}</td>
                                                        <td>@{{ parent.lastname }}</td>
                                                        <td>@{{ parent.phone }}</td>
                                                        <td>@{{ parent.mobile }}</td>

                                                        <td>
                                                            @can('command_edit')
                                                                <a href="#" class="btn btn-simple btn-info btn-just-icon pull-left" @click.prevent="editParentRecord(parent)">
                                                                    <i class="material-icons">create</i>
                                                                    <div class="ripple-container"></div>
                                                                </a>
                                                            @endcan


                                                            @can('command_delete')
                                                                <a href="#" class="btn btn-simple btn-danger btn-just-icon pull-left"
                                                                    {{-- data-toggle="modal" data-target="#removeRecordModal" --}}
                                                                     @click.prevent="readyToDeleteParent(parent)">
                                                                     {{-- @click.prevent="deleteParentRecord(parent)"> --}}

                                                                    <i class="material-icons">clear</i>
                                                                    <div class="ripple-container"></div>
                                                                </a>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            {{-- /List Data Table --}}

                                          <!--   <pagination :data="allData" v-on:pagination-change-page="loadParentRecords"></pagination> -->
                                        </div>
                                        {{-- /Data List --}}

                                        {{-- Register Form --}}
                                        <div v-if="isRegisterParentMode">
                                            @include('people.assign-parent.create')
                                        </div>
                                        {{-- /Register Form --}}

                                        <!-- small modal -->
                                        <div class="modal fade" id="removeRecordModal" tabindex="-2" role="dialog"
                                            aria-labelledby="myModalLabel" aria-hidden="true">

                                            <div class="modal-dialog modal-small ">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close"
                                                            data-dismiss="modal" aria-hidden="true">
                                                            <i class="material-icons">clear</i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <h5>برای حذف اطمینان دارید؟ </h5>
                                                    </div>
                                                    <div class="modal-footer text-center">
                                                        <button type="button" class="btn btn-simple" data-dismiss="modal">خیر</button>
                                                        <button type="button" class="btn btn-success btn-simple"  data-dismiss="modal"
                                                            @click.prevent="deleteParentRecord">بله</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--    end small modal -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- /Modal Body --}}

                        {{-- Modal Footer --}}
                        <div class="modal-footer justify-content-center">
                            @can('command_insert')
                                <span class="pull-left" v-show="isNormalModalMode">
                                    <button type="button" class="btn btn-info btn-round"  @click.prevent="newParentRecord">ثبت رکورد جدید</button>
                                     <button type="button" class="btn btn-info btn-round"  @click.prevent="registerParentCancel" data-dismiss="modal">انصراف</button>
                                </span>
                            @endcan
                        </div>
                        {{-- /Modal Footer --}}


