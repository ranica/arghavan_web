import Store from './store';
import VueChartist from 'vue-chartist';
import GateWidget from '../../Components/GateWidget';
import CircularCounter from '../../Components/CircularCounter';
import SimpleCounter from '../../Components/SimpleCounter';

Vue.use(VueChartist, {
    messageNoData: "اطلاعاتی ثبت نشده است",
    classNoData: "chart-empty"
});

const LOADING_TRAFFIC_DAILY = 1;
const LOADING_TRAFFIC_WEEKLY = 2;
const LOADING_TRAFFIC_MONTHLY = 4;
const LOADING_TRAFFIC_PRESENTS = 8;
const LOADING_ACTIVE_GATEDEVICE = 16;
const LOADING_POSTED_SMS = 32;
const LOADING_REFERRAL_DATA = 64;


/* Daily chart */
const dailyChartOptions = {
    fullWidth: true,
    seriesBarDistance: 30,
    axisY: {
      labelInterpolationFnc: function (value, index) {
              return index % 2 == 0 ? value: null;
        }
    },
};

const dailyChartData = {
    labels: ["A", "B", "C"],
    series: [
        [1, 3, 2],
        [5, 1, 3]
    ]
};

/* Weekly chart */
const weeklyChartOptions = dailyChartOptions;
const weeklyChartData    = dailyChartData;

/* Monthly chart */
const monthlyChartOptions = dailyChartOptions;
const monthlyChartData    = dailyChartData;

/* Instantiated VueJs */
window.x = new Vue({
    el: '#app',

    store: Store,

    components: {
        GateWidget,
        CircularCounter,
        SimpleCounter,
    },

    data: {
        formMode: Enums.FormMode.normal,
        loadingStatus: 0,
        trafficPresentsCount: 0,
        gatedeviceActiveCount: 0,
        postedSMSCount: 0,
        referralDataCount: 0,
        isLoading: true,

        dailyChartData,
        dailyChartOptions,
        weeklyChartData,
        weeklyChartOptions,
        monthlyChartData,
        monthlyChartOptions,

        tempRecord: {},
        options: {
            sign: 'نفر',
            bakckground: 'white',
            textFillStyle: '#26c6da',
            fontFamily: 'BYekan',
            normalLineWidth: 15,
            filledStrokeStyle: '#26c6da',
            filledLineWidth: 25,
            normalStrokeStyle: '#b3b6b7'
        }
    },

    computed: {
        isNormalMode: state => state.formMode == Enums.FormMode.normal,

        records: state => state.$store.getters.records,
        allData: state => state.$store.getters.allData,
        hasRow: state => (0 < state.records.length),


        gategenders: state => state.$store.getters.gategenders,
        gatepasses: state => state.$store.getters.gatepasses,
        gatedirects: state => state.$store.getters.gatedirects,
        zones: state => state.$store.getters.zones,

        gaterecords: state => state.$store.getters.gaterecords,
        hasGateRecordRow: state => (0 < state.$store.getters.gaterecords.length),

        /**
         * Report Present in Dashboar
         */
        presentRecords: state => state.$store.getters.presentReports,
        hasPresentReportRow: state =>(0 < state.$store.getters.presentReports.length),

        /**
         * Report Gate Active In Dashboard
         */
        gateActiveRecords: state => state.$store.getters.gateActiveReports,
        hasGateActiveReportRow: state =>(0 < state.$store.getters.gateActiveReports.length),

        /**
         * Report SMS in Dashboard
         */
        smsRecords: state => state.$store.getters.smsReports,
        hasSMSReportRow: state =>(0 < state.$store.getters.smsReports.length),


        loadingPostedSMS: state => (state.loadingStatus & LOADING_POSTED_SMS) == LOADING_POSTED_SMS,
        loadingReferralData: state => (state.loadingStatus & LOADING_REFERRAL_DATA) == LOADING_REFERRAL_DATA,
        loadingActiveGatedevice: state => (state.loadingStatus & LOADING_ACTIVE_GATEDEVICE) == LOADING_ACTIVE_GATEDEVICE,
        loadingTrafficPresents: state => (state.loadingStatus & LOADING_TRAFFIC_PRESENTS) == LOADING_TRAFFIC_PRESENTS,
        loadingTrafficDaily: state => (state.loadingStatus & LOADING_TRAFFIC_DAILY) == LOADING_TRAFFIC_DAILY,
        loadingTrafficWeekly: state => (state.loadingStatus & LOADING_TRAFFIC_WEEKLY) == LOADING_TRAFFIC_WEEKLY,
        loadingTrafficMonthly: state => (state.loadingStatus & LOADING_TRAFFIC_MONTHLY) == LOADING_TRAFFIC_MONTHLY,

        aspectRatio: state => 'ct-golden-section',
        emptyRecord() {
            return {
                id: 0,
                name: '',
                ip: '',
                state: '',
                timeserver: '',
                timepass: '',
                type: '', // Logical or Physical
                gategender: {
                    id: 0
                },
                gatepass: {
                    id: 0
                },
                gatedirect: {
                    id: 0
                },
                zone: {
                    id: 0
                },
                editMode: false,
                refreshMode: false,
            };
        },

    },

    created() {
        this.tempRecord = this.emptyRecord;
    },

    mounted() {
        this.loadChartData();
    },

    methods: {
        titleClick(sender){
            if ('key1' == sender){
                this.loadReportPresents();
            }
            if('key2' == sender){
                this.loadReportGateActives();
            }
            if('key3' == sender){
                this.loadReportSMS();
            }
        },
        /**
         * Loads a report present.
         */
        loadReportPresents() {
            let data = {
                url: document.pageData.home.report_daily_traffic_url
            };

            this.$store.dispatch('loadReportPresents', data)
                .then(res => {
                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
                });
                $('#PresentReportModal').modal('show');
        },

        /**
         * Loads a report gatedevice active.
         */
        loadReportGateActives() {
            let data = {
                url: document.pageData.home.report_active_gatedevice_url
            };

            this.$store.dispatch('loadReportGateActives', data)
                .then(res => {
                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
                });
                $('#GateActiveReportModal').modal('show');
        },

         /**
         * Loads a report SMS
         */
        loadReportSMS() {
            let data = {
                url: document.pageData.home.report_posted_sms_url
            };

            this.$store.dispatch('loadReportSMS', data)
                .then(res => {
                    this.isLoading = false;
                    $('#SMSReportModal').modal('show');
                })
                .catch(err => {
                    this.isLoading = false;
                });

        },
        /**
         * Refersh Chart
         */
        refreshGate(){
            this.loadRecords(1);
        },
         /**
         * Convert gregorian date to persian
         */
        toPersian(gDate) {
            return window.Helper.gregorianToJalaali(gDate);
        },

        /**
         * Unlocks the input.
         *
         * @param      {<type>}  item    The item
         */
        unlockInput(item){
            let data = {
                        command: '['+ item.id +',53011]',
                        };
            this.$store.dispatch('unlockGate', data)
               .then(res => {
                    if (res.data.status == 0) {
                        demo.showNotification('اطلاعات با موفقیت ارسال شد', 'success');
                    }
                    else {
                        demo.showNotification('خطا در ارسال اطلاعات', 'warning');
                    }
                })
                .catch(err => {

                    if (err.response.status) {
                        demo.showNotification('اطلاعات ارسال نشد', 'danger');
                    }
                    else {
                        demo.showNotification(err.message, 'danger');
                    }
                });

            // SocketClient.socketOpened = () => {
            //     let data = '['+ item.id +',53011]';
            //     SocketClient.send (data);
            //     SocketClient.disconnect();
            // };
            // SocketClient.connect(document.pageData.webSocketServer,
            //                     document.pageData.webSocketServerPort,
            //                     (e) => {
            //                         console.log (e);
            //                     });
        },

        /**
         * Unlocks the output.
         */
        unlockOutput(item){
            let data = {
                        command: '['+ item.id +',54011]',
                        };
            this.$store.dispatch('unlockGate', data)
               .then(res => {
                    if (res.data.status == 0) {
                        demo.showNotification('اطلاعات با موفقیت ارسال شد', 'success');
                    }
                    else {
                        demo.showNotification('خطا در ارسال اطلاعات', 'warning');
                    }
                })
                .catch(err => {

                    if (err.response.status) {
                        demo.showNotification('اطلاعات ارسال نشد', 'danger');
                    }
                    else {
                        demo.showNotification(err.message, 'danger');
                    }
                });

            // SocketClient.socketOpened = () => {
            //     let data = '['+ item.id +',53011]';
            //     SocketClient.send (data);
            //     SocketClient.disconnect();
            // };
            // SocketClient.connect(document.pageData.webSocketServer,
            //                     document.pageData.webSocketServerPort,
            //                     (e) => {
            //                         console.log (e);
            //                     });
        },

        /**
         * Unlocks the Output.
         *
         * @param      {<type>}  item    The item
         */
        // unlockOutput(item){
        //     SocketClient.socketOpened = () => {
        //             let data = '[' + item.id + ',54011]';
        //             SocketClient.send (data);
        //             SocketClient.disconnect();
        //         };
        //     SocketClient.connect(document.pageData.webSocketServer,
        //                         document.pageData.webSocketServerPort,
        //                         (e) => {
        //                             console.log (e);
        //                         });
        // },

        /**
         * Set Loading Status
         */
        setLoadingStatus(status) {
            this.loadingStatus = this.loadingStatus | status;
        },

        /**
         * Remove Loading Status
         *
         * @param      {<type>}  status  The status
         */
        removeLoadingStatus(status) {
            this.loadingStatus = this.loadingStatus & ~status;
        },

        /**
         * Refresh chart
         *
         * @param      {<type>}  type    The type
         */
        refreshChart(type) {
            if (type == 'traffic-daily') {
                this.loadDailyTraffics();

                return;
            }

            if (type == 'traffic-weekly') {
                this.loadWeeklyTraffics();

                return;
            }

            if (type == 'traffic-monthly') {
                this.loadMonthlyTraffics();

                return;
            }

            if (type == 'traffic-presents') {
                this.loadDailyCountTraffices();

                return;
            }

            if (type == 'gatedevice-active') {
                this.loadActiveCountGatedevices();

                return;
            }

            if (type == 'posted-SMS') {
                this.loadPostedSMSCount();

                return;
            }

            if (type == 'referral-data') {
                this.loadReferralDataCount();

                return;
            }
        },

        /**
         * Load Chart data
         */
        loadChartData() {
            // count data
            this.loadDailyCountTraffices();
            this.loadPostedSMSCount();
            this.loadReferralDataCount();
            this.loadActiveCountGatedevices();
            // chart
            this.loadDailyTraffics();
            this.loadWeeklyTraffics();
            this.loadMonthlyTraffics();
            this.loadRecords(1);
        },

         /**
         * Load Posted SMS
         */
        loadPostedSMSCount() {
            let url = document.pageData.home.count_posted_sms_url;

            this.setLoadingStatus(LOADING_POSTED_SMS);

            setTimeout(() => {
                axios.get(url)
                    .then(res => {
                        this.postedSMSCount = res.data;
                        this.removeLoadingStatus(LOADING_POSTED_SMS);
                    })
                    .catch(err => {
                        this.removeLoadingStatus(LOADING_POSTED_SMS);

                        MessageHelper.error(err.message);
                    });
            }, 1000);
        },

         /**
         * Load Referral Data
         */
        loadReferralDataCount() {
            let url = document.pageData.home.count_referral_data_url;

            this.setLoadingStatus(LOADING_REFERRAL_DATA);

            setTimeout(() => {
                axios.get(url)
                    .then(res => {
                        this.referralDataCount = res.data;
                        this.removeLoadingStatus(LOADING_REFERRAL_DATA);
                    })
                    .catch(err => {
                        this.removeLoadingStatus(LOADING_REFERRAL_DATA);

                        MessageHelper.error(err.message);
                    });
            }, 1000);
        },

        /**
         * Load daily traffics
         */
        loadActiveCountGatedevices() {
            let url = document.pageData.home.count_active_gatedevice_url;

            this.setLoadingStatus(LOADING_ACTIVE_GATEDEVICE);

            setTimeout(() => {
                axios.get(url)
                    .then(res => {
                        this.gatedeviceActiveCount = res.data;
                        this.removeLoadingStatus(LOADING_ACTIVE_GATEDEVICE);
                    })
                    .catch(err => {
                        this.removeLoadingStatus(LOADING_ACTIVE_GATEDEVICE);

                        MessageHelper.error(err.message);
                    });
            }, 1000);
        },


        /**
         * Load daily traffics
         */
        loadDailyCountTraffices() {
            let url = document.pageData.home.count_daily_traffic_url;

            this.setLoadingStatus(LOADING_TRAFFIC_PRESENTS);

            setTimeout(() => {
                axios.get(url)
                    .then(res => {
                        this.trafficPresentsCount = res.data;
                        this.removeLoadingStatus(LOADING_TRAFFIC_PRESENTS);
                    })
                    .catch(err => {
                        this.removeLoadingStatus(LOADING_TRAFFIC_PRESENTS);

                        MessageHelper.error(err.message);
                    });
            }, 1000);
        },

        /**
         * Load daily traffics
         */
        loadDailyTraffics() {
            let url = document.pageData.home.daily_traffic_url;

            this.setLoadingStatus(LOADING_TRAFFIC_DAILY);

            setTimeout(() => {
                axios.get(url)
                    .then(res => {
                        let labels = res.data.labels;
                        let series = res.data.series;

                        let result = {
                            labels: labels,
                            series: [
                                series.map(el => el.inputCount),
                                series.map(el => el.outputCount)
                            ]
                        };

                        this.dailyChartData = result;
                        this.removeLoadingStatus(LOADING_TRAFFIC_DAILY);
                    })
                    .catch(err => {
                        this.removeLoadingStatus(LOADING_TRAFFIC_DAILY);

                        MessageHelper.error(err.message);
                    });
            }, 1000);
        },

        /**
         * Load weekly traffics
         */
        loadWeeklyTraffics() {
            let url = document.pageData.home.weekly_traffic_url;

            this.setLoadingStatus(LOADING_TRAFFIC_WEEKLY);

            setTimeout(() => {
                axios.get(url)
                    .then(res => {
                        let labels = res.data.labels;
                        let series = res.data.series;

                        let result = {
                            labels: labels,
                            series: [
                                series.map(el => el.inputCount),
                                series.map(el => el.outputCount)
                            ]
                        };

                        this.weeklyChartData = result;
                        this.removeLoadingStatus(LOADING_TRAFFIC_WEEKLY);
                    })
                    .catch(err => {
                        this.removeLoadingStatus(LOADING_TRAFFIC_WEEKLY);

                        MessageHelper.error(err.message);
                    });
            }, 1000);
        },

        /**
         * Load monthly traffics
         */
        loadMonthlyTraffics() {
            let url = document.pageData.home.monthly_traffic_url;

            this.setLoadingStatus(LOADING_TRAFFIC_MONTHLY);

            setTimeout(() => {
                axios.get(url)
                    .then(res => {
                        let labels = res.data.labels;
                        let series = res.data.series;

                        let result = {
                            labels: labels,
                            series: [
                                series.map(el => el.inputCount),
                                series.map(el => el.outputCount)
                            ]
                        };

                        this.monthlyChartData = result;
                        this.removeLoadingStatus(LOADING_TRAFFIC_MONTHLY);
                    })
                    .catch(err => {
                        this.removeLoadingStatus(LOADING_TRAFFIC_MONTHLY);

                        MessageHelper.error(err.message);
                    });
            }, 1000);
        },

        /**
         * Load Gate Genders list
         */
        loadGategenders() {
            this.$store.dispatch('loadGategenders')
                .then(res => {
                    if (null != this.$store.getters.gategenders[0].id) {
                        this.tempRecord.gategender.id = this.$store.getters.gategenders[0].id;
                    }

                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load Gate Genders list
         */
        loadGatepasses() {
            this.$store.dispatch('loadGatepasses')
                .then(res => {
                    if (null != this.$store.getters.gatepasses[0].id) {
                        this.tempRecord.gatepass.id = this.$store.getters.gatepasses[0].id;
                    }
                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load Gate Direction
         */
        loadGatedirects() {
            this.$store.dispatch('loadGatedirects')
                .then(res => {
                    if (null != this.$store.getters.gatedirects[0].id) {
                        this.tempRecord.gatedirect.id = this.$store.getters.gatedirects[0].id;
                    }
                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load Zones list
         */
        loadZones() {
            this.$store.dispatch('loadZones')
                .then(res => {
                    if (null != this.$store.getters.zones[0].id) {
                        this.tempRecord.zone.id = this.$store.getters.zones[0].id;
                    }
                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load Records list
         */
        loadRecords(page) {
            this.page = page;
            this.isLoading = true;

            this.$store.dispatch('loadRecords', page)
                .then(res => {
                    this.loadGategenders();
                    this.loadGatepasses();
                    this.loadGatedirects();
                    this.loadZones();

                    this.showInvisibleItems();
                })
                .catch(err => {
                    this.isLoading = false;

                    //this.showInvisibleItems();
                });
        },
    }
});
