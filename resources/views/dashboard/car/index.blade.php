
@can('chart_number')
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <simple-counter background-color="green"
                        :value="carTrafficPresentsCount"
                        icon="equalizer"
                        text="حاضرین"
                        :is-loading="loadingCarTrafficPresents"
                        @on-refresh="refreshChart('car-traffic-presents')" >
        </simple-counter>
    </div>
@endcan

@can('dashboard_number_chart')
    <div class="col-md-3 col-sm-6 col-xs-12">
        <simple-counter background-color="blue"
                        :value="carTrafficPresentsCount"
                        icon="local_parking"
                        text="ظرفیت پارکینگ"
                        :is-loading="loadingCarTrafficPresents"
                        @on-refresh="refreshChart('car-traffic-presents')" >
        </simple-counter>
    </div>
</div>
@endcan


@can('dashboard_chart')
    <h3>  گزارشات آماری </h3>
    <br>
    <div class="row">
        <!-- pie Chart -->
        <div class="col-md-6">
            <div class="card card-chart">
                <div class="card-header card-header-rose">
                    <div  class="text-center color-white">
                        <i class="fa fa-refresh fa-spin fa-fw fa-16x"></i>
                    </div>
                    <canvas id="barChart" width="500" height="290"></canvas>
                </div>
                <div class="card-body row">
                    <i class="fa fa-refresh fa-2x pd-right-05em pd-left-05em cursor-pointer" @click.prevent="refreshChart('car-traffic-daily')"></i>
                    <h4 class="card-title inline-block">تردد های روازنه</h4>
                    <p class="card-category pd-right-05em">  {{App\Home::todayDashboard()}} </p>
                </div>
            </div>
        </div>
        <!-- /Pie Chart -->
        <!--  Daily Chart  -->
        <div class="col-md-6">
            <div class="card card-chart">
                <div class="card-header card-header-success">
                    <div v-if="loadingTrafficDaily" class="text-center color-white">
                        <i class="fa fa-refresh fa-spin fa-fw fa-16x"></i>
                    </div>
                    <chartist v-show="! loadingTrafficDaily"
                            :ratio="aspectRatio"
                            type="Line"
                            :data="dailyChartData"
                            :options="dailyChartOptions">
                    </chartist>
                </div>
                <div class="card-body row">
                    <i class="fa fa-refresh fa-2x pd-right-05em pd-left-05em cursor-pointer" @click.prevent="refreshChart('car-traffic-daily')"></i>
                    <h4 class="card-title inline-block">تردد های روازنه</h4>
                    <p class="card-category pd-right-05em">  {{App\Home::todayDashboard()}} </p>
                </div>
            </div>
        </div>
        <!--  /Daily Chart  -->
    </div>

    <div class="row">
        <!--  Weekly Chart --->
        <div class="col-md-6">
            <div class="card card-chart">
                <div class="card-header card-header-info">
                    <div v-if="loadingTrafficWeekly" class="text-center color-white">
                        <i class="fa fa-refresh fa-spin fa-fw fa-16x"></i>
                    </div>
                    <chartist ref="weekly_chart"
                              v-show="! loadingTrafficWeekly"
                              :ratio="aspectRatio"
                              type="Bar"
                              :data="weeklyChartData"
                              :options="weeklyChartOptions">
                    </chartist>
                </div>
                <div class="card-body row">
                    <i class="fa fa-refresh fa-2x pd-right-05em pd-left-05em cursor-pointer" @click.prevent="refreshChart('car-traffic-weekly')"></i>
                    <h4 class="card-title inline-block">تردد های هفتگی</h4>
                    <p class="card-category pd-right-05em">&nbsp;</p>
                </div>
            </div>
        </div>
        <!--  /Weekly Chart --->
    </div>

@endcan
