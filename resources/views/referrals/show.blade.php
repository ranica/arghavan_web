<div v-show="isShowMode">
    <div class="card">
        <div class="card-content">
        {{-- Title --}}
        <h3 class="card-title">
            <div>
                <span class="panel-heading">بررسی مراجعه کننده</span>

                @can('command_insert')
                    <span class="pull-left" v-show="isShowMode">
                        <a class="btn btn-rose" href="#" @click.prevent="newRecord">
                            <span class="glyphicon glyphicon-plus"></span>
                            ثبت رکورد جدید
                        </a>
                    </span>
                @endcan

            </div>
        </h3>
        {{-- /Title --}}

            <div v-if="! hasRow">
                <h4 class="text-center f-BYekan">
                    رکوردی ثبت نشده است
                </h4>
            </div>
            {{-- List Data Table --}}

            <table id="myTable" class="table table-striped table-hover" v-show="hasRow">
                <thead v-show="!isLoading">
                    <td></td>
                    <td>نام</td>
                    <td>نام خانوادگی</td>
                    <td>کد ملی</td>
                    <td>موبایل</td>
                    <td>ملاقات شونده</td>
                    <td>واحد ملاقات شونده</td>
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
                                    <img  :src="record.referral.pictureThumbUrl" class="picture-src larger" title="" />
                                </div>
                            </div>
                        </td>
                        <td>@{{ record.name }}</td>
                        <td>@{{ record.lastname }}</td>
                        <td>@{{ record.nationalId }}</td>
                        <td>@{{ record.mobile }}</td>
                        <td>@{{ record.user.name }}</td>
                        <td>@{{ record.department.name }}</td>

                        <td>
                            <!-- @can('command_edit') -->
                                <a href="#" class="btn btn-simple btn-info btn-just-icon pull-left" @click.prevent="showRecord(record)">
                                    <i class="material-icons">search</i>
                                    <div class="ripple-container"></div>
                                </a>
                            <!-- @endcan -->

                            @can('command_edit')
                                <a href="#" class="btn btn-simple btn-info btn-just-icon pull-left" @click.prevent="editRecord(record)">
                                    <i class="material-icons">create</i>
                                    <div class="ripple-container"></div>
                                </a>
                            @endcan

                            @can('command_delete')
                                <a href="#" class="btn btn-simple btn-danger btn-just-icon pull-left"
                                    data-toggle="modal" data-target="#removeRecordModal" @click.prevent="readyToDelete(record)">

                                    <i class="material-icons">clear</i>
                                    <div class="ripple-container"></div>
                                </a>
                            @endcan

                        </td>
                    </tr>
                </tbody>
            </table>
            {{-- /List Data Table --}}

            <div class="text-center">
                <pagination :data="allData"
                            v-on:pagination-change-page="loadRecords"
                            :limit= {{ \App\Http\Controllers\Controller::C_PAGINATION_LIMIT }}
                            :show-disable= true>
                </pagination>
            </div>

            {{-- /Data List --}}



        </div>
    </div>
</div>

