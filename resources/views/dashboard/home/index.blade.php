@can('chart_number')
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <simple-counter background-color="blue"
                        :value="trafficPresentsCount"
                        icon="equalizer"
                        text="حاضرین"
                        :is-loading="loadingTrafficPresents"
                        item-key="key1"
                        @title-click="titleClick"
                        @on-refresh="refreshChart('traffic-presents')" >
            </simple-counter>
    </div>

     <div class="col-md-3 col-sm-6 col-xs-12">
        <simple-counter background-color="orange"
                        :value="gatedeviceActiveCount"
                        icon="cell_wifi"
                        text="گیت های فعال"
                        :is-loading="loadingActiveGatedevice"
                        item-key="key2"
                        @title-click="titleClick"
                        @on-refresh="refreshChart('gatedevice-active')" >
        </simple-counter>
    </div>

     <div class="col-md-3 col-sm-6 col-xs-12">
        <simple-counter background-color="rose"
                        :value="postedSMSCount"
                        icon="message"
                        text="پیامک های ارسالی"
                        :is-loading="loadingPostedSMS"
                        item-key="key3"
                        @title-click="titleClick"
                        @on-refresh="refreshChart('posted-SMS')">
        </simple-counter>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <simple-counter background-color="green"
                        :value="referralDataCount"
                        icon="group"
                        text="ارباب رجوع ها"
                        :is-loading="loadingReferralData"
                        @on-refresh="refreshChart('referral-data')">
        </simple-counter>
    </div>
</div>
@endcan

@can('gate_device')
    <h3>
        <div class="panel-heading my-dashboard">گیت های کنترل تردد</div>
    </h3>
    <br>
    <div class="row">
        <gate-widget class="col-md-3" v-for="item in gaterecords" :gate-data="item" @refresh-data="refreshGate">
            <a href="#"
                @click.prevent="unlockInput(item)"
                color="white"
                title="ورود">
                <i class="fas fa-unlock-alt icon-background-input fa-3x"></i>
            </a>
            <a href="#"
                @click.prevent="unlockOutput(item)"
                color="black"
                title="خروج">
                <i class="fas fa-unlock-alt icon-background fa-3x"></i>
            </a>
        </gate-widget>
    </div>
@endcan

@can('chart_traffic')
    <h3>
        <div class="panel-heading my-dashboard">گزارشات آماری</div>
    </h3>
    <br>
    <div class="row">
        {{-- Daily Chart --}}
        <div class="col-md-6">
            <div class="card card-chart">
                <div class="card-header card-header-rose">
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
                    <i class="fa fa-refresh fa-2x pd-right-05em pd-left-05em cursor-pointer"
                       @click.prevent="refreshChart('traffic-daily')"></i>
                    <h4 class="card-title inline-block">تردد های روازنه</h4>
                    <p class="card-category pd-right-05em">  {{App\Home::todayDashboard()}} </p>
                </div>
            </div>
        </div>
        {{-- /Daily Chart --}}

        {{-- Weekly Chart --}}
        <div class="col-md-6">
            <div class="card card-chart">
                <div class="card-header card-header-warning">
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
                    <i class="fa fa-refresh fa-2x pd-right-05em pd-left-05em cursor-pointer" @click.prevent="refreshChart('traffic-weekly')"></i>
                    <h4 class="card-title inline-block">تردد های هفتگی</h4>
                    <p class="card-category pd-right-05em">&nbsp;</p>
                </div>
            </div>
        </div>
        {{-- /Weekly Chart --}}

        {{-- Monthly Chart --}}
       <!--  <div class="col-md-6">
            <div class="card card-chart">
                <div class="card-header card-header-rose">
                    <div v-if="loadingTrafficMonthly" class="text-center color-white">
                        <i class="fa fa-refresh fa-spin fa-fw fa-16x"></i>
                    </div>
                    <chartist v-show="! loadingTrafficMonthly" :ratio="aspectRatio" type="Bar" :data="monthlyChartData" :options="monthlyChartOptions">
                    </chartist>
                </div>
                <div class="card-body row">
                    <i class="fa fa-refresh fa-2x pd-right-05em pd-left-05em cursor-pointer" @click.prevent="refreshChart('traffic-monthly')"></i>
                    <h4 class="card-title inline-block">تردد های ماهانه</h4>
                    <p class="card-category pd-right-05em">تاریخ : MONTH</p>
                </div>
            </div>
        </div> -->
        {{-- /Monthly Chart --}}
    </div>
@endcan
