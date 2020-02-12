 {{-- Title --}}
<h3 class="card-title">
    <div>
        <div v-if = "isNormalMode">
             <i class="fa fa-chart-pie fa-2x"></i>
             <i class="fa fa-sign-out"></i>
             <span class="panel-heading">گزارش ورود  و خروج</span>
        </div>
            {{-- @can('command_savetraffic') --}}
            <span class="pull-left" v-show="isNormalMode">
                <a class="btn btn-rose" href="{{ route('download_all_traffic') }}">
                    <span class="glyphicon glyphicon-print"></span>
                  چاپ PDF
                </a>
            </span>
            {{-- @endcan --}}
        @can('command_savetraffic')
            <span class="pull-left" v-show="isNormalMode">
                <a class="btn btn-rose" href="#"
                    data-toggle="modal" data-target="#ManualRecordModal"
                    title = "ثبت دستی تردد" >
                    <span class="glyphicon glyphicon-plus"></span>
                    ثبت دستی تردد
                </a>
            </span>
        @endcan

        @can('command_search')
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
                رکوردی ثبت نشده است
            </h4>
        </div>
        {{-- List Data Table --}}
        <table id="myTable" class="table table-striped table-hover" v-show="hasRow">
            <thead v-show="!isLoading">
                <td>شماره کاربری</td>
                <td>نام</td>
                <td>نام خانوادگی</td>
                <td>جهت تردد</td>
                <td>دستگاه تردد</td>
                <td> تاریخ تردد</td>
                <td> پیام </td>
            </thead>

            <tbody>
                <tr v-if="isLoading">
                    <td colspan="2" class="text-center">در حال بارگذاری اطلاعات</td>
                </tr>

               <tr v-for="record in records">
                <td>@{{ record.user.code }}</td>
                <td>@{{ record.user.people.name }}</td>
                <td>@{{ record.user.people.lastname }}</td>
                <td>@{{ record.gatedirect.name }}</td>
                <td> @{{ record.gatedevice.name }}</td>
                <td> @{{ toPersian(record.gatedate) }}</td>
                <td>@{{ record.gatemessage.message }}</td>
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
    </div>
    {{-- /Data List --}}
</div>
