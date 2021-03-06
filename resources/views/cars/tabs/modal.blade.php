                        <!--  Modal Header  -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="carModal">ویرایش کارت</h5>
                            <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">
                                <i class="material-icons">close</i>
                            </button>
                        </div>
                        <!--  /Modal Header  -->

                        <!--  Modal Body  -->
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div v-if="! hasSearchDataCar">
                                            <h4 class="text-center f-BYekan">
                                                رکوردی ثبت نشده است
                                            </h4>
                                        </div>
                                         <!--  List Data Table  -->
                                            <table id="myTable" class="table table-striped table-hover" v-show="hasSearchDataCar">
                                                <thead v-show="!isLoading">
                                                    <td>شماره پلاک</td>
                                                    <td>شماره برچسب</td>
                                                    <td>تاریخ شروع اعتبار</td>
                                                    <td>تاریخ پایان اعتبار</td>
                                                    <td>وضعیت</td>
                                                    <td></td>
                                                </thead>

                                                <tbody>
                                                    <tr v-if="isLoading">
                                                        <td colspan="2" class="text-center">در حال بارگذاری اطلاعات</td>
                                                    </tr>

                                                    <tr v-for="data in searchDataCar">
                                                        <td>@{{ data.plate_first }}
                                                            @{{ data.plate_word }}
                                                            @{{ data.plate_second }}
                                                        </td>
                                                        <td>@{{ data.card.cdn }}</td>
                                                        <td>@{{ toPersian(data.card.startDate)}}</td>
                                                        <td>@{{ toPersian(data.card.endDate)}}</td>
                                                        <td>@{{ data.card.stateStr }}</td>
                                                        <td>
                                                            @can('command_edit')
                                                                <a href="#"
                                                                    class="btn btn-simple btn-info btn-just-icon pull-left"
                                                                    @click.prevent="editDataCar(data)"
                                                                     data-dismiss="modal">
                                                                    <i class="material-icons">create</i>
                                                                    <div class="ripple-container"></div>
                                                                </a>
                                                            @endcan

                                                            @can('command_delete')
                                                                <a href="#" class="btn btn-simple btn-danger btn-just-icon pull-left"
                                                                     @click.prevent="readyToDelete(data)">
                                                                    <i class="material-icons">clear</i>
                                                                    <div class="ripple-container"></div>
                                                                </a>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            {{-- /List Data Table --}}

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  /Modal Body  -->

                        <!--  Modal Footer  -->
                        <div class="modal-footer justify-content-center">
                                <span class="pull-left" >
                                     <button type="button" class="btn btn-info btn-round"  @click.prevent="" data-dismiss="modal">انصراف</button>
                                </span>
                        </div>
                        <!--  /Modal Footer  -->


